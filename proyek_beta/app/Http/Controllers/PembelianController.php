<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function checkout($id){
        $title = "Checkout";
        $ticket = Tiket::where('id_tiket',$id)->first(); //kalo pake get() dapatnya bentuk array[]
        $date = ""; //kalo place tidak ada startDatenya
        if($ticket->kategori == "seminar"){
            $date = $ticket->start_date;
        }
        return view('checkout',compact('title','ticket','date'));
    }
}
