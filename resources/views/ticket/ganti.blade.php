
    @extends('layouts.appc')

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
        
        
    <!--Cetak List Lantai -->
        @foreach($lantai1 as $l1)
            @if($l1->id == $l->id)          
                <a href="/ganti/{{$tid}}/lantai/{{$l1->id}}"><div class="men1">{{$l1->Nama_Lantai}}</div></a>
            @else
                <a href="/ganti/{{$tid}}/lantai/{{$l1->id}}"><div class="men2">{{$l1->Nama_Lantai}}</div></a>
            @endif
        @endforeach

    @endforeach
    </br></br>
    </br></br></br>
    <form action="/gantislot/ganti" method="post">
    @foreach ($ticket as $t)
    {{ csrf_field() }}
    <div class="isi">
        <h2>Choose Slot To Change</h2>
    
        <!--Cetak Slot Lantai -->
            @foreach($slot as $sub)
                
            @if($sub->Status_Slot == 0)
            <div class="kotak">{{$sub->Nama_Slot}}</div>
            @elseif($sub->Status_Slot == 2)
            <label class="kotak21"><input type="radio" name="knk" value="{{$sub->id}}" class="input1" required>
            <div class="abed">{{$sub->Nama_Slot}}
            </div></label>            
            @elseif($sub->Status_Slot == 3)
            <div class="kotak2">{{$sub->Nama_Slot}}</div>
            @elseif($sub->Status_Slot == 4)
                @if($sub->id == $t->Slot_Id)
                    <div class="kotak33">{{$sub->Nama_Slot}}</div>
                @else
                    <div class="kotak3">{{$sub->Nama_Slot}}</div>
                @endif
        @endif
                
            @endforeach  
            <div class="qma">
                    <h3>Info Ticket</h3>
                    @foreach($gedung as $g)
                    Nama Gedung : {{$g->Nama_Gedung}}</br>
                    @endforeach
                    Nama User : {{$namauser}} </br>
                    No Plat Kendaraan : {{$noplat}} </br>
                    Slot Parkir : Lantai {{$lantaislot}} Slot {{$namaslot}} </br>
                    <input type="hidden" value="{{$sid}}" name="sid">
                    <input type="hidden" value="{{$t->id}}" name="tickid">
                    <input type="hidden" value="{{$t->Status_Ticket}}" name="status">
                    @foreach($lantai as $l)
                        <input type="hidden" value="{{$l->id}}" name="lantaiid">
                    @endforeach
                @endforeach
            <input type="submit" class="btn btn-primary" value="Ganti">
            </div>
        </div>      
    </div>
    </form>
        

    @endsection