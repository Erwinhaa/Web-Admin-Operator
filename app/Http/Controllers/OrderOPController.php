<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderOPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    public function indexticket(){
        $opid = auth()->user()->id;
        $mobil = DB::table('mobils')->get();
        $gedung = DB::table('gedungs')->where('Operator_Id',$opid)->get();
        foreach($gedung as $g){
            $gid = $gedung->id;
        }
        $lantai = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        $slot = DB::table('slot_parkirs')->get();
        $ticket = DB::table('tickets')->wherebetween('Status_Ticket',array('1','2'))->where('Gedung_Id',$gid)->get();

    }
    public function infokeuangan(){
        $opid = auth()->user()->id;
        $totalsemua = 0; 
        $totalparkir = 0;
        $totaltopup = 0;
        $transaksi = DB::table('transaksi')->where('Operator_Id',$opid)->get();
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
        return view('history.transaksiop')->with('transaksi',$transaksi)->with('operator',$operator)
        ->with('user',$user)->with('totalsemua',$totalsemua)->with('totalparkir',$totalparkir)
        ->with('totaltopup',$totaltopup);
    }
    public function caritransaksi(Request $request){
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $totalsemua = 0;
        $totalparkir = 0;
        $totaltopup = 0;
        $transaksi = DB::table('transaksi')->whereMonth('Tanggal',$bulan)->whereYear('Tanggal',$tahun)
        ->where('Operator_Id',$opid)->get();
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
        return view('history.transaksiop')->with('transaksi',$transaksi)->with('operator',$operator)
        ->with('user',$user)->with('totalsemua',$totalsemua)->with('totalparkir',$totalparkir)
        ->with('totaltopup',$totaltopup);
    }
    
}
