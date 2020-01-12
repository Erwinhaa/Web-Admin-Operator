<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mobil;
use DB;

class MobilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
                
        $mobils = DB::table('mobils')->select('No_Plat')->where('user_id','1')->get();
        return view('mobil.index')->with('mobils',$mobils);
    }

    public function store(Request $request)
    {   
        $no = $request->nobk;
        $no = str_replace(' ', '', $no);
        $noe= strtoupper($no);
        DB::table('mobils')->insert([
            'user_id' => $request->userid,
            'Tipe' => $request->tipe,
            'No_Plat' => $noe,
        ]);
        return redirect('/profile')->with('success','Data Mobil Berhasil Ditambah');        
    }
    public function edit($id)
    {
        $mobil = Mobil::find($id);
        if(auth()->user()->id !== $mobil->user_id){
            return redirect('/profile')->with('error','Anda Tidak Memiliki Hak Untuk Mengedit');
        }   
        return view('mobil.edit')->with('mobil',$mobil);
    }
    public function update(Request $request)
    {
        	// update data mobil
	    DB::table('mobils')->where('id',$request->id)->update([
            'Tipe' => $request->jk,
            'No_Plat' => $request->nobk,
	    ]);	
	    return redirect('/profile')->with('success','Data Mobil Berhasil Diubah');
    }
    public function hapus($id)
    {   
        $mobil = Mobil::find($id);
        if(auth()->user()->id !== $mobil->user_id){
            return redirect('/profile')->with('error','Anda Tidak Memiliki Hak Untuk Menghapus');
        }       
        $mobil->delete();
        return redirect('/profile')->with('success','Data Mobil Berhasil Dihapus');
    }
}
