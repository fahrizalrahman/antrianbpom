<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

class AddUserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = User::where('jabatan','pelanggan')->get();
        return view('loket.pelanggan.indexPelanggan', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loket.pelanggan.addPelanggan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $this->validate($request, [ 
         'nik' => 'required|unique:users|max:16',
         'no_telp' => 'required|unique:users',
         'email' => 'required|unique:users',
        ]);

        $usercreate = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jabatan' => 'pelanggan',
            'lantai' => 0,
            'password' => bcrypt('123456')
        ]);

        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Pelanggan"
            ]);


        return redirect()->route('user.index');
    }

        public function storePerusahaan(Request $request)
    {

        $this->validate($request, [ 
         'nik' => 'required|unique:users',
         'no_telp' => 'required|unique:users',
         'email' => 'required|unique:users',
         'npwp' => 'required|unique:users',
         'no_telp_perusahaan' => 'required|unique:users',
         'email_perusahaan' => 'required|unique:users',
        ]);

        $usercreate = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jabatan' => 'pelanggan',
            'lantai' => 0,
            'password' => bcrypt('123456'),
            'npwp' => $request->npwp,
            'nama_perusahaan' => $request->nama_perusahaan,
            'email_perusahaan' => $request->email_perusahaan,
            'no_telp_perusahaan' => $request->no_telp_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan

        ]);

        

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Pelanggan"
        ]);


        return redirect()->route('user.index');
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
        $editpelanggan = User::findorfail($id);
        return view('loket.pelanggan.editPelanggan', compact('editpelanggan'));
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
        $user = User::findorfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->no_telp = $request->no_telp;
        $user->alamat = $request->alamat;
        $user->jabatan = 'pelanggan';
        $user->lantai = $request->lantai;
        $user->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Pelanggan"
            ]);

        
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = User::findorfail($id);
        $pelanggan->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menghapus Pelanggan"
            ]);

        return redirect()->route('user.index');
    }
}
