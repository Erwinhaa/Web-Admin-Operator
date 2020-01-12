<?php

namespace App\Http\Controllers\UserTest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GedungTestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listgedung(){
        $gedung= DB::table('gedungs')->get();
        return view('mobil.gedung')->with('gedung',$gedung);
    }
    public function infogedung($id){
        $gedung = DB::table('gedungs')->where('id',$id)->get();
        $lantai = DB::table('lantais')->where('Gedung_Id',$id)->get();
        return view('mobil.lantai')->with('gedung',$gedung)->with('lantai',$lantai);
    }
    public function infolantai($id){
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l){
            $gid = $l->Gedung_Id;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        return view('mobil.slot')->with('lantai',$lantai)->with('slot',$slot)->with('lantai1',$lantai1);
    }
    public function infopesan($id){
        $userid= auth()->user()->id;
        $mobil = DB::table('mobils')->where('user_id',$userid)->get();
        $mobil1 = DB::table('mobils')->where('Share_Id',$userid)->get();
        $slot = DB::table('slot_parkirs')->where('id',$id)->get();
        return view('mobil.order')->with('mobil',$mobil)->with('slot',$slot)->with('userid',$userid)
        ->with('mobil1',$mobil1);
    }
    public function indexcancel(){
        $userid= auth()->user()->id;
        $ticket = DB::table('tickets')->where('User_Id',$userid)->where('Status_Ticket','0')->get();
        return view('mobil.cancel')->with('ticket',$ticket);
    }   
    public function infoshare(){
        $userid= auth()->user()->id;
        $user = DB::table('users')->where('id','!=',$userid)->get();
        return view('mobil.share')->with('user',$user);
    }
    public function carimobil(Request $request){
        $user = DB::table('users')->where('id','!=',$request->id)->where('name', 'like', "%".$request->cari."%")->get();
        return view('mobil.share')->with('user',$user);
    }
    public function indexshare($iduser,$id){
        $user = DB::table('users')->where('id',$id)->get();
        $mobil = DB::table('mobils')->where('User_Id',$iduser)->get();
        return view('mobil.share2')->with('id',$id)->with('mobil',$mobil)->with('user',$user);
    }
    public function sendnotif(){
        $userid= auth()->user()->id;
        $ticket = DB::table('tickets')->where('User_Id',$userid)->where('Status_Ticket','1')->get();
        foreach($ticket as $t){
            $mid = $t->Mobil_Id;
            $slotid = $t->Slot_Id;
        }
        $mobil = DB::table('mobils')->where('id',$mid)->get();
        foreach($mobil as $m){
            $noplat = $m->No_Plat;
        }
        $slot = DB::table('slot_parkirs')->where('id',$slotid)->get();
        foreach($slot as $s){
            $lid = $s->Lantai_Id;
        }
        return view('mobil.notif')->with('ticket',$ticket)->with('noplat',$noplat)->with('lid',$lid);
    }
    public function testocr(){
        return view('ocr.ocr');
    }
    public function ubahslot($id,$lid){
        $ticket = DB::table('tickets')->where('id',$id)->get();
        foreach($ticket as $t){
            $mid = $t->Mobil_Id;
            $slotid = $t->Slot_Id;
        }
        $slot1 = DB::table('slot_parkirs')->where('id',$slotid)->get();
        foreach($slot1 as $s1){
            $namaslot = $s1->Nama_Slot;
        }
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        foreach($lantai as $l){
            $gid = $l->Gedung_Id;          
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
        return view('mobil.ubahslot')->with('ticket',$ticket)->with('lantai',$lantai)
        ->with('lantai1',$lantai1)->with('slot',$slot)->with('namaslot',$namaslot);
    }
}
