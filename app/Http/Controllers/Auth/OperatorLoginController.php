<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class OperatorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:operator');
    }
    public function showLoginForm()
    {
        return view('auth.operator-login');
    }
    public function login(Request $request)
    {
        $this->validate($request , [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('operator')->attempt(['email' => $request->email , 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('operator.dashboard'));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
