@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Form Pembayaran Administrasi</h2>
        <p class="text-muted">Input pembayaran SPP, Uang Gedung, dan Pendaftaran Santri.</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="max-width: 600px;">
    <div class="card-body p-4">
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="santri_id" class="form-label">Nama Santri</label>
                <select class="form-select @error('santri_id') is-invalid @enderror" id="santri_id" name="santri_id" required>
                    <option value="" disabled selected>-- Cari Nama Santri --</option>
                    @foreach($santris as $santri)
                        <option value="{{ $santri->id }}" data-kelas="{{ $santri->kelas }}">
                            {{ $santri->id_murid }} - {{ $santri->nama }} ({{ $santri->kelas }})
                        </option>
                    @endforeach
                </select>
                @error('santri_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_transaksi" class="form-label">Jenis Pembayaran</label>
                <select class="form-select @error('jenis_transaksi') is-invalid @enderror" id="jenis_transaksi" name="jenis_transaksi" required>
                    <option value="" disabled selected>-- Pilih Jenis --</option>
                    <option value="SPP">SPP Bulanan</option>
                    <option value="Uang Gedung">Uang Gedung</option>
                    <option value="Pendaftaran">Pendaftaran Santri Baru</option>
                </select>
                @error('jenis_transaksi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3" id="detail_container" style="display: none;">
                <label for="item_detail" class="form-label">Pembayaran Untuk Bulan/Detail</label>
                <input type="text" class="form-control" id="item_detail" name="item_detail" placeholder="Contoh: SPP Juli 2026">
                <small class="text-muted">Isi bulan dan tahun jika pembayaran adalah SPP.</small>
            </div>

            <div class="mb-4">
                <label for="nominal" class="form-label">Nominal (Rp)</label>
                <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" required>
                @error('nominal') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary px-4 w-100">Simpan Pembayaran</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const santriSelect = document.getElementById('santri_id');
        const jenisSelect = document.getElementById('jenis_transaksi');
        const nominalInput = document.getElementById('nominal');
        const detailContainer = document.getElementById('detail_container');
        const detailInput = document.getElementById('item_detail');

        // Mengambil data harga dari controller yang di-passing via Blade
        const hargaStandar = @json($kategori);

        function updateForm() {
            const selectedSantri = santriSelect.options[santriSelect.selectedIndex];
            // Jika belum memilih santri, hentikan proses
            if (!selectedSantri || !selectedSantri.value) return; 

            const kelasSantri = selectedSantri.getAttribute('data-kelas');
            const jenisTrx = jenisSelect.value;

            // Logika SPP
            if (jenisTrx === 'SPP') {
                detailContainer.style.display = 'block';
                detailInput.setAttribute('required', 'required');
                
                if (kelasSantri === 'Pra-Qurani') {
                    nominalInput.value = hargaStandar['SPP_PRA'] || 75000;
                } else if (kelasSantri === 'TPQ & MD') {
                    nominalInput.value = hargaStandar['SPP_TPQ'] || 70000;
                } else {
                    nominalInput.value = 0; // Jika kelas lainnya
                }
            } 
            // Logika Uang Gedung
            else if (jenisTrx === 'Uang Gedung') {
                detailContainer.style.display = 'none';
                detailInput.removeAttribute('required');
                nominalInput.value = hargaStandar['GEDUNG'] || 100000;
            } 
            // Logika Pendaftaran
            else if (jenisTrx === 'Pendaftaran') {
                detailContainer.style.display = 'none';
                detailInput.removeAttribute('required');
                nominalInput.value = hargaStandar['DAFTAR'] || 100000;
            } 
            // Reset
            else {
                detailContainer.style.display = 'none';
                detailInput.removeAttribute('required');
                nominalInput.value = '';
            }
        }

        // Jalankan fungsi update setiap kali dropdown santri atau jenis transaksi diubah
        santriSelect.addEventListener('change', updateForm);
        jenisSelect.addEventListener('change', updateForm);
    });
</script>
@endsection