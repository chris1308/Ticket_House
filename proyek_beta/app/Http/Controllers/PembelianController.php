<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Tiket;
use App\Models\Promo;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function pay(Request $request,$id){
        $ticket = Tiket::where('id_tiket',$id)->first();
        $namaTiket = $ticket->nama;
        $hiddenTotal = $request->input('hiddenTotal');
        $hiddenPromo = $request->input('hiddenPromo');
        $ctr = Pembelian::count()+1;
        $numberWithLeadingZeros = str_pad($ctr, 3, '0', STR_PAD_LEFT); //beri leading zero sebanyak 3. misal 1 jadi 001
        $newId = 'INV'.$numberWithLeadingZeros; //buat refferal dengan format REF+numberleadingzeros
        $order = Pembelian::create([
            'id_invoice'=>$newId,
            'id_pembeli'=>session('user')->id_pembeli,
            'id_kodepromo'=>$request->input('promoCode'),
            'id_tiket'=>$id,
            'tanggal_pembelian'=>Carbon::now(),
            'quantity'=>$request->input('hiddenQty'),
            'harga_beli'=>$ticket->harga,
            'total'=>$hiddenTotal,
        ]);
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => session('user')->username,
                'email' => session('user')->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        return view('cobaCheckout',compact('snapToken','order','namaTiket'));
    }

    public function checkout($id){
        $title = "Checkout";
        $ticket = Tiket::where('id_tiket',$id)->first(); //kalo pake get() dapatnya bentuk array[]
        //ambil kode promo yang tersedia
        $promos = Promo::where('id_penjual',$ticket->id_penjual)->where('status',1)->get(); //array
        $date = ""; //kalo place tidak ada startDatenya
        if($ticket->kategori == "seminar"){
            $date = $ticket->start_date;
        }
        return view('checkout',compact('title','ticket','date','promos'));
    }

    public function apply(Request $request,$id){
        $promoEntered = $request->input('promo'); //promo code yang dimasukkan user
        $ticket = Tiket::where('id_tiket',$id)->first(); //kalo pake get() dapatnya bentuk array[]
        //ambil kode promo yang tersedia
        $promos = Promo::where('id_penjual',$ticket->id_penjual)->where('status',1)->get(); //array
        //validasi kode promo yang dimasukkan
        $ketemu=false;
        $tempPromo = [];
        foreach ($promos as $p) {
            if ($p->kode_promo == $promoEntered) {
                $ketemu=true;
                array_push($tempPromo,$p);
                break;
            }
        }
        $nilaiPotongan=0;
        if (!$ketemu) return redirect()->back()->with('error','Kode promo tidak valid!');
        if($ketemu){
            //cari besaran promo
            if ($tempPromo[0]->tipe == "non"){
                //potongan langsung bukan persen
                // dd('non persen');
                return redirect()->back()->with('message','Kode promo berhasil digunakan')->with('potongan',$tempPromo[0]->nilai_promo)->with('kodepromo',$promoEntered);

            }else{ //potongan persen(belum selesai)

            }
        }
    }
}
