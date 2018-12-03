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

// Route Tampil judulLayanan
// Route::get('judul_layanan','judulLayananController@judul_layanan')->name('homePelanggan.judul');

Route::get('cek_npwp', 'ProfileController@ceknpwp');


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
// Tambah Tulisan - Home
Route::resource('inputTulisanUtama','TulisanUtamaController');

// Route Tambah Gambar
Route::resource('inputImg','FileController');
Route::resource('inputImgFoot','FotterController');
Route::resource('inputImgSid','SidebarController');
Route::post('inputImageBg','FileController@storeBg')->name('imagebg.store');
Route::get('inputImageBg','FileController@createBg')->name('imagebg.createBg');
Route::get('viewbbg','FileController@ImageBg')->name('imagebg.view');
Route::get('inputImgHome','FileController@createImgHome')->name('imgHome.create');
Route::post('inputImgHome','FileController@storeHome')->name('imgHome.storeHome');
Route::get('viewImgHome','FileController@ImgHome')->name('imgHome.view');

Route::get('/proses/image/status','FileController@proses_status');

// Route Tambah File per-lantai
Route::get('inputImgLt2','FileController@Lt2')->name('loket.inputImg.indexImgLt2');
Route::get('inputImgLt3','FileController@Lt3')->name('loket.inputImg.indexImgLt3');
Route::get('inputImgLt4','FileController@Lt4')->name('loket.inputImg.indexImgLt4');
Route::get('inputImgLt5','FileController@Lt5')->name('loket.inputImg.indexImgLt5');
Route::get('inputImgLt6','FileController@Lt6')->name('loket.inputImg.indexImgLt6');

// Route Hapus File
Route::delete('inputImgLt2/destroy2/{id}','FileController@destroy2')->name('inputImgLt2.destroy2');
Route::delete('inputImgLt3/destroy3/{id}','FileController@destroy3')->name('inputImgLt3.destroy3');
Route::delete('inputImgLt4/destroy4/{id}','FileController@destroy4')->name('inputImgLt4.destroy4');
Route::delete('inputImgLt5/destroy5/{id}','FileController@destroy5')->name('inputImgLt5.destroy5');
Route::delete('inputImgLt6/destroy6/{id}','FileController@destroy6')->name('inputImgLt6.destroy6');

// Route::get('editImgBtn/{id}/status','FileController@editBtn')->name('indexImg.editBtn');

// Route Tambah User
Route::resource('user','AddUserController');
Route::post('/user-perusahaan', 'AddUserController@storePerusahaan')->name('store-perusahaan');

// Tambah Petugas
Route::resource('petugas','addPetugasController');
Route::get('/petugas-reset/{id}', 'addPetugasController@reset')->name('reset');
Route::get('/petugas/delete/{id}', 'addPetugasController@delete')->name('petugas.delete');

// Route Antrian
Route::get('/print-antrian/{id}', 'AntrianController@print')->name('print-antrian');
Route::get('/print-antrian-sub/{id}/{id_sub}', 'AntrianController@printSub')->name('print-antrian-sub');

// Route Unit
    // Tambah Background
Route::get('unit/bgcreate','FileController@createBgUnit')->name('bgunit.create');
Route::get('unit/bg','FileController@ImageBgUnit')->name('bgunit.index');

    // Petugas
Route::get('unit/petugas','UnitController@petugas')->name('unit.petugas');

// Route Admin Unit
Route::resource('AdminUnit','AdminUnitController');
// Laporan Pengunjung (Admin Unit)
// Route::get('unit/pengunjung','UnitController@laporan_pengunjung')->name('unit.pengunjung');
// Route::get('unit/presensi','UnitController@presensi')->name('unit.presensi');
// Route::get('unit/survey','UnitController@survey_pengunjung')->name('unit.survey');

//survey
Route::get('unit-survey-pengunjung', 'UnitController@survey_pengunjung');
Route::get('unit-filter-data-survey', 'UnitController@filterDataSurvey');

//pengunjung
Route::get('unit-laporan-pengunjung', 'UnitController@laporanPengunjung');
Route::get('unit-filter-laporan-pengunjung', 'UnitController@filterLaporanPengunjung');
Route::get('unit-lihat-list-kunjungan', 'UnitController@lihatListKunjungan');

