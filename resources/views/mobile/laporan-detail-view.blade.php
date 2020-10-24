@extends('layouts.mobile')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="{{Route('mobilepagelaporan')}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        LAPORAN DETAIL
    </div>
</div>
@endsection

@section('content')
<div class="section mt-2 mb-2">

    @foreach ($select as $i)
    <div class="listed-detail mt-3">
        <div class="icon-wrapper">
            <div class="iconbox">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
        </div>
        <h3 class="text-center mt-2">LAPORAN {{$kategori}}</h3>
    </div>

    <ul class="listview flush transparent simple-listview no-space mt-3">
        <li>
            <strong>Status</strong>
            <?php 
                if($i->status == 'Menunggu Validasi'){
                    echo '<span class="text-warning">Menunggu Validasi</span>';
                }elseif($i->status == 'Data Tidak Valid'){
                    echo '<span class="text-danger">Data Tidak Valid</span>';    
                }elseif($i->status == 'Data Valid'){
                    echo '<span class="text-success">Data Valid</span>';
                }
            ?>
        </li>
        <li>
            <strong>Nomor IRSMS</strong>
            <span>{{$i->noirsms}}</span>
        </li>
        <li>
            <strong>Tanggal IRSMS</strong>
            <span>
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
            </span>
        </li>
        <li>
            <strong>Nomor LP</strong>
            <span>{{$i->nomor_lp}}</span>
        </li>
        <li>
            <strong>Tanggal Kejadian</strong>
            <span>
                {{substr($i->tanggal_kejadian,0,2).' '}}
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
            </span>
        </li>
        <li>
            <strong>Tanggal Penyelesaian</strong>
            <span>
                {{substr($i->tanggal_penyelesaian,0,2).' '}}
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
            </span>
        </li>
        <li>
            <strong>Bulan</strong>
            <span>
                <?php 
                if($i->bulan == '01'){
                    echo 'JANUARI';
                }elseif($i->bulan == '02'){
                    echo 'FEBRUARI';
                }elseif($i->bulan == '03'){
                    echo 'MARET';
                }elseif($i->bulan == '04'){
                    echo 'APRIL';
                }elseif($i->bulan == '05'){
                    echo 'MEI';
                }elseif($i->bulan == '06'){
                    echo 'JUNI';
                }elseif($i->bulan == '07'){
                    echo 'JULI';
                }elseif($i->bulan == '08'){
                    echo 'AGUSTUS';
                }elseif($i->bulan == '09'){
                    echo 'SEPTEMBER';
                }elseif($i->bulan == '10'){
                    echo 'OKTOBER';
                }elseif($i->bulan == '11'){
                    echo 'NOVEMBER';
                }elseif($i->bulan == '12'){
                    echo 'DESEMBER';
                } 
            ?>
            </span>
        </li>
        <li>
            <strong>Tanggal Upload</strong>
            <span>
                {{substr($i->tanggal_upload,0,2).' '}}
                <?php 
                if(substr($i->tanggal_upload,4,2) == '01'){
                    echo 'JANUARI ';
                }elseif(substr($i->tanggal_upload,4,2) == '02'){
                    echo 'FEBRUARI ';
                }elseif(substr($i->tanggal_upload,4,2) == '03'){
                    echo 'MARET ';
                }elseif(substr($i->tanggal_upload,4,2) == '04'){
                    echo 'APRIL ';
                }elseif(substr($i->tanggal_upload,4,2) == '05'){
                    echo 'MEI ';
                }elseif(substr($i->tanggal_upload,4,2) == '06'){
                    echo 'JUNI ';
                }elseif(substr($i->tanggal_upload,4,2) == '07'){
                    echo 'JULI ';
                }elseif(substr($i->tanggal_upload,4,2) == '08'){
                    echo 'AGUSTUS ';
                }elseif(substr($i->tanggal_upload,4,2) == '09'){
                    echo 'SEPTEMBER ';
                }elseif(substr($i->tanggal_upload,4,2) == '10'){
                    echo 'OKTOBER ';
                }elseif(substr($i->tanggal_upload,4,2) == '11'){
                    echo 'NOVEMBER ';
                }elseif(substr($i->tanggal_upload,4,2) == '12'){
                    echo 'DESEMBER ';
                } 
            ?>
            {{substr($i->tanggal_upload,0,4)}}
            </span>
        </li>
        <li>
            <strong>Keterangan</strong>
            <span style="background:red;color:#fff"><?php if($i->keterangan == ''){ echo 'Belum Ada Catatan';}else{ echo $i->keterangan; } ?></span>
        </li>
    </ul>
    @endforeach
