@if (session('admin') == "admin")
{{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
    <div class="container" style="overflow:hidden; height: 650px; padding-top:80px; margin-left: 280px;">
            <div class="row">
            <div class="col-md-9">
                <h1 class="">Dashboard</h1>
                <div class="Statistik text-center mt-3 mb-5" style="font-size: 25px; background-color: rgb(160, 251, 160); width:850px; min-height:300px;">
                    <div class="Baris1 pt-5 d-flex justify-content-evenly" style="">
                        <div class="Kiri ps-3">
                            <p class="fw-bold">Jumlah Transaksi</p>
                            <p>{{ $totalPembelian }}</p>
                        </div>
                        <div class="Tengah">
                            <p class="fw-bold">Jumlah Tiket</p>
                            <p>{{ $totalTiket }}</p>
                        </div>
                        <div class="Kanan pe-4">
                            <p class="fw-bold">Total View</p>
                            <p>{{ $totalView }}</p>
                        </div>
                    </div>
                    <div class="Baris2  mt-4 d-flex justify-content-evenly">
                        <div class="Kiri ps-3">
                            <p class="fw-bold">Jumlah Pembeli</p>
                            <p>{{ $totalPembeli }}</p>
                        </div>
                        <div class="Kanan pe-3">
                            <p class="fw-bold">Jumlah Penjual</p>
                            <p>{{ $totalPenjual }}</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    @endsection
@else
    {{-- redirect to admin login page if hasn't logged in --}}
    <script>window.location = "{{ route('login.admin') }}";</script>
@endif

