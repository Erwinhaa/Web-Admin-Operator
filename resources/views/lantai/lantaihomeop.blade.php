
<div id="links">

@extends('layouts.appcc')

@section('content')
<meta http-equiv="refresh" content="7">
<link href="{{asset('css/lantaioperator.css')}}" rel="stylesheet">

<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>

<form action ="/lantai/tambahlayout" method="post"> 
            {{ csrf_field() }} 
<h4>Nama Gedung
</br>
    
@foreach($gedung as $g)                                               
        <span class="ser">{{$g->Nama_Gedung}}</span> 
</br>
@if($g->Status_Gedung == 1) 
    <a href="/tutupgedung" class="btn btn-danger">Tutup Gedung</a>
@else
    <a href="/tutupgedung" class="btn btn-primary">Buka Gedung</a>
@endif   
       @if(count($slot) > 0)
       
</form>
{{--
<div class="d1">
        <a href="#delete10" data-toggle="modal" class="btn btn-danger">Delete Slot</a>
        @include('inc.modal1')
        
</div>
    <div class="d2">
     
    <a href="#deletefull" data-toggle="modal" class="btn btn-danger">Delete Layout</a>
     @include('inc.modal2')
</div>  
--}}
</br>
       @endif
    </form>
       
</br>
<!--Cetak List Lantai -->
    @foreach($lantai as $l)
    @foreach($lantai1 as $l1)
        @if($l1->id == $l->id)          
            <a href="/operator/lantai/{{$l1->id}}"><div class="men1">{{$l1->Nama_Lantai}}</div></a>
        @else
            <a href="/operator/lantai/{{$l1->id}}"><div class="men2">{{$l1->Nama_Lantai}}</div></a>
        @endif
    @endforeach
    @endforeach

@endforeach
</br></br></br>
@foreach($lantai as $l)

@endforeach
<div id="bois" class="isi">  
        <div class="slot">     
    <!--Cetak Slot Lantai -->
        @foreach($slot as $sub)     
                    @if($sub->Status_Slot == 0)
                    <div class="kotak"></div>
                    @elseif($sub->Status_Slot == 2)
                    <div class="kotak1">{{$sub->Nama_Slot}}</div>
                    @elseif($sub->Status_Slot == 3)
                    <div class="kotak2">{{$sub->Nama_Slot}}</div>
                    @elseif($sub->Status_Slot == 4)
                    <div class="kotak3">{{$sub->Nama_Slot}}</div>
                       <!--Untuk Arah-->
                       @elseif($sub->Status_Slot == 5)<div class="kotaked">        
                        <img src="/images/pintumasuk.png" width="50px" height="50px">   
                    </div>
                    @elseif($sub->Status_Slot == 6)<div class="kotaked"> 
                        <img src="/images/pintukeluar.png" width="50px" height="50px">   
                    </div>
                    @elseif($sub->Status_Slot == 11)<div class="kotaked"> 
                        <img src="/images/arahatas.png" width="50px" height="50px">   
                    </div>
                    @elseif($sub->Status_Slot == 12)<div class="kotaked"> 
                        <img src="/images/arahkiri.png" width="50px" height="50px">   
                    </div>
                    @elseif($sub->Status_Slot == 13)<div class="kotaked"> 
                        <img src="/images/arahkanan.png" width="50px" height="50px">   
                    </div>
                    @elseif($sub->Status_Slot == 14)<div class="kotaked"> 
                        <img src="/images/arahbawah.png" width="50px" height="50px">   
                    </div>
                @endif   
        @endforeach  
                </div>   
        <div class="qma">
            <h2>Detail Slot Parkir</h2></br></br>
            @if(count($ticket1) > 0)
                <table>
                    <tr>
                        <td>Lantai</td>
                        <td>Slot</td>
                        <td>No Plat</td>
                        <td>Lama Parkir</td>
                        <td>Biaya</td>
                        <td>Info Ticket</td>
                    </tr>
                    @foreach($ticket1 as $t1)
                        <tr>    
                            @foreach($slot2 as $s2)           
                                @if($t1->Slot_Id == $s2->id)                      
                                    @foreach($lantai1 as $l1)
                                
                                        @if($s2->Lantai_Id == $l1->id)
                                            
                                            <td>{{$l1->Nama_Lantai}}</td>
                                        @endif
                                    @endforeach
                                    
                                    <td>{{$s2->Nama_Slot}}</td>
                                @endif
                            @endforeach
                            
                                @foreach($mobil as $m)
                                    @if($m->id == $t1->Mobil_Id)
                                        <td>{{$m->No_Plat}}</td>
                                    @endif
                                @endforeach
                            
                                
                            <td><div id="demo{{$t1->id}}"></div></td>
                            <script>
                            // Set the date we're counting down to
                            var countDownDate{{$t1->id}} = new Date('{{$t1->Check_In}}').getTime();

                            // Update the count down every 1 second
                            var x = setInterval(function() {

                            // Get today's date and time
                            var now = new Date().getTime();

                            // Find the distance between now and the count down date
                            var distance = now - countDownDate{{$t1->id}};

                            // Time calculations for days, hours, minutes and seconds
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                            // Display the result in the element with id="demo"
                                document.getElementById("demo{{$t1->id}}").innerHTML = hours + "h "
                                + minutes + "m " + seconds + "s ";

                            // If the count down is finished, write some text
                            if (distance < 0) {
                                clearInterval(x);
                                document.getElementById("demo4{{$t1->id}}").innerHTML = "EXPIRED";
                            }
                            }, 1000);
                            </script>
                            <td>{{$t1->Biaya}}</td>
                            @foreach($slot2 as $s2)           
                                @if($t1->Slot_Id == $s2->id)
                                
                                    @foreach($lantai1 as $l1)
                                
                                        @if($s2->Lantai_Id == $l1->id)
                                            
                                            <td>
                                            <a href="/ticket/{{$t1->id}}" class="btn btn-primary">Info Ticket</a>
                                            </td>
                                        @endif
                                    @endforeach
                                    
                                @endif
                            @endforeach               
                        </tr>
                           
                    @endforeach
                </table>       
                @endif
    
         </div>
         
</div>  
</div>
      
      

@endsection