<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Data_anggota;
use Illuminate\Support\Facades\File;
use App\Models\Simpanan;

class Kelola_anggota extends Controller
{
    function tabel_anggota()
    {
        return view('admin.tabel_anggota');
    }
    function get_anggota()
    {
        $data = User::join('data_anggota', 'users.id', '=' , 'data_anggota.id')
        ->select('users.email','users.role','data_anggota.*')
        ->where('users.is_active', '=' , 1)
        ->where('users.role', '=' , 'anggota')
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'berhasil ambil data',
            'data'    => $data ,
        ],200);
    }
    function aksi_tambah_anggota(Request $request)
    {
                $file_status = $_FILES["foto"]["name"];

                $request->validate([
                'nik' => ['required'],
                'nama' => ['required'],
                'email' => ['required', 'email'],
                'tanggal_lahir' => ['required'],
                'jenis_kelamin' => ['required'],
                'nomer_telpon' => ['required'],
                'alamat' => ['required'],
                'password' => ['required'],
                'status' => ['required'],
                'tanggal_masuk' => ['required'],
                'tempat_lahir' => ['required'],
                'foto' => ['image','mimes:jpg,png,jpeg,gif,svg','max:2048'],
            ]);

            $email = User::where('email', $request->email)->count();
            $nik = Data_anggota::where('nik', $request->nik)->count();

            if($email == 0 && $nik == 0 ){
            $id = User::insertGetId([
                'name' => $request->input('nama'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'created_by' => Auth()->user()->name,
            ]);

            Simpanan::insert([
                'id_anggota' => $id ,
                'saldo' => '0' ,
                'jenis' => 'pokok' ,
                'created_by' => Auth()->user()->name ,
            ]);
            Simpanan::insert([
                'id_anggota' => $id ,
                'saldo' => '0' ,
                'jenis' => 'wajib' ,
                'created_by' => Auth()->user()->name ,
            ]);
            Simpanan::insert([
                'id_anggota' => $id ,
                'saldo' => '0' ,
                'jenis' => 'sukarela' ,
                'created_by' => Auth()->user()->name ,
            ]);

            if($file_status){
                $image_path = $request->file('foto')->store('image/anggota', 'public');

                Data_anggota::insert([
                    'id'  => $id,
                    'nik'  => $request->input('nik'),
                    'npwp'  => $request->input('npwp'),
                    'nama'  => $request->input('nama'),
                    'tanggal_masuk'  => $request->input('tanggal_masuk'),
                    'tempat_lahir'  => $request->input('tempat_lahir'),
                    'tanggal_lahir'  => $request->input('tanggal_lahir'),
                    'jenis_kelamin'  => $request->input('jenis_kelamin'),
                    'nomor_hp'  => $request->input('nomer_telpon'),
                    'alamat'  => $request->input('alamat'),
                    'is_active'  => $request->input('status'),
                    'image'  => $image_path,
                ]);
            }else
            {
                Data_anggota::insert([
                    'id'  => $id,
                    'nik'  => $request->input('nik'),
                    'npwp'  => $request->input('npwp'),
                    'nama'  => $request->input('nama'),
                    'tanggal_masuk'  => $request->input('tanggal_masuk'),
                    'tempat_lahir'  => $request->input('tempat_lahir'),
                    'tanggal_lahir'  => $request->input('tanggal_lahir'),
                    'jenis_kelamin'  => $request->input('jenis_kelamin'),
                    'nomor_hp'  => $request->input('nomer_telpon'),
                    'alamat'  => $request->input('alamat'),
                    'is_active'  => $request->input('status'),
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'berhasil input data',
                'data'    => 'succes' 
            ],200);

        }else{
            return response()->json([
                'success' => true,
                'message' => 'email atau nik sudah ada !!',
                'data'    => 'error' 
            ],401);
        }
    }
    function edit_data(Request $request)
    {
        $file_status = $_FILES["foto"]["name"];
        $file_lama =  $request->input('foto_lama');

        $request->validate([
            'nik' => ['required'],
            'nama' => ['required'],
            'email' => ['required', 'email'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'nomer_telpon' => ['required'],
            'alamat' => ['required'],
            'status' => ['required'],
            'tanggal_masuk' => ['required'],
            'tempat_lahir' => ['required'],
            'foto' => ['image','mimes:jpg,png,jpeg,gif,svg','max:2048'],
        ]);


        if($file_status)
        {
            if($file_lama == 'null'){
                
                $image_path = $request->file('foto')->store('image/anggota', 'public');
                
                if($request->password){
                    User::where('id' , $request->id)
                    ->update([
                        'name' => $request->input('nama'),
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'updated_by' => Auth()->user()->name,
                    ]);
                }else{
                    User::where('id' , $request->id)
                    ->update([
                        'name' => $request->input('nama'),
                        'email' => $request->input('email'),
                        'updated_by' => Auth()->user()->name,
                    ]);
                }
         
                Data_anggota::where('id', $request->id)
                        ->update([
                            'nik'  => $request->input('nik'),
                            'npwp'  => $request->input('npwp'),
                            'nama'  => $request->input('nama'),
                            'tanggal_masuk'  => $request->input('tanggal_masuk'),
                            'tempat_lahir'  => $request->input('tempat_lahir'),
                            'tanggal_lahir'  => $request->input('tanggal_lahir'),
                            'jenis_kelamin'  => $request->input('jenis_kelamin'),
                            'nomor_hp'  => $request->input('nomer_telpon'),
                            'alamat'  => $request->input('alamat'),
                            'is_active'  => $request->input('status'),
                            'image'  => $image_path,
                        ]);
                        return response()->json([
                            'success' => true,
                            'message' => 'berhasil update data',
                            'data'    => 'succes' 
                        ],200);
                

            }else{
               if(File::exists(public_path('storage/'.$file_lama))){
                  File::delete(public_path('storage/'.$file_lama));

                  $image_path = $request->file('foto')->store('image/anggota', 'public');

                if($request->password){
                    User::where('id' , $request->id)
                    ->update([
                        'name' => $request->input('nama'),
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'updated_by' => Auth()->user()->name,
                    ]);
                }else{
                    User::where('id' , $request->id)
                    ->update([
                        'name' => $request->input('nama'),
                        'email' => $request->input('email'),
                        'updated_by' => Auth()->user()->name,
                    ]);
                }
                Data_anggota::where('id', $request->id)
                  ->update([
                    'nik'  => $request->input('nik'),
                    'npwp'  => $request->input('npwp'),
                    'nama'  => $request->input('nama'),
                    'tanggal_masuk'  => $request->input('tanggal_masuk'),
                    'tempat_lahir'  => $request->input('tempat_lahir'),
                    'tanggal_lahir'  => $request->input('tanggal_lahir'),
                    'jenis_kelamin'  => $request->input('jenis_kelamin'),
                    'nomor_hp'  => $request->input('nomer_telpon'),
                    'alamat'  => $request->input('alamat'),
                    'is_active'  => $request->input('status'),
                      'image'  => $image_path,
                  ]);
                return response()->json([
                    'success' => true,
                    'message' => 'berhasil update data',
                    'data'    => 'succes' 
                ],200);

               }else{
                    return response()->json([
                        'success' => true,
                        'message' => 'update data gagal',
                        'data'    => 'Gagal' 
                    ],500);
               }

            }

        }else{
            if($request->password){
                User::where('id' , $request->id)
                ->update([
                    'name' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'updated_by' => Auth()->user()->name,
                ]);
            }else{
                User::where('id' , $request->id)
                ->update([
                    'name' => $request->input('nama'),
                    'email' => $request->input('email'),
                    'updated_by' => Auth()->user()->name,
                ]);
            }
          Data_anggota::where('id', $request->id)
            ->update([
                'nik'  => $request->input('nik'),
                'npwp'  => $request->input('npwp'),
                'nama'  => $request->input('nama'),
                'tanggal_masuk'  => $request->input('tanggal_masuk'),
                'tempat_lahir'  => $request->input('tempat_lahir'),
                'tanggal_lahir'  => $request->input('tanggal_lahir'),
                'jenis_kelamin'  => $request->input('jenis_kelamin'),
                'nomor_hp'  => $request->input('nomer_telpon'),
                'alamat'  => $request->input('alamat'),
                'is_active'  => $request->input('status'),
            ]);
            return response()->json([
                'success' => true,
                'message' => 'berhasil update data',
                'data'    => 'succes' 
            ],200);
        }
    }
    function delete(Request $request)
    {
        User::where('id' , $request->id)
        ->update([
            'is_active' => '0',
            'updated_by' => Auth()->user()->name,
        ]);
        Data_anggota::where('id' , $request->id)
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
