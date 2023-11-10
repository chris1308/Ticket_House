@extends('layouts.main')
@section('content')

<div class="Places container" style="padding-top:60px; ">
    <h1>Places</h1><br>
    <div class="row pb-5">
        @foreach($places as $place)
            <div class="col-sm-6 col-md-4 col-lg-3 rounded-3 p-3 mb-3" style="height: 250px;">
                <div class="gbr" style="height: 85%;">
                    <img class="img rounded-3 w-100 h-100" src="images/{{json_decode($place->gambar)[0]}}" alt="{{$place->nama}}" style="object-fit: cover;">
                </div>
                <div class="fw-bold">{{ $place->nama }}</div>
                <div>From IDR {{substr_replace($place->harga, 'K', strlen($place->harga)-3)}}</div>
            </div>    
        @endforeach
    </div>
</div>

@endsection
