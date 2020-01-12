@extends('layouts.appa')

@section('content')
<?php
$a=0
?>
@foreach($history as $t)
    @foreach($user as $us)
        @if($us->id == $t->user_id)
            <?php $a=$a+1;
            
            ?>
        @endif
    @endforeach
@endforeach
<link href="{{asset('css/history.css')}}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>History Saldo</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/historysaldo/cari" method="post">
                        {{ csrf_field() }}
                        <p>Cari Data</p>
                        <input type="text" placeholder="Nama User" name="cari">
                        <input type="submit" value="Search">
                    </br></br>
                    </form>
                    @if($a > 0)
                        <table>
                            <tr>
                                <td>Nama User</td>
                                <td>Nama Operator</td>
                                <td>Gedung</td>
                                <td>Saldo</td>
                                <td>Tanggal Transaksi</td>
                            </tr>
                        @foreach($history as $h)
                            <tr>
                                @foreach($user as $u)
                                    @if($u->id == $h->user_id)
                                        <td>                               
                                            <a href="/userinfo/{{$u->id}}">{{$u->name}}</a>                
                                        </td>
                                        <td>
                                            @foreach($operator as $op)
                                                @if($op->id == $h->operator_id)
                                                    <a href="/slotoperator/{{$op->id}}">{{$op->Name_Operator}}</a>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$h->nama_gedung}}</td>
                                        <td>{{$h->jumlah}}</td>
                                        <td>{{$h->created_at}}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                        </table>
                    @else
                        <h2>Tidak Ada Data </h2>  
                    @endif  
                                    

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
