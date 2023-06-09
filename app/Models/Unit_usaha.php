<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_usaha extends Model
{
    protected $table = 'unit_usaha';

    protected $fillable = [
        'nama_pemesan',
        'jasa',
        'tanggal',
        'harga',
        'jenis_usaha',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
