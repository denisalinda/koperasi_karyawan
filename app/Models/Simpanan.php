<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $table = 'simpanan';

    protected $fillable = [
        'id_anggota',
        'saldo',
        'jenis',
        'is_active',
        'created_by',
        'updated_by',

    ];
}
