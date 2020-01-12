<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class LantaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //Menampilkan Halaman Utama
    public function index($id)
    {
        $lantai = DB::table('lantais')->where('id',$id)->get();
        if(count($lantai) == 0){
            return redirect('/slot/custom')->with('error','Page Tidak Dapat Ditemukan');
        }
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantai')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)
        ->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2);
    }
    //Menampilkan Halaman Set Pintu 
    public function setpintu($id){
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaisetpintu')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2
        );
    }
    //Menampilkan Halaman Set Arah 
    public function setarah($id){
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaisetarah')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2
        );
    }
    //Halaman Delete Item
    Public function deleteitem($id){
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaideleteitem')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2);
   
    }
    //Demo Tambah Lantai
    public function index1($id)
    {
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaitest')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2
        );
    }
    //Demo Delete Lantai
    public function index2($id)
    {
        $lantai = DB::table('lantais')->where('id',$id)->get();
        
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaidelete')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2);
    }
    public function slotindex($id)
    {
        
        $infoslot = DB::table('slot_parkirs')->where('id',$id)->get();
        foreach ($infoslot as $s){
            $lid = $s->Lantai_Id;
            $status = $s->Status_Slot;
        }
        if($status == 0 || $status == 2){
            $slot1= DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
            $lantai = DB::table('lantais')->where('id',$lid)->get();
            return view('lantai.slotlantai')->with('infoslot',$infoslot)->with('slot1',$slot1)->with('lantai',$lantai);
        }
        else{
            return redirect()->action(  
                'LantaiController@index',['id' => $lid]
            )->with('error','Tidak Bisa Mengakses');
        }
    }
    //testing delete
    public function deletetest(Request $request)
    {
        
        $g = $request->knk;
        $d = count($g);   
        $total = 0 ;
        $total = $request->jl - $d;
        
        for($i=0;$i<$d;$i++){
            
            DB::table('slot_parkirs')->where('id',$g[$i])->update([
                'Status_Slot' => 0,
                'Nama_Slot' =>  $request->d, 
            ]);
        }
        DB::table('lantais')->where('id',$request->lid)->update([
                'Jumlah_Slot' => $total,
        ]);     
        
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil Menghapus');
    }
    //delete item
    public function itemdelete(Request $request)
    { 
        $g = $request->knk;
        $d = count($g);   
        for($i=0;$i<$d;$i++){
            
            DB::table('slot_parkirs')->where('id',$g[$i])->update([
                'Status_Slot' => 0,
            ]);
        }
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil Menghapus Item');
    }
    //Tambah PintU
    public function tambahpintu(Request $request){
        $g= $request->knk;
        $slotpark = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->where('Status_Slot',$request->status_slot)->get();
        if(count($slotpark) > 0 && $request->status_slot == 5){
            return redirect()->action(
                'LantaiController@setpintu',['id' => $request->lid]
                )->with('error','Hanya Bisa Menambahkan 1 Pintu Masuk');
        }
        else if(count($slotpark) > 2 && $request->status_slot == 6){
            return redirect()->action(
                'LantaiController@setpintu',['id' => $request->lid]
                )->with('error','Hanya Bisa Menambahkan 3 Pintu Keluar');
        }
        DB::table('slot_parkirs')->where('id',$g)->update([
            'Status_Slot' => $request->status_slot,
        ]);
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil');
    }    
        
    public function tambaharah(Request $request){  
        $g = $request->knk;
        $d = count($g);    
        for($i=0;$i<$d;$i++){
            DB::table('slot_parkirs')->where('id',$g[$i])->update([
                'Status_Slot' => $request->status_slot,
            ]);
            $total = 0 ;
        }  
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil');

    }
    //testing
    public function tambahtest(Request $request)
    {
        
        $g = $request->knk;
        $d = count($g);        
        $r = $request->range;
        $n = $request->namaslot;
        $total = 0 ;
        $total1 = 0;
   
        if($r < 0 )
        {    
            return redirect()->action(
            'LantaiController@index1',['id' => $request->lid]
            )->with('error','Angka Tidak Boleh Minus');

        }
    
        else if(strlen($request->namaslot) == 1)
        {   
            $total1= $d+$r;
            
            if($total1 > 1000)
            {
                return redirect()->action(
                    'LantaiController@index1',['id' => $request->lid]
                    )->with('error','Range Terlalu Tinggi');
            }
            else{
                for($i1=0;$i1<$d;$i1++){
                    $total = $r + $i1;
                    $der = strtoupper($n).$total;
                    $aer = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->where('Nama_Slot',$der)->get();
                    if(count($aer) > 0){
                        return redirect()->action(
                            'LantaiController@index1',['id' => $request->lid]
                            )->with('error','Ada Nama Yang Sama');
                    }
                }
                for($i=0;$i<$d;$i++){
                    $total = $r + $i;
                    $der = strtoupper($n).$total;
                    DB::table('slot_parkirs')->where('id',$g[$i])->update([
                        'Status_Slot' => 2,
                        'Nama_Slot' => $der,
                    ]);
                    $total = 0 ;
                }
                $total = $request->jl + $d;
                DB::table('lantais')->where('id',$request->lid)->update([
                        'Jumlah_Slot' => $total,
                ]);
                
                return redirect()->action(
                    'LantaiController@index',['id' => $request->lid]
                    )->with('success','Berhasil');
    
            }
        }
        else{         
            return redirect()->action(
                'LantaiController@index1',['id' => $request->lid]
                )->with('error','Panjang Nama Slot Tidak Boleh Lebih Dari 1');
            }      
    }

}   

