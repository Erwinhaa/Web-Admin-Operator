@extends('layouts.app')

@section('content')
<div class="container">
    <h3>List Gedung</h3>
    <form action = "/mobil/share/cari" method="post">
    {{ csrf_field() }} 
    User ID : <input type="text" name="id" value="{{ Auth::user()->id}}" readonly>
    </br></br>
    Cari : <input type="text" name="cari" placeholder="Cari User">
    </br></br>
    <input type="submit" value="Cari User" class="btn btn-primary">
    </br></br>
    @foreach($user as $us)
        <a href="/mobil/{{ Auth::user()->id}}/share/{{$us->id}}">{{$us->name}}</a>
    @endforeach
</form>
</div>
@endsection