<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $no = 1;
        $unit = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();
        $atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();
        if($request->has('_token')){
            Session::put('bulan',$request->bulan);
            Session::put('tahun',$request->tahun);
            Session::put('units',$request->unit);
        }else{
            Session::put('bulan',Carbon\Carbon::now()->format('m'));
            Session::put('tahun',Carbon\Carbon::now()->format('Y'));
            Session::put('units','7');

        }
        //perbulan
        $bulan1 = array('01','02','03','04','05','06','07','08','09','10','11','12');
        $total1 = array();

        foreach($bulan1 as $bu){

        $nilai1 = DB::table('perkara')
        ->where('id_unit',Session::get('units'))
        ->where('status','Data Valid')
        ->where('tanggal_kejadian','LIKE',Session::get('tahun').$bu.'%')
        //->where('tanggal_kejadian','LIKE','%-12-2020')
        ->count();

        $jml1 = DB::table('selra')
        ->where('id_unit',Session::get('units'))
        ->where('bulan',$bu)
        ->where('tahun',Session::get('tahun'))
        ->first();

        if($jml1 == null){
            $jam1 = 0;
        }else{
            $jam1 = $jml1->jmlselra;
        }

        $total1[] .= ($nilai1!=0 and $jam1!=0) ? round(($nilai1 / $jam1) * 100,2) :0;
        }

        $jahanam = implode(',',$total1);


        //lapora polres
        $jmlperkara = DB::table('perkara')
        ->select(DB::raw('count(*) as jmlperkara'))
        ->where('status', 'Data Valid')
        ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
        ->first();

        $jmlperkaras = $jmlperkara->jmlperkara;

        $jmlselra1 = DB::table('selra')
        ->select(DB::raw('SUM(jmlselra) as jmlselra'))
        ->where('bulan',Session::get('bulan'))
        ->where('tahun',Session::get('tahun'))
        ->first();

        $jmlselras = $jmlselra1->jmlselra;

        if($jmlselra1 == null){
            $jamm = 0;
        }else{
            $jamm = $jmlselra1->jmlselra;
        }
        $total = ($jmlperkara->jmlperkara!=0 and $jamm!=0) ? round(($jmlperkara->jmlperkara / $jamm) * 100,2) :0;
        $totalunit = array();

        foreach($unit as $u){
            $find = array('POLRES ','POLRESTABES ','POLRESTA ');
            $totalunit[] .= "'".str_replace($find,'',$u->nama_unit)."'";
        }

        $units = implode(',',$totalunit);
        $atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();

        $totalsunit = array();

        foreach($unit as $us){
            $tot = DB::table('perkara')
            ->select(DB::raw('count(*) as jmlperkara'))
            ->where('id_unit',$us->id)
            ->where('status', 'Data Valid')
            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
            ->first();

            $jmlselra = DB::table('selra')
            ->select(DB::raw('SUM(jmlselra) as jmlselra'))
            ->where('id_unit',$us->id)
            ->where('bulan',Session::get('bulan'))
            ->where('tahun',Session::get('tahun'))
            ->first();

            if($jmlselra == null){
                $ram = 0;
            }else{
                $ram = $jmlselra->jmlselra;
            }

            $totalsunit[] .= ($tot->jmlperkara!=0 and $ram!=0) ? round(($tot->jmlperkara / $ram) * 100,2) :0;
        }

        $nilais = implode(',',$totalsunit);
        return view('web.dashboard',[
            'unit' => $unit,
            'atahun' => $atahun,
            'jahanam' => $jahanam,
            'units' => $units,
            'nilais' => $nilais,
            'no' => $no,
            'jmlperkaras' => $jmlperkaras,
            'jmlselras' => $jmlselras,
        ]);
    }

    public function update_dashboard(Request $request, $id){
        DB::table('perkara')
        ->where('id',$id)
        ->update([
            'status' => $request->validasi,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('webdashboard');
    }
}
