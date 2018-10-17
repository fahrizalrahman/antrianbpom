<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@home')->middleware('verified');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
// Route Lantai
Route::get('/lantai', 'HomeController@lantai')->name('lantai');
Route::get('/lantai2', 'HomeController@lantai2')->name('lantai2');
Route::get('/lantai3', 'HomeController@lantai3')->name('lantai3');
Route::get('/lantai4', 'HomeController@lantai4')->name('lantai4');
Route::get('/lantai5', 'HomeController@lantai5')->name('lantai5');
Route::get('/lantai6', 'HomeController@lantai6')->name('lantai6');

Route::resource('loket','LoketController');
Route::get('/loket/delete/{id}', 'LoketController@delete')->name('loket.delete');

// Tambah Tulisan
Route::resource('inputTulisan','TulisanController');
// Route::get('/monitor','HomeController@TextMonitor')-name('monitor');

// Route Tambah Gambar
Route::resource('inputImg','FileController');
Route::resource('inputImgFoot','FotterController');
Route::resource('inputImgSid','SidebarController');

// Route Tambah User
Route::resource('user','AddUserController');
// Tambah Petugas
Route::resource('petugas','addPetugasController');

// Route Antrian
Route::get('/print-antrian/{id}', 'AntrianController@print')->name('print-antrian');
Route::get('/print-antrian-sub/{id}/{id_sub}', 'AntrianController@printSub')->name('print-antrian-sub');


// Route User
Route::get('/layanan/{id}', 'HomeController@layanan');
Route::get('/display', 'HomeController@display')->name('antrian')->middleware('verified');

Route::get('/utama','HomeController@utama')->name('utama');
Route::get('/monitor', 'HomeController@monitor')->name('monitor');
Route::get('/display', 'HomeController@display')->name('antrian');

//route dashboard pelanggan
Route::get('/profile-edit','ProfileController@editProfile')->name('profile');
Route::resource('profile','ProfileController');
Route::get('/history/pelanggan', 'AntrianController@history')->name('history');
Route::get('/monitor-tiket','AntrianController@monitorTiket')->name('monitor-tiket');
Route::get('/lihat-tiket/{id}','AntrianController@lihatTiket')->name('lihat-tiket');


/*Custom*/
Route::get('/proses/total', 'pelayananController@total_antrian');
Route::get('/proses/sisa', 'pelayananController@sisa_antrian');
Route::get('/proses/akhir', 'pelayananController@nomor_terakhir');
Route::get('/proses/berikut', 'pelayananController@nomor_berikut');
Route::get('/proses/konversi_nomor', 'pelayananController@konversi');
Route::get('/proses/check status', 'pelayananController@check_status');
Route::get('/proses/layanan/update', 'pelayananController@update_status');


//sublayanan
Route::resource('sublayanan','SublayananController');
Route::get('/sublayanan/delete/{id}', 'SublayananController@delete')->name('sublayanan.delete');

Route::get('pilih-sublayanan', 'AntrianController@pilih_sublayanan');


Route::get('count-antrian', 'AntrianController@count_antrian');
Route::get('cek-setting-hari', 'AntrianController@cekSettingHari');
Route::get('cek-setting-hari-sub', 'AntrianController@cekSettingHariSub');



//setting hari
Route::resource('settinghari','SettingHariController');
Route::get('/settinghari/delete/{id}', 'SettingHariController@delete')->name('settinghari.delete');


Route::get('cek-pilih-lantai', 'SettingHariController@cekPilihLantai');


/*Route pelayanan loket*/
Route::get('/layanan-antrian/{lantai}/{layanan}/{loket}', 'LoketController@petugas');


Route::get('/monitor','DisplayController@Display')->name('monitor');


/*Monitoring Layar*/
Route::get('/monitoring/1', 'monitoringController@layanan_satu');
Route::get('/monitoring/2', 'monitoringController@layanan_dua');
Route::get('/monitoring/3', 'monitoringController@layanan_tiga');
Route::get('/monitoring/4', 'monitoringController@layanan_empat');
Route::get('/monitoring/5', 'monitoringController@layanan_lima');
Route::get('/monitoring/6', 'monitoringController@layanan_enam');
Route::get('/monitoring/aktif', 'monitoringController@layanan_aktif');

//setting hari
Route::resource('settingharisub','SettingHariSubController');
Route::get('/settingharisub/delete/{id}', 'SettingHariSubController@delete')->name('settingharisub.delete');

/*Monitoring Layar Lantai 1*/
Route::get('/monitor/utama', 'Monitoring\monitoringController@layanan_utama');


