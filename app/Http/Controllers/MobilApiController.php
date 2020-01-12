<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class MobilApiController extends Controller
{
    public function tambahmobil(Request $request){
        $validator =  Validator::make($request->all(), [ 
            'tipe' => 'required', 
            'noplat' => 'required', 
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=> true,
                'pesan' => 'Ada Field Kosong',
            ]);            
        }
        $mobil = DB::table('mobils')->where('user_id',$request->id)->get();
        if(count($mobil) > 2){
            return response()->json([
                'error' => true,
                'pesan' => 'Tidak Bisa Menambahkan Mobil',
            ]);
        }
        $no = $request->noplat;
        $no = str_replace(' ', '', $no);
        $noe= strtoupper($no);
        $ned = strtoupper($request->tipe);
        $mobil = DB::table('mobils')->where('No_plat',$request->noplat)->get();
        if(count($mobil) == 1){
            return response()->json([
                'error' => true,
                'pesan' => 'No Plat Sudah Terdaftar',
            ]);
        }
        DB::table('mobils')->insert([
            'user_id' => $request->id,
            'Tipe' => $ned,
            'No_Plat' => $noe,
        ]);
        return response()->json([
            'error' => false,
            'pesan' => 'Berhasil Menambahkan',
        ]);
        
        
    }
    public function edit($id)
    {
        $mobil = DB::table('mobils')->where('id',$id)->get();
        return response()->json([
            'mobil' => $mobil,
        ]);
    }
    public function update(Request $request){
        $validator =  Validator::make($request->all(), [ 
            'tipe' => 'required', 
            'noplat' => 'required', 
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>true,
                'pesan' => 'Ada Field Kosong',
            ]);            
        }
        $no = $request->noplat;
        $no = str_replace(' ', '', $no);
        $noe= strtoupper($no);
        $mobil = DB::table('mobils')->where('No_plat',$request->noplat)->get();
        if(count($mobil) == 1){
            return response()->json([
                'error' => true,
                'pesan' => 'No Plat Sudah Terdaftar',
            ]);
        }
        DB::table('mobils')->where('user_id',$request->id)->update([
            'Tipe' => $request->tipe,
            'No_Plat' => $noe,
        ]);
        return response()->json([
            'error' => false,
            'pesan' => 'Berhasil Mengedit',
        ]);

    }
    public function delete($id){
        $ticket = DB::table('tickets')->where('Mobil_Id',$id)->wherebetween('Status_Ticket',array('0','2'))->get();
        if(count($ticket) > 0){
            return response()->json([
                'error' => true,
                'pesan' => 'Mobil Sedang Digunakan',
             ]);
        }
        
        DB::table('mobils')->where('id',$id)->delete();
        return response()->json([
           'error' => false,
           'pesan' => 'Berhasil Menghapus Data Mobil',
        ]);
    } 
  
    public function cariuser(Request $request){
        $user = DB::table('users')->where('id',$request->cari)->get();
        return response()->json([
            'user' => $user,
         ]);
    }  
   
}
