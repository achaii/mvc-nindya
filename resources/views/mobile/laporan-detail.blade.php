@extends('layouts.mobile')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="{{Route('mobilepagelaporan')}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        LAPORAN {{$kategori}}
    </div>
</div>
@endsection

@section('content')
<div class="section mt-2">
    <div class="section-heading">
    </div>
    @if(Session::get('status') == 'Kasubdit' or Session::get('status') == 'Administrator')
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


<div class="listview-title mt-2">LAPORAN
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
    {{$tahun}}</div>
<ul class="listview image-listview">

@forelse ($select as $i)
<li>
    <a href="{{Route('mobilelaporandetailview',[$kategori,$unit,$tahun,$bulan,$i->id])}}" class="item">
        <div class="icon-box 
        <?php 
            if($i->status == 'Menunggu Validasi'){
                echo 'bg-warning';
            }elseif($i->status == 'Data Tidak Valid'){
                echo 'bg-danger';    
            }elseif($i->status == 'Data Valid'){
                echo 'bg-success';
            }
        ?>
        ">
            <ion-icon name="alarm"></ion-icon>
        </div>
        <div class="in">
            <div>
                <header>{{$i->nomor_lp}}</header>
                Tgl Kejadian. {{substr($i->tanggal_kejadian,6,2).'-'.substr($i->tanggal_kejadian,4,2).'-'.substr($i->tanggal_kejadian,0,4)}} <br>
                Tgl Penyelesaian. {{substr($i->tanggal_penyelesaian,6,2).'-'.substr($i->tanggal_penyelesaian,4,2).'-'.substr($i->tanggal_penyelesaian,0,4)}}
                <footer>{{$i->status}}</footer>
            </div>
            <span class="text-muted">Lihat</span>
        </div>
    </a>
</li>
@empty
<li>
    <a href="#" class="item">
        <div class="in">
            <div>Data di Tidak Temukan</div>
        </div>
    </a>
</li>
@endforelse

</ul>

@endsection

@section('footer')
    
@endsection

@section('css')
    
@endsection

@section('js')
   <script>
        $('select[name=bulan]').change(function(){
            var bulan = document.getElementById('bulan').value;
            var tahun = document.getElementById('tahun').value;
            var unit = document.getElementById('unit').value;
            var kategori = '{{$kategori}}';

            window.location.href = "{{ URL::to('mobile-view/laporan-detail') }}" + "/" + kategori + "/" + unit + "/" + tahun + "/" + bulan 
        }); 

        $('select[name=tahun]').change(function(){
            var bulan = document.getElementById('bulan').value;
            var tahun = document.getElementById('tahun').value;
            var unit = document.getElementById('unit').value;
            var kategori = '{{$kategori}}';

            window.location.href = "{{ URL::to('mobile-view/laporan-detail') }}" + "/" + kategori + "/" + unit + "/" + tahun + "/" + bulan 
        }); 

        $('select[name=unit]').change(function(){
            var bulan = document.getElementById('bulan').value;
            var tahun = document.getElementById('tahun').value;
            var unit = document.getElementById('unit').value;
            var kategori = '{{$kategori}}';

            window.location.href = "{{ URL::to('mobile-view/laporan-detail') }}" + "/" + kategori + "/" + unit + "/" + tahun + "/" + bulan 
        }); 
   </script> 
@endsection