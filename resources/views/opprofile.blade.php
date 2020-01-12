@extends('layouts.appc')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informasi Operator </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>
                        Nama :  {{ Auth::user()->Name_Operator }}
                        <P>
                        Tanggal :{{ Auth::user()->created_at }}
                        </P>
                        Gedung Yang Diurus :                 
                        @foreach($gedung as $g)
                            {{$g->Nama_Gedung}}
                        @endforeach
                        </p>                 
                        
                   
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
