@if (session('admin') == "admin")
{{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
    <div class="container" style="overflow:hidden; height: 650px; padding-top:80px; margin-left: 280px;">
            <div class="row" id="statistik">
            <div class="col-md-9">
                <h1 class="mb-5">Dashboard</h1>
                <div class="row d-flex justify-content-between mb-4" id="rowSatu">
                    <div class="col-md-3 text-center mx-4 p-2 rounded-4 shadow" style="background-color: rgb(160, 251, 160);">
                        <p class="fw-bold fs-5">Jumlah Transaksi</p>
                        <p class="fs-5">{{ $totalPembelian }}</p>
                    </div>
                    <div class="col-md-3 text-center mx-4 p-2 rounded-4 shadow" style="background-color: rgb(160, 251, 160);">
                        <p class="fw-bold fs-5">Jumlah Tiket</p>
                        <p class="fs-5">{{ $totalTiket }}</p>
                    </div>
                    <div class="col-md-3 text-center mx-4 p-2 rounded-4 shadow" style="background-color: rgb(160, 251, 160);">
                        <p class="fw-bold fs-5">Total View</p>
                        <p class="fs-5">{{ $totalView }}</p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-4" id="rowDua">
                    <div class="col-md-3 text-center mx-4 p-2 rounded-4 shadow" style="background-color: rgb(160, 251, 160);">
                        <p class="fw-bold fs-5">Jumlah Pembeli</p>
                        <p class="fs-5">{{ $totalPembeli }}</p>
                    </div>
                    <div class="col-md-3 text-center mx-4 p-2 rounded-4 shadow" style="background-color: rgb(160, 251, 160);">
                        <p class="fw-bold fs-5">Jumlah Penjual</p>
                        <p class="fs-5">{{ $totalPenjual }}</p>
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

