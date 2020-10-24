@extends('layouts.web')

@section('title')
<h2 class="az-content-title tx-24 mg-b-5">Posting Berita</h2>
<p class="mg-b-20 mg-lg-b-25">Pengaturan posting berita</p>
@endsection

@section('content')
<div class="row row-sm mg-b-20">
    <div class="col-lg-12">
        <div class="card card-dashboard-eighteen">
            <div class="col-sm-6 col-md-3" style="padding-left: 0px;">
                <a href="#modaldemo" class="modal-effect btn btn-primary btn-with-icon btn-block" data-effect="effect-scale" data-toggle="modal" data-target="#modaldemo">
                    <i class="typcn typcn-plus"></i> TAMBAH BERITA
                </a>
            </div>
            <table id="managamentuser" class="display responsive table table-hover table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th class="wd-5p">No</th>
                        <th class="wd-300-f" data-priority="1">Judul Berita</th>
                        <th class="wd-400-f" data-priority="1">Isi Berita</th>
                        <th class="wd-10p" data-priority="1">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($select as $i)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>
                            {{$i->judul_berita}}</br>
                            Created <a href="#">{{$i->tanggal_buat}}</a></br>
                            Publish <a href="#">{{$i->tanggal_publish}}</a>
                        </td>
                        <td>
                            {!! html_entity_decode($i->isi_berita) !!}
                        </td>
                        <td>
                            <a href="{{Route('webberitaedit',[$i->id])}}" class="btn btn-warning btn-with-icon btn-block"><i class="typcn typcn-clipboard"></i></a>
                            <a href="#modaldemo{{$i->id}}" class="btn btn-primary btn-with-icon btn-block" data-toggle="modal" data-target="#modaldemo{{$i->id}}"><i class="typcn typcn-edit"></i></a>
                            <a onclick="return confirm('Yakin Ingin mengahapus Data Ini ?')" href="{{Route('webberitadestroy',[$i->id])}}" class="btn btn-danger btn-with-icon btn-block"><i class="typcn typcn-trash"></i></a>   

                            <div id="modaldemo{{$i->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content modal-content-demo">
                                    <form method="POST" action="{{Route('webberitaupdate',[$i->id])}}" enctype="multipart/form-data">
                                        @csrf
                                    <div class="modal-header">
                                      <h6 class="modal-title">EDIT BERITA</h6>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Judul Berita <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                  <input value="{{$i->judul_berita}}" name="judulberita" type="text" class="form-control" placeholder="Masukan username tanpa spasi" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                </div>
                                              </div>
                                          </div>
                                          <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Isi Berita <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                    <textarea id="summernote{{$i->id}}" name="isiberita" class="form-control" >
                                                        {!! html_entity_decode($i->isi_berita) !!}
                                                    </textarea>
                                                  </div>
                                              </div>
                                          </div>
                                        <div class="row row-sm ">
                                            <div class="col-lg">
                                                <label>Upload Gambar Utama<span class="tx-danger">*</span></label>
                                            <div class="custom-file">
                                                <input name="gambars" value="{{$i->gambar}}" style="display: none">
                                                <input type="file" id="gambar{{$i->id}}" name="gambar" value="{{$i->gambar}}" class="dropify" data-default-file="{{URL::to('/').'/public/asset/img-berita/'.$i->gambar}}"/>
                                              </div>
                                            </div>
                                    </div>
                                    <div class="row row-sm mg-t-20">
                                        <div class="col-lg">
                                            <label>Status Berita <span class="tx-danger">*</span></label>
                                            <select class="form-control" name="status" <?php if($i->status == 'Draft'){ echo 'disabled';} ?>>   
                                                <option <?php if($i->status == 'Publish'){ echo 'selected';} ?> value="Publish">Publish</option>   
                                                <option <?php if($i->status == 'Draft'){ echo 'selected';} ?> value="Draft">Draft</option>                 
                                              </select>
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
        <form method="POST" action="{{Route('webberitastore')}}" enctype="multipart/form-data">
            @csrf
        <div class="modal-header">
          <h6 class="modal-title">TAMBAH BERITA</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row row-sm">
                <div class="col-lg">
                    <label>Judul Berita <span class="tx-danger">*</span></label>
                    <div class="input-group mb-3">  
                      <input name="judulberita" type="text" class="form-control" placeholder="Masukan username tanpa spasi" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                  </div>
              </div>
              <div class="row row-sm">
                <div class="col-lg">
                    <label>Isi Berita <span class="tx-danger">*</span></label>
                    <div class="input-group mb-3">  
                        <textarea id="summernote" name="isiberita" class="form-control" >
                        </textarea>
                      </div>
                  </div>
              </div>
            <div class="row row-sm ">
                <div class="col-lg">
                    <label>Upload Gambar Utama<span class="tx-danger">*</span></label>
                <div class="custom-file">
                    <input type="file" id="gambar" name="gambar" class="dropify" />
                  </div>
                </div>
            </div>
            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <label>Status Berita <span class="tx-danger">*</span></label>
                    <select class="form-control" id="select2-no-search" name="status">   
                        <option value="Publish">Publish</option>   
                        <option value="Draft">Draft</option>                 
                    </select>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection

@section('js') 
    <script src="{{ asset('public/web/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/web/lib/select2/js/select2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script type="text/javascript">
        function myFunction(){
            var x = document.getElementById('password');
            if(x.type === "password"){
                x.type = "text";
            }else{
                x.type = "password";
            }
        }
        $(document).ready(function() {
            $('.dropify').dropify();
            $('#managamentuser').dataTable({
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
        $('[name="isiberita"]').summernote({
            height:350,
            minHeight:null,
            maxheight:null,
            focus:false
        });
            //$('select').addClass('bg-primary');
            //$('.dataTables_length select').select2({ minimumResultsForSearch: Infinity }); 
            $('.modal-effect').on('click', function(e){
                e.preventDefault();
                var effect = $(this).attr('data-effect');
                $('#modaldemo').addClass(effect);
            });

        // hide modal with effect
            $('#modaldemo').on('hidden.bs.modal', function (e) {
                $(this).removeClass (function (index, className) {
                    return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
                });
            });
        });
    </script>
@endsection

