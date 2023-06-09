<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggsuran;
Use App\Models\Pinjaman;
Use App\Models\Data_anggota;
Use App\Helpers\Sorting;

class C_Data_anggota extends Controller
{
    function index()
    {
        return view('admin.anggota_pinjaman');
    }
    
    function get_data()
    {
        $data = Data_anggota::join('pinjaman', 'pinjaman.id_nama_anggota','data_anggota.id')
                    ->where(['pinjaman.acc' => '4'])
                    ->select('data_anggota.id','data_anggota.nama','data_anggota.nik')
                    ->distinct()
                    ->get();

    //    $data_array = Sorting::sorting_data_pinjam($data);
        
        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data 
        ],200);
    }

    function data_anggota($id)
    {
        $data = Data_anggota::join('users', 'users.id','=','data_anggota.id')
                    ->where('data_anggota.nik',$id)
                    ->select('data_anggota.id','data_anggota.nik', 'data_anggota.nama','data_anggota.image','data_anggota.is_active', 'users.email')
                    ->first();
        return view('admin.detail_anggota_pinjam',['anggota' => $data]);
    }

    function get_data_angsuran(Request $request)
    {
        $data = Pinjaman::where(['id_nama_anggota' => $request->id , 'acc' => '4' ])->get();
        
        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data
        ],200);
    }

    function get_angsuran(Request $request)
    {
        $data =  Anggsuran::join('data_anggota','data_anggota.id','=','anggsuran.id_anggota')
                            ->select('anggsuran.id_pinjaman','anggsuran.id','anggsuran.tanggal_jatuh_tempo','anggsuran.updated_at','anggsuran.angsuran','anggsuran.lunas','data_anggota.nama','data_anggota.nik')
                            ->where('id_pinjaman', $request->id)->get();

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data
        ],200);
    }
}
