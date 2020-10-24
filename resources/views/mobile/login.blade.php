<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SELRALAKA MOBILE</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="selralaka polda jabar, subditgakkum">
    <meta name="keywords" content="bootstrap, mobile template, cordova, phonegap, mobile, html, responsive" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/mobile/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('public/mobile/img/favicon.png')}}" sizes="32x32">
    <link rel="shortcut icon" href="{{asset('public/mobile/img/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('public/mobile/style.css?v=5')}}">
    <script>window.history.forward()</script>
    <style>
        @media(max-width:480px){
        body {
            /* background-image: url("http://e-selralaka.subditgakkumpoldajabar.com/public/police-tape.png"); */
            background-image: url("http://e-selralaka.subditgakkumpoldajabar.com/public/logologin.png");
            background-repeat:no-repeat;
            background-size:350% auto;
            background-position:top right;
            background-attachment: fixed;
        }
    }
    </style>
</head>
{{-- class="bg-light" --}}
<body>
    {{-- <div id="loader">
        <img src="http://e-selralaka.subditgakkumpoldajabar.com/public/logo2.png" alt="icon" class="loading-icon">
    </div> --}}

    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <img src="http://e-selralaka.subditgakkumpoldajabar.com/public/logo2.png" width="40%" height="40%">
            <div class="section mt-2 mb-4"></div>
            <h1 style="color:#fff;text-shadow: 2px 2px 5px gray">E-SELRA LAKA <br>SUBDIT GAKKUM</h1>
            <h2 style="color:#fff;text-shadow: 2px 2px 5px gray">POLDA JABAR</h2>
        </div>
        <div class="section mt-2 mb-5 p-3">
            <form action="{{Route('mobilelogin')}}" method="POST">
                @csrf
                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label style="color:#fff;" class="label" for="email1">Username</label>
                        <input value="{{ old('alert1') }}" autofocus onload="setemail()" type="text" style="text-transform: uppercase" class="form-control" name="email" id="email1" placeholder="username ...">
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>

                <div class="form-group basic">
                    <div class="input-wrapper">
                        <label style="color:#fff;" class="label" for="password1">Password</label>
                        <input type="password" onload="setpass()" style="text-transform: uppercase" class="form-control" name="password" id="password1" placeholder="password ...">
                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    </div>
                </div>

                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">LOGIN</button>
                </div>

            </form>
        </div>
    </div>

    <div class="modal fade dialogbox" id="user" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-danger">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">Login Gagal</h5>
                </div>
                <div class="modal-body">
                    Username Anda Salah !!!
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade dialogbox" id="pass" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-icon text-danger">
                    <ion-icon name="close-circle-outline"></ion-icon>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">Login Gagal</h5>
                </div>
                <div class="modal-body">
                    Password Anda Salah !!!
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script> --}}
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

    <script>
        @if($errors->has('alert1'))
            $('#user').modal('show');
            function setemail(){
                document.getElementById('email1').focus();
            }
        @endif
        @if($errors->has('alert2'))
            $('#pass').modal('show');
            function setpass(){
                document.getElementById('password1').focus();
            }
        @endif



    </script>
</body>
</html>