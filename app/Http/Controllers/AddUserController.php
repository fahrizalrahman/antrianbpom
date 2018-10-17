<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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

        $user = New User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->no_telp = $request->no_telp;
        $user->alamat = $request->alamat;
        $user->jabatan = 'pelanggan';
        $user->lantai = 0;
        $user->password = bcrypt($request->password);
        $user->save();
        
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
        $user->password = bcrypt($request->password);
        $user->save();
        
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

        return redirect()->route('user.index');
    }
}
