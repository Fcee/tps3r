<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Penjualan - PDF</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 30px; }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 80px;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .header p {
            margin: 2px 0;
        }

        .rekap-info {
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .rekap-info p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .filter {
            margin-bottom: 10px;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/logo1.png') }}" alt="Logo TPS 3R">
        <h2>TPS 3R SIDO MAKMUR</h2>
        <p>Jl. ALAMAK NAJIS NYAA No. 123, Kota INI YANG PAPA CARII</p>
        <p>Telepon: (+62) 83821671510 | Email: info@MBUH</p>
    </div>

    <h3 style="text-align: center;">Rekap Penjualan</h3>

    @if(request('nama_produk') || request('start_date') || request('end_date'))
        <div class="filter">
            <strong>Filter:</strong>
            @if(request('nama_produk')) Produk = {{ request('nama_produk') }} @endif
            @if(request('start_date')) | Dari = {{ request('start_date') }} @endif
            @if(request('end_date')) | Sampai = {{ request('end_date') }} @endif
        </div>
    @endif

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
            @foreach($rekaps as $i => $rekap)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $rekap->nama_pembeli }}</td>
                    <td>{{ $rekap->nama_produk }}</td>
                    <td>Rp {{ number_format($rekap->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $rekap->jumlah }}</td>
                    <td>Rp {{ number_format($rekap->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $rekap->tanggal }}</td>
                    <td>{{ $rekap->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
     <div class="rekap-info">
        <p><strong>Total Barang:</strong> {{ $totalBarang }}</p>
        <p><strong>Total Harga:</strong> Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
    </div>
</body>
</html>
