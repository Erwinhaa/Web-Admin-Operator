@extends('layouts.appa')

@section('content')

<link href="{{asset('css/history.css')}}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Laporan Keuangan</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/transaksi/cari" method="post">
                        {{ csrf_field() }}
                        @foreach($gedung as $g)
                        <p>Nama Gedung : {{$g->Nama_Gedung}}</p>
                        <input type="hidden" value="{{$g->id}}" name="gid">
                        @endforeach
                        <p>Cari Data</p>
                        Tahun :  <input type="text" placeholder="Tahun" name="tahun" required></br></br>
                        Bulan :
                        <select name="bulan">
                            <option value="1">Januari</option>
                            <option value="2">Febuari</option> 
                            <option value="3">Maret</option>
                            <option value="4">April</option>       
                            <option value="5">Maret</option>
                            <option value="6">Juni</option> 
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option> 
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        </br></br>
                        <input type="submit" value="Search">
                    </br></br>
                    </form>
                    
                    @if(count($transaksi) > 0)
                        <table>
                            <tr>
                                <td>Nama User</td>
                                <td>Nama Operator</td>
                                <td>Jumlah</td>
                                <td>Jenis Transaksi</td>
                                <td>Tanggal Transaksi</td>
                            </tr>
                            
                                    @foreach($transaksi  as $tr)
                                        <tr>
                                            <td>
                                                @foreach($user as $u)
                                                    @if($u->id == $tr->User_Id)
                                                                                
                                                        <a href="/userinfo/{{$u->id}}">{{$u->name}}</a>                
                                                    
                                                    @endif
                                                @endforeach
                                                
                                            </td> 
                                            <td>
                                                @foreach($operator as $op)
                                                    @if($op->id == $tr->Operator_Id)
                                                        <a href="/slotoperator/{{$op->id}}">{{$op->Name_Operator}}</a>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$tr->Jumlah}}</td>
                                            <td>{{$tr->Jenis}}</td>
                                            <td>{{$tr->Tanggal}}</td>
                                        </tr>
                                    @endforeach
                            
                        </table>
                    </br>
                    <h4>Total Biaya Parkir : {{$totalparkir}}</h4>
                    <h4>Total TopUp Saldo : {{$totaltopup}}</h4>
                    <h4>Jumlah Transaksi : {{$totalsemua}}</h4>
                    @else
                        <h4>Tidak Ada Data</h4>         
                    @endif
                                    

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
