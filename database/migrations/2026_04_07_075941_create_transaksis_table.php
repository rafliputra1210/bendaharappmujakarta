<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('santri_id')->constrained('santris')->onDelete('cascade');
            $table->string('jenis_transaksi'); 
            $table->string('item_detail')->nullable(); 
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran')->default('Tunai');
            // Dibuat nullable sementara agar tidak error jika sistem Auth/Users belum siap
            $table->foreignId('kasir_id')->nullable()->constrained('users')->nullOnDelete(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
