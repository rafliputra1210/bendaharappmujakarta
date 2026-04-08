<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;

    protected $fillable = ['id_murid', 'nama', 'kelas'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}