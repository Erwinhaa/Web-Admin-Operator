@extends('layouts.appc')

@section('content')
<link href="{{asset('css/ticket.css')}}" rel="stylesheet">

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
                <div class="card-header"><h3>List Ticket</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/order/cari" method="post">
                        {{ csrf_field() }}
                        <p>Cari Data Ticket</p>
                        <input type="text" placeholder="ID Ticket" name="cari">
                        <input type="submit" value="Search">
                    </br></br>
                    </form>
                    @if(count($ticket) > 0)
                        <table>
                            <tr>
                                <td>ID</td>
                                <td>Nama User</td>
                                <td>No Plat</td>
                                <td>Nama Gedung</td>
                                <td>Slot Parkir</td>
                                <td>Tanggal Order</td>
                                <td>Check-In</td>
                                <td>Check-Out</td>
                                <td>Status Ticket</td>
                                <td>Detail Ticket</td>
                            </tr>
                        @foreach($ticket as $t)
                            @foreach($mobil as $m)
                                @if($m->id == $t->Mobil_Id)
                            <tr>
                                <td>{{$t->id}}</td>
                                <td>
                                    @foreach($user as $us)
                                        @if($us->id == $t->User_Id)
                                            {{$us->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{$m->No_Plat}}
                                </td>
                                <td>
                                    @foreach($gedung as $g)
                                        @if($g->id == $t->Gedung_Id)
                                            {{$g->Nama_Gedung}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($slotparkir as $slot)
                                        @if($slot->id == $t->Slot_Id)
                                            {{$slot->Nama_Slot}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$t->Tanggal_Order}}</td>
                                <td>
                                    @if($t->Check_In == NULL)
                                        -
                                    @else
                                        {{$t->Check_In}}
                                    @endif
                                </td>
                                <td>
                                    @if($t->Check_Out == NULL)
                                        -
                                    @else
                                        {{$t->Check_Out}}
                                    @endif

                                </td>
                                <td>
                                    @if($t->Status_Ticket == 1)
                                        Pending
                                    @elseif($t->Status_Ticket == 2)
                                        Sudah Check-In
                                    @elseif($t->Status_Ticket == 3)
                                        Sudah Check-Out
                                    @elseif($t->Status_Ticket == 4)
                                        Batal Order
                                    @elseif($t->Status_Ticket == 0)
                                        Sedang Order
                                    @endif
                                </td>  
                                <td>
                                    <div class="tombol"><a href="/ticket/{{$t->id}}" class="btn btn-primary">Detail Ticket</a></div>
                                </td>
                            </tr>
                                @endif
                            @endforeach
                        @endforeach
                        </table>
                    @else
                        <h2>Tidak Ada Data Ticket</h2>  
                    @endif  
                                    

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
