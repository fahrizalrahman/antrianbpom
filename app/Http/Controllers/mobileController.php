<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use DB;
use Redirect;
use App\Loket;
use App\judulLayanan;
use App\user_profile;
use App\Sublayanan;

class mobileController extends Controller{

	public function ambil_antrian(Request $request){
		if(Auth::check()){
			if($request->jenis==='layanan'){
				/*Check Hari*/
				$_hari = \App\helper\Tanggal::ambil_hari($request->tanggal);
				$_check = DB::table('setting_haris')
					-> where([
						'id_loket'	=> $request->data,
						'hari'		=> strtolower($_hari)])
					-> first();
				if(is_null($_check)){
					return "hari tidak bisa";
				}else{
					/*Check jam hari ini*/
					$_hari_ini = \App\helper\Tanggal::ambil_hari(now());
					$_waktu = Loket::select('batas_dari_jam', 'batas_sampai_jam', 'batas_antrian')
							-> where('id', '=', $request->data)
							-> first();
					$_no_antri = (DB::table('antrians')
						-> where([
							'id_loket'		=> $request->data,
							'tgl_antrian'	=> $request->tanggal
							])
						-> count()) + 1;

						$_jam = date('H');
						if((intval($_jam) >= $_waktu->batas_sampai_jam)){
							return	$_antri = 'sudah tutup';
						}elseif((intval($_jam) <= $_waktu->batas_dari_jam)){
							return	$_antri = 'belum buka';
						}elseif((intval($_no_antri) > $_waktu->batas_antrian)){
							return	$_antri = 'tiket habis';
						}else{
							DB::table('antrians')
							-> insert([
								'id_loket'		=> $request->data,
								'status'		=> 'antri',
								'no_antrian'	=>	$_no_antri,
								'id_user'		=> Auth()->user()->id,
								'created_at'	=> now(),
								'updated_at'	=> now(),
								'tgl_antrian'	=> $request->tanggal]);

						return	$_antri = 'masih bisa';
						}

					 
					
				}
			}elseif($request->jenis==='sub_layanan'){
				/*Check Hari*/
				$_hari = \App\helper\Tanggal::ambil_hari($request->tanggal);
				$_check = DB::table('setting_hari_subs')
					-> where([
						'id_sublayanan'	=> $request->data,
						'hari'		=> strtolower($_hari)])
					-> first();
				if(is_null($_check)){
					return "hari tidak bisa";
				}else{
					/*Check jam hari ini*/
					$_hari_ini = \App\helper\Tanggal::ambil_hari(now());

					$_waktu = Sublayanan::select('batas_dari_jam', 'batas_sampai_jam', 'batas_antrian')
							-> where('id', '=', $request->data)
							-> first();

					$_head_loket = DB::table('sublayanans')
						-> select('id_loket')
						-> where('id', '=', $request->data)
						-> first();

					$_no_antri = (DB::table('antrians')
						-> where([
							'id_loket'		=> $_head_loket->id_loket,
							'tgl_antrian'	=> $request->tanggal
							])
						-> count()) + 1;

						$_jam = date('H');
						
						if((intval($_jam) >= $_waktu->batas_sampai_jam)){
							return	$_antri = 'sudah tutup';
						}elseif((intval($_jam) <= $_waktu->batas_dari_jam)){
							return	$_antri = 'belum buka';
						}elseif((intval($_no_antri) > $_waktu->batas_antrian)){
							return	$_antri = 'tiket habis';
						}else{
							DB::table('antrians')
							-> insert([
								'id_loket'		=> $_head_loket->id_loket,
								'status'		=> 'antri',
								'no_antrian'	=>	$_no_antri,
								'id_user'		=> Auth()->user()->id,
								'id_sublayanan'	=> $request->data,
								'created_at'	=> now(),
								'updated_at'	=> now(),
								'tgl_antrian'	=> $request->tanggal]);

							return $_antri = 'masih bisa';
						}

				}

			}
		}
	}

