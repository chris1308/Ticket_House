@extends('layouts.main')
@section('content')
    <div class="Home container" style="height: 1500px; padding-top:100px; ">
        @if (session()->has('user'))
            <h1>Hello, {{ session('user')->name }}</h1><br>
        @else
            <h1>Hello, Guest</h1><br>
        @endif 
        {{-- Jumbotron --}}
        <div id="carouselExample" style="height: 400px" class="bg-primary carousel slide">
            <div class="carousel-inner" style="height: 400px">
              <div class="carousel-item active w-100 h-100">
                <img src="/images/concert1.jpg" style="object-fit: cover; " class="d-block w-100 h-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="/images/seminar1.jpg" style="object-fit: cover; " class="d-block w-100 h-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="/images/seminar2.jpg" style="object-fit: cover; " class="d-block w-100 h-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- popular now --}}
        <div class="Popular my-4">
            <div class="Header d-flex justify-content-between">
                <h3>Popular Now</h3>
                <button style="padding:10px; border-radius:10%; background-color:lightgreen; border:0;"><a href="" style="text-decoration: none; color:black">View More</a></button>
            </div>
            <div class="Items d-flex justify-content-between mt-2" style="flex-wrap: wrap">
                @foreach($tikets as $tiket)
                    <div class="mb-3 me-2" style=" ">    
                        <div class="Gambar mb-2" style="width: 250px; height:270px;">                    
                            <img style="object-fit: cover; border-radius:5%;" class="w-100 h-100" src="/images/{{ json_decode($tiket->gambar)[0] }}" alt="">          
                        </div>      
                        <h5>{{ $tiket->nama }}</h5>
                        <p>From IDR {{ $tiket->harga }}</p>
     
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Latest on --}}
        <div class="Latest my-4">
            <div class="Header d-flex justify-content-between">
                <h3>Latest On Ticket House</h3>
            </div>
            <div class="Items d-flex justify-content-between mt-2" style="flex-wrap: wrap">
                @foreach($tikets as $tiket)
                    <div class="mb-3 me-2" style=" ">    
                        <div class="Gambar mb-2" style="width: 250px; height:270px;">                    
                            <img style="object-fit: cover; border-radius:5%;" class="w-100 h-100" src="/images/{{ json_decode($tiket->gambar)[0] }}" alt="">          
                        </div>      
                        <h5>{{ $tiket->nama }}</h5>
                        <p>From IDR {{ $tiket->harga }}</p>
     
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection