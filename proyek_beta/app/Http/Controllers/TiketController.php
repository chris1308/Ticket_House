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
        return view('ticketDetail', ['ticket' => $ticket, 'title'=>'Detail Ticket', 'seller'=>$seller, "id"=>$id]);
    }

    public function search(Request $request){
        $keyword = $request->input('keyword');

        if(!$keyword){
            return redirect()->route("home");
        }

        $tiket = Tiket::where('nama','LIKE', '%'.$keyword.'%')->get();

        return view('searchResult')->with(['result' => $tiket, 'title' => 'Search result']);
    }

    //function untuk mengukur jarak radius antara dua titik

    public function nearMe(Request $request){
        function haversineDistance($lat1, $lon1, $lat2, $lon2, $unit = 'km') {
            $R = ($unit === 'km') ? 6371 : 3959; // Radius of the Earth in kilometers or miles
        
            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lon2 - $lon1);
        
            $a = sin($dLat / 2) * sin($dLat / 2) +
                 cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
                 sin($dLon / 2) * sin($dLon / 2);
        
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
            $distance = $R * $c;
        
            return $distance;
        }


        $longitude = floatval($request->input('long')); //longitude user
        $latitude = floatval($request->input('lat')); //latitude user
        
        if(!$latitude || !$longitude){
            return redirect()->route("home");
        }

        $semuaTiket = Tiket::get();
        $tiketNearme = [];

        foreach($semuaTiket as $tiket){
            $lat_lokasi_tiket = floatval($tiket->lokasi_lat); //latitude tiket
            $long_lokasi_tiket = floatval($tiket->lokasi_long); //longitude tiket

            $distance = haversineDistance($latitude, $longitude, $lat_lokasi_tiket, $long_lokasi_tiket);
            $isNear = ($distance <= 4);//cari tiket yang lokasinya ada di radius < 4km
            if($isNear){
                array_push($tiketNearme, $tiket);//push data tiket near me untuk ditampilkan ke view
            }
        }

        return view('nearMe')->with(['result' => $tiketNearme, 'title' => 'Near Me']);
    }

    public function showAdd(){
        //show add ticket page
        return view('addTiket',[
            "title" => "Tambah Tiket",
        ]);
    }

    public function saveAdd(Request $request){
        // $keyword = $request->input('keyword');
        $rules = [
            'namaTiket' => 'required|string|max:255',
            'kategori' => 'required|in:place,seminar',
            'deskripsi' => 'required|string',
            'harga'=> 'required|integer',
            'stok'=> 'required|integer',
            'kota'=> 'required',
            'lokasi'=> 'required|string',
        ];
        $request->validate($rules);

        //generate new ID
        $ctr = Tiket::count()+1; //hitung ada berapa pembeli di DB +1
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
        
        Tiket::create([
            'id_tiket' => $tiketID,
            'id_penjual' => "PJ001",
            'nama' => $request->input('namaTiket'),
            'harga' => $request->input('harga'),
            'quantity' => $request->input('stok'),
            'kota' => $request->input('kota'),
            'alamat_lokasi' => $request->input('lokasi'),
            'lokasi_lat' => $lat,
            'lokasi_long' => $long,
            'gambar'=>json_encode(['seminar1.jpg']),
            'jumlah_view'=>0,
            'status'=>1,
            'deskripsi'=> $request->input('deskripsi'),
            'kategori'=> $request->input('kategori'),
            'start_date' => "2023/01/01",
            'start_time' => "12:30",
            'end_time' => "15:30",

        ]);
        //sementara redirect ke dashbord setelah add
        return redirect('/dashboard');
    }

}
