<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Traits\CommonTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{

      use CommonTrait;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
     public function index(Request $request)
     {
        $this->authorize('view-page', 'permission-list');
         if ($request->ajax()) {
             // Query all permissions from the database
             $permissions = Permission::query();
     
             // Use DataTables to handle the data
             return Datatables::of($permissions)
                 ->addIndexColumn() // Adds index column for numbering
     
                 // Optional: Uncomment if status functionality is needed
                 // ->addColumn('status', function($row) {
                 //     $checked = $row->status ? 'checked' : '';
                 //     return '<input data-id="'.$row->id.'" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-size="xs" data-on="Active" data-off="Inactive" '.$checked.'>';
                 // })
     
                 // Limit permission names to 30 characters for display
                 ->editColumn('name', function($row) {
                     return Str::limit($row->name, 30);
                 })
     
                 // Add action buttons for edit and delete
                 ->addColumn('action', function($row) {
                    // return '
                    // <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn"><i class="fas fa-edit"></i></a>';
                    $editPermission = auth()->user()->can('view-page', 'permission-edit');

                    $buttons = '';

                    if ($editPermission) {
                        $buttons .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn"> <i class="fas fa-edit"></i></a>';
                    }

                    return $buttons;
                    //  return '
                    //  <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit-btn"><i class="fas fa-edit"></i></a>
                    //  <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete-btn text-danger"><i class="fas fa-trash-alt"></i></a>';
                 })
     
                 // Search filter for the datatable
                 ->filter(function ($query) use ($request) {
                     if ($request->has('search.value')) {
                         $searchTerm = $request->input('search.value');
                         // Apply search to name column, you can adjust as needed
                         $query->where('name', 'like', "%{$searchTerm}%")
                         ->orWhere('created_at', 'like', "%{$searchTerm}%");
                     }
                 })
     
                 // Ensure raw HTML is rendered for status and action columns
                 ->rawColumns(['status', 'name', 'action'])
                 ->make(true);
         }
     
         // If not AJAX request, return the view
         return view('permissions.index');
     }
    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:3|max:30|unique:permissions,name',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

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

        // dd($request->all());
        DB::beginTransaction();
        try {
            Permission::create([
                'name' => $request->name,
            ]);

            DB::commit();
            Log::info('Transaction committed successfully');
            return response()->json(['status' => 'success', 'message' => 'Permission created successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in permission creation: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred. Please try again later.'], 500);
        }
    }
  

    public function show($id) : View
    {
        $permission = Permission::find($id);
        return view('permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return response()->json([
            'id' => $permission->id,
            'name' => $permission->name,
        ]);
        // return response()->json($permission);
    }


    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $rules = [
            'name' => 'required|string|min:3|max:50|unique:permissions,name,' . $permission->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
        $h_id = base64_encode($request->h);
        $name = $this->sanitizeInput($request->name);
        $h1_name = $request->h1;

        if (!$this->dataTamper($name,$h1_name) || !$this->dataTamper($id,$h_id)) {
            Log::error('Store Data error: ' . 'Data temporing.');
                return response()->json([
                    'status' => 'error',
                    'errorTamperingValue' => true,
                    'redirect' => route('error-page','errorTampering')
                ],400);
                die;
        }
// dd($request->all());

        DB::beginTransaction();
        try {
            $permission->update([
                'name' => $request->name,
            ]);

            DB::commit();
            Log::info('Transaction committed successfully');
            return response()->json(['status' => 'success', 'message' => 'Permission updated successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in permission update: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred. Please try again later.'], 500);
        }
    }

    public function destroy(Request $request,$id)
    {
        dd($request->all());
        DB::beginTransaction();

        try {
            // Find the permission
            $permission = Permission::findOrFail($id);

            // Check if permission is assigned to any roles in the `roles_permissions` table
            $roleAssigned = DB::table('roles_permissions')
                ->where('permission_nims_wp_permission_id', $id)
                ->exists();

            // Check if permission is assigned to any users in the `users_permissions` table
            $userAssigned = DB::table('users_permissions')
                ->where('permission_nims_wp_permission_id', $id)
                ->exists();
// dd($permission,$roleAssigned,$userAssigned);
            // If the permission is assigned to any role or user, prevent deletion
            if ($roleAssigned || $userAssigned) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Cannot delete the permission because it is assigned to roles or users.'
                ], 400);
            }

            // If not assigned, proceed with deletion
            $permission->delete();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Permission deleted successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in permission deletion: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred. Please try again later.'
            ], 500);
        }
    }
    
}
