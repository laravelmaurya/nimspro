<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\View\View;
use App\Traits\CommonTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Rules\NoDoubleExt;
class TenderController extends Controller
{
    use CommonTrait;
     /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request): View
     {
        //  $tenders = Tender::latest()->paginate(5);
        //  $tenders = Tender:: orderByDesc('nims_wp_tender_id')->paginate(5); // working pagination but searching not all page
         $tenders = Tender:: orderByDesc('nims_wp_tender_id')->get();

         return view('tenders.index',compact('tenders'));
     }

    public function create()
    {
        // $files = Storage::files('uploads');
        // dd($files);
        return view('tenders.create');
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'title' => [
                'required',
                'string',
                'unique:nims_wp_tenders,nims_wp_tender_title',
                'regex:/^[a-zA-Z1-9 ]+$/',
                'min:5',
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
        try {
            $request->validate($rules, [], $attributeNames);
            Log::info('Request validated successfully');
        } catch (\Exception $e) {
            Log::error('Validation failed: ' . $e->getMessage());
            return back()->with('error', 'Validation failed: ' . $e->getMessage());
        }

        // Handle file uploads
        $uploadedFiles = [];
        $directoryDate = date("Y-m-d");
        $path = 'public/uploads/tenders' . $directoryDate;

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

        // Format dates
        $start_date = date('Y-m-d', strtotime(str_replace('/', '-', $request->start_date)));
        $end_date = date('Y-m-d H:i', strtotime(str_replace('/', '-', $request->end_date)));
        $publish_date = date('Y-m-d', strtotime(str_replace('/', '-', date('d/m/Y'))));
        $add_id = rand(10, 10000000);
        $archive = 1;
        $main_num = 1;

        // Sanitize input data
        $title = $this->sanitizeInput($request->title);
        $number = $this->sanitizeInput($request->number);
        $description = $this->sanitizeInput($request->description);

        // Create a new tender and notification data
        $tenderData = [
            'add_id' => $add_id,
            'maintender' => 1,
            'wp_tender_archive' => $archive,
            'wp_tender_title' => $title,
            'wp_tender_number' => $number,
            'wp_tender_description' => $description,
            'wp_tender_start_date' => $start_date,
            'wp_tender_end_date' => $end_date,
            'wp_tender_submit_date' => $publish_date,
            'wp_tender_doc' => $main_doc,
        ];

        $notificationData = [
            'main_id' => $add_id,
            'main' => $main_num,
            'archive' => $archive,
            'type' => 'tender',
            'title' => $title,
            'number' => $number,
            'desc' => $description,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'submit_date' => $publish_date,
            'docu' => $main_doc,
        ];

        // Add attachment paths to the tender data and notification data
        for ($i = 1; $i <= $attachmentCount; $i++) {
            if (isset($uploadedFiles['attachment_' . $i])) {
                $tenderData['wp_tender_link' . $i] = $uploadedFiles['attachment_' . $i];
                $notificationData['docu_link' . $i] = $uploadedFiles['attachment_' . $i];
            }
        }

        // Use transactions to ensure atomic operations
        DB::beginTransaction();
        try {
            // Save the tender data
            $tender = Tender::create($tenderData);
            Log::info('Tender created: ' . $tender->id);

            // Save the notification data
            $notification = Notification::create($notificationData);
            Log::info('Notification created: ' . $notification->id);

            DB::commit();
            Log::info('Transaction committed successfully');

            return redirect()->route('tenders.index')->with('success', 'Tender created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while saving the data: ' . $e->getMessage());
        }
      
       
    }

    private function resizeImage($file, $width, $height)
    {
        // Get the image size
        list($originalWidth, $originalHeight) = getimagesize($file);

        // Create a new true color image
        $newImage = imagecreatetruecolor($width, $height);

        // Load the image
        $source = imagecreatefromstring(file_get_contents($file));

        // Resize the image
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);

        // Save the resized image
        imagejpeg($newImage, $file, 90);

        // Free up memory
        imagedestroy($newImage);
        imagedestroy($source);
    }
    public function show($id): View
     {
 
         $tender = Tender::find($id);
 
         return view('tenders.show',compact('tender'));
 
     }

     public function edit($id)
    {
        $tender = Tender::find($id);        
        return view('tenders.edit', compact('tender'));
    }

    public function update(Request $request, $id)
    {
        $tender = Tender::find($id);
        // dd($request->all());
// dd($tender);
        // Validate the incoming request data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:tenders,email,'.$tender->id,
        //     'roles' => 'required|array',
        //     'roles.*' => 'exists:roles,id',
        // ]);
        
        // Update the tender's basic details
        $tender->update(['nims_employe_code'=> $request->emp_code, ]);

        return redirect()->route('tenders.index')->with('success', 'Tender updated successfully');
        
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


