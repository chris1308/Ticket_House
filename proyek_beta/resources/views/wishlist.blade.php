@extends('layouts.main')
@section('content')
    <div class="container" style="height: 850px; padding-top:100px;">
        <h1 style="text-align: center;">My Wishlist</h1>
        <a href="/home">Back to Home</a>
        <table class="mt-3">
            <tr class="" style="text-align:center;border-bottom:1px solid black">
                <th style="padding: 15px 25px; "></th>
                <th  style=" padding: 10px 35px; ">Product Name</th>
                <th style=" padding:10px 70px; " >Price</th>
                <th style="padding:10px 60px">Quantity</th>
                <th style=" padding:10px 60px;">Stock</th>
                <th style=" padding:10px 80px; ">Action</th>
            </tr>
            @foreach ($tempTickets as $ticket)
            <tr class="" style="border-bottom:1px solid black; text-align:center;">
                <td style="padding: 20px"><img style="width: 100px; object-fit:cover;" src="/images/{{ json_decode($ticket->gambar)[0] }}" alt=""></td>
                <td  style="padding: 10px; ">{{ $ticket->nama }}</td>
                <td style=" padding:10px 70px; ">Rp. {{ $ticket->harga }}</td>
                <td style="padding:10px 60px">1</td>
                <td style=" padding:10px 60px;">{{ $ticket->quantity }}</td>
                <td style=" padding:10px 60px; "><i class="fa-solid fa-trash fa-lg"></i></td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex flex-row-reverse " style="padding-right: 35px">
            <button class="btn btn-danger mt-5 " style="text-align: right">Remove All</button>
        </div>
    </div>
@endsection