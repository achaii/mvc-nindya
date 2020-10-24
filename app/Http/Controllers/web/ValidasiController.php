<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ValidasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){

        $no = 1;
        $noo = 1;
        if($request->has('_token')){
            if($request->unit == 'semua' or Session::get('units') == 'semua'){
                Session::put('bulan',$request->bulan);
                Session::put('tahun',$request->tahun);
                Session::put('units',$request->unit);
                $select = DB::table('perkara')
                ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                ->get();
            }else{
                Session::put('bulan',$request->bulan);
                Session::put('tahun',$request->tahun);
                Session::put('units',$request->unit);
                $select = DB::table('perkara')
                ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                ->where('id_unit',$request->unit)
                ->get();
            }
        }else{
            if(Session::get('units') == 'semua'  or Session::get('units') == null){
                Session::put('bulan',Carbon\Carbon::now()->format('m'));
                Session::put('tahun',Carbon\Carbon::now()->format('Y'));
                Session::put('units',$request->unit);
                $select = DB::table('perkara')
                ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                ->get();
            // }elseif(Session::get('bulan') == null or Session::get('tahun') == null or Session::get('units') == null){
            //     Session::put('bulan',Carbon\Carbon::now()->format('m'));
            //     Session::put('tahun',Carbon\Carbon::now()->format('Y'));
            //     Session::put('units','7');
            //     $select = DB::table('perkara')
            //             ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
            //     ->where('id_unit','7')
            //     ->get(); 
            }else{
                $select = DB::table('perkara')
                ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                ->where('id_unit',Session::get('units'))
                ->get(); 
            }
        }
        $atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();
        $unit = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();

        return view('web.validasi',[
            'select' => $select,
            'atahun' => $atahun,
            'unit' => $unit,
            'no' => $no,
            'noo' => $noo
        ]);
    }

    public function keterangan(Request $request){
        DB::table('perkara')
        ->where('id',$request->id)
        ->update([
            'keterangan' => $request->keterangan
        ]);
        Session::put('tablevalidasi',$request->id);
        return redirect()->route('webvalidasi')->withErrors(['tabs' => 'gagal']);
    }

    public function destroy($id){
        DB::table('perkara')->where('id',$id)->delete();
        return redirect()->route('webvalidasi');
    }

    public function validasi($id, Request $request){
        DB::table('perkara')->where('id',$id)->update([
            'status' => $request->validasi,
            'keterangan' => $request->keterangan
        ]);
        Session::put('tablevalidasi',$id);
        return redirect()->route('webvalidasi')->withErrors(['tabs' => 'gagal']);
    }
}
