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
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // dd(session()->getId());
           $user = Auth::user();
            // dd($user->hasRole($role));
            // dd(auth()->user()->roles,auth()->user()->permissions);
            // dd(auth()->user()->roles);
            $roles = auth()->user()->roles;
            foreach ($roles as $role) {
                // echo $role->name;
                if(empty($role->name)){
                    return redirect()->route('login')->withErrors(['error' => 'The credentials do not match.']);
                }
            }
            
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return back()->withErrors(['error' => 'The credentials do not match.']);
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
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
