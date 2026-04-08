@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Form Penjualan Koperasi</h2>
        <p class="text-muted">Input transaksi pembelian Seragam dan Kitab oleh santri.</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="jenis_transaksi" value="Penjualan">

            <div class="mb-3">
                <label for="santri_id" class="form-label">Nama Santri Pembeli</label>
                <select class="form-select @error('santri_id') is-invalid @enderror" id="santri_id" name="santri_id" required>
                    <option value="" disabled selected>-- Cari Nama Santri --</option>
                    @foreach($santris as $santri)
                        <option value="{{ $santri->id }}">
                            {{ $santri->id_murid }} - {{ $santri->nama }} ({{ $santri->kelas }})
                        </option>
                    @endforeach
                </select>
                @error('santri_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="kategori_barang" class="form-label">Kategori Barang</label>
                <select class="form-select" id="kategori_barang" onchange="updateItemDetail()" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="Seragam">Seragam</option>
                    <option value="Kitab">Kitab / Buku</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="item_detail" class="form-label">Nama Barang (Detail)</label>
                <input type="text" class="form-control @error('item_detail') is-invalid @enderror" id="item_detail" name="item_detail" placeholder="Contoh: Seragam Olahraga Ukuran L" required>
                @error('item_detail') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="nominal" class="form-label">Total Harga (Rp)</label>
                <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" placeholder="Contoh: 150000" required>
                @error('nominal') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-success px-4 w-100">Simpan Transaksi Penjualan</button>
        </form>
    </div>
</div>

<script>
    // Fungsi sederhana untuk memberikan prefix pada nama barang berdasarkan kategori
    function updateItemDetail() {
        const kategori = document.getElementById('kategori_barang').value;
        const detailInput = document.getElementById('item_detail');
        
        if(kategori === 'Seragam') {
            detailInput.value = 'Seragam ';
            detailInput.focus();
        } else if(kategori === 'Kitab') {
            detailInput.value = 'Kitab ';
            detailInput.focus();
        } else {
            detailInput.value = '';
        }
    }
</script>
@endsection