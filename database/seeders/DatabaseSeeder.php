<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder kategori transaksi yang sudah dibuat sebelumnya
        $this->call([
            KategoriTransaksiSeeder::class,
        ]);

        // Buat Akun Admin Default
        User::create([
            'name' => 'Administrator SADC',
            'email' => 'admin@sadc.com',
            'password' => Hash::make('password123'), // Password default: password123
        ]);
    }
}