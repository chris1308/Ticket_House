<table>
    <tr class="" style=" background-color: #3aaaff; color:white">
        <th class="py-2" style="  width:100px; padding-left:10px">No</th>
        <th style="width:300px;padding-left:10px">Tanggal</th>
        <th style="width:200px;padding-left:10px; text-align:center;">Total Pemasukan</th>
        <th style="text-align:center;width:200px;padding-left:10px">Tiket Terjual</th>
    </tr>
    @foreach ($tempCashflows as $index => $ticket)
        <tr style="background-color: {{ $index%2==0 ? 'white' : 'lightblue' }};">
            <td class="py-2" style="padding-left:10px">{{ $index+1 }}</td>
            <td style="padding-left:10px">{{ $ticket['tanggal'] }}</td>
            <td style="text-align: center">Rp. {{ formatUang($ticket['total_pemasukan']) }}</td>
            <td style="text-align: center">{{ $ticket['tiket_terjual'] }}</td>
        </tr>
    @endforeach
</table>