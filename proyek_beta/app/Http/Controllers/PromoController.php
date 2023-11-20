<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Penjual;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; //supaya bisa pake Rule::
class PromoController extends Controller
{
    public function showAddPromo(){
        //show add ticket page
        return view('addPromo',[
            "title" => "Tambah Kode Promo",
        ]);
    }

    public function store(Request $request){
        $rules = [
            'kodePromo' => [
                'required','string','max:255',Rule::unique('promos','kode_promo'),
            ],
            'nilaiPromo' => 'required|integer',
        ];
        $request->validate($rules);
        //generate new ID
        $ctr = Promo::count()+1; //hitung ada berapa tiket di DB +1
        $numberWithLeadingZeros = str_pad($ctr, 3, '0', STR_PAD_LEFT); //beri leading zero sebanyak 3. misal 1 jadi 001
        $promoId = 'PR'.$numberWithLeadingZeros;
        $getPenjual = Penjual::where('username', session('user')->username)->first();
        $idPenjual = $getPenjual->id_penjual;
        $kode_promo = $request->input('kodePromo');
        $nilai_promo = $request->input('nilaiPromo');
        Promo::create([
            'id_kodepromo'=>$promoId,
            'id_penjual'=>$idPenjual,
            'kode_promo'=>$kode_promo,
            'nilai_promo'=>$nilai_promo,
        ]);
        //sementara redirect ke dashbord setelah add
        return redirect('/dashboard')->with('message','Successfully added new promo code');
    }
}
