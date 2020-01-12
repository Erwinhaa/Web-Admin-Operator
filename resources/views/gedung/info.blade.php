<style type="text/css">
    .peta{
        margin-left:-150px;
    }
    .tombol1{
        margin-top:-37px;
        height:37px;
        margin-right:-50px;
        float:right;

    }
    </style>
    @extends('layouts.appa')
    
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Info Gedung</div>
                        
                    <div class="card-body">
            
        <form action="/gedung/update", method = "post" >
            {{ csrf_field() }} 
            <input type="hidden" class="" value="{{$gedung->id}}" name="id" required>
            <div class="form-group row">
                    <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama Gedung') }}</label>
    
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="namagedung" value="{{$gedung->Nama_Gedung}}" required autocomplete="name" autofocus>
                    </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Biaya Parkir') }}</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="biaya" value="{{$gedung->Biaya}}" required autocomplete="name" autofocus>
                </div>
            </div>
            
            
            <div class="form-group row">
                    <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Gedung') }}</label>
    
                    <div class="col-md-6">
                            <input id="pac-input" class="controls" value="{{$gedung->Alamat}}" type="text" placeholder="alamat" name="alamat">  
                            <div class="peta">@include('inc.editpeta')</div>
            </div>
            </div>
            
            <div class="form-group row">
                    <label for="idope" class="col-md-4 col-form-label text-md-right">{{ __('Nama Operator') }}</label>
                    @foreach($user as $us)
                        
                            <div class="col-md-6">
                            <input type="hidden" value="{{$us->id}}" name="idope">
                            <input type="text" value="{{$us->Name_Operator}}"class="form-control" name="nama" readonly>
                            </div>
                        
                    @endforeach
                        </div>
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Data') }}
                                    </button>
                                    <a href="/slot/{{$gedung->id}}" class="btn btn-primary" >Lihat Layout</a>
                            </div>
                                </div>
                            </div>
            
                            </form>
                
    
        </div>  
        </div>
        </div>
        </div>
    </div>
    @endsection