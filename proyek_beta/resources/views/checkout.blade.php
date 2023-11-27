{{-- check if user has logged in or not. If not redirect him to login page --}}
@if (session()->has('user')) 
    @extends('layouts.main')
    @section('content')
        <div class="container d-flex pb-4 justify-content-center" style="min-height: 750px; padding-top:100px">
            <div class="shadow-lg mt-3" style=" border-radius:10px;width:650px ;height:550px; padding: 15px 20px">
                <h2 class="mb-4 text-center">Checkout</h2>
                <p class="fs-5">Nama Tiket : &nbsp;{{ $ticket->nama }}</p>
                <p class="fs-5">Lokasi : &nbsp;{{ $ticket->alamat_lokasi }}, {{ $ticket->kota }}</p>
                @if ($ticket->start_date != null)
                <p class="fs-5">Tanggal : &nbsp;{{ $ticket->start_date }}</p>
                @endif
                <p class="fs-5">Jam : &nbsp;{{ $ticket->start_time }} - {{ $ticket->end_time }}</p>
                <div class="d-flex" style="">
                    <p class="fs-5 me-3 ">Jumlah :</p>
                    <input class="form-control" style="width:70px; height:35px;" type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <input class="form-check-input" type="checkbox" value="" onchange="handleChange()" id="pointCheck">
                <label class="form-check-label" for="pointCheck">
                  <span id="" class="ms-2">Use Points ( <span id="poin">{{ session('user')->poin }}</span> )</span> 
                </label>
                <br><br>
                <div class="d-flex">
                    <p class="form-label mt-2">Promo Code (optional)</p>
                    <input class="form-control mx-2" type="text" value="" style="width: 50%" id="promo" placeholder="enter promo code">
                    <button class="btn btn-primary">Use</button>
                </div><br>
                <p  class="fs-5 fw-bold">Total : Rp. <span class="fs-5" id="total">{{ $ticket->harga }}</span></p>
                {{-- redirect to midtrans after checkout button pressed --}}
                <button class="btn btn-success">Bayar Sekarang</button>
            </div>
        </div>
        <script>
            function handleChange(){
                let pointCheck = document.getElementById("pointCheck");
                let currentPoint = document.getElementById("poin").innerHTML;
                let totalSpan = document.getElementById("total");
                let currentValue = parseInt(totalSpan.innerHTML);
                if(pointCheck.checked){
                    // alert(currentPoint);
                    //deduct total 
                    currentValue -= parseInt(currentPoint);
                }else{
                    currentValue += parseInt(currentPoint);
                }
                totalSpan.innerHTML = currentValue; //update total value
            }
        </script>
    @endsection
@else
    <script>window.location = "{{ route('login') }}";</script>
@endif