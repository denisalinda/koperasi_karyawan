<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_anggota extends Model
{
    protected $table = 'data_anggota';

    protected $fillable = [
        'nik',
        'npwp',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'nomor_hp',
        'alamat',
        'image',
        'is_active',
    ];
}
