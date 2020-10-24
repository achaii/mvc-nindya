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
<div class="section mt-4">
    @if(Session::get('status') == 'Administrator' or Session::get('status') == 'Kasubdit')
<div class="row mt-2">
    <div class="col-12">
        <div class="stat-box">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="account1">UNIT</label>
                    <select class="form-control custom-select" id="unit" name="unit">
                        @foreach ($units as $item)
                            <option <?php if($item->id == $unit){echo 'selected';} ?> value="{{$item->id}}"> {{$item->nama_unit}}</option>     
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
</div>
</div>
@else
<input name="unit" id="unit" style="display: none" value="{{Session::get('id_unit')}}"/>
@endif
<div class="row mt-2">
    <div class="col-12">
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
<br>
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Laporan Statistik(%)</h2>
        <a href="#" class="link btn btn-primary" data-toggle="modal" data-target="#LAP">Dalam Tabel</a>
    </div>
    <div class="row mt-2">
        <div class="col-12 ">
            <div class="stat-box">
          <div class="chartjs-wrapper-demo"><canvas id="chartBar"></canvas></div>
            </div><!-- col-6 -->
        </div>
      </div><!-- row -->
</div>

<div class="modal fade action-sheet" id="LAP" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Statistik {{$tahun}}</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="section full mb-2">
                        <div class="content-header mb-05">
                            Formula <code>(Total Selra Polres / Total Kejadian IRSMS)*100</code>
                        </div>
                        <div class="wide-block p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Selra Polres</th>
                                            <th scope="col">Kejadian IRSMS</th>
                                            <th scope="col">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $a = array('01','02','03','04','05','06','07','08','09','10','11','12');
                                            $t = array();
                                        ?>
                                        @foreach ($a as $bu)
                                        <tr>
                                            <th scope="row">
                                                <?php 
                                                    if($bu == '01'){
                                                        echo 'JANUARI';
                                                    }elseif($bu == '02'){
                                                        echo 'FEBRUARI';
                                                    }elseif($bu == '03'){
                                                        echo 'MARET';
                                                    }elseif($bu == '04'){
                                                        echo 'APRIL';
                                                    }elseif($bu == '05'){
                                                        echo 'MEI';
                                                    }elseif($bu == '06'){
                                                        echo 'JUNI';
                                                    }elseif($bu == '07'){
                                                        echo 'JULI';
                                                    }elseif($bu == '08'){
                                                        echo 'AGUSTUS';
                                                    }elseif($bu == '09'){
                                                        echo 'SEPTEMBER';
                                                    }elseif($bu == '10'){
                                                        echo 'OKTOBER';
                                                    }elseif($bu == '11'){
                                                        echo 'NOVEMBER';
                                                    }elseif($bu == '12'){
                                                        echo 'DESEMBER';
                                                    } 
                                                ?>
                                            </th>
                                            <td>
                                                <?php 
                                                    $nilai = DB::table('perkara')
                                                    ->where('id_unit',$unit)
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bu.'%')
                                                    ->count();    
                                                    echo $nilai;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $jml = DB::table('selra')
                                                        ->where('id_unit',$unit)
                                                        ->where('bulan',$bu)
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
                                                    $t = ($nilai!=0 and $jam!=0) ? round(($nilai / $jam) * 100,2):0;    
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
        </div>
    </div>
</div>
</br>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" rel="stylesheet">
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
        {{-- <script src="{{asset('public/mobile/js/jquery.min.js')}}"></script> --}}
        <script src="{{asset('public/mobile/js/Chart.bundle.min.js')}}"></script>
        <script>
    
    var ctx4 = document.getElementById('chartBar').getContext('2d');
    new Chart(ctx4, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'Capaian ',
          data: [<?php echo $jahanam; ?>],
          backgroundColor: '#007bff',
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
              fontSize: 12,
              //mirror:true
            }
          }],
          xAxes: [{
            ticks: {
              beginAtZero:true,
              fontSize: 11,
              max: 100
            }
          }]
        }
      }
    });
    </script>

    <script>
        $('select[name=tahun]').change(function(){
            var tahun = document.getElementById('tahun').value;
            var unit = document.getElementById('unit').value;
            window.location.href = "{{ URL::to('mobile-view/laporan-tahun') }}" + "/" + unit + "/" + tahun 
        }); 

        $('select[name=unit]').change(function(){
            var tahun = document.getElementById('tahun').value;
            var unit = document.getElementById('unit').value;
            window.location.href = "{{ URL::to('mobile-view/laporan-tahun') }}" + "/" + unit + "/" + tahun 
        }); 
    </script>
@endsection