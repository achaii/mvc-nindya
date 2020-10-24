@extends('layouts.web')

@section('title')
<h2 class="az-content-title tx-24 mg-b-5">Laporan Bulanan Per-Tanggal</h2>
<p class="mg-b-20 mg-lg-b-25">Managemen Laporan Bulanan Per-Tanggal</p>
@endsection

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12">
        <div class="card card-dashboard-eighteen">
            <div class="col-sm-12 col-md-8" style="padding-left: 0px;">
                <form action="{{Route('weblaporanbulantanggal')}}" method="POST">
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
                    <div class="col-lg">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-with-icon btn-block">
                            <i class="typcn typcn-plus"></i> CARI DATA
                        </button>
                    </div>
                
                </div>  
            </br>   
                <label>Form pencarian laporan data selra per-tanggal</label>  
            </form>
            </div>
            <div class="table-responsive">
                <table id="managamentunit" class="display responsive table table-hover table-striped table-bordered" width="100%" >
                    <thead>
                        <tr>
                            <th class="wd-5p" style="padding:5px">NO</th>
                            <th class="wd-10p">POLRES</th>
                                @foreach ($tahun as $t)
                                    <th class="wd-5p" style="padding:5px">
                                        {{substr($t->tanggal,3,2)}}
                                        <br>
                                        {{substr($t->tanggal,0,2)}}
                                    </th>
                                @endforeach
                            <th class="wd-5p">JML SELRA</th>
                            <th class="wd-5p">KJDN IRSMS</th>
                            <th class="wd-5p">CAPAIAN</th>
                            <th class="wd-5p">KETERANGAN</th>
                            <th class="wd-5p">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($select as $sel)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$sel->nama_unit}}</td>
                            @foreach ($tahun as $t)
                                <?php 
                                    $jml = DB::table('perkara')
                                    ->where('id_unit',$sel->id)
                                    ->where('tanggal_kejadian',substr($t->tanggal,6,4).substr($t->tanggal,3,2).substr($t->tanggal,0,2))
                                    ->where('status','Data Valid')
                                    ->count();

                                    $jmldata = DB::table('perkara')
                                    ->where('id_unit',$sel->id)
                                    ->where('tanggal_kejadian',substr($t->tanggal,6,4).substr($t->tanggal,3,2).substr($t->tanggal,0,2))
                                    ->where('status','Data Valid')
                                    ->get();
                                ?>
                                <td style="padding:5px">
                                    @if($jml == 0)
                                        -
                                    @else
                                    <a href="#datajml{{$sel->id}}{{$t->id}}" data-effect="effect-scale" data-toggle="modal" data-target="#datajml{{$sel->id}}{{$t->id}}">{{$jml}}</a>
                                    <div id="datajml{{$sel->id}}{{$t->id}}" class="modal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">DATA SELRA</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row row-sm">
                                                        <div class="col-lg">
                                                            <table id="datajmltable{{$sel->id}}{{$t->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="wd-5p">IRSMS & LP</th>
                                                                        <th class="wd-5p">Dokumen Pendukung</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($jmldata as $jmldataj)
                                                                    <tr>
                                                                        <td>
                                                                            No. IRSMS</br>
                                                                            {{$jmldataj->noirsms}}</br>
                                                                            Tgl IRSMS</br>
                                                                            {{$jmldataj->tglirsms}}</br>
                                                                            No. LP</br>
                                                                            {{$jmldataj->nomor_lp}}</br>
                                                                            Tgl Kejadian</br>
                                                                            {{$jmldataj->tanggal_kejadian}}</br>
                                                                            Tgl Penyelesaian</br>
                                                                            {{$jmldataj->tanggal_penyelesaian}}</br>
                                                                        </td>
                                                                        <td>
                                                                        <?php 
                                                                            $laporan = DB::table('gambar')
                                                                            ->where('id_gambar',$jmldataj->id_gambar)
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
                                                                            ->where('id_gambar',$jmldataj->id_gambar)
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
                                                                            ->where('id_gambar',$jmldataj->id_gambar)
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
                            @endforeach
                            <td>
                                <?php 
                                    $jmlselra = DB::table('perkara')
                                    ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                                    ->where('status','Data Valid')
                                    ->where('id_unit',$sel->id)
                                    ->count();
        
                                    if($jmlselra == 0){
                                        echo '-';
                                    }else{
                                        echo $jmlselra;
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    $kejadian = DB::table('selra')
                                    ->where('id_unit',$sel->id)
                                    ->where('bulan',Session::get('bulan'))
                                    ->where('tahun',Session::get('tahun'))
                                    ->first();
    
                                ?>
                                @if ($kejadian == null or $kejadian == '0')
                                    - 
                                @else
                                    {{$kejadian->jmlselra}}
                                @endif
                            </td>
                            <td>
                                <?php
                                    if($kejadian == null){
                                        $jamm = 0;
                                    }else{
                                        $jamm = $kejadian->jmlselra;
                                    }
                                    $persentase = ($jmlselra!=0 and $jamm!=0) ? round(($jmlselra / $jamm) * 100,2) :0;
                                    echo $persentase.'%';
                                ?>
                            </td>
                            <td>
                                <?php 
                                $ket = DB::table('selra')
                                ->where('id_unit',$sel->id)
                                ->where('bulan',Session::get('bulan'))
                                ->where('tahun',Session::get('tahun'))
                                ->first();
                                if($ket == null or $ket == ''){
                                    echo '-';
                                    $keterangan = null;
                                }else{
                                    echo $ket->keterangan;
                                    $keterangan = $ket->keterangan;
                                }
                            ?>
                            </td>
                            <td>
                                <a type="submit" class="btn btn-primary btn-with-icon btn-block" data-effect="effect-scale" data-toggle="modal" data-target="#modalket{{$sel->id}}">
                                    <i class="typcn typcn-input-checked"></i>
                                </a>
                                <div id="modalket{{$sel->id}}" class="modal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <form method="POST" action="{{Route('weblaporanbulantanggalupdate')}}">
                                                @csrf
                                                <input style="display: none" value="{{$sel->id}}" name="id">
                                                <input style="display: none" value="{{Session::get('bulan')}}" name="bulan">
                                                <input style="display: none" value="{{Session::get('tahun')}}" name="tahun">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">FORM KETERANGAN</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row row-sm">
                                                        <div class="col-lg">
                                                            <label>KETERANGAN <span class="tx-danger">*</span></label>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$keterangan}}</textarea>
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
        @foreach($tahun as $ts)
        $('#datajmltable{{$sal->id}}{{$ts->id}}').dataTable({
            "info":     false,
            "bLengthChange" : false,
            "responsive": true,
            "lengthMenu": [[2], ["All"]],
        });
        @endforeach
    @endforeach

    $('#managamentunit').dataTable({
        'dom': 'Bfrtip',
        'buttons': ['copy','excel','csv'],
        "scrollX": false,
        "scrollCollapse": false,
        "lengthMenu": [[-1], ["All"]],
        "responsive": false,
        "searching": false,
        "bLengthChange" : false,
        "paging":   false,
        "ordering": false,
        "info":     false,
        "columnDefs": [
            {"searchable": false, "targets": 5},
        ], 
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