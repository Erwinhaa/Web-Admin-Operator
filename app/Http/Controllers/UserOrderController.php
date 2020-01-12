<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

class UserOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function algo(Request $request){
        /*Mengambil Waktu Sekarang*/
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();
        $gege=(date("Y-m-d H:i:s",$a));
        /*Mengambil Pattern Dari Database*/
        $tm = '';
        $teme = '';
        $ticketse = DB::table('tickets')->wherebetween('Status_Ticket',array('0','2'))->where('Gedung_Id','1')->get();
        if(count($ticketse) == 0)
            return redirect('/');
        foreach($ticketse as $ts){
            $mobil_id = $ts->Mobil_Id;
            $mobil1 = DB::table('mobils')->where('id',$mobil_id)->get();
            foreach($mobil1 as $m1){
                $plat = $m1->No_Plat;
                
            }
            
            $tem = strtoupper($request->noplat);
            $teme = str_replace(' ','',$tem);
            $teme = '-'.$teme.'-';
            $me = '-'.$tm.'-';
            $tme = str_replace(' ','',$me);
            $mem = '-'.$plat.'-';
            $tm = $tm.$mem;
         
        /*Cara Kerja Algoritma Mulai Dari Sini */
            
            $patern = $teme;
            $mark1=0;
            $mark2=0;
            $textarr = str_split($tm);
            $paternarr = str_split($patern);
            $textlength = count($textarr);
            $totalc=0;
            $paternlength = count($paternarr);
            $num = 0;
            $status = '';
            $marki=0;
            $total = 0;
            $maret = -2;
            $ind = 0 ;
            $markermargin=0;$pat = $paternlength-1;
            $i = $paternlength -1 ; /*text iterator */
            $j = $paternlength -1 ; /*pattern iterator */
            $h1 = $paternlength-1;
            $step = 1;
            $q1=0;
            $q2=0;
            $q2=$q2+$h1;
            /*Occurance Table */
            $ocindex = array();
            $jj = 0 ;
            for($ii=0 ;$ii<$paternlength;$ii++)
            {
                $ocindex[$ii] = -1;
                if($ii != 0 ){
                    for($jj=0 ;$jj<$ii;$jj++)
                    {
                        if($paternarr[$ii] == $paternarr[$jj] && $ii != $jj){
                            $ocindex[$ii] = $jj;
                        }				
                    }		
                }	
            }
            $margintable = array();
            $jc= 0;
            $jarak=0;
            $tc = 0;
            $iz1=0; 
            /*Menetentukan Kondisi MarginTable Untuk Panjang Text ganjil atau genap */
            if($paternlength % 2 == 1){
                $jc = ($paternlength/2) - 0.5;
                $jarak = $jc + 1;
            }
            else{
                $jc = ($paternlength/2);
                $jarak = $jc ;
            }
            /*Margin Table*/
            while($jc > 0 ){
                $tc = 0 ;
                for ($iz=0;$iz<$jc;$iz++){
                    $iz1=0;
                    $iz1= $iz + $jarak;
            
                    if ($paternarr[$iz] == $paternarr[$iz1]){
                        $tc = $tc+1;
                    }
                }
                if ($tc == $jc)
                {
                    $jc = 0;
                }
                $jc -- ;	
                $jarak ++;
            }
            for($zz= 0 ; $zz < $paternlength ; $zz++){

                if ($zz >= ($paternlength-$tc)){
                    $margintable[$zz] = 0;
                }
                else{
                    $margintable[$zz] = $tc; 
                }
            }
            /*Algo Logical */
            while($j>= 0 && $i < $textlength){	
                if ($textarr[$i] == $paternarr[$j]){
                    if ($j == $paternlength-1){
                        $marki = $i;
                    }
                    
                    $i--; $j--;$total ++ ;
                
                    
                }
                else{
                    $total++;
                    $totalc=$total;
                    
                    $numofmatch = 0;
                    if($j == $h1){
                        $marki = $i;
                    }
                    $mark1=$i;
                    $mark2=$marki;
                    $markermargin = $margintable[$j];
                    
                    $step++;
                    $g = $j;
                    $loncat = 0;
                    $pairedakhir = $textarr[$i];
                    if($j == 0){
                        $pairedawal= " ";
                    }
                    else{
                        $pairedawal = $textarr[$i-1];
                    }
                
                    $mar = 0;
                    $unmatch = '';
                    while($g >= 0 ){			
                        $text = $paternarr[$g];
                        $unmatch = $unmatch.$text;
                        $g=$g-1;
                    }
                    /*Membalikan String Dan Memecah Menjadi Array*/
                    $unmatch1=strrev($unmatch);
                    $unmatched = str_split($unmatch1);
                    $unmatchlength = count($unmatched);
                    if(count($unmatched) == $paternlength){
                        array_pop($unmatched);
                    }
                    
                    /*Mencari char dari Occurance Table*/
                    $indexakhir = -1;
                    $indexawal = -2;
                    $ale = count($unmatched);
                    
                
                        
                    for($y=0 ;$y<$ale;$y++){
                            
                        if ($unmatched[$y] == $pairedakhir){			
                             $indexakhir = $y;/*Index Occurance Table Akhir Muncul*/
                             $indexawal = $y-1;
                             $temp = $ocindex[$y];		
                        
                        }	
                    }
                    $ab = $indexakhir;
                    /*Menetukan Paired Atau Tidak */
                    $marker= 0 ;
                    while($ab > -1){
                            
                        if($ab == 0)
                        {
                            $de = " ";
                        }
                        else{
                            $de = $unmatched[$ab-1];
                        }
                        if($de == $pairedawal && $unmatched[$ab] == $pairedakhir && $ab ){
                            $mar = 2 ;		
                            $marker= $ab;
                            $ab = 0;			
                        }	
                        else if ($unmatched[0] == $pairedakhir && $ab == 0 ){
                            $mar = 	1;
                            $ab = 0;	
                        }
                                
                        $temp = $ocindex[$ab];
                        $ab = $temp;
                    }
                    
                    if($mar != 0){
                        if($mar == 2){
                            $loncat = count($unmatched);
                            $numofmatch = 2;
                            $maret = $i;
                            $i = $marki + $unmatchlength-1 - $marker ;		
                
                            $j = $paternlength-1;
                            $q2= $i;
                            $q1= $q2-$j;
                        }
                        else if($mar == 1){
                            $loncat = 
                            $i = $marki+$unmatchlength-1;
                            $j = $paternlength-1;
                            $q2= $i;
                            $q1= $q2-$j;
                        }
                    }
                    else if($markermargin != 0){
                            $loncat = $paternlength-$markermargin;
                            $maret =  $marki;
                            
                            $numofmatch = $margintable[0];
                            $i = $marki + $loncat;
                            $j = $paternlength-1;	
                            $q2= $i;
                            $q1= $q2-$j;
                        }
                    else{
                            $loncat = count($paternarr);
                            $i = $marki+$loncat;
                            $j = $paternlength-1;
                            $q2= $i;
                            $q1= $q2-$j;
                        }
                    }
                    /*Avoid Double Comparison */
                    
                    if ($i == $maret){
                        $i = $i - $numofmatch;
                        $j = $j - $numofmatch;
                            
                    }
                    
                
                }
            $totalc=$total;        
        }
        if($j == -1 )
        {
            $tme = '';
            $tme = str_replace(' ','',$request->noplat);
            $tme= strtoupper($tme);
            $mobil = DB::table('mobils')->where('No_Plat',$tme)->get();
            foreach($mobil as $m){
                $mid = $m->id;
            }
            $tickets = DB::table('tickets')->where('Mobil_Id',$mid)->get();
            foreach($tickets as $t){
                $statusslot = $t->Status_Ticket;
                $slotid = $t->Slot_Id;
            }
            if($statusslot == 0){
                DB::table('tickets')->where('Slot_Id',$slotid)->where('Status_Ticket','0')->update([
                    'Status_Ticket' => '1',
                    'Check_In' =>$gege,
                ]);             
                $pesan = 'Sudah Dimasuk Gedung';
            }
            elseif($statusslot == 1){
                DB::table('tickets')->where('Slot_Id',$slotid)->where('Status_Ticket','1')->update([
                    'Status_Ticket' => '2',
                    'Check_In' =>$gege,

                ]);
                DB::table('slot_parkirs')->where('id',$slotid)->update([
                    'Status_Slot' => '4',
                ]);               
            }
            elseif($statusslot == 2){
                $tme = '';
                $tme = str_replace(' ','',$request->noplat);
                $tme= strtoupper($tme);
                $mobil = DB::table('mobils')->where('No_Plat',$tme)->get();
                foreach($mobil as $m){
                    $mid = $m->id;
                }
                $pen = 0;
                $tick = DB::table('tickets')->where('Mobil_Id',$mid)->get();
                foreach ($tick as $ti){
                    $tid = $ti->id;
                    $checkin = $ti->Check_In;
                    $usertid = $ti->User_Id;
                    $gtid = $ti->Gedung_Id;
                    $biayaticket = $ti->Biaya;
                    $penticket = $ti->Pinalti;
                }
                $gedung = DB::table('gedungs')->where('id',$gtid)->get();
                foreach($gedung as $g){
                    $biaya = $g->Biaya;
                    $namag = $g->Nama_Gedung;
                }   
        
                $user = DB::table('users')->where('id',$usertid)->get();
                foreach ($user as $us){
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


               //Melakukan Pengecheckan Apakah Saldo Cukup Atau Tidak
                $saldo = $saldo - $biayaticket - $penticket;
                if($saldo >= 0 ){
                DB::table('users')->where('id',$usertid)->update([
                    'Saldo' => $saldo,
                ]);
                
                DB::table('tickets')->where('Slot_Id',$slotid)->where('Status_Ticket','2')->update([
                    'Biaya' => $biayaticket,
                    'Status_Ticket' => '3',
                    'Check_Out' =>$gege,
                    'Mobil_Id' => $tme,
                    'User_Id' => $namaus,
                    'Gedung_Id' => $namag,
                    'Slot_Id' => $namanama,
                ]);
                
                DB::table('slot_parkirs')->where('id',$slotid)->update([
                    'Status_Slot' => '2',
               ]);                
                $pesan = 'Berhasil Check Out';
                }
            }
            echo "Ada";
            
        }
        else{
            echo "tidak ada";
            
            echo "</br>";
            echo "Patern :" . $patern;
            echo "</br>";
            echo "Text : " . $tm;
            $pesan = 'Tidak Ada Mobil';
        }  
        //return view('ztest.algo1')->with('ticketse',$ticketse)->with('tm',$tm)
        //->with('totalc',$totalc)->with('pesan',$pesan);
    }
    public function cancelorder($id)
    {
        $userid = auth()->user()->id;
        $ticket = DB::table('tickets')->where('id',$id)->get();
        $mobil = DB::table('mobils')->where('User_Id',$userid)->get();
        $te = '';
        //Algoritma Penting
        $tm = '';
        $indexm = '';
        $ticketsemua = DB::table('tickets')->wherebetween('Status_Ticket',array('1','2'))->get();
        foreach($ticketsemua as $ts){
            $mobilid1 = $ts->Mobil_Id;
            $mobil1 = DB::table('mobils')->Where('id',$mobilid1)->get();
            foreach($mobil1 as $m1){
                $plat = $m1->No_Plat;
                
            }
            $mem = '-'.$plat.'-';
            $tm = $tm.$mem;
            $tm = str_replace(' ', '', $tm);
            $tm = str_toupper($tm);
        }
        //
        foreach($mobil as $m){
            $me = '-'.$m->No_Plat.'-';
            $te = $te.$me;
            $te = str_replace(' ', '', $te);
        }
        $jumlahts = count($ticketsemua);
        $user = DB::table('users')->where('id',$userid)->get();
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();
        $g=(date("Y-m-d H:i:s",$a)); 
        $pen = 0;   
        foreach($user as $us){
            $saldo = $us->Saldo;
        }
        foreach($ticket as $t){
            $sid = $t->Slot_Id;
            $tanggal_order = $t->Tanggal_Order;
            $biaya = $t->Biaya;
            $statusticket = $t->Status_Ticket;
        }
        $datetime1 = new DateTime($tanggal_order);
        $datetime2 = new DateTime($g);
        $since_start = date_diff($datetime1,$datetime2);
        $minutedi = $since_start->i;
        if ($since_start->i > 30 || $since_start->h > 0){
            $pen = $biaya + ($biaya * $since_start->h);
            $saldo = $saldo - $pen;
        }
        if ($statusticket == 1 || $statusticket == 2){
            DB::table('tickets')->where('id',$id)->update([
                'Status_Ticket' => 0,
                'Check_In' => $tanggal_order,
                'Check_Out' => $g,
                'Pinalti' => $pen,
            ]);
            DB::table('slot_parkirs')->where('id',$sid)->update([
                'Status_Slot' => 2,
            ]);
            DB::table('users')->where('id',$userid)->update([
                'Saldo' => $saldo,
            ]);DB::table('tickets')->where('id',$id)->update([
            'Status_Ticket' => 0,
            'Check_In' => $tanggal_order,
            'Check_Out' => $g,
            'Pinalti' => $pen,
            ]);
             DB::table('slot_parkirs')->where('id',$sid)->update([
            'Status_Slot' => 2,
            ]);
            DB::table('users')->where('id',$userid)->update([
            'Saldo' => $saldo,
             ]);
        }
        
        return view('ztest.admink')->with('minutedi',$minutedi)->with('pen',$pen)->with('since_start',$since_start)
        ->with('saldo',$saldo)->with('g',$g)->with('tanggal_order',$tanggal_order)->with('sid',$sid)
        ->with('jumlahts',$jumlahts)->with('te',$te)->with('tm',$tm);
    }
}
