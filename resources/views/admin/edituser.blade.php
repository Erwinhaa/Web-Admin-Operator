@extends('layouts.appa')

@section('content')
<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Info User</div>
                    
                        <div class="card-body">
                                    {{ csrf_field() }}   
                                @foreach($user as $u)
                                <div class="form-group row">
                                    
                                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama User') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="nama" type="text" class="form-control" name="nama" value="{{$u->name}}"  autofocus readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                
                                            <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{$u->Email}}" readonly>
                                            </div>
                                            <input type="hidden" name="email1" value="{{$u->Email}}">

                                        </div>
                                                           
                                        <div class="form-group row">
                                            <label for="idgedung" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Handphone') }}</label>
                                          <div class="col-md-6">      
                                                <input id="idgedung" type="text" class="form-control" name="idgedung" value="{{$u->No_Hp}}" required readonly>
                                          </div>

                                        </div>    
                                        <div class="form-group row">
                                            <label for="idgedung" class="col-md-4 col-form-label text-md-right">{{ __('Saldo') }}</label>
                                          <div class="col-md-6">      
                                                <input id="idgedung" type="text" class="form-control" name="idgedung" value="{{$u->Saldo}}" required readonly>
                                          </div>

                                        </div>        
                                        <?php $a=0;?>
                                        @foreach($mobil as $m)                   
                                        <div class="form-group row">
                                            <label for="idgedung" class="col-md-4 col-form-label text-md-right">
                                                <?php $a=$a+1;?>
                                                Mobil-{{$a}}
                                            </label>

                                            <div class="col-md-6">      
                                                    
                                                    <input id="idgedung" type="text" class="form-control" name="idgedung" value="{{$m->No_Plat}}" required readonly>
                                              </div>

                                           
                                        </div>
                                        @endforeach
                                        @foreach($mobilshare as $ms)                   
                                        <div class="form-group row">
                                            <label for="idgedung" class="col-md-4 col-form-label text-md-right">
                                                Mobil Share-1
                                            </label>

                                            <div class="col-md-6">      
                                                @if(count($mobilshare) > 0)    
                                                    <input id="idgedung" type="text" class="form-control" name="idgedung" value="{{$ms->No_Plat}}" required readonly>
                                                @else
                                                    <input id="idgedung" type="text" class="form-control" name="idgedung" value="-" required readonly>
                                                @endif
                                                </div>

                                           
                                        </div>
                                        @endforeach
                                </p>
                                @endforeach
                          
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection