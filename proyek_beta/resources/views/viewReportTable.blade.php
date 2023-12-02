<table class="me-3" style="width:82%">
    <tr class="d-none">
        <th>Laporan View</th>
    </tr>
    <tr class="" style=" background-color: #3aaaff; color:white">
        <th class="py-2" style="  width:10%; padding-left:10px">ID</th>
        <th class="" style="width:20%;padding-left:10px">Nama</th>
        <th style="text-align:center;width:20%;padding-left:10px">Jumlah View</th>
    </tr>
    @foreach ($allTickets as $index => $ticket)
        <tr style="background-color: {{ $index%2==0 ? 'white' : 'lightblue' }};">
            <td class="py-2" style="padding-left:10px">{{ $ticket->id_tiket }}</td>
            <td style="padding-left:10px">{{ $ticket->nama }}</td>
            <td style="text-align: center">{{ $ticket->jumlah_view }}</td>
        </tr>
    @endforeach
</table>