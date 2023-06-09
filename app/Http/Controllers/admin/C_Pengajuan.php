<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Anggsuran;

class C_Pengajuan extends Controller
{
    function tabel_pengajuan()
    {
        return view('admin.pengajuan_pinjaman');
    }

    function get_data_pengajuan()
    {
        $data = Pinjaman::join('users','users.id','=','pinjaman.id_nama_anggota')
        ->join('data_anggota','data_anggota.id','=','pinjaman.id_nama_anggota')
        ->where('pinjaman.is_active', '=' , 1)
        ->where('pinjaman.acc', '=' , '3')
        ->select('users.email','users.name','pinjaman.*','data_anggota.nama','data_anggota.alamat','data_anggota.nomor_hp')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data 
        ],200);
    }

    function acc_pengajuan(Request $request)
    {
        if($request->status == "acc"){

            $where =  Pinjaman::where('id', $request->id) ->first();

            $tanggal_awal = date('Y-m-d');
            $result = preg_replace("/[^0-9]/", "", $request->rupiah);

            $nilai = round($result/$request->waktu);

            $hasil = round(($nilai*($where->bunga/100))+$nilai);

            $data_array = [];
            for ($i = 1; $i <= $request->waktu; $i++) {
                $new_fruit =   ['id_pinjaman' => $request->id, 'id_anggota' => $request->id_anggota, 'angsuran' => $hasil 
                , 'tanggal_jatuh_tempo' => date('Y-m-d', strtotime('+'.$i.' month', strtotime(  $tanggal_awal )))];
                array_push($data_array, $new_fruit);
              }

            Anggsuran::insert($data_array);

            Pinjaman::where('id', $request->id)
            ->update([
                'acc' => '1'
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'berhasil update data',
                'data'    => 'ditolak'
            ],200);


        }elseif($request->status == "tolak"){

            Pinjaman::where('id', $request->id)
                    ->update([
                        'acc' => '2'
                    ]);
            
            return response()->json([
                'success' => true,
                'message' => 'berhasil update data',
                'data'    => 'ditolak'
            ],200);

        }else{
            return response()->json([
                'success' => false,
                'message' => 'kesalahan',
                'data'    => 'kesalahan'
            ],401);
        }
    }


    function get_angsuran()
    {
        $data = Anggsuran::join('pinjaman','pinjaman.id','=','anggsuran.id_pinjaman')
                        ->join('anggsuran','pinjaman.id_nama_anggota','=','anggsuran.id')
                        ->get();

        print_r($data);
    }
    

}
