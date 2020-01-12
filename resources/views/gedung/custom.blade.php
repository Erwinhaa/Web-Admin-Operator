<style type="text/css">
    .option1{
        width:200px;       
    }
    
</style>
@extends('layouts.appa')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                <div class="card-header">Informasi Gedung </div>
                    
                <div class="card-body">
                        <p>Cari Data Gedung : </p> 
                        <form action ="/slot/cari" method="post">
                            {{ csrf_field() }}
                          
                                <input type="text" name="cari" placeholder="Cari Gedung" value="">
                                <input type="submit" value="Search"></br></br>
                            
                        @if(count($gedung) > 0) 
                        <table class="table table-striped">
                                <tr>
                                    <th>Nama Gedung</th>
                                    
                                
                        
                                </tr>
                                @foreach($gedung as $g)
                                    <tr>
                                        <th><a href="/slot/{{$g->id}}">{{$g->Nama_Gedung}}</a></th>
                               
                                        
                                        
                                    </tr
                        
                                @endforeach
                            </form>
                            @endif
                
                </div>
            </div>
     
        </div>
    </div>
</div>
@endsection
