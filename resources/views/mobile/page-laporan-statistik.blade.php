@extends('layouts.mobile')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="{{Route('mobilepagelaporan')}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        LAPORAN TAHUNAN
    </div>
</div>
@endsection

@section('content')
<div class="section mt-4">
    <div class="section-heading">
        <h2 class="title">Laporan Statistik(%)</h2>
        <a href="#" class="link btn btn-primary" data-toggle="modal" data-target="#laporanpolres">Dalam Tabel</a>
    </div>
    <div class="row mt-2">
        <div class="col-12 ">
            <div class="stat-box">
                <div class="row mt-2">
                    <div class="col-6">
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
                    <div class="col-6">
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
                <br>
                <div class="chartjs-wrapper-demo">
                    <canvas id="cPolres"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade action-sheet" id="laporanpolres" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Laporan Statistik 
                    <?php 
                    if($bulan == '01'){
                       echo 'JANUARI';
                   }elseif($bulan == '02'){
                       echo 'FEBRUARI';
                   }elseif($bulan == '03'){
                       echo 'MARET';
                   }elseif($bulan == '04'){
                       echo 'APRIL';
                   }elseif($bulan == '05'){
                       echo 'MEI';
                   }elseif($bulan == '06'){
                       echo 'JUNI';
                   }elseif($bulan == '07'){
                       echo 'JULI';
                   }elseif($bulan == '08'){
                       echo 'AGUSTUS';
                   }elseif($bulan == '09'){
                       echo 'SEPTEMBER';
                   }elseif($bulan == '10'){
                       echo 'OKTOBER';
                   }elseif($bulan == '11'){
                       echo 'NOVEMBER';
                   }elseif($bulan == '12'){
                       echo 'DESEMBER';
                   }
               ?>
               {{' '.$tahun}}
                </h5>
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
                                            <th scope="col">Polres</th>
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
                                        @foreach ($unit as $bu)
                                        <tr>
                                            <th scope="row">
                                                <?php 
                                                    $find = array('POLRES ','POLRESTABES ','POLRESTA ');
                                                    echo str_replace($find,'',$bu->nama_unit);
                                                ?>
                                            </th>
                                            <td>
                                                <?php 
                                                    $nilai = DB::table('perkara')
                                                    ->where('id_unit',$bu->id)
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                    ->count();    
                                                    echo $nilai;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $jml = DB::table('selra')
                                                        ->where('id_unit',$bu->id)
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
            var ctx3 = document.getElementById('cPolres').getContext('2d');
            new Chart(ctx3,{
                type: 'line',
                data: {
                    labels: [<?php echo $units; ?>],
                    datasets: [{
                        label: 'Capaian ',
                        data: [<?php echo $nilais; ?>],
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
                                beginAtZero: true,
                                fontSize: 12,
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
    
        $('select[name=tahun]').change(function(){
            var tahun = document.getElementById('tahun').value;
            var bulan = document.getElementById('bulan').value;
            window.location.href = "{{ URL::to('mobile-view/laporan-statistik') }}" + "/" + tahun + "/" + bulan 
        }); 
    
        $('select[name=bulan]').change(function(){
            var tahun = document.getElementById('tahun').value;
            var bulan = document.getElementById('bulan').value;
            window.location.href = "{{ URL::to('mobile-view/laporan-statistik') }}" + "/" + tahun + "/" + bulan 
        }); 
        </script>
@endsection