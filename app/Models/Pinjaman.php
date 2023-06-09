<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable = [
        'id_nama_anggota',
        'jumlah_pinjman_diajukan',
        'jumlah_pinjman',
        'jangka_waktu',
        'tujuan_pinjaman',
        'bunga',
        'tanggal_pencarian',
        'bukti_pencairan',
        'lunas',
        'is_active',
        'created_by',
        'updated_by',

    ];
}
