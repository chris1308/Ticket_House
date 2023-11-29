@php
    use Carbon\Carbon;
    $formattedDate = Carbon::createFromFormat('Y-m-d', $penjual->tgl_lahir)->format('d-F-Y');
    $dob = Carbon::parse($penjual->tgl_lahir); //calculate age
    $age = $dob->age;
@endphp
@if (session('admin') == "admin")
{{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
        <div class="container" style="overflow:hidden; min-height: 650px; padding-top:80px; margin-left: 280px;">
            <div class="row mb-3">
                <div class="col-md-9">
                    <h1 class="">Informasi Penjual</h1>
                </div>
            </div>
            <div class="shadow bg-light" style="width:45% ;border-radius: 10px; padding:35px 30px;">
                <p class=""><span class="fw-bold">Nama Penjual : </span>{{ $penjual->name }}</p>
                <p class=""><span class="fw-bold">Jenis Kelamin : </span>{{ $penjual->jk == "L" ? "Laki-laki" : "Perempuan" }}</p>
                <p class=""><span class="fw-bold">Tanggal Lahir : </span>{{ $formattedDate }}</p>
                <p class=""><span class="fw-bold">Umur : </span>{{ $age }}</p>
                <p class=""><span class="fw-bold">Email : </span>{{ $penjual->email }}</p>
                <p class=""><span class="fw-bold">Nomor Telepon : </span>{{ $penjual->no_telp }}</p>
                <p class=""><span class="fw-bold">Status Membership : </span>{{ $penjual->premium_status == 0 ? 'Basic' : 'Premium' }}</p>
            </div>
        </div>
    @endsection
@else
    {{-- redirect to admin login page if hasn't logged in --}}
    <script>window.location = "{{ route('login.admin') }}";</script>
@endif

