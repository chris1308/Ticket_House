@extends('layouts.adminMain')
@section('content')
    <div class="container-fluid" style="height: 100%; padding-top: 90px;">
        <div class="row">
            <!-- Page Kiri -->
            <div class="col-md-3" style="background-color: #F1F8FF; height: 100%;">
                <div class="mb-4">
                    <a href="/adminDashboard" class="fw-bold nav-link text-dark text-decoration-none">Home</a>
                </div>
                <div class="mb-4" style="background-color: #FD9191;">
                    <p class="fw-bold text-white">Masters</p>
                </div>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Penjual</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Pembeli</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Tiket</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Aktivitas</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Promo</a>
                    </li>
                </ul>
                <div style="background-color: #FD9191;">
                    <p class="fw-bold text-white">Laporan</p>
                </div>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Penjual</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Pembeli</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Tiket</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Kunjungan</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="fw-bold nav-link text-dark text-decoration-none">Transaksi</a>
                    </li>
                </ul>
            </div>

            <!-- Page Kanan -->
            <div class="col-md-9">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
@endsection