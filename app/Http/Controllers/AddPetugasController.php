<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $petugas->password = bcrypt($request->password);
        $petugas->save();
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
        $petugas->password = bcrypt($request->password);
        $petugas->save();

        
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

        return redirect()->route('petugas.index');
    }
}
