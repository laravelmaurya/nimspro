<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\View\View;
use App\Rules\NoDoubleExt;
use App\Traits\CommonTrait;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $query = Tender::where('nims_wp_tender_archive', 0);
      
    
        // $query = Tender::where('nims_wp_tender_archive', 0)
        //                ->where('nims_wp_tender_end_date', '>=', now());
    
        if ($request->ajax()) {
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nims_wp_tender_title', 'like', '%' . $search . '%')
                      ->orWhere('nims_wp_tender_number', 'like', '%' . $search . '%')
                      ->orWhere('nims_wp_tender_submit_date', 'like', '%' . $search . '%')
                      ->orWhere('nims_wp_tender_start_date', 'like', '%' . $search . '%')
                      ->orWhere('nims_wp_tender_end_date', 'like', '%' . $search . '%');
    
                });
            }
    
            $tenders = $query->latest('nims_wp_tender_id')->paginate(5);
    
            $tenders->getCollection()->transform(function ($tender) {
                $tender->nims_wp_tender_title = Str::limit($tender->nims_wp_tender_title, 50);
                $tender->nims_wp_tender_number = Str::limit($tender->nims_wp_tender_number, 50);
                return $tender;
            });
    
            return response()->json([
                'data' => view('tenders.tender_table', compact('tenders'))->render(),
                'links' => (string) $tenders->links()
            ]);
        }
    
        $tenders = $query->latest('nims_wp_tender_id')->paginate(5);
    
        $tenders->getCollection()->transform(function ($tender) {
            $tender->nims_wp_tender_title = Str::limit($tender->nims_wp_tender_title, 50);
            $tender->nims_wp_tender_number = Str::limit($tender->nims_wp_tender_number, 50);
            return $tender;
        });
    
        return view('tenders.index', compact('tenders'));
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
    
        // Sanitize input data
        $title = $this->sanitizeInput($request->title);
        $h1_title = $request->h1;
        $number = $this->sanitizeInput($request->number);
        $h2_number = $request->h2;

        // description value sanitizeInput for both and hidden field decode before snitize
        $description = $request->description;
        $h3_des = $request->h3;

        // echo $description;
        // echo'<br>'. $h3_des;

        // // echo'<br>'. base64_decode($h3_des);
   
        // echo 'title='.$this->dataTamper($title,$h1_title);
        // echo 'number='.$this->dataTamper($number,$h2_number);
        // echo 'compare resulte='.$this->dataTamperDes($description,$h3_des);


        if(!$this->dataTamper($title,$h1_title) || !$this->dataTamper($number,$h2_number) || !$this->dataTamperDes($description,$h3_des) ){            
            return redirect()->route('error-page') ->with('errorTampering',true);;
        }
    
