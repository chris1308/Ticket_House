<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Penjual;
use App\Models\Promo;
use App\Models\Report;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function showMasterAddPenjual(){
        return view('masterAddPenjual',[
            "title" => "Add Penjual",
        ]);
    }

    public function saveMasterAddPenjual(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'telepon' => 'required|string',
            'gender'=> 'required',
            'password'=> 'required|string|confirmed',
            'dob'=> 'required',
        ];

        $rules['email'] = [
            'required',
            'string',
            'email:dns',
            'max:255',
            Rule::unique('penjuals'), // Ensure email is unique
        ];
        $rules['username'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('penjuals'), //Ensure username is unique
        ];

        $request->validate($rules);

        $ctr = Penjual::count()+1; //hitung ada berapa penjual di DB +1
        $numberWithLeadingZeros = str_pad($ctr, 3, '0', STR_PAD_LEFT);
        $newId = "PJ".$numberWithLeadingZeros;

        Penjual::create([
            'id_penjual' => $newId,
            'username'=> $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_telp' => $request->input('telepon'),
            'jk' => $request->input('gender'),
            'password' => bcrypt($request->input('password')),
            'profile_picture'=>null,
            'tgl_lahir'=> $request->input('dob'),
        ]);

        return redirect('/admin/master/penjual');
    }

    public function showMasterDetailPenjual($id){
        $penjual = Penjual::where('id_penjual', $id)->first();
        return view('masterDetailPenjual',[
            "title" => "Detail Penjual",
            "penjual" => $penjual
        ]);
    }

    public function changeStatusPenjual($id){
        $penjual = Penjual::where('id_penjual', $id)->first();
        $newStatus = 0;

        //toggle status
        if($penjual->status == 0){//if old status was banned
            $newStatus = 1;
        }else{
            $newStatus = 0;
        }

        Penjual::where('id_penjual', $id)->update(['status' => $newStatus]);

        return redirect("/admin/master/penjual")->with("message", "Penjual status changed successfully");
    }

    //PEMBELI
    public function showMasterAddPembeli(){
        return view('masterAddPembeli',[
            "title" => "Add Pembeli",
        ]);
    }

    public function saveMasterAddPembeli(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'telepon' => 'required|string',
            'gender'=> 'required',
            'password'=> 'required|string|confirmed',
            'dob'=> 'required',
        ];

        $rules['email'] = [
            'required',
            'string',
            'email:dns',
            'max:255',
            Rule::unique('pembelis'), // Ensure email is unique
        ];
        $rules['username'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('pembelis'), //Ensure username is unique
        ];

        $request->validate($rules);

        $ctr = Pembeli::count()+1; //hitung ada berapa penjual di DB +1
        $numberWithLeadingZeros = str_pad($ctr, 3, '0', STR_PAD_LEFT);
        $newId = "PJ".$numberWithLeadingZeros;
        $reff = 'REF'.$numberWithLeadingZeros; 

        Pembeli::create([
            'id_pembeli' => $newId,
            'username'=> $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_telp' => $request->input('telepon'),
            'jk' => $request->input('gender'),
            'password' => bcrypt($request->input('password')),
            'profile_picture' => null,
            'tgl_lahir' => $request->input('dob'),
            'refferal' => $reff
        ]);

        return redirect('/admin/master/pembeli');
    }

    public function showMasterDetailPembeli($id){
        $pembeli = Pembeli::where('id_pembeli', $id)->first();
    
        return view('masterDetailPembeli',[
            "title" => "Detail Pembeli",
            "pembeli" => $pembeli
        ]);
    }

    public function changeStatusPembeli($id){
        $pembeli = Pembeli::where('id_pembeli', $id)->first();
        $newStatus = 0;

        //toggle status
        if($pembeli->status == 0){//if old status was banned
            $newStatus = 1;
        }else{
            $newStatus = 0;
        }

        Pembeli::where('id_pembeli', $id)->update(['status' => $newStatus]);

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

    public function showMasterAddPromo(){
        return view('masterAddPromo',[
            "title" => "Add Promo",
        ]);
    }

    public function saveMasterAddPromo(Request $request){
        $limit = 5;
        $rules = [
            'idPenjual' => 'required|string',
            'kodePromo' => 'required|string|max:255',
            'nilaiPromo' => 'required|integer',
            'tipePromo' => 'required|in:persen,nonpersen',
            'minPurchase' => 'required|integer'
        ];
        $request->validate($rules);

        //Cek
        $cek = Penjual::where('id_penjual', $request->input("idPenjual"))->get();

        if(count($cek) == 0){
            return redirect()->back()->with('error', 'ID Penjual tidak valid!');
        }

        //generate new ID Promo
        $ctr = Promo::count()+1;
        $numberWithLeadingZeros = str_pad($ctr, 3, '0', STR_PAD_LEFT);
        $promoID = 'PMO'.$numberWithLeadingZeros;

        //-------------------------------

        Promo::create([
            'id_kodepromo' => $promoID,
            'id_penjual' => $request->input('idPenjual'),
            'kode_promo' => $request->input('kodePromo'),
            'nilai_promo' => $request->input('nilaiPromo'),
            'tipe' => $request->input('tipePromo'),
            'min_purchase' => $request->input('minPurchase'),
            'status' => 1
        ]);
        //redirect setelah berhasil add dengan pesan
        return redirect()->back()->with('message', 'Successfully added new promo!');
    }

    public function deleteMasterPromo($id){
        $promo = Promo::where('id_kodepromo', $id)->first();
        $newStatus = 0;

        if($promo->status == 0){
            $newStatus = 1;
        }
        else{
            $newStatus = 0;
        }

        Promo::where('id_kodepromo', $id)->update(['status' => $newStatus]);

        return redirect("admin/master/promo");
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


    public function deleteMasterTiket($id){
        $tiket = Tiket::where('id_tiket', $id)->first();
        $newStatus = 0;

        //toggle status
        if($tiket->status == 0){//if old status was banned
            $newStatus = 1;
        }else{
            $newStatus = 0;
        }

        Tiket::where('id_tiket', $id)->update(['status' => $newStatus]);

        return redirect("/admin/master/tiket");
    }

    //AKTIVITAS

    public function showMasterAddAktivitas(){
        $daftarPembeli = Pembeli::all();
        $daftarPenjual = Penjual::all();
        return view("masterAddAktivitas", [
            "title"=>"Add Aktivitas",
            "daftarPembeli"=>$daftarPembeli,
            "daftarPenjual"=>$daftarPenjual
        ]);
    }

    public function saveMasterAddAktivitas(Request $request){
        
        $rules = [
            'idTerlapor' => 'required|string|max:6',
            'idPelapor' => 'required|string|max:6',
            'deskripsi' => 'required|string',
        ];

        $request->validate($rules);

        $ctr = Report::count()+1;
        $numberWithLeadingZeros = str_pad($ctr, 3, '0', STR_PAD_LEFT); //beri leading zero sebanyak 3. misal 1 jadi 001
        $newActivityId = "RP".$numberWithLeadingZeros;
        
        Report::create([
            'id_aktivitas'=>$newActivityId,
            'id_penjual'=>$request->input('idTerlapor'),
            'id_pembeli'=>$request->input('idPelapor'),
            'keterangan'=>$request->input('deskripsi'),
        ]);

        return redirect("/admin/master/aktivitas");
    }
    
    public function showMasterDetailAktivitas($id){
        $aktivitas = Report::with(['penjual', 'pembeli'])->where('id_aktivitas', $id)->first();
        return view("masterDetailAktivitas", [
            "title" => "Detail Aktivitas",
            "aktivitas" => $aktivitas
        ]);
    }

    public function deleteMasterAktivitas($id){
        $aktivitas = Report::where('id_aktivitas', $id)->first();
        // Report::destroy($id); //this code can't worked
        
        Report::where('id_aktivitas', $id)->delete();

        return redirect("/admin/master/aktivitas");

        // this code can't delete
        // if ($aktivitas) {
        //     $aktivitas->delete();
        //     return redirect("/admin/master/aktivitas");
        // }else {//not found
        //     return redirect("/admin/master/aktivitas");
        // }
    }

}
