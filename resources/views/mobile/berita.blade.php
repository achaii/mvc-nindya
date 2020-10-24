@extends('layouts.mobile')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="{{Route('mobiledashboard',[$tahun,$bulan])}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        Berita
    </div>
</div>
@endsection

@section('content')
<div class="section tab-content mt-2 mb-2">
    <div class="row">
        @foreach ($select as $i)
        <div class="col-6 mb-2">
            <a href="{{Route('mobileberitashow',[$i->id])}}">
                <div class="blog-card">
                    <img src="{{URL::to('/').'/public/asset/img-berita/'.$i->gambar}}" alt="image" class="imaged w-100" 
                    style="width:100px;
                    height:100px;
                    object-fit:fill;">
                    <div class="text">
                        <h4 class="title">{{$i->judul_berita}}</h4>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
        <div>
            {{$select->links()}}
        </div>
    </div>
</div>
@endsection

@section('css')
    
@endsection

@section('js')
    
@endsection