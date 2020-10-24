<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SELRALAKA MOBILE</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="selralaka polda jabar, subditgakkum">
    <meta name="keywords" content="bootstrap, mobile template, cordova, phonegap, mobile, html, responsive" />
    {{-- <script>window.history.forward()</script> --}}
    <link rel="shortcut icon" href="https://3.bp.blogspot.com/-sx9UZVCGOus/VxufV6giOcI/AAAAAAAAXAY/4KGJoUUFfikE54p0p6ncbSP9lzoLRuXowCLcB/s1600/Logo+DIR+Lantas+Polri.png"/>
    @yield('css')
    <link rel="stylesheet" href="{{asset('public/mobile/minstyle.css?v=5')}}">

</head>

<body>

    {{-- <div id="loader">
        <img src="https://3.bp.blogspot.com/-sx9UZVCGOus/VxufV6giOcI/AAAAAAAAXAY/4KGJoUUFfikE54p0p6ncbSP9lzoLRuXowCLcB/s1600/Logo%2BDIR%2BLantas%2BPolri.png" alt="icon" class="loading-icon">
    </div> --}}

    @yield('header')

    <!-- * App Header -->


    <!-- App Capsule -->
    <div id="appCapsule">
        @yield('content')
        @yield('footer')
    </div>

    <!-- App Bottom Menu -->
    @include('layouts.mobile-menu')

    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}

    <script src="{{asset('public/mobile/js/lib/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('public/mobile/js/lib/popper.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    {{-- <script src="{{asset('public/mobile/js/lib/bootstrap.min.js')}}"></script> --}}
    {{-- <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script> --}}
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('public/mobile/js/base.js')}}"></script>
    @yield('js')
</body>
</html>