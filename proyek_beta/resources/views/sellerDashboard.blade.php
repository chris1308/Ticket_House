@extends('layouts.sellerMain')
@section('content')
    <div class="container" style="height: 650px; padding-top:100px; margin-left: 250px;">
        @if(session('message')) 
            <div style="width: 500px" class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif 
        <h2 class="fw-bold" style="margin-left: 20px;">Dashboard</h2>
        <a href="/addPromo"><button type="button" class="btn" style="width: 200px; height: 40px; background-color: #0C9509; color: white;">Tambah Kode Promo</button></a>
    </div>
@endsection