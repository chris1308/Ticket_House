<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjual;
use App\Models\Pembelian;
use App\Models\Tiket;
class PenjualController extends Controller
{
    public function upgrade($id){
        Penjual::where('id_penjual',$id)->update(["premium_status"=>1]);
        $penjual = Penjual::where('id_penjual',$id)->first();
        //update session so that the membership status on the sidebar will be updated
        session(['user'=>$penjual]);
        
        return redirect('/dashboard');
    }

    public function show(){
        $title = "Seller Dashboard";
        //count total views of all tickets owned by this seller
        $allTickets = Tiket::where('id_penjual',session('user')->id_penjual)->get();
        $totalView = 0;
        foreach ($allTickets as $ticket) {
            $totalView += $ticket->jumlah_view;
        }
        $totalRevenue = 0;
        $ticketSold = 0;
        $allPurchase = Pembelian::all();
        foreach ($allPurchase as $purchase) {
            foreach ($allTickets as $ticket){
                if ($purchase->id_tiket == $ticket->id_tiket){
                    $totalRevenue  += $purchase->total;
                    $ticketSold += $purchase->quantity;
                    break;
                }
            }
        }
        return view('sellerDashboard',compact('title', 'totalView','totalRevenue','ticketSold'));
    }
}
