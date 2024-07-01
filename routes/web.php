<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PermissionController;

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

// Route::get('/', function(){
//     return "hi";
// });


Route::get('/', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');



Route::group(['middleware' => 'custom_auth'], function() {

    // Route::post('tender/image-delete', [TenderController::class,'imgDeleteSingle']); 
    Route::post('tender/main-image-delete', [TenderController::class,'mainImgDelete'])->name('tender.main-image-delete'); 
    Route::post('tender/image-delete', [TenderController::class,'imgDeleteSingle'])->name('tender.image-delete-only'); 
    Route::resource('tenders', TenderController::class);  
    Route::post('changeStatusUser', [UserController::class,'changeStatusUser']); 
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('error-page', [CustomAuthController::class,'dataTampering'])->name('error-page'); 
});


//  Route::group(['middleware' => 'role:user'], function() {
//     //
//  });