@extends('layouts.appc')

@section('content')
<link href="{{asset('css/history.css')}}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    @if(count($ticket) > 0)
                    <script>
                        d=count($ticket);
                        alert("a "+ d);   
                    </script> 
                    @endif
                <div class="card-header"><h3>Notifikasi</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/notif/cari" method="post">
                        {{ csrf_field() }}
                        <p>Cari Data Notif</p>
                        <input type="text" placeholder="Id Ticket" name="cari">
                        <input type="submit" value="Search">
                    </br></br>
                    </form>
                    @if(count($notif) > 0)
                        <table>
                            <tr>
                                <td>Id Ticket</td>
                                <td>User</td>
                                <td>Tanggal</td>
                                <td>Baca Pesan</td>
                            </tr>
                        @foreach($notif as $n) 
                            <tr>
                                <td><a href="/ticket/{{$n->Ticket_Id}}">{{$n->Ticket_Id}}</a></td>
                            
                            
                                @foreach($user as $u)
                                    @if($u->id == $n->User_Id)
                                        <td>{{$u->name}}</td>
                                    @endif
                                @endforeach
                            
                            
                            
                            
                                <td>{{$n->Tanggal}}</td>
                        
                                @if($n->Status == 1)
                                    <td><a href="/notif/{{$n->id}}" class="btn btn-primary">Baca</a></td>
                                @elseif($n->Status == 2)
                                    <td><a href="/notif/{{$n->id}}" class="btn btn-primary">Selesaikan</a></td>                          
                                @endif
                                </tr>
                        @endforeach
                        </table>
                    @else
                        <h2>Tidak Ada Notifikasi</h2>  
                    @endif  
                                    

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
