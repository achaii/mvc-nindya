@extends('layouts.web')

@section('title')
    <h2 class="az-content-title tx-24 mg-b-5">Selamat Datang!</h2>
    <p class="mg-b-20 mg-lg-b-25">Managemen Dashboard Selra {{Session::get('tahun')}}</p>
@endsection

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12">
      <div class="card card-dashboard-eighteen">
        <h6 class="card-title mg-b-5">Pencarian Data Statistik</h6>
        <p class="tx-gray-500 mg-b-0">Laporan Bulanan</p>
        <div class="card-body row row-xs">
          <form method="POST" action="{{Route('webdashboard')}}">
            @csrf
            <div class="row row-sm">
              <div class="col-lg">
                <label>TAHUN <span class="tx-danger">*</span></label>
                  <select class="form-control" id="btahun" name="tahun">   
                    @foreach ($atahun as $t)
                        <option <?php if($t->tahun == Session::get('tahun')){ echo 'selected';} ?> value="{{$t->tahun}}">{{$t->tahun}}</option>  
                    @endforeach                                         
                  </select>
              </div><!-- col -->
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
              </div><!-- col -->
              <div class="col-lg">
                <label>UNIT</label>
                <select class="form-control" id="unit" name="unit">
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
          </form>
        </div>
        <h6 class="card-title mg-b-10">Laporan Statistik Tahunan Per-Polres (%)</h6>
        <div class="chartjs-wrapper-demo">
          <canvas id="chartArea1"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-12 mg-t-20">
      <div class="card card-dashboard-eighteen">
        <h6 class="card-title mg-b-5">Laporan Statistik Bulanan Per-Polres</h6>
        <p class="tx-gray-500 mg-b-0">Laporan Bulanan</p>
        <div class="card-body row row-xs">
          <div class="col-6">
            <h6 class="dot-primary">{{$jmlselras}}</h6>
            <label>Total Kejadian IRSMS</label>
          </div>
          <div class="col-6">
            <h6 class="dot-purple">{{$jmlperkaras}}</h6>
            <label>Total Selra Polres</label>
          </div>
        </div>
        <h6 class="card-title mg-b-20">Capaian Polres (%)</h6>
        <div class="chartjs-wrapper-demo">
          <canvas id="chartBar5"></canvas>
        </div>
      </div>
    </div>

    <div class="col-lg-12 mg-t-20">
      <div class="card card-dashboard-twenty ht-md-100p">
        <div class="card-body">
          <h6 class="az-content-label tx-13 mg-b-5">Tabel Laporan Selralaka <span>({{Session::get('tahun')}})</span></h6>
          <p class="mg-b-25">Laporan Selralaka Bulan Berjalan</p>
          <table id="managamentunit" class="display responsive table table-hover table-striped table-bordered" width="100%">
            <thead>
                <tr>
                  <th rowspan="2" class="wd-5p">NO</th>
                  <th rowspan="2" class="wd-20p" data-priority="1">POLRES</th>
                  <th colspan="8" style="text-align: center">SELRA</th>
                  <th rowspan="2" class="wd-5p">JML SERLA</th>
                  <th rowspan="2" class="wd-5p">KJDN IRSMS</th>
                  <th rowspan="2" class="wd-5p" data-priority="1">CAPAIAN</th>
                  <th rowspan="2" class="wd-5p">KETERANGAN</th>
                </tr>
                <tr>
                    <th class="wd-5p">P21</th>
                    <th class="wd-5p">SP3</th>
                    <th class="wd-5p">ADR</th>
                    <th class="wd-5p">BAS</th>
                    <th class="wd-5p">DIVERSI</th>
                    <th class="wd-5p">LIMPAH</th>
                    <th class="wd-5p">RJ</th>
                    <th class="wd-5p">SP2 LIDIK</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unit as $sel)
                <tr style="padding: 5px">
                    <td style="padding: 5px;text-align: center">{{$no++}}</td>
                    <td style="padding: 5px">{{$sel->nama_unit}}</td>
                    <td>
                      <?php 
                          $p21 = DB::table('perkara')
                          ->where('kategori','p21')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $p21data = DB::table('perkara')
                          ->where('kategori','p21')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
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
                                                  <table id="datap21table{{$sel->id}}" class="display responsive table table-hover table-striped table-bordered" width="100%">
                                                      <thead>
                                                          <tr>
                                                              <th class="wd-5p">IRSMS & LP</th>
                                                              <th class="wd-5p">Dokumen Pendukung</th>
                                                              <th class="wd-5p">#</th>
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
                                                            <hr>
                                                            @if($p21da->status == 'Data Valid')
                                                            <a href="" style="color:green">{{$p21da->status}}</a>
                                                            @else
                                                            <a href="" style="color:red">{{$p21da->status}}</a>
                                                            @endif
                                                            </td>
                                                            <td>
                                                            <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$p21da->id])}}">
                                                                @csrf
                                                                <input name="id" value="{{$p21da->id}}" style="display: none">
                                                                <select class="form-control" name="validasi">   
                                                                    <option <?php if($p21da->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                    <option <?php if($p21da->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                                </select>
                                                                <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$p21da->keterangan}}</textarea>
                                                                <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                    <i class="typcn typcn-input-checked"></i>
                                                                </button>
                                                            </form>
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
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $sp3data = DB::table('perkara')
                          ->where('kategori','sp3')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
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
                                                          <th class="wd-5p">#</th>
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
                                                        <hr>
                                                        @if($sp3da->status == 'Data Valid')
                                                        <a href="" style="color:green">{{$sp3da->status}}</a>
                                                        @else
                                                        <a href="" style="color:red">{{$sp3da->status}}</a>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$sp3da->id])}}">
                                                            @csrf
                                                            <input name="id" value="{{$sp3da->id}}" style="display: none">
                                                            <select class="form-control" name="validasi">   
                                                                <option <?php if($sp3da->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                <option <?php if($sp3da->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                            </select>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$sp3da->keterangan}}</textarea>
                                                            <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                <i class="typcn typcn-input-checked"></i>
                                                            </button>
                                                        </form>
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
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $adrdata = DB::table('perkara')
                          ->where('kategori','adr')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
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
                                                          <th class="wd-5p">#</th>
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
                                                        <hr>
                                                        @if($adrda->status == 'Data Valid')
                                                        <a href="" style="color:green">{{$adrda->status}}</a>
                                                        @else
                                                        <a href="" style="color:red">{{$adrda->status}}</a>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$adrda->id])}}">
                                                            @csrf
                                                            <input name="id" value="{{$adrda->id}}" style="display: none">
                                                            <select class="form-control" name="validasi">   
                                                                <option <?php if($adrda->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                <option <?php if($adrda->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                            </select>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$adrda->keterangan}}</textarea>
                                                            <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                <i class="typcn typcn-input-checked"></i>
                                                            </button>
                                                        </form>
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
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $basdata = DB::table('perkara')
                          ->where('kategori','bas')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
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
                                                          <th class="wd-5p">#</th>
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
                                                        <hr>
                                                        @if($basda->status == 'Data Valid')
                                                        <a href="" style="color:green">{{$basda->status}}</a>
                                                        @else
                                                        <a href="" style="color:red">{{$basda->status}}</a>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$basda->id])}}">
                                                            @csrf
                                                            <input name="id" value="{{$basda->id}}" style="display: none">
                                                            <select class="form-control" name="validasi">   
                                                                <option <?php if($basda->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                <option <?php if($basda->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                            </select>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$basda->keterangan}}</textarea>
                                                            <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                <i class="typcn typcn-input-checked"></i>
                                                            </button>
                                                        </form>
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
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $diversidata = DB::table('perkara')
                          ->where('kategori','diversi')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
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
                                                          <th class="wd-5p">#</th>
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
                                                        <hr>
                                                        @if($diversida->status == 'Data Valid')
                                                        <a href="" style="color:green">{{$diversida->status}}</a>
                                                        @else
                                                        <a href="" style="color:red">{{$diversida->status}}</a>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$diversida->id])}}">
                                                            @csrf
                                                            <input name="id" value="{{$diversida->id}}" style="display: none">
                                                            <select class="form-control" name="validasi">   
                                                                <option <?php if($diversida->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                <option <?php if($diversida->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                            </select>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$diversida->keterangan}}</textarea>
                                                            <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                <i class="typcn typcn-input-checked"></i>
                                                            </button>
                                                        </form>
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
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $limpahdata = DB::table('perkara')
                          ->where('kategori','limpah')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')    
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
                                                          <th class="wd-5p">#</th>
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
                                                        <hr>
                                                        @if($limpahda->status == 'Data Valid')
                                                        <a href="" style="color:green">{{$limpahda->status}}</a>
                                                        @else
                                                        <a href="" style="color:red">{{$limpahda->status}}</a>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$limpahda->id])}}">
                                                            @csrf
                                                            <input name="id" value="{{$limpahda->id}}" style="display: none">
                                                            <select class="form-control" name="validasi">   
                                                                <option <?php if($limpahda->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                <option <?php if($limpahda->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                            </select>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$limpahda->keterangan}}</textarea>
                                                            <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                <i class="typcn typcn-input-checked"></i>
                                                            </button>
                                                        </form>
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
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $rjdata = DB::table('perkara')
                          ->where('kategori','rj')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
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
                                                          <th class="wd-5p">#</th>
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
                                                        <hr>
                                                        @if($rjda->status == 'Data Valid')
                                                        <a href="" style="color:green">{{$rjda->status}}</a>
                                                        @else
                                                        <a href="" style="color:red">{{$rjda->status}}</a>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$rjda->id])}}">
                                                            @csrf
                                                            <input name="id" value="{{$rjda->id}}" style="display: none">
                                                            <select class="form-control" name="validasi">   
                                                                <option <?php if($rjda->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                <option <?php if($rjda->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                            </select>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$rjda->keterangan}}</textarea>
                                                            <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                <i class="typcn typcn-input-checked"></i>
                                                            </button>
                                                        </form>
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
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')                             
                          ->where('status','Data Valid')
                          ->where('id_unit',$sel->id)
                          ->count();

                          $sp2lidikdata = DB::table('perkara')
                          ->where('kategori','sp2 lidik')
                          ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')                             
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
                                                          <th class="wd-5p">#</th>
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
                                                        <hr>
                                                        @if($sp2lidikda->status == 'Data Valid')
                                                        <a href="" style="color:green">{{$sp2lidikda->status}}</a>
                                                        @else
                                                        <a href="" style="color:red">{{$sp2lidikda->status}}</a>
                                                        @endif
                                                        </td>
                                                        <td>
                                                        <form method="POST" action="{{Route('weblaporanperiodebulanupdate',[$sp2lidikda->id])}}">
                                                            @csrf
                                                            <input name="id" value="{{$sp2lidikda->id}}" style="display: none">
                                                            <select class="form-control" name="validasi">   
                                                                <option <?php if($sp2lidikda->status == 'Data Valid'){ echo 'selected';} ?> value="Data Valid"> Data Valid</option>
                                                                <option <?php if($sp2lidikda->status == 'Data Tidak Valid'){ echo 'selected';} ?> value="Data Tidak Valid"> Data Tidak Valid</option>
                                                            </select>
                                                            <textarea name="keterangan" class="form-control" rows="4" cols="60">{{$sp2lidikda->keterangan}}</textarea>
                                                            <button type="submit" class="btn btn-primary btn-with-icon btn-block">
                                                                <i class="typcn typcn-input-checked"></i>
                                                            </button>
                                                        </form>
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
                    <td style="padding: 5px">
                        <?php 
                            $total = $p21 + $sp3 + $adr + $bas + $rj + $diversi + $sp2lidik + $limpah;
                            if($total == 0){
                                echo '-';
                            }else{
                                echo $total; 
                            }   
                        ?>
                    </td>
                    <td style="padding: 5px">
                        <?php 
                            $kejadian = DB::table('selra')
                            ->where('id_unit',$sel->id)
                            ->where('bulan',Session::get('bulan'))
                            ->where('tahun',Session::get('tahun'))
                            ->first();
                            //dd($kejadian->jmlselra);
                        ?>
                        @if ($kejadian == null or $kejadian == '0')
                            - 
                        @else
                            {{$kejadian->jmlselra}}
                        @endif
                    </td>
                    <td style="padding: 5px">
                        <?php
                            if($kejadian == null){
                                $jamm = 0;
                            }else{
                                $jamm = $kejadian->jmlselra;
                            }
                            $persentase = ($total!=0 and $jamm!=0) ? round(($total / $jamm) * 100,2) :0;
                            echo $persentase.'%';
                        ?>
                    </td>
                    <td style="padding: 5px">
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
                </tr>  
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <?php 

                        (int)$A = 0;
                        (int)$B = 0;
                        (int)$C = 0;
                        (int)$D = 0;
                        (int)$E = 0;
                        (int)$F = 0;
                        (int)$G = 0;
                        (int)$H = 0;
                        (int)$I = 0;

                        foreach ($unit as $sel) {
                            $p21data = DB::table('perkara')
                            ->where('kategori','p21')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $A = $A + $p21data;

                            $sp3data = DB::table('perkara')
                            ->where('kategori','sp3')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $B = $B + $sp3data;

                            $adrdata = DB::table('perkara')
                            ->where('kategori','adr')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $C = $C + $adrdata;

                            $basdata = DB::table('perkara')
                            ->where('kategori','bas')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $D = $D + $basdata;

                            $diversidata = DB::table('perkara')
                            ->where('kategori','diversi')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $E = $E + $diversidata;

                            $limpahdata = DB::table('perkara')
                            ->where('kategori','limpah')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')    
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $F = $F + $limpahdata;

                            $rjdata = DB::table('perkara')
                            ->where('kategori','rj')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $G = $G + $rjdata;

                            $sp2lidikdata = DB::table('perkara')
                            ->where('kategori','sp2 lidik')
                            ->where('tanggal_kejadian','LIKE',Session::get('tahun').Session::get('bulan').'%')                             
                            ->where('status','Data Valid')
                            ->where('id_unit',$sel->id)
                            ->count();

                            $H = $H + $sp2lidikdata;

                            $kejadian = DB::table('selra')
                            ->where('id_unit',$sel->id)
                            ->where('bulan',Session::get('bulan'))
                            ->where('tahun',Session::get('tahun'))
                            ->first();

                            $I = $I + $kejadian->jmlselra;
                        }    
                    ?>
                    <th></th>
                    <th>Total</th>
                    <th>{{$A}}</th>
                    <th>{{$B}}</th>
                    <th>{{$C}}</th>
                    <th>{{$D}}</th>
                    <th>{{$E}}</th>
                    <th>{{$F}}</th>
                    <th>{{$G}}</th>
                    <th>{{$H}}</th>
                    <th>{{ $A + $B + $C + $D + $E + $F + $G + $H }}</th>
                    <th>{{$I}}</th>
                    <th>
                        <?php 
                            $total_ = $A + $B + $C + $D + $E + $F + $G + $H;

                            $persentase_ = ($total_!=0 and $I!=0) ? round(($total_ / $I) * 100,2) :0;
                            echo $persentase_.'%';    
                        ?>
                    </th>
                    <th></th>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div><!-- row -->
