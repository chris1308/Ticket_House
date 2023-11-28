<!-- belum selesai -->
@if (session('admin') == "admin")
<!-- {{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}} -->
    @extends('layouts.adminMain')
    @section('content')
    <div class="container" style="min-height: 650px; padding-top:80px; padding-left: 18%;">
        <!-- bagian atas -->
        <div class="row d-flex justify-content-between">
            <div class="col-md-6">
                <h1 class="" style="">Master Pembeli</h1>
            </div>
            <div class="col-md-4 d-flex justify-content-end align-items-center">
                <button class="border-0 rounded-3 p-2" style="background-color: #FDE1A9; height: 70%;">Tambah Pembeli Baru</button>
            </div>
        </div>

        <!-- table -->
        <table class="table table-striped mt-4" style="width: 100%">
            <thead>
                <!-- <tr> -->
                    <th class="px-2 text-center" style="width: 5%">No</th>
                    <th class="px-2" style="width: 5%">ID</th>
                    <th class="px-2" style="width: 13%;">Nama</th>
                    <th class="px-2" style="width: 13%;">Username</th>
                    <th class="px-2" style="width: 13%;">Kontak</th>
                    <th class="px-2" style="width: 13%;">Email</th>
                    <th class="px-2" style="width: 13%;">Status</th>
                    <th class="px-2" style="width: 15%;">Action</th>
                <!-- </tr> -->
            </thead>
            <tbody>
                @foreach($daftarPembeli as $index => $pembeli)
                    <tr>
                        <td class="text-center">{{$index + 1}}</td>
                        <td>{{$pembeli->id_pembeli}}</td>
                        <td>{{$pembeli->name}}</td>
                        <td>{{$pembeli->username}}</td>
                        <td>{{$pembeli->no_telp}}</td>
                        <td>{{$pembeli->email}}</td>
                        <td class="{{($pembeli->status == 0) ? 'text-danger' : ''}}">{{($pembeli->status == 1 ? "Aktif" : "Banned")}}</td>
                        <td>
                            <a href="/admin/master/pembeli/{{$pembeli->id_pembeli}}/detail" style="text-decoration: none;">
                                <button class="btn btn-info d-flex align-items-center" style="height: 30px;">Lihat Detail</button>
                            </a>
                        </td>
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

