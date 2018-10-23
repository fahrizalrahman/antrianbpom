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
}
