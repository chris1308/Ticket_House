@php
    use Carbon\Carbon;
    $formattedDate = Carbon::createFromFormat('Y-m-d', $pembeli->tgl_lahir)->format('d-F-Y');
    $dob = Carbon::parse($pembeli->tgl_lahir); //calculate age
    $age = $dob->age;
@endphp
@if (session('admin') == "admin")
{{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
        <div class="container" style="overflow:hidden; min-height: 650px; padding-top:80px; margin-left: 280px;">
            <div class="row mb-3">
                <div class="col-md-9">
                    <h1 class="">Informasi Pembeli</h1>
                </div>
            </div>
            <div class="shadow bg-light" style="width:45% ;border-radius: 10px; padding:35px 30px;">
                <p class=""><span class="fw-bold">Nama Pembeli : </span>{{ $pembeli->name }}</p>
                <p class=""><span class="fw-bold">Jenis Kelamin : </span>{{ $pembeli->jk == "L" ? "Laki-laki" : "Perempuan" }}</p>
                <p class=""><span class="fw-bold">Tanggal Lahir : </span>{{ $formattedDate }}</p>
                <p class=""><span class="fw-bold">Umur : </span>{{ $age }}</p>
                <p class=""><span class="fw-bold">Email : </span>{{ $pembeli->email }}</p>
                <p class=""><span class="fw-bold">Kode Refferal : </span>{{ $pembeli->refferal }}</p>
                <p class=""><span class="fw-bold">Nomor Telepon : </span>{{ $pembeli->no_telp }}</p>
            </div>
        </div>
    @endsection
@else
    {{-- redirect to admin login page if hasn't logged in --}}
    <script>window.location = "{{ route('login.admin') }}";</script>
@endif

