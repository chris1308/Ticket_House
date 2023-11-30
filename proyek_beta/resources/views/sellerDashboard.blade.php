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
        <a href="/addPromo"><button type="button" class="btn" style="width: 200px; height: 40px; background-color: #0C9509; color: white;">Buat Kode Promo</button></a>
        <div class="Statistik text-center mt-3 mb-5" style="font-size: 25px; width:850px; min-height:300px;">
            <div class="Baris1 d-flex justify-content-center" style="">
                <div class="shadow px-2 py-4" style="border-radius:10px;background-color: rgb(160, 251, 160); width:40%">
                    <p class=" fw-bold" style="">Total Penghasilan</p>
                    <p>Rp. {{ formatUang($totalRevenue) }}</p>
                </div>
            </div>
            <div class="Baris2  mt-4 d-flex justify-content-between">
                <div style="border-radius:10px;background-color: rgb(160, 251, 160); width:40%" class="shadow Kiri py-3 ps-3">
                    <p class="fw-bold">Jumlah Tiket Terjual</p>
                    <p>{{ $ticketSold }}</p>
                </div>
                <div style="background-color: rgb(160, 251, 160); border-radius:10px; width:40%" class="shadow Kanan py-3 pe-3">
                    <p class="fw-bold">Total View Tiket</p>
                    <p>{{ $totalView }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection