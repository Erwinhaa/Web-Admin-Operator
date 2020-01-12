<style type="text/css">
    .ko{
        margin-left:15px;
        width:100px;
        
    }
</style>    
@extends('layouts.appa')

@section('content')
<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Info Gedung</div>
                    
                        <div class="card-body">
                            <form method="POST" action="/gedung/update">
                                <input type="hidden" class="" value="{{$gedung->id}}" name="id" required>
                                @csrf
                            
                                <div class="form-group row">
                                    <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama Gedung') }}</label>
        
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="namagedung" value="{{$gedung->Nama_Gedung}}" required autocomplete="name" autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>
            
                                        <div class="col-md-6">
                                                
                                        <input type="text" class="form-control" value="{{$gedung->Alamat}}"name="alamat">
                                        </div>
                                    </div>
        
                                <div class="form-group row">
                                    <label for="idope" class="col-md-4 col-form-label text-md-right">{{ __('Nama Operator') }}</label>
                                    @foreach($user as $us)
                                        @if($us->id == $gedung->Operator_Id)
                                            <div class="col-md-6">
                                            <input type="hidden" value="{{$us->id}}" name="idope">
                                            <input type="text" value="{{$us->Name_Operator}}"class="form-control" name="nama" readonly>
                                            </div>
                                        @endif 
                                    @endforeach

                                 
                                </div>
                                <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('List Operator') }}</label>
                                        <select name="opid" class="ko"> 
                                            @foreach($user as $us)                                              
                                             <option value="{{$us->id}}" name="opid" class="">{{$us->Name_Operator}}</option>
                                            @endforeach
                                        </select> 
                                        
                                </div>
                                <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Edit Data') }}
                                            </button>
                                        </div>
                                    </div>
    
                          
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection