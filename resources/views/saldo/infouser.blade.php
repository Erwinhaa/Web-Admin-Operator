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
                      
                        <p>
                            @foreach($usa as $us)
                            Nama :  {{ $us->name }}
                            <P>
                            No HP :  {{ $us->No_Hp }}        
                            <p>
                            Saldo :  {{ $us->Saldo }}
                        <p>
                           
                        
                                <table class="table table-striped">
                                        <tr>
                                            <th>Tipe Mobil</th>
                                            <th>Nomor Plat</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach($mobils as $c)
                                            <tr>
                                                <th>{{$c->Tipe}}</th>
                                                <th>{{$c->No_Plat}}</th>
                                                <th></th>
                                                <th></th>
                                               
                                            </tr>                                    
                                        @endforeach
                                </table>
                        <p>Masukan Jumlah Saldo Yang Ingin Ditambahkan</P>
                            
                        <form action="/saldo/tambah" method="post">
                         
                            {{ csrf_field() }}
                        <input type="hidden" value="{{$us->id}}" name="id">
                        <input type="hidden" value="{{$us->Saldo}}" name="saldos">
                        <input type="text"  name="saldo">
                        <input type="hidden" value="{{ Auth::user()->id}}" name="opid">
                        
                        <input type="submit" value="Tambah Saldo">
                          
                        </form>                                                 
                </div>
                
            </div> @endforeach
     
        </div>
    </div>
</div>
@endsection
