<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Antrian;
use App\Loket;
use App\Sublayanan;
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'name'  => 'required|string',
                'email' => 'required|unique:users,email,'. $id,
                'nik' => 'unique:users,nik,'. $id,
                'no_telp'=>'required|unique:users,no_telp,'. $id,

        ]);


        $update_user = User::find($id);
        $update_user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'nik'       => $request->nik,
            'no_telp'   => $request->no_telp,
            'alamat'    => $request->alamat,
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
                $image_resize->fit(200);
                $image_resize->save(public_path('foto_user/' . $filename));
                // hapus foto_home lama, jika ada
                if ($update_user->foto) {
                    $old_foto = $update_user->foto;
                    $filepath = public_path() . DIRECTORY_SEPARATOR . 'foto_user'
                    . DIRECTORY_SEPARATOR . $update_user->foto;
                    try {
                        File::delete($filepath);
                    } catch (FileNotFoundException $e) {
                        // File sudah dihapus/tidak ada
                    }
                }
                $update_user->foto = $filename;
                $update_user->save();
            }


       return view('pelanggan.profile',['data_user' => $update_user]);    
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
