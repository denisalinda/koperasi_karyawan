<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class Sorting {

    public static function sorting_data_pinjam($data) {
        $data_array = [];
        $data_array_2 = [];

        $no = 0;
        foreach($data as $key => $value)
        {
            echo $value->nama;
                // if(empty($data_array)){
                //     $new_data = ['id' => $value->id,'nama' => $value->nama,'nik' => $value->nik];
                //     array_push($data_array, $new_data);
                //     $no = 0;
                // }

             

                // if(  $value->nik != $data_array[$no]['nik']){
                //     $new_data = ['id' => $value->id,'nama' => $value->nama,'nik' => $value->nik];
                //     array_push($data_array, $new_data);
                //     $no++;

                // }
        }
       
    //    $data =  array_map(function($v){

    //     if($v['nama'] == $v['nama']){
    //         return [
    //             'data' => $v['nama']
    //         ];
    //     }
            
    //     }, $data_array);

        
        // print_r($data);
        die();

        return $data_array;
    }
}