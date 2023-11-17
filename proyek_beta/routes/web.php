<?php

use App\Http\Controllers\TiketController;
use App\Models\Tiket;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ImageController;

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
})->name("home");

Route::get('/dashboard', function () { //tampilan saat seller yang login
    return view('sellerDashboard',[
        "title" => "Seller Dashboard",
    ]);
});
Route::get('/sellerProfile', function() {
    return view('sellerProfile',[
        "title" => "Seller Profile",
    ]);
});
Route::get('/adminDashboard', function() {
    return view('adminDashboard',[
        "title" => "Admin Dashboard",
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

Route::get('/logout', [LoginController::class,'logout']); 

//Seminar
Route::get('/seminar', [TiketController::class,'getSeminar']);
//Places
Route::get('/places', [TiketController::class,'getPlaces']);
//Detail Ticket. Name supaya bisa diakses lewat route(name)
Route::get('/ticket/{id}', [TiketController::class, 'show'])->name('ticket.detail');

//Search
Route::get('/search', [TiketController::class,'search']);

//Wishlist
Route::get('/wishlist', [WishlistController::class,'index']);
Route::post('/wishlist/{id}',[WishlistController::class, 'addToWishlist'])->name('add.wishlist');

Route::put("/wishlist", [WishlistController::class, 'removeAllFromWishlist']);
Route::put("/wishlist/{id}",[WishlistController::class,'removeFromWishlist'])->name('remove.wishlist');

//masih coba-coba
// Route::get('/nearme', function(){
//     return view('nearme', ["title"=>"Near Me"]);
// })->name("nearMe");
Route::get('/nearme', [TiketController::class,'nearMe'])->name("nearMe");


//Penjual
Route::get('/add', [TiketController::class,'showAdd']);
Route::post('/add', [TiketController::class,'saveAdd']);
//Report
Route::post('/report/{id}',[ReportController::class,'processReport'])->name('submit.report');

//COBA COBA UPLOAD IMAGE EDIT PROFIL PENJUAL
//Masih gagal, harus ubah-ubah auth web
//Route::post('/upload/image', [ImageController::class, 'upload'])->name('upload.image');
