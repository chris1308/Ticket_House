<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; //untuk menangani form

class UserController extends Controller
{
    public function login(){
        return view('login',[
            "title" => "Login"
        ]);
    }
}
