<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriTransaksi;

class KategoriTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode' => 'SPP_PRA', 'nama_kategori' => 'SPP Pra-Qurani', 'nominal_standar' => 75000],
            ['kode' => 'SPP_TPQ', 'nama_kategori' => 'SPP TPQ & MD', 'nominal_standar' => 70000],
            ['kode' => 'GEDUNG', 'nama_kategori' => 'Uang Gedung', 'nominal_standar' => 100000],
            ['kode' => 'DAFTAR', 'nama_kategori' => 'Pendaftaran', 'nominal_standar' => 100000],
        ];

        foreach ($data as $item) {
            KategoriTransaksi::create($item);
        }
    }
}