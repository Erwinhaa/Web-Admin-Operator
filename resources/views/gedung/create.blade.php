@extends('layouts.appa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Gedung</div>
                    
                <div class="card-body">
        
    <form action="/gedung/store", method = "post" >
        {{ csrf_field() }} 
        
        <input type="hidden" class="" value = "{{$idoperator}}" name="opid">
            Nama Gedung
            </br>
            <input type="text" class="" name="nama" required>
            </br>
            </br>
            Alamat Gedung
            
        </br>
            @include('inc.peta')
            </br></br>
            Biaya
        </br>
        <input type="text" name="biaya" required>
        </br>
           </br>
            <input type="submit" class="" value="Tambah Gedung">
            </form>
        </br>
            

    </div>  
    </div>
    </div>
    </div>
</div>
@endsection