@extends('layouts.app')

@section('content')
<link href="{{asset('css/lantaioperator.css')}}" rel="stylesheet">

<div class="container">
        <form action = "http://127.0.0.1/Skripsi/public/api/kirimnotif" method="post">
            {{ csrf_field() }} 
    <h3>Ubah Lantai</h3>
    <?php $a=0; $b=0; 

$a1=0; $b1=0;
?>


</br>
<!--Cetak List Lantai -->
@foreach($ticket as $t)

    @foreach($lantai as $l)      
            <h1>Lantai {{$l->Nama_Lantai}}</h1>
</br>
    @foreach($lantai1 as $l1)
        <a href="/kirimnotif/{{$t->id}}/lantai/{{$l1->id}}"><div class="btn btn-primary">{{$l1->Nama_Lantai}}</div></a>
    @endforeach


</br></br></br>
<div class="isi">       
    <!--Cetak Slot Lantai -->
        @foreach($slot as $sub)          
                    @if($sub->Status_Slot == 0)
                    <div class="kotak"></div></a>
                    @elseif($sub->Status_Slot == 2)
                    <a href="/{{$sub->id}}"><div class="kotak1">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 3)
                    <div class="kotak2">{{$sub->Nama_Slot}}</div></a>
                    @elseif($sub->Status_Slot == 4)
                    <div class="kotak3">{{$sub->Nama_Slot}}</div></a>
                @endif
            
        @endforeach  
</br></br>


        Ticket ID : <input type="text" value ="{{$t->id}}" readonly name="tid"></br>
        Nama Lantai: <input type="text" value ="{{$l->Nama_Lantai}}" readonly></br>
        Nama Slot : <input type="text" value ="{{$namaslot}}" readonly></br>
        Pilih Slot : <input type="text" name="slotid"></br>

    </br>
    <input type="submit" value="Kirim Notif">
    </br>
        </div>
     
        @endforeach
    
</div>

</div>
</form>
@endforeach 

@endsection