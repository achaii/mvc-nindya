<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon;
use Illuminate\Support\Facades\Session;

class SelraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $abulan = Carbon\carbon::now()->format('m');
        $atahun = Carbon\carbon::now()->format('Y');

        if($request->has('_token')){
            $bulan = $request->bulan;
            $tahun = $request->tahun;

            $select = DB::table('selra')
            ->join('unit','selra.id_unit','=','unit.id')
            ->select('selra.*','unit.nomorurut')
            ->where('selra.bulan',$bulan)
            ->where('selra.tahun',$tahun)
            ->orderBy('unit.nomorurut','asc')
            ->get();

            Session::put('bulan',$bulan);
            Session::put('tahun',$tahun);
           // dd($select);
            
        }else{
            if(!Session::get('state')){
                Session::put('state','');
            }
            
            if(Session::get('bulan') == '' and Session::get('tahun') == ''){
                $bulan = Session::put('bulan',$abulan);
                $tahun = Session::put('tahun',$atahun);
            }else{
                $bulan = Session::get('bulan');
                $tahun = Session::get('tahun');
            }

            $select = DB::table('selra')
            ->join('unit','selra.id_unit','=','unit.id')
            ->select('selra.*','unit.nomorurut')
            ->where('selra.bulan',$bulan)
            ->where('selra.tahun',$tahun)
            ->orderBy('unit.nomorurut','asc')
            ->get();
           // dd($select);
        }

        $list_tahun = DB::table('tahun_set')
        ->select('tahun')
        ->GroupBy('tahun')
        ->OrderBy('tahun','desc')
        ->get();

        $no = 1;
        $noo = 1;
        $nomor = 1;
        
        return view('web.selra',[
            'tahun' => $tahun,
            'bulan' => $bulan,
            'select' => $select,
            'list_tahun' => $list_tahun,
            'no' => $no,
            'noo' => $noo,
            'nomor' => $nomor,
        ]);
    }

    public function tahun(Request $request){
        $create = Carbon\Carbon::createFromDate($request->tahun,1,0);
       // dd($create);
        for($i=0;$i<356;$i++){
            DB::table('tahun_set')->insert([
                'tahun' => substr($request->tahun,0,4),
                'tanggal' => $create->addDay(1)->format('d-m-Y'),
                'hari' => $create->format('l')
            ]);
        }
        return redirect()->route('webselra');
    }

    public function generate(Request $request){
        $select = DB::table('unit')
        ->orderBy('nomorurut','asc')
        ->get();

        $check = DB::table('selra')
                ->select('bulan','tahun')
                ->where('bulan',$request->abulan)
                ->where('tahun',$request->atahun)
                ->GroupBy('tahun','bulan')
                ->count();
        if($check > 0){
            return redirect()->route('webselra')->withErrors(['alert' => 'gagal']);
        }else{
            foreach($select as $s){
                DB::table('selra')->insert([
                    'id_unit' => $s->id,
                    'polres' => $s->nama_unit,
                    'bulan' => $request->abulan,
                    'tahun' => $request->atahun
                ]);
            } 
        }

        return redirect()->route('webselra')->withErrors(['alert1' => 'Save']);
    }

    public function update(Request $request){
        if($request->jmlselra == null){
            $total = (int)$request->p21 + (int)$request->sp3 + (int)$request->adr + (int)$request->bas + (int)$request->diversi + (int)$request->limpah + (int)$request->rj + (int)$request->sp2lidik;
            DB::table('selra')
            ->where('id',$request->id)
            ->update([
                // 'p21' => $request->p21,
                // 'sp3' => $request->sp3,
                // 'adr' => $request->adr,
                // 'bas' => $request->bas,
                // 'diversi' => $request->diversi,
                // 'limpah' => $request->limpah,
                // 'rj' => $request->rj,
                // 'sp2lidik' => $request->sp2lidik,
                'jmlselra' => $total,
                'keterangan' => $request->keterangan,
            ]);
        }else{
            DB::table('selra')
            ->where('id',$request->id)
            ->update([
                // 'p21' => $request->p21,
                // 'sp3' => $request->sp3,
                // 'adr' => $request->adr,
                // 'bas' => $request->bas,
                // 'diversi' => $request->diversi,
                // 'limpah' => $request->limpah,
                // 'rj' => $request->rj,
                // 'sp2lidik' => $request->sp2lidik,
                'jmlselra' => $request->jmlselra,
                'keterangan' => $request->keterangan,
            ]);
        }

        Session::put('state',$request->id);
        return redirect()->route('webselra')->withErrors(['table' => 'table']);
    }

    public function destroy($tahun){
        DB::table('tahun_set')->where('tahun',$tahun)->delete();
        return redirect()->route('webselra');
    }
}
