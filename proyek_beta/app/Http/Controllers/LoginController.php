<?php

namespace App\Http\Controllers;
use App\Models\Pembeli;

use App\Models\Penjual;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; //we need this to be able to use Auth::
use Illuminate\Foundation\Auth\AuthenticatesUsers; //help us to authenticate
class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function login(){
                //random 3 tickets to be recommended on notification bar with the premise that there are at least 8 tickets in the database. Otherwise just fetch 3 most viewed ticket
                $tickets = Tiket::where('status',1)->orderBy('jumlah_view','desc')->get(); 
                $tempTickets = [];
                // $tempTicketsId = [];
                if(count($tickets)>=8){
                    $doneIndex = [];
                    for($i = 0; $i<3; $i++){
                        //random 3 index number
                        $randomIdx = random_int(0,7); //random number within the range of 0-7
                        while(in_array($randomIdx,$doneIndex)){
                            $randomIdx = random_int(0,7);
                        }
                        //check that there are no duplicate tickets being pushed
                        array_push($tempTickets,$tickets[$randomIdx]);
                        array_push($doneIndex,$randomIdx);
                    }
                }else{ //less than 8 tickets available
                    for($i = 0; $i<3; $i++){
                        array_push($tempTickets,$tickets[$i]->nama);
                    }
                }
                //save into session
                session(['tempTickets'=>$tempTickets]);
                // session(['tempTicketsId'=>$tempTicketsId]);
        return view('login',[
            "title" => "Login"
        ]);
    }

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
            
                //additional validation for banned account
                if($buyer->status == 0){//banned buyer not allowed to login  
                    return back()->with("loginError","Akun telah terkena ban!");
                }

            // this email belongs to Buyer
            session(["user"=>$buyer]);
            return redirect()->intended('/home'); //intended untuk dioper ke middleware dulu sebelum redirect
            }else if ($seller && Auth::guard('seller')->attempt(['email' => $loginField, 'password' => $password])){

                //additional validation for banned account
                if($seller->status == 0){//banned seller not allowed to login  
                    return back()->with("loginError","Akun telah terkena ban!");
                }

            //email belongs to Seller
            session(["user"=>$seller]);
            return redirect()->intended('/dashboard'); //intended untuk dioper ke middleware dulu sebelum redirect
            }
        }else{
            //login with username
            $buyer = Pembeli::where('username', $loginField)->first();
            $seller = Penjual::where('username',$loginField)->first();
            if ($seller && Auth::guard('seller')->attempt(['username' => $loginField, 'password' => $password])) {
            
                //additional validation for banned account
                if($seller->status == 0){//banned seller not allowed to login  
                    return back()->with("loginError","Akun telah terkena ban!");
                }
            
            // this username belongs to seller
            // Authentication successful
            // $request->session()->regenerate();
            session(["user"=>$seller]);
            
            return redirect()->intended('/dashboard'); //intended untuk dioper ke middleware dulu sebelum redirect
            }
            else if ($buyer && Auth::guard('buyer')->attempt(['username' => $loginField, 'password' => $password])) {
                
                //additional validation for banned account
                if($buyer->status == 0){//banned buyer not allowed to login  
                    return back()->with("loginError","Akun telah terkena ban!");
                }

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
