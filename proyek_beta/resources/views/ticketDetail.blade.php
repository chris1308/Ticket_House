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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Report this ticket</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="myModalForm" action="{{ route('submit.report',['id'=>$ticket->id_penjual]) }}" method="post">
                @csrf
                <div class="mb-3">
                  <label for="message-text" class="col-form-label">Message:</label>
                  <textarea name="reportText" class="form-control" id="message-text"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" >Submit Report</button>
            </form>
        </div>
      </div>
    </div>
  </div>
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
                            <a href="{{ route('tickets.reminder',['id' => $id]) }}" class="btn btn-warning me-2"><i class="fa-solid fa-calendar fa-lg"></i>&nbsp;Set Reminder</a>
                        </span>
                        <span>
                            <form action="{{ route('add.wishlist', ['id' => $id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary me-2" type="submit">Add to Wishlist</button>
                            </form>
                        </span>
                        <span>                            
                            <button type="button" id="myBtn"  data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-danger me-2">Report</button>
                        </span>
                        <span id="shareButton" class="shareButton">
                            <i class="fa-solid fa-share-nodes fa-2xl"></i>
                        </span>
                    </div>
                </div>
                <div class="BagianDua">
                    <div class="gambarMap" id="gambarMap" style="margin-left:25px ;width: 775px; height:200px">
                        <!-- <img class="w-100 h-100" src="/images/graybackground.png" alt=""> -->
                    </div><br>
                    @if ($ticket->start_date != null)
                        <p><i class="fa-solid fa-clock fa-lg"></i>&nbsp;{{date('D-M-Y',strtotime($ticket->start_date) )  }} {{ $ticket->start_time }} - {{ $ticket->end_time }} WIB</p>                        
                    @else
                        <p><i class="fa-solid fa-clock fa-lg"></i>&nbsp;Jam Operasional : {{ $ticket->start_time }} - {{ $ticket->end_time }} WIB</p>  
                    @endif
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
        {{-- modal --}}
    </div>
    <script src="{{ asset('js/share.js') }}"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>
    <script>

        //function untuk load map HERE
        function loadHereMaps() {
            let script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://js.api.here.com/v3/3.1/mapsjs-core.js';
            document.body.appendChild(script);

            script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://js.api.here.com/v3/3.1/mapsjs-service.js';
            document.body.appendChild(script);

            script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://js.api.here.com/v3/3.1/mapsjs-mapevents.js';
            document.body.appendChild(script);

            script.onload = function () {
                let latitude = <?php echo json_encode($ticket->lokasi_lat); ?>;
                let longitude = <?php echo json_encode($ticket->lokasi_long); ?>;
                let platform = new H.service.Platform({
                    apikey: '1DvppUVi__lz1FhPrVsRjXlo92_CDUDCBgPkikH4xd4'
                });

                let defaultLayers = platform.createDefaultLayers();

                let map = new H.Map(
                document.getElementById('gambarMap'),
                defaultLayers.vector.normal.map,
                    {
                        center: { lat: latitude, lng: longitude },
                        zoom: 14,
                        pixelRatio: window.devicePixelRatio || 1
                    }
                );

                let behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

                const marker = new H.map.Marker({ lat: latitude, lng: longitude });
                map.addObject(marker);

                marker.addEventListener('tap', function (evt) {
                    alert('Marker clicked!'); // You can replace this with your custom logic
                });
            };
        }

        window.onload = loadHereMaps;

    </script>
@endsection