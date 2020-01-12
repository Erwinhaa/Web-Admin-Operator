@extends('layouts.appa')

@section('content')
<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Apakah Anda Yakin Untuk Mendelete Account Ini. </div>
                    
                        <div class="card-body">
                                <form action ="/slotoperator/delete" method="post">
                                    {{ csrf_field() }}   
                                @foreach($operator as $op)
                                <div class="form-group row">
                                    
                                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama Operator') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="nama" type="text" class="form-control" name="nama" value="{{$op->Name_Operator}}"  readonly autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                
                                            <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{$op->Email}}" readonly>
                                            </div>
                                            <input type="hidden" name="email1" value="{{$op->Email}}">
                                            <input type="hidden" name="id" value="{{$op->id}}">
                                        </div>
                          
            
                                    <div class="form-group row">
                                        <label for="tanggal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Terdaftar') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="tanggal" value="{{$op->created_at}}" type="text" class="form-control" name="tanggal" required readonly>
                                        </div>
                                    </div>
                                    
                                        <div class="form-group row">
                                            <label for="idgedung" class="col-md-4 col-form-label text-md-right">{{ __('Assign Gedung') }}</label>
                                        @if(count($gedung) > 0)
                                            @foreach($gedung as $g)
                                     
                                                <div class="col-md-6">
                                                <input type="hidden" value={{$g->id}} name="gedungid">
                                                <input id="idgedung" type="text" class="form-control" name="idgedung" value="{{$g->Nama_Gedung}}" required readonly>
                                                </div>
                                            @endforeach
                                        @else
                                            
                                            <div class="col-md-6">
                                            <input id="idgedung" type="text" class="form-control" name="idgedung" value="Tidak Memiliki Auth" readonly>          
                                            </div>
                                            @endif

                                        </div>                              
                                        
                                    <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                        
                                                
                                                    
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                            </div>
                                        </div>

                                
                                 
                                    
                                </p>
                                @endforeach
                          
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection