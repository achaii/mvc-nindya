@extends('layouts.mobile')

@section('header')
    @include('layouts.mobile-header')
@endsection

@section('content')
<div class="section inset mt-2 mb-2">
    <div class="section-title">LAPORAN PENYELESAIAN PERKARA</div>
    <div class="wide-block pb-1 pt-1">
        <form action="{{Route('mobileinputstore')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="account1">BULAN <span class="text-danger">*</span></label>
                    <select class="form-control custom-select" id="account1" name="bulan">
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

            <div class="form-group basic">
                <div class="input-wrapper">
                <label class="label" for="nomorlp">NOMOR IRSMS <span class="text-danger">*</span></label>
                    <input required type="text" onfocusout="funcirsms()" class="form-control" style="text-transform: uppercase" id="noirsms" name="noirsms">
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    <label class="label" id="irsms" style="display: none"><font color="red">Nomor IRSMS Sudah Ada</font></label>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                <label class="label" for="nomorlp">TANGGAL IRSMS <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" id="datepicker-autoclose3" name="tglirsms" placeholder="...">
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                <label class="label" for="nomorlp">NOMOR LP <span class="text-danger">*</span></label>
                    <input required type="text" onfocusout="funcnolp()" class="form-control" style="text-transform: uppercase" id="nomorlp" name="nomor_lp">
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                    <label class="label" id="lp" style="display:none"><font color="red">Nomor LP Sudah Ada</font></label>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                <label class="label" for="nomorlp">TANGGAL KEJADIAN PERKARA <span class="text-danger">*</span></label>
                <input required type="text" class="form-control" id="datepicker-autoclose1" name="tgl1" placeholder="...">
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label" for="account1">PENYELESAIAN PERKARA <span class="text-danger">*</span></label>
                    <select class="form-control custom-select" id="account1" name="penyelesaianperkara">
                        <option value="P21"> P21</option>
                        <option value="SP3"> SP3</option>
                        <option value="RJ"> RJ</option>
                        @if(Session::get('status') == '')
                        <option value="ADR"> ADR</option>
                        @endif
                        <option value="BAS"> BAS</option>
                        <option value="DIVERSI"> DIVERSI</option>
                        <option value="LIMPAH"> LIMPAH</option>
                        <option value="SP2 LIDIK"> SP2 LIDIK</option>
                    </select>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                <label required class="label" for="nomorlp">TANGGAL PENYELESAIAN PERKARA <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="datepicker-autoclose2" name="tgl2" placeholder="...">
                    <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                </div>
            </div>

            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label">UPLOAD LAPORAN POLISI (PDF/JPG Max File 10M)<span class="text-danger">*</span></label>
                    <label class="label">Untuk laporan yg lebih dari 1 halaman disarankan untuk di PDF-kan dulu </label>
                    &nbsp;
                    <input required required id="upload1" type="file" name="laporan[]" class="dropify" data-max-file-size="10M" multiple />
                </div>
            </div>
            @if(Session::get('status') == '')
            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label">UPLOAD RESUME (PDF/JPG Max File 10M)<span class="text-danger">*</span></label>
                    &nbsp;
                    <input required id="upload2" type="file" name="resume[]" class="dropify" data-max-file-size="10M" multiple />
                </div>
            </div>
            @endif

            <div class="form-group basic">
                <div class="input-wrapper">
                    <label class="label">UPLOAD SELRA (PDF/JPG Max File 10M)<span class="text-danger">*</span> </label>
                    <label class="label">Untuk laporan yg lebih dari 1 halaman disarankan untuk di PDF-kan dulu</label>
                    &nbsp;
                    <input required id="upload3" type="file" name="selra[]" class="dropify" data-max-file-size="10M" multiple />
                </div>
            </div>

            <div class="form-group basic">
                <button onclick="info()" type="submit" class="btn btn-primary btn-block btn-lg">SIMPAN</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade dialogbox" id="DialogIconedSuccess" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-icon text-success">
                <ion-icon name="checkmark-circle"></ion-icon>
            </div>
            <div class="modal-header">
                <h5 class="modal-title">Sukses</h5>
            </div>
            <div class="modal-body">
                Laporan Selralaka Telah di Kirim
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade dialogbox" id="DialogIconedSuccess1" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-icon text-danger">
                <ion-icon name="close-circle-outline"></ion-icon>
            </div>
            <div class="modal-header">
                <h5 class="modal-title">Gagal</h5>
            </div>
            <div class="modal-body">
                Laporan Selralaka Tidak Terkirim Silahkan Lengkapi Data
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn" data-dismiss="modal">CLOSE</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade dialogbox" id="loading" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="section full mt-2">
                    Tunggu Beberapa Saat Sedang Mengupload File ...
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer')
@include('layouts.mobile-footer')
@endsection

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('public/mobile/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
@endsection

@section('js')
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/locale/af.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    
    <script type="text/javascript">
        function funcirsms(){
            var inoirsms = document.getElementById('noirsms').value;
            $.ajax({
                url : "{{Route('noirsms')}}",
                method : 'POST',
                data : {
                    "_token": "{{csrf_token()}}",
                    "data":inoirsms,
                },
                success : function(respons){
                    console.log(respons);
                    if(respons.sukses == true){
                        document.getElementById('irsms').style.display = "block";
                    }else if(respons.gagal == true){
                        document.getElementById('irsms').style.display = "none";
                    }
                }
            });
        }

        function funcnolp(){
            var inolp = document.getElementById('nomorlp').value;
            $.ajax({
                url : "{{Route('nolp')}}",
                method : 'POST',
                data : {
                    "_token": "{{csrf_token()}}",
                    "data":inolp,
                },
                success : function(respons){
                    console.log(respons);
                    if(respons.sukses == true){
                        document.getElementById('lp').style.display = "block";
                    }else if(respons.gagal == true){
                        document.getElementById('lp').style.display = "none";
                    }
                }
            });
        }
        $(document).ready(function() {
            $('.dropify').dropify();
            $('#datepicker-autoclose1').bootstrapMaterialDatePicker({ format : 'DD-MM-YYYY', time: false });
            $('#datepicker-autoclose2').bootstrapMaterialDatePicker({ format : 'DD-MM-YYYY', time: false });
            $('#datepicker-autoclose3').bootstrapMaterialDatePicker({ format : 'DD-MM-YYYY', time: false });
            @if($errors->has('alert'))
                $("#DialogIconedSuccess").modal('show');
            @endif
            @if($errors->has('alert1'))
                $("#DialogIconedSuccess1").modal('show');
            @endif
        });

        function info(){
            var upload1 = document.getElementById('upload1');
            var upload3 = document.getElementById('upload3');

            if(upload1.value == "" || upload3.value == ""){
                upload1.required;
                upload3.required;
            }else{
                $('#loading').modal('show');
            }
        }
    </script>
@endsection