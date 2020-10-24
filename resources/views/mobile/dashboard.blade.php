@extends('layouts.mobile')

@section('header')
    @include('layouts.mobile-header')
@endsection

@section('content')
            <!-- Wallet Card -->
            <div class="section wallet-card-section pt-1">
                <div class="wallet-card">
                    <!-- Balance -->
                    <div class="balance">
                        <div class="left">
                        <span class="title">INDIKATOR SELRA 
                            <?php 
                                 if($bulan == '01'){
                                    echo 'JANUARI';
                                }elseif($bulan == '02'){
                                    echo 'FEBRUARI';
                                }elseif($bulan == '03'){
                                    echo 'MARET';
                                }elseif($bulan == '04'){
                                    echo 'APRIL';
                                }elseif($bulan == '05'){
                                    echo 'MEI';
                                }elseif($bulan == '06'){
                                    echo 'JUNI';
                                }elseif($bulan == '07'){
                                    echo 'JULI';
                                }elseif($bulan == '08'){
                                    echo 'AGUSTUS';
                                }elseif($bulan == '09'){
                                    echo 'SEPTEMBER';
                                }elseif($bulan == '10'){
                                    echo 'OKTOBER';
                                }elseif($bulan == '11'){
                                    echo 'NOVEMBER';
                                }elseif($bulan == '12'){
                                    echo 'DESEMBER';
                                }
                            ?>
                        </span>
                            <h1 class="total">{{$total}} %</h1>
                            <h5 style="margin: 0px;padding:0px;">Angka Selralaka Polres : {{$jmlperkara}}</h5>
                            <h5 style="margin: 0px;padding:0px;">Angka Kejadian IRSMS &ensp;: <?php if($jmlselra == null){echo '0';}else{echo $jmlselra;} ?></h5>
                        </div>
                        @if(Session::get('status') == 'Kasat' or Session::get('status') == 'Anggota' or Session::get('status') == 'Administrator')
                        <div class="right">
                            <a href="#" class="button" data-toggle="modal" data-target="#depositActionSheet">
                                <ion-icon name="search-outline"></ion-icon>
                            </a>
                        </div>
                        @endif
                    </div>
                
                    <!-- Wallet Footer -->
                    <div class="wallet-footer">
                        @if(Session::get('status') == 'Anggota' or Session::get('status') == 'Kasat' or Session::get('status') == 'Administrator')
                        <div class="item">
                            <a href="{{Route('mobileinput')}}">
                                <div class="icon-wrapper bg-danger">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                </div>
                                <strong>Input Selra</strong>
                            </a>
                        </div>
                        @endif
                        <div class="item">
                            <a href="{{Route('mobilepagelaporan')}}">
                                <div class="icon-wrapper bg-success">
                                    <ion-icon name="apps-outline"></ion-icon>
                                </div>
                                <strong>Laporan</strong>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{Route('mobileberita')}}">
                                <div class="icon-wrapper">
                                    <ion-icon name="newspaper-outline"></ion-icon>
                                </div>
                                <strong>Berita</strong>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{Route('mobileprofil')}}">
                                <div class="icon-wrapper bg-warning">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                <strong>Profil</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if(Session::get('status') == 'Administrator')    
            <!-- LAPORAN HARIAN BULALAN POLRES -->
            <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">LAPORAN SELRA 
                                <?php
                                    if($bulan == '01'){
                                       echo 'JANUARI';
                                   }elseif($bulan == '02'){
                                       echo 'FEBRUARI';
                                   }elseif($bulan == '03'){
                                       echo 'MARET';
                                   }elseif($bulan == '04'){
                                       echo 'APRIL';
                                   }elseif($bulan == '05'){
                                       echo 'MEI';
                                   }elseif($bulan == '06'){
                                       echo 'JUNI';
                                   }elseif($bulan == '07'){
                                       echo 'JULI';
                                   }elseif($bulan == '08'){
                                       echo 'AGUSTUS';
                                   }elseif($bulan == '09'){
                                       echo 'SEPTEMBER';
                                   }elseif($bulan == '10'){
                                       echo 'OKTOBER';
                                   }elseif($bulan == '11'){
                                       echo 'NOVEMBER';
                                   }elseif($bulan == '12'){
                                       echo 'DESEMBER';
                                   }
                               ?>
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content">
                                Klik Data di Bawah Ini Untuk Data lebih Detail</br>
                                <font style="color:green">Data Valid : </font><font style="font-weight: bold">{{$valid}}</font> </br>
                                <font style="color:red">Data Tidak Valid : </font><font style="font-weight: bold">{{$tidakvalid}}</font> </br>
                                @foreach ($perkara as $item)
                                <a href="{{Route('mobilelaporandetailview',[$item->kategori,$item->id_unit,$tahun,$bulan,$item->id])}}">
                                <div class="card 
                                <?php 
                                    if($item->status == 'Menunggu Validasi'){
                                        echo 'bg-warning';
                                    }elseif($item->status == 'Data Tidak Valid'){
                                        echo 'bg-danger';    
                                    }elseif($item->status == 'Data Valid'){
                                        echo 'bg-success';
                                    }
                                ?> 
                                mb-2">
                                    <div class="card-header">{{$item->kategori}} / 
                                        {{substr($item->tanggal_kejadian,5,2).' '}}
                                        <?php 
                                        if(substr($item->tanggal_kejadian,4,2) == '01'){
                                            echo 'JANUARI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '02'){
                                            echo 'FEBRUARI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '03'){
                                            echo 'MARET ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '04'){
                                            echo 'APRIL ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '05'){
                                            echo 'MEI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '06'){
                                            echo 'JUNI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '07'){
                                            echo 'JULI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '08'){
                                            echo 'AGUSTUS ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '09'){
                                            echo 'SEPTEMBER ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '10'){
                                            echo 'OKTOBER ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '11'){
                                            echo 'NOVEMBER ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '12'){
                                            echo 'DESEMBER ';
                                        } 
                                    ?>
                                    {{substr($item->tanggal_kejadian,0,4)}} / {{$item->status}}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Unit : {{$item->nama_unit}}</h5>
                                        <h5 class="card-title">Nomor IRSMS : {{$item->noirsms}}</h5>
                                        <h5 class="card-title">Nomor LP : {{$item->nomor_lp}}</h5>
                                        <p class="card-text">
                                            Ket. Admin : <?php if($item->keterangan == ''){echo '-';}else{echo $item->keterangan;} ?><br> 
                                        </p>
                                    </div>
                                </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::get('status') == 'Kasat' or Session::get('status') == 'Anggota')    
            <!-- LAPORAN HARIAN BULALAN POLRES -->
            <div class="modal fade action-sheet" id="depositActionSheet" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">LAPORAN SELRA 
                                <?php
                                    if($bulan == '01'){
                                       echo 'JANUARI';
                                   }elseif($bulan == '02'){
                                       echo 'FEBRUARI';
                                   }elseif($bulan == '03'){
                                       echo 'MARET';
                                   }elseif($bulan == '04'){
                                       echo 'APRIL';
                                   }elseif($bulan == '05'){
                                       echo 'MEI';
                                   }elseif($bulan == '06'){
                                       echo 'JUNI';
                                   }elseif($bulan == '07'){
                                       echo 'JULI';
                                   }elseif($bulan == '08'){
                                       echo 'AGUSTUS';
                                   }elseif($bulan == '09'){
                                       echo 'SEPTEMBER';
                                   }elseif($bulan == '10'){
                                       echo 'OKTOBER';
                                   }elseif($bulan == '11'){
                                       echo 'NOVEMBER';
                                   }elseif($bulan == '12'){
                                       echo 'DESEMBER';
                                   }
                               ?>
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content">
                                Klik Data di Bawah Ini Untuk Data lebih Detail<br>
                                @foreach ($perkara as $item)
                                <a href="{{Route('mobilelaporandetailview',[$item->kategori,Session::get('id_unit'),$tahun,$bulan,$item->id])}}">
                                <div class="card 
                                <?php 
                                    if($item->status == 'Menunggu Validasi'){
                                        echo 'bg-warning';
                                    }elseif($item->status == 'Data Tidak Valid'){
                                        echo 'bg-danger';    
                                    }elseif($item->status == 'Data Valid'){
                                        echo 'bg-success';
                                    }
                                ?> 
                                mb-2">
                                    <div class="card-header">{{$item->kategori}} / 
                                        {{substr($item->tanggal_kejadian,5,2).' '}}
                                        <?php 
                                        if(substr($item->tanggal_kejadian,4,2) == '01'){
                                            echo 'JANUARI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '02'){
                                            echo 'FEBRUARI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '03'){
                                            echo 'MARET ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '04'){
                                            echo 'APRIL ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '05'){
                                            echo 'MEI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '06'){
                                            echo 'JUNI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '07'){
                                            echo 'JULI ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '08'){
                                            echo 'AGUSTUS ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '09'){
                                            echo 'SEPTEMBER ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '10'){
                                            echo 'OKTOBER ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '11'){
                                            echo 'NOVEMBER ';
                                        }elseif(substr($item->tanggal_kejadian,4,2) == '12'){
                                            echo 'DESEMBER ';
                                        } 
                                    ?>
                                    {{substr($item->tanggal_kejadian,0,4)}} / {{$item->status}}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Nomor IRSMS {{$item->noirsms}}</h5>
                                        <h5 class="card-title">Nomor LP {{$item->nomor_lp}}</h5>
                                        <p class="card-text">
                                            Ket. Admin : <?php if($item->keterangan == ''){echo '-';}else{echo $item->keterangan;} ?><br> 
                                        </p>
                                    </div>
                                </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- * Deposit Action Sheet -->
            @if(Session::get('status') == 'Kasubdit' or Session::get('status') == 'Administrator')
            <div class="section mt-4">
                <div class="section-heading">
                    <h2 class="title">Laporan Statistik(%)</h2>
                    <a href="#" class="link btn btn-primary" data-toggle="modal" data-target="#laporanpolres">Dalam Tabel</a>
                </div>
                <div class="row mt-2">
                    <div class="col-12 ">
                        <div class="stat-box">
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="account1">BULAN</label>
                                            <select class="form-control custom-select" id="bulan" name="bulan">
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
                                </div>
                                <div class="col-6">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="account1">TAHUN </label>
                                            <select class="form-control custom-select" id="tahun" name="tahun">
                                                @foreach ($atahun as $s)
                                                    <option <?php if($s->tahun == $tahun){echo 'selected';} ?> value="{{$s->tahun}}"> {{$s->tahun}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="chartjs-wrapper-demo">
                                <canvas id="cPolres"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2"></div>
                <div class="section-heading">
                    <h2 class="title">Laporan Selra 
                        <?php
                            if($bulan == '01'){
                                echo 'JANUARI';
                            }elseif($bulan == '02'){
                                echo 'FEBRUARI';
                            }elseif($bulan == '03'){
                                echo 'MARET';
                            }elseif($bulan == '04'){
                                echo 'APRIL';
                            }elseif($bulan == '05'){
                                echo 'MEI';
                            }elseif($bulan == '06'){
                                echo 'JUNI';
                            }elseif($bulan == '07'){
                                echo 'JULI';
                            }elseif($bulan == '08'){
                                echo 'AGUSTUS';
                            }elseif($bulan == '09'){
                                echo 'SEPTEMBER';
                            }elseif($bulan == '10'){
                                echo 'OKTOBER';
                            }elseif($bulan == '11'){
                                echo 'NOVEMBER';
                            }elseif($bulan == '12'){
                                echo 'DESEMBER';
                            }
                        ?>
                        {{$tahun}}
                    </h2>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="stat-box">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">POLRES</th>
                                            <th scope="col">P21</th>
                                            <th scope="col">SP3</th>
                                            <th scope="col">RJ</th>
                                            <th scope="col">SP2 LIDIK</th>
                                            <th scope="col">DIVERSI</th>
                                            <th scope="col">LIMPAH</th>
                                            <th scope="col">JML SELRA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($unit as $un)
                                        <tr>
                                            <td scope="row">
                                                <font size="1">{{$un->nama_unit}}</font>
                                            </td>
                                            <td>
                                                <?php 
                                                    $p21 = DB::table('perkara')
                                                    ->where('id_unit',$un->id)
                                                    ->where('kategori','P21')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                    ->count();    
                                                    echo $p21;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $sp3 = DB::table('perkara')
                                                    ->where('id_unit',$un->id)
                                                    ->where('kategori','SP3')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                    ->count();    
                                                    echo $sp3;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $rj = DB::table('perkara')
                                                    ->where('id_unit',$un->id)
                                                    ->where('kategori','RJ')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                    ->count();    
                                                    echo $rj;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $sp2lidik = DB::table('perkara')
                                                    ->where('id_unit',$un->id)
                                                    ->where('kategori','SP2 LIDIK')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                    ->count();    
                                                    echo $sp2lidik;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $diversi = DB::table('perkara')
                                                    ->where('id_unit',$un->id)
                                                    ->where('kategori','DIVERSI')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                    ->count();    
                                                    echo $diversi;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $limpah = DB::table('perkara')
                                                    ->where('id_unit',$un->id)
                                                    ->where('kategori','LIMPAH')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                    ->count();    
                                                    echo $limpah;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $total = $p21 + $sp3 + $rj + $sp2lidik + $diversi + $limpah;
                                                    echo $total;
                                                ?>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::get('status') == 'Kasubdit' or Session::get('status') == 'Administrator')
            <div class="modal fade action-sheet" id="laporanpolres" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laporan Statistik 
                                <?php 
                                if($bulan == '01'){
                                   echo 'JANUARI';
                               }elseif($bulan == '02'){
                                   echo 'FEBRUARI';
                               }elseif($bulan == '03'){
                                   echo 'MARET';
                               }elseif($bulan == '04'){
                                   echo 'APRIL';
                               }elseif($bulan == '05'){
                                   echo 'MEI';
                               }elseif($bulan == '06'){
                                   echo 'JUNI';
                               }elseif($bulan == '07'){
                                   echo 'JULI';
                               }elseif($bulan == '08'){
                                   echo 'AGUSTUS';
                               }elseif($bulan == '09'){
                                   echo 'SEPTEMBER';
                               }elseif($bulan == '10'){
                                   echo 'OKTOBER';
                               }elseif($bulan == '11'){
                                   echo 'NOVEMBER';
                               }elseif($bulan == '12'){
                                   echo 'DESEMBER';
                               }
                           ?>
                           {{' '.$tahun}}
                            </h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content">
                                <div class="section full mb-2">
                                    <div class="content-header mb-05">
                                        Formula <code>(Total Selra Polres / Total Kejadian IRSMS)*100</code>
                                    </div>
                                    <div class="wide-block p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Polres</th>
                                                        <th scope="col">Selra Polres</th>
                                                        <th scope="col">Kejadian IRSMS</th>
                                                        <th scope="col">%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $a = array('01','02','03','04','05','06','07','08','09','10','11','12');
                                                        $t = array();
                                                    ?>
                                                    @foreach ($unit as $bu)
                                                    <tr>
                                                        <th scope="row">
                                                            <?php 
                                                                $find = array('POLRES ','POLRESTABES ','POLRESTA ');
                                                                echo str_replace($find,'',$bu->nama_unit);
                                                            ?>
                                                        </th>
                                                        <td>
                                                            <?php 
                                                                $nilai = DB::table('perkara')
                                                                ->where('id_unit',$bu->id)
                                                                ->where('status','Data Valid')
                                                                ->where('tanggal_kejadian','LIKE',$tahun.$bulan.'%')
                                                                ->count();    
                                                                echo $nilai;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                            $jml = DB::table('selra')
                                                                    ->where('id_unit',$bu->id)
                                                                    ->where('bulan',$bulan)
                                                                    ->where('tahun',$tahun)
                                                                    ->first();

                                                            if($jml == null){
                                                                $jam = 0;
                                                            }else{
                                                                $jam = $jml->jmlselra;
                                                            }

                                                            echo $jam;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $t = ($nilai!=0 and $jam!=0) ? round(($nilai / $jam) * 100,2):0;    
                                                                echo $t;
                                                            ?>
                                                        </td>
                                                    </tr>  
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- LAPORAN POLRES -->
            @if(Session::get('status') == 'Kasat' or Session::get('status') == 'Anggota')
            <div class="section mt-4">
                @if(Session::get('status') == 'Kasat')
                <div class="section-heading">
                    <h2 class="title">Laporan Statistik(%)</h2>
                    <a href="#" class="link btn btn-primary" data-toggle="modal" data-target="#LAP">Dalam Tabel</a>
                </div>
                <div class="row mt-2">
                    <div class="col-12 ">
                        <div class="stat-box">
                            <div class="chartjs-wrapper-demo">
                                <canvas id="chartBar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="section-heading">
                    <h2 class="title">Laporan Selra {{$tahun}}</h2>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="stat-box">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">BULAN</th>
                                            <th scope="col">P21</th>
                                            <th scope="col">SP3</th>
                                            <th scope="col">RJ</th>
                                            <th scope="col">SP2 LIDIK</th>
                                            <th scope="col">DIVERSI</th>
                                            <th scope="col">LIMPAH</th>
                                            <th scope="col">JML SELRA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $a = array('01','02','03','04','05','06','07','08','09','10','11','12');
                                            $t = array();
                                        ?>
                                        @foreach ($a as $aa)
                                        <tr>
                                            <td scope="row">
                                            <?php 
                                                if($aa == '01'){
                                                    echo 'JANUARI';
                                                }elseif($aa == '02'){
                                                    echo 'FEBRUARI';
                                                }elseif($aa == '03'){
                                                    echo 'MARET';
                                                }elseif($aa == '04'){
                                                    echo 'APRIL';
                                                }elseif($aa == '05'){
                                                    echo 'MEI';
                                                }elseif($aa == '06'){
                                                    echo 'JUNI';
                                                }elseif($aa == '07'){
                                                    echo 'JULI';
                                                }elseif($aa == '08'){
                                                    echo 'AGUSTUS';
                                                }elseif($aa == '09'){
                                                    echo 'SEPTEMBER';
                                                }elseif($aa == '10'){
                                                    echo 'OKTOBER';
                                                }elseif($aa == '11'){
                                                    echo 'NOVEMBER';
                                                }elseif($aa == '12'){
                                                    echo 'DESEMBER';
                                                } 
                                            ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $p21 = DB::table('perkara')
                                                    ->where('id_unit',Session::get('id_unit'))
                                                    ->where('kategori','P21')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$aa.'%')
                                                    ->count();    
                                                    echo $p21;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $sp3 = DB::table('perkara')
                                                    ->where('id_unit',Session::get('id_unit'))
                                                    ->where('kategori','SP3')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$aa.'%')
                                                    ->count();    
                                                    echo $sp3;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $rj = DB::table('perkara')
                                                    ->where('id_unit',Session::get('id_unit'))
                                                    ->where('kategori','RJ')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$aa.'%')
                                                    ->count();    
                                                    echo $rj;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $sp2lidik = DB::table('perkara')
                                                    ->where('id_unit',Session::get('id_unit'))
                                                    ->where('kategori','SP2 LIDIK')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$aa.'%')
                                                    ->count();    
                                                    echo $sp2lidik;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $diversi = DB::table('perkara')
                                                    ->where('id_unit',Session::get('id_unit'))
                                                    ->where('kategori','DIVERSI')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$aa.'%')
                                                    ->count();    
                                                    echo $diversi;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $limpah = DB::table('perkara')
                                                    ->where('id_unit',Session::get('id_unit'))
                                                    ->where('kategori','LIMPAH')
                                                    ->where('status','Data Valid')
                                                    ->where('tanggal_kejadian','LIKE',$tahun.$aa.'%')
                                                    ->count();    
                                                    echo $limpah;
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    $total = $p21 + $sp3 + $rj + $sp2lidik + $diversi + $limpah;
                                                    echo $total;
                                                ?>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2"></div>
                <div class="section-heading">
                    <h2 class="title">Selralaka Tervalidasi</h2>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="value">P21</div>
                            <div class="title text-success">{{$p21}} Perkara</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="value">SP3</div>
                            <div class="title text-success">{{$sp3}} Perkara</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="value">RJ</div>
                            <div class="title text-success">{{$rj}} Perkara</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="value">SP2 LIDIK</div>
                            <div class="title text-success">{{$sp2lidik}} Perkara</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="value">DIVERSI</div>
                            <div class="title text-success">{{$diversi}} Perkara</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="value">LIMPAH</div>
                            <div class="title text-success">{{$limpah}} Perkara</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="value">BAS</div>
                            <div class="title text-success">{{$bas}} Perkara</div>
                        </div>
                    </div>
                </div>

                <!-- laporan tidak valid -->
                <div class="row mt-2"></div>
                <div class="section-heading">
                    <h2 class="title">Selralaka Belum Valid</h2>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="stat-box">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Nomor</th>
                                            <th scope="col">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datatidakvalid as $dtv)
                                        <tr>
                                            <td style="background:red;color:#fff">{{ $dtv->bulan }}</td>
                                            <td style="background:red;color:#fff">{{ $dtv->kategori }}</td>
                                            <td style="background:red;color:#fff">
                                                NoIRSMS.{{ $dtv->noirsms }}<br/>
                                                TglIRSMS.{{ $dtv->tglirsms }}<br/>
                                            </td>
                                            <td>
                                                <a href="{{Route('mobilelaporandetailview',[$dtv->kategori,$dtv->id_unit,'2020',$dtv->bulan,$dtv->id])}}" type="submit" class="btn btn-primary btn-block btn-lg">Lihat</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- LAPORAN BULANAN POLRES-->
            @if(Session::get('status') == 'Kasat' or Session::get('status') == 'Anggota')
            <div class="modal fade action-sheet" id="LAP" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Laporan Statistik {{$tahun}}</h5>
                        </div>
                        <div class="modal-body">
                            <div class="action-sheet-content">
                                <div class="section full mb-2">
                                    <div class="content-header mb-05">
                                        Formula <code>(Total Selra Polres / Total Kejadian IRSMS)*100</code>
                                    </div>
                                    <div class="wide-block p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Bulan</th>
                                                        <th scope="col">Selra Polres</th>
                                                        <th scope="col">Kejadian IRSMS</th>
                                                        <th scope="col">%</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $a = array('01','02','03','04','05','06','07','08','09','10','11','12');
                                                        $t = array();
                                                    ?>
                                                    @foreach ($a as $bu)
                                                    <tr>
                                                        <th scope="row">
                                                            <?php 
                                                                if($bu == '01'){
                                                                    echo 'JANUARI';
                                                                }elseif($bu == '02'){
                                                                    echo 'FEBRUARI';
                                                                }elseif($bu == '03'){
                                                                    echo 'MARET';
                                                                }elseif($bu == '04'){
                                                                    echo 'APRIL';
                                                                }elseif($bu == '05'){
                                                                    echo 'MEI';
                                                                }elseif($bu == '06'){
                                                                    echo 'JUNI';
                                                                }elseif($bu == '07'){
                                                                    echo 'JULI';
                                                                }elseif($bu == '08'){
                                                                    echo 'AGUSTUS';
                                                                }elseif($bu == '09'){
                                                                    echo 'SEPTEMBER';
                                                                }elseif($bu == '10'){
                                                                    echo 'OKTOBER';
                                                                }elseif($bu == '11'){
                                                                    echo 'NOVEMBER';
                                                                }elseif($bu == '12'){
                                                                    echo 'DESEMBER';
                                                                } 
                                                            ?>
                                                        </th>
                                                        <td>
                                                            <?php 
                                                                $nilai = DB::table('perkara')
                                                                ->where('id_unit',Session::get('id_unit'))
                                                                ->where('status','Data Valid')
                                                                ->where('tanggal_kejadian','LIKE',$tahun.$bu.'%')
                                                                ->count();    
                                                                echo $nilai;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                            $jml = DB::table('selra')
                                                                    ->where('id_unit',Session::get('id_unit'))
                                                                    ->where('bulan',$bu)
                                                                    ->where('tahun',$tahun)
                                                                    ->first();

                                                            if($jml == null){
                                                                $jam = 0;
                                                            }else{
                                                                $jam = $jml->jmlselra;
                                                            }

                                                            echo $jam;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $t = ($nilai!=0 and $jam!=0) ? round(($nilai / $jam) * 100,2):0;    
                                                                echo $t;
                                                            ?>
                                                        </td>
                                                    </tr>  
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- BERITA -->
            <div class="section full mt-4 mb-3">
                <div class="section-heading padding">
                    <h2 class="title">Berita Terkini</h2>
                    <a href="{{Route('mobileberita')}}" class="link">Lihat Semua</a>
                </div>
                <div class="shadowfix carousel-multiple owl-carousel owl-theme">
                    @foreach ($berita as $i)
                    <div class="item">
                        <a href="{{Route('mobileberitashow',[$i->id])}}">
                            <div class="blog-card">
                                <img src="{{URL::to('/').'/public/asset/img-berita/'.$i->gambar}}" alt="image" class="imaged w-100" 
                                style="width:100px;
                                height:100px;
                                object-fit:fill;">
                                <div class="text">
                                    <h4 class="title">{{$i->judul_berita}}</h4>
                                </div>
                            </div>
                        </a>
                    </div>  
                    @endforeach  
                </div>
            </div>
    
