<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;
use DB;
use DateTime;

class OperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    //Rute Web (/operator)
    public function index()
    {
        $opid = auth()->user()->id;
        $gedung = DB::table('gedungs')->where('id',$opid)->get();
        foreach($gedung as $g){
            $gid=$g->id;
            $namag = $g->Nama_Gedung;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        foreach($lantai1 as $l){
            $lid=$l->id;
        }
        DB::table('gedungs')->where('id',$opid)->update([
            'Status_Gedung' => '1',
        ]);
        return redirect()->action(  
            'OperatorController@indexlantai',['id' => $lid]
        );
    }
    public function tutupgedung(){
        $opid = auth()->user()->id;
        $gedung = DB::table('gedungs')->where('id',$opid)->get();
        foreach($gedung as $g){
            $gid=$g->id;
            $statusgedung = $g->Status_Gedung;
        }
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->take(1)->get();
        foreach($lantai1 as $l){
            $lid=$l->id;
        }
        if($statusgedung == 1){
            DB::table('gedungs')->where('Operator_Id',$opid)->update([
                'Status_Gedung' => '0',
            ]);
        }
        elseif($statusgedung == 0){
            DB::table('gedungs')->where('Operator_Id',$opid)->update([
                'Status_Gedung' => '1',
            ]);
        }
        
        return redirect()->action(  
            'OperatorController@indexlantai',['id' => $lid]
        );
    }
    //Rute Web (/operator/lantai/{id})
    public function indexlantai($id){
        $opid = auth()->user()->id;
        $mobil = DB::table('mobils')->get();
        $gedung = DB::table('gedungs')->where('id',$opid)->get();
        $notif  = DB::table('notifications')->where('Operator_Id',$opid)->where('Status','1')->get();
        foreach($gedung as $g){
            $gid=$g->id;
            $biayagedung = $g->Biaya;

        }
        $lantai = DB::table('lantais')->where('id',$id)->get();
        $lantai1 = DB::table('lantais')->where('Gedung_Id',$gid)->get();
        foreach($lantai1 as $l){
            $lid=$l->id;
        }
        $slot = DB::table('slot_parkirs')->where('Lantai_Id',$id)->get();
        $slot1 = DB::table('slot_parkirs')->where('Lantai_Id',$id)->orderby('id','desc')->take(10)->get();
        $slot2 =DB::table('slot_parkirs')->get();
        //$ticket = DB::table('tickets')->where('Gedung_Id',$gid)->wherebetween('Status_Ticket',array('1','4'))->get();
        $ticket=DB::table('tickets')->get();
        $ticket1 = DB::table('tickets')->where('Gedung_Id',$gid)->wherebetween('Status_Ticket',array('1','2'))->get();
        //$ticket1=DB::table('tickets')->where('Status_Ticket','2')->get();
        
        date_default_timezone_set('Asia/Bangkok'); 
        $a = time();      
        $g=(date("Y-m-d H:i:s",$a));        
        $datetime2 = new DateTime($g);
        foreach ($ticket as $tick){
            $user_id = $tick->User_Id;
            $ticket_id = $tick->id;
            $slot_id = $tick->Slot_Id;        
            $tanggal_order = $tick->Tanggal_Order;
            $check_in = $tick->Check_In;
            $pen = $tick->Pinalti;
            $stat = $tick->Status_Ticket;
            $datetime1 = new DateTime($tanggal_order);
            $datetime3 = new DateTime($check_in);
            $since_start = date_diff($datetime1,$datetime2);
            $since_start2 = date_diff($datetime3,$datetime2);
            $user = DB::table('users')->where('id',$user_id)->get();
            foreach($user as $us){
                $saldo = $us->Saldo;
            }
            //Fungsi Untuk Batal 30 menit sekali
            if($stat == 0){
                $totalsaldo = 0;
                if ($since_start->i >= 30 || $since_start->h > 0 || $since_start->d > 0){
                    DB::table('slot_parkirs')->where('id',$slot_id)->update([
                        'Status_Slot'  => '2',
                    ]);
                    DB::table('tickets')->where('id',$ticket_id)->update([
                        'Status_Ticket' => '4',
                        'Biaya' => '0',
                        'Pinalti' => $biayagedung,
                    ]);
                    $totalsaldo = $saldo - $biayagedung;
                    DB::table('users')->where('id',$user_id)->update([
                        'Saldo' => $totalsaldo,
                    ]);
                }   
            }
            if($stat == 1 && $pen == 0){
                if ($since_start2->i >= 10 || $since_start2->h > 0 || $since_start2->d > 0){
                    DB::table('tickets')->where('id',$ticket_id)->update([
                        'Status_Ticket' => '1',
                        'Pinalti' => '15000',
                    ]);            
                }  
            }  
            if($stat == 2){
                $biayatotal = 0;
                if($since_start2->d > 0){
                    $biayatotal = 50000*$since_start2->d;
                }
                else if ($since_start2->h > 3){
                    $biayatotal = 25000;
                }
                else if ($since_start2->i > 9 && $since_start2->h > 0){
                    $biayatotal = $biayagedung * $since_start->h + $biayagedung;
                }
                else if ($since_start2->i < 10 && $since_start2->h >0){
                    $biayatotal = $biayagedung * $since_start2->h ;
                }             
                else{
                    $biayatotal = $biayagedung;
                }
                DB::table('tickets')->where('id',$ticket_id)->update([
                    'Biaya' => $biayatotal,
                ]);   
            }                   
        }
        
        return view('lantai.lantaihomeop')->with('gedung',$gedung)->with('slot',$slot)
        ->with('slot1',$slot1)->with('lantai',$lantai)->with('lantai1',$lantai1)->with('ticket',$ticket)
        ->with('ticket1',$ticket1)->With('slot2',$slot2)->with('mobil',$mobil)->with('notif',$notif);
        ;
    }
  
    public function profile()
    {
        $op_id = auth()->user()->id;
        $gedung = DB::table('gedungs')->where('Operator_Id',$op_id)->get();
        return view ('opprofile')->with('gedung',$gedung);
  
    }
   
    public function algo(){
        $ocr = DB::table('ocr')->get();
        if(count($ocr) == 0){              
            echo "Belum Ada Data Di-OCR";
            return view('ztest.algo1');
        }
        foreach($ocr as $oc){
            $gedungocr = $oc->Gedung_Id;
            $noplatocr = $oc->noplat;
            $slotidocr = $oc->Slot_Id;
            $ocrid = $oc->id;
            
            DB::table('ocr')->where('id',$ocrid)->delete();
            date_default_timezone_set('Asia/Bangkok'); 
            $a = time();
            $gege=(date("Y-m-d H:i:s",$a));
            /*Mengambil Pattern Dari Database*/
            $tm = '';
            $teme = '';
            $tem = strtoupper($noplatocr);
            $teme = str_replace(' ','',$tem);
            $teme = '-'.$teme.'-';
            if($slotidocr == 0)
                $ticketse = DB::table('tickets')->wherebetween('Status_Ticket',array('0','2'))->where('Gedung_Id',$gedungocr)->get();  
            elseif($slotidocr != 0)
                $ticketse = DB::table('tickets')->where('Status_Ticket','1')->where('Slot_Id',$slotidocr)->get();  
            foreach($ticketse as $ts){
                $mobil_id = $ts->Mobil_Id;
                $mobil1 = DB::table('mobils')->where('id',$mobil_id)->get();
                foreach($mobil1 as $m1){
                    $plat = $m1->No_Plat;        
                }            
                
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
            if(count($ticketse) == 0){
                $j = 0;
            }
            if($j == -1 )
            {
                $tme = '';
                $tme= strtoupper($noplatocr);
                $mobil = DB::table('mobils')->where('No_Plat',$tme)->get();
                foreach($mobil as $m){
                    $mid = $m->id;
                }
                $tickets = DB::table('tickets')->where('Mobil_Id',$mid)->get();
                foreach($tickets as $t){
                    $statusslot = $t->Status_Ticket;
                    $slotid = $t->Slot_Id;
                    $biaya = $t->Biaya;
                    $tid = $t->id;      
                    $checkin = $t->Check_In;
                    $usertid = $t->User_Id;
                    $gtid = $t->Gedung_Id;
                    $biayaticket = $t->Biaya;
                    $penticket = $t->Pinalti;
                }
                $user = DB::table('users')->where('id',$usertid)->get();
                foreach ($user as $us){
                        $saldo = $us->Saldo;
                        $namaus = $us->name;
                }
                if($statusslot == 0){
                    DB::table('tickets')->where('Slot_Id',$slotid)->where('Status_Ticket','0')->update([
                        'Status_Ticket' => '1',
                        'Check_In' =>$gege,
                    ]);   
                    $pesan = "Sudah Masuk Gedung";
                }
                elseif($statusslot == 1 && $slotidocr != 0){
                    DB::table('tickets')->where('Slot_Id',$slotid)->where('Status_Ticket','1')->update([
                        'Status_Ticket' => '2',
                        'Check_In' =>$gege,

                    ]);
                    DB::table('slot_parkirs')->where('id',$slotid)->update([
                        'Status_Slot' => '4',
                    ]);    
                    $pesan = "Masuk Slot Yang Pas";      
                }
                elseif($statusslot == 2 || $statusslot == 1){      
                    $tme = '';
                    $tme= strtoupper($noplatocr);
                    $pen = 0;                     
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
                    
                    $totz = 0;
                    $totz = $biayaticket  + $penticket ;
                    $saldo = $saldo - $totz;
                    if($saldo >= 0 ){
                        DB::table('users')->where('id',$usertid)->update([
                            'Saldo' => $saldo,
                        ]);              
                        DB::table('tickets')->where('Slot_Id',$slotid)->where('Status_Ticket',$statusslot)->update([
                            'Biaya' => $biayaticket,
                            'Status_Ticket' => '3',
                            'Check_Out' =>$gege,
                            'Mobil_Id' => $tme,
                            'Gedung_Id' => $namag,
                            'Slot_Id' => $namanama,
                        ]);                   
                        DB::table('slot_parkirs')->where('id',$slotid)->update([
                            'Status_Slot' => '2',
                        ]); 
                        DB::table('notifications')->where('Ticket_Id',$tid)->update([
                            'Status' => 3,
                        ]);
                        DB::table('transaksi')->insert([
                            'User_Id' => $usertid,
                            'Operator_Id' => $gtid,
                            'Jenis' => "Biaya Parkir",
                            'Jumlah' => $totz,
                        ]);           
                        $pesan = "Berhasil Check Out";
                    }
                    else   
                        $pesan = "Tidak Cukup Saldo";
                }
                echo "</br>";
                echo "Patern :" . $teme;
                echo "</br>";
                echo "Text : " . $tm;   
                echo "</br>";
                echo $pesan; 
                echo "</br>";
                echo "Ada";              
                echo "</br>";    
            }
            else{        
                echo "</br>";
                echo "Patern :" . $teme;
                echo "</br>";
                echo "Text : " . $tm;
                if($slotidocr == 0){ 
                    echo "</br>";            
                    echo "(Mobil Ini Tidak Ada Memesan)";
                }
                elseif($slotidocr != 0 && count($ticketse) > 0){
                    echo "</br>";            
                    echo "(Mobil Ini Memilih Slot Orang Lain)";
                }
                elseif($slotidocr != 0){
                    echo "</br>";            
                    echo "(Mobil Ini Salah Memilih Slot)";  
                }      
                echo "</br>";
                echo "tidak ada"; 
                echo "</br>";
                $tme = '';
                      
            } 
        }
        return view('gedung.algo1');
        /*Mengambil Waktu Sekarang*/
         
        //return view('ztest.algo1')->with('ticketse',$ticketse)->with('tm',$tm)
        //->with('totalc',$totalc)->with('pesan',$pesan);
    }
}
