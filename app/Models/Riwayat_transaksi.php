<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat_transaksi extends Model
{
    protected $table = 'riwayat_transaksi';

    protected $fillable = [
        'id_anggota',
        'saldo',
        'jenis',
        'jenis_simpanan',
        'is_active',
        'created_by',
        'updated_by',

    ];
}
