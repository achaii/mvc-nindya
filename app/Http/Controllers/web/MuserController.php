<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;

class MuserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $no = 1;
        $noo = 1;
        $select = DB::table('users')->get();
        $unit = DB::table('unit')->get();
        return view('web.muser',[
            'select' => $select,
            'unit' => $unit,
            'no' => $no,
            'noo' => $noo
        ]);
    }

    public function store(Request $request){
        $select = DB::table('unit')->where('id',$request->kesatuan)->first();
        DB::table('users')->insert([
            'nama' => $request->nama,
            'name' => $select->nama_unit,
            'email' => $request->username.'@selralaka.com',
            'password' => bcrypt($request->password),
            'password_hit' => $request->password,
            'id_unit' => $request->kesatuan,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
            'gambar' => 'ava.png',
        ]);
        return redirect()->route('webmuser');
    }

    public function update(Request $request,$id){
        if($request->kesatuan == '0'){
            $nama = 'SUBDIT GAKKUM';
        }else{
            $select = DB::table('unit')->where('id',$request->kesatuan)->first();
            $nama = $select->nama_unit;
        }
        
        DB::table('users')->where('id',$id)->update([
            'name' => $nama,
            'nama' => $request->nama,
            'email' => $request->username.'@selralaka.com',
            'password' => bcrypt($request->password),
            'password_hit' => $request->password,
            'id_unit' => $request->kesatuan,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('webmuser');
    }

    public function destroy($id){
        DB::table('users')->where('id',$id)->delete();
        return redirect()->route('webmuser');
    }
}
