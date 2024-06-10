<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function index(){
    //    dd('Customer');
    // $usersFromPostgreSQL = DB::connection('pgsql')->table('hivt_user_test_mst')->get();
    $usersFromPostgreSQL = User::all();
    // dd('from user model $usersFromPostgreSQL =',$usersFromPostgreSQL );
    // $usersFromPostgreSQL = DB::connection('pgsql')->table('ahiscl.gblt_hospital_mst')->get(); 
    //  $usersFromPostgreSQL = DB::connection('pgsql')->select("select * from ahiscl.gblt_hospital_mst");          
    $usersFromPostgreSQL = DB::connection('pgsql')->table('ahiscl.hivt_user_test_mst')->get();
    // dd('usersFromPostgreSQL=',$usersFromPostgreSQL);

    // $usersFromMySQL = DB::connection('mysql')->table('nims_wp_user_login')->get();
    // dd('$usersFromMySQL=',$usersFromMySQL,'usersFromPostgreSQL=',$usersFromPostgreSQL);

    if (auth()->user()->can('create-user',)) {
        return view('auth.home');
    }
 
    }
}
