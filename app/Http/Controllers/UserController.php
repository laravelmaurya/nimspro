<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    use CommonTrait;
   /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request)
     {
        $this->authorize('view-page', 'user-list');
         if ($request->ajax()) {
             // Fetch users with their roles using eager loading
             $data = User::with('roles');
            //  dd($data);

             return Datatables::of($data)               
                 ->addIndexColumn()
                 ->addColumn('status', function ($row) {
                     $checked = $row->nims_wp_user_status ? 'checked' : '';
                     return '<input data-id="'. $row->nims_wp_user_id . '" class="toggle-class" type="checkbox" data-onstyle="success"
                         data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active"
                         data-off="InActive" ' . $checked . '>';
                 })
                 ->editColumn('nims_employe_code', function($row) {
                    return Str::limit($row->nims_employe_code, 20);
                })
                 ->editColumn('nims_wp_user_name', function($row) {
                    return Str::limit($row->nims_wp_user_name, 30);
                })
                ->editColumn('nims_wp_user_email', function($row) {
                    return Str::limit($row->nims_wp_user_email, 20);
                })
                ->editColumn('e_email', function($row) {
                    return Str::limit($row->e_email, 20);
                })
                ->editColumn('nims_employe_mob_no', function($row) {
                    return Str::limit($row->nims_employe_mob_no, 20);
                })               
                // ->addColumn('nims_wp_department_name', function ($row) {
                //     $department = Department::where(['nims_wp_department_id'=>$row->nims_wp_department_name])->first('nims_wp_department_name');
                //     $department_name = (!empty($department)) ? Str::limit($department->nims_wp_department_name, 20) : '';                
                //     return $department_name;           
                // })
                 ->addColumn('role', function ($row) {
                     $roles = '';
                     foreach ($row->roles as $role) {
                         $roles .= '<h4 class="ml-1 d-inline"><span class="badge bg-info">' . Str::limit($role->name, 30) . '</span></h4>';
                     }
                     return $roles;
                 })
                 ->addColumn('action', function ($row) {
                    //  return '
                    //      <a href="javascript:void(0)" data-id="' . $row->nims_wp_user_id . '" class="edit-btn"><i class="fas fa-edit"></i></a>';
                         $editPermission = auth()->user()->can('view-page', 'user-edit');

                        $buttons = '';

                        if ($editPermission) {
                            $buttons .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn"> <i class="fas fa-edit"></i></a>';
                        }

                        return $buttons;
                 })
                 ->filter(function ($query) use ($request) {
                     if ($request->has('search.value')) {
                         $searchTerm = $request->input('search.value');
                         $query->where('nims_wp_user_name', 'like', "%{$searchTerm}%")
                             ->orWhere('nims_employe_code', 'like', "%{$searchTerm}%")
                             ->orWhere('nims_wp_user_email', 'like', "%{$searchTerm}%")
                             ->orWhere('e_email', 'like', "%{$searchTerm}%")
                             ->orWhere('nims_employe_mob_no', 'like', "%{$searchTerm}%")                                          
                             ->orWhere('nims_wp_user_created_on', 'like', "%{$searchTerm}%")
                             ->orWhereHas('roles', function ($q) use ($searchTerm) {
                                 $q->where('name', 'like', "%{$searchTerm}%");
                             });
                     }
                 })
                 ->rawColumns(['status', 'role', 'action'])
                 ->make(true);
         }
     
         $roles = Role::all();
         $departments = Department::all();
        //  dd($users);
         return view('users.index', compact('roles', 'departments'));
     }
     


    // public function create()
    // {
    //     $roles = Role::all();
    //     $departments = Department::all();
    //     // dd($departments);
    //     return view('users.create',compact('roles','departments'));
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        // Define validation rules
    // Define validation rules
    $rules = [
        'emp_code' => [
            'required',
            'string',
            'min:10',  // Minimum length 3 characters
            'max:30', // Maximum length 30 characters
            'unique:nims_wp_user_login,nims_employe_code',
            'regex:/^[A-Za-z0-9]+$/',  // Only letters and numbers allowed (no special characters)
        ],
        'employe_surname' => [
            'required',
            'string',
            'min:3',  // Minimum length 3 characters
            'max:30', // Maximum length 30 characters
            'regex:/^[A-Za-z\s]+$/', // Only letters and spaces allowed
        ],
        'user_last_name' => [
            'required',
            'string',
            'min:3',  // Minimum length 3 characters
            'max:30', // Maximum length 30 characters
            'regex:/^[A-Za-z\s]+$/', // Only letters and spaces allowed
        ],
        'user_email' => [
            'required',
            'email',  // Email validation
            'unique:nims_wp_user_login,nims_wp_user_email',
        ],
        'personal_email' => [
            'required',
            'email',  // Email validation
            'unique:nims_wp_user_login,e_email',
        ],
        'user_mobile_no' => [
            'required',
            'digits:10',  // Exactly 10 digits
        ],
        'dep_name' => [
            'required',  // Required field
            'exists:nims_wp_department,nims_wp_department_id',  // Ensure selected department exists
        ],
        'roles' => [
            'required',  // Ensure at least one role is selected
            'array',
            'min:1',
        ],
        'roles.*' => [
            'exists:roles,id',  // Ensure each selected role exists
        ],
    ];

    // Define validation messages
    $messages = [
        'emp_code.required' => 'Please enter an Employee Code.',
        'emp_code.min' => 'Employee Code must be at least 3 characters long.',
        'emp_code.max' => 'Employee Code cannot exceed 30 characters.',
        'emp_code.regex' => 'Employee Code cannot contain special characters.',

        'employe_surname.required' => 'First name is required.',
        'employe_surname.min' => 'First name must be at least 3 characters long.',
        'employe_surname.max' => 'First name cannot exceed 30 characters.',
        'employe_surname.regex' => 'First name can only contain letters and spaces.',

        'user_last_name.required' => 'Last name is required.',
        'user_last_name.min' => 'Last name must be at least 3 characters long.',
        'user_last_name.max' => 'Last name cannot exceed 30 characters.',
        'user_last_name.regex' => 'Last name can only contain letters and spaces.',

        'user_email.required' => 'Please enter an email address.',
        'user_email.email' => 'Please enter a valid email address.',

        'personal_email.required' => 'Please enter a personal email address.',
        'personal_email.email' => 'Please enter a valid personal email address.',

        'user_mobile_no.required' => 'Please enter your mobile number.',
        'user_mobile_no.digits' => 'Mobile number must be exactly 10 digits.',

        'dep_name.required' => 'Please select a department.',
        'dep_name.exists' => 'The selected department is invalid.',

        'roles.required' => 'Please select at least one role.',
        'roles.exists' => 'The selected role is invalid.',
    ];

        // Create the validator
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }


        $employe_surname = $this->sanitizeInput($request->employe_surname);
        $h2_employe_surname = $request->h2;

        $user_last_name = $this->sanitizeInput($request->user_last_name);
        $h3_user_last_name = $request->h3;

        $emp_code = $this->sanitizeInput($request->emp_code);
        $h1_emp_code = $request->h1;

        $user_email = $this->sanitizeInput($request->user_email);
        $h4_user_email = $request->h4;

        $personal_email = $this->sanitizeInput($request->personal_email);
        $h5_personal_email = $request->h5;

        $user_mobile_no = $this->sanitizeInput($request->user_mobile_no);
        $h6_user_mobile_no = $request->h6;

        $dep_name = $this->sanitizeInput($request->dep_name);
        $h7_dep_name = $request->h7;

        $roles =   json_encode($request->roles);
        $salt = 'asldkjdslakjdsaldjsourrekjhkfhds';
        $password = 'Test@123#';
        $userpassword_insert = hash('sha256', $password . $salt); 
        $logged_in_user = '_'.auth()->user()->roles()->first()->name;
        date_default_timezone_set('Asia/Kolkata');  
        $create_date = $this->convertDateTimeSec(date('d/m/Y H:i:s'));

        $validColumnsRole = [];
        $i=0;
        foreach(Role::all() as $role){
            $validColumnsRole[$i] = $role->id;
            ++$i;
        }

    if (!$this->dataTamper($employe_surname,$h2_employe_surname) || !$this->dataTamper($user_last_name, $h3_user_last_name) || !$this->dataTamper($emp_code, $h1_emp_code) || !$this->dataTamper($user_email,$h4_user_email) || !$this->dataTamper($personal_email,$h5_personal_email) || !$this->dataTamper($user_mobile_no,$h6_user_mobile_no) || !$this->dataTamper($dep_name,$h7_dep_name)) {
        Log::error('Store Data error: ' . 'Data temporing.');
            return response()->json([
                'status' => 'error',
                'errorTamperingValue' => true,
                'redirect' => route('error-page','errorTampering')
            ],400);
            die;
    }

    foreach($request->roles as $role){        
        if (!in_array($role, $validColumnsRole)) {
            Log::error('Edit Data error: ' . 'Data temporing.');
            return response()->json([
                'status' => 400,
                'errorTamperingValue' => true,
                'redirect' => route('error-page','errorTampering')
            ],400);
            die;
        }
    }

    $full_name = $employe_surname.' '.$user_last_name;
    // dd('stem',$full_name);
       
       
        DB::beginTransaction();
        try {

            $user = User::create([
                // 'name' => $request->name,
                // 'email' => $request->email,
                // 'password' => Hash::make($request->password),
                'nims_employe_code'=> $request->emp_code,
                'nims_wp_user_name'=> $full_name ,
                'nims_wp_user_email'=> $request->user_email ,
                'nims_wp_user_password'=>  $userpassword_insert ,
                'nims_employe_mob_no'=> $request->user_mobile_no ,
                'e_email'=> $request->personal_email ,
                'nims_wp_department_name'=> $request->dep_name ,
                'nims_wp_user_type'=> $roles,
                'nims_wp_user_created_by'=> $logged_in_user,
                'nims_wp_user_created_on'=>  $create_date,
                'nims_wp_user_status'=>0,
                'user'=>$roles,
                'nims_wp_salt_random'=> $salt ,
            ]);
  
            // Sync roles to the user
             $user->roles()->sync($request->roles);

            // Fetch all permissions associated with the selected roles
            $permissions = [];
            foreach ($request->roles as $roleId) {
                $role = Role::find($roleId);
                if ($role) {
                    $permissions = array_merge($permissions, $role->permissions->pluck('id')->toArray());
                }
            }
    
            // Attach permissions to the user
            $user->permissions()->sync($permissions);

            DB::commit();
            Log::info('Transaction committed successfully');

            return response()->json([
                'status' => 'success',
                'message' => 'User added successfully!'
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
         $user = User::with('roles')->find($id);
         return view('users.show',compact('user'));
    }

     public function edit($id)
    {
// dd($id);
        $user = User::with('roles')->findOrFail($id);
        // dd($user);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
                //  dd($request->all());
    // Define validation rules
    $rules = [
        'emp_code' => [
            'required',
            'string',
            'min:3',  // Minimum length 3 characters
            'max:30', // Maximum length 30 characters
            'unique:nims_wp_user_login,nims_employe_code,' . $id . ',nims_wp_user_id', // Unique except current user
            'regex:/^[A-Za-z0-9]+$/',  // Only letters and numbers allowed (no special characters)
        ],
        'employe_surname' => [
            'required',
            'string',
            'min:3',  // Minimum length 3 characters
            'max:30', // Maximum length 30 characters
            'regex:/^[A-Za-z\s]+$/', // Only letters and spaces allowed
        ],
        'user_email' => [
            'required',
            'email',  // Email validation
            'unique:nims_wp_user_login,nims_wp_user_email,' . $id . ',nims_wp_user_id', // Unique except current user
        ],
        'personal_email' => [
            'required',
            'email',  // Email validation
            'unique:nims_wp_user_login,e_email,' . $id . ',nims_wp_user_id', // Unique except current user
        ],
        'user_mobile_no' => [
            'required',
            'digits:10',  // Exactly 10 digits
        ],
        'dep_name' => [
            'required',  // Required field
            'exists:nims_wp_department,nims_wp_department_id',  // Ensure selected department exists
        ],
        'roles' => [
            'required',  // Ensure at least one role is selected
            'array',
            'min:1',
        ],
        'roles.*' => [
            'exists:roles,id',  // Ensure each selected role exists
        ],
    ];

    // Define validation messages
    $messages = [
        'emp_code.required' => 'Please enter an Employee Code.',
        'emp_code.min' => 'Employee Code must be at least 3 characters long.',
        'emp_code.max' => 'Employee Code cannot exceed 30 characters.',
        'emp_code.regex' => 'Employee Code cannot contain special characters.',

        'employe_surname.required' => 'User name is required.',
        'employe_surname.min' => 'User name must be at least 3 characters long.',
        'employe_surname.max' => 'User name cannot exceed 30 characters.',
        'employe_surname.regex' => 'User name can only contain letters and spaces.',

        'user_email.required' => 'Please enter an email address.',
        'user_email.email' => 'Please enter a valid email address.',

        'personal_email.required' => 'Please enter a personal email address.',
        'personal_email.email' => 'Please enter a valid personal email address.',

        'user_mobile_no.required' => 'Please enter your mobile number.',
        'user_mobile_no.digits' => 'Mobile number must be exactly 10 digits.',

        'dep_name.required' => 'Please select a department.',
        'dep_name.exists' => 'The selected department is invalid.',

        'roles.required' => 'Please select at least one role.',
        'roles.exists' => 'The selected role is invalid.',
    ];

    // Create the validator
    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Sanitize input
    $h_id = $this->sanitizeInput($request->h);
    $htwo_id = $request->htwo;

    $emp_code = $this->sanitizeInput($request->emp_code);
    $h1_emp_code = $request->h1;

    $employe_surname = $this->sanitizeInput($request->employe_surname);
    $h2_employe_surname = $request->h2;
   

    $user_email = $this->sanitizeInput($request->user_email);
    $h3_user_email = $request->h3;

    $personal_email = $this->sanitizeInput($request->personal_email);
    $h4_personal_email = $request->h4;

    $user_mobile_no = $this->sanitizeInput($request->user_mobile_no);
    $h5_user_mobile_no = $request->h5;

    $dep_name = $this->sanitizeInput($request->dep_name);
    $h6_dep_name = $request->h6;

    $roles = json_encode($request->roles);

    // Validate role tampering
    $validColumnsRole = Role::pluck('id')->toArray();

    foreach ($request->roles as $role) {
        if (!in_array($role, $validColumnsRole)) {
            Log::error('Edit Data error: Role tampering.');
            return response()->json([
                'status' => 'error',
                'errorTamperingValue' => true,
                'redirect' => route('error-page', 'errorTampering')
            ], 400);
        }
    }

    if (!$this->dataTamper($h_id, $htwo_id) || !$this->dataTamper($employe_surname, $h2_employe_surname) || !$this->dataTamper($emp_code, $h1_emp_code) || !$this->dataTamper($user_email, $h3_user_email) || !$this->dataTamper($personal_email, $h4_personal_email) || !$this->dataTamper($user_mobile_no, $h5_user_mobile_no) || !$this->dataTamper($dep_name, $h6_dep_name)) {
        Log::error('Edit Data error: Data tampering detected.');
        return response()->json([
            'status' => 'error',
            'errorTamperingValue' => true,
            'redirect' => route('error-page', 'errorTampering')
        ], 400);
    }

    $full_name = $employe_surname;
    date_default_timezone_set('Asia/Kolkata');  
    $create_date = $this->convertDateTimeSec(date('d/m/Y H:i:s'));

    DB::beginTransaction();
    try {
        // Fetch the user
        $user = User::findOrFail($id);

        // Update the user details
        $user->nims_employe_code = $emp_code;
        $user->nims_wp_user_name = $full_name;
        $user->nims_wp_user_email = $user_email;
        $user->e_email = $personal_email;
        $user->nims_employe_mob_no = $user_mobile_no;
        $user->nims_wp_department_name = $dep_name;
        $logged_in_user = '_'.auth()->user()->roles()->first()->name;
        $user->update(['nims_employe_code'=> $request->emp_code,
        'nims_wp_user_name'=> $full_name ,
        'nims_wp_user_email'=>  $user_email ,
        'e_email'=> $personal_email ,
        'nims_employe_mob_no'=> $user_mobile_no ,
        'nims_wp_department_name'=> $dep_name ,
        'nims_wp_user_type'=> $roles,
        'nims_wp_user_created_by'=> $logged_in_user,
        'nims_wp_user_created_on'=>  $create_date,
        'nims_wp_user_status'=>0,
        'user'=>$roles,
       ]);

        // Update roles
        $user->roles()->sync($request->roles);

        // Update permissions
        $permissions = [];
        foreach ($request->roles as $roleId) {
            $role = Role::find($roleId);
            if ($role) {
                $permissions = array_merge($permissions, $role->permissions->pluck('id')->toArray());
            }
        }

        $user->permissions()->sync($permissions);

        // Commit transaction
        DB::commit();
        Log::info('Transaction committed successfully');

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully!'
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


    public function changeStatusUser(Request $request)
    {
    	//\Log::info($request->all());
        // dd($request->all());
        // dd($request->id);
        $user = User::find($request->id);
        $status = ($user->nims_wp_user_status == 1) ? 0: 1; 
        $user->nims_wp_user_status = $status;
        $user->save();
        if($status)
        {
            Log::info('Status: Activat successfully');
            return response()->json(['success'=>'Activat successfully.']);         
        }else{
            Log::info('Status: Inactivat successfully');
            return response()->json(['success'=>'Inactivat successfully.']); 
        }
    }
}
