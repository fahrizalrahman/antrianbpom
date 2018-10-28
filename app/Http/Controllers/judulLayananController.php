<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class judulLayananController extends Controller

{
    //
    public function store(Request $request){
		$settinghari = judulLayanan::create([
			'keterangan'	=> $request->hari
		]);
		return redirect()->route('settinghari.index');
		}

	// public function judul_layanan()
	// {
	// 	$judul_layanan = judulLayanan::where('id','1');
	// 	return view('home_pelanggan', compact('judul_layanan'));
	// }
}
