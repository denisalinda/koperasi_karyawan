<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggsuran extends Model
{
    protected $table = 'anggsuran';

    protected $fillable = [
        'id_pinjaman',
        'angsuran',
        'lunas',
        'created_by',
        'updated_by',
    ];
}