@endsection

@section('css')
<link href="{{ asset('public/web/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/web/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{ asset('public/web/lib/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" rel="stylesheet">

<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

<style>
    .chartjs-wrapper-demo {
    height: 400px; }
@media (max-width: 330px) {
    .chartjs-wrapper-demo {
    width: 290px; } }
@media (min-width: 992px) {
    .chartjs-wrapper-demo {
    height: 300px; } }
</style>
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
  @foreach($unit as $sal)
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
                columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13 ]
            },
            messageTop: 'BULAN ' + {{Session::get('bulan')}} + ' ' + {{Session::get('tahun')}}
          },
          {
            extend: 'csv',
            exportOptions: {
                columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13 ]
            },
            messageTop: 'BULAN ' + {{Session::get('bulan')}} + ' ' + {{Session::get('tahun')}}
          },
          {
            extend: 'excel',
            exportOptions: {
                columns: [ 0,1,2,3,4,5,6,7,8,9,10,11,12,13 ]
            },
            messageTop: 'BULAN ' + {{Session::get('bulan')}} + ' ' + {{Session::get('tahun')}}
          },
        ],
        //'dom': 't',
        "responsive": true,
        "lengthMenu": [[-1], ["All"]],
        "searching": false,
        "bLengthChange" : false,
        "paging":   false,
        "ordering": false,
        "info":     false,
        "columnDefs": [{ 
            "searchable": false, "targets": 5 
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
});
</script>
<script src="{{asset('public/mobile/js/Chart.bundle.min.js')}}"></script>
<script type="text/javascript">
var ctx9 = document.getElementById('chartArea1').getContext('2d');
var gradient2 = ctx9.createLinearGradient(5, 71, 143, .3);
    gradient2.addColorStop(0, 'rgba(241,0,117,0)');
    gradient2.addColorStop(1, 'rgba(5,71,143,.3)');

