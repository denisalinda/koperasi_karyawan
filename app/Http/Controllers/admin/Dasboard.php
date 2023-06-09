<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pinjaman;

class Dasboard extends Controller
{
    function view_dasboard()
    {

        $jml_anggota = User::join('data_anggota', 'users.id', '=' , 'data_anggota.id')
        ->select('users.email','users.role','data_anggota.*')
        ->where('users.is_active', '=' , 1)
        ->where('users.role', '=' , 'anggota')
        ->count();

        $pinjaman_pending = Pinjaman::where(['acc' =>'0', 'is_active' => '1'])
                        ->count();

        return view('admin.dasboard', ['jml_anggota' => $jml_anggota, 'pinjaman_pending' => $pinjaman_pending]);
    }
}
