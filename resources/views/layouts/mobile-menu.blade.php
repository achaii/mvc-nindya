{{--NAVAIGATION--}}
<?php 
    $bulan = Carbon\Carbon::now()->format('m');
    $tahun = Carbon\Carbon::now()->format('Y');
?>
<div class="appBottomMenu">
    <a href="{{Route('mobiledashboard',[$tahun,$bulan])}}" class="item {{set_active('mobiledashboard')}}">
        <div class="col">
            <ion-icon name="pie-chart-outline"></ion-icon>
            <strong>OVERVIEW</strong>
        </div>
    </a>
    @if(Session::get('status') == 'Anggota' or Session::get('status') == 'Kasat' or Session::get('status') == 'Administrator')
    <a href="{{Route('mobileinput')}}" class="item {{set_active('mobileinput')}}">
        <div class="col">
            <ion-icon name="document-text-outline"></ion-icon>
            <strong>INPUT SELRA</strong>
        </div>
    </a>
    @endif
    <a href="{{Route('mobilepagelaporan')}}" class="item {{ set_active('mobilepagelaporan') }}">
        <div class="col">
            <ion-icon name="apps-outline"></ion-icon>
            <strong>LAPORAN</strong>
        </div>
    </a>
    <a href="{{Route('mobileprofil')}}" class="item {{set_active('mobileprofil')}}">
        <div class="col">
            <ion-icon name="person-outline"></ion-icon>
            <strong>PROFIL</strong>
        </div>
    </a>
    {{-- <a href="javascript:;" class="item" data-toggle="modal" data-target="#sidebarPanel">
        <div class="col">
            <ion-icon name="menu-outline"></ion-icon>
            <strong>Menu</strong>
        </div>
    </a> --}}
</div>


{{--NAVIGATION SIDE--}}
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- profile box -->
                <div class="profileBox pt-2 pb-2">
                    <div class="image-wrapper">
                        <img src="{{asset('public/asset/img-profil/'.Session::get('gambar'))}}" alt="image" class="imaged w36"
                        style="width:36px;
                        height:36px;
                        object-fit:fill;">
                    </div>
                    <div class="in">
                        <strong>{{Session::get('nama')}}</strong>
                        <div class="text-success">Level {{Session::get('status')}}</div>
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->
                <!-- balance -->
                <div class="sidebar-balance">
                    <div class="listview-title">Unit</div>
                    <div class="in">
                        <h4 class="amount">{{Session::get('name')}}</h4>
                    </div>
                </div>
                <!-- * balance -->

                <!-- action group -->
                {{-- <div class="action-group">
                    <a href="#" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="add-outline"></ion-icon>
                            </div>
                            Deposit
                        </div>
                    </a>
                    <a href="#" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            Withdraw
                        </div>
                    </a>
                    <a href="#" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="arrow-forward-outline"></ion-icon>
                            </div>
                            Send
                        </div>
                    </a>
                    <a href="app-cards.html" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            My Cards
                        </div>
                    </a>
                </div> --}}
                <!-- * action group -->

                <!-- menu -->
                <div class="listview-title mt-1">Menu</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="{{Route('mobiledashboard',[$tahun,$bulan])}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="pie-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Overview
                            </div>
                        </a>
                    </li>
                    @if(Session::get('status') == 'Anggota' or Session::get('status') == 'Kasat' or Session::get('status') == 'Administrator')
                    <li>
                        <a href="{{Route('mobileinput')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Input Selra
                            </div>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{Route('mobilepagelaporan')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="apps-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Laporan
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{Route('mobileberita')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="newspaper-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Berita
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{Route('mobileprofil')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Profil
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * menu -->

                <!-- others -->
                <div class="listview-title mt-1">Others</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="{{Route('mobileloginlogout')}}" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Log out
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * others -->
            </div>
        </div>
    </div>
</div>