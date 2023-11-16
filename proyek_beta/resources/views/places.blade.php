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

<div class="Places container" style="padding-top:100px; ">
    <h1>Places</h1><br>
    <div class="row pb-5">
        @foreach($places as $place)
            <div onclick="redirectToDetail('{{ route('ticket.detail', ['id' => $place->id_tiket]) }}')" class="col-sm-6 col-md-4 col-lg-3 rounded-3 p-3 mb-3" style="height: 250px;">
                <div class="gbr" style="height: 85%;">
                    <img class="img rounded-3 w-100 h-100" src="images/{{json_decode($place->gambar)[0]}}" alt="{{$place->nama}}" style="object-fit: cover;">
                </div>
                <div class="fw-bold">{{ $place->nama }}</div>
                <div>IDR {{formatUang($place->harga)}}</div>
            </div>    
        @endforeach
    </div>
</div>
<script>
    // Function to redirect to the detail page 
    function redirectToDetail(detailUrl) {
        //we need this because we use div onclick that doesnt have href attribute
        //if we use an <a></a> instead, we dont need this
        // Update the window location to the detail page URL
        window.location.href = detailUrl;
    }
</script>
@endsection