Route::get('/monitoring/1', 'Monitoring\monitoringController@layanan_satu');
Route::get('/monitoring/2', 'Monitoring\monitoringController@layanan_dua');
Route::get('/monitoring/3', 'Monitoring\monitoringController@layanan_tiga');
Route::get('/monitoring/4', 'Monitoring\monitoringController@layanan_empat');
Route::get('/monitoring/5', 'Monitoring\monitoringController@layanan_lima');
Route::get('/monitoring/6', 'Monitoring\monitoringController@layanan_enam');
Route::get('/monitoring/aktif', 'Monitoring\monitoringController@layanan_aktif');

/*Monitoring Layar Lantai 2*/
Route::get('/monitoring2/1', 'Monitoring\monitoring2Controller@layanan_satu');
Route::get('/monitoring2/2', 'Monitoring\monitoring2Controller@layanan_dua');
Route::get('/monitoring2/3', 'Monitoring\monitoring2Controller@layanan_tiga');
Route::get('/monitoring2/4', 'Monitoring\monitoring2Controller@layanan_empat');
Route::get('/monitoring2/5', 'Monitoring\monitoring2Controller@layanan_lima');
Route::get('/monitoring2/6', 'Monitoring\monitoring2Controller@layanan_enam');
Route::get('/monitoring2/7', 'Monitoring\monitoring2Controller@layanan_tujuh');
Route::get('/monitoring2/aktif', 'Monitoring\monitoring2Controller@layanan_aktif');

/*Monitoring Layar Lantai 3*/
Route::get('/monitoring3/1', 'Monitoring\monitoring3Controller@layanan_satu');
Route::get('/monitoring3/2', 'Monitoring\monitoring3Controller@layanan_dua');
Route::get('/monitoring3/3', 'Monitoring\monitoring3Controller@layanan_tiga');
Route::get('/monitoring3/4', 'Monitoring\monitoring3Controller@layanan_empat');
Route::get('/monitoring3/5', 'Monitoring\monitoring3Controller@layanan_lima');
Route::get('/monitoring3/6', 'Monitoring\monitoring3Controller@layanan_enam');
Route::get('/monitoring3/7', 'Monitoring\monitoring3Controller@layanan_tujuh');
Route::get('/monitoring3/aktif', 'Monitoring\monitoring3Controller@layanan_aktif');

/*Monitoring Layar Lantai 4*/
Route::get('/monitoring4/1', 'Monitoring\monitoring4Controller@layanan_satu');
Route::get('/monitoring4/2', 'Monitoring\monitoring4Controller@layanan_dua');
Route::get('/monitoring4/3', 'Monitoring\monitoring4Controller@layanan_tiga');
Route::get('/monitoring4/aktif', 'Monitoring\monitoring4Controller@layanan_aktif');

/*Monitoring Layar Lantai 5*/
Route::get('/monitoring5/1', 'Monitoring\monitoring5Controller@layanan_satu');
Route::get('/monitoring5/2', 'Monitoring\monitoring5Controller@layanan_dua');
Route::get('/monitoring5/3', 'Monitoring\monitoring5Controller@layanan_tiga');
Route::get('/monitoring5/4', 'Monitoring\monitoring5Controller@layanan_empat');
Route::get('/monitoring5/aktif', 'Monitoring\monitoring5Controller@layanan_aktif');

/*Monitoring Layar Lantai 6*/
Route::get('/monitoring6/1', 'Monitoring\monitoring6Controller@layanan_satu');
Route::get('/monitoring6/2', 'Monitoring\monitoring6Controller@layanan_dua');
Route::get('/monitoring6/3', 'Monitoring\monitoring6Controller@layanan_tiga');
Route::get('/monitoring6/4', 'Monitoring\monitoring6Controller@layanan_empat');
Route::get('/monitoring6/5', 'Monitoring\monitoring6Controller@layanan_lima');
Route::get('/monitoring6/6', 'Monitoring\monitoring6Controller@layanan_enam');
Route::get('/monitoring6/aktif', 'Monitoring\monitoring6Controller@layanan_aktif');

/*Laporan Petugas*/
Route::get('/laporan/daftar-pengunjung', 'LoketController@laporan_pengunjung');
Route::get('/laporan/survey-pengunjung', 'LoketController@survey_pengunjung');
Route::get('/laporan/presensi-petugas', 'LoketController@presensi');


Route::get('/pelanggan/popup', 'LoketController@popup_pelanggan');
Route::get('/pelanggan/popup/survey', 'LoketController@survey_pelanggan');

Route::get('/petugas/report/create_pdf','LoketController@generatePDF');
Route::get('survey-pengunjung', 'HomeController@survey_pengunjung');
