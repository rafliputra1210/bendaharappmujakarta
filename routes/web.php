<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;

// Rute Login (Bisa diakses siapa saja / Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

// Rute yang Dilindungi (Harus Login)
Route::middleware('auth')->group(function () {
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Data Santri
    Route::resource('santri', SantriController::class);

    // Modul Transaksi
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/pembayaran', [TransaksiController::class, 'createPembayaran'])->name('pembayaran');
        Route::get('/penjualan', [TransaksiController::class, 'createPenjualan'])->name('penjualan');
        Route::post('/store', [TransaksiController::class, 'store'])->name('store');
        Route::get('/{id}/struk', [TransaksiController::class, 'printStruk'])->name('struk');
    });

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/export-pdf', [LaporanController::class, 'exportPdf'])->name('export_pdf');
    });

});
