<?php

use App\Http\Controllers\TiketController;
use App\Models\Tiket;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', function () { 
    $tikets = Tiket::take(4)->get();
    return view('home',[
        "title" => "Home",
        "tikets"=>$tikets,
    ]);
});

Route::get('/home', function () { 
    $tikets = Tiket::take(4)->get(); //fetch first 4 tickets
    return view('home',[
        "title" => "Home",
        "tikets"=>$tikets,
    ]);
});
Route::get('/dashboard', function () { //tampilan saat seller yang login
    return view('sellerDashboard',[
        "title" => "Seller Dashboard",
    ]);
});
Route::get('/about', function () {
    return view('about',[
        "title" => "About Us",
    ]);
});
Route::get('/register', [RegisterController::class,'index']);
Route::post('/register', [RegisterController::class,'store']);

//only if user hasn't logged in, he/she can access the login page
Route::get('/login', [LoginController::class,'login']);
Route::post('/login', [LoginController::class,'attemptLogin']);

Route::get('/logout', [LoginController::class,'logout']); //sementara untuk logout


//Seminar
Route::get('/seminar', [TiketController::class,'getSeminar']);
//Places
Route::get('/places', [TiketController::class,'getPlaces']);
//Detail Ticket. Name supaya bisa diakses lewat route(name)
Route::get('/ticket/{id}', [TiketController::class, 'show'])->name('ticket.detail');

