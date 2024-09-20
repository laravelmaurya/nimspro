<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

   /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request)
     {
         if ($request->ajax()) {
             $roles = Role::with('permissions')->get();
             return Datatables::of($roles)
                 ->addIndexColumn()
                 ->addColumn('status', function($row) {
                     $checked = $row->status ? 'checked' : '';
                     return '<input data-id="'.$row->id.'" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active" data-off="InActive" '.$checked.'>';
                 })
                 ->addColumn('permissions', function($row) {
                     $permissions = $row->permissions->map(function($permission) {
                         return '<h4 class="d-inline"><span class="badge bg-info">' . $permission->name . '</span></h4>';
                     })->implode(' ');
 
                     return $permissions;
                 })
                 ->addColumn('action', function($row){
                     $editUrl = route('roles.edit', $row->id);
                     $deleteUrl = route('roles.destroy', $row->id);
                     $viewUrl = route('roles.show', $row->id);
 
                     $btn = '<a href="'.$editUrl.'" class="edit"><i class="fas fa-edit"></i></a>
                             <form method="GET" action="'.$viewUrl.'">
                                 @csrf
                                 <button class="btn btn-sm bg-warning"><i class="fas fa-eye"></i></button>
                             </form>
                             <a href="'.$deleteUrl.'" class="delete-confirm">
                                 <i class="text-danger fas fa-trash"></i>
                             </a>';
 
                     return $btn;
                 })
                 ->rawColumns(['status', 'permissions', 'action'])
                 ->make(true);
         }
 
         return view('roles.index');
     }
 
   

     
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'required',
            // 'permissions.*' => 'exists:permissions,id',
            // 'roles.*' => 'exists:roles,name',
        ]);

        // dd($request->all());
        $role = Role::create([
            'name' => $request->name,
        ]);

        // $role->givePermissionsTo(...$request->roles);
        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }


    public function show($id): View
     {
 
         $role = Role::with('permissions')->find($id);
 
         return view('roles.show',compact('role'));
 
     }

     public function edit($id)
    {
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Update the role's basic details
        $role->update($request->only('name'));

        // Sync roles
        $role->permissions()->sync($request->permissions);

        // Update users' permissions in users_permissions
        $this->syncUsersPermissions($role, $request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }
    // this function for sys permissions in users_permissions intermediate table
    protected function syncUsersPermissions(Role $role, array $permissions)
    {
        // Get all users with the specified role
        $users = $role->users;

        foreach ($users as $user) {
            // Detach all current permissions of the user
            $user->permissions()->detach();

            // Attach all permissions of the user's roles
            foreach ($user->roles as $userRole) {
                $user->permissions()->syncWithoutDetaching($userRole->permissions);
            }
        }
    }
}
