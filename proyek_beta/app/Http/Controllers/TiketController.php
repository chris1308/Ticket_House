<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
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


}
