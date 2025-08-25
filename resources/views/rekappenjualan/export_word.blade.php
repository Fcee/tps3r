<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Rekap Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Harga</th>
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
                    <td>{{ number_format($rekap->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $rekap->jumlah }}</td>
                    <td>{{ number_format($rekap->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $rekap->tanggal }}</td>
                    <td>{{ $rekap->status }}</td>
                </tr>
            @endforeach
        </tbody>
    <tr>
        <td colspan="4" style="text-align: right;"><strong></strong></td>
        <td><strong>Total Barang: {{ $totalBarang }}</strong></td>
        <td><strong>Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></td>
        <td colspan="4"></td>
    </tr>
</body>
</table>
</html>
