
@extends('layouts.appa')

@section('content')

<link href="{{asset('css/lantai.css')}}" rel="stylesheet">
<div class="container">
<?php $a=0; $b=0; 

$a1=0; $b1=0;
?>
<script language="JavaScript">
        function toggle(source) {
        checkboxes = document.getElementsByName('knk[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
          checkboxes[i].checked = source.checked;
        }
      }
      </script> 
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
</br></br>
<form action="/lantaideleteitem/delete" method="post">
    {{ csrf_field() }}
  <div class="isi">       
    <div class="isi">  
        <H2>Choose Item To Delete </h2>  
        <input type="checkbox" onClick="toggle(this)" /> Toggle All<br/>        
       
        <!--Cetak Slot Lantai -->
            @foreach($slot as $sub)
                
            
            @if($sub->Status_Slot == 0)
            <div class="kotak">{{$sub->Nama_Slot}}</div>
            @elseif($sub->Status_Slot == 2)   
            <div class="kotak1">{{$sub->Nama_Slot}}</div>
            @elseif($sub->Status_Slot == 3)
            <div class="kotak2">{{$sub->Nama_Slot}}</div>
            @elseif($sub->Status_Slot == 4)
            <div class="kotak3">{{$sub->Nama_Slot}}</div>
               <!--Untuk Arah-->
          @elseif($sub->Status_Slot == 5)
          <label class="kotak212"><input type="checkbox" name="knk[]" value="{{$sub->id}}" class="input1">
            <div class="abeded">
              <img src="/images/pintumasuk.png" width="50px" height="50px">  
            </div></label>
          @elseif($sub->Status_Slot == 6)<label class="kotak212"><input type="checkbox" name="knk[]" value="{{$sub->id}}" class="input1">
            <div class="abeded">
              <img src="/images/pintukeluar.png" width="50px" height="50px">  
            </div></label>
          @elseif($sub->Status_Slot == 11)<label class="kotak212"><input type="checkbox" name="knk[]" value="{{$sub->id}}" class="input1">
            <div class="abeded">
              <img src="/images/arahatas.png" width="50px" height="50px">  
            </div></label>
          @elseif($sub->Status_Slot == 12)<label class="kotak212"><input type="checkbox" name="knk[]" value="{{$sub->id}}" class="input1">
            <div class="abeded">
              <img src="/images/arahkiri.png" width="50px" height="50px">  
            </div></label>   
          @elseif($sub->Status_Slot == 13)<label class="kotak212"><input type="checkbox" name="knk[]" value="{{$sub->id}}" class="input1">
            <div class="abeded">
              <img src="/images/arahkanan.png" width="50px" height="50px">  
            </div></label>
          @elseif($sub->Status_Slot == 14)<label class="kotak212"><input type="checkbox" name="knk[]" value="{{$sub->id}}" class="input1">
            <div class="abeded">
              <img src="/images/arahbawah.png" width="50px" height="50px">  
            </div></label>
          
            @endif          
            @endforeach  
          <div class="bawah">
                <div class="menee">
                        @foreach ($lantai as $l)
                      
                        @endforeach
                        <input type="submit" value="Delete" class="btn btn-danger">
                        <input type="hidden" name="lid" value="{{$l->id}}">
                        <input type="hidden" name="jl" value="{{$l->Jumlah_Slot}}">
                        <input type="hidden" name="d" value="">
                </div>
        </div>     
          <div class="qma">
              
          </div> 
          </div>
  
                   

  </div>
  </form>
     
</div>
      
      

@endsection