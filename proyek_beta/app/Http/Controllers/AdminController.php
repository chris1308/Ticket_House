<?php

namespace App\Http\Controllers;
use App\Models\Pembeli;
use App\Models\Penjual;
use App\Models\Tiket;
use App\Models\View;
use App\Models\Pembelian;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Barryvdh\DomPDF\Facade\Pdf; //untuk export pdf
use Maatwebsite\Excel\Facades\Excel; //untuk export excel
class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function exportexcel($id){
        if($id==1){
            //laporan penjual
        }
    }
    public function kunjunganReport(){
        $kunjungans = View::all();
        $title = "Laporan Kunjungan";
        return view('kunjunganReport',compact('title','kunjungans'));
    }
    public function transaksiReport(){
        $transaksis = Pembelian::where('status','berhasil')->get();
        $sortedTrans = $transaksis->sortBy('tanggal_pembelian'); //sort tanggal ascending
        $groupedTrans= $sortedTrans->groupBy(function($trans){
            return $trans->tanggal_pembelian;
        });
        // dd($groupedTrans);
        $tempTrans = [];
        foreach($groupedTrans as $transDate => $transPerDate){
            $tanggal = $transDate;
            $jumlah_transaksi = count($transPerDate);
            $total_nominal = 0;
            foreach($transPerDate as $t){
                $total_nominal+=$t->total;
            }
            $tempData = [
                'tanggal'=>$tanggal,
                'jumlah'=>$jumlah_transaksi,
                'total'=>$total_nominal,
            ];
            array_push($tempTrans,$tempData);
        }
        $title = "Laporan Transaksi";
        return view('transaksiReport',compact('title','tempTrans'));
    }
    public function sellerDetail($id){
        $title = "Informasi Penjual";
        $penjual = Penjual::where('id_penjual',$id)->first();
        return view('sellerDetail',compact('title','penjual'));
    }
    
    public function sellerReport(){
        $title = "Laporan Penjual";
        $penjuals = Penjual::all();
        return view('sellerReport',compact('title','penjuals'));
    }
    public function ticketReport(){
        $title = "Laporan Tiket";
        $tickets = Tiket::all();
        return view('ticketReport',compact('title','tickets'));
    }
    public function ticketReportDetail($id){
        $title = "Informasi Tiket";
        $ticket = Tiket::where('id_tiket',$id)->first();
        return view('ticketreportDetail',compact('title','ticket'));
    }
    public function buyerDetail($id){
        $title = "Informasi Pembeli";
        $pembeli = Pembeli::where('id_pembeli',$id)->first();
        return view('buyerDetail',compact('title','pembeli'));
    }

    public function buyerReport(){
        $title = "Laporan Pembeli";
        $pembelis = Pembeli::all();
        return view('buyerReport',compact('title','pembelis'));
    }
    public function login(){
        return view('adminLogin',[
            "title" => "Admin Login"
        ]);
    }
    
    protected function attemptLogin(Request $request) //method from use ...\AuthenticateUsers
    {
        $loginField = $request->input('login'); //get input with the name 'login'
        $password = $request->input('password');


        if ($loginField && $password){
            if ($loginField === 'admin' && $password === 'admin') {
                // Authentication successful
                // $request->session()->regenerate();
                // session(["user"=>$seller]);
                session(["admin"=>"admin"]);
                return redirect()->intended('/adminDashboard'); //intended untuk dioper ke middleware dulu sebelum redirect
                }
       
        }
        // Authentication failed, flash an error message
        return back()->with("loginError","Login gagal!");
    }

    public function logout(Request $request)
    {
        auth()->check();
        // admin attempting to log out

        auth()->logout();
        // Auth::logout();
        // Session::flush();
        $request->session()->forget('admin');
        // $request->session()->regenerateToken();
        
        return redirect('/adminLogin');
    }

    public function show(){
        //show dashboard admin
        $title = "Admin Dashboard";
        $totalPembeli = Pembeli::all()->count();
        $totalPenjual = Penjual::all()->count();
        $totalTiket = Tiket::all()->count();
        $totalPembelian = Pembelian::all()->count(); //total transaction
        $allTickets = Tiket::all();
        $totalView = 0;
        foreach ($allTickets as $ticket) {
            $totalView+=$ticket->jumlah_view;
        }
        return view('adminDashboard',compact('title','totalPembeli','totalPenjual','totalTiket','totalPembelian','totalView'));
    }

    public function showAddMasterPromo(){
        return view('addMasterPromo', [
            "title" => "Tambah Master Promo",
        ]);
    }
}

