@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted">Ringkasan sistem informasi akademik & keuangan hari ini.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Pemasukan Hari Ini</h6>
                <h3 class="fw-bold text-success">Rp {{ number_format($pemasukanHariIni, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Pemasukan Bulan Ini</h6>
                <h3 class="fw-bold text-primary">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Total TRX Bulan Ini</h6>
                <h3 class="fw-bold text-warning">{{ $totalTransaksiBulanIni }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted">Total Santri Aktif</h6>
                <h3 class="fw-bold text-info">{{ $totalSantri }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection