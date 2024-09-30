<?php

namespace App\Http\Controllers;

use App\Models\Latest;

use App\Models\Tender;
use App\Models\Admission;
use Illuminate\View\View;
use App\Rules\NoDoubleExt;
use App\Models\Examination;
use App\Models\Recruitment;
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

class LatestController extends Controller
{
    use CommonTrait;
     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)
{

    // dd($request->all());
    if ($request->ajax()) {
        $query = Notification::where('notifi_archive', 0)
        ->where('notifi_end_date', '>', Carbon::now())
        ->select([
                    'notifi_id as id',
                    'notifi_title as title',
                    'notifi_number as number',
                    'notifi_submit_date as submit_date',
                    'notifi_start_date as start_date',
                    'notifi_end_date as end_date'
                ])
        ->orderBy('notifi_number', 'asc')
        ->orderBy('notifi_id', 'asc')
        ->latest('id','asc');
        // dd($query);
//dd($query->toSql());
        return DataTables::eloquent($query)
            ->filter(function ($query) use ($request) {
                if ($request->has('search.value')) {
                    $search = $request->input('search.value');
                    $query->where(function ($query) use ($search) {
                        $query->where('notifi_title', 'like', "%{$search}%")
                            ->orWhere('notifi_number', 'like', "%{$search}%")
                            ->orWhere('notifi_submit_date', 'like', "%{$search}%")
                            ->orWhere('notifi_start_date', 'like', "%{$search}%")
                            ->orWhere('notifi_end_date', 'like', "%{$search}%");
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

    return view('latests.index');
}
    

    public function create()
    {
        // $files = Storage::files('uploads');
        // dd($files);
        return view('tenders.create');
    }


 



  
    public function show($id): View
     {
 
         $tender = Tender::find($id);
 
         return view('tenders.show',compact('tender'));
 
     }

     public function edit($id)
    {
        // dd($id);
        $notification = Notification::find($id);
        $noti_type = $notification->type;
        $noti_type_id = $notification->type_id;
        // dd($noti_type_id);
        
        if(trim($noti_type) == 'tender'){
            $latest =  Tender::find($noti_type_id);
            // dd($latest);
            return response()->json($latest);
        }else if(trim($noti_type) == 'admission'){
            $latest =  Admission::find($noti_type_id);
            return response()->json($latest);
        }else if(trim($noti_type) == 'examination'){
            $latest =  Examination::find($noti_type_id);
            return response()->json($latest);
        }
        else if(trim($noti_type) == 'recruitment'){
            $latest =  Recruitment::find($noti_type_id);
            return response()->json($latest);
        }
  
    }

    public function update(Request $request, $id)
    {
        // dd($id,$request->all());
        $notification = Notification::find($id);
        $noti_type = $notification->type;
        $noti_type_id = $notification->type_id;
        if(trim($noti_type) == 'tender'){
            $latest =  Tender::find($noti_type_id);
        }else if(trim($noti_type) == 'admission'){
            $latest =  Admission::find($noti_type_id);
        }else if(trim($noti_type) == 'examination'){
            $latest =  Examination::find($noti_type_id);
        }
        else if(trim($noti_type) == 'recruitment'){
            $latest =  Recruitment::find($noti_type_id);
        }
        if (!$notification) {
            return redirect()->route('latests.index')->with('error', 'Latest not found.');
        }       

        // Format dates
        date_default_timezone_set('Asia/Kolkata');
        $start_date = $this->convertDateTimeFormateYmd($request->start_date);
        $h3_sd = base64_decode($request->h3);
        $end_date = $this->convertDateTimeFormateYmd_hi($request->end_date);
        $h4_ed = base64_decode($request->h4);


        $publish_date = $this->convertDateTimeFormateYmd($request->publish_date);        

        $entry_date = $this->convertDateTimeFormateYmd_hisA();


        // $add_id = rand(10, 10000000);

        $archive = ($request->archive == 'on') ? 1: 0; 

        $main_num = 1;
        $client_ip = $request->ip();
        $user_id = $request->user()->nims_wp_user_id;

        // dd($client_ip);
        // Define validation rules

        $attributeNames = [           
            'publish_date' => 'Publish Date',
            'start_date' => 'Start date',
            'end_date' => 'End date',           
        ];

        $rules = [            
            'publish_date' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],           
        ];

       

       // Validate the request
       $validator = Validator::make($request->all(), $rules, [], $attributeNames);

       if ($validator->fails()) {
           return response()->json([
               'status' => 'error',
               'errors' => $validator->errors()
           ], 422);
       }


        
       $model = new Latest();  
        if($noti_type == 'tender'){
            $noti_type_col = 'nims_wp_'.$noti_type;
            $main_num_col = 'nims_maintender'; 
            $latest_id = $latest->nims_wp_tender_id;
            $latest_number = $latest->nims_wp_tender_number;
    
        }else{
            $noti_type_col = 'nims_'.$noti_type;
            $main_num_col = 'nims_main';

            $latest_id = $latest->$noti_type_id;
            $latest_number = 'nims_'.$noti_type.'_number';
       
           
        }

        if($noti_type == 'admission'){           
            $table_name = 'nims_wp_'.$noti_type.'s';                 
     
        }else if($noti_type == 'tender' || $noti_type == 'examination' || $noti_type == 'recruitment'){            
            $table_name = 'nims_wp_'.$noti_type;
           

        }else if($noti_type == 'notification'){            
            $table_name = 'nims_'.$noti_type;
           

        }

  
        $latestData = [
            $main_num_col => $main_num, 
            $noti_type_col.'_archive' => $archive,              
            $noti_type_col.'_start_date' => $start_date,
            $noti_type_col.'_end_date' => $end_date,
            $noti_type_col.'_submit_date' => $publish_date,           
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id,
        ];

        $notificationData = [
            'nims_main' => $main_num,
            'notifi_archive' => $archive,
            'type' => $noti_type,           
            'notifi_start_date' => $start_date,
            'notifi_end_date' => $end_date,
            'notifi_submit_date' => $publish_date,            
            'entry_date' => $entry_date,
            'nims_wp_log_ip' => $client_ip,
            'nims_wp_user_id' => $user_id,
        ];

        
       
    //     $na= Notification::find(2031);
    //    dd($notificationData,$na);
        // Use transactions to ensure atomic operations
        DB::beginTransaction();
        try {
            // Update the tender data
            $latest->update($latestData);
            Log::info(''.$noti_type.'updated: ' .$latest_id);
            // dd($tender->type_id);
            // dd($notificationData);
            // Update the notification data
            Notification::where('type_id', $latest_id)->update($notificationData);
            Log::info('Notification updated for '.$noti_type.' ID and : '.$noti_type.' number' .$latest_id. ' and '. $latest_number);

            DB::commit();
            Log::info('Transaction committed successfully');

            // return redirect()->route('tenders.index')->with('success', 'Tender updated successfully!');
            return response()->json([
                'status' => 'success',
                'message' => ucfirst($noti_type).'updated successfully!'
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
            'end_date' => ['required',new CheckedSameDate(Tender::class,'nims_wp_tender_number','nims_wp_tender_end_date','Main Tender & Corrigendum')],
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
        $path = 'public/uploads/tenders/' . $directoryDate;

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

    public function getNumber()
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

            return view('tenders.list-archive');
    }
}
