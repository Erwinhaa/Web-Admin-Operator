<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GedungApiController extends Controller
{
    public function listgedung(){
        $gedung= DB::table('gedungs')->get();
        return response()->json([
            'gedung' => $gedung,
         ]);
    }
    public function search($cari){
        $gedung = DB::table('gedungs')->where('Nama_Gedung', 'like', "%".$cari."%"
        )->get();
        return response()->json([
            'gedung' => $gedung,
         ]);
    }
    public function infogedung($id){
        $gedung = DB::table('gedungs')->where('id',$id)->get();
        $lantai = DB::table('lantais')->where('Gedung_Id',$id)->get();
        return response()->json([
            'gedung' => $gedung,
            'lantai' => $lantai,
         ]);
    }
    public function infolantai($id){
        $lantai = DB::table('lantais')->where('id',$id)->get();
        foreach($lantai as $l){
            $lid = $l->id;
        }
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$lid)->get();
        return response()->json([
            'lantai' => $lantai,
            'slot' =>$slot,
         ]);
    }
        public function infoslot($id){
            $slot = DB::table('slot_parkirs')->where('id',$id)->get();
            foreach($slot as $s){
                $slotid = $s->id;
                $namaslot = $s->Nama_Slot;
                $lantaid = $s->Lantai_Id;
                $statusslot = $s->Status_Slot;
            }
            $lantai = DB::table('lantais')->where('id',$lantaid)->get();
            return response()->json([
                'lantai' => $lantai,
                'slot' =>$slot,
            ]);
        }
}
