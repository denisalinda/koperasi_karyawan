<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Riwayat_transaksi;

class C_simpanan extends Controller
{
    function tabel_saldo()
    {
        return view('admin.tabel_simpanan');
    }
    function tabel_simpanan_sukarela()
    {
        return view('admin.tabel_simpanan_sukarela');
    }
    function tabel_simpanan_wajib()
    {
        return view('admin.tabel_simpanan_wajib');
    }
    function get_simpanan_wajib()
    {
       $data = Simpanan::join('data_anggota', 'data_anggota.id', '=' ,'simpanan.id_anggota')
                ->select('data_anggota.nama', 'data_anggota.nik', 'simpanan.*')
                ->where('jenis','wajib')
                ->get();
        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data ,
        ],200);
        
    }
    function get_simpanan_sukarela()
    {
       $data = Simpanan::join('data_anggota', 'data_anggota.id', '=' ,'simpanan.id_anggota')
                ->select('data_anggota.nama', 'data_anggota.nik', 'simpanan.*')
                ->where('jenis','sukarela')
                ->get();
        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data ,
        ],200);
        
    }
    function get_simpanan()
    {
       $data = Simpanan::join('data_anggota', 'data_anggota.id', '=' ,'simpanan.id_anggota')
                ->select('data_anggota.nama', 'data_anggota.nik', 'simpanan.*')
                ->where('jenis','pokok')
                ->get();
        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data ,
        ],200);
        
    }
    function setor_simpanan(Request $request)
    {
        $request->validate([
            'id' => ['required'],
            'rupiah' => ['required'],
            'id_anggota' => ['required'],
            'jenis_simpanan' => ['required'],
        ]);
        $data = Simpanan::where('id',$request->id)->first();
        $result = preg_replace("/[^0-9]/", "", $request->rupiah);

        $saldo = $data->saldo +  $result;

        Simpanan::where('id', $request->id)
                    ->update([
                        'saldo' => $saldo
                    ]);

        Riwayat_transaksi::insert([
            'id_anggota' => $request->id_anggota,
            'nominal' => $result,
            'jenis' => 'setor',
            'jenis_simpanan' =>  $request->jenis_simpanan,
            'created_by' => Auth()->user()->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil update data',
            'data'    => 'sukses' ,
        ],200);
    }

    function tarik_saldo(Request $request)
    {
        $request->validate([
            'id_tarik' => ['required'],
            'rupiah_tarik' => ['required'],
            'id_anggota_tarik' => ['required'],
            'jenis_simpanan' => ['required'],
        ]);

        $data = Simpanan::where('id',$request->id_tarik)->first();
        $result = preg_replace("/[^0-9]/", "", $request->rupiah_tarik);

        if($data->saldo < $result){
            return response()->json([
                'success' => true,
                'message' => 'gagal tarik saldo',
                'data'    => 'gagal' ,
            ],200);
        }else{


            $saldo = $data->saldo - $result;

            Simpanan::where('id', $request->id_tarik)
                        ->update([
                            'saldo' => $saldo
                        ]);
    
            Riwayat_transaksi::insert([
                'id_anggota' => $request->id_anggota_tarik,
                'nominal' => $result,
                'jenis' => 'penarikan',
                'jenis_simpanan' =>  $request->jenis_simpanan,
                'created_by' => Auth()->user()->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'berhasil update data',
                'data'    => 'sukses' ,
            ],200);

        }
    }

    function tabel_riwayat()
    {
        return view('admin.tabel_riwayat_transaksi');
    }

    function get_data()
    {
     $data = Riwayat_transaksi::join('data_anggota', 'data_anggota.id', '=' ,'riwayat_transaksi.id_anggota')
        ->select('data_anggota.nama', 'data_anggota.nik', 'riwayat_transaksi.*')
        ->get();
            return response()->json([
                'success' => true,
                'message' => 'berhasil ambil data',
                'data'    => $data ,
            ],200);
    }
}
