@if (session('admin') == "admin")
{{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
        <div class="container" style="overflow:hidden; min-height: 650px; padding-top:80px; margin-left: 280px;">
            <div class="row mb-3">
                <div class="col-md-9">
                    <h1 class="">Laporan Penjual</h1>
                </div>
            </div>
            <table class="table table-light table-striped" style="width:80%;">
                <thead>
                    <tr>
                        <th class="px-2 text-center" style="width:5%">No</th>
                        <th class="px-2 " style="width:7%">ID Penjual</th>
                        <th class="px-2 " style="width:15%">Nama Penjual</th>
                        <th class="px-2 " style="width:15%">Kontak</th>
                        <th class="px-2 " style="width:15%">Email</th>
                        <th class="px-2 " style="width:5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjuals as $idx=>$p) 
                        <tr>
                            <td class="text-center">{{ $idx+1 }}</td>
                            <td class="">{{ $p->id_penjual }}</td>
                            <td class="">{{ $p->name }}</td>
                            <td class="">{{ $p->no_telp }}</td>
                            <td class="">{{ $p->email }}</td>
                            <td class=""><a href="{{ route('seller.detail',['id'=>$p->id_penjual]) }}" class="btn btn-outline-success">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
@else
    {{-- redirect to admin login page if hasn't logged in --}}
    <script>window.location = "{{ route('login.admin') }}";</script>
@endif

