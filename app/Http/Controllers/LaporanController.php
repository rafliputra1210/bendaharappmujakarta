<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data khusus Pembayaran Administrasi (selain Penjualan)
        $pembayarans = Transaksi::with('santri')
                        ->where('jenis_transaksi', '!=', 'Penjualan')
                        ->latest()
                        ->get();
        $totalPembayaran = $pembayarans->sum('nominal');

        // 2. Ambil data khusus Penjualan Koperasi
        $penjualans = Transaksi::with('santri')
                        ->where('jenis_transaksi', 'Penjualan')
                        ->latest()
                        ->get();
        $totalPenjualan = $penjualans->sum('nominal');

        return view('laporan.index', compact(
            'pembayarans', 'totalPembayaran', 
            'penjualans', 'totalPenjualan'
        ));
    }

    public function exportPdf()
    {
        $transaksis = Transaksi::with('santri')->latest()->get();
        $totalPemasukan = $transaksis->sum('nominal');

        $pdf = Pdf::loadView('laporan.pdf', compact('transaksis', 'totalPemasukan'));
        
        return $pdf->download('Laporan_Transaksi_SADC.pdf');
    }
}