<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi', 'santri_id', 'jenis_transaksi', 
        'item_detail', 'nominal', 'tanggal_pembayaran', 
        'metode_pembayaran', 'kasir_id'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
}