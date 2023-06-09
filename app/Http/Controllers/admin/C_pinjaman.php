<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pinjaman;

class C_pinjaman extends Controller
{
    function tabel_pengajuan()
    {
        $data_user = User::where('users.is_active', '=' , 1)
        ->get();

        $data_array = [
            'user' => $data_user
        ];
        return view('admin.tabel_pengajuan', $data_array);
    }

    function tambah_pengajuan(Request $request)
    {
        $request->validate([
            'nama_anggota' => ['required'],
            'rupiah' => ['required'],
            'jangka_waktu' => ['required'],
            'tujuan' => ['required'],
            'persen' => ['required'],
        ]);

        Pinjaman::insert([
            'id_nama_anggota' => $request->input('nama_anggota'),
            'jumlah_pinjman_diajukan' => $request->input('rupiah'),
            'jangka_waktu' => $request->input('jangka_waktu'),
            'tujuan_pinjaman' => $request->input('tujuan'),
            'bunga' => $request->input('persen'),
            'created_by' =>  Auth()->user()->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil update data',
            'data'    => 'succes'
        ],200);
    }

    function get_data_pinjaman()
    {

       $data = Pinjaman::join('users','users.id','=','pinjaman.id_nama_anggota')
                    ->join('data_anggota','data_anggota.id','=','pinjaman.id_nama_anggota')
                    ->where('pinjaman.is_active', '=' , 1)
                    ->select('data_anggota.nik','users.name','pinjaman.*')
                    ->get();

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data
        ],200);
    }

    function edit_pengajuan(Request $request)
    {
        $request->validate([
            'nama_anggota' => ['required'],
            'rupiah' => ['required'],
            'jangka_waktu' => ['required'],
            'tujuan' => ['required'],
            'persen' => ['required'],
        ]);

        Pinjaman::where('id', $request->id)
                ->update([
                    'id_nama_anggota' => $request->input('nama_anggota'),
                    'jumlah_pinjman_diajukan' => $request->input('rupiah'),
                    'jangka_waktu' => $request->input('jangka_waktu'),
                    'tujuan_pinjaman' => $request->input('tujuan'),
                    'bunga' => $request->input('persen'),
                    'updated_by' =>  Auth()->user()->name,
                  ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil update data',
            'data'    => 'succes'
        ],200);
    }

    function hapus_pengajuan(Request $request)
    {
        Pinjaman::where('id', $request->id)
                ->update([
                    'is_active' => '0',
                  ]);

        return response()->json([
            'success' => true,
            'message' => 'berhasil update data',
            'data'    => 'succes'
        ],200);
    }

    function bukti_pencairan(Request $request)
    {
        $request->validate([
            'bukti' => ['image','mimes:jpg,png,jpeg,gif,svg','max:2048'],
            'tanggal_bukti' => ['required'],
            'pencairan' => ['required'],
        ]);

        $image_path = $request->file('bukti')->store('image/pencairan', 'public');

        Pinjaman::where('id', $request->id_bukti)
        ->update([
            'tanggal_pencarian' => $request->tanggal_bukti,
            'bukti_pencairan' => $image_path,
            'pencairan_melalui' =>  $request->pencairan,
            'acc' =>   '4',
          ]);

    }

    function get_pinjaman()
    {
        $data = Pinjaman::join('users','users.id','=','pinjaman.id_nama_anggota')
        ->join('data_anggota','data_anggota.id','=','pinjaman.id_nama_anggota')
        ->where('pinjaman.is_active', '=' , 1)
        ->where('pinjaman.acc', '=' , '0')
        ->select('users.email','users.name','pinjaman.*','data_anggota.nama','data_anggota.alamat','data_anggota.nomor_hp','data_anggota.nik')
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data
        ],200);
    }

    function tabel_rekomendasi()
    {
        return view('admin.rekomendasi');
    }

    function rekomendasi_aksi(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);

        Pinjaman::where('id', $request->id)
        ->update([
            'acc' =>   '3',
          ]);
    }
    function rekomendasi_aksi_tolak(Request $request)
    {
        $request->validate([
            'id' => ['required'],
        ]);

        Pinjaman::where('id', $request->id)
        ->update([
            'acc' =>   '2',
          ]);
    }
}