	public function booking_layanan(Request $request){
		if(Auth::check()){
			if($request->data!=='0'){
				$_loket = Sublayanan::select('id', 'nama_sublayanan', 'kode_loket')
					-> where('id_loket', '=', $request->content)
					-> get();
				$_layanan = Loket::select('nama_layanan', 'kode', 'lantai')
					-> where('id', $request->content)
					-> first();
				$_content = view::make('/mobile/partials/pages/subpages/sub_sub_booking')
					-> with('loket', $_loket)
					-> with('layanan', $_layanan)
					-> with('jenis', 'sub_layanan');

				return $_content;
			}else{
				if($request->jenis==='layanan'){
					$data = DB::table('lokets')
						-> select('kode', 'nama_layanan')
						-> where('id', '=', $request->content)
						-> first();
				}else{
					$data = DB::table('sublayanans AS a')
						-> leftJoin('lokets AS b', 'b.id', '=', 'a.id_loket')
						-> select('b.kode', 'b.nama_layanan', 'a.nama_sublayanan')
						-> where('a.id', '=', $request->content)
						-> first();
				}
				$_content = view::make('/mobile/partials/pages/subpages/booking_layanan')
					-> with('_data', $data)
					-> with('jenis', $request->jenis)
					-> with('rowid', $request->content);

				return $_content;
			}
		}else{
			Auth::logout();
		}
	}

	public function load_content_data(Request $request){
		if(Auth::check()){
			if($request->q==='load_sub_content'){
				$_loket = DB::table('view_sub_layanan')
					-> where('lantai', '=', $request->data)
					-> get();
				$_layanan = judulLayanan::select('keterangan')
					-> where('id', $request->data)
					-> first();
				$_content = view::make('/mobile/partials/pages/subpages/sub_booking')
					-> with('loket', $_loket)
					-> with('layanan', $_layanan)
					-> with('jenis', 'layanan');
			}
			return $_content;
		}else{
			Auth::logout();
		}
	}

	public function edit_profile(Request $request){
		if(Auth::check()){
			$user_profile = user_profile::select()
				-> where('userid', '=', Auth()->user()->id)
				-> first();
			return view::make('mobile.partials.pages.subpages.edit_profile')
				-> with('_user_profile', $user_profile);
		}
	}

	public function load_content(Request $request){
		if(Auth::check()){
			if($request->data==='booking'){
				$judulLayanan = judulLayanan::select('id', 'keterangan')
					-> get();
				$_content = view::make('/mobile/partials/pages/' . $request->data, compact('judulLayanan'));
				return $_content;
			}elseif($request->data==='account'){
				$profile = user_profile::select()
					-> where('userid', Auth()->user()->id)
					-> first();
				if($profile){
					$_content = view::make('/mobile/partials/pages/' . $request->data, compact('profile'));
					return $_content;
				}else{
					return "Wizard";
				}
			}elseif($request->data==='monitor'){
				$data = DB::table('view_antrian')
					-> select('tgl_antrian', 'nama_layanan', 'nama_sub_layanan', 'nama_loket', 'nama_loket_sub_layanan', 'lantai', 'no_antrian', 'panggilan', 'status')
					-> whereRaw('id_user=' . Auth()->user()->id . ' And status<>"selesai"')
					-> get();
				$_content = view::make('/mobile/partials/pages/' . $request->data)
					-> with('_data', $data)
					-> render();
				return $_content;
			}elseif($request->data==='inbox'){
				$data = DB::table('view_history')
					-> select('tgl_antrian', 'nama_layanan', 'nama_sub_layanan', 'nama_loket', 'nama_loket_sub_layanan', 'lantai', 'no_antrian', 'mulai', 'selesai', 'kepuasan')
					-> where('id_user', '=', Auth()->user()->id)
					-> get();
				$_content = view::make('/mobile/partials/pages/' . $request->data)
					-> with('_data', $data)
					-> render();
				return $_content;
			}else{
				$_content = view::make('/mobile/partials/pages/' . $request->data);
				return $_content;
			}
		}else{
			Auth::logout();
		}
	}

	public function update(Request $request){
		if(Auth::check()){
			$user_profile = DB::table('user_profiles')
			-> where('userid', '=', Auth()->user()->id)
			-> update([
				'type'		=> $request->ed_type,
				'nama'		=> $request->ed_nama,
				'npwp'		=> $request->ed_npwp,
				'alamat'	=> $request->ed_alamat,
				'no_telp'	=> $request->ed_phone,
				'no_fax'	=> $request->ed_fax,
				'email_1'	=> $request->ed_email
			]);
			return Redirect::to('/home');
		}
	}

	public function store(Request $request){
		$_rowid = (DB::table('user_profiles')->count('id')) + 1;
		$user_profile = user_profile::create([
			'id'		=> $_rowid,
			'userid'	=> Auth()->user()->id,
			'type'		=> $request->ed_type,
			'nama'		=> $request->ed_nama,
			'npwp'		=> $request->ed_npwp,
			'alamat'	=> $request->ed_alamat,
			'no_telp'	=> $request->ed_phone,
			'no_fax'	=> $request->ed_fax,
			'email_1'	=> $request->ed_email
		]);
		return Redirect::to('/home');
	}
}
