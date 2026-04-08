<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santri;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data ringkasan untuk dashboard
        $totalSantri = Santri::count();
        
        $pemasukanHariIni = Transaksi::whereDate('tanggal_pembayaran', Carbon::today())
                                     ->sum('nominal');
                                     
        $pemasukanBulanIni = Transaksi::whereMonth('tanggal_pembayaran', Carbon::now()->month)
                                      ->whereYear('tanggal_pembayaran', Carbon::now()->year)
                                      ->sum('nominal');

        $totalTransaksiBulanIni = Transaksi::whereMonth('tanggal_pembayaran', Carbon::now()->month)
                                           ->count();

        return view('dashboard', compact(
            'totalSantri', 
            'pemasukanHariIni', 
            'pemasukanBulanIni', 
            'totalTransaksiBulanIni'
        ));
    }
}