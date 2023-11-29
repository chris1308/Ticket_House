@extends('layouts.main')
@section('content')
    <div class="container" style="min-height: 850px; padding-bottom:100px; padding-top:100px;">
        <h1 class="mb-4" style="text-align: center;">My Transaction History</h1>
        @if (count($purchases)==0)
            <h2 style="text-align: center; color:red;">Belum ada transaksi</h2>
        @else            
            <table class="mt-4">
                <tr class="" style="text-align:center;border-bottom:1px solid black">
                    <th style="padding: 15px 15px; "></th>
                    <th style=" padding: 10px 35px; ">Product Name</th>
                    <th style="padding:10px 30px">Quantity</th>
                    <th style=" padding:10px 70px; " >Total</th>
                    <th style=" padding:10px 40px;">Status</th>
                    <th style=" padding:10px 60px;">Date</th>
                    <th style=" padding:10px 70px; ">Action</th>
                </tr>
                @foreach ($purchases as $p)
                    @foreach ($tickets as $t)
                        @if ($t->id_tiket == $p->id_tiket)
                            <tr style="border-bottom:1px solid black; text-align:center">
                                <td style="padding: 20px"><a href="/ticket/{{ $p->id_tiket }}"><img style="width: 100px; object-fit:cover;" src="/images/{{ json_decode($t->gambar)[0] }}" alt=""></a> </td>
                                <td style="padding: 20px">{{ $t->nama }} </td>
                                <td style="padding: 10px">{{ $p->quantity }} </td>
                                <td style="padding: 20px">Rp. {{ formatUang($p->total) }} </td>
                                <td style="color:{{ $p->status == 'berhasil' ? 'green' : 'red' }}; padding: 20px">{{ $p->status }} </td>
                                <td style="padding: 20px">{{ $p->tanggal_pembelian }} </td>
                                <td style="padding: 20px"><button class="btn btn-primary">Lihat Invoice</button> </td>
                            </tr>                        
                            @break
                        @endif  
                    @endforeach
                @endforeach
            </table>
        @endif
    </div>

@endsection