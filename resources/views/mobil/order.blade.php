@extends('layouts.app')

@section('content')
<div class="container">
    <form action = "http://127.0.0.1/Skripsi/public/api/pesan" method="post">
        {{ csrf_field() }} 
        <h3>Pesan</h3>
        UserID : <input type="text" value="{{$userid}}" name="userid" readonly>
        </br>
        @foreach($slot as $s)
        SlotID : <input type="text" value="{{$s->id}}" name="slotid" readonly>
        @endforeach
        </br>
        Mobil  : 
        <select name="mobilid">
            @foreach($mobil1 as $m1)
                <option value="{{$m1->id}}">{{$m1->No_Plat}}</option>
            @endforeach
            @foreach($mobil as $m)
                <option value="{{$m->id}}">{{$m->No_Plat}}</option>
            @endforeach
        </select>
    </br>
        <input type="submit" value="Pesan">
    
    </form>
        
</div>
@endsection