</div>


<div class="section full mb-3">
    <div class="section-title">Dokumen Pendukung</div>
    <div class="carousel-multiple owl-carousel owl-theme">
        @foreach ($select as $item)
        <?php $gambar = DB::table('gambar')->where('id_gambar',$item->id_gambar)->get(); ?>
            @foreach ($gambar as $g)
                @if(substr($g->nama_gambar,-3,3) == 'png' or substr($g->nama_gambar,-3,3) == 'jpg' or substr($g->nama_gambar,-3,3) == 'jpeg')
                    <a href="#" class="item" data-toggle="modal" data-target="#LAP{{$g->id}}">
                        <img src="{{URL::to('/').'/public/jpg.png'}}" alt="alt" class="imaged w-100">
                    </a>
                @else
                    <a href="#" class="item" data-toggle="modal" data-target="#LAP1{{$g->id}}">
                        <img src="{{URL::to('/').'/public/pdf.png'}}" alt="alt" class="imaged w-100">
                    </a>
                @endif
            @endforeach      
        @endforeach
    </div>
</div>

@foreach ($select as $item)
<?php 
    $gambar = DB::table('gambar')->where('id_gambar',$item->id_gambar)->get(); 
    $gambarcount = DB::table('gambar')->where('id_gambar',$item->id_gambar)->count(); 
    $arraygambar[] = array();
    $namagambar[] = array();
