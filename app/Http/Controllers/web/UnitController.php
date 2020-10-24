<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $no = 1;
        $select = DB::table('unit')->get();
        return view('web.munit',[
            'select' => $select,
            'no' => $no
        ]);
    }

    public function store(Request $request){
        //dd($request->kesatuan);
        DB::table('unit')->insert([
            'nama_unit' => $request->kesatuan
        ]);

        return redirect()->route('webmunit');
    }

    public function update(Request $request,$id){
        DB::table('unit')->where('id',$id)
        ->update([
            'nama_unit' => $request->kesatuan
        ]);

        return redirect()->route('webmunit');
    }

    public function destroy($id){
        DB::table('unit')->where('id',$id)->delete();
        return redirect()->route('webmunit');
    }

    public function status(){
        $select = DB::table('unit')->get();
        $no = 1;
        return view('web.munit-valid',[
            'select' => $select,
            'no' => $no
        ]);
    }

    public function status_valid(Request $request,$id){
        DB::table('unit')
        ->where('id',$id)
        ->update([
            'status' => $request->status
        ]);
        return redirect()->route('webmunitstatus');
    }

    public function all(Request $request){
        if($request->status == 'Data Valid'){
            DB::table('unit')->update([
                'status' => 'Data Valid'
            ]);
        }elseif($request->status == 'Data Tidak Valid'){
            DB::table('unit')->update([
                'status' => 'Data Tidak Valid'
            ]);
        }
    return redirect()->route('webmunitstatus');
    }
}
