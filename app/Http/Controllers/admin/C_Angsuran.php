<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggsuran;
use App\Models\Pinjaman;


class C_Angsuran extends Controller
{
    function tabel_angsuran()
    {
        return view('admin.tabel_angsuran');
    }
    function get_data_angsuran()
    {
        $data = Anggsuran::join('pinjaman', 'pinjaman.id','=','anggsuran.id_pinjaman')
                            ->join('data_anggota', 'data_anggota.id','=','anggsuran.id_anggota')
                            ->select('anggsuran.*','pinjaman.jumlah_pinjman_diajukan','data_anggota.nama','data_anggota.nik')
                            ->get();

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data 
        ],200);
    }
    function bayar_angsuran(Request $request)
    {
        Anggsuran::where('id', $request->id)
                ->update([
                    'lunas' => '1',
                    'updated_by' => Auth()->user()->id,
                ]);
        
        $data_angsuran = Anggsuran::where(['id_pinjaman' => $request->id_pinjaman, 'lunas' => '0'])->count();
      

        if($data_angsuran == 0){
            Pinjaman::where('id', $request->id_pinjaman)->update([
                'lunas' => '1'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'berhasil bayar',
            'data'    => 'berhasil bayar' 
        ],200);
    }
}
