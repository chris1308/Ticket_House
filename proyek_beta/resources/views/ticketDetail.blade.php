<?php
    function formatUang($inputan){
        $hasil = "";
        $ctr = 0; 
        for ($i=strlen($inputan)-1; $i >= 0; $i--) {
          if($ctr < 3){
            $hasil.= substr($inputan, $i, 1);
            $ctr = $ctr+1;
          }
      
          if($ctr == 3){
            if($i != 0){
              $hasil.=".";
            }
            $ctr = 0;
          }
        }
      
        $hasilFlip = "";
        for ($i=strlen($hasil)-1; $i >=0 ; $i--) { 
          $hasilFlip.=substr($hasil, $i, 1);
        }
      
        return $hasilFlip;
    }
?>

@extends('layouts.main')
@section('content')
    {{-- @dd($seller); --}}
    <div class="container d-flex justify-content-between" style="height: 850px; padding-top:130px;">
        <div class="kiri">
            <a href="/home" class="text-decoration-none" style="font-size: 18px">< Back</a><br><br>
            <div class="">
                <div class="BagianSatu " style="display:flex;justify-content: space-between">
                    <div class="kiri" >
                        <h2>{{ $ticket->nama }}</h2>
                        <p>oleh <span style="font-size: 20px" class="fw-bold">{{ $seller->name }}</span></p>
                        <p><i class="fa-solid fa-location-dot fa-lg"></i>&nbsp; {{ $ticket->alamat_lokasi }}, {{ $ticket->kota }}</p>

                    </div>
                    <div class="kanan pt-2 d-flex" >
                        <span>
                            <form action="{{ route('add.wishlist', ['id' => $id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary me-2" type="submit">Add to Wishlist</button>
                            </form>
                        </span>
                        <span>
                            <a href="#" class="btn btn-danger me-2">Laporkan Penjual</a>
                        </span>
                        <span id="shareButton" class="shareButton">
                            <i class="fa-solid fa-share-nodes fa-2xl"></i>
                        </span>
                    </div>
                </div>
                <div class="BagianDua">
                    <div class="gambarMap" style="margin-left:25px ;width: 775px; height:200px">
                        <img class="w-100 h-100" src="/images/graybackground.png" alt="">
                    </div><br>
                    <p><i class="fa-solid fa-clock fa-lg"></i>&nbsp;{{date('D-M-Y',strtotime($ticket->start_date) )  }} {{ $ticket->start_time }} - {{ $ticket->end_time }} WIB</p>
                    <form action="" style="margin-left: 25px">
                        <input type="text" name="" id="" size="50" placeholder="Dari IDR {{ formatUang($ticket->harga) }}" disabled>
                        <button class=" ms-2 btn btn-success">Beli Tiket</button>
                    </form>
                </div><br>
                <div class="BagianTiga">
                    <p style="font-size: 20px; font-weight:bold;">Deskripsi</p>
                    <p>{{ $ticket->deskripsi }}</p>
                </div>
            </div>
        </div>
        <div class="kanan">
            <div class="Gambar" style="width: 250px; height:260px;">                    
                <img style="object-fit: cover; border-radius:5%;" class="w-100 h-100" src="/images/{{ json_decode($ticket->gambar)[0] }}" alt="">          
            </div>   
        </div>
    </div>
<script src="{{ asset('js/share.js') }}"></script>
@endsection