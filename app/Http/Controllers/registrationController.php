<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use DB;
use View;

class registrationController extends Controller{

	public function simpan(Request $request){
		DB::table('users')
			-> insert([
				'name'		=> $request->name,
				'email'		=> $request->email,
				'password'	=> bcrypt($request->password),
				'lantai'	=> 0,
				'jabatan'	=> 'pelanggan']);
		return Redirect::to('/user/registration/success')
			-> with('_email', $request->email);
	}

	public function success(Request $request){
		return view::make('mobile.register_berhasil')
			-> with('_email', $request->_email);
	}
}
