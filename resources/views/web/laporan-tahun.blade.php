@extends('layouts.web')

@section('title')
    <h2 class="az-content-title tx-24 mg-b-5">Laporan Tahunan</h2>
    <p class="mg-b-20 mg-lg-b-25">Managemen Laporan Tahunan</p>
@endsection

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12">
        <div class="card card-dashboard-eighteen">
            <div class="col-sm-6 col-md-3" style="padding-left: 0px;">
                <form action="{{Route('weblaporantahun')}}" method="POST">
                    @csrf
                <div class="row row-sm mg-t-20">             
                    <div class="col-lg">
                        <label>TAHUN <span class="tx-danger">*</span></label>
                        <select class="form-control" id="btahun" name="tahun">   
                            @foreach ($atahun as $t)
                                <option <?php if($t->tahun == Session::get('tahun')){ echo 'selected';} ?> value="{{$t->tahun}}">{{$t->tahun}}</option>  
                            @endforeach                                         
                          </select>
                    </div>
                    <div class="col-lg">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-with-icon btn-block">
                            <i class="typcn typcn-plus"></i> CARI DATA
                        </button>
                    </div>
                
                </div>  
            </br>   
                <label>Form pencarian laporan data selra per-tahun</label>  
            </form>
            </div>
            <table id="managamentunit" class="display responsive table table-hover table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th style="display: none">NO</th>
                        <th style="display: none">POLRES</th>
                        <th style="display: none">P21</th>
                        <th style="display: none">SP3</th>
                        <th style="display: none">ADR</th>
                        <th style="display: none">BAS</th>
                        <th style="display: none">DIVERSI</th>
                        <th style="display: none">LIMPAH</th>
                        <th style="display: none">RJ</th>
                        <th style="display: none">SP2 LIDIK</th>
                        <th style="display: none">JML SERLA</th>
                        <th style="display: none">KJDN IRSMS</th>
                        <th style="display: none">CAPAIAN</th>

                        <th class="wd-5p">NO</th>
                        <th class="wd-20p">POLRES</th>
                        <th class="wd-5p">P21</th>
                        <th class="wd-5p">SP3</th>
                        <th class="wd-5p">ADR</th>
                        <th class="wd-5p">BAS</th>
                        <th class="wd-5p">DIVERSI</th>
                        <th class="wd-5p">LIMPAH</th>
                        <th class="wd-5p">RJ</th>
                        <th class="wd-5p">SP2 LIDIK</th>
                        <th class="wd-5p">JML SERLA</th>
                        <th class="wd-5p">KJDN IRSMS</th>
                        <th class="wd-5p">CAPAIAN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($select as $sel)
                    <tr>
                        <td style="display: none">{{$noo++}}</td>
                        <td style="display: none">{{$sel->nama_unit}}</td>
                        <td style="display: none">
                            <?php 
                                $p21 = DB::table('perkara')
                                ->where('kategori','p21')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($p21 == 0)
                                - 
                            @else
                                {{$p21}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $sp3 = DB::table('perkara')
                                ->where('kategori','sp3')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($sp3 == 0)
                                - 
                            @else
                                {{$sp3}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $adr = DB::table('perkara')
                                ->where('kategori','adr')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($adr == 0)
                                - 
                            @else
                                {{$adr}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $bas = DB::table('perkara')
                                ->where('kategori','bas')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($bas == 0)
                                - 
                            @else
                                {{$bas}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $diversi = DB::table('perkara')
                                ->where('kategori','diversi')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($diversi == 0)
                                - 
                            @else
                                {{$diversi}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $limpah = DB::table('perkara')
                                ->where('kategori','limpah')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($limpah == 0)
                                - 
                            @else
                                {{$limpah}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $rj = DB::table('perkara')
                                ->where('kategori','rj')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($rj == 0)
                                - 
                            @else
                                {{$rj}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $sp2lidik = DB::table('perkara')
                                ->where('kategori','sp2 lidik')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();
                            ?>
                            @if ($sp2lidik == 0)
                                - 
                            @else
                                {{$sp2lidik}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php 
                                $total = $p21 + $sp3 + $adr + $bas + $rj + $diversi + $sp2lidik + $limpah;
                                if($total == 0){
                                    echo '-';
                                }else{
                                    echo $total; 
                                }   
                            ?>
                        </td>
                        <td style="display: none">
                            <?php 
                                $kejadian = DB::table('selra')
                                ->select(DB::raw('SUM(jmlselra) as total'))
                                ->where('id_unit',$sel->id)
                                ->where('tahun',Session::get('tahun'))
                                ->first();
                                //dd($kejadian->jmlselra);
                            ?>
                            @if ($kejadian == null or $kejadian == '0')
                                - 
                            @else
                                {{$kejadian->total}}
                            @endif
                        </td>
                        <td style="display: none">
                            <?php
                                if($kejadian == null){
                                    $jamm = 0;
                                }else{
                                    $jamm = $kejadian->total;
                                }
                                $persentase = ($total!=0 and $jamm!=0) ? round(($total / $jamm) * 100,2) :0;
                                echo $persentase.'%';
                            ?>
                        </td>


                        <td>{{$no++}}</td>
                        <td>{{$sel->nama_unit}}</td>
                        <td>
                            <?php 
                                $p21 = DB::table('perkara')
                                ->where('kategori','p21')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                

                                $p21data = DB::table('perkara')
                                ->where('kategori','p21')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();

                            ?>
                            @if ($p21 == 0)
                                - 
                            @else
                                <a href="#datap21{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#datap21{{$sel->id}}">{{$p21}}</a>
                                <div id="datap21{{$sel->id}}" class="modal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">DATA P21</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <table id="data21table{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="wd-5p">IRSMS & LP</th>
                                                                    <th class="wd-5p">Dokumen Pendukung</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($p21data as $p21da)
                                                                <tr>
                                                                    <td>
                                                                        No. IRSMS</br>
                                                                        {{$p21da->noirsms}}</br>
                                                                        Tgl IRSMS</br>
                                                                        {{$p21da->tglirsms}}</br>
                                                                        No. LP</br>
                                                                        {{$p21da->nomor_lp}}</br>
                                                                        Tgl Kejadian</br>
                                                                        {{$p21da->tanggal_kejadian}}</br>
                                                                        Tgl Penyelesaian</br>
                                                                        {{$p21da->tanggal_penyelesaian}}</br>
                                                                    </td>
                                                                    <td>
                                                                    <?php 
                                                                        $laporan = DB::table('gambar')
                                                                        ->where('id_gambar',$p21da->id_gambar)
                                                                        ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                        ->get();
                                                                        $nolaporan = 1;
                                                                        echo 'Bukti Laporan Polisi </br>';
                                                                        if($laporan == null){
                                                                            echo 'Tidak Ada Dokumen';
                                                                        }else{
                                                                            foreach($laporan as $l){
                                                                                echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                            }
                                                                        }
                                        
                                                                        $resume = DB::table('gambar')
                                                                        ->where('id_gambar',$p21da->id_gambar)
                                                                        ->where('nama_gambar','LIKE','%RESUME%')
                                                                        ->get();
                                                                        echo 'Bukti Resume </br>';
                                                                        $noresume = 1;
                                                                        if($resume == null){
                                                                            echo 'Tidak Ada Dokumen';
                                                                        }else{
                                                                            foreach($resume as $l){
                                                                                echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                            } 
                                                                        }
                                        
                                                                        $selra = DB::table('gambar')
                                                                        ->where('id_gambar',$p21da->id_gambar)
                                                                        ->where('nama_gambar','LIKE','%SELRA%')
                                                                        ->get();
                                                                        echo 'Bukti Selra </br>';
                                                                        $noselra = 1;
                                                                        if($selra == null){
                                                                            echo 'Tidak Ada Dokumen';
                                                                        }else{
                                                                            foreach($selra as $l){
                                                                                echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $sp3 = DB::table('perkara')
                                ->where('kategori','sp3')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                $sp3data = DB::table('perkara')
                                ->where('kategori','sp3')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();
                            ?>
                            @if ($sp3 == 0)
                                - 
                            @else
                            <a href="#datasp3{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#datasp3{{$sel->id}}">{{$sp3}}</a>
                            <div id="datasp3{{$sel->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">DATA SP3</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-sm">
                                                <div class="col-lg">
                                                    <table id="datasp3table{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p">IRSMS & LP</th>
                                                                <th class="wd-5p">Dokumen Pendukung</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($sp3data as $sp3da)
                                                            <tr>
                                                                <td>
                                                                    No. IRSMS</br>
                                                                    {{$sp3da->noirsms}}</br>
                                                                    Tgl IRSMS</br>
                                                                    {{$sp3da->tglirsms}}</br>
                                                                    No. LP</br>
                                                                    {{$sp3da->nomor_lp}}</br>
                                                                    Tgl Kejadian</br>
                                                                    {{$sp3da->tanggal_kejadian}}</br>
                                                                    Tgl Penyelesaian</br>
                                                                    {{$sp3da->tanggal_penyelesaian}}</br>
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                    $laporan = DB::table('gambar')
                                                                    ->where('id_gambar',$sp3da->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                    ->get();
                                                                    $nolaporan = 1;
                                                                    echo 'Bukti Laporan Polisi </br>';
                                                                    if($laporan == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($laporan as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                        }
                                                                    }
                                    
                                                                    $resume = DB::table('gambar')
                                                                    ->where('id_gambar',$sp3da->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%RESUME%')
                                                                    ->get();
                                                                    echo 'Bukti Resume </br>';
                                                                    $noresume = 1;
                                                                    if($resume == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($resume as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                        } 
                                                                    }
                                    
                                                                    $selra = DB::table('gambar')
                                                                    ->where('id_gambar',$sp3da->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%SELRA%')
                                                                    ->get();
                                                                    echo 'Bukti Selra </br>';
                                                                    $noselra = 1;
                                                                    if($selra == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($selra as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                        }
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $adr = DB::table('perkara')
                                ->where('kategori','adr')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                $adrdata = DB::table('perkara')
                                ->where('kategori','adr')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();
                            ?>
                            @if ($adr == 0)
                                - 
                            @else
                            <a href="#dataadr{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#dataadr{{$sel->id}}">{{$adr}}</a>
                            <div id="dataadr{{$sel->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">DATA SP3</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-sm">
                                                <div class="col-lg">
                                                    <table id="dataadrtable{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p">IRSMS & LP</th>
                                                                <th class="wd-5p">Dokumen Pendukung</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($adrdata as $adrda)
                                                            <tr>
                                                                <td>
                                                                    No. IRSMS</br>
                                                                    {{$adrda->noirsms}}</br>
                                                                    Tgl IRSMS</br>
                                                                    {{$adrda->tglirsms}}</br>
                                                                    No. LP</br>
                                                                    {{$adrda->nomor_lp}}</br>
                                                                    Tgl Kejadian</br>
                                                                    {{$adrda->tanggal_kejadian}}</br>
                                                                    Tgl Penyelesaian</br>
                                                                    {{$adrda->tanggal_penyelesaian}}</br>
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                    $laporan = DB::table('gambar')
                                                                    ->where('id_gambar',$adrda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                    ->get();
                                                                    $nolaporan = 1;
                                                                    echo 'Bukti Laporan Polisi </br>';
                                                                    if($laporan == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($laporan as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                        }
                                                                    }
                                    
                                                                    $resume = DB::table('gambar')
                                                                    ->where('id_gambar',$adrda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%RESUME%')
                                                                    ->get();
                                                                    echo 'Bukti Resume </br>';
                                                                    $noresume = 1;
                                                                    if($resume == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($resume as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                        } 
                                                                    }
                                    
                                                                    $selra = DB::table('gambar')
                                                                    ->where('id_gambar',$adrda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%SELRA%')
                                                                    ->get();
                                                                    echo 'Bukti Selra </br>';
                                                                    $noselra = 1;
                                                                    if($selra == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($selra as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                        }
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $bas = DB::table('perkara')
                                ->where('kategori','bas')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                $basdata = DB::table('perkara')
                                ->where('kategori','bas')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();
                            ?>
                            @if ($bas == 0)
                                - 
                            @else
                            <a href="#databas{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#databas{{$sel->id}}">{{$bas}}</a>
                            <div id="databas{{$sel->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">DATA SP3</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-sm">
                                                <div class="col-lg">
                                                    <table id="databastable{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p">IRSMS & LP</th>
                                                                <th class="wd-5p">Dokumen Pendukung</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($basdata as $basda)
                                                            <tr>
                                                                <td>
                                                                    No. IRSMS</br>
                                                                    {{$basda->noirsms}}</br>
                                                                    Tgl IRSMS</br>
                                                                    {{$basda->tglirsms}}</br>
                                                                    No. LP</br>
                                                                    {{$basda->nomor_lp}}</br>
                                                                    Tgl Kejadian</br>
                                                                    {{$basda->tanggal_kejadian}}</br>
                                                                    Tgl Penyelesaian</br>
                                                                    {{$basda->tanggal_penyelesaian}}</br>
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                    $laporan = DB::table('gambar')
                                                                    ->where('id_gambar',$basda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                    ->get();
                                                                    $nolaporan = 1;
                                                                    echo 'Bukti Laporan Polisi </br>';
                                                                    if($laporan == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($laporan as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                        }
                                                                    }
                                    
                                                                    $resume = DB::table('gambar')
                                                                    ->where('id_gambar',$basda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%RESUME%')
                                                                    ->get();
                                                                    echo 'Bukti Resume </br>';
                                                                    $noresume = 1;
                                                                    if($resume == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($resume as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                        } 
                                                                    }
                                    
                                                                    $selra = DB::table('gambar')
                                                                    ->where('id_gambar',$basda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%SELRA%')
                                                                    ->get();
                                                                    echo 'Bukti Selra </br>';
                                                                    $noselra = 1;
                                                                    if($selra == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($selra as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                        }
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $diversi = DB::table('perkara')
                                ->where('kategori','diversi')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                $diversidata = DB::table('perkara')
                                ->where('kategori','diversi')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();
                            ?>
                            @if ($diversi == 0)
                                - 
                            @else
                            <a href="#datadiversi{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#datadiversi{{$sel->id}}">{{$diversi}}</a>
                            <div id="datadiversi{{$sel->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">DATA SP3</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-sm">
                                                <div class="col-lg">
                                                    <table id="datadiversitable{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p">IRSMS & LP</th>
                                                                <th class="wd-5p">Dokumen Pendukung</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($diversidata as $diversida)
                                                            <tr>
                                                                <td>
                                                                    No. IRSMS</br>
                                                                    {{$diversida->noirsms}}</br>
                                                                    Tgl IRSMS</br>
                                                                    {{$diversida->tglirsms}}</br>
                                                                    No. LP</br>
                                                                    {{$diversida->nomor_lp}}</br>
                                                                    Tgl Kejadian</br>
                                                                    {{$diversida->tanggal_kejadian}}</br>
                                                                    Tgl Penyelesaian</br>
                                                                    {{$diversida->tanggal_penyelesaian}}</br>
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                    $laporan = DB::table('gambar')
                                                                    ->where('id_gambar',$diversida->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                    ->get();
                                                                    $nolaporan = 1;
                                                                    echo 'Bukti Laporan Polisi </br>';
                                                                    if($laporan == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($laporan as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                        }
                                                                    }
                                    
                                                                    $resume = DB::table('gambar')
                                                                    ->where('id_gambar',$diversida->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%RESUME%')
                                                                    ->get();
                                                                    echo 'Bukti Resume </br>';
                                                                    $noresume = 1;
                                                                    if($resume == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($resume as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                        } 
                                                                    }
                                    
                                                                    $selra = DB::table('gambar')
                                                                    ->where('id_gambar',$diversida->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%SELRA%')
                                                                    ->get();
                                                                    echo 'Bukti Selra </br>';
                                                                    $noselra = 1;
                                                                    if($selra == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($selra as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                        }
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $limpah = DB::table('perkara')
                                ->where('kategori','limpah')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                $limpahdata = DB::table('perkara')
                                ->where('kategori','limpah')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')    
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();
                            ?>
                            @if ($limpah == 0)
                                - 
                            @else
                            <a href="#datalimpah{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#datalimpah{{$sel->id}}">{{$limpah}}</a>
                            <div id="datalimpah{{$sel->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">DATA SP3</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-sm">
                                                <div class="col-lg">
                                                    <table id="datalimpahtable{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p">IRSMS & LP</th>
                                                                <th class="wd-5p">Dokumen Pendukung</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($limpahdata as $limpahda)
                                                            <tr>
                                                                <td>
                                                                    No. IRSMS</br>
                                                                    {{$limpahda->noirsms}}</br>
                                                                    Tgl IRSMS</br>
                                                                    {{$limpahda->tglirsms}}</br>
                                                                    No. LP</br>
                                                                    {{$limpahda->nomor_lp}}</br>
                                                                    Tgl Kejadian</br>
                                                                    {{$limpahda->tanggal_kejadian}}</br>
                                                                    Tgl Penyelesaian</br>
                                                                    {{$limpahda->tanggal_penyelesaian}}</br>
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                    $laporan = DB::table('gambar')
                                                                    ->where('id_gambar',$limpahda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                    ->get();
                                                                    $nolaporan = 1;
                                                                    echo 'Bukti Laporan Polisi </br>';
                                                                    if($laporan == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($laporan as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                        }
                                                                    }
                                    
                                                                    $resume = DB::table('gambar')
                                                                    ->where('id_gambar',$limpahda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%RESUME%')
                                                                    ->get();
                                                                    echo 'Bukti Resume </br>';
                                                                    $noresume = 1;
                                                                    if($resume == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($resume as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                        } 
                                                                    }
                                    
                                                                    $selra = DB::table('gambar')
                                                                    ->where('id_gambar',$limpahda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%SELRA%')
                                                                    ->get();
                                                                    echo 'Bukti Selra </br>';
                                                                    $noselra = 1;
                                                                    if($selra == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($selra as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                        }
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $rj = DB::table('perkara')
                                ->where('kategori','rj')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                $rjdata = DB::table('perkara')
                                ->where('kategori','rj')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();
                            ?>
                            @if ($rj == 0)
                                - 
                            @else
                            <a href="#datarj{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#datarj{{$sel->id}}">{{$rj}}</a>
                            <div id="datarj{{$sel->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">DATA SP3</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-sm">
                                                <div class="col-lg">
                                                    <table id="datarjtable{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p">IRSMS & LP</th>
                                                                <th class="wd-5p">Dokumen Pendukung</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($rjdata as $rjda)
                                                            <tr>
                                                                <td>
                                                                    No. IRSMS</br>
                                                                    {{$rjda->noirsms}}</br>
                                                                    Tgl IRSMS</br>
                                                                    {{$rjda->tglirsms}}</br>
                                                                    No. LP</br>
                                                                    {{$rjda->nomor_lp}}</br>
                                                                    Tgl Kejadian</br>
                                                                    {{$rjda->tanggal_kejadian}}</br>
                                                                    Tgl Penyelesaian</br>
                                                                    {{$rjda->tanggal_penyelesaian}}</br>
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                    $laporan = DB::table('gambar')
                                                                    ->where('id_gambar',$rjda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                    ->get();
                                                                    $nolaporan = 1;
                                                                    echo 'Bukti Laporan Polisi </br>';
                                                                    if($laporan == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($laporan as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                        }
                                                                    }
                                    
                                                                    $resume = DB::table('gambar')
                                                                    ->where('id_gambar',$rjda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%RESUME%')
                                                                    ->get();
                                                                    echo 'Bukti Resume </br>';
                                                                    $noresume = 1;
                                                                    if($resume == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($resume as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                        } 
                                                                    }
                                    
                                                                    $selra = DB::table('gambar')
                                                                    ->where('id_gambar',$rjda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%SELRA%')
                                                                    ->get();
                                                                    echo 'Bukti Selra </br>';
                                                                    $noselra = 1;
                                                                    if($selra == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($selra as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                        }
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $sp2lidik = DB::table('perkara')
                                ->where('kategori','sp2 lidik')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')                             
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->count();

                                $sp2lidikdata = DB::table('perkara')
                                ->where('kategori','sp2 lidik')
                                ->where('tanggal_kejadian','LIKE',Session::get('tahun').'%')                             
                                ->where('status','Data Valid')
                                ->where('id_unit',$sel->id)
                                ->get();
                            ?>
                            @if ($sp2lidik == 0)
                                - 
                            @else
                            <a href="#datasp2lidik{{$sel->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#datasp2lidik{{$sel->id}}">{{$sp2lidik}}</a>
                            <div id="datasp2lidik{{$sel->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">DATA SP3</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row row-sm">
                                                <div class="col-lg">
                                                    <table id="datasp2lidiktable{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="wd-5p">IRSMS & LP</th>
                                                                <th class="wd-5p">Dokumen Pendukung</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($sp2lidikdata as $sp2lidikda)
                                                            <tr>
                                                                <td>
                                                                    No. IRSMS</br>
                                                                    {{$sp2lidikda->noirsms}}</br>
                                                                    Tgl IRSMS</br>
                                                                    {{$sp2lidikda->tglirsms}}</br>
                                                                    No. LP</br>
                                                                    {{$sp2lidikda->nomor_lp}}</br>
                                                                    Tgl Kejadian</br>
                                                                    {{$sp2lidikda->tanggal_kejadian}}</br>
                                                                    Tgl Penyelesaian</br>
                                                                    {{$sp2lidikda->tanggal_penyelesaian}}</br>
                                                                </td>
                                                                <td>
                                                                <?php 
                                                                    $laporan = DB::table('gambar')
                                                                    ->where('id_gambar',$sp2lidikda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%LAPORAN%')
                                                                    ->get();
                                                                    $nolaporan = 1;
                                                                    echo 'Bukti Laporan Polisi </br>';
                                                                    if($laporan == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($laporan as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Laporan-'.$nolaporan++.'</a><br>';
                                                                        }
                                                                    }
                                    
                                                                    $resume = DB::table('gambar')
                                                                    ->where('id_gambar',$sp2lidikda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%RESUME%')
                                                                    ->get();
                                                                    echo 'Bukti Resume </br>';
                                                                    $noresume = 1;
                                                                    if($resume == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($resume as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Resume-'.$noresume++.'</a><br>';
                                                                        } 
                                                                    }
                                    
                                                                    $selra = DB::table('gambar')
                                                                    ->where('id_gambar',$sp2lidikda->id_gambar)
                                                                    ->where('nama_gambar','LIKE','%SELRA%')
                                                                    ->get();
                                                                    echo 'Bukti Selra </br>';
                                                                    $noselra = 1;
                                                                    if($selra == null){
                                                                        echo 'Tidak Ada Dokumen';
                                                                    }else{
                                                                        foreach($selra as $l){
                                                                            echo '<a target="_blank" href="'.$l->gambar.'/'.$l->nama_gambar.'">Selra-'.$noselra++.'</a><br>';
                                                                        }
                                                                    }
                                                                ?>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $total = $p21 + $sp3 + $adr + $bas + $rj + $diversi + $sp2lidik + $limpah;
                                if($total == 0){
                                    echo '-';
                                }else{
                                    echo $total; 
                                }   
                            ?>
                        </td>
                        <td>
                            <?php 
                                $kejadian = DB::table('selra')
                                ->select(DB::raw('SUM(jmlselra) as total'))
                                ->where('id_unit',$sel->id)
                                ->where('tahun',Session::get('tahun'))
                                ->first();
                                //dd($kejadian->jmlselra);
                            ?>
                            @if ($kejadian == null or $kejadian == '0')
                                - 
                            @else
                                {{$kejadian->total}}
                            @endif
                        </td>
                        <td>
                            <?php
                                if($kejadian == null){
                                    $jamm = 0;
                                }else{
                                    $jamm = $kejadian->total;
                                }
                                $persentase = ($total!=0 and $jamm!=0) ? round(($total / $jamm) * 100,2) :0;
                                    echo $persentase.'%';
                            ?>
                        </td>

                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="{{ asset('public/web/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/web/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/web/lib/select2/css/select2.min.css')}}" rel="stylesheet">

<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset('public/web/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/web/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{ asset('public/web/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('public/web/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script src="{{ asset('public/web/lib/select2/js/select2.min.js')}}"></script>

<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    @foreach($select as $sal)
    $('#datap21table{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    $('#datarjtable{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    $('#datalimpahtable{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    $('#datadiversitable{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    $('#databastable{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    $('#dataadrtable{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    $('#datasp3table{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    $('#datasp2lidiktable{{$sal->id}}').dataTable({
        "info":     false,
        "bLengthChange" : false,
        "responsive": true,
        "lengthMenu": [[2], ["All"]],
    });
    @endforeach

    $('#managamentunit').dataTable({
        'dom': 'Bfrtip',
              'buttons': [
                {
                  extend: 'copy',
                  exportOptions: {
                      columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12]
                  },
                },
                {
                  extend: 'csv',
                  exportOptions: {
                      columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12]
                  },
                },
                {
                  extend: 'excel',
                  exportOptions: {
                      columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12]
                  },
                },
              ],
            "responsive": true,
            "searching": false,
            "bLengthChange" : false,
            "columnDefs": [{ 
              "targets": [ 0,1,2,3,4,5,6,7,8,9,10,11,12 ],
                "visible": false,
                "searchable": false
            }],
            "lengthMenu": [[-1], ["All"]],
        "language": {
            "lengthMenu": "_MENU_ Data",
            "zeroRecords": "Tidak ada data yang tersedia pada tabel ini",
            "info": "Menampilkan _PAGE_ dari _PAGES_ entri",
            "infoEmpty": "Tidak ditemukan data yang sesuai",
            "searchPlaceholder": 'Silahkan Cari Data',
            "sSearch": '',
            "lengthMenu": '_MENU_ Data',
            "infoFiltered": "(filter dari _MAX_ entri keseluruhan)",
            "paginate": {
                "first": "Pertama",
                "previous": "Sebelumnya",
                "next": "Selajutnya",
                "last": "Terkahir"
            }
        }
    });
});
</script>
@endsection