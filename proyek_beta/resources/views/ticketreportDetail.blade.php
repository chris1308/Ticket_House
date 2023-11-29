@php
    use Carbon\Carbon;
    $formattedDate = "";
    if($ticket->start_date !=null){
        $formattedDate = Carbon::createFromFormat('Y-m-d', $ticket->start_date)->format('d-F-Y');
    }
@endphp
@if (session('admin') == "admin")
{{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
        <div class="container" style="overflow:hidden; min-height: 650px; padding-top:80px; margin-left: 280px;">
            <div class="row mb-3">
                <div class="col-md-9">
                    <h1 class="">Informasi Tiket</h1>
                </div>
            </div>
            <div class="shadow bg-light" style="width:45% ;border-radius: 10px; padding:35px 30px;">
                <p class=""><span class="fw-bold">Nama Tiket : </span>{{ $ticket->nama }}</p>
                <p class=""><span class="fw-bold">Deskripsi : </span>{{ $ticket->deskripsi }}</p>
                <p class=""><span class="fw-bold">Kategori : </span>{{ $ticket->kategori }}</p>
                @if ($formattedDate!="")                
                    <p class=""><span class="fw-bold">Tanggal Acara: </span>{{ $formattedDate }}</p>
                @endif
                <p class=""><span class="fw-bold">Jam : </span>{{ $ticket->start_time }} - {{ $ticket->end_time }} WIB</p>
            </div>
        </div>
    @endsection
@else
    {{-- redirect to admin login page if hasn't logged in --}}
    <script>window.location = "{{ route('login.admin') }}";</script>
@endif

