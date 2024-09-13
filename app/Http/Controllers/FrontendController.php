<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Temporary;
use App\Traits\CommonTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class FrontendController extends Controller
{
    use CommonTrait;
    
    function index(){
        return view("frontend.index");
    }

    public function show($te,$column , $title)
    {
       // dd($request->all());
        // dd($te,$column,$title);
        $validTables = [ 'aboutus','director','dean','executive_registrar','medical_superintendent'
                         ,'emergency','hospital_services','master_health','academicsection','academic',
                         'academic_1','academic_ap','home','research',
                         
                        ]; // Add all your valid table names here
        $validColumns = [ 'governmentc', 'ex_board', 'finance','acadamiccouncil','committees',
                          'about','office','exdirector','exdean','ex_executive_registrar','exms',
                          'hos_eme','morning_service','millennium','miscellaneous','specialityb','in_patient','general_holidays','mobile_numbers','master',
                          'academicsection1','academicsection2','medical_broadspeciality','broadspeciality_dnb',
                          'medical_superspeciality','superspeciality_dnb','medical_pgdiploma','nursing_bsc','nursing_msc',
                          'physiotherapy_bpt','physiotherapy_mpt','hospital_mhm','paramedical_pg','physiotherapy_staff','physiotherapy_activities',
                          'nursing_staff','nursing_activities','AP_nlcp','AP_cidc','AP_cm','AP_ma','AP_rf','AP_pgq','AP_macd','AP_cac','AP_cd',
                          'guest_lecture','library_doctor','library_nursing','annualreports','nims_proceedings','IEC','DSMB','ESGS','evening_service','nurology','cardiology'
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

        
        $column = $this->unsanitizeInput($governingCouncil->$column);
        return view('frontend.dynamic-page', compact('column','title'));
    }

    public function showTab(Request $request)
    {
    //     dd($request->method());
    //    dd($request->all());
       $te  = $request->te;
       $column  = $request->id;
       $column2  = $request->id2;
       $column3  = $request->id3;
       $column4  = $request->id4;
       $title  = $request->title;
       $title2  = $request->title2;
       $title3  = $request->title3;
       $title4  = $request->title4;
        // dd($te,$column,$column2,$column3,$column4,$title,$title2,$title3,$title4);
        $validTables = [ 'aboutus','director','dean','executive_registrar','medical_superintendent'
                         ,'emergency','hospital_services','master_health','academicsection','academic',
                         'academic_1','academic_ap','home','research','test_mst'
                         
                        ]; // Add all your valid table names here
        $validColumns = [ 'governmentc', 'ex_board', 'finance','acadamiccouncil','committees',
                          'about','office','exdirector','exdean','ex_executive_registrar','exms',
                          'hos_eme','morning_service','millennium','miscellaneous','specialityb','in_patient','general_holidays','mobile_numbers','master',
                          'academicsection1','academicsection2','medical_broadspeciality','broadspeciality_dnb',
                          'medical_superspeciality','superspeciality_dnb','medical_pgdiploma','nursing_bsc','nursing_msc',
                          'physiotherapy_bpt','physiotherapy_mpt','hospital_mhm','paramedical_pg','physiotherapy_staff','physiotherapy_activities',
                          'nursing_staff','nursing_activities','AP_nlcp','AP_cidc','AP_cm','AP_ma','AP_rf','AP_pgq','AP_macd','AP_cac','AP_cd',
                          'guest_lecture','library_doctor','library_nursing','annualreports','nims_proceedings','IEC','DSMB','ESGS','evening_service','nurology','cardiology',
                          'all_test',
                        ]; // Add all your valid column names here
        // dd(!in_array($column, $validColumns),!in_array($te, $validTables));
       
        $validTitle = [ 
          'Members of Governing Council','Members of Executive Board','Members of Finance Committee',
          'Members of Academic Council','About Director','Overview','Ex-Director','About Dean','Ex-Deans',
          'About Executive Registrar','Ex-Executive Registrars','About Medical Superintendent','Ex-Medical Superintendents',
          'Emergency Services','Morning Services - Out Patient Department (OPD Block)','Morning Services - Millennium Block'
          ,'Emergency & Physiotherapy Block','Morning Services - Speciality','Evening Special Clinic - Out Patient Department(OPD Block)'
          ,'Evening Special Clinic - Millennium Block','Evening Special Clinic - Specialty Block','In Patient Services','All Tests',
        ];
        if(isset($te) && !empty($te)){
            

            if(isset($column) && !empty($column)){
                $columns = [$column];
                $titles = [$title];
                $arrayMerge = array_merge($columns,$titles);
                // $arrayKeys = array_keys($request->all());
                // dd($arrayKeys->'1',$arrayKeys,$columns,$titles);
                unset($request->_token);
                // $dataUpdate = $request->all();
                $dataUpdate = $request->except('_token');
                //  dd($dataUpdate);
                $dataUpdate = ['te'=>$request->te,'c'=>$request->id,'title'=>$request->title];
                // dd($dataUpdate);
              
            }else if(isset($column) && !empty($column) && isset($column2) && !empty($column2) ){
                $columns = [$column,$column2];
                $titles = [$title,$title2];
                $arrayMerge = array_merge($columns,$titles);
    
                unset($request->_token);
                // $dataUpdate = $request->all();
                $dataUpdate = $request->except('_token');
                //  dd($dataUpdate);
                $dataUpdate = ['te'=>$request->te,'c'=>$request->id,'c2'=>$request->id2,
                                'title'=>$request->title,'title2'=>$request->title2];
                
            }else if(isset($column) && !empty($column) && isset($column2) && !empty($column2) && isset($column3) && !empty($column3)){
                $columns = [$column,$column2,$column3];
                $titles = [$title,$title2,$title3];
                $arrayMerge = array_merge($columns,$titles);
                unset($request->_token);
                // $dataUpdate = $request->all();
                $dataUpdate = $request->except('_token');
                //  dd($dataUpdate);
                $dataUpdate = ['te'=>$request->te,'c'=>$request->id,'c2'=>$request->id2,'c3'=>$request->id3,
                                'title'=>$request->title,'title2'=>$request->title2,'title3'=>$request->title3,];
                
            }
            else if(isset($column) && !empty($column) && isset($column2) && !empty($column2) && isset($column3) && !empty($column3) && isset($column4) && !empty($column4)){
            $columns = [$column,$column2,$column3,$column4];
            $titles = [$title,$title2,$title3,$title4];
            $arrayMerge = array_merge($columns,$titles);
            unset($request->_token);
            // $dataUpdate = $request->all();
            $dataUpdate = $request->except('_token');
            //  dd($dataUpdate);
            $dataUpdate = ['te'=>$request->te,'c'=>$request->id,'c2'=>$request->id2,'c3'=>$request->id3,'c4'=>$request->id4,
                            'title'=>$request->title,'title2'=>$request->title2,'title3'=>$request->title3,'title4'=>$request->title4];
            // dd($dataUpdate);
            
        }
         
       
        $i=1;
        foreach($columns as  $column_single){
        // echo $i.'='.$column_single;
        // $i++;
        if (!in_array($column_single, $validColumns) || !in_array($te, $validTables)) {
            Log::error('Edit Data error: ' . 'Data temporing.');
            return response()->json([
                'status' => 400,
                'errorTamperingValue' => true,
                'redirect' => route('error-page','errorTampering')
            ],400);
            die;
        }
    }
    $updateData =  DB::table('temporaries')->where('id',1)->update($dataUpdate);
    $temporaries='';
 }
 else{
    $temporaries =  DB::table('temporaries')->first();
    // dd($temporaries);
    $te =  $temporaries->te;
    $column =  $temporaries->c;
    $column2 =  $temporaries->c2;
    $column3 =  $temporaries->c3;
    $column4 =  $temporaries->c4;
    $column5 =  $temporaries->c5;
    
    $title =  $temporaries->title;
    $title2 =  $temporaries->title2;
    $title3 =  $temporaries->title3;
    $title4 =  $temporaries->title4;
 }

    $te = 'nims_'.$te;
    if(isset($column) && !empty($column)){
        $columnData =  DB::table($te)->first($column);
        $columnTabs =  $this->unsanitizeInput($columnData->$column);
        $columns = [$column];
        $titles = [$title];
        $columnTabsPass = ['columnTabs'];
        $titles = ['title'];
    }else if(isset($column) && !empty($column) && isset($column2) && !empty($column2) ){
        $columnData =  DB::table($te)->first($column);
        $columnData2 = DB::table($te)->first($column2);
        $columnTabs =  $this->unsanitizeInput($columnData->$column);
        $columnTabs2 = $this->unsanitizeInput($columnData2->$column2);
        $columnTabsPass = ['columnTabs','columnTabs2'];
        $titles = ['title','title2'];
    }else if(isset($column) && !empty($column) && isset($column2) && !empty($column2) && isset($column3) && !empty($column3) ){
        $columnData =  DB::table($te)->first($column);        
        $columnData2 = DB::table($te)->first($column2);
        $columnData3 = DB::table($te)->first($column3);
        $columnTabs =  $this->unsanitizeInput($columnData->$column);
        $columnTabs2 = $this->unsanitizeInput($columnData2->$column2);
        $columnTabs3 = $this->unsanitizeInput($columnData3->$column3);
        $columnTabsPass = ['columnTabs','columnTabs2','columnTabs3'];
        $titles = ['title','title2','title3'];
    }else if(isset($column) && !empty($column) && isset($column2) && !empty($column2) && isset($column3) && !empty($column3) && isset($column4) && !empty($column4)){
            $columnData =  DB::table($te)->first($column);
            $columnData2 = DB::table($te)->first($column2);
            $columnData3 = DB::table($te)->first($column3);
            $columnData4 = DB::table($te)->first($column4);
            $columnTabs =  $this->unsanitizeInput($columnData->$column);
            $columnTabs2 = $this->unsanitizeInput($columnData2->$column2);
            $columnTabs3 = $this->unsanitizeInput($columnData3->$column3);
            $columnTabs4 = $this->unsanitizeInput($columnData4->$column4);
            $columnTabsPass = ['columnTabs','columnTabs2','columnTabs3','columnTabs4'];
            $titles = ['title','title2','title3','title4'];
        }
    

        return view('frontend.dynamic-tab-page', compact($columnTabsPass,$titles));
    }
 
    
    public function downloadImage($te,$column,$val,$column2){

        // dd('te ='.$te,'column ='.$column);

        $validTables = [ 
            'research_documents',
        ]; // Add all your valid table names here

        $validColumns = [ 
            'research_id',
        ]; // Add all your valid column names here

        $validVal = [ 
            1,3
        ]; // Add all your valid value names here

        $validColumns2 = [ 
            'act',
        ]; // Add all your valid value names here

        // dd(!in_array($column, $validColumns),!in_array($te, $validTables));
        if (!in_array($column, $validColumns) || !in_array($te, $validTables) || !in_array($val, $validVal) || !in_array($column2, $validColumns2)) {
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
        $column = 'nims_'.$column;
        $column2 = 'nims_'.$column2;
    
        $governingCouncil = DB::table($te)->where([$column => $val])->first([$column,$column2]);
        // dd($governingCouncil->$column2);
        return response()->json([
            $column => $governingCouncil->$column2,
            ]);
// $column = $this->unsanitizeInput($governingCouncil->$column);
// return view('frontend.dynamic-page', compact('column','title'));
    }
    public function allTests(Request $request)
    {
       // dd($request->all());
        if ($request->ajax()) {
            $query = DB::connection('pgsql')->table('ahiscl.hivt_laboratory_test_mst as lt')
                ->select([
                    DB::raw('(select gstr_dept_name from ahiscl.gblt_department_mst where gnum_dept_code = 
                              (select gnum_dept_code from ahiscl.hivt_laboratory_mst where gnum_lab_code = lt.gnum_labcode 
                               and gnum_hospital_code = 33101 and gnum_isvalid = 1) 
                               and gnum_hospital_code = 33101 and gnum_isvalid = 1) as dept_name'),
                    DB::raw('(select gstr_lab_name from ahiscl.hivt_laboratory_mst where gnum_lab_code = lt.gnum_labcode 
                              and gnum_hospital_code = 33101 and gnum_isvalid = 1) as lab_name'),
                    'lt.gnum_user_test_code',
                    DB::raw('(select gstr_test_name from ahiscl.hivt_test_mst where gnum_test_code = lt.gnum_test_code) as test_name')
                ])
                ->where('lt.gnum_hospital_code', 33101)
                ->where('lt.gnum_isvalid', 1);
        
            // Apply search filter if search value is provided
            if ($request->has('search.value')) {
                $search = $request->input('search.value');
                $query->where(function($q) use ($search) {
                    $q->where(DB::raw('(select gstr_dept_name from ahiscl.gblt_department_mst where gnum_dept_code = 
                                       (select gnum_dept_code from ahiscl.hivt_laboratory_mst where gnum_lab_code = lt.gnum_labcode 
                                       and gnum_hospital_code = 33101 and gnum_isvalid = 1) 
                                       and gnum_hospital_code = 33101 and gnum_isvalid = 1)'), 'ILIKE', "%{$search}%")
                      ->orWhere(DB::raw('(select gstr_lab_name from ahiscl.hivt_laboratory_mst where gnum_lab_code = lt.gnum_labcode 
                                       and gnum_hospital_code = 33101 and gnum_isvalid = 1)'), 'ILIKE', "%{$search}%")
                      ->orWhere(DB::raw('(select gstr_test_name from ahiscl.hivt_test_mst where gnum_test_code = lt.gnum_test_code)'), 'ILIKE', "%{$search}%")
                      ->orWhere('lt.gnum_user_test_code', 'ILIKE', "%{$search}%");
                });
            }
        
            // Execute the query and return the results to DataTables
            $queryResult = $query->get();
        
            return DataTables::of($queryResult)
                ->addIndexColumn() // Adds DT_RowIndex
                ->editColumn('dept_name', function($row) {
                    return Str::limit($row->dept_name, 30);
                })
                ->editColumn('lab_name', function($row) {
                    return Str::limit($row->lab_name, 20);
                })
                ->editColumn('test_name', function($row) {
                    return Str::limit($row->test_name, 20);
                })
                ->editColumn('test_code', function($row) {
                    return Str::limit($row->gnum_user_test_code, 20);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'All Tests';
        return view('frontend.all-test', compact('title'));
    }
    
    public function depwTestView(Request $request)
    {
        // dd($request->all());
        $department = (int)$request->input('department');
        $hospitalCode = 33101;
        $gnum_isvalid = 1;
    
        $query = DB::connection('pgsql')->table('ahiscl.hivt_laboratory_test_mst as lt')
            ->select([
                DB::raw("(select gstr_lab_name from ahiscl.hivt_laboratory_mst where gnum_lab_code = lt.gnum_labcode and gnum_hospital_code = $hospitalCode and gnum_isvalid = $gnum_isvalid) as lab_name"),
                'lt.gnum_user_test_code',
                DB::raw("(select gstr_test_name from ahiscl.hivt_test_mst where gnum_test_code = lt.gnum_test_code) as test_name")
            ])
            ->where('lt.gnum_hospital_code', $hospitalCode)
            ->where('lt.gnum_isvalid', $gnum_isvalid)
            ->whereIn('lt.gnum_labcode', function($query) use ($department, $hospitalCode, $gnum_isvalid) {
                $query->select('gnum_lab_code')
                      ->from('ahiscl.hivt_laboratory_mst')
                      ->where('gnum_dept_code', $department)
                      ->where('gnum_hospital_code', $hospitalCode)
                      ->where('gnum_isvalid', $gnum_isvalid);
            })
            ->orderByRaw('1, 2');
            // dd($query);
        if ($request->ajax()) {
            return DataTables::of($query)
                ->filter(function ($query) use ($request) {
                    if ($request->has('search.value')) {
                        $search = strtolower($request->input('search.value'));
                        $query->where(function ($query) use ($search) {
                            $query->whereRaw("LOWER((select gstr_lab_name from ahiscl.hivt_laboratory_mst where gnum_lab_code = lt.gnum_labcode and gnum_hospital_code = 33101 and gnum_isvalid = 1)) like ?", ["%{$search}%"])
                                  ->orWhere('lt.gnum_user_test_code', 'like', "%{$search}%")
                                  ->orWhereRaw("LOWER((select gstr_test_name from ahiscl.hivt_test_mst where gnum_test_code = lt.gnum_test_code)) like ?", ["%{$search}%"]);
                        });
                    }
                })
                ->editColumn('lab_name', function($row) {
                    return Str::limit($row->lab_name, 30);
                })
                ->editColumn('test_name', function($row) {
                    return Str::limit($row->test_name, 20);
                })
                ->editColumn('gnum_user_test_code', function($row) {
                    return Str::limit($row->gnum_user_test_code, 20);
                })
                ->rawColumns(['lab_name', 'test_name', 'gnum_user_test_code'])
                ->make(true);
        }
    
        $title = 'Department wise tests';
     
        $departments = DB::connection('pgsql')->table('ahiscl.gblt_department_mst')
            ->select('gnum_dept_code', 'gstr_dept_name')
            ->whereIn('gnum_dept_code', function($query) use ($hospitalCode, $gnum_isvalid) {
                $query->select('gnum_dept_code')
                      ->from('ahiscl.hivt_laboratory_mst')
                      ->where('gnum_hospital_code', $hospitalCode)
                      ->where('gnum_isvalid', $gnum_isvalid);
            })
            ->where('gnum_hospital_code', $hospitalCode)
            ->where('gnum_isvalid', $gnum_isvalid)
            ->orderBy('gstr_dept_name')
            ->get();
            // dd($departments);
        return view('frontend.depw-test-view', compact('title', 'departments'));
    }

    public function hsInternalPhoneNo(Request $request)
    {
        $title = 'Internal Extension No.';
        return view('frontend.hs-internal-phone-numbers', compact('title'));
    }
    public function patientView(Request $request)
    {
        $title = "Today's Patient Statistics.";
        // Use DB facade to execute raw SQL query in Laravel
        $resultdep = DB::connection('pgsql')->table('ahiscl.hrgt_episode_dtl as ep')
        ->selectRaw("
            SUM(CASE WHEN ep.hrgnum_visit_type = 1 AND ep.hblnum_tariff_id IN (1010001,1010006,1010012) THEN 1 ELSE 0 END) AS New_OPD,
            SUM(CASE WHEN ep.hrgnum_visit_type = 1 AND ep.hblnum_tariff_id = 1010005 THEN 1 ELSE 0 END) AS Revisit_OPD,
            SUM(CASE WHEN ep.hrgnum_visit_type = 1 AND ep.hblnum_tariff_id = 1010007 THEN 1 ELSE 0 END) AS Repaid_OPD,
            SUM(CASE WHEN ep.hrgnum_visit_type = 3 AND ep.hblnum_tariff_id IN (1010004, 1010008) THEN 1 ELSE 0 END) AS New_EMD,
            SUM(CASE WHEN ep.hrgnum_visit_type = 3 AND ep.hblnum_tariff_id = 1010005 THEN 1 ELSE 0 END) AS Revisit_EMD,
            SUM(CASE WHEN ep.hrgnum_visit_type = 3 AND ep.hblnum_tariff_id = 1010007 THEN 1 ELSE 0 END) AS Repaid_EMD,
            SUM(CASE WHEN ep.hrgnum_visit_type = 4 AND ep.hblnum_tariff_id IN (1010003, 1010009, 1010013) THEN 1 ELSE 0 END) AS New_Special,
            SUM(CASE WHEN ep.hrgnum_visit_type = 4 AND ep.hblnum_tariff_id = 1010005 THEN 1 ELSE 0 END) AS Revisit_Special,
            SUM(CASE WHEN ep.hrgnum_visit_type = 4 AND ep.hblnum_tariff_id = 1010011 THEN 1 ELSE 0 END) AS Repaid_Special
        ")
        ->where('ep.gnum_hospital_code', 33101)
        ->whereRaw("trunc(ep.gdt_entry_date) = CURRENT_DATE")
        ->where('ep.gnum_isvalid', 1)
        ->first(); // Use first() if you expect a single row of results


        return view('frontend.patient-view', compact('title','resultdep'));
    }
    public function clickpaths(Request $request)
    {
        $title = 'Click Path Manuals';
        return view('frontend.click-paths',compact('title'));
    }

    public function mciListBs()
    {
        $spect = "broad speciality";

        // Get the speciality ID
        $speciality = DB::table('academic_speciality')
            ->where('Specialitytype', $spect)
            ->first();
        
        if (!$speciality) {
            return redirect('error_page')->withErrors('Speciality not found');
        }
        
        // Get the current year data
        $current_year1 = date('Y');
        $current_year2 = date('y');
        $current_year = ($current_year1 - 1) . '-' . $current_year2;
        
        $academic_year = DB::table('academic_year')
            ->where('year', $current_year)
            ->first();
        
        // if (!$academic_year) {
        //     return redirect('error_page')->withErrors('Academic year not found');
        // }
        
        // Fetch course data for the speciality
        $courses = DB::table('academic_mci')
            ->where('speciality', $speciality->Id)
            ->get();
        
        // Process and get course and department data
        foreach ($courses as $course) {
            $course->course_name = DB::table('academic_coursetype')->where('id', $course->coursetype)->value('coursetype');
            $course->department_name = DB::table('academic_department')->where('id', $course->departmentname)->value('departmentname');
        }
        
        // Calculate the total number of seats
        $total_seats = $courses->sum('no_of_seats');
        $title = 'Broad Speciality Courses';
        return view('frontend.mci-list-bs', compact('title','courses', 'total_seats', 'academic_year'));
    }


    public function mciListSs()
    {

            $specialityType = 'super speciality';
            $currentYear = date('Y') . '-' . (date('y') + 1);

            // Fetch speciality and year using DB::table
            $speciality = DB::table('academic_speciality')
                            ->where('Specialitytype', $specialityType)
                            ->first();
            // dd($speciality);
            $year = DB::table('academic_year')
                    ->where('year', $currentYear)
                    ->first();

            // Fetch courses and join with course types and department names
            $courses = DB::table('academic_mci as mci')
                        ->join('academic_coursetype as ct', 'mci.coursetype', '=', 'ct.id')
                        ->join('academic_department as dept', 'mci.departmentname', '=', 'dept.id')
                        ->where('mci.speciality', $speciality->Id)
                        ->select('mci.no_of_seats', 'ct.coursetype', 'dept.departmentname')
                        ->get();
            $title = 'Super Speciality Courses';
            return view('frontend.mci-list-ss', compact('title','courses','speciality','year'));
    }

    public function mciCountStudents()
    {
        // Query for gender 'F'
        $femaleCount = DB::table('academic_student_details')
            ->where('gender', 'F')
            ->count();

        // Get current year and previous year
        $currentYear1 = date('Y');
        $currentYear2 = date('y');
        $currentYear = $currentYear1 . '-' . $currentYear2;

        // Get the academic year
        $academicYear = DB::table('academic_year')
            ->where('year', $currentYear)
            ->first();

        // Check if academic year exists
        if ($academicYear) {
            $academicYearId = $academicYear->Id;
        } else {
            $academicYearId = null;
        }

        // Query for course types and count of students
        $courseTypes = DB::table('academic_student_details')
            ->join('academic_coursetype', 'academic_student_details.Course_Type', '=', 'academic_coursetype.Id')
            ->select('academic_coursetype.coursetype', DB::raw('COUNT(academic_student_details.Id) as student_count'))
            ->groupBy('academic_coursetype.coursetype')
            ->get();

        // Query for speciality types
        $specialityTypes = DB::table('academic_speciality')->get();

        // Query for department names and student count
        $courseNames = DB::table('academic_student_details')
            ->join('academic_department', 'academic_student_details.Course_department', '=', 'academic_department.Id')
            ->select('academic_department.departmentname', DB::raw('COUNT(academic_student_details.Id) as student_count'))
            ->groupBy('academic_department.departmentname')
            ->get();

        // Queries for student subcategories
        $subCategories = [
            'general' => DB::table('academic_student_details')->where('Sub_Category', 'general')->where('academic_year', $academicYearId)->count(),
            'sc' => DB::table('academic_student_details')->where('Sub_Category', 'sc')->where('academic_year', $academicYearId)->count(),
            'st' => DB::table('academic_student_details')->where('Sub_Category', 'st')->where('academic_year', $academicYearId)->count(),
            'obc' => DB::table('academic_student_details')->where('Sub_Category', 'obc')->where('academic_year', $academicYearId)->count(),
            'others' => DB::table('academic_student_details')->where('Sub_Category', 'others')->where('academic_year', $academicYearId)->count()
        ];

        // Physically handicapped count
        $phcCount = [
            'yes' => DB::table('academic_student_details')->where('Physically_handicapped', '1')->where('academic_year', $academicYearId)->count(),
            'no' => DB::table('academic_student_details')->where('Physically_handicapped', '0')->where('academic_year', $academicYearId)->count()
        ];

        // Gender count
        $genderCount = [
            'M' => DB::table('academic_student_details')->where('gender', 'M')->where('academic_year', $academicYearId)->count(),
            'F' => DB::table('academic_student_details')->where('gender', 'F')->where('academic_year', $academicYearId)->count()
        ];
        $title = 'Post Graduate Student Summary';
        // Pass all data to the view
        return view('frontend.mci-count-students', compact(
            'title',
            'femaleCount',
            'currentYear' ,
            'courseTypes' ,
            'specialityTypes' ,
            'courseNames',
            'subCategories',
            'phcCount' ,
            'genderCount'));
  }
 }



