<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{

   /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request): View

     {
 
        //  $roles = Role::latest()->paginate(5);
         $roles = Role::with('permissions')->get();
 
         return view('roles.index',compact('roles'));
 
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
