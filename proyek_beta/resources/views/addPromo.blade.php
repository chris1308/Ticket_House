@extends('layouts.sellerMain')
@section('content')
<!-- {{-- Desain interface masih belum perfect sesuai figma, masih ada field yang kurang (ex. startdate, starttime, endtime) dan belum bisa upload gambar. --}} -->
<div class="d-flex justify-content-center" style="min-height: 500px">
    <div class="my-3 pt-5" style=" ">
        <h3 class="mt-5">Tambah Kode Promo</h3>
        <form action="/addPromo" method="post" class="mt-3 pb-3" >
            @csrf
            Kode Promo
            <input required value="{{ old('kodePromo') }}" id="kodePromo" class=" form-control @error('kodePromo') is-invalid @enderror" type="text" name="kodePromo" size="50" placeholder="masukkan kode promo" id="">
            @error('kodePromo')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            <br/>
            Nilai Promo
            <input required value="{{ old('nilaiPromo') }}" type="text" class=" form-control @error('nilaiPromo') is-invalid @enderror" name="nilaiPromo" size="50" placeholder="nilai promo" id="">
            @error('nilaiPromo')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror            
            <br/>
            <button class="btn btn-success" style="width: 450px;">Tambah</button>
            <input type="reset" value="Reset">
        </form>
    </div>
</div>
@endsection