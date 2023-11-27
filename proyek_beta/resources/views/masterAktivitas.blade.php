<!-- belum selesai -->
@if (session('admin') == "admin")
<!-- {{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}} -->
    @extends('layouts.adminMain')
    @section('content')
    <div class="container" style="min-height: 650px; padding-top:80px; padding-left: 18%;">
        <!-- bagian atas -->
        <div class="row d-flex justify-content-between">
            <div class="col-md-6">
                <h1 class="" style="">Master Aktivitas</h1>
            </div>
            <div class="col-md-3 d-flex justify-content-end align-items-center">
                <button class="border-0 rounded-3 p-2" style="background-color: #FDE1A9; height: 70%;">Tambah Report Aktivitas</button>
            </div>
        </div>

        <!-- table -->
        <table class="table table-striped mt-4" style="width: 100%">
            <thead>
                <!-- <tr> -->
                    <th class="px-2 text-center" style="width: 5%">No</th>
                    <th class="px-2" style="width: 5%">ID</th>
                    <th class="px-2" style="width: 13%;">Penjual Terlapor</th>
                    <th class="px-2" style="width: 13%;">Pelapor</th>
                    <th class="px-2" style="width: 8%;">Keterangan</th>
                    <th class="px-2" style="width: 15%;">Action</th>
                <!-- </tr> -->
            </thead>
            <tbody>
                @foreach($daftarAktivitas as $index => $aktivitas)
                    <tr>
                        <td class="text-center">{{$index + 1}}</td>
                        <td>{{$aktivitas->id_aktivitas}}</td>
                        <td>{{$aktivitas->penjual->name}}</td>
                        <td>{{$aktivitas->pembeli->name}}</td>
                        <td>{{$aktivitas->keterangan}}</td>

                        <td>
                            <button class="btn btn-info d-flex align-items-center" style="height: 30px;">Lihat Detail</button>
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

