
@extends('layouts.appa')

@section('content')

<link href="{{asset('css/lantai.css')}}" rel="stylesheet">
<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>
@foreach($lantai as $l)
<form action ="/lantai/tambahlayout" method="post"> 
            {{ csrf_field() }} 
<h4>Nama Gedung
</br>

@foreach($gedung as $g)                                               
       <span style="color:g"class="ser">{{$g->Nama_Gedung}}</span>
<div class="kepala">
    
<!--Cetak List Lantai -->  
        @foreach($lantai1 as $l1)
        @if($l1->id == $l->id)          
            <a href="/lantai/{{$l1->id}}"><div class="men1">{{$l1->Nama_Lantai}}</div></a>
        @else
            <a href="/lantai/{{$l1->id}}"><div class="men2">{{$l1->Nama_Lantai}}</div></a>
        @endif
        @endforeach
      
@endforeach
</div>
<div class="tombol">    
        
        <a href="#tambah1" data-toggle="modal" class="btn btn-primary">Tambah Lantai</a>
        <a href="#edit1" data-toggle="modal" class="btn btn-primary">Edit Nama Lantai</a>     
        <a href="/lantaisetpintu/{{$l->id}}" class="btn btn-primary">Set Pintu</a>
        <a href="/lantaisetarah/{{$l->id}}" class="btn btn-primary">Set Arah</a>
         
        <a href="/lantaideleteitem/{{$l->id}}" class="btn btn-danger">Delete Item</a>
        @foreach($lantai2 as $l2)
            @if($l->id != $l2->id)
                <a href="#delete1" data-toggle="modal" class="btn btn-danger">Delete Lantai</a>
            @endif
    </div>
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

    
       
    </form>
       @include('inc.modal1')
 
@endforeach


@endforeach
</br></br></br>

<div class="isi">       
    <!--Cetak Slot Lantai -->
        @foreach($slot as $sub)
            
                    @if($sub->Status_Slot == 0)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak"></div></a>
                    @elseif($sub->Status_Slot == 2)
                    <a href="/slotparkir/{{$sub->id}}"><div class="kotak1">{{$sub->Nama_Slot}}</div></a>
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
        <div class="bawah">
                <div class="menee">
                    <a href="/slot/{{$l->id}}/add" class="btn btn-primary">Add Slot</a>
                    <a href="#delete10" data-toggle="modal" class="btn btn-danger">Delete Slot</a>
                </div>
                <div class="menee1">            
                    <a href="/lantaitest/{{$l->id}}" class="btn btn-primary">Slot Easy</a>
                    <a href="/lantaitestdelete/{{$l->id}}" class="btn btn-danger">Delete Slot Easy</a>
                </div>
                @include('inc.modal1')
        </div>         
      
</div>

</div>
      
      

@endsection