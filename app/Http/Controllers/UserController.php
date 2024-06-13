<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

   /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request): View

     {
 
        //  $users = User::latest()->paginate(5);
         $users = User::with('roles')->get();
 
   
 
         return view('users.index',compact('users'));
 
     }

     
    public function create()
    {
        $roles = Role::all();
        $departments = Department::all();
        // dd($departments);
        return view('users.create',compact('roles','departments'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        //     'roles' => 'required|array',
        // ]);

   
        $full_name = $request->employe_surname. $request->user_last_name;
        $roles =   json_encode($request->roles);
        $salt = 'asldkjdslakjdsaldjsourrekjhkfhds';
        $password = 'Test@123#';
        $userpassword_insert = hash('sha256', $password . $salt); 
        $logged_in_user = '_'.auth()->user()->roles()->first()->name;
        date_default_timezone_set('Asia/Kolkata');  
        $publish_date = date('Y-m-d',strtotime(str_replace('/', '-', date('d/m/Y H:i'))));
    

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
            'nims_wp_user_created_on'=>  $publish_date,
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

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }


    public function show($id): View
     {
 
         $user = User::with('roles')->find($id);
 
         return view('users.show',compact('user'));
 
     }

     public function edit($id)
    {
        $user = User::with('roles')->find($id);
        // dd($user);
        $roles = Role::all();
        $departments = Department::all();
        return view('users.edit', compact('user', 'roles','departments'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // dd($request->all());
// dd($user);
        // Validate the incoming request data
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        //     'roles' => 'required|array',
        //     'roles.*' => 'exists:roles,id',
        // ]);

        $full_name = $request->employe_surname. $request->user_last_name;
        $roles =   json_encode($request->roles);
        $salt = 'asldkjdslakjdsaldjsourrekjhkfhds';
        $password = 'Test@123#';
        $userpassword_insert = hash('sha256', $password . $salt); 
        // $logged_in_user = '_'.auth()->user()->roles()->first()->name;
        $logged_in_user = $full_name;
        date_default_timezone_set('Asia/Kolkata');  
        $publish_date = date('Y-m-d',strtotime(str_replace('/', '-', date('d/m/Y H:i'))));

        // Update the user's basic details
        $user->update(['nims_employe_code'=> $request->emp_code,
        'nims_wp_user_name'=> $full_name ,
        'nims_wp_user_email'=> $request->user_email ,
        'nims_wp_user_password'=>  $userpassword_insert ,
        'nims_employe_mob_no'=> $request->user_mobile_no ,
        'e_email'=> $request->personal_email ,
        'nims_wp_department_name'=> $request->dep_name ,
        'nims_wp_user_type'=> $roles,
        'nims_wp_user_created_by'=> $logged_in_user,
        'nims_wp_user_created_on'=>  $publish_date,
        'nims_wp_user_status'=>0,
        'user'=>$roles,
        'nims_wp_salt_random'=> $salt ]);

        // Sync roles
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
        return redirect()->route('users.index')->with('success', 'User updated successfully');
        
    }
}
