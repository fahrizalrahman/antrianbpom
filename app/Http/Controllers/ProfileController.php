<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Antrian;
use App\Loket;
use App\Sublayanan;
use App\user_profile;
use Auth;
use DB;
use Image;
use File;
use Redirect;

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
        $data_user = user_profile::select()
                    -> where('userid', '=', Auth()->user()->id)
                    -> first();
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

        $count = user_profile::where('userid',Auth()->user()->id)->count();
        if ($count > 0) {
                
                $user_profile = user_profile::find($request->id);
                $user_profile->update([
                        'type'      => $request->type,
                        'nama'      => $request->name,
                        'npwp'      => $request->npwp,
                        'alamat'    => $request->alamat,
                        'no_telp'   => $request->no_telp,
                        'nik'       => $request->nik,
                        'email_1'   => $request->email
                ]);


               if ($request->hasFile('foto')) {
                // Mengambil file yang diupload
                $foto          = $request->file('foto');
                $uploaded_foto = $foto;
                // mengambil extension file
                $extension = $uploaded_foto->getClientOriginalExtension();
                // membuat nama file random berikut extension
                $filename     = str_random(40) . '.' . $extension;
                $image_resize = Image::make($foto->getRealPath());
                $image_resize->fit(150,150);
                $image_resize->save(public_path('foto-profile/' . $filename));
                // hapus foto_home lama, jika ada
                if ($user_profile->foto) {
                    $old_foto = $user_profile->foto;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'foto-profile'
                    . DIRECTORY_SEPARATOR . $user_profile->foto;
                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                    }
                }
                $user_profile->foto = $filename;
                $user_profile->save();
            }

        }else{
            $_rowid = (DB::table('user_profiles')->count('id')) + 1;
               
                $user_profile = user_profile::create([
                    'id'        => $_rowid,
                    'userid'    => Auth()->user()->id,
                    'type'      => $request->type,
                    'nama'      => $request->name,
                    'npwp'      => $request->npwp,
                    'alamat'    => $request->alamat,
                    'no_telp'   => $request->no_telp,
                    'nik'       => $request->nik,
                    'email_1'   => $request->email
                ]);

                if ($request->hasFile('foto')) {
                    // Mengambil file yang diupload
                    $foto          = $request->file('foto');
                    $uploaded_foto = $foto;
                    // mengambil extension file
                    $extension = $uploaded_foto->getClientOriginalExtension();
                    // membuat nama file random berikut extension
                    $filename     = str_random(40) . '.' . $extension;
                    $image_resize = Image::make($foto->getRealPath());
                    $image_resize->fit(450,150);
                    $image_resize->save(public_path('foto-profile/' . $filename));
                    // hapus foto_home lama, jika ada
                    if ($user_profile->foto) {
                        $old_foto = $user_profile->foto;
                        $filepath = public_path() . DIRECTORY_SEPARATOR . 'foto-profile'
                        . DIRECTORY_SEPARATOR . $user_profile->foto;
                        try {
                            File::delete($filepath);
                        } catch (FileNotFoundException $e) {
                            // File sudah dihapus/tidak ada
                        }
                    }
                    $user_profile->foto = $filename;
                    $user_profile->save();
                 }

        }
       

            
        
        return Redirect::to('/profile-edit');

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