@endsection

@section('footer')
@include('layouts.mobile-footer')
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" rel="stylesheet">
    <style>
        .chartjs-wrapper-demo {
        height: 400px; }
    @media (max-width: 330px) {
        .chartjs-wrapper-demo {
        width: 290px; } }
    @media (min-width: 992px) {
        .chartjs-wrapper-demo {
        height: 300px; } }
    </style>
@endsection

@section('js')
    {{-- <script src="{{asset('public/mobile/js/jquery.min.js')}}"></script> --}}
    <script src="{{asset('public/mobile/js/Chart.bundle.min.js')}}"></script>
    <script>
    @if(Session::get('status') == 'Kasat' or Session::get('status') == 'Anggota')
        var ctx4 = document.getElementById('chartBar').getContext('2d');
        new Chart(ctx4, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
            label: 'Capaian ',
            data: [
                        <?php
                          echo $jahanam;
                        ?>
                    ],
            backgroundColor: '#007bff',
            borderColor: '#5BC236',
            borderWidth: 1,
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
            display: false,
                labels: {
                display: false
                }
            },
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero:true,
                fontSize: 12,
                }
            }],
            xAxes: [{
                stacked:false,
                ticks: {
                    autoSkip:false,
                    beginAtZero:false,
                    fontSize: 10,
                    max: 100,
                    min:0,
                    stepSize:1
                }
            }]
            }
        }
        });
    @endif

    @if(Session::get('status') == 'Kasubdit' or Session::get('status') == 'Administrator')
        var ctx3 = document.getElementById('cPolres').getContext('2d');
        new Chart(ctx3,{
            type: 'line',
            data: {
                labels: [<?php echo $units; ?>],
                datasets: [{
                    label: 'Capaian ',
                    data: [<?php echo $nilais; ?>],
                    backgroundColor: '#007bff',
                    borderColor: '#5BC236',
                    borderWidth: 1,
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontSize: 12,
                        }
                    }],
                    xAxes: [{
                        stacked:false,
                        ticks: {
                            autoSkip:false,
                            beginAtZero:false,
                            fontSize: 10,
                            max: 100,
                            min:0,
                            stepSize:1
                        }
                    }]
                }
            }
        });
    @endif

    $('select[name=tahun]').change(function(){
        var tahun = document.getElementById('tahun').value;
        var bulan = document.getElementById('bulan').value;
        window.location.href = "{{ URL::to('mobile-view/dashboard') }}" + "/" + tahun + "/" + bulan 
    }); 

    $('select[name=bulan]').change(function(){
        var tahun = document.getElementById('tahun').value;
        var bulan = document.getElementById('bulan').value;
        window.location.href = "{{ URL::to('mobile-view/dashboard') }}" + "/" + tahun + "/" + bulan 
    }); 
    </script>
@endsection