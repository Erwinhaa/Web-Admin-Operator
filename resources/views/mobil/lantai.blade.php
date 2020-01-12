@extends('layouts.app')

@section('content')
<div class="container">
    <h3>List Gedung</h3>
    @foreach($gedung as $g)
        <h2><a href="/user/gedung/{{$g->id}}">{{$g->Nama_Gedung}}</a></h2>

    @endforeach
    @foreach($lantai as $l)
    <a href="/user/lantai/{{$l->id}}"><div class="btn btn-primary">{{$l->Nama_Lantai}}</div></a>
    @endforeach
    
</div>
@endsection