new Chart(ctx9, {
  type: 'line',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
      data: [<?php echo $jahanam; ?>],
      borderColor: '#05478F',
      borderWidth: 1,
      backgroundColor: gradient2,
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
      display: false,
        labels: {
          display: false
        }
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero:true,
          fontSize: 10,
          max: 100
        }
      }],
      xAxes: [{
        ticks: {
          beginAtZero:true,
          fontSize: 11
        }
      }]
    }
  }
});

var ctx5 = document.getElementById('chartBar5').getContext('2d');
var gradient4 = ctx5.createLinearGradient(8, 75, 143, .3);
    gradient4.addColorStop(0, 'rgba(241,55,117,0)');
    gradient4.addColorStop(1, 'rgba(15,7,143,.3)');
  new Chart(ctx5, {
    type: 'line',
    data: {
      labels: [<?php echo $units; ?>],
      datasets: [{
        data: [<?php echo $nilais; ?>],
        backgroundColor: gradient4,
        borderColor: '#05478F',
        borderWidth: 1,
      }]
    },
    options: {
      maintainAspectRatio: false,
      legend: {
        display: false,
          labels: {
            display: false
          }
      },
      scales: {
        yAxes: [{
          ticks: {
            
            beginAtZero:true,
            fontSize: 11,
          }
        }],
        xAxes: [{
          stacked:false,
          ticks: {
            autoSkip:false,
            beginAtZero:false,
            fontSize: 10,
            max: 100,
            min:0,
            stepSize:1
          }
        }]
      }
    }
  });
</script>
@endsection