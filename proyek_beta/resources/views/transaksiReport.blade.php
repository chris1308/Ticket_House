@if (session('admin') == "admin")
{{-- layout.adminMain untuk ambil komponen navbar dan sidebar admin --}}
    @extends('layouts.adminMain')
    @section('content')
        <div class="container" style="overflow:hidden; min-height: 650px; padding-top:80px; padding-bottom:50px; margin-left: 280px;">
            <div class="row mb-3">
                <div class="col-md-9">
                    <h1 class="">Laporan Transaksi</h1>
                    <div>
                        <button class="btn btn-secondary">Export to Excel</button>
                        <button class="btn btn-secondary">Export to PDF</button>
                    </div>
                </div>
            </div>
            <table class="table table-light table-striped" style="width:80%;">
                <thead>
                    <tr>
                        <th class="px-2 text-center" style="width:7%">ID</th>
                        <th class="px-2 text-center" style="width:10%">Tanggal Transaksi</th>
                        <th class="px-2 text-center" style="width:10%">Jumlah Transaksi</th>
                        <th class="px-2 text-center" style="width:10%">Total Nominal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tempTrans as $idx=>$p) 
                        <tr>
                            <td class="text-center">{{ $idx+1 }}</td>
                            <td class="text-center">{{ $p["tanggal"] }}</td>
                            <td class="text-center">{{ $p["jumlah"] }}</td>
                            <td class="text-center">Rp. {{ formatUang($p["total"]) }}</td>
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

