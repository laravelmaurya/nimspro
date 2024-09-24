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

    use CommonTrait;
   /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function index(Request $request)
     {
    if ($request->ajax()) {
        $roles = Role::with('permissions');
        // $roles = Role::with('permissions');
        return Datatables::of($roles)
            ->addIndexColumn()
            // ->addColumn('status', function($row) {
            //     $checked = $row->status ? 'checked' : '';
            //     return '<input data-id="'.$row->id.'" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active" data-off="InActive" '.$checked.'>';
            // })
            ->editColumn('roles', function($row) {
                return Str::limit($row->name, 30);
            })
            ->addColumn('permissions', function($row) {
                $permissions = $row->permissions->map(function($permission) {
                    return '<h4 class="d-inline"><span class="badge bg-info">' .  Str::limit($permission->name, 30) . '</span></h4>';
                })->implode(' ');

                return $permissions;
            })
            ->addColumn('action', function($row){
                return '
                <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn"><i class="fas fa-edit"></i></a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete-btn text-danger"><i class="fas fa-trash-alt"></i></a>';
            })->filter(function ($roles) use ($request) {
                     if ($request->has('search.value')) {
                         $searchTerm = $request->input('search.value');
                         $roles->where('name', 'like', "%{$searchTerm}%")
                             ->orWhereHas('permissions', function ($q) use ($searchTerm) {
                                 $q->where('name', 'like', "%{$searchTerm}%");
                             });
                     }
                 })
            ->rawColumns(['status', 'permissions', 'action'])
            ->make(true);
    }

    $permissions = Permission::all();
    return view('roles.index', compact('permissions'));
}

 
   

     
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'min:3',  // Minimum length 3 characters
                'max:30', // Maximum length 30 characters
                'regex:/^[A-Za-z\s]+$/', // Only letters and spaces allowed
                'unique:roles,name', // Check if the role name already exists
            ],
            'permissions' => [
                'required',
                'array', // Ensure permissions is an array
            ],
        ];
    
        $messages = [
            'name.required' => 'Role Name is required.',
            'name.min' => 'Role Name must be at least 3 characters long.',
            'name.max' => 'Role Name cannot exceed 30 characters.',
            'name.regex' => 'Role Name can only contain letters and spaces.',
            'name.unique' => 'Role Name already exists. Please choose another name.', // Custom message for uniqueness
            'permissions.required' => 'Please select at least one role.',            
        ];
        
        // Create the validator
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        // dd($request->all());
        $name = $this->sanitizeInput($request->name);
        $h1_name = $request->h1;

        if (!$this->dataTamper($name,$h1_name)) {
            Log::error('Store Data error: ' . 'Data temporing.');
                return response()->json([
                    'status' => 'error',
                    'errorTamperingValue' => true,
                    'redirect' => route('error-page','errorTampering')
                ],400);
                die;
        }

        $permissions = Permission::pluck('id')->toArray();
        // dd($request->permissions,$permissions);
        // dd($permissions);

        // Get permission IDs only without keys
        $sanitizedPermissions = array_values($permissions); // Now it's [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]
        foreach($request->permissions as $permission){           
            if (!in_array($permission, $sanitizedPermissions)) {
                // dd('d=',$sanitizedPermissions);
                // dd($request->all());
                Log::error('Edit Data error: ' . 'Data temporing.');
                return response()->json([
                    'status' => 400,
                    'errorTamperingValue' => true,
                    'redirect' => route('error-page','errorTampering')
                ],400);
                die;
            }    
        }
            //  dd($request->all());

             DB::beginTransaction();
        try {

            $role = Role::create([
                'name' => $name,
            ]);
  
            // $role->givePermissionsTo(...$request->roles);
            $role->permissions()->sync($request->permissions);

            DB::commit();
            Log::info('Transaction committed successfully');

            return response()->json([
                'status' => 'success',
                'message' => 'Role added successfully!'
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
 
         $role = Role::with('permissions')->find($id);
 
         return view('roles.show',compact('role'));
 
     }

     public function edit($id)
     {
         $role = Role::with('permissions')->findOrFail($id);
     
         return response()->json([
             'id' => $role->id,
             'name' => $role->name,
             'permissions' => $role->permissions->pluck('id') // Returns only the permission IDs
         ]);
     }

     public function update(Request $request, $id)
     {
            $rules = [
                'name' => [
                    'required',
                    'string',
                    'min:3',
                    'max:30',
                    'regex:/^[A-Za-z\s]+$/',
                    'unique:roles,name,' . $id, // Ensure unique name except for the current role
                ],
                'permissions' => [
                    'required',
                ],
            ];

            $messages = [
                'name.required' => 'Role Name is required.',
                'name.min' => 'Role Name must be at least 3 characters long.',
                'name.max' => 'Role Name cannot exceed 30 characters.',
                'name.regex' => 'Role Name can only contain letters and spaces.',
                'permissions.required' => 'Please select at least one permission.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 422);
            }
            //  dd($request->all());
            $h_id = base64_encode($request->h);
            $name = $this->sanitizeInput($request->name);
            $h1_name = $request->h1;

            if (!$this->dataTamper($name, $h1_name) || !$this->dataTamper($id, $h_id)) {
                Log::error('Update Data error: ' . 'Data tampering.');
                return response()->json([
                    'status' => 'error',
                    'errorTamperingValue' => true,
                    'redirect' => route('error-page', 'errorTampering')
                ], 400);
            }

            $permissions = Permission::pluck('id')->toArray();
            $sanitizedPermissions = array_values($permissions);

            foreach ($request->permissions as $permission) {
                if (!in_array($permission, $sanitizedPermissions)) {
                    Log::error('Edit Data error: ' . 'Data tampering.');
                    return response()->json([
                        'status' => 400,
                        'errorTamperingValue' => true,
                        'redirect' => route('error-page', 'errorTampering')
                    ], 400);
                }
            }

            DB::beginTransaction();

            try {
                $role = Role::findOrFail($id);
                $role->update(['name' => $name]);
                $role->permissions()->sync($request->permissions);

                DB::commit();
                Log::info('Transaction committed successfully');
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Role updated successfully!'
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while updating the role: ' . $e->getMessage()
                ], 500);
            }
     }

    
    public function destroy(Request $request,$id)
    {
        $req_id = base64_encode($request->id);
        if (!$this->dataTamper($id, $req_id)) {
            Log::error('Update Data error: ' . 'Data tampering.');
            return response()->json([
                'status' => 'error',
                'errorTamperingValue' => true,
                'redirect' => route('error-page', 'errorTampering')
            ], 400);
        }
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            $role->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully!'
            ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'An error occurred while deleting the role: ' . $e->getMessage()
                ], 500);
            }
    }
    
}
