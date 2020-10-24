@extends('layouts.web')

@section('title')
    <h2 class="az-content-title tx-24 mg-b-5">Managemen Kejadian</h2>
    <p class="mg-b-20 mg-lg-b-25">Pengaturan managemen kejadian IRSMS per-polres</p>
@endsection

@section('content')
<div class="row row-sm mg-b-20">

    <div class="col-lg-12">
        <div class="card card-dashboard-eighteen">
            <div class="col-sm-6 col-md-3" style="padding-left: 0px;">
                <form action="{{Route('webselragenerate')}}" method="POST">
                    @csrf
                    <label>Untuk menghasilkan data inputan kejadian IRSMS perbulan</label>
                    <input style="display:none" type="text" id="atahun" name="atahun" value="{{$tahun}}">
                    <input style="display:none" type="text" id="abulan" name="abulan" value="{{$bulan}}">
                    <button type="submit" class="btn btn-warning btn-with-icon btn-block">
                        <i class="typcn typcn-plus"></i> GENERATE DATA
                    </button>
                </form>
            </div>
            <div class="col-sm-12 col-md-8" style="padding-left: 0px;">
                <form action="{{Route('webselra')}}" method="POST">
                    @csrf
                <div class="row row-sm mg-t-20">             
                    <div class="col-lg">
                        <label>TAHUN <span class="tx-danger">*</span></label>
                        <select class="form-control" id="btahun" name="tahun">   
                            @foreach ($list_tahun as $t)
                                <option <?php if($t->tahun == $tahun){ echo 'selected';} ?> value="{{$t->tahun}}">{{$t->tahun}}</option>  
                            @endforeach                                         
                          </select>
                    </div>
                    <div class="col-1" style="padding-left: 0%">
                        <label>&nbsp;</label>
                        <a href="#modaldemo" class="modal-effect btn btn-primary btn-with-icon btn-sm" data-effect="effect-scale" data-toggle="modal" data-target="#modaldemo">
                            <i class="typcn typcn-plus"></i>
                        </a>
                    </div>
                    <div class="col-lg">
                        <label>BULAN <span class="tx-danger">*</span></label>
                        <select class="form-control" id="bbulan" name="bulan">   
                            <option <?php if($bulan == '01'){ echo 'selected';} ?> value="01"> JANUARI</option>
                            <option <?php if($bulan == '02'){ echo 'selected';} ?> value="02"> FEBRUARI</option>
                            <option <?php if($bulan == '03'){ echo 'selected';} ?> value="03"> MARET</option>
                            <option <?php if($bulan == '04'){ echo 'selected';} ?> value="04"> APRIL</option>
                            <option <?php if($bulan == '05'){ echo 'selected';} ?> value="05"> MEI</option>
                            <option <?php if($bulan == '06'){ echo 'selected';} ?> value="06"> JUNI</option>
                            <option <?php if($bulan == '07'){ echo 'selected';} ?> value="07"> JULI</option>
                            <option <?php if($bulan == '08'){ echo 'selected';} ?> value="08"> AGUSTUS</option>
                            <option <?php if($bulan == '09'){ echo 'selected';} ?> value="09"> SEPTEMBER</option>
                            <option <?php if($bulan == '10'){ echo 'selected';} ?> value="10"> OKTOBER</option>
                            <option <?php if($bulan == '11'){ echo 'selected';} ?> value="11"> NOVEMBER</option>
                            <option <?php if($bulan == '12'){ echo 'selected';} ?> value="12"> DESEMBER</option>          
                          </select>
                    </div>
                    <div class="col-lg">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-success btn-with-icon btn-block">
                            <i class="typcn typcn-plus"></i> CARI DATA
                        </button>
                    </div>
                </div>  
            </br>   
                <label>Form pencarian data kejadian IRSMS per-tahun - per-bulan, (Generate bila data belum ada)</label>  
            </form>
            </div>
            <table id="managamentunit" class="display responsive table table-hover table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th style="display: none">No</th>
                        <th style="display: none">KESATUAN</th>
                        <th style="display: none" >JML KEJADIAN</th>
                        <th style="display: none">KETERANGAN</th>

                        <th>No</th>
                        <th data-priority="1">KESATUAN</th>
                        <th data-priority="1">JML KEJADIAN</th>
                        <th>KETERANGAN</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <a id="a" href="/managemen-kejadian#tr{{Session::get('state')}}"></a>
                    @foreach ($select as $s)
                    <tr id="tr{{$s->id}}">
                        <td style="display: none">{{$noo++}}</td>
                        <td style="display: none">{{$s->polres}}</td>
                        <td style="display: none">{{$s->jmlselra}}</td>
                        <td style="display: none">{{$s->keterangan}}</td>

                        <form action="{{Route('webselraupdate')}}" method="POST" id="{{$s->id}}">
                            @csrf

                        <td style="width:5px">{{$no++}}
                        <input type="hidden" name="id" value="{{$s->id}}">
                        </td>
                        <td>{{$s->polres}}</td>
                        <td style="width:5px"><input id="i{{$s->id}}" class="form-control" placeholder="..." type="text" value="{{$s->jmlselra}}" name="jmlselra"></td>
                        <td><textarea id="j{{$s->id}}" name="keterangan" class="form-control" >{{$s->keterangan}}</textarea></td>
                        <td style="width:5px"><button id="k{{$s->id}}" type="submit" class="btn btn-primary btn-with-icon btn-block"><i class="typcn typcn-input-checked"></i></button></td>
                    </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- card -->
    </div><!-- col -->
  </div><!-- row -->


  <div id="modaldemo" class="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-content-demo">
        <form method="POST" action="{{Route('webselratahun')}}">
            @csrf
        <div class="modal-header">
          <h6 class="modal-title">TAMBAH TAHUN</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row row-sm">
                <div class="col-lg">
                    <label>TAHUN <span class="tx-danger">*</span></label>
                  <input class="form-control" placeholder="..." type="text" name="tahun">
                </div>
              </div>
            </br>
              <div class="row row-sm">
                <div class="col-lg">
                    <table id="tahun" class="display responsive table table-hover table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5px">NO</th>
                                <th style="width: 100px">TAHUN</th>
                                <th style="width: 5px">HAPUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_tahun as $item)

                            <tr>
                                <td>{{$nomor++}}</td>
                                <td>{{$item->tahun}}</td>
                                <td>
                                    <a href="{{Route('webselradestroy',[$item->tahun])}}" class=" btn-danger btn-with-icon"><i class="typcn typcn-times"></i></a>
                                </td>
                            </tr>
                                                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="Submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div id="modaldemo4" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i class="icon ion-ios-checkmark-circle-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
          <h4 class="tx-success tx-semibold mg-b-20">Sukses!</h4>
          <p class="mg-b-20 mg-x-20">Generalisasi Selra Selesai</p>
          <button type="button" class="btn btn-success pd-x-25" data-dismiss="modal" aria-label="Close">Close</button>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->

  <div id="modaldemo5" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
          <h4 class="tx-danger mg-b-20">Error: Data Sudah Ada</h4>
          <p class="mg-b-20 mg-x-20">Data Selra Bulan {{$bulan}} di Tahun {{$tahun}} Sudah Ada</p>
          <button type="button" class="btn btn-danger pd-x-25" data-dismiss="modal" aria-label="Close">Close</button>
        </div><!-- modal-body -->
      </div><!-- modal-content -->
    </div><!-- modal-dialog -->
  </div><!-- modal -->
@endsection

@section('css')
    <link href="{{ asset('public/web/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ asset('public/web/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/select2/js/select2.min.js')}}"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tahun').dataTable({
                'dom':'t'
            });

            $('#managamentunit').dataTable({
                'dom': 'Bfrtip',
              'buttons': [
                {
                  extend: 'copy',
                  exportOptions: {
                      columns: [ 0,1,2,3]
                  },
                },
                {
                  extend: 'csv',
                  exportOptions: {
                      columns: [ 0,1,2,3]
                  },
                },
                {
                  extend: 'excel',
                  exportOptions: {
                      columns: [ 0,1,2,3]
                  },
                },
              ],
            "responsive": true,
            "searching": true,
            "bLengthChange" : false,
            "columnDefs": [{ 
              "targets": [ 0,1,2,3],
                "visible": false,
                "searchable": false
            }],
            "lengthMenu": [[-1], ["All"]],
            // "responsive": true,
            // "searching": true,
            // "bLengthChange" : false,
            // "scrollX": false,
            // "scrollCollapse": true,
            // "autoWidth": true,
            // "columnDefs": [{ 
            //     "width": "50px", "targets": [0,2,3,4,5,6,7,8,9,12], 
            //     "width": "60px", "targets": [10], 
            //     "width": "112px", "targets": [1,11]
            // }],
            "language": {
                "lengthMenu": "_MENU_ Data",
                "zeroRecords": "Tidak ada data yang tersedia pada tabel ini",
                "info": "Menampilkan _PAGE_ dari _PAGES_ entri",
                "infoEmpty": "Tidak ditemukan data yang sesuai",
                "searchPlaceholder": 'Silahkan Cari Data',
                "sSearch": '',
                "lengthMenu": '_MENU_ Data',
                "infoFiltered": "(filter dari _MAX_ entri keseluruhan)",
                "paginate": {
                    "first": "Pertama",
                    "previous": "Sebelumnya",
                    "next": "Selajutnya",
                    "last": "Terkahir"
                }
            }
        });
            $('select[name=tahun]').change(function() {
                var a = document.getElementById('btahun').value;
                document.getElementById('atahun').value = a;
            });

            $('select[name=bulan]').change(function() {
                var a = document.getElementById('bbulan').value;
                document.getElementById('abulan').value = a;
            });

            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

            $('.modal-effect').on('click', function(e){
                e.preventDefault();
                var effect = $(this).attr('data-effect');
                $('#modaldemo').addClass(effect);
            });

            $('#modaldemo').on('hidden.bs.modal', function (e) {
                $(this).removeClass (function (index, className) {
                    return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
                });
            });

            @if($errors->has('alert'))
                $("#modaldemo5").modal('show');
            @endif

            @if($errors->has('alert1'))
                $("#modaldemo4").modal('show');
            @endif

   
            // @foreach($select as $as)
            // $('#a{{$as->id}},#b{{$as->id}},#c{{$as->id}},#d{{$as->id}},#e{{$as->id}},#f{{$as->id}},#g{{$as->id}},#h{{$as->id}}').change(function() {
            //     document.getElementById('i{{$as->id}}').value = '';
            // });
            // @endforeach


            @if($errors->has('table'))
            $(function(){
                window.location.href = $("#a").attr('href');
            });
            @endif
        });
    </script>
@endsection