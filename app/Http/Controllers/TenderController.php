<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\View\View;
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

class TenderController extends Controller
{
    use CommonTrait;
     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    //  public function index(Request $request): View
    //  {
    //      $tenders = Tender::latest('nims_wp_tender_id')->paginate(5);
    //     //  $tenders = Tender:: orderByDesc('nims_wp_tender_id')->paginate(5); // working pagination but searching not all page
    //     //  $tenders = Tender:: orderByDesc('nims_wp_tender_id')->get();

    //      return view('tenders.index',compact('tenders'));
    //  }

    public function index(Request $request)
{

    // dd($request->all());
    if ($request->ajax()) {
        $query = Tender::where('nims_wp_tender_archive', 0)
        ->where('nims_wp_tender_end_date', '>', Carbon::now())
        ->select([
                    'nims_wp_tender_id as id',
                    'nims_wp_tender_title as title',
                    'nims_wp_tender_number as number',
                    'nims_wp_tender_submit_date as submit_date',
                    'nims_wp_tender_start_date as start_date',
                    'nims_wp_tender_end_date as end_date'
                ])
        ->orderBy('nims_wp_tender_number', 'asc')
        ->orderBy('nims_wp_tender_id', 'asc')
        ->latest('id','asc');
        // dd($query);
//dd($query->toSql());
        return DataTables::eloquent($query)
            ->filter(function ($query) use ($request) {
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('nims_wp_tender_title', 'like', "%{$search}%")
                            ->orWhere('nims_wp_tender_number', 'like', "%{$search}%")
                            ->orWhere('nims_wp_tender_submit_date', 'like', "%{$search}%")
                            ->orWhere('nims_wp_tender_start_date', 'like', "%{$search}%")
                            ->orWhere('nims_wp_tender_end_date', 'like', "%{$search}%");
                    });
                }
            })
            ->editColumn('title', function($row) {
                return Str::limit($row->title, 30);
            })
            ->editColumn('number', function($row) {
                return Str::limit($row->number, 20);
            })
            ->addIndexColumn()
            ->addColumn('action', function($row){               
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit editBtn"> <i class="fas fa-edit"></i></a>';
                return $btn;
            })
            ->editColumn('submit_date', function($row){
                return $row->submit_date ? date('Y-m-d', strtotime(str_replace('/', '-', $row->submit_date))) : '';                   
            })
            ->editColumn('start_date', function($row){
                return $row->start_date ? date('Y-m-d', strtotime(str_replace('/', '-', $row->start_date))) : '';  
            })
            ->editColumn('end_date', function($row){
                return $row->end_date ? date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $row->end_date))) : '';  
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('tenders.index');
}
    

    public function create()
    {
        // $files = Storage::files('uploads');
        // dd($files);
        return view('tenders.create');
    }


    public function store(Request $request)
    {
        
        // dd($request->all());
        // Define validation rules
        $rules = [
            'title' => [
                'required',
                'string',
                'unique:nims_wp_tenders,nims_wp_tender_title',
                'regex:/^[a-zA-Z1-9 ]+$/',
                'min:3',
                'max:50'
            ],
            'number' => [
                'required',
                'numeric',
                'digits:10',
                'unique:nims_wp_tenders,nims_wp_tender_number'
            ],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'main_doc' => ['required', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf', new NoDoubleExt()]
        ];

        // Add dynamic rules for attachments
        $attachmentCount = 10;
        for ($i = 1; $i <= $attachmentCount; $i++) {
            $rules['attachment_' . $i] = [
                'file',
                'max:2048',
                'mimes:jpg,jpeg,png,pdf',
                new NoDoubleExt()
            ];
        }

        // Define attribute names
        $attributeNames = [
            'title' => 'title',
            'number' => 'number',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'main_doc' => 'Attachment'
        ];

        // Add dynamic attribute names for attachments
        for ($i = 1; $i <= $attachmentCount; $i++) {
            $attributeNames['attachment_' . $i] = 'Attachment ' . $i;
        }

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
        // $description = base64_decode($h3);
        $description = $request->description;
        $h3 = $request->h3;
        // $h3 = base64_decode($h3);

        

        
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
        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
        $h3_sd = base64_decode($request->h3);
        $end_date = date('Y-m-d h:i', strtotime(str_replace('/', '-', $request->end_date)));
        $h4_ed = base64_decode($request->h4);

        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', date('d/m/Y'))));
        $entry_date = date('Y-m-d h:i:s A', strtotime(str_replace('/', '-', date('d/m/Y h:i:s A'))));
        $client_ip = $request->ip();
        $user_id = $request->user()->nims_wp_user_id;
        $add_id = rand(10, 10000000);
        $archive = 0;
        $main_num = 1;

        // Handle file uploads
        $uploadedFiles = [];
        $directoryDate = date("Y-m-d");
        $path = 'public/uploads/tenders/' . $directoryDate;

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
            Log::info('Directory created: ' . $path);
        }

        // Upload main document
        $file = $request->file('main_doc');
        if ($file) {
            $main_doc = $this->uploadAndSanitizeFile($request->number, $path, $file);
            Log::info('Main document uploaded: ' . $main_doc);
        }

        // Upload additional attachments
        for ($i = 1; $i <= $attachmentCount; $i++) {
            $fileKey = 'attachment_' . $i;
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $uploadedFiles[$fileKey] = $this->uploadAndSanitizeFile($request->number, $path, $file);
                Log::info('Attachment ' . $i . ' uploaded: ' . $uploadedFiles[$fileKey]);
            }
        }

        // Create a new tender and notification data
        $tenderData = [
            'nims_add_id' => $add_id,
            'nims_maintender' => $main_num,
            'nims_wp_tender_archive' => $archive,
            'nims_wp_tender_title' => $title,
            'nims_wp_tender_number' => $number,
            'nims_wp_tender_description' => $description,
            'nims_wp_tender_start_date' => $start_date,
            'nims_wp_tender_end_date' => $end_date,
            'nims_wp_tender_submit_date' => $publish_date,
            'nims_wp_tender_doc' => $main_doc,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id
        ];

        $notificationData = [
            'nims_main_id' => $add_id,
            'nims_main' => $main_num,
            'notifi_archive' => $archive,
            'type' => 'tender',
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

        // Add attachment paths to the tender data and notification data
        for ($i = 1; $i <= $attachmentCount; $i++) {
            if (isset($uploadedFiles['attachment_' . $i])) {
                $tenderData['nims_wp_tender_link' . $i] = $uploadedFiles['attachment_' . $i];
                $notificationData['notifi_docu_link' . $i] = $uploadedFiles['attachment_' . $i];
            }
        }
       
        // Use transactions to ensure atomic operations
        DB::beginTransaction();
        try {
            // Save the tender data
            $tender = Tender::create($tenderData);
            Log::info('Tender added: ' . $tender->nims_wp_tender_id);
            $notificationData['type_id'] = $tender->nims_wp_tender_id;
            // dd($notificationData);
            // Save the notification data
            $notification = Notification::create($notificationData);
            Log::info('Notification added: ' . $notification->notifi_id);

            DB::commit();
            Log::info('Transaction committed successfully');

            return response()->json([
                'status' => 'success',
                'message' => 'Tender added successfully!'
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
 
         $tender = Tender::find($id);
 
         return view('tenders.show',compact('tender'));
 
     }

     public function edit($id)
    {
        // dd($id);
        $tender = Tender::find($id); 
        // dd($tender);
        $additional_attachments =  [];
        $additional_attachments_number =  [];
        for($i=1; $i <= 10; $i++){
            $imagelink = 'nims_wp_tender_link'.$i;
            $imagelink = $tender->$imagelink;

           $additional_attachments['imageLink'.$i] = $imagelink;
           
          
        }
        // dd($additional_attachments);
        $tender['additional_attachments'] = $additional_attachments;
        $tender['additional_attachments_number'] = $additional_attachments_number;
        // dd($additional_attachments);   
    //    dd($tender);
        return response()->json($tender);
        // return view('tenders.edit', compact('tender'));
    }

    public function update(Request $request, $id)
    {
        // dd($id,$request->all());
        $tender = Tender::find($id);

        if (!$tender) {
            return redirect()->route('tenders.index')->with('error', 'Tender not found.');
        }       

        // Format dates
        date_default_timezone_set('Asia/Kolkata');
        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
        $h3_sd = base64_decode($request->h3);
        $end_date = date('Y-m-d h:i', strtotime(str_replace('/', '-', $request->end_date)));
        $h4_ed = base64_decode($request->h4);


        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->publish_date)));        

        $entry_date = date('Y-m-d h:i:s A', strtotime(str_replace('/', '-', date('d/m/Y h:i:s A'))));


        // $add_id = rand(10, 10000000);

        $archive = ($request->archive == 'on') ? 1: 0; 

        $main_num = 1;
        $client_ip = $request->ip();
        $user_id = $request->user()->nims_wp_user_id;

        // dd($client_ip);
        // Define validation rules
        $rules = [
            'title' => [
                'required',
                'string',
                'unique:nims_wp_tenders,nims_wp_tender_title,' . $id .  ',nims_wp_tender_id',
                'regex:/^(?!(?>[^.]*\.){2})[A-Za-z0-9 \.]+$/',
                'min:3',
                'max:50'
            ],
            'number' => [
                'required',
                'numeric',
                'digits:10',
                // 'unique:nims_wp_tenders,nims_wp_tender_number,' . $id .  ',nims_wp_tender_id'
            ],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'main_doc' => ['file', 'max:2048', 'mimes:jpg,jpeg,png,pdf', new NoDoubleExt()]
        ];

        // Add dynamic rules for attachments
        $attachmentCount = 10;
        for ($i = 1; $i <= $attachmentCount; $i++) {
            $rules['attachment_' . $i] = [
                'file',
                'max:2048',
                'mimes:jpg,jpeg,png,pdf',
                new NoDoubleExt()
            ];
        }

        // Define attribute names
        $attributeNames = [
            'title' => 'title',
            'number' => 'number',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'main_doc' => 'Attachment'
        ];

        // Add dynamic attribute names for attachments
        for ($i = 1; $i <= $attachmentCount; $i++) {
            $attributeNames['attachment_' . $i] = 'Attachment ' . $i;
        }

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

        // description value sanitizeInput for both and hidden field decode before sanitize
        $description = $request->description;
        // $h3 = base64_decode($request->h3);
        $h3 = $request->h3;
        // echo '<pre>'.$description.'<br>'.$h3_des;die;
        // dd($description,$h3);
       if (!$this->dataTamper($title, $h1_title) || !$this->dataTamper($number, $h2_number) || !$this->dataTamperDes($description,$h3)) {
        // return redirect()->route('error-page')->with('errorTampering', true);
        Log::error('Update Data error: ' . 'Data temporing.');
        return response()->json([
            'status' => 'error',
            'errorTamperingValue' => true,
            'redirect' => route('error-page','errorTampering')
        ],400);
        die;
        }

        // Handle file uploads
        $uploadedFiles = [];
        $directoryDate = date("Y-m-d");
        $path = 'public/uploads/tenders/' . $directoryDate;

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
            Log::info('Directory created: ' . $path);
        }

        // Upload main document
        $main_doc = $tender->nims_wp_tender_doc; // default to existing main document
        $file = $request->file('main_doc');
        if ($file) {
            $main_doc = $this->uploadAndSanitizeFile($request->number, $path, $file);
            Log::info('Main document uploaded: ' . $main_doc);
        }

        // Upload additional attachments
        for ($i = 1; $i <= $attachmentCount; $i++) {
            $fileKey = 'attachment_' . $i;
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                // dd($file);
                $uploadedFiles[$fileKey] = $this->uploadAndSanitizeFile($request->number, $path, $file);
                Log::info('Attachment '.date("Y-m-d :h:si") . $i . ' uploaded: ' . $uploadedFiles[$fileKey]);
            }
        }

        // Prepare the updated tender and notification data
        $tenderData = [
            'nims_maintender' => $main_num, 
            'nims_wp_tender_archive' => $archive,  
            'nims_wp_tender_title' => $title,
            'nims_wp_tender_number' => $number,
            'nims_wp_tender_description' => $description,
            'nims_wp_tender_start_date' => $start_date,
            'nims_wp_tender_end_date' => $end_date,
            'nims_wp_tender_submit_date' => $publish_date,
            'nims_wp_tender_doc' => $main_doc,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id,
        ];

        $notificationData = [
            'nims_main' => $main_num,
            'notifi_archive' => $archive,
            'type' => 'tender',
            'notifi_title' => $title,
            'notifi_number' => $number,
            'notifi_desc' => $description,
            'notifi_start_date' => $start_date,
            'notifi_end_date' => $end_date,
            'notifi_submit_date' => $publish_date,
            'notifi_docu' => $main_doc,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id,
        ];

        // Add attachment paths to the tender data and notification data
        for ($i = 1; $i <= $attachmentCount; $i++) {
            if (isset($uploadedFiles['attachment_' . $i])) {                
                $tenderData['nims_wp_tender_link' . $i] = $uploadedFiles['attachment_' . $i];
                $notificationData['notifi_docu_link' . $i] = $uploadedFiles['attachment_' . $i];
            }
        }
    //     $na= Notification::find(2031);
    //    dd($notificationData,$na);
        // Use transactions to ensure atomic operations
        DB::beginTransaction();
        try {
            // Update the tender data
            $tender->update($tenderData);
            Log::info('Tender updated: ' . $tender->nims_wp_tender_id);
            // dd($tender->type_id);
            // dd($notificationData);
            // Update the notification data
            Notification::where('type_id', $tender->nims_wp_tender_id)->update($notificationData);
            Log::info('Notification updated for tender ID and : tender number' .$tender->nims_wp_tender_id. ' and '. $tender->nims_wp_tender_number);

            DB::commit();
            Log::info('Transaction committed successfully');

            // return redirect()->route('tenders.index')->with('success', 'Tender updated successfully!');
            return response()->json([
                'status' => 'success',
                'message' => 'Tender updated successfully!'
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
    public function imgDeleteSingle(Request $request)
    {   
        // dd($request->all());
        $image = 'nims_wp_tender_link'.$request->img;
        $tender = Tender::find($request->id); 
        if ($tender) {
            // Get the path of the image file
            $filePath = $tender->$image; // Adjust the attribute name according to your model
            // Delete the file from the storage
            if (Storage::exists($filePath)) {                
                unlink(Storage::path($filePath));
                // Delete the image record from the database               
                $tender->$image = null;
                $tender->save();
                return response()->json(['success' => 'Image deleted successfully.']);
            }            
            return response()->json(['error' => 'Image is not deleted.']);
        }        
    }
    public function mainImgDelete(Request $request)
    {   
        dd($request->all());
      
        $tender = Tender::find($request->id); 
        if ($tender) {
            // Get the path of the image file
            $filePath = $tender->nims_wp_tender_doc; // Adjust the attribute name according to your model
            // Delete the file from the storage
            if (Storage::exists($filePath)) {                
                unlink(Storage::path($filePath));
                // Delete the image record from the database               
                $tender->nims_wp_tender_doc = null;
                $tender->save();
                return response()->json(['success' => 'Attachment deleted successfully.']);
            }            
            return response()->json(['error' => 'Attachment is not deleted.']);
        }        
    }
    public function destroy($id)
    {
        // dd($id);
       $tender = Tender::find($id)->delete();
    //    dd($tender);
        return redirect()->back()
                    ->with('success', 'Tender deleted successfully');
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
        $tender = Tender::find($id); 
        $notification = Notification::where(['notifi_number' =>$tender->nims_wp_tender_number])->first('notifi_id'); 

        // dd($tender,$notification);

        if ($tender) {
            // Get the path of the image file

            $image = 'nims_wp_tender_link'.$attachment_number;
            $notifi_image = 'notifi_docu_link'.$attachment_number;
          
            $filePath = $tender->$image; // Adjust the attribute name according to your model
            // dd($filePath);
            // Delete the file from the storage
            if (Storage::exists($filePath)) {                
                unlink(Storage::path($filePath));
                // Delete the image record from the database 
                // dd($tender->$image);              
                $tender->$image = null;
                $notification->$notifi_image = null;
      
                if($tender->save() && $notification->save()){
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
    public function changeStatusTender(Request $request)
    {
    	//\Log::info($request->all());
        // dd($request->all());
        // dd($request->id);
        $tender = Tender::find($request->id);
        $status = ($tender->nims_wp_user_status == 1) ? 0: 1; 
        $tender->nims_wp_user_status = $status;
        $tender->save();
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
                'unique:nims_wp_tenders,nims_wp_tender_title',
                'regex:/^[a-zA-Z1-9 ]+$/',
                'min:3',
                'max:50'
            ],
            'number' => [
                'required',
                'numeric',
                'digits:10',
                // 'unique:nims_wp_tenders,nims_wp_tender_number'
            ],
            'start_date' => ['required'],
            'end_date' => ['required',new CheckedSameDate()],
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
        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
        $h3_sd = base64_decode($request->h3);
        $end_date = date('Y-m-d h:i', strtotime(str_replace('/', '-', $request->end_date)));
        $h4_ed = base64_decode($request->h4);

        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', date('d/m/Y'))));
        $entry_date = date('Y-m-d h:i:s A', strtotime(str_replace('/', '-', date('d/m/Y h:i:s A'))));
        $client_ip = $request->ip();
        $user_id = $request->user()->nims_wp_user_id;
        $add_id = rand(10, 10000000);
        $archive = 0;
        $main_num = 0;

        // Handle file uploads
        $uploadedFiles = [];
        $directoryDate = date("Y-m-d");
        $path = 'public/uploads/tenders/' . $directoryDate;

        // Ensure the directory exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
            Log::info('Directory created: ' . $path);
        }

        // Upload main document
        $file = $request->file('main_doc');
        if ($file) {
            $main_doc = $this->uploadAndSanitizeFile($request->number, $path, $file);
            Log::info('Main document uploaded: ' . $main_doc);
        }

       

        // Create a new tender and notification data
        $tenderData = [
            'nims_add_id' => $add_id,
            'nims_maintender' => $main_num,
            'nims_wp_tender_archive' => $archive,
            'nims_wp_tender_title' => $title,
            'nims_wp_tender_number' => $number,
            'nims_wp_tender_description' => $description,
            'nims_wp_tender_start_date' => $start_date,
            'nims_wp_tender_end_date' => $end_date,
            'nims_wp_tender_submit_date' => $publish_date,
            'nims_wp_tender_doc' => $main_doc,
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id
        ];

        $notificationData = [
            'nims_main_id' => $add_id,
            'nims_main' => $main_num,
            'notifi_archive' => $archive,
            'type' => 'tender',
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
            // Save the tender data
            $tender = Tender::create($tenderData);
            Log::info('Tender added: ' . $tender->nims_wp_tender_id);
            $notificationData['type_id'] = $tender->nims_wp_tender_id;
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

    public function getTenderNumber()
    {
        
        $nims_maintender = 1;
        $nims_wp_tender_archive = 0;

        // Perform the query using Eloquent
        $tenders = Tender::where('nims_maintender', $nims_maintender)
                         ->where('nims_wp_tender_archive', $nims_wp_tender_archive)
                         ->where('nims_wp_tender_end_date', '>',  Carbon::now())
                         ->orderBy('nims_wp_tender_number', 'DESC')
                         ->get(['nims_wp_tender_number']);

        return response()->json($tenders);
    }

    public function listArchive(Request $request)
    {
            if ($request->ajax()) {
                $query = Tender::where('nims_wp_tender_archive', 1)
                            ->orWhere('nims_wp_tender_end_date', '<',  Carbon::now())
                    ->select([
                        'nims_wp_tender_id as id',
                        'nims_wp_tender_title as title',
                        'nims_wp_tender_number as number',
                        'nims_wp_tender_submit_date as submit_date',
                        'nims_wp_tender_start_date as start_date',
                        'nims_wp_tender_end_date as end_date'
                    ])
                    // ->orderBy('nims_wp_tender_number', 'ASC')
                    // ->orderBy('nims_wp_tender_id', 'ASC')
                    ->latest('id','ASC');
                    

                return DataTables::eloquent($query)
                    ->filter(function ($query) use ($request) {
                        if ($request->has('search.value')) {
                            $search = $request->input('search.value');
                            $query->where(function ($query) use ($search) {
                                $query->where('nims_wp_tender_title', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_tender_number', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_tender_submit_date', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_tender_start_date', 'like', "%{$search}%")
                                    ->orWhere('nims_wp_tender_end_date', 'like', "%{$search}%");
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
                        $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit editBtn"> <i class="fas fa-edit"></i></a>';
                        return $btn;
                    })
                    ->editColumn('submit_date', function($row){
                        return $row->submit_date ? date('Y-m-d', strtotime(str_replace('/', '-', $row->submit_date))) : '';                   
                    })
                    ->editColumn('start_date', function($row){
                        return $row->start_date ? date('Y-m-d', strtotime(str_replace('/', '-', $row->start_date))) : '';  
                    })
                    ->editColumn('end_date', function($row){
                        return $row->end_date ? date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $row->end_date))) : '';  
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('tenders.list-archive');
    }
}


