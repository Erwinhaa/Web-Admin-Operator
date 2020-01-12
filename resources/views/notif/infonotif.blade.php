
    @extends('layouts.appc')

    @section('content')

    <link href="{{asset('css/lantai.css')}}" rel="stylesheet">
    
    <div class="container">
            <h1>Mengubah Slot</h1>
        @foreach ($notif as $n)

    <div class="isi">
    </br>  </br>  </br>
    
        <!--Cetak Slot Lantai -->
            @foreach($slot1 as $sub)
                
            @if($sub->Status_Slot == 0)
            <div class="kotak">{{$sub->Nama_Slot}}</div>
            @elseif($sub->Status_Slot == 2)
            @if($sub->id == $n->Solusi)
                <div class="kotak33">{{$sub->Nama_Slot}}</div>
            @else
                <div class="kotak1">{{$sub->Nama_Slot}}</div>
            @endif        
            @elseif($sub->Status_Slot == 3)
            <div class="kotak2">{{$sub->Nama_Slot}}</div>
            @elseif($sub->Status_Slot == 4)
                    <div class="kotak3">{{$sub->Nama_Slot}}</div>
            @endif
                
            @endforeach  
            <div class="qma">
                <form action="/notif/ganti" method="post">
                    {{ csrf_field() }}
                @foreach($user as $us)
                    <h2>Nama User : {{$us->name}}</h2>
                @endforeach
                </br>
                    <h2>Ticket Id : <a href="/ticket/{{$n->Ticket_Id}}">{{$n->Ticket_Id}}</a></h2>
                </br>
                    <h2>Keluhan : Mengubah Slot Menjadi 
                        @foreach($slot as $s1)
                            {{$s1->Nama_Slot}}
                        @endforeach
                    </h2>
                </br>
                <input type="hidden" value="{{$n->id}}" name="nid">
                <input type="hidden" value="{{$n->Solusi}}" name="sid">
                @foreach($ticket as $t)
                    <input type="hidden" value="{{$t->Slot_Id}}" name="sid1">
                @endforeach
                <input type="hidden" value="{{$n->Ticket_Id}}" name="tid">
                    <input type="submit" value="Ganti Slot" class="btn btn-primary">
                </form>
            </div>
        </div>
        @endforeach      
    </div>
    </form>
        

    @endsection