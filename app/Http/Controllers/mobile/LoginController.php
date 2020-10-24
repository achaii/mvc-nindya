<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class LoginController extends Controller
{
    public function index(Request $request){
        $bulan = Carbon\Carbon::now()->format('m');
        $tahun = Carbon\Carbon::now()->format('Y');
        if(!Session::get('akses')){
            if($request->has('_token')){
                $email = strtoupper($request->email).'@selralaka.com';
                $select = DB::table('users')->where('email',$email)->first();
                if($select){
                    if(hash::check(strtoupper($request->password),$select->password)){
                        Session::put('id',$select->id);
                        Session::put('name',$select->name);
                        Session::put('nama',$select->nama);
                        Session::put('email',$select->email);
                        Session::put('password_hit',$select->password_hit);
                        Session::put('status',$select->status);
                        Session::put('keterangan',$select->keterangan);
                        Session::put('id_unit',$select->id_unit);
                        Session::put('gambar',$select->gambar);
                        Session::put('akses',TRUE);
                        return redirect()->route('mobiledashboard',[$tahun,$bulan]);
                    }else{
                        return redirect()->route('mobilelogin')->withErrors(['alert2' => 'password']);
                    }
                }else{
                    return redirect()->route('mobilelogin')->withErrors(['alert1' => $email]);
                }
            }else{
                return view('mobile.login');
            }
        }else{
            return redirect()->route('mobiledashboard',[$tahun,$bulan]);
        }
    }

    public function logout(){
        Session::flush();
        return redirect()->route('mobilelogin');
    }

    public function page_laporan(){
        $bulan = Carbon\Carbon::now()->format('m');
        $tahun = Carbon\Carbon::now()->format('Y');
        return view('mobile.page-laporan',[
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
    }

    public function laporan_detail($kategori,$unit,$tahun,$bulan){
        $units = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();
        $select = DB::table('perkara')
        ->where('kategori',$kategori)
        ->where('id_unit',$unit)
        ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
        ->orderBy('tanggal_kejadian','asc')
        //->where('bulan',$bulan)
        ->get();

        $atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();

        return view('mobile.laporan-detail',[
            'kategori' => $kategori,
            'bulan' => $bulan,
            'select' => $select,
            'tahun' => $tahun,
            'atahun' => $atahun,
            'unit' => $unit,
            'units' => $units,
        ]);
    }

    public function laporan_detail_view($kategori,$unit,$tahun,$bulan,$id){
        $units = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();

        $select = DB::table('perkara')
        ->where('id',$id)
        ->get();

        $atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();

        return view('mobile.laporan-detail-view',[
            'kategori' => $kategori,
            'bulan' => $bulan,
            'select' => $select,
            'tahun' => $tahun,
            'atahun' => $atahun,
            'unit' => $unit,
            'units' => $units,
            'id' => $id,
        ]);
    }

    public function edit_lp($kategori,$unit,$tahun,$bulan,$id,Request $request){
        DB::table('perkara')
        ->where('id',$id)
        ->update([
            'bulan' => $request->bulan,                    
            'nomor_lp' => strtoupper($request->nomor_lp),                    
            'noirsms' => strtoupper($request->noirsms),                    
            'tanggal_kejadian' => substr($request->tgl1,6,4).substr($request->tgl1,3,2).substr($request->tgl1,0,2),                    
            'tglirsms' => substr($request->tglirsms,6,4).substr($request->tglirsms,3,2).substr($request->tglirsms,0,2),                    
            'kategori' => $request->penyelesaianperkara,               
            'tanggal_penyelesaian' => substr($request->tgl2,6,4).substr($request->tgl2,3,2).substr($request->tgl2,0,2),   
            'status' => 'Data Valid'            
        ]);

        //laporan
        
        $laporan1 = DB::table('gambar')->where('nama_gambar',$request->laporan1)->first();
        if($laporan1->nama_gambar == $request->laporan1 and $request->laporan == null){
            DB::table('gambar')
            ->where('id',$laporan1->id)
            ->update([
                'nama_gambar' => $request->laporan1
            ]);
        }elseif($request->laporan == null){
            DB::table('gambar')
            ->where('id',$laporan1->id)
            ->update([
                'nama_gambar' => $request->laporan1
            ]);
        }else{
            $filelaporan = $request->file('laporan');
            $ext = $filelaporan->getClientOriginalExtension();
            $namafile = strtoupper($request->nomor_lp).'-'.'LAPORAN'.'-'.rand(100000,1001238912).'.'.$ext;
            $path = public_path(substr($laporan1->gambar,53,200));
            $filelaporan->move($path,$namafile);
            File::delete(public_path(substr($laporan1->gambar,53,200).'/'.$laporan1->nama_gambar));

            DB::table('gambar')
            ->where('id',$laporan1->id)
            ->update([
                'nama_gambar' => $namafile
            ]);
        }

        //serla
        $selra1 = DB::table('gambar')->where('nama_gambar',$request->selra1)->first();
        if($selra1->nama_gambar == $request->selra1 and $request->selra == null){
            DB::table('gambar')
            ->where('id',$selra1->id)
            ->update([
                'nama_gambar' => $request->selra1
            ]);
        }elseif($request->selra == null){
            DB::table('gambar')
            ->where('id',$selra1->id)
            ->update([
                'nama_gambar' => $request->selra1
            ]);
        }else{
            $fileselra = $request->file('selra');
            $ext = $fileselra->getClientOriginalExtension();
            $namafile = strtoupper($request->nomor_lp).'-'.'SELRA'.'-'.rand(100000,1001238912).'.'.$ext;
            $path = public_path(substr($selra1->gambar,53,200));
            $filelaporan->move($path,$namafile);
            File::delete(public_path(substr($selra1->gambar,53,200).'/'.$selra1->nama_gambar));

            DB::table('gambar')
            ->where('id',$selra1->id)
            ->update([
                'nama_gambar' => $namafile
            ]);
        }

        //resume
        if(Session::get('status') == 'superuser'){
            $resume1 = DB::table('gambar')->where('nama_gambar',$request->resume1)->first();
            if($resume1->nama_gambar == $request->resume1 and $request->resume == null){
                DB::table('gambar')
                ->where('id',$resume1->id)
                ->update([
                    'nama_gambar' => $request->resume1
                ]);
            }elseif($request->resume == null){
                DB::table('gambar')
                ->where('id',$resume1->id)
                ->update([
                    'nama_gambar' => $request->resume1
                ]);
            }else{
                $fileresume = $request->file('resume');
                $ext = $fileresume->getClientOriginalExtension();
                $namafile = strtoupper($request->nomor_lp).'-'.'RESUME'.'-'.rand(100000,1001238912).'.'.$ext;
                $path = public_path(substr($resume1->gambar,53,200));
                $filelaporan->move($path,$namafile);
                File::delete(public_path(substr($resume1->gambar,53,200).'/'.$resume1->nama_gambar));
    
                DB::table('gambar')
                ->where('id',$resume1->id)
                ->update([
                    'nama_gambar' => $namafile
                ]);
            }
        }

        return redirect('mobile-view/laporan-detail-view/'.$kategori.'/'.$unit.'/'.$tahun.'/'.$bulan.'/'.$id);
    }

    public function laporan_bulan($tahun,$bulan){
        $units = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();
        $select = DB::table('perkara')
        //->where('kategori',$kategori)
       // ->where('id_unit',$unit)
        ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
        ->orderBy('tanggal_kejadian','asc')
        ->get();

        Session::put('tahun', $tahun);
        Session::put('bulan', $bulan);

        $atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();
        
        return view('mobile.page-laporan-bulan',[
            'bulan' => $bulan,
            'select' => $select,
            'tahun' => $tahun,
            'atahun' => $atahun,
           // 'unit' => $unit,
            'units' => $units,
        ]);
    }

    public function laporan_delete($id){
        $select = DB::table('perkara')->where('id',$id)->first();
        $selectdel = DB::table('gambar')->where('id_gambar',$select->id_gambar)->first();
        $respon = File::deleteDirectory(public_path(substr($selectdel->gambar,53,200)));
        //d(public_path(substr($selectdel->gambar,53,200)));
        //dd($respon);
        DB::table('gambar')->where('id_gambar',$select->id_gambar)->delete();
        DB::table('perkara')->where('id',$id)->delete();
        return redirect()->route('mobilepagelaporan');
    }

    public function laporan_tahun($unit,$tahun){
        //$tahun = Carbon\Carbon::now()->format('Y');
        $bulans = array('01','02','03','04','05','06','07','08','09','10','11','12');
        $totall = array();
        foreach($bulans as $bu){
        
        $nilai = DB::table('perkara')
        ->where('id_unit',$unit)
        ->where('status','Data Valid')
        ->where('tanggal_kejadian','LIKE',$tahun.$bu.'%')
        //->where('tanggal_kejadian','LIKE','%-12-2020')
        ->count();

        $jml = DB::table('selra')
                    ->where('id_unit',$unit)
                    ->where('bulan',$bu)
                    ->where('tahun',$tahun)
                    ->first();
        //dd($jml);

        if($jml == null){
            $jam = 0;
        }else{
            $jam = $jml->jmlselra;
        }

        $totall[] .= ($nilai!=0 and $jam!=0) ? round(($nilai / $jam) * 100,2) :0;
        }

        $jahanam = implode(',',$totall);
        $atahun = DB::table('tahun_set')->SELECT('tahun')->GroupBy('tahun')->get();
        $units = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();

    return view('mobile.page-laporan-tahun',[
        'jahanam' => $jahanam,
        'tahun' => $tahun,
        'atahun' => $atahun,
        'units' => $units,
        'unit' => $unit,
    ]);
    }

    public function laporan_statistik($tahun,$bulan){
        $unit = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();
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
        return view('mobile.page-laporan-statistik',[
            'bulan' => $bulan,
            'total' => $total,
            'atahun' => $atahun,
            'jmlperkara' => $jmlperkaras,
            'jmlselra' => $jmlselras,
            'tahun' => $tahun,
            'units' => $units,
            'unit' => $unit,
            'nilais' => $nilais,
        ]);
    }
}
