<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Transaksi;
use App\Models\KategoriTransaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function createPembayaran()
    {
        // Ambil semua data santri untuk pilihan di dropdown
        $santris = Santri::orderBy('nama', 'asc')->get();
        
        // Ambil data harga standar dari database yang sudah di-seed
        $kategori = KategoriTransaksi::pluck('nominal_standar', 'kode');

        return view('transaksi.form_pembayaran', compact('santris', 'kategori'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'jenis_transaksi' => 'required|string',
            'nominal' => 'required|numeric|min:0',
            'item_detail' => 'nullable|string',
        ]);

        // Membuat Kode Transaksi Otomatis (Contoh: TRX-20260407-0001)
        $today = Carbon::now()->format('Ymd');
        $lastTrxToday = Transaksi::whereDate('created_at', Carbon::today())->count() + 1;
        $kodeTransaksi = 'TRX-' . $today . '-' . str_pad($lastTrxToday, 4, '0', STR_PAD_LEFT);

        // Simpan ke database
        $transaksi = Transaksi::create([
            'kode_transaksi' => $kodeTransaksi,
            'santri_id' => $request->santri_id,
            'jenis_transaksi' => $request->jenis_transaksi,
            'item_detail' => $request->item_detail,
            'nominal' => $request->nominal,
            'tanggal_pembayaran' => Carbon::today(),
            'metode_pembayaran' => 'Tunai',
        ]);

        // Kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Transaksi ' . $request->jenis_transaksi . ' berhasil disimpan!');
    }

    // Biarkan kosong dulu untuk fitur penjualan yang akan datang
    public function createPenjualan()
    {
        // Ambil data santri untuk dropdown
        $santris = Santri::orderBy('nama', 'asc')->get();
        
        return view('transaksi.form_penjualan', compact('santris'));
    }

    public function printStruk($id)
    {
        $transaksi = Transaksi::with('santri')->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }
}