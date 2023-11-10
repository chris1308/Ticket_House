<?php

namespace App\Http\Controllers;
use App\Models\Pembeli;

use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; //we need this to be able to use Auth::
use Illuminate\Foundation\Auth\AuthenticatesUsers; //help us to authenticate
class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function login(){
        return view('login',[
            "title" => "Login"
        ]);
    }

    // public function authenticate(Request $request){
    //     $credentials = $request->validate([
    //         'email' => ['required'],   
    //         'password'=>['required'],
    //     ]);

    //     //cek data 
    //     if(Auth::attempt($credentials)){ //Auth::attempt otomatis cek di database credentials email dan password
    //         $request->session()->regenerate();
    //         return redirect()->intended('/home');
    //     }

    //     return back()->with("loginError","Login gagal!");
    // }
    protected function attemptLogin(Request $request) //method from use ...\AuthenticateUsers
    {
        $loginField = $request->input('login'); //get input with the name 'login'
        $password = $request->input('password');

        // Check if the login input is an email address
        $isEmail = filter_var($loginField, FILTER_VALIDATE_EMAIL); 

        //Check if the credentials belong to buyer or seller
        if ($isEmail){
            //login with email
            $buyer = Pembeli::where('email', $loginField)->first();
            $seller = Penjual::where('email',$loginField)->first();
            if ($buyer && Auth::guard('buyer')->attempt(['email' => $loginField, 'password' => $password])) {
            // this email belongs to Buyer
            // Authentication successful
            // $request->session()->regenerate();
            session(["user"=>$buyer]);
            return redirect()->intended('/home'); //intended untuk dioper ke middleware dulu sebelum redirect
            }else if ($seller && Auth::guard('seller')->attempt(['email' => $loginField, 'password' => $password])){
                //email belongs to Seller
            // Authentication successful
            // $request->session()->regenerate();
            session(["user"=>$seller]);
            return redirect()->intended('/dashboard'); //intended untuk dioper ke middleware dulu sebelum redirect
            }
        }else{
            //login with username
            $buyer = Pembeli::where('username', $loginField)->first();
            $seller = Penjual::where('username',$loginField)->first();
            if ($seller && Auth::guard('seller')->attempt(['username' => $loginField, 'password' => $password])) {
                // this username belongs to seller
            // Authentication successful
            // $request->session()->regenerate();
            session(["user"=>$seller]);
            return redirect()->intended('/dashboard'); //intended untuk dioper ke middleware dulu sebelum redirect
            }
            else if ($buyer && Auth::guard('buyer')->attempt(['username' => $loginField, 'password' => $password])) {
            // this username belongs to buyer
            // Authentication successful
            // $request->session()->regenerate();
            session(["user"=>$buyer]);
            // Auth::guard('buyer')->login($buyer);
            return redirect()->intended('/home'); //intended so that it will go to middleware before redirecting to /home
            }
        }
        // Authentication failed, flash an error message
        return back()->with("loginError","Login gagal!");
    }

    public function logout(Request $request)
    {
        if (Auth::guard('buyer')->check()) {
            // buyer attempting to log out

            Auth::guard('buyer')->logout();
        }
        if (Auth::guard('seller')->check()) {
            // seller attempting to log out
            Auth::guard('seller')->logout();
        }
        // Auth::logout();
        // Session::flush();
        $request->session()->invalidate(); //hapus session login
     
        $request->session()->regenerateToken();
     
        return redirect('/home');
    }
}
