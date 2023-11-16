@extends('layouts.main')
@section('content')
<!-- {{-- Desain interface masih belum perfect sesuai figma, masih ada field yang kurang (ex. startdate, starttime, endtime) dan belum bisa upload gambar. --}} -->
<div class="d-flex justify-content-center">
    <div class="my-3 p-3" style="">
        <h3 class="my-2 ">Tambah Tiket</h3>
        <form action="/add" method="post" class="mt-3 pb-3" >
            @csrf
            Nama
            <input required value="{{ old('namaTiket') }}" id="namaTiket" class=" form-control @error('namaTiket') is-invalid @enderror" type="text" name="namaTiket" size="50" placeholder="namaTiket" id="">
            @error('namaTiket')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            <br/>

            Kategori
            <select value="{{ old('kategori') }}" style="width: 450px" class="form-control" name="kategori" id="kategori">
                <option value="place">Place</option>
                <option value="seminar">Seminar</option>
            </select>
            @error('kategori')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
           <br/>

           Deskripsi
           <textarea required type="text" class=" form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" size="50" placeholder="deskripsi" id="">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            <br/>

            Harga
            <input required value="{{ old('harga') }}" type="text" class=" form-control @error('harga') is-invalid @enderror" name="harga" size="50" placeholder="harga" id="">
            @error('harga')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            <br/>

            Stok
            <input required value="{{ old('stok') }}" type="text" class=" form-control @error('stok') is-invalid @enderror" name="stok" size="50" placeholder="stok" id="">
            @error('stok')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
            <br/>

            Kota
            <select value="{{ old('kota') }}" style="width: 450px" class="form-control" name="kota" id="kota">
                <option value="Bandung">Bandung</option>
                <option value="Denpasar">Denpasar</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Malang">Malang</option>
                <option value="Medan">Medan</option>
                <option value="Solo">Solo</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Yogyakarta">Yogyakarta</option>
            </select>
            @error('kota')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
           <br/>

           Lokasi
           <input required value="{{ old('lokasi') }}" type="text" class=" form-control @error('lokasi') is-invalid @enderror" name="lokasi" size="50" placeholder="lokasi" id="">
            @error('lokasi')
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