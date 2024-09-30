<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;
use App\Models\Department;
use App\Rules\NoDoubleExt;
use App\Traits\CommonTrait;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Rules\CheckedSameDate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    use CommonTrait;
     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
             // Query the Event table and join with Department
             $query = DB::table('nims_wp_event')
                 ->join('nims_wp_department', 'nims_wp_event.nims_wp_event_department', '=', 'nims_wp_department.nims_wp_department_id')
                 ->where('nims_wp_event.nims_wp_event_archive', '=', 0)  // Non-archived events
                 ->where('nims_wp_event.nims_wp_event_end_date', '>', DB::raw('NOW()'))  // Events ending after current time
                 ->select([
                     'nims_wp_event.nims_wp_event_id as id',
                     'nims_wp_event.nims_wp_event_title as title',
                     'nims_wp_event.nims_wp_event_submit_date as submit_date',
                     'nims_wp_event.nims_wp_event_start_date as start_date',
                     'nims_wp_event.nims_wp_event_end_date as end_date',
                     'nims_wp_department.nims_wp_department_name as department_name'  // Department name added
                 ])
                 ->orderBy('nims_wp_event.nims_wp_event_id', 'asc');  // Sort by event ID
     
             return DataTables::of($query)
                 ->filter(function ($query) use ($request) {
                     // Apply search filter for specific fields
                     if ($request->has('search.value')) {
                         $search = $request->input('search.value');
                         $query->where(function ($query) use ($search) {
                             $query->where('nims_wp_event_title', 'like', "%{$search}%")
                                 ->orWhere('nims_wp_event_submit_date', 'like', "%{$search}%")
                                 ->orWhere('nims_wp_event_start_date', 'like', "%{$search}%")
                                 ->orWhere('nims_wp_event_end_date', 'like', "%{$search}%")
                                 ->orWhere('nims_wp_department.nims_wp_department_name', 'like', "%{$search}%"); // Allow search by department name
                         });
                     }
                 })
                 ->editColumn('title', function ($row) {
                     return Str::limit($row->title, 30);  // Limit the event title to 30 characters
                 })
                 ->addIndexColumn()  // Add index column
                 ->addColumn('department', function ($row) {
                     return $row->department_name;  // Display department name
                 })
                 ->addColumn('action', function ($row) {
                     // Check for edit permission
                     $editPermission = auth()->user()->can('view-page', 'event-edit');
     
                     $buttons = '';
                     if ($editPermission) {
                         $buttons .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit editBtn"> <i class="fas fa-edit"></i></a>';
                     }
                     
                     return $buttons;
                 })
                 ->editColumn('submit_date', function ($row) {
                     return $row->submit_date ? $this->convertDateTimeFormateYmd($row->submit_date) : '';                   
                 })
                 ->editColumn('start_date', function ($row) {
                     return $row->start_date ? $this->convertDateTimeFormateYmd($row->start_date) : '';  
                 })
                 ->editColumn('end_date', function ($row) {
                     return $row->end_date ? $this->convertDateTimeFormateYmd_hi($row->end_date) : '';  
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }
         $departments = Department::all();
         // Render the events index view if not AJAX
         return view('events.index',compact('departments'));
     }
     
     
    

    public function create()
    {
        return view('events.create');
    }


    public function store(Request $request)
    {
        
        // dd($request->all());
        // Define validation rules
        $rules = [
            'title' => [
                'required',
                'string',
                'unique:nims_wp_event,nims_wp_event_title',
                'regex:/^[A-Za-z0-9\s]+$/',
                'min:3',
                'max:50'
            ],
            'notify' => [
                'required',
                'in:1,2,3' // Correct the list of allowed values
            ],
            'dep_name' => [
                'required',  // Required field
                'exists:nims_wp_department,nims_wp_department_id',  // Ensure selected department exists
            ],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'main_doc' => ['required', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf', new NoDoubleExt()]
        ];

       

        // Define attribute names
        $attributeNames = [
            'title' => 'title',
            'notify' => 'notify',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'main_doc' => 'Attachment'
        ];

      
        // Validate the request
        $validator = Validator::make($request->all(), $rules, [], $attributeNames);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Sanitize input data
        $title = $this->sanitizeInput($request->title);
        $h1_title = $request->h1;
        $notify_status = $this->sanitizeInput($request->notify);
        $h2_notify_status = $request->h2;

        // Description value sanitizeInput for both and hidden field decode before sanitize
        // $description = base64_decode($h3);
        $description = $request->description;
        $h3 = $request->h3;
        // $h3_des = base64_decode($h3);
        $h3_des =  $h3;
        // / 1. Remove newlines and other unwanted characters (like \r, \n)
        $h3_des = str_replace(["\r", "\n"], '', $h3_des);
// dd($notify_status,base64_decode($h2_notify_status));
        $dep_name = $this->sanitizeInput($request->dep_name);
        $h6_dep_name = $request->h6;


        
        // dd($description,$h3_des);
        if (!$this->dataTamper($title, $h1_title) || !$this->dataTamper($notify_status, $h2_notify_status)  || !$this->dataTamper($dep_name, $h6_dep_name) ) {
            // return redirect()->route('error-page')->with('errorTampering', true);
            // return response()->json(['redirect' => route('error-page')], 400); 
            Log::error('Store Data error: ' . 'Data temporing.');
                return response()->json([
                    'status' => 'error',
                    'errorTamperingValue' => true,
                    'redirect' => route('error-page','errorTampering')
                ],400);
                die;
        }
        // dd('datachceck',$request->all());
        // Format dates
        date_default_timezone_set('Asia/Kolkata');
        $start_date = $this->convertDateTimeFormateYmd($request->start_date);
        $h3_sd = base64_decode($request->h3);
        $end_date = $this->convertDateTimeFormateYmd_hi($request->end_date);
        $h4_ed = base64_decode($request->h4);

        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', date('d/m/Y'))));
        $entry_date = $this->convertDateTimeFormateYmd_hisA();
        $client_ip = $request->ip();
        $user_id = $request->user()->nims_wp_user_id;
        $add_id = rand(10, 10000000);
        $archive = 0;
        $main_num = 1;

        // Handle file uploads
        $uploadedFiles = [];
        $directoryDate = date("Y-m-d");
        $path = 'public/uploads/events/' . $directoryDate;

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
            Log::info('Directory created: ' . $path);
        }

        // Upload main document
        $file = $request->file('main_doc');
        if ($file) {
            $main_doc = $this->uploadAndSanitizeFile(14,$request->number, $path, $file);
            Log::info('Main document uploaded: ' . $main_doc);
        }

       
        // Create a new event and notification data
        $eventData = [
            'nims_wp_event_archive' => $archive,
            'nims_wp_event_title' => $title,
            'nims_wp_event_desc' => $description,
            'nims_wp_event_start_date' => $start_date,
            'nims_wp_event_end_date' => $end_date,
            'nims_wp_event_submit_date' => $publish_date,
            'nims_wp_event_doc' => $main_doc,
            'nims_wp_event_department' => $dep_name,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id,
            'nims_wp_notify_status' => $notify_status,

        ];

        $notificationData = [
            'notifi_archive' => $archive,
            'type' => 'event',
            'notifi_title' => $title,
            'notifi_number' => 'Event',
            'notifi_desc' => $description,
            'notifi_start_date' => $start_date,
            'notifi_end_date' => $end_date,
            'notifi_submit_date' => $publish_date,
            'notifi_docu' => $main_doc,
            'notifi_department' => $dep_name,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id
        ];


       
        // Use transactions to ensure atomic operations
        DB::beginTransaction();
        try {
            // Save the event data
            $event = Event::create($eventData);
            Log::info('Event added: ' . $event->nims_wp_event_id);
            $notificationData['type_id'] = $event->nims_wp_event_id;
            // dd($notificationData);
            // Save the notification data
            $notification = Notification::create($notificationData);
            Log::info('Notification added: ' . $notification->notifi_id);

            DB::commit();
            Log::info('Transaction committed successfully');

            return response()->json([
                'status' => 'success',
                'message' => 'Event added successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while saving the data: ' . $e->getMessage()
            ], 500);
        }
    }



  
    public function show($id): View
     {
 
         $event = Event::find($id);
 
         return view('events.show',compact('event'));
 
     }

     public function edit($id)
    {
        // dd($id);
        $event = Event::find($id); 
        // dd($event);
       
        return response()->json($event);
        // return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
{
    // Fetch the existing event by its ID
    $event = Event::findOrFail($id);

    // Define validation rules
    $rules = [
        'title' => [
            'required',
            'string',
            'unique:nims_wp_event,nims_wp_event_title,' . $id .  ',nims_wp_event_id',
            'regex:/^[A-Za-z0-9\s]+$/',
            'min:3',
            'max:50',
            // Rule::unique('nims_wp_event', 'nims_wp_event_title')->ignore($event->nims_wp_event_id) // Ignore current record during title uniqueness validation
        ],
        'edit_notify' => [
            'required',
            'in:1,2,3' // Correct the list of allowed values
        ],
        'dep_name' => [
            'required',
            'exists:nims_wp_department,nims_wp_department_id' // Ensure selected department exists
        ],
        'start_date' => ['required'],
        'end_date' => ['required'],
        // 'main_doc' => ['file', 'max:2048', 'mimes:jpg,jpeg,png,pdf', new NoDoubleExt()]
        'main_doc' => ['nullable', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf', new NoDoubleExt()]
    ];

    // Define attribute names
    $attributeNames = [
        'title' => 'title',
        'notify' => 'notify',
        'start_date' => 'Start date',
        'end_date' => 'End date',
        'main_doc' => 'Attachment'
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules, [], $attributeNames);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }
// dd($request->all());
    // Sanitize input data
    $title = $this->sanitizeInput($request->title);
    $h1_title = $request->h1;
    $notify_status = $this->sanitizeInput($request->edit_notify);
    $h2_notify_status = $request->h2;

    // Description value sanitizeInput for both and hidden field decode before sanitize
    $description = $request->description;
    $h3 = $request->h3;
    // $h3_des = base64_decode($h3);
    $h3_des = $h3;
    // $h3_des = str_replace(["\r", "\n"], '', $h3_des);

    $dep_name = $this->sanitizeInput($request->dep_name);
    $h6_dep_name = $request->h6;
    // dd($request->all());
// dd($notify_status,base64_decode($h2_notify_status));
// dd($description,$h3_des);
    // Check for data tampering
    if (!$this->dataTamper($title, $h1_title) || !$this->dataTamper($notify_status, $h2_notify_status)  || !$this->dataTamperDes($description, $h3_des) || !$this->dataTamper($dep_name, $h6_dep_name)) {
        Log::error('Update Data error: Data tampering detected.');
        return response()->json([
            'status' => 'error',
            'errorTamperingValue' => true,
            'redirect' => route('error-page', 'errorTampering')
        ], 400);
    }
// dd($request->all());
    // Format dates
    $start_date = $this->convertDateTimeFormateYmd($request->start_date);
    $end_date = $this->convertDateTimeFormateYmd_hi($request->end_date);

    $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', date('d/m/Y'))));
    $entry_date = $this->convertDateTimeFormateYmd_hisA();
    $client_ip = $request->ip();
    $user_id = $request->user()->nims_wp_user_id;

    // Handle file uploads
    $directoryDate = date("Y-m-d");
    $path = 'public/uploads/events/' . $directoryDate;

    // Ensure the directory exists
    if (!File::exists($path)) {
        File::makeDirectory($path, 0777, true);
        Log::info('Directory created: ' . $path);
    }

    // Upload main document if it exists
    $main_doc = $event->nims_wp_event_doc; // Use the existing document if not replaced
    $file = $request->file('main_doc');
    if ($file) {
        $main_doc = $this->uploadAndSanitizeFile(14, $request->number, $path, $file);
        Log::info('Main document updated: ' . $main_doc);
    }

    // Prepare event data for update
    $eventData = [
        'nims_wp_event_title' => $title,
        'nims_wp_event_desc' => $description,
        'nims_wp_event_start_date' => $start_date,
        'nims_wp_event_end_date' => $end_date,
        'nims_wp_event_doc' => $main_doc,
        'nims_wp_event_department' => $dep_name,
        'nims_wp_notify_status' => $notify_status,
        'nims_wp_log_ip' => $client_ip,
        'entry_date' => $entry_date
    ];

    $notificationData = [
        'notifi_title' => $title,
        'notifi_desc' => $description,
        'notifi_start_date' => $start_date,
        'notifi_end_date' => $end_date,
        'notifi_docu' => $main_doc,
        'notifi_department' => $dep_name,
        'nims_wp_log_ip' => $client_ip,
        'entry_date' => $entry_date
    ];

    // Use transactions to ensure atomic operations
    DB::beginTransaction();
    try {
        // Update the event data
        $event->update($eventData);
        Log::info('Event updated: ' . $event->nims_wp_event_id);

        // Update the notification data
        $notification = Notification::where('type_id', $event->nims_wp_event_id)->where('type', 'event')->first();
        if ($notification) {
            $notification->update($notificationData);
            Log::info('Notification updated: ' . $notification->notifi_id);
        }

        DB::commit();
        Log::info('Transaction committed successfully');

        return response()->json([
            'status' => 'success',
            'message' => 'Event updated successfully!'
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Transaction failed: ' . $e->getMessage());
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while updating the data: ' . $e->getMessage()
        ], 500);
    }
}

    public function imgDeleteSingle(Request $request)
    {   
        // dd($request->all());
        $image = 'nims_wp_event_link'.$request->img;
        $event = Event::find($request->id); 
        if ($event) {
            // Get the path of the image file
            $filePath = $event->$image; // Adjust the attribute name according to your model
            // Delete the file from the storage
            if (Storage::exists($filePath)) {                
                unlink(Storage::path($filePath));
                // Delete the image record from the database               
                $event->$image = null;
                $event->save();
                return response()->json(['success' => 'Image deleted successfully.']);
            }            
            return response()->json(['error' => 'Image is not deleted.']);
        }        
    }
    public function mainImgDelete(Request $request)
    {   
        dd($request->all());
      
        $event = Event::find($request->id); 
        if ($event) {
            // Get the path of the image file
            $filePath = $event->nims_wp_event_doc; // Adjust the attribute name according to your model
            // Delete the file from the storage
            if (Storage::exists($filePath)) {                
                unlink(Storage::path($filePath));
                // Delete the image record from the database               
                $event->nims_wp_event_doc = null;
                $event->save();
                return response()->json(['success' => 'Attachment deleted successfully.']);
            }            
            return response()->json(['error' => 'Attachment is not deleted.']);
        }        
    }
    public function destroy($id)
    {
        // dd($id);
       $event = Event::find($id)->delete();
    //    dd($event);
        return redirect()->back()
                    ->with('success', 'Event deleted successfully');
    }
    public function removeAttachment(Request $request)
    {
        // dd($request->id,$request->attachment_number,$request->attachment_url);
        // dd($request->all());
        $id = $request->id;
        $ci = $request->ci;
        $attachment_number = $request->attachment_number;
        $cn = $request->cn;
        if (!$this->dataTamper($id, $ci) || !$this->dataTamper($attachment_number, $cn)) {
            // return redirect()->route('error-page')->with('errorTampering', true);
            // dd();
            Log::error('Attachment error: ' . 'Attachment is Data temporing.');
            return response()->json([
                'status' => 'error',
                'errorTamperingValue' => true,
                'redirect' => route('error-page','errorTampering')
            ],400);
            die;
            }
        $event = Event::find($id); 
        $notification = Notification::where(['notifi_number' =>$event->nims_wp_event_number])->first('notifi_id'); 

        // dd($event,$notification);

        if ($event) {
            // Get the path of the image file

            $image = 'nims_wp_event_link'.$attachment_number;
            $notifi_image = 'notifi_docu_link'.$attachment_number;
          
            $filePath = $event->$image; // Adjust the attribute name according to your model
            // dd($filePath);
            // Delete the file from the storage
            if (Storage::exists($filePath)) {                
                unlink(Storage::path($filePath));
                // Delete the image record from the database 
                // dd($event->$image);              
                $event->$image = null;
                $notification->$notifi_image = null;
      
                if($event->save() && $notification->save()){
                        return response()->json([
                            'status'=>'success',
                            'message' => 'Attachment removed successfully.'
                        ]);
                }else{
                    Log::error('Attachment error: ' . 'Attachment is not deleted.');
                      return response()->json([ 
                        'status' => 'error',
                        'message' => 'Attachment is not deleted.'
                        ]);
                }
            }            
            Log::error('Attachment error: ' . 'Attachment is not exists.');
            return response()->json([ 
            'status' => 'error',
            'message' => 'Attachment is not exists.'
            ]);
        }
        Log::error('Attachment failed: ' . 'Attachment failed.');
        return response()->json([ 
            'status' => 'error',
            'message' => 'Attachment failed.'
            ]); 
                
    }
    public function changeStatusEvent(Request $request)
    {
    	//\Log::info($request->all());
        // dd($request->all());
        // dd($request->id);
        $event = Event::find($request->id);
        $status = ($event->nims_wp_user_status == 1) ? 0: 1; 
        $event->nims_wp_user_status = $status;
        $event->save();
        if($status)
        {
          return response()->json(['success'=>'InActivat successfully.']);         
        }else{
            return response()->json(['success'=>'Activat successfully.']); 
        }
    }

    
    public function storeCorrigendum(Request $request)
    {

        // Define validation rules
        $rules = [
            'title' => [
                'required',
                'string',
                'unique:nims_wp_event,nims_wp_event_title',
                'regex:/^[a-zA-Z1-9 ]+$/',
                'min:3',
                'max:50'
            ],
            'number' => [
                'required',
                'numeric',
                'digits:10',
                // 'unique:nims_wp_event,nims_wp_event_number'
            ],
            'start_date' => ['required'],
            'end_date' => ['required',new CheckedSameDate(Event::class,'nims_wp_event_number','nims_wp_event_end_date','Main Event & Corrigendum')],
            'main_doc' => ['required', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf', new NoDoubleExt()]
        ];

       

        // Define attribute names
        $attributeNames = [
            'title' => 'title',
            'number' => 'number',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'main_doc' => 'Attachment'
        ];

        

        // Validate the request
        $validator = Validator::make($request->all(), $rules, [], $attributeNames);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // Sanitize input data
        $title = $this->sanitizeInput($request->title);
        $h1_title = $request->h1;
        $number = $this->sanitizeInput($request->number);
        $h2_number = $request->h2;

        // Description value sanitizeInput for both and hidden field decode before sanitize
        $description = $request->description;
        // $description = base64_decode($description);
        $h3 = $request->h3;
 
     
        

        
        // dd($description,$h3_des);
        if (!$this->dataTamper($title, $h1_title) || !$this->dataTamper($number, $h2_number) || !$this->dataTamperDes($description,$h3)) {
            // return redirect()->route('error-page')->with('errorTampering', true);
            // return response()->json(['redirect' => route('error-page')], 400); 
            Log::error('Store Data error: ' . 'Data temporing.');
                return response()->json([
                    'status' => 'error',
                    'errorTamperingValue' => true,
                    'redirect' => route('error-page','errorTampering')
                ],400);
                die;
        }

        // Format dates
        date_default_timezone_set('Asia/Kolkata');
        $start_date = $this->convertDateTimeFormateYmd($request->start_date);
        $h3_sd = base64_decode($request->h3);
        $end_date = $this->convertDateTimeFormateYmd_hi($request->end_date);
        $h4_ed = base64_decode($request->h4);

        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', date('d/m/Y'))));
        $entry_date = $this->convertDateTimeFormateYmd_hisA();
        $client_ip = $request->ip();
        $user_id = $request->user()->nims_wp_user_id;
        $add_id = rand(10, 10000000);
        $archive = 0;
        $main_num = 0;

        // Handle file uploads
        $uploadedFiles = [];
        $directoryDate = date("Y-m-d");
        $path = 'public/uploads/events/' . $directoryDate;

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
            Log::info('Directory created: ' . $path);
        }

        // Upload main document
        $file = $request->file('main_doc');
        if ($file) {
            $main_doc = $this->uploadAndSanitizeFile(14,$request->number, $path, $file);
            Log::info('Main document uploaded: ' . $main_doc);
        }

       

        // Create a new event and notification data
        $eventData = [
            'nims_add_id' => $add_id,
            'nims_mainevent' => $main_num,
            'nims_wp_event_archive' => $archive,
            'nims_wp_event_title' => $title,
            'nims_wp_event_number' => $number,
            'nims_wp_event_description' => $description,
            'nims_wp_event_start_date' => $start_date,
            'nims_wp_event_end_date' => $end_date,
            'nims_wp_event_submit_date' => $publish_date,
            'nims_wp_event_doc' => $main_doc,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id
        ];

        $notificationData = [
            'nims_main_id' => $add_id,
            'nims_main' => $main_num,
            'notifi_archive' => $archive,
            'type' => 'event',
            'notifi_title' => $title,
            'notifi_number' => $number,
            'notifi_desc' => $description,
            'notifi_start_date' => $start_date,
            'notifi_end_date' => $end_date,
            'notifi_submit_date' => $publish_date,
            'notifi_docu' => $main_doc,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id
        ];

       
       
        // Use transactions to ensure atomic operations
        DB::beginTransaction();
        try {
            // Save the event data
            $event = Event::create($eventData);
            Log::info('Event added: ' . $event->nims_wp_event_id);
            $notificationData['type_id'] = $event->nims_wp_event_id;
            // dd($notificationData);
            // Save the notification data
            $notification = Notification::create($notificationData);
        
            Log::info('Notification added: ' . $notification->notifi_id);

            DB::commit();
            Log::info('Transaction committed successfully');

            return response()->json([
                'status' => 'success',
                'message' => 'New Corrigendum added successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while saving the data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getNumber()
    {
        
        $nims_mainevent = 1;
        $nims_wp_event_archive = 0;

        // Perform the query using Eloquent
        $events = Event::where('nims_mainevent', $nims_mainevent)
                         ->where('nims_wp_event_archive', $nims_wp_event_archive)
                         ->where('nims_wp_event_end_date', '>',  Carbon::now())
                         ->orderBy('nims_wp_event_number', 'DESC')
                         ->get(['nims_wp_event_number']);

        return response()->json($events);
    }

    public function listArchive(Request $request)
    {
        $this->authorize('view-page', 'event-list-archive');
            if ($request->ajax()) {
                $query = Event::where('nims_wp_event_archive', 1)
                            ->orWhere('nims_wp_event_end_date', '<',  Carbon::now())
                    ->select([
                        'nims_wp_event_id as id',
                        'nims_wp_event_title as title',
                        'nims_wp_event_number as number',
                        'nims_wp_event_submit_date as submit_date',
                        'nims_wp_event_start_date as start_date',
                        'nims_wp_event_end_date as end_date'
                    ])
                    // ->orderBy('nims_wp_event_number', 'ASC')
                    // ->orderBy('nims_wp_event_id', 'ASC')
                    ->latest('id','ASC');
                    

                return DataTables::eloquent($query)
                    ->filter(function ($query) use ($request) {
                        if ($request->has('search.value')) {
                            $search = $request->input('search.value');
                            $query->where(function ($query) use ($search) {
                                $query->where('nims_wp_event_title', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_event_number', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_event_submit_date', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_event_start_date', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_event_end_date', 'like', "%{$search}%");
                            });
                        }
                    })
                    ->editColumn('title', function($row) {
                        return Str::limit($row->title, 50);
                    })
                    ->editColumn('number', function($row) {
                        return Str::limit($row->number, 50);
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $editPermission = auth()->user()->can('view-page', 'event-edit-archive');

                        $buttons = '';
                        
                        if ($editPermission) {
                            $buttons .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit editBtn"> <i class="fas fa-edit"></i></a>';
                        }
                        
                        return $buttons;
                        
                    })
                    ->editColumn('submit_date', function($row){
                        return $row->submit_date ? $this->convertDateTimeFormateYmd($row->submit_date) : '';                   
                    })
                    ->editColumn('start_date', function($row){
                        return $row->start_date ? $this->convertDateTimeFormateYmd($row->start_date) : '';  
                    })
                    ->editColumn('end_date', function($row){
                        return $row->end_date ? $this->convertDateTimeFormateYmd_hi($row->end_date) : '';  
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('events.list-archive');
    }
}


