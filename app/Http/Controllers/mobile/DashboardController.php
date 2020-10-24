<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index($tahun,$bulan){
        $berita = DB::table('berita')->limit(6)->get();
        $unit = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();

        if(Session::get('status') == 'Kasubdit' or Session::get('status') == 'Administrator'){
            $p21 = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','P21')
            ->where('status','Data Valid')
            ->count();

            $perkara = DB::table('perkara')
            ->join('unit','perkara.id_unit','=','unit.id')
            ->select('perkara.*','unit.nama_unit')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->orderBy('perkara.tanggal_kejadian','desc')
            ->get();

            $valid = DB::table('perkara')
            ->where('status','Data Valid')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->count();

            $tidakvalid = DB::table('perkara')
            ->where('status','Data Tidak Valid')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->count();

            $sp3 = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','SP3')
            ->where('status','Data Valid')
            ->count();

            $rj = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','RJ')
            ->where('status','Data Valid')
            ->count();

            $adr = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','ADR')
            ->where('status','Data Valid')
            ->count();

            $diversi = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','DIVERSI')
            ->where('status','Data Valid')
            ->count();

            $limpah = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','LIMPAH')
            ->where('status','Data Valid')
            ->count();

            $sp2lidik = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','SP2 LIDIK')
            ->where('status','Data Valid')
            ->count();

            $bas = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','BAS')
            ->where('status','Data Valid')
            ->count();

            $jmlperkara = DB::table('perkara')
            ->select(DB::raw('count(*) as jmlperkara'))
            ->where('status', 'Data Valid')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->first();

            $jmlperkaras = $jmlperkara->jmlperkara;

            $jmlselra = DB::table('selra')
            ->select(DB::raw('SUM(jmlselra) as jmlselra'))
            ->where('bulan',$bulan)
            ->where('tahun',$tahun)
            ->first();

            $jmlselras = $jmlselra->jmlselra;

            if($jmlselra == null){
                $jamm = 0;
            }else{
                $jamm = $jmlselra->jmlselra;
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
                ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                ->first();

                $jmlselra = DB::table('selra')
                ->select(DB::raw('SUM(jmlselra) as jmlselra'))
                ->where('id_unit',$us->id)
                ->where('bulan',$bulan)
                ->where('tahun',$tahun)
                ->first();

                if($jmlselra == null){
                    $ram = 0;
                }else{
                    $ram = $jmlselra->jmlselra;
                }

                $totalsunit[] .= ($tot->jmlperkara!=0 and $ram!=0) ? round(($tot->jmlperkara / $ram) * 100,2) :0;
            }

            $nilais = implode(',',$totalsunit);

            return view('mobile.dashboard',[
                'berita' => $berita,
                'valid' => $valid,
                'tidakvalid' => $tidakvalid,
                'bulan' => $bulan,
                'total' => $total,
                'p21' => $p21,
                'sp3' => $sp3,
                'bas' => $bas,
                'rj' => $rj,
                'adr' => $adr,
                'diversi' => $diversi,
                'limpah' => $limpah,
                'sp2lidik' => $sp2lidik,
                'atahun' => $atahun,
                'jmlperkara' => $jmlperkaras,
                'jmlselra' => $jmlselras,
                'perkara' => $perkara,
                'tahun' => $tahun,
                'units' => $units,
                'unit' => $unit,
                'nilais' => $nilais,
            ]);
        }elseif(Session::get('status') == 'Kasat' or Session::get('status') == 'Anggota'){
            $datatidakvalid = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('status', 'Data Tidak Valid')
            //->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->orderBy('tanggal_kejadian','desc')
            ->get();


            $jmlperkara = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('status', 'Data Valid')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->count();

            $perkara = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->orderBy('tanggal_kejadian','desc')
            ->get();

            $jmlselra = DB::table('selra')
            ->where('id_unit',Session::get('id_unit'))
            ->where('bulan',$bulan)
            ->where('tahun',$tahun)
            ->first();

            if($jmlselra == null){
                $jamm = 0;
            }else{
                $jamm = $jmlselra->jmlselra;
            }
            $total = ($jmlperkara!=0 and $jamm!=0) ? round(($jmlperkara / $jamm) * 100,2) :0;

            //jumlah
            $p21 = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','P21')
            ->where('status','Data Valid')
            ->count();

            $sp3 = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','SP3')
            ->where('status','Data Valid')
            ->count();

            $rj = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','RJ')
            ->where('status','Data Valid')
            ->count();

            $adr = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','ADR')
            ->where('status','Data Valid')
            ->count();

            $diversi = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','DIVERSI')
            ->where('status','Data Valid')
            ->count();

            $bas = DB::table('perkara')
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','BAS')
            ->where('status','Data Valid')
            ->count();

            $limpah = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','LIMPAH')
            ->where('status','Data Valid')
            ->count();

            $sp2lidik = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
            ->where('kategori','SP2 LIDIK')
            ->where('status','Data Valid')
            ->count();


            $bulans = array('01','02','03','04','05','06','07','08','09','10','11','12');
            $totall = array();

            foreach($bulans as $bu){
    
            $nilai = DB::table('perkara')
            ->where('id_unit',Session::get('id_unit'))
            ->where('status','Data Valid')
            ->where('tanggal_kejadian','LIKE',$tahun.$bu.'%')
            //->where('tanggal_kejadian','LIKE','%-12-2020')
            ->count();

            $jml = DB::table('selra')
            ->where('id_unit',Session::get('id_unit'))
            ->where('bulan',$bu)
            ->where('tahun',$tahun)
            ->first();

            if($jml == null){
                $jam = 0;
            }else{
                $jam = $jml->jmlselra;
            }

            $totall[] .= ($nilai!=0 and $jam!=0) ? round(($nilai / $jam) * 100,2) :0;
            }

            $jahanam = implode(',',$totall);
            //$atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();

            return view('mobile.dashboard',[
                'berita' => $berita,
                'bulan' => $bulan,
                'total' => $total,
                'p21' => $p21,
                'sp3' => $sp3,
                'rj' => $rj,
                'bas' => $bas,
                'adr' => $adr,
                'diversi' => $diversi,
                'limpah' => $limpah,
                'sp2lidik' => $sp2lidik,
                'perkara' => $perkara,
                'jahanam' => $jahanam,
                'jmlperkara' => $jmlperkara,
                'jmlselra' => $jamm,
                'tahun' => $tahun,
                //'atahun' => $atahun,
                'unit' => $unit,
                'datatidakvalid' => $datatidakvalid
            ]);
        }
    }

    public function profil(){
        $select = DB::table('users')
        //->join('unit','users.id_unit','=','unit.id')
        //->select('users.*','unit.nama_unit')
        ->where('users.id',Session::get('id'))
        ->get();

        return view('mobile.profil',[
            'select' => $select
        ]);
    }

    public function edit_profil(Request $request){
        $file = $request->file('gambar');
        $gambar = DB::table('users')->where('id',$request->id)->first();
        if($request->gambar == $gambar->gambar and $request->gambar == null){
            DB::table('users')
            ->where('id',$request->id)
            ->update([
                'nama' => $request->nama,
                'password_hit' => $request->password,
                'password' => bcrypt($request->password),
            ]);  
        }elseif($request->gambar == null){
            DB::table('users')
            ->where('id',$request->id)
            ->update([
                'nama' => $request->nama,
                'password_hit' => $request->password,
                'password' => bcrypt($request->password),
                'gambar' => 'ava.png',
            ]);

            Session::put('gambar','ava.png');
            Session::put('nama',$request->nama);
        }else{
            $b = $file->getClientOriginalExtension();
            $namafile = rand(100000,1001238912).'.'.$b;
            $path = public_path().'/asset/img-profil';
            $file->move($path,$namafile);

            DB::table('users')
            ->where('id',$request->id)
            ->update([
                'nama' => $request->nama,
                'password_hit' => $request->password,
                'password' => bcrypt($request->password),
                'gambar' => $namafile,
            ]);
            Session::put('gambar',$namafile);
            Session::put('nama',$request->nama);
        }
        return redirect()->route('mobileprofil');
    }
}
