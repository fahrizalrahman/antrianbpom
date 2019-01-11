<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use View;
use Auth;
use App\Loket;
use App\User;
use App\Sublayanan;
use App\Antrian;
use DB;
use Alert;
use Session;
use PDF;


class LoketUnitController extends Controller
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
            $loket = Loket::select(
                    'lokets.id AS id',
                     'lokets.nama_layanan',
                     'lokets.kode',
                     'lokets.kode_antrian',
                     'users.name AS petugas',
                     'lokets.lantai', 
                     'lokets.batas_dari_jam',
                     'lokets.batas_sampai_jam',
                     'lokets.batas_antrian'
                 )
                ->leftJoin('users', 'users.id', '=', 'lokets.petugas')
                ->where('users.unit',Auth::user()->unit)
                ->orderBy('id','asc')
                ->get();

        return view('unit.loket.index')->with(compact('loket'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if (Auth::check()) {
             return  view('unit.loket.create');
        }else{
             return  view('auth.login');
        }
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
                'nama_layanan'  => 'required|string',
                'kode' => 'required',
                'lantai' => 'required',
                'kode_antrian'=>'required',
                'petugas'   => 'unique:lokets'
                ]);

        

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Loket"
            ]);

         return redirect()->route('unit-loket.index');
    }


    public function prosesLayananUnit(Request $request){
                $cek_loket = Loket::where('petugas',$request->petugas)->count();
                $cek_sub = Sublayanan::where('petugas',$request->petugas)->count();
                $cek_kode_antrian = Loket::where('kode_antrian',$request->kode_antrian,'lantai',$request->lantai)->count();
                if ($cek_loket > 0 OR $cek_sub > 0) {
                    $return = 0;
                }elseif($cek_kode_antrian > 0){
                    $return = 2;
                }else{
                    $loket = Loket::create([
                        'nama_layanan'  => $request->nama_layanan,
                        'kode'          => $request->kode,
                        'lantai'        => $request->lantai,
                        'petugas'       => $request->petugas,
                        'batas_dari_jam'=> $request->batas_dari_jam,
                        'batas_sampai_jam'=> $request->batas_sampai_jam,
                        'batas_antrian'=> $request->batas_antrian,
                        'kode_antrian'  => $request->kode_antrian
                    ]);
                    $return = 1;  
                }
                

                return $return;
    }


    public function editLayananUnit(Request $request){
                $cek_loket = Loket::where('petugas',$request->petugas)->where('id','!=',$request->id)->count();
                $cek_sub = Sublayanan::where('petugas',$request->petugas)->count();
                $cek_kode_antrian = Loket::where('kode_antrian',$request->kode_antrian)->where('lantai',$request->lantai)->where('id','!=',$request->id)->count();
                if ($cek_loket > 0 OR $cek_sub > 0) {
                    $return = 0;
                }elseif($cek_kode_antrian > 0){
                    $return = 2;
                }else{
                    $loket = Loket::find($request->id);
                    $loket->update([
                        'nama_layanan'      => $request->nama_layanan,
                        'kode'              => $request->kode,
                        'lantai'            => $request->lantai,
                        'petugas'           => $request->petugas,
                        'batas_dari_jam'    => $request->batas_dari_jam,
                        'batas_sampai_jam'  => $request->batas_sampai_jam,
                        'batas_antrian'     => $request->batas_antrian,
                        'kode_antrian'      =>$request->kode_antrian
                    ]);
                    $return = 1;
                }
                return $return;
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
        if (Auth::check()) {
            $loket = Loket::find($id);
            return view('unit.loket.edit')->with(compact('loket'));
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
        //
        $this->validate($request, [
                'nama_layanan'  => 'required|string',
                'kode' => 'required',
                'lantai' => 'required',
                'kode_antrian'=>'required',
                'petugas'  =>'unique:lokets,petugas,'. $id
        ]);


        $loket = Loket::find($id);
        $loket->update([
            'nama_layanan'      => $request->nama_layanan,
            'kode'              => $request->kode,
            'lantai'            => $request->lantai,
            'petugas'           => $request->petugas,
            'batas_dari_jam'    => $request->batas_dari_jam,
            'batas_sampai_jam'  => $request->batas_sampai_jam,
            'batas_antrian'     => $request->batas_antrian,
            'kode_antrian'      =>$request->kode_antrian
        ]);

        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Loket"
            ]);
            
            return redirect()->route('unit-loket.index'); 

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
           Loket::where('id', $id)->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Mengapus Loket"
            ]);
            return redirect()->route('unit-loket.index');
    }
}
