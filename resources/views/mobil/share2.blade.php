@extends('layouts.app')

@section('content')
<div class="container">
    <form action = "http://127.0.0.1/Skripsi/public/api/sharemobil
    " method="post">
        {{ csrf_field() }} 
        <h3>Pesan</h3>
        @foreach($user as $u)
        Nama User Untuk Diganti : {{$u->name}}
        </br>
        User ID Untuk Diganti : <input type="text" value="{{$id}}" name="id" readonly>
        </br>
        @endforeach
        </br>
        Mobil  : Ini Kirimkan Mobil ID 
        <select name="mobilid">
            @foreach($mobil as $m)
                <option value="{{$m->id}}">{{$m->No_Plat}}</option>
            @endforeach
        </select>
    </br></br>
        <input type="submit" value="Ganti Kepemilikan" class="btn btn-primary">
    
    </form>
        
</div>
@endsection