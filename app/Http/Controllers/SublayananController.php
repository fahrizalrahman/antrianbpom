<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sublayanan;
use App\Loket;
use App\User;
use Auth;
use Session;

class SublayananController extends Controller
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
        //
        $data_sublayanan = Sublayanan::select([
                'lokets.nama_layanan as nama_layanan',
                'sublayanans.nama_sublayanan as nama_sublayanan',
                'sublayanans.id as id','lokets.lantai as lantai',
                'sublayanans.kode_loket as kode_loket',
                'sublayanans.batas_dari_jam as batas_dari_jam',
                'sublayanans.batas_sampai_jam as batas_sampai_jam',
                'sublayanans.batas_antrian as batas_antrian',
                'users.name AS petugas'
            ])
        ->leftjoin('lokets','lokets.id', '=', 'sublayanans.id_loket')
        ->leftJoin('users', 'users.id', '=', 'sublayanans.petugas')
        ->orderBy('sublayanans.kode_loket','asc')
        ->get();

        return view('sublayanan.index')->with(compact('data_sublayanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
             return  view('sublayanan.create');
        }else{
             return  view('auth.login');
        }
    }

    public function cekPilihPetugas(Request $request){

        $data_loket = User::select('name','id')->where('lantai',$request->lantai)->where('jabatan','petugas_loket')->get();

         $select = '';
         $select .= '<div class="form-group">
                     <label for="petugas" class="col-md-2 control-label">Nama Layanan</label>
                     <select id="petugas" class="form-control" name="petugas">
                     ';
                    foreach ($data_loket as $data_lokets) {

        $select .= '<option value="'.$data_lokets->id.'">'.$data_lokets->name.'         </option>';
                        }'
                        </select> 
                    </div>';

        return $select;
    }

    public function cekPilihPetugasEdit(Request $request){

        $data_loket = User::select('name','id')->where('lantai',$request->lantai)->where('jabatan','petugas_loket')->get();

         $select = '';
         $select .= '<div class="form-group">
                     <label for="petugas" class="col-md-2 control-label">Nama Layanan</label>
                     <select id="petugas" class="form-control" name="petugas">
                     ';
                    foreach ($data_loket as $data_lokets) {

        $select .= '<option value="'.$data_lokets->id.'">'.$data_lokets->name.'         </option>';
                        }'
                        </select> 
                    </div>';

        return $select;
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
                'kode_loket'        => 'required',
                'nama_sublayanan'   => 'required|string',
                'id_loket'          => 'required',
                'petugas'           =>'required|unique:sublayanans'
                ]);

                $sublayanan = Sublayanan::create([
                    'kode_loket'        => $request->kode_loket,
                    'nama_sublayanan'   => $request->nama_sublayanan,
                    'id_loket'          => $request->id_loket,
                    'petugas'           => $request->petugas,
                    'batas_dari_jam'    => $request->batas_dari_jam,
                    'batas_sampai_jam'  => $request->batas_sampai_jam,
                    'batas_antrian'     => $request->batas_antrian,
                ]);

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Sublayanan"
            ]);

         return redirect()->route('sublayanan.index');
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
       if (Auth::check()) {

            $sublayanan = Sublayanan::select([
                'lokets.nama_layanan as nama_layanan',
                'sublayanans.nama_sublayanan as nama_sublayanan',
                'sublayanans.id as id','lokets.lantai as lantai',
                'sublayanans.id_loket as id_loket',
                'sublayanans.kode_loket as kode_loket',
                'sublayanans.batas_dari_jam as batas_dari_jam',
                'sublayanans.batas_sampai_jam as batas_sampai_jam',
                'sublayanans.batas_antrian as batas_antrian'
            ])
            ->leftjoin('lokets','lokets.id', '=', 'sublayanans.id_loket')
            ->where('sublayanans.id',$id)
            ->first();

            return view('sublayanan.edit')->with(compact('sublayanan'));
        }else{
           return  view('auth.login'); 
        }  
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
                'kode_loket'        => 'required',
                'nama_sublayanan'   => 'required|string',
                'id_loket'          => 'required',
                'petugas'           =>'required|unique:sublayanans,petugas,'. $id
                ]);

        $sublayanan = Sublayanan::find($id);
        $sublayanan->update([
                    'kode_loket'       => $request->kode_loket,
                    'nama_sublayanan'  => $request->nama_sublayanan,
                    'id_loket'          => $request->id_loket,
                    'petugas'           => $request->petugas,
                    'batas_dari_jam'    => $request->batas_dari_jam,
                    'batas_sampai_jam'  => $request->batas_sampai_jam,
                    'batas_antrian'     => $request->batas_antrian,
                ]);

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubahs Sublayanan"
            ]);

         return redirect()->route('sublayanan.index');
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

        public function delete($id)
    {
        //
           Sublayanan::where('id', $id)->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Mengapus Sublayaan"
            ]);
            return redirect()->route('sublayanan.index');
    }
}
