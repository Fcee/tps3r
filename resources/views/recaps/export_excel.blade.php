<table>
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>Total Barang</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalBarang = 0;
            $totalHarga = 0;
        @endphp
        @foreach($recaps as $recap)
        <tr>
            <td>{{ $recap->category->nama_category }}</td>
            <td>{{ $recap->total_barang }}</td>
            <td>Rp {{ number_format($recap->total_harga, 0, ',', '.') }}</td>
        </tr>
        @php
            $totalBarang += $recap->total_barang;
            $totalHarga += $recap->total_harga;
        @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td style="font-weight: bold;">Jumlah</td>
            <td style="font-weight: bold;">{{ $totalBarang }}</td>
            <td style="font-weight: bold;">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
        </tr>
    </tfoot>
</table>
