@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Data Santri</h2>
    <a href="{{ route('santri.create') }}" class="btn btn-primary">+ Tambah Santri</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>ID Murid</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($santris as $index => $santri)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span class="badge bg-secondary">{{ $santri->id_murid }}</span></td>
                        <td class="fw-semibold">{{ $santri->nama }}</td>
                        <td>{{ $santri->kelas }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('santri.edit', $santri->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('santri.destroy', $santri->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini? Semua transaksi terkait santri ini juga akan terhapus.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data santri.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection