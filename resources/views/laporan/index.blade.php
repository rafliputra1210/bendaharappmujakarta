@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold">Laporan Transaksi</h2>
        <p class="text-muted">Rekapitulasi terpisah untuk administrasi sekolah dan unit usaha (koperasi).</p>
    </div>
    <div>
        <button onclick="window.print()" class="btn btn-outline-secondary me-2">Cetak Halaman</button>
        <a href="{{ route('laporan.export_pdf') }}" class="btn btn-danger">Export Semua PDF</a>
    </div>
</div>

<ul class="nav nav-tabs mb-4" id="laporanTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active fw-bold" id="pembayaran-tab" data-bs-toggle="tab" data-bs-target="#tab-pembayaran" type="button" role="tab">
            💰 Laporan Pembayaran Administrasi
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link fw-bold" id="penjualan-tab" data-bs-toggle="tab" data-bs-target="#tab-penjualan" type="button" role="tab">
            🛒 Laporan Penjualan Koperasi
        </button>
    </li>
</ul>

<div class="tab-content" id="laporanTabContent">
    
    <div class="tab-pane fade show active" id="tab-pembayaran" role="tabpanel">
        <div class="card border-0 shadow-sm mb-4 border-start border-primary border-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Pemasukan Administrasi</h6>
                <h4 class="fw-bold text-primary">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h4>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tgl Transaksi</th>
                                <th>Kode</th>
                                <th>Nama Santri</th>
                                <th>Jenis Tagihan</th>
                                <th>Detail/Bulan</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayarans as $trx)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($trx->tanggal_pembayaran)->format('d/m/Y') }}</td>
                                <td><small class="text-muted">{{ $trx->kode_transaksi }}</small></td>
                                <td class="fw-semibold">{{ $trx->santri->nama }}</td>
                                <td><span class="badge bg-primary">{{ $trx->jenis_transaksi }}</span></td>
                                <td>{{ $trx->item_detail ?? '-' }}</td>
                                <td class="fw-bold">Rp {{ number_format($trx->nominal, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.struk', $trx->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Cetak Struk</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data pembayaran administrasi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="tab-penjualan" role="tabpanel">
        <div class="card border-0 shadow-sm mb-4 border-start border-info border-4">
            <div class="card-body">
                <h6 class="text-muted mb-1">Total Pendapatan Koperasi</h6>
                <h4 class="fw-bold text-info">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h4>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Tgl Transaksi</th>
                                <th>Kode</th>
                                <th>Nama Pembeli</th>
                                <th>Kategori</th>
                                <th>Nama Barang</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualans as $trx)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($trx->tanggal_pembayaran)->format('d/m/Y') }}</td>
                                <td><small class="text-muted">{{ $trx->kode_transaksi }}</small></td>
                                <td class="fw-semibold">{{ $trx->santri->nama }}</td>
                                <td><span class="badge bg-info text-dark">Koperasi</span></td>
                                <td>{{ $trx->item_detail }}</td>
                                <td class="fw-bold">Rp {{ number_format($trx->nominal, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.struk', $trx->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">Cetak Struk</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data penjualan koperasi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection