<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Tender;
use App\Models\Admission;
use App\Models\Permission;
use App\Models\Examination;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        
        if(empty($user)){
          return view('auth.login');
       }

       return redirect("dashboard");
    }  
      
    public function customLogin(Request $request)
    {
        if ($request->isMethod('post')) {

        $request->validate([
            'nims_wp_user_email' => 'required',
            'nims_wp_user_password' => 'required',
        ]);
   
        $credentials = [
            'nims_wp_user_email' => $request->input('nims_wp_user_email'),
            'nims_wp_user_password' => $request->input('nims_wp_user_password'),
        ];

        // Custom user retrieval
        $user = User::where('nims_wp_user_email', $credentials['nims_wp_user_email'])->first();

        if ($user && Hash::check($credentials['nims_wp_user_password'], $user->nims_wp_user_password)) {
            Auth::login($user);
            // dd(auth()->user()->roles);
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return back()->withErrors(['error' => 'The credentials do not matchaaa.']);
      }
      return redirect()->intended('login');
    }
    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have successfully signed-in');
    }
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard()
    {
        //  dd(Auth::check());
        if(Auth::check()){
            // dd(Auth::check());

            // Total counts
            $totalPermissions = Permission::count();
            $totalTenders = Tender::where('nims_wp_tender_archive', 0)
            ->where('nims_wp_tender_end_date', '>', Carbon::now())->count();

            $totalNotifications = Notification::count();
            $totalAdmissions = Admission::where('nims_admissions_archive', 0)
            ->where('nims_admissions_end_date', '>', Carbon::now())
            ->count();
            $totalExaminations = Examination::where('nims_examination_archive', 0)
            ->where('nims_examination_end_date', '>', Carbon::now())->count();
        // dd($totalPermissions,$totalTenders ,$totalNotifications,$totalAdmissions,$totalExaminations);
    // Today's counts
    $today = Carbon::today();

            $todayPermissions = Permission::whereDate('created_at', $today)->count();
            $todayTenders = Tender::where('nims_wp_tender_archive', 0)
            ->where('nims_wp_tender_end_date', '>', Carbon::now())
            ->whereDate('nims_wp_tender_submit_date', Carbon::today())
            ->count();
            $todayNotifications = Notification::whereDate('entry_date', $today)->count();
            $todayAdmissions = Admission::where('nims_admissions_archive', 0)
            ->where('nims_admissions_end_date', '>', Carbon::now())
            ->whereDate('nims_admissions_submit_date', Carbon::today())
            ->count();
            $todayExaminations = Examination::where('nims_examination_archive', 0)
            ->where('nims_examination_end_date', '>', Carbon::now())
            ->whereDate('nims_examination_submit_date', Carbon::today())
            ->count();
            $totalUsers = DB::table('nims_wp_user_login')->count();

            $totalUsersToday = DB::table('nims_wp_user_login')->where('nims_wp_user_created_on', '>=', $today)->count();
            // Get total number of roles
            $totalRoles = Role::count();
            // Get total number of roles created today
            $totalRolesToday = Role::where('created_at', '>=', $today)->count();
            // dd($totalUsersToday);
            return view('auth.home',compact('totalUsers',
                                            'totalUsersToday',
                                            'totalRoles',
                                            'totalRolesToday',
                                            'totalPermissions', 'todayPermissions', 
                                            'totalTenders', 'todayTenders', 
                                            'totalNotifications', 'todayNotifications', 
                                            'totalAdmissions', 'todayAdmissions', 
                                            'totalExaminations', 'todayExaminations'
             ));
        }
  
        return back()->withErrors(['error' => 'You are not allowed to access.']);
        // return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function dataTampering(Request $request)
    {
// dd($request->all());
        $error = session('errorTampering');
        $errorTampering = $request->errorTampering;
        if($error || $errorTampering){
            return view('auth.error-data-tampering');
        }
        return redirect("dashboard");
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}
