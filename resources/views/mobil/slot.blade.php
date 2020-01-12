
@extends('layouts.app')

@section('content')

<link href="{{asset('css/lantaioperator.css')}}" rel="stylesheet">
<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>


</br>
<!--Cetak List Lantai -->
    @foreach($lantai as $l)      
            <h1>Lantai {{$l->Nama_Lantai}}</h1>
</br>
    @foreach($lantai1 as $l1)
        <a href="/user/lantai/{{$l1->id}}"><div class="btn btn-primary">{{$l1->Nama_Lantai}}</div></a>
    @endforeach


</br></br></br>
<div class="isi">       
    <!--Cetak Slot Lantai -->
        @foreach($slot as $sub)
            
                    @if($sub->Status_Slot == 0)
                    <div class="kotak"></div></a>
                    @elseif($sub->Status_Slot == 2)
                    <a href="/user/slot/{{$sub->id}}"><div class="kotak1">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 3)
                    <div class="kotak2">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 4)
                    <div class="kotak3">{{$sub->Nama_Slot}}</div></a>
                @endif
            
        @endforeach  
            
      
        </div>
        
</div>
<div class="zer">
    
        
           
</div>

@endforeach 
      

@endsection