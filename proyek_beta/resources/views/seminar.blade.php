@extends('layouts.main')
@section('content')

<div class="Seminar container" style="padding-top:60px; ">
    <h1>Seminar</h1><br>
    <div class="row pb-5">
        @foreach($seminars as $seminar)
            <div class="col-sm-6 col-md-4 col-lg-3 rounded-3 p-3 mb-3" style="height: 250px;">
                <div class="gbr" style="height: 85%;">
                    <img class="img rounded-3 w-100 h-100" src="images/{{json_decode($seminar->gambar)[0]}}" alt="{{$seminar->nama}}" style="object-fit: cover;">
                </div>
                <div class="fw-bold">{{ $seminar->nama }}</div>
                <div>From IDR {{substr_replace($seminar->harga, 'K', strlen($seminar->harga)-3)}}</div>
            </div>    
        @endforeach
    </div>
</div>

@endsection
