@extends('layouts.web')

@section('title')
<h2 class="az-content-title tx-24 mg-b-5">Managemen User</h2>
<p class="mg-b-20 mg-lg-b-25">Pengaturan managemen user polres</p>
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
            <table id="managamentuser" class="display responsive table table-hover table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th class="wd-5p">No</th>
                        <th class="wd-10p">Kesatuan</th>
                        <th class="wd-10p">Username</th>
                        <th class="wd-10p">Status</th>
                        <th class="wd-20p">Keterangan</th>
                        <th class="wd-5p">Setting</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($select as $i)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$i->name}}</td>
                        <td>{{$i->email}}</td>
                        <td>{{$i->status}}</td>
                        <td>{{$i->keterangan}}</td>
                        <td>
                            <div class="col-lg-4">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="#modaldemo{{$i->id}}" class="btn btn-success" data-effect="effect-scale" data-toggle="modal" data-target="#modaldemo{{$i->id}}">Edit</a>
                                  <a onclick="return confirm('Yakin Ingin mengahapus Data Ini ?')" href="{{Route('webmuserdestroy',[$i->id])}}" class="btn btn-danger">Hapus</a>
                                </div>
                            </div><!-- col-4 -->
                            <div id="modaldemo{{$i->id}}" class="modal">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content modal-content-demo">
                                    <form method="POST" action="{{Route('webmuserupdate',[$i->id])}}">
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
                                                <label>Username <span class="tx-danger">*</span></label>
                                                <div class="input-group mb-3">  
                                                  <input name="username" value="{{substr($i->email,0,-14)}}" type="text" class="form-control" placeholder="Masukan username tanpa spasi" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                  <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">@selralaka.com</span>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>
                                          <div class="row row-sm">
                                            <div class="col-lg">
                                                <label>Password <span class="tx-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <div class="input-group-text">
                                                        <label class="ckbox wd-16 mg-b-0">
                                                          <input type="checkbox" onclick="myFunctions()" class="mg-0"><span></span>
                                                        </label>
                                                      </div>
                                                    </div>
                                                    <input type="password" value="{{$i->password_hit}}" id="pass{{$i->id}}" name="password" class="form-control" placeholder="Masukan password">
                                                  </div><!-- input-group -->
                                              </div>
                                          </div>
                                          <script>
                                                function myFunctions(){                                       
                                                    var x{{$i->id}} = document.getElementById('pass{{$i->id}}');
                                                    if(x{{$i->id}}.type === "password"){
                                                        x{{$i->id}}.type = "text";
                                                    }else{
                                                        x{{$i->id}}.type = "password";
                                                    }
                                                }
                                          </script>
                                        <div class="row row-sm mg-t-20">
                                            <div class="col-lg">
                                                <label>Nama Kesatuan <span class="tx-danger">*</span></label>
                                                <select class="form-control" id="select2-no-search" name="kesatuan">
                                                    @foreach ($unit as $a)
                                                        <option <?php if($i->id_unit == $a->id){ echo 'selected';} ?> value="{{$a->id}}">{{$a->nama_unit}}</option>         
                                                    @endforeach
                                                  </select>
                                            </div>
                                          </div>
                                        <div class="row row-sm mg-t-20">
                                            <div class="col-lg">
                                                <label>Hak Akses <span class="tx-danger">*</span></label>
                                                <select class="form-control" id="select2-no-search" name="status">   
                                                    <option <?php if($i->status == 'Administrator'){ echo 'selected';} ?> value="Administrator">[Level Akses 1] Administrator </option>   
                                                    <option <?php if($i->status == 'Kepala Kesatuan'){ echo 'selected';} ?> value="Kepala Kesatuan">[Level Akses 2] Kepala Kesatuan (Kasat) </option>         
                                                    <option <?php if($i->status == 'Kepolisian Rasor'){ echo 'selected';} ?> value="Kepolisian Resor">[Level Akses 3] Kepolisian Resor (Polres)</option>            
                                                  </select>
                                            </div>
                                          </div>
                                        <div class="row row-sm mg-t-20">
                                            <div class="col-lg">
                                                <label>Nama Kesatuan <span class="tx-danger">*</span></label>
                                                <textarea rows="4" class="form-control" placeholder="..." name="keterangan"></textarea>
                                              </div><!-- col -->
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
        <form method="POST" action="{{Route('webmuserstore')}}">
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
                    <label>Username <span class="tx-danger">*</span></label>
                    <div class="input-group mb-3">  
                      <input name="username" type="text" class="form-control" placeholder="Masukan username tanpa spasi" aria-label="Recipient's username" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">@selralaka.com</span>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="row row-sm">
                <div class="col-lg">
                    <label>Password <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <label class="ckbox wd-16 mg-b-0">
                              <input type="checkbox" onclick="myFunction()" class="mg-0"><span></span>
                            </label>
                          </div>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukan password">
                      </div><!-- input-group -->
                  </div>
              </div>
            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <label>Nama Kesatuan <span class="tx-danger">*</span></label>
                    <select class="form-control" id="select2-no-search" name="kesatuan">
                        @foreach ($unit as $a)
                            <option value="{{$a->id}}">{{$a->nama_unit}}</option>         
                        @endforeach
                      </select>
                </div>
              </div>
            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <label>Hak Akses <span class="tx-danger">*</span></label>
                    <select class="form-control" id="select2-no-search" name="status">   
                        <option value="Administrator">[Level Akses 1] Administrator </option>   
                        <option value="Kepala Kesatuan">[Level Akses 2] Kepala Kesatuan (Kasat) </option>         
                        <option value="Kepolisian Resor">[Level Akses 3] Kepolisian Resor (Polres)</option>            
                      </select>
                </div>
              </div>
            <div class="row row-sm mg-t-20">
                <div class="col-lg">
                    <label>Nama Kesatuan <span class="tx-danger">*</span></label>
                    <textarea rows="4" class="form-control" placeholder="..." name="keterangan"></textarea>
                  </div><!-- col -->
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
        function myFunction(){
            var x = document.getElementById('password');
            if(x.type === "password"){
                x.type = "text";
            }else{
                x.type = "password";
            }
        }



        $(document).ready(function() {
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

