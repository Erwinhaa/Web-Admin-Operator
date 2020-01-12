@extends('layouts.appa')

@section('content')

<link href="{{asset('css/ticket.css')}}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>List Ticket</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/historyticket/cari" method="post">
                        {{ csrf_field() }}
                        <p>Cari Data Ticket</p>
                        <input type="text" placeholder="ID" name="cari">
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
                                    @foreach($mobil as $m)
                                        @if($t->Mobil_Id == $m->id)
                                            {{$m->No_Plat}}
                                        @endif
                                    @endforeach
                                    @if($t->Status_Ticket == 3 || $t->Status_Ticket == 4)
                                        {{$t->Mobil_Id}}
                                    @endif
                                </td>
                                <td>
                                    @foreach($gedung as $g)
                                        @if($g->id == $t->Gedung_Id)
                                            {{$g->Nama_Gedung}}
                                        @endif
                                    @endforeach
                                    @if($t->Status_Ticket == 3 || $t->Status_Ticket == 4)
                                        {{$t->Gedung_Id}}
                                    @endif
                                </td>
                                <td>
                                    @foreach($slotparkir as $slot)
                                        @foreach($lantai as $l)
                                            @if($slot->id == $t->Slot_Id)
                                                @if($slot->Lantai_Id == $l->id)
                                                    Lantai{{$l->Nama_Lantai}}-{{$slot->Nama_Slot}}
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                    @if($t->Status_Ticket == 3 || $t->Status_Ticket == 4)
                                        {{$t->Slot_Id}}
                                    @endif
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
                                    @elseif($t->Status_Ticket == 0)
                                        Sedang Order
                                    @elseif($t->Status_Ticket == 3)
                                        Sudah Check-Out
                                    @elseif($t->Status_Ticket == 4)
                                        Batal Order
                                    @endif
                                </td>  
                                <td>
                                    <div class="tombol"><a href="/ticketinfo/{{$t->id}}" class="btn btn-primary">Detail Ticket</a></div>
                                </td>
                            </tr>
                                
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