?>
    @foreach ($gambar as $g)
    <?php $arraygambar[] .= $g->gambar.'/'.$g->nama_gambar; ?>
    <?php $namagambar[] .= $g->nama_gambar; ?>
        @if(substr($g->nama_gambar,-3,3) == 'png' or substr($g->nama_gambar,-3,3) == 'jpg' or substr($g->nama_gambar,-3,3) == 'jpeg')
        <div class="modal fade action-sheet" id="LAP{{$g->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dokumen Pendukung</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="section full mb-2">
                                <div class="content-header mb-05">
                                     {{$g->nama_gambar}}
                                </div>
                                <div class="wide-block p-0">
                                    <img src="<?php echo $g->gambar.'/'.$g->nama_gambar ?>" alt="alt" class="imaged w-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="modal fade action-sheet" id="LAP1{{$g->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Dokumen Pendukung</h5>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="section full mb-2">
                                <div class="content-header mb-05">
                                    {{$g->nama_gambar}}
                                </div>
                                <div class="wide-block p-0">
                                    {{-- <iframe src=" echo $g->gambar.'/'.$g->nama_gambar" width="100%" height="350px"></iframe> --}}
                                    
                                    Untuk Melihat File Silahkan Klik Tombol Ini.<br />
                                    <a class="btn btn-warning btn-sm" href="intent://<?php echo substr($g->gambar,7,-14).'/'.$g->nama_gambar; ?>#Intent;package=com.android.chrome;scheme=https;end">Disini</a>
                                    <?php echo substr($g->gambar,7,-14);  ?>
                                    {{-- <canvas id="pdf_view{{$g->id}}"></canvas> --}}
                                    {{-- <iframe id="pdf{{$g->id}}" src="<?php// echo $g->gambar.'/'.$g->nama_gambar ?>" width="100%" height="350px"></iframe> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endforeach      
@endforeach

<div class="section full mb-3">
    <div class="wide-block pb-1 pt-1">
        <div class="form-group basic">
            <a class="btn btn-success btn-block btn-lg" href="#" data-toggle="modal" data-target="#edit">EDIT LAPORAN</a>
        </div>
        <div class="form-group basic">
            @foreach ($select as $h)
            <form action="{{Route('mobilelaporandestroy',[$h->id])}}" method="POST">
                @csrf
                <button onclick="return confirm('Yakin Ingin mengahapus Data Ini ?')" type="submit" class="btn btn-danger btn-block btn-lg">HAPUS LAPORAN</button>
            </form>          
            @endforeach
        </div>
    </div>
</div>

@foreach ($select as $m)
<div class="modal fade action-sheet" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Laporan</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="section full mb-2">
                            <form action="{{Route('mobilelaporandetailedit',[$kategori,$unit,$tahun,$bulan,$id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">BULAN <span class="text-danger">*</span></label>
                                        <select class="form-control custom-select" id="account1" name="bulan">
                                            <option <?php if($m->bulan == '01'){echo 'selected';} ?> value="01"> JANUARI</option>
                                            <option <?php if($m->bulan == '02'){echo 'selected';} ?> value="02"> FEBRUARI</option>
                                            <option <?php if($m->bulan == '03'){echo 'selected';} ?> value="03"> MARET</option>
                                            <option <?php if($m->bulan == '04'){echo 'selected';} ?> value="04"> APRIL</option>
                                            <option <?php if($m->bulan == '05'){echo 'selected';} ?> value="05"> MEI</option>
                                            <option <?php if($m->bulan == '06'){echo 'selected';} ?> value="06"> JUNI</option>
                                            <option <?php if($m->bulan == '07'){echo 'selected';} ?> value="07"> JULI</option>
                                            <option <?php if($m->bulan == '08'){echo 'selected';} ?> value="08"> AGUSTUS</option>
                                            <option <?php if($m->bulan == '09'){echo 'selected';} ?> value="09"> SEPTEMBER</option>
                                            <option <?php if($m->bulan == '10'){echo 'selected';} ?> value="10"> OKTOBER</option>
                                            <option <?php if($m->bulan == '11'){echo 'selected';} ?> value="11"> NOVEMBER</option>
                                            <option <?php if($m->bulan == '12'){echo 'selected';} ?> value="12"> DESEMBER</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                    <label class="label" for="nomorlp">NOMOR IRSMS <span class="text-danger">*</span></label>
                                        <input value="{{$m->noirsms}}" required type="text" class="form-control" style="text-transform: uppercase" id="noirsms" name="noirsms">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                    <label class="label" for="nomorlp">TANGGAL IRSMS <span class="text-danger">*</span></label>
                                    <input value="{{substr($m->tglirsms,6,2).'-'.substr($m->tglirsms,4,2).'-'.substr($m->tglirsms,0,4)}}" required type="text" class="form-control"  name="tglirsms" placeholder="...">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                    <label class="label" for="nomorlp">NOMOR LP <span class="text-danger">*</span></label>
                                        <input value="{{$m->nomor_lp}}" required type="text" class="form-control" style="text-transform: uppercase" id="nomorlp" name="nomor_lp">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                    <label class="label" for="nomorlp">TANGGAL KEJADIAN PERKARA <span class="text-danger">*</span></label>
                                    <input value="{{substr($m->tanggal_kejadian,6,2).'-'.substr($m->tanggal_kejadian,4,2).'-'.substr($m->tanggal_kejadian,0,4)}}" required type="text" class="form-control"  name="tgl1" placeholder="...">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="account1">PENYELESAIAN PERKARA <span class="text-danger">*</span></label>
                                        <select class="form-control custom-select" id="account1" name="penyelesaianperkara">
                                            <option <?php if($m->kategori == 'P21'){echo 'selected';} ?> value="P21"> P21</option>
                                            <option <?php if($m->kategori == 'SP3'){echo 'selected';} ?> value="SP3"> SP3</option>
                                            <option <?php if($m->kategori == 'RJ'){echo 'selected';} ?> value="RJ"> RJ</option>
                                            @if(Session::get('status') == 'Administrator')
                                            <option <?php if($m->kategori == 'ADR'){echo 'selected';} ?> value="ADR"> ADR</option>
                                            @endif
                                            <option <?php if($m->kategori == 'DIVERSI'){echo 'selected';} ?> value="DIVERSI"> DIVERSI</option>
                                            <option <?php if($m->kategori == 'LIMPAH'){echo 'selected';} ?> value="LIMPAH"> LIMPAH</option>
                                            <option <?php if($m->kategori == 'SP2 LIDIK'){echo 'selected';} ?> value="SP2 LIDIK"> SP2 LIDIK</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                    <label required class="label" for="nomorlp">TANGGAL PENYELESAIAN PERKARA <span class="text-danger">*</span></label>
                                        <input value="{{substr($m->tanggal_penyelesaian,6,2).'-'.substr($m->tanggal_penyelesaian,4,2).'-'.substr($m->tanggal_penyelesaian,0,4)}}" type="text" class="form-control" name="tgl2" placeholder="...">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">UPLOAD LAPORAN POLISI (PDF/JPG Max File 10M)<span class="text-danger">*</span></label>
                                        &nbsp;
                                        <input name="laporan1" style="display: none" value="{{$namagambar[1]}}">
                                        <input type="file" name="laporan" class="dropify" data-max-file-size="10M" data-default-file="<?php echo $arraygambar[1]; ?>"/>
                                    </div>
                                </div>
                                @if(Session::get('status') == 'Administrator' and $namagambar == false and $arraygambar == false)
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">UPLOAD RESUME (PDF/JPG Max File 10M)<span class="text-danger">*</span></label>
                                        &nbsp;
                                        <input name="resume1" style="display: none" value="{{$namagambar[3]}}">
                                        <input type="file" name="resume" class="dropify" data-max-file-size="10M" data-default-file="<?php echo $arraygambar[3]; ?>"/>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">UPLOAD SELRA (PDF/JPG Max File 10M)<span class="text-danger">*</span> </label>
                                        &nbsp;
                                        <input name="selra1" style="display: none" value="{{$namagambar[2]}}">
                                        <input  type="file" name="selra" class="dropify" data-max-file-size="10M" data-default-file="<?php echo $arraygambar[2]; ?>"/>
                                    </div>
                                </div>
                    
                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-success btn-block btn-lg">SIMPAN</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endforeach
@endsection

@section('css')
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.5.207/build/pdf.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{asset('public/mobile/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
<style>
	.pdfobject-container { height: 500px;}
	.pdfobject { border: 1px solid #666; }
</style>

@endsection

@section('js')
<script>
    window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@2.5.207/build/pdf.worker.js';
</script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/locale/af.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>


<script type="text/javascript">
        @foreach($gambar as $g)
            @if(substr($g->nama_gambar,-3,3) == 'pdf')
            pdfjsLib.getDocument('./././././././public/LAPORAN/POLRES-BANDUNG/2020/AGUSTUS/26/NO-213/LAPORAN-349278002.pdf').then(doc =>{
                    console.log('{{$g->gambar."/".$g->nama_gambar}}');
                    doc.getPage(1).then(page =>{
                        var mycanvas = document.getElementById('pdf_view{{$g->id}}');
                        var context = mycanvas.getContext('2d');
                        var viewport = page.getViewport('1');
                        mycanvas.width = viewport.width;
                        mycanvas.height = viewport.height;
                        page.render({
                            canvasContext : context,
                            Viewport : Viewport
                        });
                    });
                });
            @endif
        @endforeach
    $(document).ready(function() {
        $('.dropify').dropify();

    });
    function info(){
        $('#loading').modal('show');
    }
</script>
@endsection