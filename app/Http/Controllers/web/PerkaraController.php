<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class PerkaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
       return view('web.perkara'); 
    }

    public function laporan_bulan(Request $request){
        $atahun = DB::table('tahun_set')->select('tahun')->GroupBy('tahun')->get();
        $select = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();
        $no = 1;
        $noo = 1;
            if($request->has('_token')){
                Session::put('bulan',$request->bulan);
                Session::put('tahun',$request->tahun);
            }else{

                Session::put('bulan',Carbon\Carbon::now()->format('m'));
                Session::put('tahun',Carbon\Carbon::now()->format('Y'));
            }
        return view('web.laporan-bulan',[
            'select' => $select,
            'atahun' => $atahun,
            'no' => $no,
            'noo' => $noo,
        ]);
    }

    public function laporan_keterangan(Request $request){
        DB::table('selra')
        ->where('id_unit',$request->id)
        ->where('bulan',$request->bulan)
        ->where('tahun',$request->tahun)
        ->update([
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('weblaporanbulanselra');
    }

    public function laporan_bulan_tanggal(Request $request){
        $atahun = DB::table('tahun_set')->select('tahun')->GroupBy('tahun')->get();
        $select = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();

        if($request->has('_token')){
            Session::put('bulan',$request->bulan);
            Session::put('tahun',$request->tahun);
        }else{
            Session::put('bulan',Carbon\Carbon::now()->format('m'));
            Session::put('tahun',Carbon\Carbon::now()->format('Y'));
        }

        $tahun = DB::table('tahun_set')
        ->where('tanggal','LIKE','%-'.Session::get('bulan').'-'.Session::get('tahun'))
        ->orderBy('tanggal','asc')
        ->get();

        $no = 1;
        $noo = 1;
        return view('web.laporan-bulan-tanggal',[
            'tahun' => $tahun,
            'atahun' => $atahun,
            'select' => $select,
            'no' => $no,
            'noo' => $noo,
        ]);
    }

    public function laporan_keterangan_tanggal(Request $request){
        DB::table('selra')
        ->where('id_unit',$request->id)
        ->where('bulan',$request->bulan)
        ->where('tahun',$request->tahun)
        ->update([
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('weblaporanbulantanggal');
    }

    public function laporan_bulan_selra(Request $request){
        $atahun = DB::table('tahun_set')->select('tahun')->GroupBy('tahun')->get();
        $select = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();

        if($request->has('_token')){
            Session::put('bulan',$request->bulan);
            Session::put('tahun',$request->tahun);
            Session::put('selra',$request->selra);
        }else{
            Session::put('bulan',Carbon\Carbon::now()->format('m'));
            Session::put('tahun',Carbon\Carbon::now()->format('Y'));
            Session::put('selra','P21');
        }

        $tahun = DB::table('tahun_set')
        ->where('tanggal','LIKE','%-'.Session::get('bulan').'-'.Session::get('tahun'))
        ->orderBy('tanggal','asc')
        ->get();

        $no = 1;
        $noo = 1;
        return view('web.laporan-bulan-selra',[
            'tahun' => $tahun,
            'atahun' => $atahun,
            'select' => $select,
            'no' => $no,
            'noo' => $noo,
        ]);
    }

    public function laporan_tahunan(Request $request){
        $atahun = DB::table('tahun_set')->select('tahun')->GroupBy('tahun')->get();
        $select = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();
        $no = 1;
        $noo = 1;
            if($request->has('_token')){
                Session::put('tahun',$request->tahun);
            }else{
                Session::put('tahun',Carbon\Carbon::now()->format('Y'));
            }
        return view('web.laporan-tahun',[
            'select' => $select,
            'atahun' => $atahun,
            'no' => $no,
            'noo' => $noo
        ]);
    }
    
    public function laporan_periodik_bulan(Request $request){
        $atahun = DB::table('tahun_set')->select('tahun')->GroupBy('tahun')->get();
        $select = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();
        $no = 1;
        $noo = 1;
            if($request->has('_token')){
                Session::put('tahun',$request->tahun);
                Session::put('abulan',$request->abulan);
                Session::put('bbulan',$request->bbulan);
            }else{
                if(Session::get('tahun') == '' and Session::get('abulan') == '' and Session::get('bbulan') == ''){
                    Session::put('tahun',Carbon\Carbon::now()->format('Y'));
                    Session::put('abulan',Carbon\Carbon::now()->addMonths(-1)->format('m'));
                    Session::put('bbulan',Carbon\Carbon::now()->format('m'));
                }

            }
        return view('web.laporan-periodik-bulan',[
            'select' => $select,
            'atahun' => $atahun,
            'no' => $no,
            'noo' => $noo
        ]); 
    }

    public function update_periodik(Request $request, $id){
        DB::table('perkara')
        ->where('id',$id)
        ->update([
            'status' => $request->validasi,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('weblaporanperiodebulan');
    }

    // public function migrasi(){
    //     $res = DB::table('aa')->get();
    //     foreach($res as $r){
    //         $tgl_kejadian = substr($r->tanggal_kejadian,6,4).substr($r->tanggal_kejadian,3,2).substr($r->tanggal_kejadian,0,2);
    //         $tgl_peny = substr($r->tanggal_penyelesaian,6,4).substr($r->tanggal_penyelesaian,3,2).substr($r->tanggal_penyelesaian,0,2);
    //         $tgl_u = substr($r->tanggal_upload,6,4).substr($r->tanggal_upload,3,2).substr($r->tanggal_upload,0,2);
    //         $tgl_i = substr($r->tglirsms,6,4).substr($r->tglirsms,3,2).substr($r->tglirsms,0,2);
    //         DB::table('perkara')->insert([
    //             'kategori' => $r->kategori,
    //             'tanggal_kejadian' => $tgl_kejadian,
    //             'tanggal_penyelesaian' => $tgl_peny,
    //             'id_gambar' => $r->id_gambar,
    //             'path' => $r->path,
    //             'tanggal_upload' => $tgl_u,
    //             'nomor_lp' => $r->nomor_lp,
    //             'id_unit' => $r->id_unit,
    //             'id_user' => $r->id_user,
    //             'status' => $r->status,
    //             'bulan' => $r->bulan,
    //             'keterangan' => $r->keterangan,
    //             'noirsms' => $r->noirsms,
    //             'tglirsms' => $tgl_i,
    //         ]);  
    //     }
    //     return 'sukses';
    // }
}
