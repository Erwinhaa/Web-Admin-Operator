<style type="text/css">
    .{
        width:900px;
        m
    }
    .th2{
        backrgound-color:red;
    }
    </style>
        @extends('layouts.appa')
    
        @section('content')
    
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                        <div class="card">
                        <div class="card-header"><h3>Informasi User</h3></div>
                            
                        <div class="card-body">
                            Cari Data User:
                        </br>
                        </br>  
                            <form action="/userinfo/search" method="post">
                                {{ csrf_field() }}   
    
                            <input type="text" placeholder="Cari User" name="cari">
                            <input type="submit" value="Search">
                            </form>
                         </br>
                        </br>
                    
                                @if(count($user) > 0) 
                                <table class="table table-striped">
                                        <tr>
                                            <th>Nama User</th>
                                            <th>Email</th>
                                            <th>Nomor Handphone</th>
                                            <th>Saldo</th>   
                            
                                            
                                        </tr>
                                        @foreach($user as $us)
                                            
                                            <tr>
                                                <th><a href="/userinfo/{{$us->id}}">{{$us->name}}</a></th>
                                            <th>{{$us->Email}}</th>    
                                            <th>{{$us->No_Hp}}</th>
                                            <th>{{$us->Saldo}}</th> 
                                                                                               
                                            </tr>  
                                        @endforeach
                                 @else
                                    <h2>Tidak Ada Data User</h2>
                                 @endif
                                           
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
        <!-- Modal -->
    
    
    @endsection