// dd('tttttttttttttttt');
        // Format dates
        date_default_timezone_set('Asia/Kolkata'); 
        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
        $h3_sd = base64_decode($request->h3);
        $end_date = date('Y-m-d h:i', strtotime(str_replace('/', '-', $request->end_date)));                
        $h4_ed = base64_decode($request->h4);

        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', date('d/m/Y'))));
        $entry_date = date('Y-m-d h:i:s A', strtotime(str_replace('/', '-', date('d/m/Y h:i:s A'))));

        $add_id = rand(10, 10000000);
        $archive = 1;
        $main_num = 1;


   
         // Define validation rules
         $rules = [
            'title' => [
                'required',
                'string',
                'unique:nims_wp_tenders,nims_wp_tender_title',
                'regex:/^[a-zA-Z1-9 ]+$/',
                'min:3',
                'max:255'
            ],
            'number' => [
                'required',
                'numeric',
                'digits:5',
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
        
            $request->validate($rules, [], $attributeNames);
            Log::info('Request validated successfully');
        
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
            'nims_add_id'=> $add_id,
            'nims_maintender' => $main_num, 
            'nims_wp_tender_archive' => $archive,  
            'nims_wp_tender_title' =>  $title,            
            'nims_wp_tender_number' => $number ,            
            'nims_wp_tender_description' => $description,            
            'nims_wp_tender_start_date' =>$start_date,            
            'nims_wp_tender_end_date' => $end_date,            
            'nims_wp_tender_submit_date' => $publish_date,                                             
            'nims_wp_tender_doc' => $main_doc,
            'entry_date' => $entry_date, 
        ];

        $notificationData = [
            'nims_main_id'=> $add_id,
            'nims_main' => $main_num, 
            'notifi_archive' => $archive,  
            'type' => 'tender',            
            'notifi_title' =>  $title,            
            'notifi_number' => $number ,            
            'notifi_desc' => $description,            
            'notifi_start_date' =>$start_date,            
            'notifi_end_date' => $end_date,            
            'notifi_submit_date' => $publish_date,                                             
            'notifi_docu' => $main_doc,
            'entry_date' => $entry_date,
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
            Log::info('Tender created: ' . $tender->nims_wp_tender_id);

            // Save the notification data
            $notification = Notification::create($notificationData);
            Log::info('Notification created: ' . $notification->notifi_id);

            DB::commit();
            Log::info('Transaction committed successfully');

            return redirect()->route('tenders.index')->with('success', 'Tender created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while saving the data: ' . $e->getMessage());
        }
    }

  
    public function show($id): View
     {
 
         $tender = Tender::find($id);
 
         return view('tenders.show',compact('tender'));
 
     }

     public function edit($id)
    {
        $tender = Tender::find($id);  
        // dd($tender);      
        return view('tenders.edit', compact('tender'));
    }

    public function update(Request $request, $id)
    {
        // dd($id,$request->all());
        $tender = Tender::find($id);

        if (!$tender) {
            return redirect()->route('tenders.index')->with('error', 'Tender not found.');
        }

        // Sanitize input data
        $title = $this->sanitizeInput($request->title);
        $h1_title = $request->h1;
        $number = $this->sanitizeInput($request->number);
        $h2_number = $request->h2;

        // description value sanitizeInput for both and hidden field decode before sanitize
        $description = $request->description;
        $h3_des = $request->h3;
        

        if (!$this->dataTamper($title, $h1_title) || !$this->dataTamper($number, $h2_number) || !$this->dataTamperDes($description, $h3_des)) {
            return redirect()->route('error-page')->with('errorTampering', true);
        }
       

        // Format dates
        date_default_timezone_set('Asia/Kolkata');
        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
        $h3_sd = base64_decode($request->h3);
        $end_date = date('Y-m-d h:i', strtotime(str_replace('/', '-', $request->end_date)));
        $h4_ed = base64_decode($request->h4);


        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->publish_date)));        

        $entry_date = date('Y-m-d h:i:s A', strtotime(str_replace('/', '-', date('d/m/Y h:i:s A'))));


        $archive = ($request->archive == 'on') ? 1: 0; 

        $main_num = 1;

        // Define validation rules
        $rules = [
            'title' => [
                'required',
                'string',
                'unique:nims_wp_tenders,nims_wp_tender_title,' . $id .  ',nims_wp_tender_id',
                'regex:/^[a-zA-Z1-9 ]+$/',
                'min:3',
                'max:255'
            ],
            'number' => [
                'required',
                'numeric',
                'digits:5',
                'unique:nims_wp_tenders,nims_wp_tender_number,' . $id .  ',nims_wp_tender_id'
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
        $request->validate($rules, [], $attributeNames);
        Log::info('Request validated successfully');

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
                $uploadedFiles[$fileKey] = $this->uploadAndSanitizeFile($request->number, $path, $file);
                Log::info('Attachment ' . $i . ' uploaded: ' . $uploadedFiles[$fileKey]);
            }
        }

        // Prepare the updated tender and notification data
        $tenderData = [
            'nims_wp_tender_title' => $title,
            'nims_wp_tender_number' => $number,
            'nims_wp_tender_description' => $description,
            'nims_wp_tender_start_date' => $start_date,
            'nims_wp_tender_end_date' => $end_date,
            'nims_wp_tender_submit_date' => $publish_date,
            'nims_wp_tender_doc' => $main_doc,
            'entry_date' => $entry_date,
        ];

        $notificationData = [
            'nims_main_id' => $tender->nims_add_id,
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
            // Update the tender data
            $tender->update($tenderData);
            Log::info('Tender updated: ' . $tender->nims_wp_tender_id);

            // Update the notification data
            Notification::where('nims_main_id', $tender->nims_add_id)->update($notificationData);
            Log::info('Notification updated for tender ID: ' . $tender->nims_add_id);

            DB::commit();
            Log::info('Transaction committed successfully');

            return redirect()->route('tenders.index')->with('success', 'Tender updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while updating the data: ' . $e->getMessage());
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
                return response()->json(['success' => 'Image deleted successfully.']);
            }            
            return response()->json(['error' => 'Image is not deleted.']);
        }        
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
}


