@extends('layouts.mobile')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="{{Route('mobilepagelaporan')}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        LAPORAN BULANAN
    </div>
</div>
@endsection

@section('content')
<div class="section">
    <div class="section-heading">
    </div>
        <div class="row mt-2">
            <div class="col-6">
                <div class="stat-box">
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label class="label" for="account1">BULAN</label>
                        <select class="form-control custom-select" id="bulan" name="bulan">
                            <option <?php if($bulan == '01'){echo 'selected';} ?> value="01"> JANUARI</option>
                            <option <?php if($bulan == '02'){echo 'selected';} ?> value="02"> FEBRUARI</option>
                            <option <?php if($bulan == '03'){echo 'selected';} ?> value="03"> MARET</option>
                            <option <?php if($bulan == '04'){echo 'selected';} ?> value="04"> APRIL</option>
                            <option <?php if($bulan == '05'){echo 'selected';} ?> value="05"> MEI</option>
                            <option <?php if($bulan == '06'){echo 'selected';} ?> value="06"> JUNI</option>
                            <option <?php if($bulan == '07'){echo 'selected';} ?> value="07"> JULI</option>
                            <option <?php if($bulan == '08'){echo 'selected';} ?> value="08"> AGUSTUS</option>
                            <option <?php if($bulan == '09'){echo 'selected';} ?> value="09"> SEPTEMBER</option>
                            <option <?php if($bulan == '10'){echo 'selected';} ?> value="10"> OKTOBER</option>
                            <option <?php if($bulan == '11'){echo 'selected';} ?> value="11"> NOVEMBER</option>
                            <option <?php if($bulan == '12'){echo 'selected';} ?> value="12"> DESEMBER</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-6">
                <div class="stat-box">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="account1">TAHUN </label>
                            <select class="form-control custom-select" id="tahun" name="tahun">
                                @foreach ($atahun as $s)
                                    <option <?php if($s->tahun == $tahun){echo 'selected';} ?> value="{{$s->tahun}}"> {{$s->tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
    </div>
  </div>

<div class="section">
        <div class="row mt-2">
            <div class="listview-title">LAPORAN STATISTIK BULANAN</div>
            <div class="col-12">
                <div class="stat-box">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">POLRES</th>
                                    <th scope="col">P21</th>
                                    <th scope="col">SP3</th>
                                    <th scope="col">RJ</th>
                                    <th scope="col">SP2 LIDIK</th>
                                    <th scope="col">DIVERSI</th>
                                    <th scope="col">LIMPAH</th>
                                    <th scope="col">JML SELRA</th>
                                    <th scope="col">JML KJDN</th>
                                    <th scope="col">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $un)
                                <tr>
                                    <td scope="row">
                                        <font size="1">{{$un->nama_unit}}</font>
                                    </td>
                                    <td>
                                        <?php 
                                            $p21 = DB::table('perkara')
                                            ->where('id_unit',$un->id)
                                            ->where('kategori','P21')
                                            ->where('status','Data Valid')
                                            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                            ->count();    
                                            echo $p21;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $sp3 = DB::table('perkara')
                                            ->where('id_unit',$un->id)
                                            ->where('kategori','SP3')
                                            ->where('status','Data Valid')
                                            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                            ->count();    
                                            echo $sp3;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $rj = DB::table('perkara')
                                            ->where('id_unit',$un->id)
                                            ->where('kategori','RJ')
                                            ->where('status','Data Valid')
                                            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                            ->count();    
                                            echo $rj;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $sp2lidik = DB::table('perkara')
                                            ->where('id_unit',$un->id)
                                            ->where('kategori','SP2 LIDIK')
                                            ->where('status','Data Valid')
                                            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                            ->count();    
                                            echo $sp2lidik;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $diversi = DB::table('perkara')
                                            ->where('id_unit',$un->id)
                                            ->where('kategori','DIVERSI')
                                            ->where('status','Data Valid')
                                            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                            ->count();    
                                            echo $diversi;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $limpah = DB::table('perkara')
                                            ->where('id_unit',$un->id)
                                            ->where('kategori','LIMPAH')
                                            ->where('status','Data Valid')
                                            ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                            ->count();    
                                            echo $limpah;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $total = $p21 + $sp3 + $rj + $sp2lidik + $diversi + $limpah;
                                            echo $total;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        $jml = DB::table('selra')
                                                ->where('id_unit',$un->id)
                                                ->where('bulan',$bulan)
                                                ->where('tahun',$tahun)
                                                ->first();
    
                                        if($jml == null){
                                            $jam = 0;
                                        }else{
                                            $jam = $jml->jmlselra;
                                        }
    
                                        echo $jam;
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $t = ($total!=0 and $jam!=0) ? round(($total / $jam) * 100,2):0;    
                                            echo $t;
                                        ?>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</div>
</br>
@endsection

@section('css')
    
@endsection

@section('js')
<script>
  $('select[name=bulan]').change(function(){
      var bulan = document.getElementById('bulan').value;
      var tahun = document.getElementById('tahun').value;

      window.location.href = "{{ URL::to('mobile-view/laporan-bulan') }}" + "/" + tahun + "/" + bulan 
  }); 

  $('select[name=tahun]').change(function(){
      var bulan = document.getElementById('bulan').value;
      var tahun = document.getElementById('tahun').value;

      window.location.href = "{{ URL::to('mobile-view/laporan-bulan') }}" + "/" + tahun + "/" + bulan 
  }); 

  $('select[name=unit]').change(function(){
      var bulan = document.getElementById('bulan').value;
      var tahun = document.getElementById('tahun').value;

      window.location.href = "{{ URL::to('mobile-view/laporan-bulan') }}" + "/" + tahun + "/" + bulan 
  }); 
</script> 
@endsection