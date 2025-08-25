<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekapitulasi Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }
        .kop-surat h2, .kop-surat p {
            margin: 0;
            padding: 2px;
        }
        .line {
            border-bottom: 2px solid #000;
            margin: 10px 0 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <h2>TPS 3R SIDO MAKMUR</h2>
        <p>Jl. Plelen No. 123, Kota PacitanA</p>
        <p>Telepon: (+62) 83821671510  | Email: info@Tps</p>
    </div>

    <div class="line"></div>

    <h3 style="text-align: center;">Rekapitulasi Data</h3>

    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Total Barang</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recaps as $recap)
            <tr>
                <td>{{ $recap->category->nama_category }}</td>
                <td>{{ $recap->total_barang }}</td>
                <td>Rp {{ number_format($recap->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <th>Jumlah</th>
                <th>{{ $totalSemuaBarang }}</th>
                <th>Rp {{ number_format($totalSemuaHarga, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

</body>
</html>
