<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Antrian;
use App\Loket;
use App\Sublayanan;
use App\user_profile;
use Auth;
use File;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function editProfile(){
        $data_user = User::select()->where('id',Auth::user()->id)->first();
       return view('pelanggan.profile',['data_user' => $data_user]);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // 
    }

    public function updateUser(Request $request)
    {

       $update_user = User::find($request->id);
            $update_user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'nik'       => $request->nik,
            'npwp'       => $request->npwp,
            'no_telp'   => $request->no_telp,
            'alamat'    => $request->alamat,
        ]);

            $user_profile = DB::table('user_profiles')
            -> where('userid', '=', $request->id)
            -> update([
                'nama'      => $request->name,
                'npwp'      => $request->npwp,
                'alamat'    => $request->alamat,
                'no_telp'   => $request->no_telp,
                'nik'       => $request->nik,
                'email_1'   => $request->email
            ]);
        
        return $update_user;

    }

    public function ceknpwp(Request $request)
    {
        $update_user = User::where('npwp', $request->npwp)->count();
        if($update_user > 2) {
            return 0;
        } else {
            return 1;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  
}
