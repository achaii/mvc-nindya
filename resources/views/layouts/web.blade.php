<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="selralaka polda jabar">
    <meta name="author" content="mikaku creative">

    <title>E-Selralaka</title>
    <link rel="shortcut icon" href="https://3.bp.blogspot.com/-sx9UZVCGOus/VxufV6giOcI/AAAAAAAAXAY/4KGJoUUFfikE54p0p6ncbSP9lzoLRuXowCLcB/s1600/Logo+DIR+Lantas+Polri.png"/>
    <!-- vendor css -->
    <link href="{{ asset('public/web/lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/typicons.font/typicons.css')}}" rel="stylesheet">

    @yield('css')
    <!-- azia CSS -->
    <link href="{{ asset('public/web/css/azia.css')}}" rel="stylesheet">
    
  </head>
  <body class="az-body az-dashboard-eight">
    <div class="az-header az-header-primary">
      <div class="container">
        <div class="az-header-left">
          <a href="{{Route('webdashboard')}}" class="az-logo">
            <img style="width:5%;height:5%" src="http://e-selralaka.subditgakkumpoldajabar.com/public/logo1.png">
            <img style="width:5%;height:5%" src="http://e-selralaka.subditgakkumpoldajabar.com/public/logo2.png">
            E-SELRA<span>LAKA</span></a>
          <a href="" id="azNavShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div>
        <div class="az-header-center">
        </div>
        <div class="az-header-right">
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user" >
                <img src="{{asset('public/asset/img-profil/'.Auth::user()->gambar)}}" alt="">

            </a>
            <font color="#fff">{{Auth::user()->nama}}</font>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="{{asset('public/asset/img-profil/'.Auth::user()->gambar)}}" alt="">
                </div>
                <h6>{{Auth::user()->nama}}</h6>
                <span>{{Auth::user()->name}}</span>
              </div>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Logout</button> 
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('layouts.web-menu')

    <div class="az-content az-content-dashboard-eight">
      <div class="container d-block">
       
        @yield('title')
        @yield('content')

      </div><!-- container -->
    </div><!-- az-content -->

    <div class="az-footer">
      <div class="container">
        <span>E-Selralaka &copy; Subdit Gakkum Polda Jabar 2020</span>
        <span>MikakuCreative</span>
      </div><!-- container -->
    </div><!-- az-footer -->

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    {{-- <script src="{{asset('public/web/lib/jquery/jquery.min.js')}}"></script> --}}
    {{-- <script src="{{asset('public/web/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
    {{-- <script src="{{asset('web/lib/ionicons/ionicons.js')}}"></script> --}}
    {{-- <script src="https://cdn.bootcdn.net/ajax/libs/ionicons/4.2.5/ionicons/ionicons.suuqn5vt.js"></script> --}}
    {{-- <script src="{{asset('web/lib/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('web/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('web/lib/chart.js/Chart.bundle.min.js')}}"></script> --}}
    
    <script src="{{asset('public/web/js/azia.js')}}"></script>
    {{-- <script src="{{asset('web/js/chart.flot.sampledata.js')}}"></script> --}}
    @yield('js')
    
  </body>
</html>
