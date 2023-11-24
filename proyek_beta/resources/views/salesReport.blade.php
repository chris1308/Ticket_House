@extends('layouts.sellerMain')
@section('content')
    <div class="container" style="min-height: 650px; padding-bottom:50px;padding-top:120px; margin-left: 250px;">
        @if(session('message')) 
            <div style="width: 900px" class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif 
        <h2 class="fw-bold " style="">Laporan Penjualan</h2>
        <div class="d-flex flex-row-reverse ExportButton my-3" style="margin-right: 200px">
            <a  href="{{ route('export.pdf',['id'=>1]) }}" class="btn btn-secondary ms-2">Export to PDF</a>
            <a href="{{ route('export.excel',['id'=>1]) }}" class="btn btn-secondary">Export to Excel</a>
        </div>
        <table>
            <tr class="" style=" background-color: #3aaaff; color:white">
                <th class="py-2" style="  width:100px; padding-left:10px">ID</th>
                <th style="width:300px;padding-left:10px">Nama</th>
                <th style="width:200px;padding-left:10px; text-align:center;">Nominal Total</th>
                <th style="text-align:center;width:200px;padding-left:10px">Tanggal</th>
            </tr>
            @foreach ($tempTickets as $index => $ticket)
                <tr style="background-color: {{ $index%2==0 ? 'white' : 'lightblue' }};">
                    <td class="py-2" style="padding-left:10px">{{ $ticket['id_invoice'] }}</td>
                    <td style="padding-left:10px">{{ $ticket['nama'] }}</td>
                    <td style="text-align: center">Rp. {{ $ticket['total'] }}</td>
                    <td style="text-align: center">{{ $ticket['tanggal_pembelian'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection