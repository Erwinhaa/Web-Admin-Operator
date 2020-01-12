<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $history = DB::table('history_saldos')->get();
        $operator = DB::table('operators')->get();
        $user = DB::table('users')->get();
        return view('history.saldo')->with('history',$history)->with('operator',$operator)->with('user',$user);
    }
    public function cari(Request $request){
        $cari = $request->cari;
        $user = DB::table('users')->where('name','like',"%".$cari."%")->get();  
        $history = DB::table('history_saldos')->get();
        $operator = DB::table('operators')->get();
        return view('history.saldo')->with('history',$history)->with('operator',$operator)->with('user',$user);
    }
    public function listticket(){
        $user = DB::table('users')->get();
        $gedung = DB::table('gedungs')->get();
        $slotparkir = DB::table('slot_parkirs')->get();
        $lantai = DB::table('lantais')->get();
        $mobil = DB::table('mobils')->get();
        foreach($gedung as $g){
            $gid = $g->id;
        }
        $ticket = DB::table('tickets')->get();
        return view('history.ticket')->with('user',$user)->with('gedung',$gedung)->with('slotparkir',$slotparkir)
        ->with('lantai',$lantai)->with('ticket',$ticket)->with('mobil',$mobil);
    }
    public function infoticket($id){
        $ticket = DB::table('tickets')->where('id',$id)->get();
        if(count($ticket) == 0){
            return redirect('/ticketinfo')->with('error','Page Tidak Ditemukan');
        }
        foreach($ticket as $t){
            $gid = $t->Gedung_Id;
            $slotid = $t->Slot_Id;
            $mobilid = $t->Mobil_Id;
            $userid = $t->User_Id;
            $status = $t->Status_Ticket;
        }
        
        $user = DB::table('users')->where('id',$userid)->get();
        if($status == 3 || $status == 4){
            return view('history.infoticket1')->with('ticket',$ticket)->with('user',$user);
        }
        else{
            $gedung = DB::table('gedungs')->where('id',$gid)->get();
            $slotparkir = DB::table('slot_parkirs')->where('id',$slotid)->get();
            foreach($slotparkir as $slot){
                $lid = $slot->Lantai_Id;
            }
            $mobil = DB::table('mobils')->where('id',$mobilid)->get();
            $user = DB::table('users')->where('id',$userid)->get();
            $lantai = DB::table('lantais')->where('id',$lid)->get();
            
            return view('history.infoticket')->with('ticket',$ticket)->with('gedung',$gedung)->with('mobil',$mobil)
            ->with('slotparkir',$slotparkir)->with('user',$user)->with('lantai',$lantai);

        }
        
    }
    public function cariticket(Request $request){    
        $user = DB::table('users')->get();
        $gedung = DB::table('gedungs')->get();
        $slotparkir = DB::table('slot_parkirs')->get();
        $lantai = DB::table('lantais')->get();
        $mobil = DB::table('mobils')->get();
        foreach($gedung as $g){
            $gid = $g->id;
        }
        $ticket = DB::table('tickets')->where('id',$request->cari)->get();
        return view('history.ticket')->with('user',$user)->with('gedung',$gedung)->with('slotparkir',$slotparkir)
        ->with('lantai',$lantai)->with('ticket',$ticket)->with('mobil',$mobil);
    }
    public function infokeuangan($id){
        $totalsemua = 0; 
        $totalparkir = 0;
        $totaltopup = 0;
        $transaksi = DB::table('transaksi')->where('Operator_Id',$id)->get();
        if(count($transaksi) == 0){
            return redirect('/transaksi')->with('error','Page Tidak Ditemukan');
        }
        $operator = DB::table('operators')->get();
        $user = DB::table('users')->get();
        foreach($transaksi as $tr){
            $jumlah = $tr->Jumlah;
            $totalsemua = $totalsemua + $jumlah;
            if($tr->Jenis == "Batal Order" || $tr->Jenis == "Biaya Parkir"){
                $totalparkir = $totalparkir + $jumlah;
            }
            elseif($tr->Jenis ==  "Top Up Saldo"){
                $totaltopup = $totaltopup + $jumlah;
            }
        }
        $gedung = DB::table('gedungs')->where('Operator_Id',$id)->get();
        return view('history.transaksi')->with('transaksi',$transaksi)->with('operator',$operator)
        ->with('user',$user)->with('totalsemua',$totalsemua)->with('totalparkir',$totalparkir)
        ->with('totaltopup',$totaltopup)->with('gedung',$gedung);
    }
    public function caritransaksi(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $gid = $request->gid;
        $totalsemua = 0;
        $totalparkir = 0;
        $totaltopup = 0;
        $transaksi = DB::table('transaksi')->whereMonth('Tanggal',$bulan)->whereYear('Tanggal',$tahun)
        ->where('Operator_Id',$gid)->get();
        $operator = DB::table('operators')->get();
        $user = DB::table('users')->get();
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        foreach($transaksi as $tr){
            $jumlah = $tr->Jumlah;
            $totalsemua = $totalsemua + $jumlah;
            if($tr->Jenis == "Batal Order" || $tr->Jenis == "Biaya Parkir"){
                $totalparkir = $totalparkir + $jumlah;
            }
            elseif($tr->Jenis ==  "Top Up Saldo"){
                $totaltopup = $totaltopup + $jumlah;
            }
        }
        return view('history.transaksi')->with('transaksi',$transaksi)->with('operator',$operator)
        ->with('user',$user)->with('totalsemua',$totalsemua)->with('totalparkir',$totalparkir)
        ->with('totaltopup',$totaltopup)->with('gedung',$gedung);
    }
}
