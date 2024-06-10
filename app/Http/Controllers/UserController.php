<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\View\View;
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
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            // 'roles.*' => 'exists:roles,name',
        ]);

        // dd($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // $user->givePermissionsTo(...$request->roles);
        $user->roles()->sync($request->roles);
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
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        // Update the user's basic details
        $user->update($request->only('name', 'email'));

        // Sync roles
        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}
