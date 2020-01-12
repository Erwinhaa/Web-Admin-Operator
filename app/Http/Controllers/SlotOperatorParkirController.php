<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SlotOperatorParkirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }

    public function indextambah($id)
    {
        $opid = auth()->user()->id;
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l)
        {
            
            $gid = $l->Gedung_Id;
        }
        if($gid != $opid){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $id]
            );
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaitestop')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2  );
    }
    //Demo Delete Lantai
    public function indexdelete($id)
    {$opid = auth()->user()->id;
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l)
        {
            
            $gid = $l->Gedung_Id;
        }
        if($gid != $opid){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $id]
            );
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaideleteop')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2);
    }
    //Halaman Tambah Arah Dislot
    public function indexarah($id){
        $opid = auth()->user()->id;
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l)
        {
            
            $gid = $l->Gedung_Id;
        }
        if($gid != $opid){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $id]
            );
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaisetarahop')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2
        );
    }
    //halaman deleteitem
    public function indexdeleteitem($id){
        $opid = auth()->user()->id;
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l)
        {
            
            $gid = $l->Gedung_Id;
        }
        if($gid != $opid){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $id]
            );
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaideleteitemop')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2);
   
    }
    //Index Slot Lantai
    public function indexslot($id){
    $infoslot = DB::table('slot_parkirs')->where('id',$id)->get();
        foreach ($infoslot as $s){
            $lid = $s->Lantai_Id;
            $status = $s->Status_Slot;
        }
    if($status == 0 || $status == 2){
        $slot1= DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        return view('lantai.slotlantaiop')->with('infoslot',$infoslot)->with('slot1',$slot1)->with('lantai',$lantai);
    }
    else{       
        return redirect()->action(
            'OperatorSlotController@indexlantai',['id' => $lid]
        )->with('error','Tidak Bisa Mengakses Slot Ini');
    }
    }
    //Halaman Tambah Pintu Di Slot
    public function indexpintu($id){
        $opid = auth()->user()->id;
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l)
        {
            
            $gid = $l->Gedung_Id;
        }
        if($gid != $opid){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $id]
            );
        }
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaisetpintuop')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2
        );
    }
    //Delete Item
    public function deleteitem(Request $request)
    { 
        $g = $request->knk;
        $d = count($g);   
        for($i=0;$i<$d;$i++){
            
            DB::table('slot_parkirs')->where('id',$g[$i])->update([
                'Status_Slot' => 0,
            ]);
        }
        return redirect()->action(
            'OperatorSlotController@indexlantai',['id' => $request->lid]
            )->with('success','Berhasil Menghapus Item');
    }
   
    //Tambah Slot EasyMode
    public function tambah(Request $request)
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
            'SlotOperatorParkirController@index',['id' => $request->lid]
            )->with('error','Angka Tidak Boleh Minus');

        }
    
        else if(strlen($request->namaslot) == 1)
        {   
            $total1= $d+$r;
            
            if($total1 > 1000)
            {
                return redirect()->action(
                    'SlotOperatorParkirController@indextambah',['id' => $request->lid]
                    )->with('error','Range Terlalu Tinggi');
            }
            else{
                for($i1=0;$i1<$d;$i1++){
                    $total = $r + $i1;
                    $der = strtoupper($n).$total;
                    $aer = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->where('Nama_Slot',$der)->get();
                    if(count($aer) > 0){
                        return redirect()->action(
                            'SlotOperatorParkirController@indextambah',['id' => $request->lid]
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
                    'OperatorSlotController@indexlantai',['id' => $request->lid]
                    )->with('success','Berhasil');
    
            }
        }
        else{         
            return redirect()->action(
                'SlotOperatorParkirController@indextambah',['id' => $request->lid]
                )->with('error','Panjang Nama Slot Tidak Boleh Lebih Dari 1');
            }      
    }

    //Tambah PintU
    public function tambahpintu(Request $request){
        $g= $request->knk;
        $slotpark = DB::table('slot_parkirs')->where('Lantai_Id',$request->lid)->where('Status_Slot',$request->status_slot)->get();
        if(count($slotpark) > 0 && $request->status_slot == 5){
            return redirect()->action(
                'SlotOperatorParkirController@indexpintu',['id' => $request->lid]
                )->with('error','Hanya Bisa Menambahkan 1 Pintu Masuk');
        }
        else if(count($slotpark) > 2 && $request->status_slot == 6){
            return redirect()->action(
                'SlotOperatorParkirController@indexpintu',['id' => $request->lid]
                )->with('error','Hanya Bisa Menambahkan 3 Pintu Keluar');
        }
        DB::table('slot_parkirs')->where('id',$g)->update([
            'Status_Slot' => $request->status_slot,
        ]);
        return redirect()->action(
            'OperatorSlotController@indexlantai',['id' => $request->lid]
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
            'OperatorSlotController@indexlantai',['id' => $request->lid]
            )->with('success','Berhasil');

    }
    //Delete EasyMode
    public function delete(Request $request)
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
            'OperatorSlotController@indexlantai',['id' => $request->lid]
            )->with('success','Berhasil Menghapus');
    }
     //Edit/Tambah Slot Parkir
     public function store(Request $request)
     {
         $slotpark = DB::table('slot_parkirs')->where('Nama_Slot',$request->nama)
         ->where('Lantai_Id',$request->lid)->get();
         if(count($slotpark) > 0){
             return redirect()->action(
                 'SlotOperatorParkirController@indexslot',['id' => $request->id]
             )->with('error','Nama Tidak Boleh Sama');
         }
         if($request->status == 3 || $request->status == 4) {
             return redirect()->action(
                 'SlotOperatorParkirController@indexslot',['id' => $request->id]
             )->with('error','Tidak Bisa Mengedit Slot Ini');
         }
         $karakter = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";   
         $karakterrr = str_split($karakter);         
         $namas = strtoupper($request->nama);
         for($i=0;$i<count($karakterrr);$i++){    		
             if($namas[1] == $karakter[$i]){                
             return redirect()->action(
             'SlotOperatorParkirController@indexslot',['id' => $request->id]
             )->with('error','Nama Slot Hanya Boleh 1 Alphabet');
             }
         }
         if(strlen($request->nama) == 0)
         {    
             return redirect()->action(
             'SlotOperatorParkirController@indexslot',['id' => $request->lid]
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
                 'OperatorSlotController@indexlantai',['id' => $request->lid]
             )->with('success','Berhasil Menambah Slot');
 
         }
         else{
             return redirect()->action(
                 'SlotOperatorParkirController@indexslot',['id' => $request->id]
             )->with('error','Untuk Nama Slot Max 4');
         }
         
         
     }
     //Delete Slot
     public function store1(Request $request)
     {
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
             'OperatorSlotController@indexlantai',['id' => $request->lid]
         )->with('success','Berhasil Menghapus Slot');
     }
 

}
