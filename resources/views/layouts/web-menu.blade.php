<div class="az-navbar az-navbar-two az-navbar-dashboard-eight">
    <div class="container">
      <div><a href="{{Route('webdashboard')}}" class="az-logo">E-SELRA<span>LAKA</span></a></div>
      <div class="az-navbar-search">
      </div><!-- az-navbar-search -->
      <ul class="nav">
        <li class="nav-label">Halama Menu</li>
        <li class="nav-item {{set_active('webdashboard')}}">
          <a href="{{Route('webdashboard')}}" class="nav-link"><i class="typcn typcn-clipboard"></i>Dashboard</a>
        </li><!-- nav-item -->
        <li class="nav-item {{set_active('webmuser')}}{{set_active('webmunit')}}{{set_active('webmunitstatus')}}">
          <a href="#" class="nav-link with-sub"><i class="typcn typcn-document"></i>Managemen Data</a>
          <nav class="nav-sub">
            <a href="{{Route('webmuser')}}" class="nav-sub-link">Managemen Users</a>
            <a href="{{Route('webmunit')}}" class="nav-sub-link">Managemen Unit</a>
            <a href="{{Route('webmunitstatus')}}" class="nav-sub-link">Managemen Valid / Tidak Valid Unit</a>
          </nav>
        </li><!-- nav-item -->
        <li class="nav-item {{set_active('webberita')}}">
          <a href="#" class="nav-link with-sub"><i class="typcn typcn-book"></i>Artikel Berita</a>
          <nav class="nav-sub">
            <a href="{{Route('webberita')}}" class="nav-sub-link">Posting Berita</a>
          </nav>
        </li><!-- nav-item -->
        <li class="nav-item {{set_active('webselra')}}{{set_active('webvalidasi')}}">
          <a href="#" class="nav-link with-sub"><i class="typcn typcn-edit"></i>Managemen Selra</a>
          <nav class="nav-sub">
            <a href="{{Route('webselra')}}" class="nav-sub-link">Managemen Jml Kejadian IRSMS</a>
            <a href="{{Route('webvalidasi')}}" class="nav-sub-link">Managemen Validasi Selra Polres</a>
          </nav>
        </li><!-- nav-item -->
        <li class="nav-item {{set_active('weblaporantahun')}}{{set_active('weblaporanbulanselra')}}{{set_active('weblaporanbulantanggal')}}{{set_active('weblaporanbulanselratgl')}}">
          <a href="#" class="nav-link with-sub"><i class="typcn typcn-edit"></i>Managemen Laporan</a>
          <nav class="nav-sub">
            <a href="{{Route('weblaporantahun')}}" class="nav-sub-link">Laporan Tahunan</a>
            <a href="{{Route('weblaporanbulanselra')}}" class="nav-sub-link">Laporan Bulanan</a>
            <a href="{{Route('weblaporanperiodebulan')}}" class="nav-sub-link">Laporan Periode Bulan</a>
            <a href="{{Route('weblaporanbulantanggal')}}" class="nav-sub-link">Laporan Bulanan / Tanggal</a>
            <a href="{{Route('weblaporanbulanselratgl')}}" class="nav-sub-link">Laporan Bulanan / Kategori</a>
          </nav>
        </li><!-- nav-item -->
      </ul><!-- nav -->
    </div><!-- container -->
  </div><!-- az-navbar -->