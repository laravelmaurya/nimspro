<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LatestController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\GoverningCouncilController;

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
// Route::get('/dynamic-page/{parameter1}/{parameter2}', [DynamicPageController::class, 'show'])->name('dynamic.page');

Route::get('/mci-count-students', [FrontendController::class, 'mciCountStudents'])->name('mci-count-students');
Route::get('/mci-list-ss', [FrontendController::class, 'mciListSs'])->name('mci-list-ss');
Route::get('/mci-list-bs', [FrontendController::class, 'mciListBs'])->name('mci-list-bs');
Route::any('/pages/click-paths', [FrontendController::class, 'clickPaths'])->name('click-paths');
Route::any('/pages/depw-test-view', [FrontendController::class, 'depwTestView'])->name('depw-test-view.page');
Route::any('/pages/all-test', [FrontendController::class, 'allTests'])->name('all-tests.page');
Route::any('/pages/patient-view', [FrontendController::class, 'patientView'])->name('patient-view.page');
Route::any('/pages/hs-internal-phone-no', [FrontendController::class, 'hsInternalPhoneNo'])->name('hs-internal-phone-no.page');
Route::get('/pages/{te}/{id}/{val}/{id2}', [FrontendController::class, 'downloadImage'])->name('downloadImage.page');
Route::any('/pages', [FrontendController::class, 'showTab'])->name('dynamic-four.tab-page');
// Route::get('/pages/{te}/{id}/{id2}/{id3}/{title}/{title2}/{title3}', [FrontendController::class, 'showTab'])->name('dynamic.tab-page');
// Route::get('/pages/{te}/{id}/{title}', [FrontendController::class, 'show'])->name('dynamic.page');

Route::get('/', [FrontendController::class, 'index'])->name('index');


Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');



Route::group(['middleware' => 'custom_auth'], function() {
    // Route::post('tender/main-image-delete', [TenderController::class,'mainImgDelete'])->name('tender.main-image-delete'); 
    // Route::post('tender/image-delete', [TenderController::class,'imgDeleteSingle'])->name('tender.image-delete-only'); 
    // Route::post('admissions/{id}', [TenderController::class,'destroy'])->name('admissions.delete'); 
   
   
    Route::put('file-upload', [GoverningCouncilController::class, 'fileUpload'])->name('file-upload');
    Route::get('file-upload/{id}/{te}/edit', [GoverningCouncilController::class, 'editFileUpload'])->name('file-upload.edit');

    Route::put('governing-council', [GoverningCouncilController::class, 'update'])->name('governing-council');
    Route::get('governing-council/{id}/{te}/edit', [GoverningCouncilController::class, 'edit'])->name('governing-council.edit');
    // Route::get('governing-council/{id}/{type}/edit', [GoverningCouncilController::class, 'edit'])->name('governing-council.edit');


    Route::get('/latests/get-number', [LatestController::class, 'getNumber'])->name('latests.get-number');
    Route::get('latests/list-archive', [LatestController::class,'listArchive'])->name('latests.list-archive'); 
    Route::get('/latests/list-archive/{id}/edit', [LatestController::class, 'edit'])->name('latests.list-archive.edit'); 
    Route::post('latests/corrigendum', [LatestController::class,'storeCorrigendum'])->name('latests.stroe-corrigendum'); 
    Route::post('latest/remove-attachment', [LatestController::class,'removeAttachment'])->name('latest.remove-attachment'); 
    Route::resource('latests', LatestController::class);

    Route::get('/recruitments/get-number', [RecruitmentController::class, 'getNumber'])->name('recruitments.get-number');
    Route::get('recruitments/list-archive', [RecruitmentController::class,'listArchive'])->name('recruitments.list-archive'); 
    Route::get('/recruitments/list-archive/{id}/edit', [RecruitmentController::class, 'edit'])->name('recruitments.list-archive.edit'); 
    Route::post('recruitments/corrigendum', [RecruitmentController::class,'storeCorrigendum'])->name('recruitments.stroe-corrigendum'); 
    Route::post('recruitment/remove-attachment', [RecruitmentController::class,'removeAttachment'])->name('recruitment.remove-attachment'); 
    Route::resource('recruitments', RecruitmentController::class);

    Route::get('/examinations/get-number', [ExaminationController::class, 'getNumber'])->name('examinations.get-number');
    Route::get('examinations/list-archive', [ExaminationController::class,'listArchive'])->name('examinations.list-archive'); 
    Route::get('/examinations/list-archive/{id}/edit', [ExaminationController::class, 'edit'])->name('examinations.list-archive.edit'); 
    Route::post('examinations/corrigendum', [ExaminationController::class,'storeCorrigendum'])->name('examinations.stroe-corrigendum'); 
    Route::post('examination/remove-attachment', [ExaminationController::class,'removeAttachment'])->name('examination.remove-attachment'); 
    Route::resource('examinations', ExaminationController::class);  
    
    Route::get('/admissions/get-number', [AdmissionController::class, 'getNumber'])->name('admissions.get-number');
    Route::get('admissions/list-archive', [AdmissionController::class,'listArchive'])->name('admissions.list-archive'); 
    Route::get('/admissions/list-archive/{id}/edit', [AdmissionController::class, 'edit'])->name('admissions.list-archive.edit'); 
    Route::post('admissions/corrigendum', [AdmissionController::class,'storeCorrigendum'])->name('admissions.stroe-corrigendum'); 
    Route::post('admission/remove-attachment', [AdmissionController::class,'removeAttachment'])->name('admission.remove-attachment'); 
    Route::resource('admissions', AdmissionController::class);  

    Route::get('/tenders/get-number', [TenderController::class, 'getNumber'])->name('tenders.get-number');
    Route::get('tenders/list-archive', [TenderController::class,'listArchive'])->name('tenders.list-archive'); 
    Route::get('/tenders/list-archive/{id}/edit', [TenderController::class, 'edit'])->name('tenders.list-archive.edit'); 
    Route::post('tenders/corrigendum', [TenderController::class,'storeCorrigendum'])->name('tenders.stroe-corrigendum'); 
    Route::post('tender/remove-attachment', [TenderController::class,'removeAttachment'])->name('tender.remove-attachment'); 
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