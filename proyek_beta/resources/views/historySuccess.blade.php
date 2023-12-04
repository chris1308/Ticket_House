@php
    use Carbon\Carbon; //supaya bisa format date
@endphp

@extends('layouts.main')
@section('content')
    <div class="container" style="min-height: 550px; padding-bottom:100px; padding-top:100px;">
        <h1 class="mb-4" style="text-align: center;">My Transaction History</h1>
        <a href="/unfinished" class="btn btn-secondary mb-2">Pending transactions</a>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/history/success">Transaksi Berhasil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="/history/fail">Transaksi Gagal</a>
            </li>
        </ul>
       
        @if (count($purchases)==0)
            <h2 style="text-align: center; color:red;">Belum ada transaksi</h2>
        @else            
            @foreach($purchases->groupBy(function($purchase) {
                return $purchase->tanggal_pembelian;
            }) as $date => $groupedTransactions)
                <div class="row d-flex justify-content-center mt-3 mb-1">
                    <div class="col-md-2 text-center fs-5 rounded-4 border" style="background-color: lightgreen;" id="dateGroup">
                        {{ $date }}
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    
                    @foreach($groupedTransactions as $transaction)
                    <div class="col-11 rounded-3 border mb-2">
                        <div class="row py-3">
                            <div class="col-md-2 d-flex align-items-center">
                                <img style="width: 100px; object-fit:cover;" src="../../images/{{json_decode($transaction->tiket->gambar)[0]}}" alt="">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1">{{ $transaction->tiket->nama }}</div>
                                <div>Rp {{ formatUang($transaction->total) }}</div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1"> {{Carbon::createFromFormat('Y-m-d', $transaction->tanggal_pembelian)->format('d F Y')}}</div>
                                <div style="color: {{ ($transaction->status == 'berhasil' ? 'Green' : 'Red') }}">{{ ($transaction->status == "berhasil" ? "Berhasil" : "Gagal") }}</div>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('invoice',['id'=>$transaction->id_invoice]) }}" class="btn btn-primary">Lihat Invoice</a> 
                            </div>
                        </div>
                        
                         
                        
                        
                    </div>
                    @endforeach
                    
                </div>
                
            @endforeach
            <div class="col mt-3">
                {{ $purchases->links() }}    
            </div>
            


        @endif
    </div>

@endsection