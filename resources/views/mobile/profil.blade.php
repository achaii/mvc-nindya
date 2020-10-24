@extends('layouts.mobile')

@section('header')
    @include('layouts.mobile-header')
@endsection

@section('content')
<div class="section mt-3 text-center">
    <div class="avatar-section">
        <a href="#" data-toggle="modal" data-target="#profil">
            <img src="{{asset('public/asset/img-profil/'.Session::get('gambar'))}}" alt="avatar" class="imaged w100 rounded" 
            style="width:100px;
            height:100px;
            object-fit:fill;">
            <span class="button">
                <ion-icon name="camera-outline"></ion-icon>
            </span>
        </a>
    </div>
</div>

@foreach ($select as $i)
<div class="listview-title mt-1">Profil</div>
<ul class="listview image-listview text">
    <li>
        <div class="item">
            <div class="in">
                <div>
                    Nama
                    <div class="text-muted">
                        {{$i->nama}}
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="item">
            <div class="in">
                <div>
                    Unit
                    <div class="text-muted">
                        {{$i->name}}
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>

<div class="listview-title mt-1">Profile Settings</div>
<ul class="listview image-listview text">
    <li>
        <div class="item">
            <div class="in">
                <div>
                    Username
                    <div class="text-muted">
                        {{substr($i->email,0,-14)}}
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="item">
            <div class="in">
                <div>
                    Password
                    <div class="text-muted">
                        Hide
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="item">
            <div class="in">
                <div>
                    Status Akses
                    <div class="text-muted">
                        {{$i->status}}
                    </div>
                </div>
            </div>
        </div>
    </li>
    <li>
        <div class="item">
            <div class="in">
                <div>
                    Keterangan
                    <div class="text-muted">
                        <?php if($i->keterangan == ''){echo 'Tidak Ada Catatan';}else{ echo $i->keterangan;} ?>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
@endforeach
<div class="listview-title mt-1">Other</div>
<ul class="listview image-listview text">
    <li>
        <a href="{{Route('mobileloginlogout')}}" class="item">
            <div class="in">
                <div>Logout Aplikasi</div>
            </div>
        </a>
    </li>
</ul>

@foreach ($select as $item)
<div class="modal fade action-sheet" id="profil" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profil</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div class="section full mb-2">
                            <form method="POST" action="{{Route('mobileprofiledit')}}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label">Foto Profil</label>
                                    <input name="id" value="{{$i->id}}" style="display: none"/>
                                    <input name="gambars" value="{{$i->gambar}}" style="display: none"/>
                                    <input type="file" name="gambar" class="dropify" data-default-file="{{URL::to('/').'/public/asset/img-profil/'.$i->gambar}}"/>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                <label class="label" for="nomorlp">Nama </label>
                                    <input value="{{$item->nama}}" type="text" class="form-control" style="text-transform: uppercase" id="nama" name="nama">
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                <label class="label" for="nomorlp">Username (Tidak Bisa di Ganti)</label>
                                    <input value="{{substr($i->email,0,-14)}}" readonly type="text" class="form-control" style="text-transform: uppercase" id="username" name="username">
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                <label class="label" for="nomorlp">Password </label>
                                    <input value="{{$item->password_hit}}" type="text" class="form-control" style="text-transform: uppercase" id="password" name="password">
                                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                </div>
                            </div>
                            <div class="form-group basic">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('footer')

@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify();
        });
    </script>
@endsection