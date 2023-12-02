@extends('layouts.sellerMain')
@section('content')
    <div class="container" style="min-height: 650px; padding-bottom:50px;padding-top:100px; margin-left: 250px;">
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
        @include('salesReportTable')
    </div>
@endsection