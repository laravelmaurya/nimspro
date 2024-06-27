<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        // dd();
        if(empty($user)){
          return view('auth.login');
       }

       return redirect("dashboard");
    }  
      
    public function customLogin(Request $request)
    {
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
            return view('auth.home');
        }
  
        return back()->withErrors(['error' => 'You are not allowed to access.']);
        // return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function dataTampering(Request $request)
    {
        $error = session('errorTampering');
        if($error){
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
