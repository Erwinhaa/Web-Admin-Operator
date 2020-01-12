@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Send Notif</h3>
    
    @foreach($ticket as $t)
    Ticket ID : <input type="text" value ="{{$t->id}}" readonly></br>
    No Plat : <input type="text" value ="{{$noplat}}" readonly></br>
    Tanggal_Order : <input type="text" value ="{{$t->Tanggal_Order}}" readonly></br>
    </br>
    <a href="kirimnotif/{{$t->id}}/lantai/{{$lid}}" class="btn btn-primary">Ubah Slot</a> 
    </br>
    @endforeach

</div>
@endsection