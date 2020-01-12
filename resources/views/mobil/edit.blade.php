@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Info Mobil</h3>
    <form action="/mobil/update", method = "post" >
        {{ csrf_field() }}
    <input type="hidden" class="" value="{{$mobil->id}}" name="id" required>
    Tipe Mobil
    </br>
    <input type="text" class="" value="{{$mobil->Tipe}}" name="jk" required>
    </br>
    </br>
    No Plat
    </br>    
    <input type="text" class="" value="{{$mobil->No_Plat}}" name="nobk">
    </br>
    </br>
    <input type="submit" class="" value="Edit Data">
    </form>
</div>
@endsection