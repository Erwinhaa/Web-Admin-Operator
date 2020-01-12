<style type="text/css">
    .option1{
        width:200px;
        
    }
    
</style>
@extends('layouts.appc')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                <div class="card-header">Informasi User </div>
                    
                <div class="card-body">
                        <p>Cari Data User : </p> 
                        <form action ="/saldo/cari" method="post">
                            {{ csrf_field() }}
                          
                                <input type="text" name="cari" placeholder="Cari User" value="{{ old('cari') }}">
                                <input type="submit" value="Search"></br></br>
                            
                        @if(count($user) > 0) 
                        <table class="table table-striped">
                                <tr>
                                    <th>Nama User</th>
                                    
                                    <th>Tambah Saldo</th>
                        
                                </tr>
                                @foreach($user as $c)
                                    <tr>
                                        <th>{{$c->name}}</th>
                               
                                        <th><a href="/saldo/{{$c->id}}" class="btn btn-primary">+</a></th>
                                        
                                    </tr
                        
                                @endforeach
                            </form>
                        @else 
                            <h1>Tidak Ada Data User</h1>
                        @endif
                
                </div>
            </div>
     
        </div>
    </div>
</div>
@endsection
