<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OperatorSlotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    //Halaman /opslotoperator/layout
    public function index()
    {
        $opid = auth()->user()->id;
        $gedung=DB::table('gedungs')->where('Operator_Id',$opid)->get();
        foreach($gedung as $g){
            $gid=$g->id;
        }
        $lantai = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        foreach($lantai as $l){
            $lid=$l->id;
        }
        return redirect()->action(  
            'OperatorSlotController@indexlantai',['id' => $lid]
        );
    }
    public function indexlantai($id){
        
        $opid = auth()->user()->id;
        
        $gedung = DB::table('gedungs')->where('Operator_Id',$opid)->get();
        foreach($gedung as $g){
            $gid = $g->id;
        }
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l){
            $gid1= $l->Gedung_Id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        foreach($lantai2 as $l2){
            $lid2 = $l2->id;
        }
        if(count($lantai) == 0){        
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $lid2]
            )->with('error','Page Tidak Ada');
        }
        
        if($gid != $gid1){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $lid2]
            )->with('error','Tidak Memiliki Hak Ases');
        }
        
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        return view('lantai.lantaiop')->with('gedung',$gedung)->with('slot',$slot)->with('slot1',$slot1)
        ->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2);
    }
    //Tambah Lantai Untuk Operator
    public function tambahlantai(Request $request)
    {
        $jumlahlantai= 0 ;
        $jumlahlantai = $request->jumlah + 1;
        $lantaipepe = DB::table('lantais')->where('Gedung_Id',$request->gid)->get();
        $lantai = DB::table('lantais')->where('Nama_Lantai',$request->namalantai)->where('Gedung_Id',$request->gid)->get();
        if(count($lantaipepe) > 4){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $request->lid]
            )->with('error','Jumlah Lantai Max 5');
        }
        if(count($lantai) > 0){
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $request->lid]
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
                'OperatorSlotController@indexlantai',['id' => $lid]
            )->with('success','Berhasil Menambahkan Lantai');
        }
        else{
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $request->lid]
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
                'OperatorSlotController@indexlantai',['id' => $request->lid]
            )->with('error','Nama Lantai Tidak Boleh Sama');
        }
        if (strlen($request->namalantai) < 4)
        {
            $nama = strtoupper($request->namalantai);
           
                DB::table('lantais')->where('id',$request->lid)->update([
                'Nama_Lantai'=> $nama,    
            ]); 
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $request->lid]
            )->with('success','Berhasil Mengedit Nama Lantai');
        }
        else{
            return redirect()->action(  
                'OperatorSlotController@indexlantai',['id' => $request->lid]
            )->with('error','Nama Lantai Harus Kurang Dari 2 Huruf');
        }

    }
    //Delete Lantai Operator
    public function deletelantai(Request $request){
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
                    'OperatorSlotController@indexlantai',['id' => $request->lid2]
                )->with('success','Berhasil Menghapus Lantai');
        }
        else
            return redirect()->action(
            'OperatorSlotController@indexlantai',['id' => $request->lid2]
            )->with('error','TIdak Bisa Menghapus Lantai');
        }
        //Add Slot Operator
        public function tambah10($id){
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
            'OperatorSlotController@indexlantai',['id' => $id]
        )->with('success','Berhasil Menghapus Lantai');
    }

    public function delete10(Request $request){
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
                    'OperatorSlotController@indexlantai',['id' => $request->lid]
                )->with('success','Berhasil Menghapus Slot');

        }
        else
        return redirect()->action(
            'OperatorSlotController@indexlantai',['id' => $request->lid]
        )->with('error','Tidak Bisa Menghapus Layout');
    }

}
