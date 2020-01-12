<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class NotifikasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    public function notifikasi(){
        $opid = auth()->user()->id;
        $notif  = DB::table('notifications')->where('Operator_Id',$opid)->wherebetween('Status',array('1','2'))->get();
        $ticket = DB::table('tickets')->get();
        $user = DB::table('users')->get();
        $slot = DB::table('slot_parkirs')->get();
        return view('notif.notif')->with('notif',$notif)->with('ticket',$ticket)->with('user',$user)
        ->with('slot',$slot);
    }
    public function cari(Request $request){
        $notif  = DB::table('notifications')->where('Ticket_Id',$request->cari)->wherebetween('Status',array('1','2'))->get();
        $ticket = DB::table('tickets')->get();
        $user = DB::table('users')->get();
        $slot = DB::table('slot_parkirs')->get();
        return view('notif.notif')->with('notif',$notif)->with('ticket',$ticket)->with('user',$user)
        ->with('slot',$slot);
    }
    public function indexnotifikasi($id){
        $notif  = DB::table('notifications')->where('id',$id)->get();
        foreach($notif as $n){
            $status = $n->Status;
        }
        if($status == 3)
            return redirect('/notif')->with('error','Tidak Bisa Mengakses');
        DB::table('notifications')->where('id',$id)->update([
            'Status' => 2,
        ]);
        foreach($notif as $n){
            $tid = $n->Ticket_Id;
            $usid = $n->User_Id;
            $kel = $n->Keluhan;
            $solusi = $n->Solusi;
        }
        $ticket = DB::table('tickets')->where('id',$tid)->get();
        $user = DB::table('users')->where('id',$usid)->get();
        $slot = DB::table('slot_parkirs')->where('id',$solusi)->get();
        foreach($slot as $s){
            $lid=$s->Lantai_Id;
        }
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
        return view('notif.infonotif')->with('notif',$notif)->with('ticket',$ticket)->with('user',$user)
        ->with('slot',$slot)->with('slot1',$slot1);
    }
    public function ganti(Request $request){
        DB::table('notifications')->where('Ticket_Id',$request->tid)->update([
            'Status' => 3,
        ]);
        DB::table('tickets')->where('id',$request->tid)->update([
            'Slot_Id' => $request->sid,
        ]);
        DB::table('slot_parkirs')->where('id',$request->sid)->update([
            'Status_Slot' => '3'
        ]);
        DB::table('slot_parkirs')->where('id',$request->sid1)->update([
            'Status_Slot' => '2'
        ]);
        return redirect('/notif')->with('success','Berhasil');
    }
}
