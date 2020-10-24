<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class MselraController extends Controller
{
    public function index(){
        $bulan = Carbon\Carbon::now()->format('m');
        return view('mobile.mselra',[
            'bulan' => $bulan
        ]);
    }

    public function store(Request $request){
        $date_upload = Carbon\Carbon::now()->format('Ymd');
        
        //$id_unit = '7';
        $id_unit = DB::table('unit')->where('id',Session::get('id_unit'))->first();
        //$id_user = '2';
        $id_user = DB::table('users')->where('id',Session::get('id'))->first();;
        //$status = 'Menunggu Validasi';

        $date_tahun = substr($request->tgl1,6,4);
        $date_bulan = substr($request->tgl1,3,2);
        $date_hari = substr($request->tgl1,0,2);
        //dd($date_bulan);
        if($date_bulan == '01'){
            $date_bulan_ = 'JANUARI';
        }elseif($date_bulan == '02'){
            $date_bulan_ = 'FEBRUARI';
        }elseif($date_bulan == '03'){
            $date_bulan_ = 'MARET';
        }elseif($date_bulan == '04'){
            $date_bulan_ = 'APRIL';
        }elseif($date_bulan == '05'){
            $date_bulan_ = 'MEI';
        }elseif($date_bulan == '06'){
            $date_bulan_ = 'JUNI';
        }elseif($date_bulan == '07'){
            $date_bulan_ = 'JULI';
        }elseif($date_bulan == '08'){
            $date_bulan_ = 'AGUSTUS';
        }elseif($date_bulan == '09'){
            $date_bulan_ = 'SEPTEMBER';
        }elseif($date_bulan == '10'){
            $date_bulan_ = 'OKTOBER';
        }elseif($date_bulan == '11'){
            $date_bulan_ = 'NOVEMBER';
        }elseif($date_bulan == '12'){
            $date_bulan_ = 'DESEMBER';
        }

        //dd($date_bulan_);

        $polres_folder = DB::table('unit')->where('id',$id_unit->id)->first();
        //$laporan_count = DB::table('perkara')->where('tanggal_kejadian','30/07/2020')->count();

        $laporan1 = $request->file('laporan');
        if(Session::get('status') == 'Administrator'){
            $laporan2 = $request->file('resume');
        }else{
            $laporan2 = null;
        }
        
        $laporan3 = $request->file('selra');

        if($laporan1 == null or $laporan3 == null){
            return redirect()->route('mobileinput')->withErrors(['alert1' => 'Save']);
        }

        $strip = str_replace('/','-',strtoupper($request->nomor_lp));
        $spasi = str_replace(' ','',$strip);
        
        $files = [];
        $path = public_path().'/LAPORAN/'.$polres_folder->slug.'/'.$date_tahun.'/'.$date_bulan_.'/'.$date_hari.'/NO-'.$spasi;
        $url = URL::to('public/LAPORAN/'.$polres_folder->slug.'/'.$date_tahun.'/'.$date_bulan_.'/'.$date_hari.'/NO-'.$spasi);
        
        if(!File::isDirectory($path)){
            File::makeDirectory($path,0777,true,true);
        }

        $nomorid = rand(100000,1001238912);

        foreach($laporan1 as $file){
            $ext = $file->getClientOriginalExtension();
            $name = 'LAPORAN'.'-'.rand(100000,1001238912).'.'.$ext;
            $file->move($path,$name);
            $files[] = [
                'id_gambar' => $nomorid,
                'gambar' => $url,
                'nama_gambar' => $name,
            ];
        }

        foreach($laporan3 as $file){
            $ext = $file->getClientOriginalExtension();
            $name = 'SELRA'.'-'.rand(100000,1001238912).'.'.$ext;
            $file->move($path,$name);
            $files[] = [
                'id_gambar' => $nomorid,
                'gambar' => $url,
                'nama_gambar' => $name,
            ];
        }

        if(Session::get('status') == 'Administrator'){
            foreach($laporan2 as $file){
                $ext = $file->getClientOriginalExtension();
                $name = 'RESUME'.'-'.rand(100000,1001238912).'.'.$ext;
                $file->move($path,$name);
                $files[] = [
                    'id_gambar' => $nomorid,
                    'gambar' => $url,
                    'nama_gambar' => $name,
                ];
            }
            }

        DB::table('gambar')->insert($files);
        
        DB::table('perkara')->insert([
            'bulan' => $request->bulan,                    
            'nomor_lp' => strtoupper($request->nomor_lp),                    
            'noirsms' => strtoupper($request->noirsms),                    
            'tanggal_kejadian' => substr($request->tgl1,6,4).substr($request->tgl1,3,2).substr($request->tgl1,0,2),                    
            'tglirsms' => substr($request->tglirsms,6,4).substr($request->tglirsms,3,2).substr($request->tglirsms,0,2),                    
            'kategori' => $request->penyelesaianperkara,               
            'tanggal_penyelesaian' => substr($request->tgl2,6,4).substr($request->tgl2,3,2).substr($request->tgl2,0,2),               
            'tanggal_upload' => $date_upload,               
            'id_gambar' => $nomorid,               
            'path' => $path,               
            'id_unit' => $id_unit->id,               
            'id_user' => $id_user->id,                             
            'status' => $id_unit->status,                             
        ]);
        return redirect()->route('mobileinput')->withErrors(['alert' => 'Save']);
    }

    public function noirsms(Request $request){
        $data = DB::table('perkara')
        ->where('noirsms',$request->data)
        ->where('id_unit',Session::get('id_unit'))
        ->first();
        //dd($data);
        if($data == null){
            return ['gagal' => true];
        }else{
            return ['sukses' => true];
        }
    }

    public function nolp(Request $request){
        $data = DB::table('perkara')
        ->where('nomor_lp',$request->data)
        ->where('id_unit',Session::get('id_unit'))
        ->first();
        //dd($data);
        if($data == null){
            return ['gagal' => true];
        }else{
            return ['sukses' => true];
        }
    }
}
