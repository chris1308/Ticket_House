@extends('layouts.main')
@section('content')

<div class="SearchResult container" style="padding-top:100px; ">
    <h1>Search Result for "{{request()->input('keyword')}}"</h1><br>
    <div class="row pb-5">
        <!-- {{-- show text if no tiket is found as result of search --}} -->
        @if(count($result) == 0)
            <h2 class="text-center text-danger">Tiket tidak ditemukan</h2>
        @endif

        @foreach($result as $res)
            <div onclick="redirectToDetail('{{ route('ticket.detail', ['id' => $res->id_tiket]) }}')" class="col-sm-6 col-md-4 col-lg-3 rounded-3 p-3 mb-3" style="height: 250px;">
                <div class="gbr" style="height: 85%;">
                    <img class="img rounded-3 w-100 h-100" src="images/{{json_decode($res->gambar)[0]}}" alt="{{$res->nama}}" style="object-fit: cover;">
                </div>
                <div class="fw-bold">{{ $res->nama }}</div>
                <div>From IDR {{substr_replace($res->harga, 'K', strlen($res->harga)-3)}}</div>
            </div>    
        @endforeach
    </div>
</div>
<script>
    // Function to redirect to the detail page 
    function redirectToDetail(detailUrl) {
        //we need this because we use div onclick that doesnt have href attribute
        //if we use an <a></a> instead, we dont need this
        // Update the window location to the detail page URL
        window.location.href = detailUrl;
    }
</script>


@endsection