    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My Profile</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            Nama :  {{ Auth::user()->name }}
                            <P>
                            No HP :  {{ Auth::user()->No_Hp }}        
                    <p>
                            Saldo :  {{ Auth::user()->Saldo }}
                            <p>
                            <a class="btn btn-primary" href="mobil/share">Share Mobil</a>

                                <p>
                                    @if(count($mobils) < 5)
                                        <a class="btn btn-primary" href="mobil/tambah">Tambah Mobil</a>
                                    @else    
                                        <p>Anda Tidak Bisa Menambahkan Mobil Lagi</p>
                                    @endif
                                    @if(count($mobils) > 0)
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Tipe Mobil</th>
                                            <th>Nomor Plat</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach($mobils as $c)
                            
                                            <tr>
                                                    
                                                <th>{{$c->Tipe}}</th>
                                                <th>{{$c->No_Plat}}</th>
                                                <th>{{$c->Status}}</th>
                                                <th><a href="/mobil/{{$c->id}}/edit" class="btn btn-primary">Edit</a></th>
                                                <th><a href="/mobil/{{$c->id}}/hapus" class="btn btn-primary">Delete</a></th>
                                            </tr>
                                        @endforeach
                                        @else
                                        <p>Anda Belum Memiliki Kendaraan</p>
                
                                        @endif
        
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
