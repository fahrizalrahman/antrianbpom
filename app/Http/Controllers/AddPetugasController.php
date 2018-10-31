<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;


class AddPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = User::where('jabatan','!=','pelanggan')->get();
        return view('loket.petugas.indexPetugas', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loket.petugas.addPetugas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $petugas = New User;
        $petugas->name = $request->name;
        $petugas->email = $request->email;
        $petugas->email_verified_at = now();
        $petugas->nik = $request->nik;
        $petugas->no_telp = $request->no_telp;
        $petugas->alamat = $request->alamat;
        $petugas->jabatan = $request->jabatan;
        $petugas->lantai = $request->lantai;
        $petugas->unit = $request->unit;
        $petugas->password = bcrypt('123456');
        $petugas->save();

        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Petugas"
            ]);


        return redirect()->route('petugas.index');
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
        $editPetugas = User::findorFail($id);
        return view('loket.petugas.editPetugas', compact('editPetugas'));
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
        $petugas = User::findorfail($id);
        $petugas->name = $request->name;
        $petugas->email = $request->email;
        $petugas->nik = $request->nik;
        $petugas->no_telp = $request->no_telp;
        $petugas->alamat = $request->alamat;
        // $petugas->jabatan = $request->jabatan;
        $petugas->lantai = $request->lantai;
        $petugas->unit = $request->unit;
        $petugas->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Petugas"
            ]);
        
        return redirect()->route('petugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petugas = User::findorfail($id);
        $petugas->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menghapus Petugas"
            ]);

        return redirect()->route('petugas.index');
    }

        public function reset($id)
    {
        
        $petugas = User::find($id);
        $petugas->password = bcrypt('123456');
        $petugas->save();


        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Reset Password"
            ]);


        return redirect()->route('petugas.index');
    }
}
