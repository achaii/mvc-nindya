@extends('layouts.web')

@section('title')
<h2 class="az-content-title tx-24 mg-b-5">Managemen Polres</h2>
<p class="mg-b-20 mg-lg-b-25">Pengaturan managemen Polres</p>
@endsection

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12">
        <div class="card card-dashboard-eighteen">
            <div class="col-sm-6 col-md-3" style="padding-left: 0px;">
                <a href="#modaldemo" class="modal-effect btn btn-primary btn-with-icon btn-block" data-effect="effect-scale" data-toggle="modal" data-target="#modaldemo">
                    <i class="typcn typcn-plus"></i> TAMBAH DATA
                </a>
            </div>
            <table id="managamentunit" class="display responsive table table-hover table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th class="wd-5p">No</th>
                        <th class="wd-600-f" data-priority="1">Kesatuan</th>
                        <th class="wd-5p" data-priority="1">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($select as $i)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$i->nama_unit}}</td>
                        <td >

                            <a href="#modaldemo{{$i->id}}" class="btn btn-primary btn-with-icon btn-block" data-effect="effect-scale" data-toggle="modal" data-target="#modaldemo{{$i->id}}"><i class="typcn typcn-edit"></i></a>
                            <a onclick="return confirm('Yakin Ingin mengahapus Data Ini ?')" href="{{Route('webmunitdestroy',[$i->id])}}" class="btn btn-danger btn-with-icon btn-block"><i class="typcn typcn-trash"></i></a>
                            <div id="modaldemo{{$i->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content modal-content-demo">
                                    <form method="POST" action="{{Route('webmunitupdate',[$i->id])}}">
                                        @csrf
                                    <div class="modal-header">
                                      <h6 class="modal-title">EDIT DATA</h6>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Nama Kesatuan <span class="tx-danger">*</span></label>
                                              <input class="form-control" placeholder="..." type="text" name="kesatuan" value="{{$i->nama_unit}}">
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
                          </td>
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
        <form method="POST" action="{{Route('webmunitstore')}}">
            @csrf
        <div class="modal-header">
          <h6 class="modal-title">TAMBAH DATA</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row row-sm">
                <div class="col-lg">
                    <label>Nama Kesatuan <span class="tx-danger">*</span></label>
                  <input class="form-control" placeholder="..." type="text" name="kesatuan">
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
@endsection

@section('css')
    <link href="{{ asset('public/web/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/web/lib/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection

@section('js')
    
    <script src="{{ asset('public/web/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#managamentunit').dataTable({
            "responsive": true,
            "searching": true,
            "bLengthChange" : false,
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
            @foreach($select as $i)
            $('.modal-effect').on('click', function(e){
                e.preventDefault();
                var effect = $(this).attr('data-effect');
                $('#modaldemo{{$i->id}}').addClass(effect);
            });

            $('#modaldemo{{$i->id}}').on('hidden.bs.modal', function (e) {
                $(this).removeClass (function (index, className) {
                    return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
                });
            });
            @endforeach
        });
    </script>
@endsection

