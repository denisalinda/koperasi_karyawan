<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit_usaha;

class Kelola_unit_usaha extends Controller
{
    function tabel_unit_usaha()
    {
        return view('admin.tabel_unit_usaha');
    }

    function get_unit_usaha()
    {
        $data = Unit_usaha::where('unit_usaha.is_active', '=' , 1)
                        ->get();

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data ,
        ],200);
    }

    function tambah_unit_usaha(Request $request)
    {
        $request->validate([
            'nama_pemesan' => ['required'],
            'jasa' => ['required'],
            'tanggal' => ['required'],
            'harga' => ['required'],
        ]);

        Unit_usaha::insert([
            'nama_pemesan' => $request->input('nama_pemesan'),
            'jasa' => $request->input('jasa'),
            'tanggal' => $request->input('tanggal'),
            'harga' => $request->input('harga'),
            'created_by' => Auth()->user()->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
        ],200);
    }

    function edit_unit_usaha(Request $request)
    {
        $request->validate([
            'nama_pemesan' => ['required'],
            'jasa' => ['required'],
            'tanggal' => ['required'],
            'harga' => ['required'],
        ]);

        Unit_usaha::where('id' , $request->id)
        ->update([
            'nama_pemesan' => $request->input('nama_pemesan'),
            'jasa' => $request->input('jasa'),
            'tanggal' => $request->input('tanggal'),
            'harga' => $request->input('harga'),
            'updated_by' => Auth()->user()->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
        ],200);
    }

    function hapus_unit_usaha(Request $request)
    {
        Unit_usaha::where('id' , $request->id)
        ->update([
            'is_active' => '0',
        ]);
        return response()->json([
            'success' => true,
            'message' => 'berhasil update data',
            'data'    => 'succes' 
        ],200);
    }
}
