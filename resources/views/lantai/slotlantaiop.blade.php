
@extends('layouts.appc')

@section('content')

<link href="{{asset('css/slotadmin.css')}}" rel="stylesheet">
<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>


</br>
<!--Cetak List Lantai -->
    @foreach($lantai as $l)      
            <h1>{{$l->Nama_Lantai}}</h1>
   



</br></br></br>
<div class="isi">       
    <!--Cetak Slot Lantai -->
        @foreach($slot1 as $sub)
            
                    @if($sub->Status_Slot == 0)
                    <a href="/opslotparkir/{{$sub->id}}"><div class="kotak"></div></a>
                    @elseif($sub->Status_Slot == 2)
                    <a href="/opslotparkir/{{$sub->id}}"><div class="kotak1">{{$sub->Nama_Slot}}</div></a>
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
        
</div>
<div class="zer">
    
        
           
    @foreach($infoslot as $Info)
    <form action ="/opslotparkir/editinfo" method="post">
        {{ csrf_field() }}
    <h3>Nama Slot</h2> 
    <input type="text" value="{{$Info->Nama_Slot}}" class="input1" placeholder="Nama Slot" name="nama"
    pattern="[A-Za-z]+[0-9]{0,3}"></input>
    <input type="hidden" value="{{$Info->id}}" name="id"></input>
    
    <input type="hidden" value="{{$Info->Status_Slot}}" name="status"></input>
    <input type="hidden" value="{{$l->id}}" name="lid"></input>
    <input type="hidden" value="{{$l->Jumlah_Slot}}" name="jslot"></input>

    </br></br>
    <input type="submit" class="btn btn-primary" value="Edit"></input>

    </form>
     @if($Info->Status_Slot == 0)
     
     @else
</br>
    <form action="/opslotparkir/deleteinfo" method="post">
        {{ csrf_field() }}
        <input type="hidden" value="" name="nama"></input>
        <input type="hidden" value="{{$Info->id}}" name="id"></input>
        <input type="hidden" value="0" name="status"></input>
        <input type="hidden" value="{{$l->id}}" name="lid"></input>
        <input type="hidden" value="{{$l->Jumlah_Slot}}" name="jslot"></input>
    
        <input type="submit" class="btn btn-danger" value="Delete"></input>  
    </form>         
     @endif
     
    @endforeach
</div>

@endforeach 
      

@endsection