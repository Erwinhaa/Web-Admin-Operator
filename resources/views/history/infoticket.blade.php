@extends('layouts.appa')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Info Ticket</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($ticket as $t)
                    <div class="form-group row">
                                    
                        <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Id Ticket') }}</label>

                        <div class="col-md-6">
                        
                        <input id="nama" type="text" class="form-control" name="nama" value="{{$t->id}}"  autofocus readonly>
                
                        </div>
                    </div> 
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama Gedung') }}</label>
                            
                            <div class="col-md-6">
                            @foreach($gedung as $g)
                            <input id="nama" type="text" class="form-control" name="nama" value="{{$g->Nama_Gedung}}"  autofocus readonly>
                            @endforeach
                            </div>
                    </div>    
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama User') }}</label>

                            <div class="col-md-6">
                            @foreach($user as $u)
                            <input id="nama" type="text" class="form-control" name="nama" value="{{$u->name}}"  autofocus readonly>
                            @endforeach
                            </div>
                    </div> 
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('No Plat') }}</label>

                            <div class="col-md-6">
                            @foreach($mobil as $m)
                            <input id="nama" type="text" class="form-control" name="nama" value="{{$m->No_Plat}}"  autofocus readonly>
                            @endforeach
                            </div>
                    </div>
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Slot Parkir') }}</label>

                            <div class="col-md-6">
                            @foreach($slotparkir as $slot)
                                @foreach($lantai as $l)
                                     <input id="nama" type="text" class="form-control" name="nama" value="Lantai {{$l->Nama_Lantai}} Slot {{$slot->Nama_Slot}}"  autofocus readonly>                       
                                @endforeach
                            @endforeach
                            </div>
                    </div>
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Order') }}</label>

                            <div class="col-md-6">
                            <input id="nama" type="text" class="form-control" name="nama" value="{{$t->Tanggal_Order}}"  autofocus readonly>                                   
                            </div>
                    </div>
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Check-In') }}</label>

                            <div class="col-md-6">
                            @if($t->Check_In == NULL)
                                <input id="nama" type="text" class="form-control" name="nama" value="-"  autofocus readonly>                                  
                            @else   
                                <input id="nama" type="text" class="form-control" name="nama" value="{{$t->Check_In}}"  autofocus readonly>                                   
                            @endif
                            </div>
                    </div>
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Check-Out') }}</label>

                            <div class="col-md-6">
                             @if($t->Check_Out == NULL)
                                <input id="nama" type="text" class="form-control" name="nama" value="-"  autofocus readonly>                                  
                             @else
                                <input id="nama" type="text" class="form-control" name="nama" value="{{$t->Check_Out}}"  autofocus readonly>                                   
                             @endif
                            </div>
                    </div>
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Biaya') }}</label>

                            <div class="col-md-6">
                             <input id="nama" type="text" class="form-control" name="nama" value="{{$t->Biaya}}"  autofocus readonly>                                   
                            
                            </div>
                    </div>
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Pinalti') }}</label>

                            <div class="col-md-6">
                             <input id="nama" type="text" class="form-control" name="nama" value="{{$t->Pinalti}}"  autofocus readonly>                                   
                            
                            </div>
                    </div>
                    <div class="form-group row">
                                    
                            <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                            @if($t->Status_Ticket == '0')
                                <input id="nama" type="text" class="form-control" name="nama" value="Sedang Order"  autofocus readonly>                                   
                            @elseif($t->Status_Ticket == '1')
                                <input id="nama" type="text" class="form-control" name="nama" value="Pending"  autofocus readonly>                                    
                            @elseif($t->Status_Ticket == '2')
                                <input id="nama" type="text" class="form-control" name="nama" value="Sudah Check-In"  autofocus readonly>                                   
                            @elseif($t->Status_Ticket == '3')
                                <input id="nama" type="text" class="form-control" name="nama" value="Sudah Check-Out"  autofocus readonly>                                   
                            @elseif($t->Status_Ticket == '4')
                                <input id="nama" type="text" class="form-control" name="nama" value="Batal Order"  autofocus readonly>                                   
                            @endif
                            </div>
                    </div>
                    


                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection
