<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operator;
use DB;
use Redirect;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //Menampilkan Halaman Admin 
    public function index()
    {
        return redirect()->action(
            'AdminController@opindex'
        );
    }
    //Menampilkan List Operator 
    public function opindex()
    {
        $operator = DB::table('operators')->get();
        $gedung = DB::table('gedungs')->get();
        
        return view('admin.indexoperator')->with('operator',$operator)->with('gedung',$gedung);
    }
    public function search (Request $request)
    {       		
		 $cari = $request->cari;
         $operator = DB::table('operators')->where('Name_Operator','like',"%".$cari."%")->get();  
         $gedung = DB::table('gedungs')->get(); 
         return view('admin.indexoperator')->with('gedung',$gedung)->with('operator',$operator);
    }
    public function searchuser(Request $request){
        $cari = $request->cari;
        $user = DB::table('users')->where('name','like',"%".$cari."%")->get();
        return view('admin.indexuser')->with('user',$user);
    }
    //Menampilkan Info Lengkap Operator
    public function infooperator($id)
    {   
        $operator = DB::table('operators')->where('id',$id)->get();
        $gedung = DB::table('gedungs')->where('Operator_Id',$id)->get();
        return view('admin.infooperator')->with('gedung',$gedung)->with('operator',$operator);
    }
    //Menampilkan Info Lengkap User
    public function infouser(){
        $user = DB::table('users')->get();
        return view('admin.indexuser')->with('user',$user);
    }
    //Menampilkan Halaman Daftar Operator
    public function daftar()
    {
        return view('admin.buatoperator');
    }
    //Menampilkan Halam Delete Confirm Opeartor
    public function deleteconfirm($id)
    {
        
        $operator = DB::table('operators')->where('id',$id)->get();
        $gedung = DB::table('gedungs')->where('Operator_Id',$id)->get();
        return view('admin.deleteconfirmoperator')->with('gedung',$gedung)->with('operator',$operator);
    }
    //Daftar Operator
    public function store(Request $request)
    {   

        $w = $request->password;
        $e = $request->password2;
        $find = DB::table('operators')->where('Email',$request->email)->get();
     
        if($w == $e && count($find) == 0){
            DB::table('operators')->insert([
                'Name_Operator' => $request->nama,
                'Email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->action(
                'GedungController@create',['id' => $request->email]
            )->with('success','Berhasil Mendaftarkan Account Operator')->with('email',$request->email);
        }         
        elseif(count($find) != 0)
            return redirect('/daftarop')->with('error','Email Yang Anda Masukan Sudah Terdaftar');  
        elseif($w != $e){
            return redirect('/daftarop')->with('error','Confirm Password Tidak Sesuai Dengan Password');
        }
    }
    //Menampilkan Data Operator
    public function edit($id)
    {
        $operator = DB::table('operators')->where('id',$id)->get();
        $gedung = DB::table('gedungs')->where('id',$id)->get();
        return view('admin.editoperator')->with('gedung',$gedung)->with('operator',$operator);

    }
    //Menampilkan Data User
    Public function datauser($id)
    {
        $user = DB::table('users')->where('id',$id)->get();
        $mobil = DB::table('mobils')->where('User_Id',$id)->get();
        $mobilshare = DB::table('mobils')->where('Share_Id',$id)->get();
        return view('admin.edituser')->with('user',$user)->with('mobil',$mobil)->with('mobilshare',$mobilshare);
    }
    //Hapus Data Gedung Dan Operator
    public function hapus(Request $request)
    { 
        $lantai = DB::table('lantais')->where('Gedung_Id',$request->gedungid)->get();
        foreach($lantai as $l){
            $lid = $l->id;
            $slot1= DB::table('slot_parkirs')->where('Status_Slot','3')->where('Lantai_Id',$lid)->get();
            $slot2= DB::table('slot_parkirs')->where('Status_Slot','4')->where('Lantai_Id',$lid)->get();
            if(count($slot1) > 0 || count($slot2) >0){
                return redirect('/operatorinfo')->with('error','Tidak Bisa Menghapus Data Operator');               
            }
        }
            DB::table('operators')->where('id',$request->id)->delete();
            DB::table('gedungs')->where('Operator_Id',$request->id)->delete();
            foreach($lantai as $l){
                DB::table('slot_parkirs')->where('Lantai_Id',$l->id)->delete();
                DB::table('lantais')->where('id',$l->id)->delete();
            }
            return redirect('/operatorinfo')->with('success','Data Gedung Dan Operator Berhasil Dihapus');
        
    }
    //Mengedit Data Operator
    public function editaccount(Request $request){
        $find = DB::table('operators')->where('Email',$request->email)->get();

        if(count($find) == 0){
            DB::table('operators')->where('id',$request->id)->update([
                'Name_Operator' => $request->nama,
                'Email' => $request->email,
            ]); 
            return redirect('/operatorinfo')->with('success','Berhasil Mengedit Data Operator');
        }
        else if($request->email == $request->email1){
            DB::table('operators')->where('id',$request->id)->update([
                'Name_Operator' => $request->nama,
                'Email' => $request->email,
            ]); 
            return redirect('/operatorinfo')->with('success','Berhasil Mengedit Data Operator');
        }
        else
             return redirect()->action(
                'AdminController@infooperator',['id' => $request->id]
            )->with('error','Email Yang Dimasukan Sudah Terdaftar');
    }
    //Mengganti Password Operator
    public function ganti(Request $request)
    {
        $ide = $request->id;
        $passw = Hash::make($request->password);
        if($request->password == $request->password2){         
            //if (Hash::check($request->oldpassword, $request->pass)) {
                DB::table('operators')->where('id',$request->id)->update([
                    'Email' => $request->email,
                    'Password'=>$passw,
              ]);
                return redirect()->action(
                    'AdminController@edit',['id' => $ide]
                )->with('success','Password Berhasil Diganti');
            //}
            //else{
               // return redirect()->action(
                   // 'AdminController@edit',['id' => $ide]
               // )->with('error','Password Lama Salah');               
            //}             
        }     
        else{
            return redirect()->action(
                'AdminController@edit',['id' => $ide]
            )->with('error','Password Dan Confirm Password Tidak Sama');
        }

    }
}
