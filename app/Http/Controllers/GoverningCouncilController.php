<?php

namespace App\Http\Controllers;

use App\Rules\NoDoubleExt;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use App\Models\GoverningCouncil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class GoverningCouncilController extends Controller
{
    use CommonTrait;
    public function editFileUpload(Request $request, $column, $te)
    {
        // dd($column, $te);
        
        $validTables = [ 'research_documents',                         
                       ]; // Add all your valid table names here
        $validColumns = [ 'guideline','general_information','working_manual','crc','crc_form','guideline_course','phd_admission_guideline',
                          'workshop','clinical_research'   
        ]; // Add all your valid column names here                       
     // dd(!in_array($column, $validColumns),!in_array($te, $validTables));
     if (!in_array($column, $validColumns) || !in_array($te, $validTables)) {
        Log::error('Edit Data error: ' . 'Data temporing.');
        return response()->json([
            'status' => 400,
            'errorTamperingValue' => true,
            'redirect' => route('error-page','errorTampering')
        ],400);
        die;
    }
        //    dd($column);
            $te = 'nims_wp_'.$te;
            $column = 'nims_'.$column.'_path';
            $governingCouncil = DB::table($te)->first([$column,'nims_research_id']);
// dd($governingCouncil);
// dd($column,$governingCouncil->$column);
            return response()->json([
                'nims_research_id' => $governingCouncil->nims_research_id,
                $column => $governingCouncil->$column,
            ]);
    }
    public function fileUpload(Request $request)
    {
        // dd($request->all());
        // dd($column, $te);

        $rules = [
            'file_to_upload' => ['required', 'file', 'max:2048', 'mimes:jpg,jpeg,png,pdf', new NoDoubleExt()]       
        ];

         // Define attribute names
         $attributeNames = [
             'file_to_upload' => 'Attachment',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, [], $attributeNames);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 422);
        }
        $nims_research_id = $request->h;  $hr = $request->hr;
        $column = $request->h1; $te = $request->h2;

        $validTables = [ 'research_documents',                         
                       ]; // Add all your valid table names here
        $validColumns = [ 'guideline','general_information','working_manual','crc','crc_form','guideline_course','phd_admission_guideline',
                          'workshop','clinical_research'
        ]; // Add all your valid column names here                       
    //  dd(!in_array($column, $validColumns),!in_array($te, $validTables),!$this->dataTamper($nims_research_id, $hr));
        // dd($request->all());
     if (!in_array($column, $validColumns) || !in_array($te, $validTables) || !$this->dataTamper($nims_research_id, $hr) ) {
        Log::error('Edit Data error: ' . 'Data temporing.');
        return response()->json([
            'status' => 400,
            'errorTamperingValue' => true,
            'redirect' => route('error-page','errorTampering')
        ],400);
        die;
    }

            //    dd($column);
            $te = 'nims_wp_'.$te;
            $column = 'nims_'.$column.'_path';
            
            $directoryDate = date("Y-m-d");
            $path = 'public/uploads/researches/' . $directoryDate;

            // Ensure the directory exists
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                Log::info('Directory created: ' . $path);
            }

            // Upload main document
            $file = $request->file('file_to_upload');
            // dd($request->all());
            if ($file) {
                $file_upload = $this->uploadAndSanitizeFile('research', $path, $file);
                Log::info('Main document uploaded: ' . $file_upload);
            }
            // dd($request->all());
            $fileData=[ $column => $file_upload];
            //   dd($serviceData);
      



        $fileSeclect = DB::table($te)->where('nims_research_id',  $nims_research_id)->first();
        // dd($type);
        if(empty($nims_research_id)){
            $file = DB::table($te)->insert($fileData);
            return response()->json([
                'status' => 'success',
                'message' => 'Added successfully!'
            ]);
        }
        else if(!empty($nims_research_id)){
                    //   dd($serviceData);
                    $file = DB::table($te)->where('nims_research_id', $fileSeclect->nims_research_id)->update($fileData);
            return response()->json([
                'status' => 'success',
                'message' => 'Update successfully!'
            ]);
        }
    }
    public function edit(Request $request, $column, $te)
    {
        // dd($request->all());
        // dd($te,$column);
        $validTables = [ 'aboutus','director','dean','executive_registrar','medical_superintendent'
                         ,'emergency','hospital_services','master_health','academicsection','academic',
                         'academic_1','academic_ap','home','research'
                         
                        ]; // Add all your valid table names here
        $validColumns = [ 'governmentc', 'ex_board', 'finance','acadamiccouncil','committees',
                          'about','office','exdirector','exdean','ex_executive_registrar','exms',
                          'hos_eme','morning_service','in_patient','general_holidays','mobile_numbers','master',
                          'academicsection1','academicsection2','medical_broadspeciality','broadspeciality_dnb',
                          'medical_superspeciality','superspeciality_dnb','medical_pgdiploma','nursing_bsc','nursing_msc',
                          'physiotherapy_bpt','physiotherapy_mpt','hospital_mhm','paramedical_pg','physiotherapy_staff','physiotherapy_activities',
                          'nursing_staff','nursing_activities','AP_nlcp','AP_cidc','AP_cm','AP_ma','AP_rf','AP_pgq','AP_macd','AP_cac','AP_cd',
                          'guest_lecture','library_doctor','library_nursing','annualreports','nims_proceedings','IEC','DSMB','ESGS'
                        ]; // Add all your valid column names here
        // dd(!in_array($column, $validColumns),!in_array($te, $validTables));
        if (!in_array($column, $validColumns) || !in_array($te, $validTables)) {
            Log::error('Edit Data error: ' . 'Data temporing.');
            return response()->json([
                'status' => 400,
                'errorTamperingValue' => true,
                'redirect' => route('error-page','errorTampering')
            ],400);
            die;
        }
//    dd($column);
        $te = 'nims_'.$te;
        if($te == 'nims_hospital_services' && $column == 'morning_service'){
            $governingCouncil = DB::table($te)->first(['morning_service','millennium','miscellaneous','specialityb']);
            // dd($governingCouncil);
            return response()->json([
                $column => $governingCouncil,
            ]);
        }
        $governingCouncil = DB::table($te)->first($column);

        return response()->json([
            $column => $governingCouncil->$column,
        ]);
    }

    public function update(Request $request)
    {
        //    dd($request->all());
        $rules = [
            'description' => [
                'required',               
                'min:1',
                'max:50000'
            ],           
        ];

         // Define attribute names
         $attributeNames = [
            'description' => 'description',           
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, [], $attributeNames);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()
            ], 422);
        }

        $te = $request->h2;
        $validTables = [ 'aboutus','director','dean','executive_registrar','medical_superintendent'
                        ,'emergency','hospital_services','master_health','academicsection','academic',
                        'academic_1','academic_ap','home','research'
                       ]; // Add all your valid table names here

        $validColumns = [ 'governmentc', 'ex_board', 'finance','acadamiccouncil','committees',
                          'about','office','exdirector','exdean','ex_executive_registrar','exms',
                          'hos_eme','morning_service','in_patient','general_holidays','mobile_numbers','master',
                          'academicsection1','academicsection2','medical_broadspeciality','broadspeciality_dnb',
                          'medical_superspeciality','superspeciality_dnb','medical_pgdiploma','nursing_bsc','nursing_msc',
                          'physiotherapy_bpt','physiotherapy_mpt','hospital_mhm','paramedical_pg','physiotherapy_staff','physiotherapy_activities',
                          'nursing_staff','nursing_activities','AP_nlcp','AP_cidc','AP_cm','AP_ma','AP_rf','AP_pgq','AP_macd','AP_cac','AP_cd',            
                          'guest_lecture','library_doctor','library_nursing','annualreports','nims_proceedings','IEC','DSMB','ESGS'
                        ]; // Add all your valid column names here
        $column = $request->h;
        $description = $request->description;
        $h1 = $request->h1;
        // dd($description,$h1);
         // dd(!in_array($column, $validColumns),!in_array($te, $validTables));
        //  dd(!$this->dataTamperDes($description,$h1));
        if (!in_array($column, $validColumns)  || !in_array($te, $validTables) || !$this->dataTamperDes($description,$h1)) {
            Log::error('Store Data error: ' . 'Data temporing.');
            return response()->json([
                'status' => 400,
                'errorTamperingValue' => true,
                'redirect' => route('error-page','errorTampering')
            ],400);
            die;
        }
        

        $description = $request->description;
        $description = $this->sanitizeInput($description);
        $serviceData=[ $column => $description];
            //   dd($serviceData);
        $type = 1; 


        $te = 'nims_'.$te;
        $GoverningCouncil = DB::table($te)->where('type',  $type)->first();
        // dd($type);
        if($type == 0){
            $governingCouncil = DB::table($te)->where('type', $GoverningCouncil->type)->insert($serviceData);
            return response()->json([
                'status' => 'success',
                'message' => 'Added successfully!'
            ]);
        }
        else if($type == 1){
                    //   dd($serviceData);
            $governingCouncil = DB::table($te)->where('type', $GoverningCouncil->type)->update($serviceData);
            return response()->json([
                'status' => 'success',
                'message' => 'Update successfully!'
            ]);
        }
        
    }
}
