<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Penjual;
use App\Models\Promo;
use App\Models\Report;
use App\Models\Tiket;
use Illuminate\Http\Request;

class AdminMasterController extends Controller
{
    //
    public function showMasterPenjual(){
        $penjual = Penjual::all();
        return view('masterPenjual',[
            "title" => "Master Penjual",
            "daftarPenjual" => $penjual
        ]);
    }


    public function showMasterPembeli(){
        $pembeli = Pembeli::all();
        return view('masterPembeli',[
            "title" => "Master Pembeli",
            "daftarPembeli" => $pembeli
        ]);
    }

    public function showMasterTiket(){
        $tiket = Tiket::with(['penjual'])->get();
        // $tiket = Tiket::all();
        // $tiket->load('penjual:name');
        return view('masterTiket',[
            "title" => "Master Tiket",
            "daftarTiket" => $tiket
        ]);
    }

    public function showMasterPromo(){
        $promo = Promo::with(['penjual'])->get();
        // $tiket = Tiket::all();
        // $tiket->load('penjual:name');
        return view('masterPromo',[
            "title" => "Master Promo",
            "daftarPromo" => $promo
        ]);
    }

    public function showMasterAktivitas(){
        $aktivitas = Report::with(['penjual', "pembeli"])->get();
        // $tiket = Tiket::all();
        // $tiket->load('penjual:name');
        return view('masterAktivitas',[
            "title" => "Master Aktivitas",
            "daftarAktivitas" => $aktivitas
        ]);
    }

    // ================== Detail Master ================== 


    //PENJUAL
    public function showMasterDetailPenjual($id){
        $penjual = Penjual::where('id_penjual', $id)->first();
        return view('masterDetailPenjual',[
            "title" => "Detail Penjual",
            "penjual" => $penjual
        ]);
    }

    public function changeStatusPenjual($id){
        // $id = $request->input('id');
        $penjual = Penjual::where('id_penjual', $id)->first();
        $newStatus = 0;

        //toggle status
        if($penjual->status == 0){//if old status was banned
            $newStatus = 1;
        }else{
            $newStatus = 0;
        }

        //belum selesai (id masih null terus)
        if($penjual){
            
            $penjual->status = $newStatus;
            $penjual->save();
    
        }else{
            return redirect("/admin/master/pembeli")->with("message", "Penjual not found");
        }
        // $pembeli->update([
        //     'status'=>$newStatus,
        // ]);
        return redirect("/admin/master/penjual")->with("message", "Penjual status changed successfully");
    }

    //PEMBELI
    public function showMasterDetailPembeli($id){
        $pembeli = Pembeli::where('id_pembeli', $id)->first();
    
        return view('masterDetailPembeli',[
            "title" => "Detail Pembeli",
            "pembeli" => $pembeli
        ]);
    }

    public function changeStatusPembeli(Request $request, $idPembeli){
        // $id = $request->input('id');
        $pembeli = Pembeli::where('id_pembeli', $idPembeli)->first();
        $newStatus = 0;

        //toggle status
        if($pembeli->status == 0){//if old status was banned
            $newStatus = 1;
        }else{
            $newStatus = 0;
        }

        //belum selesai (id masih null terus)
        if($pembeli){
            
            $pembeli->status = $newStatus;
            $pembeli->save();

    
        }else{
            return redirect("/admin/master/pembeli")->with("message", "Pembeli not found");
        }
        // $pembeli->update([
        //     'status'=>$newStatus,
        // ]);
        return redirect("/admin/master/pembeli")->with("message", "Pembeli status changed successfully");
    }


    //TIKET

    public function showMasterDetailTiket($id){
        $tiket = Tiket::with(['penjual'])->where('id_tiket', $id)->first();
    
        return view('masterDetailTiket',[
            "title" => "Detail Tiket",
            "tiket" => $tiket
        ]);
    }
}
