@extends('layouts.mobile')

@section('header')
    @include('layouts.mobile-header')
@endsection

@section('content')
<div class="listview-title mt-1">LAPORAN SELRALAKA</div>
<?php 
    if(Session::get('status') == 'Anggota' or Session::get('status') == 'Kasat'){
        $units = Session::get('id_unit');
    }else{
        $units = '7';
    }
?>
<ul class="listview image-listview mb-2">
    @if(Session::get('status') == 'Kasubdit' or Session::get('status') == 'Administrator')
    <li>
        <a href="{{Route('mobilelaporanstatistik',[$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                LAPORAN TAHUNAN
            </div>
        </a>
    </li>
    @endif
    @if(Session::get('status') == 'Kasat' or Session::get('status') == 'Anggota')
    <li>
        <a href="{{Route('mobilelaporantahun',[$units,$tahun])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                LAPORAN BULANAN
            </div>
        </a>
    </li>
    @endif
    @if(Session::get('status') == 'Kasubdit' or Session::get('status') == 'Administrator')
    <li>
        <a href="{{Route('mobilelaporanbulan',[$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                LAPORAN BULANAN
            </div>
        </a>
    </li>
    @endif
</ul>
<div class="listview-title mt-1">LAPORAN</div>
<ul class="listview image-listview mb-2">
    <li>
        <a href="{{Route('mobilelaporandetail',['P21',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (P21)
            </div>
        </a>
    </li>
    <li>
        <a href="{{Route('mobilelaporandetail',['SP3',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (SP3)
            </div>
        </a>
    </li>
    @if(Session::get('status') == '')
    <li>
        <a href="{{Route('mobilelaporandetail',['ADR',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (ADR)
            </div>
        </a>
    </li>
    @endif
    <li>
        <a href="{{Route('mobilelaporandetail',['DIVERSI',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (DIVERSI)
            </div>
        </a>
    </li>
    <li>
        <a href="{{Route('mobilelaporandetail',['BAS',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (BAS)
            </div>
        </a>
    </li>
    <li>
        <a href="{{Route('mobilelaporandetail',['RJ',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (RJ)
            </div>
        </a>
    </li>
    <li>
        <a href="{{Route('mobilelaporandetail',['LIMPAH',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (LIMPAH)
            </div>
        </a>
    </li>
    <li>
        <a href="{{Route('mobilelaporandetail',['SP2 LIDIk',$units,$tahun,$bulan])}}" class="item">
            <div class="icon-box bg-primary">
                <ion-icon name="document-text-outline"></ion-icon>
            </div>
            <div class="in">
                SELRALAKA (SP2 LIDIK)
            </div>
        </a>
    </li>
</ul>
@endsection

@section('footer')

@endsection

@section('css')
    
@endsection

@section('js')
    
@endsection