//petugas
Route::get('unit-laporan-petugas', 'UnitController@laporanPetugas');
Route::get('unit-filter-laporan-petugas', 'UnitController@filterLaporanPetugas');
Route::get('unit-lihat-list-pelayanan', 'UnitController@lihatListPelayanan');

// Laporan Admin Unit (Daftar Booking & Daftar Pembatalan)
Route::get('daftar-booking/unit', 'UnitController@daftarBooking');
Route::get('daftar-pembatalan/unit', 'UnitController@daftarPembatalan');
Route::get('unit-filter-daftar-booking', 'UnitController@filterDaftarBooking');
Route::get('unit-filter-daftar-pembatalan', 'UnitController@filterDaftarPembatalan');


//Tambah Loket / Setting Hari Unit
Route::resource('unit-settinghari','SettingHariUnitController');
Route::get('/unit-settinghari/delete/{id}', 'SettingHariUnitController@delete')->name('unit-settinghari.delete');



Route::resource('unit-settingharisub','SettingHariSubUnitController');
Route::get('/unit-settingharisub/delete/{id}', 'SettingHariSubUnitController@delete')->name('unit-settingharisub.delete');



Route::resource('unit-loket','LoketUnitController');
Route::get('/unit-loket/delete/{id}', 'LoketUnitController@delete')->name('unit-loket.delete');


Route::resource('unit-sublayanan','SublayananUnitController');
Route::get('/unit-sublayanan/delete/{id}', 'SublayananUnitController@delete')->name('unit-sublayanan.delete');

// Route User
Route::get('/layanan/{id}', 'HomeController@layanan');

/*Route::get('/display', 'HomeController@display')->name('antrian')->middleware('verified');
Route::get('/utama','HomeController@utama')->name('utama');
Route::get('/monitor', 'HomeController@monitor')->name('monitor');
Route::get('/display', 'HomeController@display')->name('antrian');
*/


//route dashboard pelanggan
Route::get('/profile-edit','ProfileController@editProfile')->name('profile');
Route::resource('profile','ProfileController');
Route::post('/update-user/web', 'ProfileController@updateUser');
Route::get('/history/pelanggan', 'AntrianController@history')->name('history');
Route::get('/monitor-tiket','AntrianController@monitorTiket')->name('monitor-tiket');
Route::get('/lihat-tiket/{id}','AntrianController@lihatTiket')->name('lihat-tiket');


/*Custom*/
Route::get('/proses/total', 'pelayananController@total_antrian');
Route::get('/proses/sisa', 'pelayananController@sisa_antrian');
Route::get('/proses/akhir', 'pelayananController@nomor_terakhir');
Route::get('/proses/berikut', 'pelayananController@nomor_berikut');
Route::get('/proses/konversi_nomor', 'pelayananController@konversi');
Route::get('/proses/check_status', 'pelayananController@check_status');
Route::get('/proses/layanan/update', 'pelayananController@update_status');
Route::get('/proses/layanan/sanksi', 'pelayananController@proses_sanksi');


//sublayanan
Route::resource('sublayanan','SublayananController');
Route::get('/sublayanan/delete/{id}', 'SublayananController@delete')->name('sublayanan.delete');

Route::get('pilih-sublayanan', 'AntrianController@pilih_sublayanan');


Route::get('count-antrian', 'AntrianController@count_antrian');
Route::get('cek-setting-hari', 'AntrianController@cekSettingHari');
Route::get('cek-setting-hari-sub', 'AntrianController@cekSettingHariSub');
Route::get('logout', 'AntrianController@logout');



//setting hari
Route::resource('settinghari','SettingHariController');
Route::get('/settinghari/delete/{id}', 'SettingHariController@delete')->name('settinghari.delete');


Route::get('cek-pilih-lantai', 'SettingHariController@cekPilihLantai');


/*Route pelayanan loket*/
Route::get('/layanan-antrian/{lantai}/{layanan}/{loket}', 'LoketController@petugas');

//Route Unit
Route::resource('unit','UnitController'); 

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
Route::get('/pelanggan/popup/show', 'LoketController@show_popup');


//laporan (ADMIN)
//survey
Route::get('survey-pengunjung', 'HomeController@survey_pengunjung');
Route::get('filter-data-survey', 'HomeController@filterDataSurvey');

