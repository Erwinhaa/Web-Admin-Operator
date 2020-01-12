@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Mobil</h3>
    <form action="/mobil/store", method = "post" >
        {{ csrf_field() }} 
    
    @if(count($mobils) < 5)
        <input type="hidden" class="" value = "{{ Auth::user()->id}}" name="userid">
            
        Tipe Mobil
        </br>
        <input type="text" class="" name="tipe" required>
        </br>
        </br>
        Nomor Plat
        </br>    
        <input type="text" class="" name="nobk" required>
        </br>
        </br>
        <input type="submit" class="" value="Tambah Kendaraan">
        </form>
    @else
        <p>Anda Tidak Bisa Menambah Mobil Lagi</p>      
    @endif
</div>
@endsection