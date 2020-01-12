<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Datetime;

class ApiOrderController extends Controller
{
    //id merupkan dari  iduser
    public function orderlist($id){
        $ticket = DB::table('tickets')->where('User_Id',$id)->wherebetween('Status_Ticket',array('0','2'))->get();
        return response()->json([
            'ticket' => $ticket,
         ]);
    }
    //iNi untuk di dashboard
    public function detailticket($id){
        $ticket = DB::table('tickets')->where('id',$id)->get();
        foreach($ticket as $t){
            $gid = $t->Gedung_Id;
            $slotid = $t->Slot_Id;
            $statusticket = $t->Status_Ticket;
            $tanggal_order = $t->Tanggal_Order;
            $waktu_checkin = $t->Check_In;  
            $biaya = $t->Biaya;
            $pen = $t->Pinalti;
            $userid= $t->User_Id;
        }   
    
        if($statusticket == 3 || $statusticket == 4){
            return response()->json([
                'ticket' => $ticket,
             ]);
        }
        else{
            date_default_timezone_set('Asia/Bangkok'); 
            $a = time();   
            $realmin = 30;   
            $realmin1 = 10;
            $g=(date("Y-m-d H:i:s",$a));  
            $datetime1 = new DateTime($tanggal_order);   //Waktu Dia Pesan  
            $datetime2 = new DateTime($g);//Waktu sekarang
            $datetime3 = new DateTime($waktu_checkin);// waktu masuk gedung atau masuk slot
            $since_start = date_diff($datetime1,$datetime2);//Buat Status Ticket 0
            $since_start2 = date_diff($datetime3,$datetime2);//Buat Status Ticket 1 Dan 2
            $gedung = DB::table('gedungs')->where('id',$gid)->get();
            foreach($gedung as $g){
                $namagedung = $g->Nama_Gedung;
                $alamat = $g->Alamat;
            }
            $slotparkir = DB::table('slot_parkirs')->where('id',$slotid)->get();
            foreach($slotparkir as $sp){
                $namaslot = $sp->Nama_Slot;
                $lid = $sp->Lantai_Id;
            }
            $lantai = DB::table('lantais')->where('id',$lid)->get();
            foreach($lantai as $l){
                $namalantai = $l->Nama_Lantai;
            }
            $user = DB::table('users')->where('id',$userid)->get();
            foreach($user as $u){
                $saldo = $u->Saldo;
            }
            $saldo = $saldo - $pen - $biaya;
            $realmin = $realmin - $since_start->i;
            $realmin = $realmin*60 - $since_start->s;
            $realmin1 = $realmin1 - $since_start2->i;
            $realmin1 = $realmin1*60 - $since_start2->s;
            if($statusticket == 0){
                return response()->json([
                    'ticket' => $ticket,
                    'namagedung' => $namagedung,
                    'alamat' => $alamat,
                    'namaslot' => $namaslot,
                    'namalantai' => $namalantai,
                    'jam' => $since_start->h,
                    'menit' => $since_start->i,
                    'detik' => $realmin,
                 ]);
            }
            elseif($statusticket == 2){
                return response()->json([
                    'ticket' => $ticket,
                    'namagedung' => $namagedung,
                    'alamat' => $alamat,
                    'namaslot' => $namaslot,
                    'namalantai' => $namalantai,
                    'jam' => $since_start2->h,
                    'menit' => $since_start2->i,
                    'detik' => $since_start2->s,
                    'now' => $datetime2,                
                    'jumlah' => $saldo,
                 ]);
            }
            elseif($statusticket == 1){
                return response()->json([
                    'ticket' => $ticket,
                    'namagedung' => $namagedung,
                    'alamat' => $alamat,
                    'namaslot' => $namaslot,
                    'namalantai' => $namalantai,
                    'jam' => $since_start->h,
                    'menit' => $since_start->i,
                    'jumlah' => $saldo,
                    'detik' => $realmin1,
                 ]);
            }      
        }    
    }
    public function pesan(Request $request){
        $slotparkir = DB::table('slot_parkirs')->where('id',$request->slotid)->get();
        $mobil = DB::table('mobils')->where('id',$request->mobilid)->get();
        $userid = $request->userid;
        $user = DB::table('users')->where('id',$userid)->get();
        foreach($user as $us){
            $saldo = $us->Saldo;
        }
        foreach($slotparkir as $slot){
            $status_slot = $slot->Status_Slot;
            $lid = $slot->Lantai_Id;
        }
        $lantai = DB::table('lantais')->where('id',$lid)->get();
        foreach($lantai as $l){
            $gid = $l->Gedung_Id;
        }
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        foreach($gedung as $g){
            $biaya  = $g->Biaya;
            $fav = $g->Fav;
        }
        $ticket = DB::table('tickets')->where('User_Id',$userid)->where('Status_Ticket','1')->get();
        $ticket2 = DB::table('tickets')->where('User_Id',$userid)->where('Status_Ticket','2')->get();
        $ticket3 = DB::table('tickets')->where('User_Id',$userid)->where('Status_Ticket','0')->get();
        $ticket4 = DB::table('tickets')->where('User_Id',$userid)->where('Status_Ticket','5')->get();
        if (count($ticket) > 0 || count($ticket2) > 0 || count($ticket3) > 0 || count($ticket4) > 0 ){
            return response()->json([
                'error' => true,
                'pesan' => 'Anda Sedang Memesan',
             ]);
        }
        if($biaya > $saldo){
            return response()->json([
                'error' => true,
                'pesan' => 'Saldo Anda Tidak Cukup Untuk Memesan',
             ]);
        }
        if($status_slot != 2){
            return response()->json([
                'error' => true,
                'pesan' => 'Tidak Bisa Memesan Slot Ini',
             ]);
        }
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();
        $fav = $fav + 1;
        $g=(date("Y-m-d H:i:s",$a));
        DB::table('tickets')->insert([
            'Mobil_Id' => $request->mobilid,
            'Slot_Id' => $request->slotid,
            'Tanggal_Order' => $g,
            'User_Id' => $request->userid,
            'Biaya' => $biaya,
            'Gedung_Id' => $gid,
            'Status_Ticket' => '0',
        ]);
        DB::table('gedungs')->where('id',$gid)->update([
            'Fav' => $fav,
        ]);
        DB::table('slot_parkirs')->where('id',$request->slotid)->update([
            'Status_Slot' => 3,
        ]);
        return response()->json([
            'error' => false,
            'pesan' => 'Berhasil Memesan',
         ]);        
    }
    //id dari id user
    public function denda($id){
        $ticket = DB::table('tickets')->where('id',$id)->where('Status_Ticket','1')->get();
        DB::table('tickets')->where('id',$id)->update([
            'Pinalti' => 15000,
        ]);
        return response()->json([
            'error' => false,
            'pesan' => 'Anda Kenak Denda',
         ]);
    }
    public function batal($id){
        $ticket = DB::table('tickets')->where('id',$id)->where('Status_Ticket','0')->get();
        foreach($ticket as $t){
            $userid = $t->User_Id;
            $gid = $t->Gedung_Id;
            $biaya = $t->Biaya;
            $slotid = $t->Slot_Id;
            $statusticket = $t->Status_Ticket;
            $opid = $t->Gedung_Id;
            $mid = $t->Mobil_Id;
        }
        $user = DB::table('users')->where('id',$userid)->get();
        $total =0 ;
        $totalop = 0;
        foreach($user as $us){
            $saldo = $us->Saldo;
            $namaus = $us->name;
        }
        $slot = DB::table('slot_parkirs')->where('id',$slotid)->get();
        foreach($slot as $sl){
            $namasl = $sl->Nama_Slot;
            $lsid = $sl->Lantai_Id;
        }
        $lantai = DB::table('lantais')->where('id',$lsid)->get();
        foreach($lantai as $l){
            $namalantai = $l->Nama_Lantai;
        }
        $namanama = "Lantai".$namalantai."-Slot".$namasl;
        $mobil = DB::table('mobils')->where('id',$mid)->get();
        foreach($mobil as $m){
            $noplat = $m->No_Plat;
        }
        $gedung = DB::table('gedungs')->where('id',$gid)->get();
        foreach($gedung as $g){
            $namagedung = $g->Nama_Gedung;
        }
        if($t->Status_Ticket != 0){
            return response()->json([
                'error' => true,
                'pesan' => 'Tidak Bisa Membatalkan Pesan',
             ]);
        }
        $total = $saldo - $biaya;
        DB::table('users')->where('id',$userid)->update([
            'Saldo' => $total,
        ]);
        DB::table('tickets')->where('id',$id)->update([
            'Status_Ticket' => 4,
            'User_Id' => $userid,
            'Mobil_Id' => $noplat,
            'Gedung_Id' => $namagedung,
            'Slot_Id' => $namanama, 
        ]);
        
        DB::table('slot_parkirs')->where('id',$slotid)->update([
            'Status_Slot' => 2,
        ]);
        DB::table('transaksi')->insert([
            'User_Id' => $userid,
            'Operator_Id' => $opid,
            'Jenis' => "Batal Order",
            'Jumlah' => $biaya,  
        ]);
        return response()->json([
            'error' => true,
            'pesan' => 'Berhasil Membatalkan Pesan',
         ]);
    }
}
