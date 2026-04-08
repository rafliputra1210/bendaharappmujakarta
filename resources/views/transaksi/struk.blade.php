<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi - {{ $transaksi->kode_transaksi }}</title>
    <style>
        body { font-family: monospace; max-width: 300px; margin: 0 auto; padding: 20px; }
        .header { text-align: center; border-bottom: 1px dashed #000; padding-bottom: 10px; margin-bottom: 10px; }
        .content { margin-bottom: 10px; border-bottom: 1px dashed #000; padding-bottom: 10px; }
        .row { display: flex; justify-content: space-between; margin-bottom: 5px; }
        .footer { text-align: center; font-size: 12px; margin-top: 15px; }
        @media print {
            body { max-width: 100%; padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="header">
        <h3>MIFTAHUL ULUM JKT</h3>
        <p style="margin:0;">Jl. Contoh Alamat No.123</p>
        <p style="margin:0;">Telp: 08123456789</p>
    </div>

    <div class="content">
        <div class="row">
            <span>Tanggal</span>
            <span>{{ \Carbon\Carbon::parse($transaksi->tanggal_pembayaran)->format('d/m/Y') }}</span>
        </div>
        <div class="row">
            <span>No. Ref</span>
            <span>{{ $transaksi->kode_transaksi }}</span>
        </div>
        <div class="row">
            <span>Kasir</span>
            <span>Admin</span>
        </div>
    </div>

    <div class="content">
        <div class="row">
            <span><strong>Nama Santri</strong></span>
            <span><strong>{{ $transaksi->santri->nama }}</strong></span>
        </div>
        <div class="row">
            <span>Jenis</span>
            <span>{{ $transaksi->jenis_transaksi }}</span>
        </div>
        @if($transaksi->item_detail)
        <div class="row">
            <span>Detail</span>
            <span>{{ $transaksi->item_detail }}</span>
        </div>
        @endif
        <div class="row" style="margin-top: 10px; font-size: 16px;">
            <span><strong>TOTAL</strong></span>
            <span><strong>Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</strong></span>
        </div>
    </div>

    <div class="footer">
        <p>Terima kasih atas pembayaran Anda.</p>
        <p><em>Simpan struk ini sebagai bukti pembayaran yang sah.</em></p>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Print Struk</button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 16px; cursor: pointer;">Tutup Halaman</button>
    </div>

    <script>
        // Otomatis trigger print saat halaman diload
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
