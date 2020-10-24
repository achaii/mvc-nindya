@extends('layouts.mobile')

@section('header')
<div class="appHeader">
    <div class="left">
        <a href="{{Route('mobileberita')}}" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        Berita Post
    </div>
</div>
@endsection

@section('content')
<div class="section mt-2">
    <h2>
        {{$select->judul_berita}}
    </h2>
    <div class="blog-header-info mt-2 mb-2">
        <div>
            <img src="{{asset('public/asset/img-profil/'.Session::get('gambar'))}}" alt="img" class="imaged w24 rounded mr-05">
            <a href="#">Admin E-Selra Laka</a>
        </div>
        <div>
            {{$tanggal}}
        </div>
    </div>
    <div class="lead">
        <img src="{{URL::to('/').'/public/asset/img-berita/'.$select->gambar}}" alt="image" class="imaged w-100">
    </div>
</div>

<div class="section mt-2">
    {!! html_entity_decode($select->isi_berita) !!}
</div>

<div class="section mt-3">
    <h2>Related Posts</h2>
    <div class="row mt-3">
        @foreach ($new as $i)
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
    </div>
</div>

@endsection

@section('footer')
@include('layouts.mobile-footer')
@endsection

@section('css')
    
@endsection

@section('js')
    
@endsection