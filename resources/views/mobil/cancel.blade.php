@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Cancel Order</h3>
    
    @foreach($ticket as $t)
    <input type="text" value ="{{$t->id}}" readonly>
   
    <a href="http://127.0.0.1/Skripsi/public/api/ticket/{{$t->id}}/batal" class="btn btn-primary">Cancel Order</a> 
    </br>
    @endforeach

</div>
@endsection