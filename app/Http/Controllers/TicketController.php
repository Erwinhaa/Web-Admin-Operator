<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    public function cari (Request $request)
    {       		
         $cari = $request->cari;
         $opid = auth()->user()->id;
         $user = DB::table('users')->get();
         $mobil = DB::table('mobils')->get();
         $gedung = DB::table('gedungs')->where('Operator_Id',$opid)->get();
         $slotparkir = DB::table('slot_parkirs')->get();
         $lantai = DB::table('lantais')->get();
         foreach($gedung as $g){
             $gid = $g->id;
         }
         $ticket = DB::table('tickets')->where('Gedung_Id',$gid)->where('id',$cari)->get();
         return view('ticket.ticket')->with('user',$user)->with('gedung',$gedung)->with('slotparkir',$slotparkir)
         ->with('lantai',$lantai)->with('ticket',$ticket)->with('mobil',$mobil);
    }
    public function index(){
        $opid = auth()->user()->id;
        $user = DB::table('users')->get();
        $gedung = DB::table('gedungs')->where('Operator_Id',$opid)->get();
        $slotparkir = DB::table('slot_parkirs')->get();
        $lantai = DB::table('lantais')->get();
        $mobil = DB::table('mobils')->get();
        foreach($gedung as $g){
            $gid = $g->id;
        }
        $ticket = DB::table('tickets')->where('Gedung_Id',$gid)->get();
        return view('ticket.ticket')->with('user',$user)->with('gedung',$gedung)->with('slotparkir',$slotparkir)
        ->with('lantai',$lantai)->with('ticket',$ticket)->with('mobil',$mobil);
    }
    public function indexticket($id){
        $opid = auth()->user()->id;
        $ticket = DB::table('tickets')->where('id',$id)->get();
        if(count($ticket) == 0){
            return redirect('/order/custom')->with('error','Page Tidak Dapat Ditemukan');
        }
        foreach($ticket as $t){
            $gid = $t->Gedung_Id;
            $slotid = $t->Slot_Id;
            $mobilid = $t->Mobil_Id;
            $userid = $t->User_Id;
        }
        if($gid != $opid){
            return redirect('/order/custom')->with('error','Tidak Memiliki Hak Akses');
        }
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        $slotparkir = DB::table('slot_parkirs')->where('id',$slotid)->get();
        foreach($slotparkir as $slot){
            $lid = $slot->Lantai_Id;
        }
        $mobil = DB::table('mobils')->where('id',$mobilid)->get();
        $user = DB::table('users')->where('id',$userid)->get();
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        return view('ticket.infoticket')->with('ticket',$ticket)->with('gedung',$gedung)->with('mobil',$mobil)
        ->with('slotparkir',$slotparkir)->with('user',$user)->with('lantai',$lantai);
    }
    public function checkin(Request $request){
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();
        $check =date_create($request->waktu);
        $g=(date("Y-m-d H:i:s",$a));
        $gg = date_create($g);
        $jam = $gg->diff($check);
        $gg = $jam->h;
        $total = $request->biaya * $gg;
    
     
        return view('ticket.test')->with('jam',$jam)->with('total',$total);
    }
    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();
        $g=(date("Y-m-d H:i:s",$a));
        DB::table('tickets')->insert([
            'Biaya' => $request->biaya,
            'CheckIn' => $request->$g,
        ]);
    }
    public function gantiticket($tid,$lid){
        $opid = auth()->user()->id;
        $gid = $opid;
        $ticket = DB::table('tickets')->where('id',$tid)->get();
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        if(count($ticket) == 0 || count($lantai) == 0){
            return redirect('/order/custom')->with('error','Page Tidak Bisa Ditemukan');
        }
        foreach($lantai as $l)
        {
            $gid = $l->Gedung_Id;  
        }
        foreach($ticket as $t){
            $mid = $t->Mobil_Id;
            $sid = $t->Slot_Id;
            $userid = $t->User_Id;
            $status = $t->Status_Ticket;
        }
        if($status == 0 || $status == 3 || $status == 4){
            return redirect('/order/custom')->with('error','Tidak Bisa Mengakses Page Ini');
        }
        if($gid != $opid){       
            return redirect('/order/custom')->with('error','Tidak Memiliki Hak Akses');
        }
        $user = DB::table('users')->where('id',$userid)->get();
        foreach ($user as $u){
            $namauser = $u->name;
        }
        $slotp = DB::table('slot_parkirs')->where('id',$sid)->get();
        foreach($slotp as $sp){
            $namaslot = $sp->Nama_Slot;
            $lantaiid = $sp->Lantai_Id;
        }
        $lantaisl = DB::table('lantais')->where('id',$lantaiid)->get();
        foreach($lantaisl as $ll){           
            $lantaislot = $ll->Nama_Lantai;
        }
        $mobil = DB::table('mobils')->where('id',$mid)->get();
        foreach($mobil as $m){
            $noplat = $m->No_Plat;
        }
        $gedung = DB::table('gedungs')->where('Operator_Id',$opid)->get();
        $lantai2 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$lid)->orderby('id','desc')->take(10)->get();
        return view('ticket.ganti')->with('gedung',$gedung)->with('slot',$slot)->with('tid',$tid)->with('ticket',$ticket)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('lantai2',$lantai2)
        ->with('noplat',$noplat)->with('namaslot',$namaslot)->with('lantaislot',$lantaislot)->with('namauser',$namauser)
        ->with('sid',$sid);
     }
     public function gantislotticket(Request $request){
         $slotid1 = $request->knk;
         $slotid2 = $request->sid;
         DB::table('tickets')->where('Slot_Id',$slotid2)->update([
            'Slot_Id' => $slotid1,
         ]);
         DB::table('slot_parkirs')->where('id',$slotid2)->update([
            'Status_Slot' => 2,
         ]);
         if($request->status == 1)
            DB::table('slot_parkirs')->where('id',$slotid1)->update([
                'Status_Slot' => 3,
            ]);
         elseif($request->status == 2)
            DB::table('slot_parkirs')->where('id',$slotid1)->update([
                'Status_Slot' => 4,
            ]);  
         return redirect()->action(
            'OperatorController@indexlantai',['id' => $request->lantaiid]
        )->with('success','Berhasil Mengubah Slot');

     }
}
