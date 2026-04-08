<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan SADC</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .total { margin-top: 20px; font-weight: bold; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Transaksi SADC</h2>
        <p>Santri Academic Digital Center</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tgl</th>
                <th>Kode</th>
                <th>Nama Santri</th>
                <th>Jenis</th>
                <th>Detail</th>
                <th>Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $trx)
            <tr>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal_pembayaran)->format('d/m/Y') }}</td>
                <td>{{ $trx->kode_transaksi }}</td>
                <td>{{ $trx->santri->nama }}</td>
                <td>{{ $trx->jenis_transaksi }}</td>
                <td>{{ $trx->item_detail }}</td>
                <td>Rp {{ number_format($trx->nominal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        Total Keseluruhan Pemasukan: Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
    </div>
</body>
</html>