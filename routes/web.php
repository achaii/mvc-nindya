<?php

use Illuminate\Support\Facades\Route;

Route::match(['post','get'],'/','web\DashboardController@index')->name('webdashboard');

Auth::routes();


Route::match(['post','get'],'/managemen-laporan-periode-perbulan\update\{id}','web\PerkaraController@update_periodik')->name('weblaporanperiodebulanupdate');
Route::match(['post','get'],'/managemen-dashboard/update/{id}','web\DashboardController@update_dashboard')->name('webdashboardupdate');


//website
Route::match(['post','get'],'/managemen-dashboard','web\DashboardController@index')->name('webdashboard');
//management user
Route::match(['post','get'],'/managemen-user','web\MuserController@index')->name('webmuser');
Route::match(['post','get'],'/managemen-user-store','web\MuserController@store')->name('webmuserstore');
Route::match(['post','get'],'/managemen-user-update/{id}','web\MuserController@update')->name('webmuserupdate');
Route::match(['post','get'],'/managemen-user-destroy/{id}','web\MuserController@destroy')->name('webmuserdestroy');
//managemen unit
Route::match(['post','get'],'/managemen-unit','web\UnitController@index')->name('webmunit');
Route::match(['post','get'],'/managemen-unit-store','web\UnitController@store')->name('webmunitstore');
Route::match(['post','get'],'/managemen-unit-update/{id}','web\UnitController@update')->name('webmunitupdate');
Route::match(['post','get'],'/managemen-unit-destroy/{id}','web\UnitController@destroy')->name('webmunitdestroy');
Route::match(['post','get'],'/managemen-status','web\UnitController@status')->name('webmunitstatus');
Route::match(['post','get'],'/managemen-status-update/{id}','web\UnitController@status_valid')->name('webmunitstatusvalid');
Route::match(['post','get'],'/managemen-status-edit','web\UnitController@all')->name('webmunitall');
//managemen berita
Route::match(['post','get'],'/managemen-berita','web\BeritaController@index')->name('webberita');
Route::match(['post','get'],'/managemen-berita-store','web\BeritaController@store')->name('webberitastore');
Route::match(['post','get'],'/managemen-berita-update/{id}','web\BeritaController@update')->name('webberitaupdate');
Route::match(['post','get'],'/managemen-berita-edit/{id}','web\BeritaController@edit')->name('webberitaedit');
Route::match(['post','get'],'/managemen-berita-destroy/{id}','web\BeritaController@destroy')->name('webberitadestroy');
//managemen kejadian
Route::match(['post','get'],'/managemen-kejadian','web\SelraController@index')->name('webselra');
Route::match(['post','get'],'/managemen-kejadian-tahun','web\SelraController@tahun')->name('webselratahun');
Route::match(['post','get'],'/managemen-kejadian-generate','web\SelraController@generate')->name('webselragenerate');
Route::match(['post','get'],'/managemen-kejadian-update','web\SelraController@update')->name('webselraupdate');
Route::match(['post','get'],'/managemen-kejadian-destroy/{tahun}','web\SelraController@destroy')->name('webselradestroy');
//managemen validasi
Route::match(['post','get'],'/managemen-validasi','web\ValidasiController@index')->name('webvalidasi');
Route::match(['post','get'],'/managemen-validasi-store','web\ValidasiController@keterangan')->name('webvalidasiketerangan');
Route::match(['post','get'],'/managemen-validasi-destroy/{id}','web\ValidasiController@destroy')->name('webvalidasidestroy');
Route::match(['post','get'],'/managemen-validasi-update/{id}','web\ValidasiController@validasi')->name('webvalidasiupdate');
//laporan
Route::match(['post','get'],'/managemen-laporan-bulan','web\PerkaraController@laporan_bulan')->name('weblaporanbulanselra');
Route::match(['post','get'],'/managemen-laporan-bulan-update','web\PerkaraController@laporan_keterangan')->name('weblaporanbulanselraupdate');
Route::match(['post','get'],'/managemen-laporan-bulan-tanggal','web\PerkaraController@laporan_bulan_tanggal')->name('weblaporanbulantanggal');
Route::match(['post','get'],'/managemen-laporan-bulan-tanggal-update','web\PerkaraController@laporan_keterangan_tanggal')->name('weblaporanbulantanggalupdate');
Route::match(['post','get'],'/managemen-laporan-bulan-selra','web\PerkaraController@laporan_bulan_selra')->name('weblaporanbulanselratgl');
Route::match(['post','get'],'/managemen-laporan-tahun','web\PerkaraController@laporan_tahunan')->name('weblaporantahun');
Route::match(['post','get'],'/managemen-laporan-periode-perbulan','web\PerkaraController@laporan_periodik_bulan')->name('weblaporanperiodebulan');

//mobile
Route::match(['post','get'],'/mobile-view','mobile\LoginController@index')->name('mobilelogin');
Route::match(['post','get'],'/mobile-view/logout','mobile\LoginController@logout')->name('mobileloginlogout');
Route::match(['post','get'],'/mobile-view/dashboard/{tahun}/{bulan}','mobile\DashboardController@index')->name('mobiledashboard');
//mobile input
Route::match(['post','get'],'/mobile-view/input','mobile\MselraController@index')->name('mobileinput');
Route::match(['post','get'],'/mobile-view/input-store','mobile\MselraController@store')->name('mobileinputstore');
Route::match(['post','get'],'/mobile-view/input-store/noirsms','mobile\MselraController@noirsms')->name('noirsms');
Route::match(['post','get'],'/mobile-view/input-store/nolp','mobile\MselraController@nolp')->name('nolp');
//mobile berita
Route::match(['post','get'],'/mobile-view/berita','mobile\BeritaController@index')->name('mobileberita');
Route::match(['post','get'],'/mobile-view/berita-detail/{id}','mobile\BeritaController@show')->name('mobileberitashow');
//mobile laporan
Route::match(['post','get'],'/mobile-view/laporan','mobile\LoginController@page_laporan')->name('mobilepagelaporan');
Route::match(['post','get'],'/mobile-view/laporan-detail/{kategori}/{id_unit}/{tahun}/{bulan}','mobile\LoginController@laporan_detail')->name('mobilelaporandetail');
Route::match(['post','get'],'/mobile-view/laporan-detail-view/{kategori}/{id_unit}/{tahun}/{bulan}/{id}','mobile\LoginController@laporan_detail_view')->name('mobilelaporandetailview');
Route::match(['post','get'],'/mobile-view/laporan-detail-view-edit/{kategori}/{id_unit}/{tahun}/{bulan}/{id}','mobile\LoginController@edit_lp')->name('mobilelaporandetailedit');
Route::match(['post','get'],'/mobile-view/laporan-detail-view-destroy/{id}','mobile\LoginController@laporan_delete')->name('mobilelaporandestroy');
//mobile laporan
Route::match(['post','get'],'/mobile-view/laporan-bulan/{tahun}/{bulan}','mobile\LoginController@laporan_bulan')->name('mobilelaporanbulan');
Route::match(['post','get'],'/mobile-view/laporan-tahun/{id_unit}/{tahun}','mobile\LoginController@laporan_tahun')->name('mobilelaporantahun');
Route::match(['post','get'],'/mobile-view/laporan-statistik/{tahun}/{bulan}','mobile\LoginController@laporan_statistik')->name('mobilelaporanstatistik');
//mobile profil
Route::match(['post','get'],'/mobile-view/profil','mobile\DashboardController@profil')->name('mobileprofil');
Route::match(['post','get'],'/mobile-view/profil-edit','mobile\DashboardController@edit_profil')->name('mobileprofiledit');