<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;
use App\Ticket;
class TestApiController extends Controller
{
    //Untuk Testing Api Halaman Register
    public function __construct()
    {
        $this->middleware('auth:operator');
    }
    
    public function login(){
        return view('ztest.api.login');
    }
  
}
