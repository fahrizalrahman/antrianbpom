<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class AdminUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $user ;
    function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
    }

    public function index()
    {
        $AdminUnit = User::where('jabatan','admin_unit')->get();
        return view('loket.unit.indexUnit', compact('AdminUnit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AddAdminUnit = User::all();
        return view('loket.unit.addAdminUnit', compact('AddAdminUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $AddAdminUnit = New User;
        $AddAdminUnit->name = $request->name;
        $AddAdminUnit->email = $request->email;
        $AddAdminUnit->email_verified_at = now();
        $AddAdminUnit->nik = $request->nik;
        $AddAdminUnit->no_telp = $request->no_telp;
        $AddAdminUnit->alamat = $request->alamat;
        $AddAdminUnit->jabatan = 'admin_unit';
        $AddAdminUnit->lantai = $request->lantai;
        $AddAdminUnit->unit = $request->unit;
        $AddAdminUnit->password = bcrypt('123456');
        $AddAdminUnit->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Admin Unit"
            ]);


        return redirect()->route('AdminUnit.index');
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
        $AddAdminUnit = User::findorfail($id);
        return view('loket.unit.editAdminUnit', compact('AddAdminUnit'));
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
        $AddAdminUnit = User::findorfail($id);
        $AddAdminUnit->name = $request->name;
        $AddAdminUnit->email = $request->email;
        $AddAdminUnit->email_verified_at = now();
        $AddAdminUnit->nik = $request->nik;
        $AddAdminUnit->no_telp = $request->no_telp;
        $AddAdminUnit->alamat = $request->alamat;
        $AddAdminUnit->lantai = $request->lantai;
        $AddAdminUnit->unit = $request->unit;
        // $AddAdminUnit->password = $request->password;
        $AddAdminUnit->save();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengedit Admin Unit"
            ]);


        return redirect()->route('AdminUnit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $AddAdminUnit = User::findorfail($id);
        $AddAdminUnit->delete();

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menghapus Admin Unit"
            ]);

        return redirect()->route('AdminUnit.index');
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


        return redirect()->route('AdminUnit.index');
    }

    
}
