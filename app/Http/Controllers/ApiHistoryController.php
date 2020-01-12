<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class ApiHistoryController extends Controller
{
    
    //id merupkan dari  iduser (untuk history )
    public function history($id){
        $ticket = DB::table('tickets')->where('User_Id',$id)->wherebetween('Status_Ticket',array('3','4'))->orderby('id','desc')->get();
        return response()->json([
            'ticket' => $ticket,
         ]);
    }
    //ini untuk yang diklick buat infoticket history
    public function infohistory($id){
        $ticket = DB::table('tickets')->where('id',$id)->wherebetween('Status_Ticket',array('3','4'))->get();
        return response()->json([
            'ticket' => $ticket,
         ]);
    }
    //idnya ambil dari id user
    public function historysaldo($id){
        $history = DB::table('history_saldos')->where('User_Id',$id)->get();
        return response()->json([
            'history' => $history,
         ]);
    }
    //info topusaldo idnya ambil dari id history saldos
    public function infoshistorysaldo($id){
        $history = DB::table('history_saldos')->where('id',$id)->get();
        foreach($history as $his){
            $opid = $his->operator_id;
        }
        $gedung = DB::table('gedungs')->where('Operator_Id',$id)->get();
        foreach($gedung as $g){
            $namagedung = $g->Nama_Gedung;
        }
        return response()->json([
            'history' => $history,
            'namagedung' => $namagedung,
         ]);
    }
}
