<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $no = 1;
        $select = DB::table('berita')->orderBy('tanggal_publish','desc')->get();
        return view('web.berita',[
            'select' => $select,
            'no' => $no
        ]);
    }

    public function store(Request $request){
        $date = Carbon\Carbon::now()->format('Y-m-d');
        $file = $request->file('gambar');
        if($file == null){
            $namafile = 'berita.jpg';
        }else{
            $b = $file->getClientOriginalExtension();
            $namafile = $date.'-'.rand(100000,1001238912).'.'.$b;
            $path = public_path().'/asset/img-berita';
            $file->move($path,$namafile);
        }

        if($request->status == 'Publish'){
            DB::table('berita')->insert([
                'judul_berita' => $request->judulberita,
                'isi_berita' => $request->isiberita,
                'gambar' => $namafile,
                'tanggal_buat' => $date,
                'tanggal_publish' => $date,
                'status' => 'Publish'
            ]);
        }else{
            DB::table('berita')->insert([
                'judul_berita' => $request->judulberita,
                'isi_berita' => $request->isiberita,
                'gambar' => $namafile,
                'tanggal_buat' => $date,
                'status' => 'Draft'
            ]);
        }
        return redirect()->route('webberita');
    }

    public function edit($id){
        $date = Carbon\Carbon::now()->format('Y-m-d');
        DB::table('berita')->where('id',$id)->update([
            'tanggal_publish' =>  $date,
            'status' => 'Publish'
        ]);
        return redirect()->route('webberita');
    }

    public function update(Request $request,$id){
        $date = Carbon\Carbon::now()->format('Y-m-d');
        $file = $request->file('gambar');
        //dd($file);
        $gambar = DB::table('berita')->where('id',$id)->first();

        if($request->gambars == $gambar->gambar and $request->gambar == null){
            DB::table('berita')
            ->where('id',$id)
            ->update([
                'judul_berita' => $request->judulberita,
                'isi_berita' => $request->isiberita,
                //'gambar' => $namafile,
                'status' => 'Publish'
            ]);
        }elseif($request->gambar == null){
            DB::table('berita')
            ->where('id',$id)
            ->update([
                'judul_berita' => $request->judulberita,
                'isi_berita' => $request->isiberita,
                //'gambar' => $namafile,
                'status' => 'Publish'
            ]);
        }else{
            $b = $file->getClientOriginalExtension();
            $namafile = $date.'-'.rand(100000,1001238912).'.'.$b;
            $path = public_path().'/asset/img-berita';
            $file->move($path,$namafile);

            DB::table('berita')
            ->where('id',$id)
            ->update([
                'judul_berita' => $request->judulberita,
                'isi_berita' => $request->isiberita,
                'gambar' => $namafile,
                'status' => 'Publish'
            ]);
        }


        return redirect()->route('webberita');
    }

    public function destroy($id){
        DB::table('berita')->where('id',$id)->delete();
        return redirect()->route('webberita');
    }
    
}
