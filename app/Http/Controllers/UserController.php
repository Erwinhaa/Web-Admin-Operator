<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Validator;
use DB;

class UserController extends Controller
{
    
    public function login(Request $request){
        if(strlen($request->email) == 0 || strlen($request->password) == 0){
            return response()->json([
                'error'=>true,
                'pesan'=>'Ada Field Yang Kosong',
            ]);  
        }
        $emailuser=$request->email;
        $datauser=DB::table('users')->where('Email',$emailuser)->get();
        $passw = $request->password;
        foreach($datauser as $du){
            $pass1=$du->password;
            $nama =$du->name;
        }
        
        if(count($datauser) == 0){
            return response()->json([
                'error'=>true,
                'pesan'=>'Email/Password Salah',
            ]);  
        }
        if (Hash::check($request->password, $pass1)){
            $users=DB::table('users')->where('Email',$emailuser)->get();
            foreach($users as $us){
                $id = $us->id;
                $name = $us->name;
                $email = $us->Email;
                $nohp = $us->No_Hp;
                $saldo = $us->Saldo;
            }
            return response()->json([
                'error'=>false,
                'pesan'=>'Berhasil Login',
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'nohp' => $nohp,
                'saldo' => $saldo,
            ]);  
        }
        else{
            return response()->json([
                'error'=>true,
                'pesan'=>'Email/Password Salah',
            ]);  
        }
    }
    //Fungsi Untuk Daftar Account
    public function register(Request $request){
          
        //Fungsi Untuk Validate Data Tidak kosong
        $validator =  Validator::make($request->all(), [ 
            'email' => 'email',  
            'nohp' => 'numeric',
        ]);
        $a=strlen($request->nama); $b=strlen($request->email);$c=strlen($request->nohp);
        $d=strlen($request->password); $e=strlen($request->password1);
        if($a == 0 || $b==0 || $c==0 ||  $d==0 || $e==0 ){
            return response()->json([
            'error' => true,
            'pesan' => 'Ada Field Yang Kosong',
        ]);             
        }
        if ($validator->fails()) {
            return response()->json([
                'error'=>true,
                'pesan' =>'Email/No Hp Harus Valid'
            ]);            
        }     
        //Validator Untuk Passowrd1 == Password2
        if($request->password1 != $request->password){
            return response()->json([
                'error' => true,
                'pesan' => 'Password Tidak Sama',
            ]);
        }
        $nohpuser = '0'.$request->nohp;
        $checknohp = DB::table('users')->where('No_Hp',$nohpuser)->get();
        $checkemail = DB::table('users')->where('email',$request->email)->get();
        //Mengecheck Apakah Email Atau NoHp Sudah Terdaftar
        if(count($checkemail) != 0 || count($checknohp) != 0){
            return response()->json([
                'error' => true,
                'pesan' => 'Email Atau NO HP Sudah Terdaftar',
            ]);
        }
        
        //Validator Domain Email
        
        //$domain = substr($request->email,-10);
        //if(strtolower($domain) != "@gmail.com"){
            //return response()->json([
                //'error' => true,
                //'pesan' => 'Domain Email Harus (@gmail.com)',
           // ]);
        //}         
        DB::table('users')->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'No_Hp'=> $nohpuser,
        ]);
        return response()->json([
            'error' => false,
        ]);
    }
    //Fungsi Untuk Menampilkan Profile
    public function profile($id){
        $user = DB::table('users')->where('id',$id)->get();
        foreach($user as $u){
            $nama = $u->name;
            $email = $u->Email; 
            $saldo = $u->Saldo;
            $nohp = $u->No_Hp;
        }
		$nomorhp = substr($nohp,1);
        $mobil = DB::table('mobils')->where('user_id',$id)->get();
        $mobil1 = DB::table('mobils')->where('Share_Id',$id)->get();
        return response()->json([
            'mobil' => $mobil,
            'nama' => $nama,
            'email' => $email,
            'saldo' => $saldo,
            'nohp' => $nomorhp,
            'mobil1' => $mobil1,
        ]);
    }
    //Fungsi Untuk Edit Profile
    public function editprofile(Request $request){
        $validator =  Validator::make($request->all(), [ 
            'nohp' => 'numeric',
        ]);
        $b=strlen($request->nama);$c=strlen($request->nohp);
        if( $b==0 || $c==0 ){
            return response()->json([
            'error' => true,
            'pesan' => 'Ada Field Yang Kosong',
        ]);  
            }
        if ($validator->fails()) {
            return response()->json([
                'error'=>true,
                'pesan' =>'No Hp Harus Valid',
            ]);            
        }
        $user = DB::table('users')->where('id',$request->id)->get();
        foreach($user as $us){
            $nohpus = $us->No_Hp;
        }
        if($nohpus == $request->nohp){
            DB::table('users')->where('id',$request->id)->update([
                'name' => $request->nama,
            ]);
            return response()->json([
                'error' => false,
                'pesan' => 'Berhasil Mengedit Profile1',
            ]);
        }
        $nohpuser = '0'.$request->nohp;
        $checknohp = DB::table('users')->where('No_Hp',$nohpuser)->get();
        //Mengecheck Apakah Email Atau NoHp Sudah Terdaftar
        if(count($checknohp) != 0){
            return response()->json([
                'error' => true,
                'pesan' => 'No HP Sudah Terdaftar',
            ]);
        }  
        //nomor hp belum bisa 
        DB::table('users')->where('id',$request->id)->update([
            'name' => $request->nama,
            'No_Hp' => $nohpuser,
        ]);
        return response()->json([
            'error' => false,
            'pesan' => 'Berhasil Mengedit Profile',
        ]);
     
    }
    public function gantipassword(Request $request){
        
        //Password == password lama
        //password1 == password baru 1
        //password2 == passwordbaru 2
        $a= strlen($request->password);
        $b= strlen($request->password1);
        $c= strlen($request->password2);
        if($a == 0 || $b == 0 || $c==0){
            return response()->json([
                'pesan' => 'Ada Field Yang Kosong',
                'error' => true,
            ]);
        }
        if($request->password1 != $request->password2){
            return response()->json([
                'pesan' => 'Password dan Confirm Password Tidak Sama',
                'error' => true,
            ]);
        }
        $user = DB::table('users')->where('id',$request->id)->get();
        foreach($user as $us){
            $pass1 = $us->password;
        }   
        if (Hash::check($request->password, $pass1)){
            DB::table('users')->where('id',$request->id)->update([
                'password' => Hash::make($request->password1),
            ]);
            return response()->json([
                'pesan' => 'Berhasi Mengedit Profil',
                'error' => false,
            ]);
        }
        else{
            return response()->json([
                'pesan' => 'Password Lama Salah',
                'error' => true,
            ]);
        }
    }
}