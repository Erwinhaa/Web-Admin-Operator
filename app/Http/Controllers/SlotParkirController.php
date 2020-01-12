<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SlotParkirController extends Controller
{    


    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function custom()
    {
        $gedung = DB::table('gedungs')->get();
        return view('gedung.custom')->with('gedung',$gedung);
    }
    public function customed()
    {
        $gedung = DB::table('gedungs')->get();
        return view('gedung.custom1')->with('gedung',$gedung);
    }
    public function caried (Request $request)
    {       		
		 $cari = $request->cari;
         $gedung = DB::table('gedungs')->where('Nama_Gedung','like',"%".$cari."%")->get();   
         return view('gedung.custom1')->with('gedung',$gedung);
    }
    public function show (Request $request)
    {  
        return redirect()->action(
            'SlotParkirController@index',['id' => $request->gid]
        );
    }
    //Cari Data Gedung
    public function cari (Request $request)
    {       		
		 $cari = $request->cari;
         $gedung = DB::table('gedungs')->where('Nama_Gedung','like',"%".$cari."%")->get();   
         return view('gedung.custom')->with('gedung',$gedung);
    }
    public function index($id)
    {
        $gedung = DB::table('gedungs')->where('id',$id)->get();
        $lantai = DB::table('lantais')->where('Gedung_Id',$id)->take(1)->get();
        foreach($lantai as $l){
            $lid=$l->id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$id)->take(1)->get();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return redirect()->action(
            'LantaiController@index',['id' => $lid]
        );  
     }
    //Tambah 10 Slot Custom
    public function tambah10($id)
    {
        $slot = DB::table('lantais')->where('id',$id)->get();
        foreach($slot as $s)
        {
            $gid = $s->Gedung_Id;
        }
        for($i=0;$i<10;$i++){
            DB::table('slot_parkirs')->insert([
                'Lantai_Id' => $id,
            ]);
        }
        
        return redirect()->action(
            'LantaiController@index',['id' => $id]
        )->with('success','Berhasil Menambahkan Slot Parkir');

    }
    //tambah lantai
    public function tambahlantai(Request $request)
    {
        $jumlahlantai= 0 ;
        $jumlahlantai = $request->jumlah + 1;
        $lantaipepe = DB::table('lantais')->where('Gedung_Id',$request->gid)->get();
        $lantai = DB::table('lantais')->where('Nama_Lantai',$request->namalantai)->where('Gedung_Id',$request->gid)->get();
        if(count($lantaipepe) > 4){
            return redirect()->action(  
                'LantaiController@index',['id' => $request->lid]
            )->with('error','Jumlah Lantai Max 5');
        }
        if(count($lantai) > 0){
            return redirect()->action(  
                'LantaiController@index',['id' => $request->lid]
            )->with('error','Nama Lantai Tidak Boleh Sama');
        }
        if (strlen($request->namalantai) < 4)
        {
       
            $nama = strtoupper($request->namalantai);
            $lantaih = DB::table('lantais')->get();
            foreach($lantaih as $lh){
                $lid = $lh->id;
            }
            if(count($lantaih) == 0){
                $lid = 0;
            }
            $lid = $lid+1;
            DB::table('lantais')->insert([
                'Gedung_Id' => $request->gid,
                'Nama_Lantai'=> $nama,
                'id' => $lid,                
            ]);
            DB::table('gedungs')->where('id',$request->gid)->update([
                'Jumlah_Lantai' =>$jumlahlantai,
            ]);
            for($i=0;$i<30;$i++){
                DB::table('slot_parkirs')->insert([
                    'Lantai_Id' => $lid,
                ]);
            }
                
            return redirect()->action(  
                'LantaiController@index',['id' => $lid]
            )->with('success','Berhasil Menambahkan Lantai');
        }
        else{
            return redirect()->action(  
                'LantaiController@index',['id' => $request->lid]
            )->with('error','Nama Lantai Harus Kurang Dari 2 Huruf');
        }

    } 
    //Edit Nama Lantai Admin
    public function editlantai(Request $request)
    {
        $jumlahlantai= 0 ;
        $jumlahlantai = $request->jumlah + 1;
        $lantaipepe = DB::table('lantais')->where('Gedung_Id',$request->gid)->get();
        $lantai = DB::table('lantais')->where('Nama_Lantai',$request->namalantai)->where('Gedung_Id',$request->gid)->get();

        if(count($lantai) > 0){
            return redirect()->action(  
                'LantaiController@index',['id' => $request->lid]
            )->with('error','Nama Lantai Tidak Boleh Sama');
        }
        if($a==0){
            return redirect()->action(  
                'LantaiController@index',['id' => $request->lid]
            )->with('error','Nama Lantai Harus Kurang Dari 3 Huruf');                  
        }
        if (strlen($request->namalantai) < 4)
        {
            $nama = strtoupper($request->namalantai); 
            DB::table('lantais')->where('id',$request->lid)->update([
                'Nama_Lantai'=> $nama,    
            ]); 
            return redirect()->action(  
                'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil Mengedit Nama Lantai');
        }
        else{
            return redirect()->action(  
                'LantaiController@index',['id' => $request->lid]
            )->with('error','Nama Lantai Harus Kurang Dari 2 Huruf');
        }
    }     
    //Menghapus Lantai Admin
    public function deletelantai(Request $request)
    {
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->where('Status_Slot','3')->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->where('Status_Slot','4')->get();
        $jumlahlantai = $request->jumlah - 1;
        if(count($slot) == 0 || count($slot) == 0){
            DB::table('gedungs')->where('id',$request->gid)->update([
                'Jumlah_Lantai' => $jumlahlantai,
            ]);
            //$slot = DB::table('slot_parkirs')->where('id',$request->)
            DB::table('lantais')->where('id',$request->lid)->delete();   
            DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->delete();         
            return redirect()->action(
                    'LantaiController@index',['id' => $request->lid2]
                )->with('success','Berhasil Menghapus Lantai');
        }
        else
            return redirect()->action(
            'LantaiController@index',['id' => $request->lid2]
            )->with('error','TIdak Bisa Menghapus Lantai');
    }
    //Menghapus Slot Parkir 10 Untuk Admin
    public function delete(Request $request)
    {
        $jumlah=0;
        $jumlah = $request->jumlah-$request->a; 
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->get();
        if(count($slot) == 10)
            $jumlah = -1;
            
        if($request->a1 == 0){
            DB::table('lantais')->where('id',$request->lid)->update([
                'Jumlah_Slot' => $jumlah,              
            ]);
    
            //Query Mengambil Data 10 Paling Bawah Untuk Dihapus
            DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->orderBY('id','desc')->take(10)->delete();
                return redirect()->action(
                    'LantaiController@index',['id' => $request->lid]
                )->with('success','Berhasil Menghapus Slot');

        }
        else
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
        )->with('error','Tidak Bisa Menghapus Layout');
    }
    //Edit/Tambah Slot Parkir
    public function store(Request $request)
    {
        $slotpark = DB::table('slot_parkirs')->where('Nama_Slot',$request->nama)
        ->where('Lantai_Id',$request->lid)->get();
        $karakter = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";   
        $karakterrr = str_split($karakter);         
        $namas = strtoupper($request->nama);
        for($i=0;$i<count($karakterrr);$i++){    		
            if($namas[1] == $karakter[$i]){                
            return redirect()->action(
            'LantaiController@slotindex',['id' => $request->id]
            )->with('error','Nama Slot Hanya Boleh 1 Alphabet');
            }
        }
        if(count($slotpark) > 0){
            return redirect()->action(
                'LantaiController@slotindex',['id' => $request->id]
            )->with('error','Nama Tidak Boleh Sama');
        }
        if($request->status == 3 || $request->status == 4) {
            return redirect()->action(
                'LantaiController@slotindex',['id' => $request->id]
            )->with('error','Tidak Bisa Mengedit Slot Ini');
        }
        if(strlen($request->nama) == 0)
        {    
            return redirect()->action(
            'LantaiController@slotindex',['id' => $request->lid]
            )->with('error','Nama Slot Tidak Boleh Kosong');

        }
        else if(strlen($request->nama) < 5)
        {
            $namas = strtoupper($request->nama);
            
            DB::table('slot_parkirs')->where('id',$request->id)->update([
                'Nama_Slot' => $namas,
                'Status_Slot' => 2,
            ]);	
            $jumlah = 0;
            $jumlahslot = $request->jslot;      
            $jumlah = $jumlahslot + 1;
            if($request->status == 0){
                DB::table('lantais')->where('id',$request->lid)->update([
                    'Jumlah_Slot' => $jumlah,
                    ]);
            }           
            return redirect()->action(
                'LantaiController@index',['id' => $request->lid]
            )->with('success','Berhasil Menambah Slot');

        }
        else{
            return redirect()->action(
                'LantaiController@slotindex',['id' => $request->id]
            )->with('error','Untuk Nama Slot Max 4');
        }
        
        
    }
    //Delete Slot
    public function store1(Request $request)
    {
        if($request->Status_Slot)
        DB::table('slot_parkirs')->where('id',$request->id)->update([
            'Nama_Slot' => $request->nama,
            'Status_Slot' => 0,
        ]);	
        $jumlah = 0;
        $jumlahslot = $request->jslot;      
        $jumlah = $jumlahslot - 1;
        DB::table('lantais')->where('id',$request->lid)->update([
            'Jumlah_Slot' => $jumlah,
        ]);
        return redirect()->action(
            'LantaiController@index',['id' => $request->lid]
        )->with('success','Berhasil Menghapus Slot');
    }

    
    
    
  
}
