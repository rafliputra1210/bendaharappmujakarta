@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Tambah Data Santri</h2>
        <a href="{{ route('santri.index') }}" class="text-decoration-none">&larr; Kembali ke Daftar Santri</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('santri.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="id_murid" class="form-label">ID Murid (NIS)</label>
                <input type="text" class="form-control @error('id_murid') is-invalid @enderror" id="id_murid" name="id_murid" value="{{ old('id_murid') }}" required>
                @error('id_murid') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select @error('kelas') is-invalid @enderror" id="kelas" name="kelas" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    <option value="Pra-Qurani" {{ old('kelas') == 'Pra-Qurani' ? 'selected' : '' }}>Pra-Qurani</option>
                    <option value="TPQ & MD" {{ old('kelas') == 'TPQ & MD' ? 'selected' : '' }}>TPQ & MD</option>
                    <option value="Lainnya" {{ old('kelas') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
        </form>
    </div>
</div>
@endsection