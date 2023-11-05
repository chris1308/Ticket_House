@extends('layouts.main')
@section('content')
<div class="Login d-flex justify-content-center">
    <div class="mt-4 p-3" style="">
        {{-- tampilkan flash message setelah berhasil register --}}
        @if (session()->has('success'))        
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2>Hello!</h2>
        <h3>Please fill your username or email to <br/> login</h3>
        
        <form action="" class="mt-3">
            <input type="text"  size="59" name="" id="" class="" placeholder="username or email">
            <br/>
            <input class="mt-2" type="password" size="59" name="" id="" placeholder="password">
            <br/><br/>
            <button class="btn btn-success" style="width: 465px;">Login</button>
            <br/><br/>
  
        </form>
        <div class="d-flex justify-content-end mb-0">
            <p class="float-right">Don't have an account? <br/><span style="margin-left: 70px"><a class="" href="/register">Register Now</a></span> </p>
        </div>
    </div>
</div>
@endsection