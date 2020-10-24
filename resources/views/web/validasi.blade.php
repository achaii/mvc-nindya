@extends('layouts.web')

@section('title')
<h2 class="az-content-title tx-24 mg-b-5">Managemen Validasi Selra</h2>
<p class="mg-b-20 mg-lg-b-25">Pengaturan managemen validasi selra per-polres</p>
@endsection

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12">
        <div class="card card-dashboard-eighteen">
            <div class="col-sm-12 col-md-8" style="padding-left: 0px;">
                <form action="{{Route('webvalidasi')}}" method="POST">
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
                        <label>BULAN <span class="tx-danger">*</span></label>
                        <select class="form-control" id="bbulan" name="bulan">   
                            <option <?php if(Session::get('bulan') == '01'){ echo 'selected';} ?> value="01"> JANUARI</option>
                            <option <?php if(Session::get('bulan') == '02'){ echo 'selected';} ?> value="02"> FEBRUARI</option>
                            <option <?php if(Session::get('bulan') == '03'){ echo 'selected';} ?> value="03"> MARET</option>
                            <option <?php if(Session::get('bulan') == '04'){ echo 'selected';} ?> value="04"> APRIL</option>
                            <option <?php if(Session::get('bulan') == '05'){ echo 'selected';} ?> value="05"> MEI</option>
                            <option <?php if(Session::get('bulan') == '06'){ echo 'selected';} ?> value="06"> JUNI</option>
                            <option <?php if(Session::get('bulan') == '07'){ echo 'selected';} ?> value="07"> JULI</option>
                            <option <?php if(Session::get('bulan') == '08'){ echo 'selected';} ?> value="08"> AGUSTUS</option>
                            <option <?php if(Session::get('bulan') == '09'){ echo 'selected';} ?> value="09"> SEPTEMBER</option>
                            <option <?php if(Session::get('bulan') == '10'){ echo 'selected';} ?> value="10"> OKTOBER</option>
                            <option <?php if(Session::get('bulan') == '11'){ echo 'selected';} ?> value="11"> NOVEMBER</option>
                            <option <?php if(Session::get('bulan') == '12'){ echo 'selected';} ?> value="12"> DESEMBER</option>          
                          </select>
                    </div>
                    <div class="col-lg" style="padding-left: 0%">
                        <label>UNIT</label>
                        <select class="form-control" id="unit" name="unit">
                            <option value="semua">SEMUA UNIT</option>
                            @foreach ($unit as $u)
                            <option <?php if($u->id == Session::get('units')){ echo 'selected';} ?> value="{{$u->id}}">{{$u->nama_unit}}</option>  
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
                <label>Form pencarian data selra per-tahun, per-bulan, per-unit</label>  
            </form>
            </div>
            <table id="managamentunit" class="display responsive table table-hover table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th style="display: none">NO</th>
                        <th style="display: none">NOMOR IRSMS</th>
                        <th style="display: none">TANGGAL IRSMS</th>
                        <th style="display: none">NOMOR LP</th>
                        <th style="display: none">TANGGAL KEJADIAN PERKARA</th>
                        <th style="display: none">TANGGAL PENYELESAIAN PERKARA</th>
                        <th style="display: none">PENYELESAIAN PERKARA</th>
                        <th style="display: none">STATUS</th>
                        <th style="display: none">DOKUMEN LAPORAN</th>
                        <th style="display: none">DOKUMEN RESUME</th>
                        <th style="display: none">DOKUMEN SELRA</th>
                        <th style="display: none">KETERANGAN</th>

                        <th class="wd-5p">NO</th>
                        <th class="wd-20p">NOMOR IRSMS</th>
                        <th class="wd-20p" data-priority="1">NOMOR LP</th>
                        <th class="wd-5p" data-priority="1">PENYELESAIAN PERKARA</th>
                        <th class="wd-40p">DOKUMEN PENDUKUNG</th>
                        <th class="wd-300-f">KETERANGAN</th>
                        <th class="wd-5p" data-priority="1">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($select as $i)
                    <a id="a" href="/managemen-validasi#tr{{Session::get('tablevalidasi')}}" ></a>
                     <tr id="tr{{$i->id}}">
                        <td style="display: none">{{$noo++}}</td>
                        <td style="display: none">{{$i->noirsms}}</td>
                        <td style="display: none">{{$i->tglirsms}}</td>
                        <td style="display: none">{{$i->nomor_lp}}</td>
                        <td style="display: none">{{$i->tanggal_kejadian}}</td>
                        <td style="display: none">{{$i->tanggal_penyelesaian}}</td>
                        <td style="display: none">{{$i->kategori}}</td>
                        <td style="display: none">{{$i->status}}</td>
                        <td style="display: none">
                        <?php 
                                $laporan = DB::table('gambar')
                                ->where('id_gambar',$i->id_gambar)
                                ->where('nama_gambar','LIKE','%LAPORAN%')
                                ->get();
                                $nolaporan = 1;
                                if($laporan == null){
                                    echo 'Tidak Ada Dokumen';
                                }else{
                                    foreach($laporan as $l){
                                        echo $l->gambar.'/'.$l->nama_gambar;
                                    }
                                }
                        ?>
                        </td>
                        <td style="display: none">
                        <?php
                                $resume = DB::table('gambar')
                                ->where('id_gambar',$i->id_gambar)
                                ->where('nama_gambar','LIKE','%RESUME%')
                                ->get();
                                $noresume = 1;
                                if($resume == null){
                                    echo 'Tidak Ada Dokumen';
                                }else{
                                    foreach($resume as $l){
                                        echo $l->gambar.'/'.$l->nama_gambar;
                                    } 
                                }
                        ?>
                        </td>
                        <td style="display: none">
                        <?php
                                $selra = DB::table('gambar')
                                ->where('id_gambar',$i->id_gambar)
                                ->where('nama_gambar','LIKE','%SELRA%')
                                ->get();
                                $noselra = 1;
                                if($selra == null){
                                    echo 'Tidak Ada Dokumen';
                                }else{
                                    foreach($selra as $l){
                                        echo $l->gambar.'/'.$l->nama_gambar;
                                    }
                                }
                        ?>
                        </td>
                        <td style="display: none">{{$i->keterangan}}</td>


                        <td>{{$no++}}</td>
                        <td>No. <a href="#">{{$i->noirsms}}</a><br>
                            Tgl IRSMS <br>
                            <a href="#">
                            {{substr($i->tglirsms,6,2).' '}}
                            <?php 
                                if(substr($i->tglirsms,4,2) == '01'){
                                    echo 'JANUARI ';
                                }elseif(substr($i->tglirsms,4,2) == '02'){
                                    echo 'FEBRUARI ';
                                }elseif(substr($i->tglirsms,4,2) == '03'){
                                    echo 'MARET ';
                                }elseif(substr($i->tglirsms,4,2) == '04'){
                                    echo 'APRIL ';
                                }elseif(substr($i->tglirsms,4,2) == '05'){
                                    echo 'MEI ';
                                }elseif(substr($i->tglirsms,4,2) == '06'){
                                    echo 'JUNI ';
                                }elseif(substr($i->tglirsms,4,2) == '07'){
                                    echo 'JULI ';
                                }elseif(substr($i->tglirsms,4,2) == '08'){
                                    echo 'AGUSTUS ';
                                }elseif(substr($i->tglirsms,4,2) == '09'){
                                    echo 'SEPTEMBER ';
                                }elseif(substr($i->tglirsms,4,2) == '10'){
                                    echo 'OKTOBER ';
                                }elseif(substr($i->tglirsms,4,2) == '11'){
                                    echo 'NOVEMBER ';
                                }elseif(substr($i->tglirsms,4,2) == '12'){
                                    echo 'DESEMBER ';
                                } 
                            ?>
                            {{substr($i->tglirsms,0,4)}}
                            </a>
                        </td>
                        <td>No. <a href="#">{{$i->nomor_lp}}</a><br>
                            Tgl Kejadian Perkara <br>
                            <a href="#">
                            {{substr($i->tanggal_kejadian,6,2).' '}}
                            <?php 
                                if(substr($i->tanggal_kejadian,4,2) == '01'){
                                    echo 'JANUARI ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '02'){
                                    echo 'FEBRUARI ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '03'){
                                    echo 'MARET ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '04'){
                                    echo 'APRIL ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '05'){
                                    echo 'MEI ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '06'){
                                    echo 'JUNI ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '07'){
                                    echo 'JULI ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '08'){
                                    echo 'AGUSTUS ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '09'){
                                    echo 'SEPTEMBER ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '10'){
                                    echo 'OKTOBER ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '11'){
                                    echo 'NOVEMBER ';
                                }elseif(substr($i->tanggal_kejadian,4,2) == '12'){
                                    echo 'DESEMBER ';
                                } 
                            ?>
                            {{substr($i->tanggal_kejadian,0,4)}}
                            </a>
                            <br>
                            Tgl Penyelesaian Perkara <br>
                            <a href="#">
                            {{substr($i->tanggal_penyelesaian,6,2).' '}}
                            <?php 
                                if(substr($i->tanggal_penyelesaian,4,2) == '01'){
                                    echo 'JANUARI ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '02'){
                                    echo 'FEBRUARI ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '03'){
                                    echo 'MARET ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '04'){
                                    echo 'APRIL ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '05'){
                                    echo 'MEI ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '06'){
                                    echo 'JUNI ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '07'){
                                    echo 'JULI ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '08'){
                                    echo 'AGUSTUS ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '09'){
                                    echo 'SEPTEMBER ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '10'){
                                    echo 'OKTOBER ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '11'){
                                    echo 'NOVEMBER ';
                                }elseif(substr($i->tanggal_penyelesaian,4,2) == '12'){
                                    echo 'DESEMBER ';
                                } 
                            ?>
                            {{substr($i->tanggal_penyelesaian,0,4)}}
                            </a>
                        </td>
                        <td>
                            {{$i->kategori}}<br>
                            @if($i->status == 'Data Valid')
                                <a href="#" style="color:green">{{$i->status}}</a>
                            @else
                                <a href="#" style="color:red">{{$i->status}}</a>
                            @endif
                        </td>
                        <td>
                            <?php 
                                $laporan = DB::table('gambar')
                                ->where('id_gambar',$i->id_gambar)
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
                                ->where('id_gambar',$i->id_gambar)
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
                                ->where('id_gambar',$i->id_gambar)
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
                        <td>
                            <form method="POST" action="{{Route('webvalidasiketerangan')}}">
                                @csrf
                                <input name="id" value="{{$i->id}}" style="display: none">
                                <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$i->keterangan}}</textarea>
                                <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                    <i class="typcn typcn-input-checked"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="#modalvalidasi{{$i->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#modalvalidasi{{$i->id}}" class="btn btn-warning btn-with-icon btn-block"><i class="typcn typcn-clipboard"></i></a>
                            <a href="#modaledit{{$i->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#modaledit{{$i->id}}" class="btn btn-primary btn-with-icon btn-block"><i class="typcn typcn-edit"></i></a>
                            <a onclick="return confirm('Yakin Ingin mengahapus Data Ini ?')" href="{{Route('webvalidasidestroy',[$i->id])}}" class="btn btn-danger btn-with-icon btn-block"><i class="typcn typcn-trash"></i></a>
                            <div id="modalvalidasi{{$i->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <form method="POST" action="{{Route('webvalidasiupdate',[$i->id])}}">
                                            @csrf
                                            <div class="modal-header">
                                                <h6 class="modal-title">FORM VALIDASI</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                    <label>VALIDASI <span class="tx-danger">*</span></label>
                                                        <select class="form-control" name="validasi">   
                                                            <option <?php if($i->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                            <option <?php if($i->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="row row-sm">
                                                    <div class="col-lg">
                                                        <label>KETERANGAN <span class="tx-danger">*</span></label>
                                                        <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$i->keterangan}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="Submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="modaledit{{$i->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content modal-content-demo">
                                    <form method="POST" action="{{Route('webmunitstore')}}">
                                        @csrf
                                    <div class="modal-header">
                                    <h6 class="modal-title">EDIT DATA</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Unit <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                    <select class="form-control" id="unit" name="unit">   
                                                        @foreach ($unit as $item)
                                                        <option <?php if($i->id_unit == $item->id){ echo 'selected';} ?> value="{{$item->id}}">{{$item->nama_unit}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Bulan <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                    <select class="form-control" id="bbulan" name="bulan">   
                                                        <option <?php if($i->bulan == '01'){ echo 'selected';} ?> value="01"> JANUARI</option>
                                                        <option <?php if($i->bulan == '02'){ echo 'selected';} ?> value="02"> FEBRUARI</option>
                                                        <option <?php if($i->bulan == '03'){ echo 'selected';} ?> value="03"> MARET</option>
                                                        <option <?php if($i->bulan == '04'){ echo 'selected';} ?> value="04"> APRIL</option>
                                                        <option <?php if($i->bulan == '05'){ echo 'selected';} ?> value="05"> MEI</option>
                                                        <option <?php if($i->bulan == '06'){ echo 'selected';} ?> value="06"> JUNI</option>
                                                        <option <?php if($i->bulan == '07'){ echo 'selected';} ?> value="07"> JULI</option>
                                                        <option <?php if($i->bulan == '08'){ echo 'selected';} ?> value="08"> AGUSTUS</option>
                                                        <option <?php if($i->bulan == '09'){ echo 'selected';} ?> value="09"> SEPTEMBER</option>
                                                        <option <?php if($i->bulan == '10'){ echo 'selected';} ?> value="10"> OKTOBER</option>
                                                        <option <?php if($i->bulan == '11'){ echo 'selected';} ?> value="11"> NOVEMBER</option>
                                                        <option <?php if($i->bulan == '12'){ echo 'selected';} ?> value="12"> DESEMBER</option>          
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Nomor IRSMS <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                <input name="noirsms" type="text" class="form-control" value="{{$i->noirsms}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Tanggal IRSMS <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                    <input type="text" value="{{$i->tglirsms}}" class="form-control" id="datepicker-autoclose3" name="tglirsms">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>No LP <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                <input name="nomorlp" type="text" class="form-control" value="{{$i->nomor_lp}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Tanggal Kejadian Perkara <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                    <input value="{{$i->tanggal_kejadian}}" type="text" class="form-control" id="datepicker-autoclose1" name="tanggal_kejadian">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Penyelesaian Perkara <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                    <select class="form-control custom-select" id="account1" name="penyelesaianperkara">
                                                        <option <?php if($i->kategori == 'P21'){ echo 'selected';} ?> value="P21"> P21</option>
                                                        <option <?php if($i->kategori == 'SP3'){ echo 'selected';} ?>value="SP3"> SP3</option>
                                                        <option <?php if($i->kategori == 'RJ'){ echo 'selected';} ?>value="RJ"> RJ</option>
                                                        <option <?php if($i->kategori == 'ADR'){ echo 'selected';} ?>value="ADR"> ADR</option>
                                                        <option <?php if($i->kategori == 'DIVERSI'){ echo 'selected';} ?>value="DIVERSI"> DIVERSI</option>
                                                        <option <?php if($i->kategori == 'LIMPAH'){ echo 'selected';} ?>value="LIMPAH"> LIMPAH</option>
                                                        <option <?php if($i->kategori == 'SP2 LIDIK'){ echo 'selected';} ?>value="SP2 LIDIK"> SP2 LIDIK</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Tanggal Penyelesaian Perkara <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                    <input value="{{$i->tanggal_penyelesaian}}" type="text" class="form-control" id="datepicker-autoclose2" name="tanggal_penyelesaian">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="Submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
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
            $('#managamentunit').dataTable({
                'dom': 'Bfrtip',
              'buttons': [
                {
                  extend: 'copy',
                  exportOptions: {
                      columns: [ 0,1,2,3,4,5,6,7,8,9,10,11]
                  },
                },
                {
                  extend: 'csv',
                  exportOptions: {
                      columns: [ 0,1,2,3,4,5,6,7,8,9,10,11]
                  },
                },
                {
                  extend: 'excel',
                  exportOptions: {
                      columns: [ 0,1,2,3,4,5,6,7,8,9,10,11]
                  },
                },
              ],
            "responsive": true,
            "searching": true,
            "bLengthChange" : false,
            "columnDefs": [{ 
              "targets": [ 0,1,2,3,4,5,6,7,8,9,10,11 ],
                "visible": false,
                "searchable": false
            }],
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

            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
            $('.modal-effect').on('click', function(e){
                e.preventDefault();
                var effect = $(this).attr('data-effect');
                $('#modaldemo').addClass(effect);
            });

            $('#modaldemo').on('hidden.bs.modal', function (e) {
                $(this).removeClass (function (index, className) {
                    return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
                });
            });

            @foreach($select as $i)
            $('.modal-effect').on('click', function(e){
                e.preventDefault();
                var effect = $(this).attr('data-effect');
                $('#modaldemo{{$i->id}}').addClass(effect);
            });

            $('#modaldemo{{$i->id}}').on('hidden.bs.modal', function (e) {
                $(this).removeClass (function (index, className) {
                    return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
                });
            });
            @endforeach 
            
            @if($errors->has('tabs'))
            $(function(){
                window.location.href = $("#a").attr('href');
            });
            @endif
        });
    </script>
@endsection