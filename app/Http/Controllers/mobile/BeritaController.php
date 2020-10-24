<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function index(){
        $bulan = Carbon\Carbon::now()->format('m');
        $tahun = Carbon\Carbon::now()->format('y');
        $select = DB::table('berita')->where('status','Publish')->orderBy('tanggal_publish','desc')->paginate(6);
        return view('mobile.berita',[
            'select' => $select,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);
    }

    public function show($id){
        $select = DB::table('berita')->where('id',$id)->first();
        $new = DB::table('berita')->where('status','Publish')->orderBy('tanggal_publish','asc')->limit(2)->get();
        $tanggal = Carbon\Carbon::parse($select->tanggal_publish)->format('d, M Y');
        return view('mobile.berita-detail',[
            'select' => $select,
            'tanggal' => $tanggal,
            'new' => $new,
        ]);
    }
}
