<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class ApiNotifikasiController extends Controller
{
    //id yang digunakan merupakan id dari user
    public function infonotif($id){
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();      
        $g=(date("Y-m-d H:i:s",$a));        
        $datetime2 = new DateTime($g);
        //Slot2 merupakan variable untuk Slot Yang Dipilih User
        //Slot1 Merupakan Variable untuk Slot Yang Ditempati User
        $notif = DB::table('notifications')->where('User_Id',$id)->wherebetween('Status',array('0','2'))->get();
        foreach($notif as $n){
            $tid = $n->Ticket_Id;
            $slot2 = $n->Solusi;
            $status = $n->Status;
            $tanggal = $n->Tanggal;
        }
        $ticket = DB::table('tickets')->where('id',$tid)->get();
        foreach($ticket as $t){
            $slot1 = $t->Slot_Id;
            $checkin = $t->Check_In;
            $gid = $t->Gedung_Id;
        }
        $slot1 = DB::table('slot_parkirs')->where('id',$slot1)->get();
        foreach($slot1 as $s){
            $namaslot1 = $s->Nama_Slot;
        }
        $slot2 = DB::table('slot_parkirs')->where('id',$slot2)->get();
        foreach($slot1 as $s){
            $namaslot2 = $s->Nama_Slot;
        }
        $datetime1 = new DateTime($tanggal);
        $since_start = date_diff($datetime2,$datetime1);
        $realmin = 5;
        $realmin = $realmin - $since_start->i;
        $realmin = $realmin*60 - $since_start->s;    
        return response()->json([
            'notif' => $notif,
            'slot1' => $slot1,
            'slot2' => $slot2,
            'namaslot1' => $namaslot1,
            'namaslot2' => $namaslot2,
            'gedungid' => $gid,
            'status' => $status,
            'detik' => $realmin,
         ]);
    }
    public function notif(Request $request){
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();      
        $g=(date("Y-m-d H:i:s",$a));        
        $datetime2 = new DateTime($g);
        $slotid=$request->sid;
        $tid=$request->tid;
        $pesan = "";
        $notif = DB::table('notifications')->where('Ticket_Id',$tid)->get();
        if(count($notif) > 0){
            foreach($notif as $n){
                $tanggal = $n->Tanggal;
            }
            $datetime1 = new DateTime($tanggal);
            $since_start = date_diff($datetime2,$datetime1);    
            if($since_start->i < 5){
                $menit = 0;
                $detik = 0;
                $menit = 4 - $since_start->i;
                $detik = 60 - $since_start->s;
                $pesan = "Anda Harus Menunggu " . $menit . " Menit " . $detik . " Detik Untuk Mengirim Pesan Lagi";
                if($menit == 0){
                    $pesan = "Anda Harus Menunggu " . $detik . " Detik Untuk Mengirim Pesan Lagi";
                }
                if($detik == 60){
                    $menit = 5 - $since_start->i;
                    $detik = 0; 
                    $pesan = "Anda Harus Menunggu " . $menit . " Menit" . " Untuk Mengirim Pesan Lagi";
                }
                return response()->json([
                    'error' => true,
                    'pesan' => $pesan,
                 ]);
            }         
        }   
        $keluhan = "Mengubah Slot";
        $slot = DB::table('slot_parkirs')->where('id',$request->slotid)->get();
        foreach($slot as $s){
            $nama = $s->Nama_Slot;
            $lid = $s->Lantai_Id;
            $statusslot = $s->Status_Slot;
        }
        if($statusslot != 2){
            return response()->json([
                'error' => false,
                'pesan' => 'Tidak Bisa Memilih Slot Ini',
             ]);
        }
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        foreach($lantai as $l){
            $namalantai = $l->Nama_Lantai;
        }
        $ticket = DB::table('tickets')->where('id',$tid)->get();
        foreach($ticket as  $t){
            $gid  = $t->Gedung_Id;
            $userid = $t->User_Id;
        }
        if(count($notif) > 0){
            DB::table('notifications')->where('Ticket_Id',$tid)->update([
                'Status' => '1',
                'User_Id' => $userid,
                'Ticket_Id' => $tid,
                'Keluhan' => $keluhan,
                'Solusi' =>$request->slotid,
                'Operator_Id' => $gid,
                'Tanggal' => $g,
     
            ]);
        }
        else{
            DB::table('notifications')->where('id',$tid)->insert([
            'Status' => '1',
            'User_Id' => $userid,
            'Ticket_Id' => $tid,
            'Keluhan' => $keluhan,
            'Solusi' =>$request->slotid,
            'Operator_Id' => $gid,
            ]);
        }
        return response()->json([
            'error' => false,
            'pesan' => 'Berhasil Mengirim Pesan Kepada Operator',
         ]);
    }
}