//pengunjung
Route::get('laporan-pengunjung', 'HomeController@laporanPengunjung');
Route::get('filter-laporan-pengunjung', 'HomeController@filterLaporanPengunjung');
Route::get('lihat-list-kunjungan', 'HomeController@lihatListKunjungan');

//petugas
Route::get('laporan-petugas', 'HomeController@laporanPetugas');
Route::get('filter-laporan-petugas', 'HomeController@filterLaporanPetugas');
Route::get('lihat-list-pelayanan', 'HomeController@lihatListPelayanan');


/*MOBILE ROUTE*/
Route::post('/user/registration', 'registrationController@simpan');
Route::get('/user/registration/success', 'registrationController@success');


Route::get('/mobile/content/load', 'mobileController@load_content');
Route::get('/mobile/content/edit/profile', 'mobileController@edit_profile');
Route::get('/mobile/content/load/subcontent', 'mobileController@load_content_data');
Route::get('/mobile/content/booking/layanan', 'mobileController@booking_layanan');
Route::get('/mobile/content/booking/booking_antrian', 'mobileController@ambil_antrian');

Route::resource('mobile','mobileController');
Route::post('/mobile/profile/update', 'mobileController@update');
Route::get('/mobile/profile/updatenpwp', 'mobileController@updatenpwp');
Route::get('/mobile/cek_npwp', 'mobileController@ceknpwp');

Route::get('laporan-data-pengunjung', 'HomeController@laporanDataPengunjung');
Route::get('laporan-survey-pengunjung', 'HomeController@laporanSurveyPengunjung');
Route::get('laporan-presensi-petugas', 'HomeController@laporanPresensiPetugas');
Route::get('daftar-booking', 'HomeController@daftarBooking');
Route::get('daftar-sanksi', 'HomeController@daftarSanksi');
Route::get('daftar-pembatalan', 'HomeController@daftarPembatalan');


Route::get('table-lantai-layanan', 'LoketController@tableLantaiLayanan');
Route::get('jv','HomeController@jv')->name('jv');

Route::get('/mobile/content/cek_quota_booking', 'mobileController@cekQuotaBooking');
Route::get('/mobile/content/update_batal_keterangan', 'mobileController@updateKeteranganBooking');

Route::get('daftar-sanksi', 'HomeController@daftarSanksi');
Route::get('/mobile/content/cek_tangal_merah', 'mobileController@cekTanggalMerah');

//DAFTAR PEMBATALAN

//download pdf petugas loket
Route::get('/petugas/report/create_pdf_pengunjung','LoketController@generatePDFPengunjung');
Route::get('/petugas/report/create_pdf_survey','LoketController@generatePDFSurvey');
Route::get('/petugas/report/create_pdf_presensi','LoketController@generatePDFPresensi');
Route::get('/petugas/report/create_pdf_booking','LoketController@generatePDFBooking');
Route::get('/petugas/report/create_pdf_pembatalan','LoketController@generatePDFPembatalan');
Route::get('/petugas/report/create_pdf_sanksi','LoketController@generatePDFSanksi');
//download pdf admin unit
Route::get('/petugas/report/create_pdf_pengunjung_unit','UnitController@generatePDFPengunjung');
Route::get('/petugas/report/create_pdf_survey_unit','UnitController@generatePDFSurvey');
Route::get('/petugas/report/create_pdf_presensi_unit','UnitController@generatePDFPresensi');
Route::get('/petugas/report/create_pdf_booking_unit','UnitController@generatePDFBooking');
Route::get('/petugas/report/create_pdf_pembatalan_unit','UnitController@generatePDFPembatalan');
// Download PDF Admin Utama
Route::get('/petugas/report/create_pdf_pengunjung_admin','LoketController@generatePDFAdminPengunjung');
Route::get('/petugas/report/create_pdf_petugas_admin','LoketController@generatePDFAdminPetugas');
Route::get('/petugas/report/create_pdf_survey_admin','LoketController@generatePDFAdminSurvey');


Route::get('cek_npwp_over', 'mobileController@ceknpwp');
Route::get('/mobile/cek_sanksi_pengunjung', 'mobileController@cekSanksiPengunjung');

Route::resource('banner-mobile','BannerMobileController');
