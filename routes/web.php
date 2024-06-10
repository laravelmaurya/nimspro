<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'App\Http\Controllers\UserController@index');
Route::resource('users','App\Http\Controllers\UserController');
Route::resource('roles','App\Http\Controllers\RoleController');
Route::resource('permissions','App\Http\Controllers\PermissionController');

Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('t', [TutorialController::class, 'index']);

// Route::group(['middleware' => 'role:admin'], function() {
    
//  });
 
//  Route::group(['middleware' => 'role:user'], function() {
//     //
//  });