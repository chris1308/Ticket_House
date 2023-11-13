<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Penjual;
use Illuminate\Http\Request;


class TiketController extends Controller
{
    //
    public function getSeminar(){
        $category = "seminar";
        $tickets = Tiket::where('kategori', $category)->get();

        return view('seminar')->with(['seminars' => $tickets, 'title' => 'Seminar']);
    }

    public function getPlaces(){
        $category = "place";
        $places = Tiket::where('kategori', $category)->get();

        return view('places')->with(['places' => $places, 'title' => 'Places']);
    }

    public function show($id){
        // Logic to fetch item details from the database using $id
        $ticket = Tiket::where('id_tiket',$id)->first(); 
        $seller = Penjual::where('id_penjual',$ticket->id_penjual)->first();
        return view('ticketDetail', ['ticket' => $ticket, 'title'=>'Detail Ticket', 'seller'=>$seller]);
    }
}
