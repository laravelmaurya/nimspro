<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
        ]);

        Permission::create($request->only('name'));

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }

    public function show($id) : View
    {
        $permission = Permission::find($id);
        return view('permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
    }
}
