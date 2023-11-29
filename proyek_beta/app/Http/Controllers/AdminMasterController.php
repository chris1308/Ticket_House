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

    public function showMasterAddTiket(){
        return view('masterAddTiket',[
            "title" => "Add Tiket",
        ]);
    }

    public function saveMasterAddTiket(Request $request){
        $limit = 5;
        $rules = [
            'namaTiket' => 'required|string|max:255',
            'idPenjual' => 'required|string',
            'kategori' => 'required|in:place,seminar',
            'deskripsi' => 'required|string',
            'harga'=> 'required|integer',
            'stok'=> 'required|integer',
            'kota'=> 'required',
            'lokasi'=> 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images'   => 'required|array|max:'.$limit.',',
            'startDate' => 'date|nullable',
            'startTime' => 'required',
            'endTime' => 'required'
        ];
        
        $tambahan = [
            'images.max' => 'You can upload a maximum of '.$limit.' images.', // Customize the error message
        ];
        $request->validate($rules, $tambahan);

        // $isIdValid = false;
        $cek = Penjual::where('id_penjual', $request->input("idPenjual"))->get();
        
        if(count($cek) == 0){
            return redirect()->back()->with('error', 'ID Penjual tidak valid!');
        }

        //generate new ID
        $ctr = Tiket::count()+1; //hitung ada berapa tiket di DB +1
        $numberWithLeadingZeros = str_pad($ctr, 3, '0', STR_PAD_LEFT); //beri leading zero sebanyak 3. misal 1 jadi 001
        $tiketID = 'TIK'.$numberWithLeadingZeros;

        // Mencari latitude dan longitude dari api HERE maps
        $lat = "";//jika alamat tidak ditemukan dimap isi string kosong
        $long = "";
        $kota = $request->input('kota');
        $lokasi = $request->input('lokasi');

        $data = [
            'q' => $lokasi,
            'apiKey' => '1DvppUVi__lz1FhPrVsRjXlo92_CDUDCBgPkikH4xd4'
        ];
        
        $json = file_get_contents('https://geocode.search.hereapi.com/v1/geocode?' . http_build_query($data));
        // echo "<script>console.log('$json')</script>";
        $result = json_decode($json, true);//encode json jadi array assoc

        //cari posisi latitude dan longitude dari lokasi tiket
        foreach ($result['items'] as $res) {
            if($res['address']['city'] == $kota){
                $lat = $res['position']['lat'];
                $long = $res['position']['lng'];
                break;
            }
        }

        //pengecekan jika lokasi tidak ditemukan dimap beri peringatan
        if($lat == "" || $long == ""){
            return redirect()->back()->with('error', 'Lokasi tidak valid!');
        }

        $gambar = [];
        //insert multiple image
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $imageName = time() . '-' . uniqid() . '.' .$image->getClientOriginalExtension();

                // $image->move(public_path('uploads'), $imageName);
                $image->move(public_path('images'), $imageName);
                array_push($gambar, $imageName);
                
            }

           
        }else{
            return redirect()->back()->with('message', 'No images were selected.');
        }
        
        
        
        Tiket::create([
            'id_tiket' => $tiketID,
            'id_penjual' =>  $request->input('idPenjual'),
            'nama' => $request->input('namaTiket'),
            'harga' => $request->input('harga'),
            'quantity' => $request->input('stok'),
            'kota' => $request->input('kota'),
            'alamat_lokasi' => $request->input('lokasi'),
            'lokasi_lat' => $lat,
            'lokasi_long' => $long,
            'gambar'=>json_encode($gambar),
            'jumlah_view'=>0,
            'status'=>1,
            'deskripsi'=> $request->input('deskripsi'),
            'kategori'=> $request->input('kategori'),
            'start_date' => $request->input('startDate'),
            'start_time' => $request->input('startTime'),
            'end_time' => $request->input('endTime'),

        ]);
        //redirect setelah berhasil add dengan pesan
        return redirect()->back()->with('message','Successfully added new ticket!');
    }
}
