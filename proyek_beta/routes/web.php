<?php

use App\Http\Controllers\AdminMasterController;
use App\Models\Tiket;
use Jorenvh\Share\Share;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WishlistController;


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

Route::get('/dashboard', [PenjualController::class,'show']);
Route::get('/sellerProfile', function() {
    return view('sellerProfile',[
        "title" => "Seller Profile",
    ]);
});
Route::get('/about', function () {
    $title = "About Us";

    return view('about', compact('title'));
});

//Admin
Route::get('/adminLogin', [AdminController::class,'login'])->name('login.admin');
Route::post('/adminLogin', [AdminController::class,'attemptLogin']);
Route::get('/adminDashboard',[AdminController::class,'show']);

Route::get('/adminLogout', [AdminController::class,'logout']); 

//Admin Master
Route::prefix('admin')->group(function(){
    Route::get('/master/penjual', [AdminMasterController::class, 'showMasterPenjual']);
    Route::get('/master/pembeli', [AdminMasterController::class, 'showMasterPembeli']);
    Route::get('/master/tiket', [AdminMasterController::class, 'showMasterTiket']);
});



Route::get('/register', [RegisterController::class,'index']);
Route::post('/register', [RegisterController::class,'store']);

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


//Near Me
Route::get('/nearme', [TiketController::class,'nearMe'])->name("nearMe");

Route::get('/set-reminder/{id}', [TiketController::class,'setReminderToCalendar'])->name('tickets.reminder');
Route::get('/auth/google/callback', [TiketController::class,'handleCallback']);


// Penjual

//Add Tiket
Route::get('/add', [TiketController::class,'showAdd']);
Route::post('/add', [TiketController::class,'saveAdd']);

//Add Promo
Route::get('/addPromo', [PromoController::class,'showAddPromo']);
Route::post('/addPromo', [PromoController::class,'store']);

Route::get('/upgrade/{id}',[PenjualController::class,'upgrade'])->name('upgrade.status');

//View All Ticket
Route::get('/viewall',[TiketController::class,'showAll'])->name('view.all');

//Delete Ticket
Route::put("/deleteTicket/{id}",[TiketController::class,'deleteTicket'])->name('delete.ticket');

//Edit Ticket
Route::get("/edit/{id}", [TiketController::class,'showEditForm']);
Route::put("/edit/{id}", [TiketController::class,'updateTiket']);

//Report
Route::post('/report/{id}',[ReportController::class,'processReport'])->name('submit.report');

//Laporan Penjual
//Laporan View Ticket
Route::get('/viewreport',[PenjualController::class,'viewReport'])->name('view.report');
Route::get('/exportpdf/{id}', [PenjualController::class, 'exportpdf'])->name('export.pdf');
Route::get('/exportexcel/{id}', [PenjualController::class, 'exportexcel'])->name('export.excel');

//laporan penjualan
Route::get('/salesreport',[PenjualController::class,'salesReport'])->name('sales.report');

//laporan cashflow
Route::get('/cashflowreport',[PenjualController::class,'cashflowReport'])->name('cashflow.report');



//COBA COBA UPLOAD IMAGE EDIT PROFIL PENJUAL
//Masih gagal, harus ubah-ubah auth web
//Route::post('/upload/image', [ImageController::class, 'upload'])->name('upload.image');
