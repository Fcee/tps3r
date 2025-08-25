<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Produk</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rekaps as $i => $rekap)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $rekap->nama_pembeli }}</td>
                <td>{{ $rekap->nama_produk }}</td>
                <td>{{ $rekap->harga_satuan }}</td>
                <td>{{ $rekap->jumlah }}</td>
                <td>{{ $rekap->total_harga }}</td>
                <td>{{ $rekap->tanggal }}</td>
                <td>{{ $rekap->status }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4"><strong>Total</strong></td>
            <td><strong>{{ $totalBarang }}</strong></td>
            <td colspan="3"><strong>{{ $totalHarga }}</strong></td>
        </tr>
    </tbody>
</table>
