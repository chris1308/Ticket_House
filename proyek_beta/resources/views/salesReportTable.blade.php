<table style="width: 82%">
    <tr class="" style=" background-color: #3aaaff; color:white">
        <th class="py-2" style="width:10%; padding-left:10px">ID</th>
        <th style="width:30%;padding-left:10px">Nama</th>
        <th style="width:20%;padding-left:10px; text-align:center;">Nominal Total</th>
        <th style="text-align:center;width:20%;padding-left:10px">Tanggal</th>
    </tr>
    @foreach ($tempTickets as $index => $ticket)
        @if ($ticket["status"] == "berhasil")            
            <tr style="background-color: {{ $index%2==0 ? 'white' : 'lightblue' }};">
                <td class="py-2" style="padding-left:10px">{{ $ticket['id_invoice'] }}</td>
                <td style="padding-left:10px">{{ $ticket['nama'] }}</td>
                <td style="text-align: center">Rp. {{ formatUang($ticket['total']) }}</td>
                <td style="text-align: center">{{ $ticket['tanggal_pembelian'] }}</td>
            </tr>
        @endif
    @endforeach
</table>