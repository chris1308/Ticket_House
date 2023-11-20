<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginAdminController extends Controller
{
    use AuthenticatesUsers;
    public function login(){
        return view('adminLogin',[
            "title" => "Admin Login"
        ]);
    }
    
    protected function attemptLogin(Request $request) //method from use ...\AuthenticateUsers
    {
        $loginField = $request->input('login'); //get input with the name 'login'
        $password = $request->input('password');

        // Check if the login input is an email address

        if ($loginField && $password){
            if ($loginField === 'admin' && $password === 'admin') {
                // Authentication successful
                // $request->session()->regenerate();
                // session(["user"=>$seller]);
                return redirect()->intended('/adminDashboard'); //intended untuk dioper ke middleware dulu sebelum redirect
                }
       
        }
        // Authentication failed, flash an error message
        return back()->with("loginError","Login gagal!");
    }

    public function logout(Request $request)
    {
        auth()->check();
        // admin attempting to log out

        auth()->logout();
        // Auth::logout();
        // Session::flush();
        $request->session()->invalidate(); //hapus session login
     
        $request->session()->regenerateToken();
     
        return redirect('/adminLogin');
    }
}

