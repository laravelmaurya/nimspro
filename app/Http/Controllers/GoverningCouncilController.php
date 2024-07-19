<?php

namespace App\Http\Controllers;

use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use App\Models\GoverningCouncil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GoverningCouncilController extends Controller
{
    use CommonTrait;
    public function edit(Request $request, $column, $te)
    {
        // dd($request->all());
        // dd($te,$column);
        $validTables = [ 'aboutus','director'
                        ]; // Add all your valid table names here
        $validColumns = [ 'governmentc', 'ex_board', 'finance','acadamiccouncil','committees',
                          'about','office','exdirector',
                          
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
        $validTables = [ 'aboutus','director'
                        ]; // Add all your valid table names here
        // Validate the column name if needed to prevent SQL injection
        $validColumns = ['governmentc', 'ex_board', 'finance','acadamiccouncil','committees',
                         'about','office','exdirector',
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
