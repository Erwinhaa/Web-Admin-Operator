<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Gedung;
use Auth;
use Validator;

class GedungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function infogedung($id)
    {
        $gedung = Gedung::find($id);                                            
        $opid=$gedung->Operator_Id;
        $user = DB::table('operators')->where('id',$opid)->get();
        return view('gedung.info')->with('gedung',$gedung)->with('user',$user);
    }
    public function create($id)
    {
        $profile = DB::table('operators')->where('email',$id)->get();
        if (count($profile) == 0)
            return redirect('/operatorinfo')->with('error','Tidak Bisa Mengakses Page Ini');
        else{
            foreach($profile as $pro)
            $idoperator = $pro->id;
        
            $operator = DB::table('gedungs')->where('id',$idoperator)->get();
            if (count($operator) == 0)
             return view('gedung.create')->with('idoperator',$idoperator);
            else 
             return redirect('/operatorinfo')->with('error','Account Ini Tidak Bisa Menambahkan Gedung');

        }
        
    }
    public function custom()
    {
        $op_id = auth()->user()->id;
        $gedung = DB::table()->where('Operator_Id',$op_id)->get();
        return view('gedung.custom');
    }
    public function gedung()
    {
        return view('gedung.test');
    }
    //Menambah Data Gedung
    public function store(Request $request)
    {
        $gedung1 = DB::table('gedungs')->where('Nama_Gedung',$request->nama)->get();
        $gedung2 = DB::table('gedungs')->where('Alamat',$request->email)->get();
        $operator = DB::table('operators')->where('id',$request->opid)->get();  
        $validator =  Validator::make($request->all(), [   
            'biaya' => 'numeric',
        ]); 
        if ($validator->fails()) {
            return redirect()->action(  
                'GedungController@create',['id' => $email]
            )->with('error','Biaya Harus Angka');
        }     
        foreach($operator as $op){
            $email = $op->Email;
        }
        if(count($gedung1) > 0 || count($gedung2) >0){
            return redirect()->action(  
                'GedungController@create',['id' => $email]
            )->with('error','Alamat/Nama Gedung Tidak Boleh Sama');
        }
        
        DB::table('gedungs')->insert([
            'Operator_id' => $request->opid,
            'id' => $request->opid,
            'Nama_Gedung' => $request->nama,
            'Alamat' => $request->alamat,
            'Biaya' => $request->biaya,
        ]);
        $lantaih = DB::table('lantais')->get();
        foreach($lantaih as $lh){
            $lid = $lh->id;
        }
        if(count($lantaih) == 0){
            $lid = 0;
        }
        $lid = $lid+1;
        DB::table('lantais')->insert([
            'Gedung_Id' => $request->opid,
            'Nama_Lantai'=> '0',
            'id' => $lid,                
        ]);
        for($i=0;$i<30;$i++){
            DB::table('slot_parkirs')->insert([
                'Lantai_Id' => $lid,
            ]);
        }
        return redirect('/operatorinfo')->with('success','Data Gedung Berhasil Ditambah');        
    }
    
    public function update(Request $request)
    {
        $op = DB::table('gedungs')->where('Operator_Id',$request->opid)->get();
        $od = $request->idope;
        $oc = $request->opid;
        $validator =  Validator::make($request->all(), [   
            'Biaya' => 'numeric',
        ]); 
        if ($validator->fails()) {
            return redirect()->action(  
                'GedungController@create',['id' => $email]
            )->with('error','Biaya Harus Angka');
        } 
        
        if(count($op) == 0){
            DB::table('gedungs')->where('id',$request->id)->update([
                'Nama_Gedung' => $request->namagedung,
                'Alamat' => $request->alamat,
                'Operator_Id' => $od,
                'Biaya' => $request->biaya,
            ]);	
            return redirect('/operatorinfo')->with('success','Data Gedung Berhasil Diubah');
        }
        

    }
}
