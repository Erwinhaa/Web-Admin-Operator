@extends('layouts.appa')

@section('content')
<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Ganti Password</div>
                    
                        <div class="card-body">
                            <form method="POST" action="/slotoperator/ganti">
                                @csrf
                                @foreach($operator as $op)
                                <div class="form-group row">
                                    <input type="hidden" name="id" value="{{$op->id}}">
                                    <input type="hidden" name="pass" value="{{$op->password}}">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{$op->Email}}" readonly autofocus>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password2" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password2" type="password" class="form-control" name="password2" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </button>
                                        </div>
                                    </div>
    
                          
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endforeach
@endsection