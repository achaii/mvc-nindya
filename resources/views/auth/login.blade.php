<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="selralaka polda jabar">
    <meta name="author" content="mikaku creative">
    <title>E-Selra Laka</title>

    <!-- vendor css -->
    <link href="{{ asset('public/web/lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/typicons.font/typicons.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="https://3.bp.blogspot.com/-sx9UZVCGOus/VxufV6giOcI/AAAAAAAAXAY/4KGJoUUFfikE54p0p6ncbSP9lzoLRuXowCLcB/s1600/Logo+DIR+Lantas+Polri.png"/>

    <link href="{{ asset('public/web/css/azia.css')}}" rel="stylesheet">

  </head>
  <body class="az-body" style="background-color:#0069D9">

    <div class="az-signin-wrapper">
      <div class="az-card-signin" style="background-color:#fff">
        <div style="text-align: center">
          <img style="width:30%;height:100%" src="http://e-selralaka.subditgakkumpoldajabar.com/public/logo1.png">
          <img style="width:30%;height:100%" src="http://e-selralaka.subditgakkumpoldajabar.com/public/logo2.png">
        </div>
        <h1 class="az-logo" style="color:#000">E-Selra<span style="color:#0069D9">Laka</span></h1>
        <div class="az-signin-header">
          <h2 style="color: #0069D9">Selamat Datang!</h2>
          <h6 style="color:#000">Silahkan Login Untuk Melanjutkan</h6>
        </br>

          <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
              <label style="color:#000">Username</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="demo@selralaka.com" required autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
              <label style="color:#000">Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required autocomplete="current-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer">
          <p style="color:#000">E-Seleralaka &copy; Subdit Gakkum Polda Jabar 2020</p>
        </div><!-- az-signin-footer -->
      </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="{{asset('public/web/js/azia.js')}}"></script>
  </body>
</html>
