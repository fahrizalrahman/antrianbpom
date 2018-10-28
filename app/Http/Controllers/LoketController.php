<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Auth;
use App\Loket;
use App\Sublayanan;
use App\Antrian;
use DB;
use Alert;
use Session;
use PDF;

class LoketController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function generatePDF(Request $request){
        if(Auth::check()){
            if(Auth()->user()->jabatan==='petugas_loket'){
                $_data = ['title' => 'Laporan Daftar Pengunjung - BPOM'];
                if($request->has('download')){
                    $pdf = PDF::loadView('layouts.layout_laporan_pengunjung', $_data);
                    return $pdf->download('test');
                }
                return view('layouts.layout_laporan_pengunjung')
                    -> with('data', $_data);
            }
        }
    }

    public function index(){
        //  
        if (Auth::check()) {
            if(Auth::user()->jabatan==='admin'){
                $loket = Loket::select(
                    'lokets.id AS id',
                     'lokets.nama_layanan',
                     'lokets.kode',
                     'users.name AS petugas',
                     'lokets.lantai', 
                     'lokets.batas_dari_jam',
                     'lokets.batas_sampai_jam',
                     'lokets.batas_antrian'
                 )
                ->leftJoin('users', 'users.id', '=', 'lokets.petugas')
                ->orderBy('id','asc')
                ->orderBy('lantai','asc')
                ->get();  
                return view('loket.index')->with(compact('loket'));
            }elseif(Auth::user()->jabatan==='petugas_loket'){

                $loket = Loket::select('id', 'nama_layanan', 'kode', 'lantai', 'kode_antrian')
                    -> where ('petugas', '=', Auth::user()->id);

                if ($loket->count() > 0){

                $lokets = Loket::select('id', 'nama_layanan', 'kode', 'lantai', 'kode_antrian')
                    -> where ('petugas', '=', Auth::user()->id)
                    ->first();

                $data = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.no_antrian', 'b.name', 'a.status')
                    -> whereRaw('(a.status="antri" or a.status="dipanggil" or a.status="diterima") And a.id_loket="' . $lokets->id . '"')
                    -> get();

                $lewati = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.id', 'a.no_antrian', 'b.name')
                    -> whereRaw('a.status="lewati" And a.id_loket="' . $lokets->id . '" and substr(a.created_at, 1, 10)=date_format(now(), "%Y-%m-%d")')
                    -> get();

                }else{

                $lokets = DB::table('sublayanans AS sub')
                    -> leftJoin('lokets AS lok', 'lok.id', '=', 'sub.id_loket')
                    -> select('sub.id as id', 'sub.nama_sublayanan as nama_layanan', 'sub.kode_loket as kode','lok.lantai as lantai','lok.kode_antrian as kode_antrian')
                    -> where ('sub.petugas', '=', Auth::user()->id)
                    ->first();


                $data = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.no_antrian', 'b.name', 'a.status')
                    -> whereRaw('(a.status="antri" or a.status="dipanggil" or a.status="diterima") And a.id_loket="' . $lokets->id . '"')
                    -> get();

                $lewati = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.id', 'a.no_antrian', 'b.name')
                    -> whereRaw('a.status="lewati" And a.id_loket="' . $lokets->id . '" and substr(a.created_at, 1, 10)=date_format(now(), "%Y-%m-%d")')
                    -> get();

                }



                return view('petugas_loket.loket')
                    -> with('_loket', $lokets)
                    -> with('_data', $data)
                    -> with('_lewati', $lewati);

            }elseif(Auth::user()->jabatan==='pelanggan'){
                return "Pelanggan";
            }
        }else{
                return view('auth.login');
        }

    }

    public function petugas($lantai, $layanan, $loket, Request $request){
        if(Auth::check()){
            $layanan = Loket::select('nama_layanan', 'kode', 'lantai')
                -> where ('petugas', '=', Auth::user()->id)->first();

            $total = Antrian::select('id')
                -> where('id_loket', '=', Auth::user()->lantai)
                -> count();
            $sisa = Antrian::select('id')
                -> where(['id_loket'=>Auth::user()->lantai, 'status'=>'antri'])
                -> count();
            $saat_ini = DB::table('proses_antrians AS a')
                -> leftJoin('antrians AS b', 'b.id', '=', 'a.id_antrian')
                -> select('a.id', 'b.no_antrian')
                -> where([
                    'a.id_petugas'  => Auth::user()->id,
                    'a.status'      => 'proses'])
                -> first();
            $berikut = Antrian::select('no_antrian')
                -> where([
                        'status'    => 'antri',
                        'id_loket'  => Auth::user()->lantai
                    ])
                -> first();
            $data = DB::table('antrians AS a')
                -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                -> select('a.no_antrian', 'b.name', 'a.status')
                -> whereRaw('a.status<>"selesai" And a.status<>"lewati" And a.id_loket="' . Auth::user()->lantai . '"')
                -> get();

            return view('loket.index_antrian')
                -> with ('_layanan', $layanan)
                -> with('_total', $total)
                -> with('_sisa', $sisa)
                -> with('_saat_ini', $saat_ini)
                -> with('_berikut', $berikut)
                -> with('_data', $data);
        }else{
            return view('auth.login');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::check()) {
             return  view('loket.create');
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
        //
             $this->validate($request, [
                'nama_layanan'  => 'required|string',
                'kode' => 'required',
                'lantai' => 'required',
                'kode_antrian'=>'required',
                'petugas'   => 'unique:lokets'
                ]);

  //INSERT MASTER DATA KAS WARUNG, JADI DEFAULT KAS
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

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Loket"
            ]);

         return redirect()->route('loket.index');
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
            return view('loket.edit')->with(compact('loket'));
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
            
            return redirect()->route('loket.index'); 

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

        public function delete($id)
    {
        //
           Loket::where('id', $id)->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Mengapus Loket"
            ]);
            return redirect()->route('loket.index');
    }

    public function laporan_pengunjung(Request $request){
        if(Auth::check()){
            if(Auth()->user()->jabatan==='petugas_loket'){

                    $datas = DB::table('pelayanans as pel')
                        -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as nama_pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub', DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
                        -> leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                        -> leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                        ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                        ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                        -> where(DB::raw('DATE(ans.tgl_antrian)'),'>=',DB::raw('curdate()'))
                        -> where(DB::raw('DATE(ans.tgl_antrian)'),'<=',DB::raw('curdate()'))
                        -> where('pel.id_petugas', '=', Auth()->user()->id)
                        -> get();

                return view('petugas_loket.daftar pengunjung')
                    -> with('_data', $datas);
            }else{
                return "Anda tidak memiliki hak akses";
            }
        }else{
            return "Anda tidak memiliki hak akses";
        }
    }

    public function survey_pengunjung(Request $request){
        if(Auth::check()){
            if(Auth()->user()->jabatan==='petugas_loket'){
                $datas = DB::table('pelayanans as pel')
                        -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan')
                        -> leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                        -> leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                        ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                        ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                        -> where(DB::raw('DATE(ans.tgl_antrian)'),'>=',DB::raw('curdate()'))
                        -> where(DB::raw('DATE(ans.tgl_antrian)'),'<=',DB::raw('curdate()'))
                        -> where('pel.id_petugas', '=', Auth()->user()->id)
                        -> get();

                return view('petugas_loket.survey pengunjung')
                    -> with('_data', $datas);
            }else{
                return "Anda tidak memiliki hak akses";
            }
        }else{
            return "Anda tidak memiliki hak akses";
        }
    }

    public function presensi(Request $request){
        if(Auth::check()){
            if(Auth()->user()->jabatan==='petugas_loket'){
                   
                $datas = DB::table('pelayanans as pel')
                        -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
                        -> leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                        -> leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                        ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                        ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                        -> where(DB::raw('DATE(ans.tgl_antrian)'),'>=',DB::raw('curdate()'))
                        -> where(DB::raw('DATE(ans.tgl_antrian)'),'<=',DB::raw('curdate()'))
                        -> where('pel.id_petugas', '=', Auth()->user()->id);

                 return view('petugas_loket.presensi')
                        -> with('_data', $datas);
            }else{
                return "Anda tidak memiliki hak akses";
            }
        }else{
            return "Anda tidak memiliki hak akses";
        }
    }

    public function popup_pelanggan(Request $request){
        if(Auth::check()){
            if((Auth()->user()->jabatan==='pelanggan') || (Auth()->user()->jabatan==='pelanggan_1')){
                $content = '';
                $check = DB::table('pelayanans as a')
                    -> leftJoin('antrians as b', 'a.id_antrian', '=', 'b.id')
                    -> select('a.rowid', 'a.kepuasan')
                    -> whereRaw('substr(a.created_at, 1, 10)=date_format(now(), "%Y-%m-%d") and b.id_user="' . Auth()->user()->id . '" and a.kepuasan="0" and a.keterangan="selesai"')
                    -> first();
                if($check){
                    $content = View::make('pelanggan.popup survey')
                        -> with('_check', $check)
                        -> render();
                }
                return $content;
            }
        }
    }

    public function survey_pelanggan(Request $request){
        if(Auth::check()){
            if(Auth()->user()->jabatan==='pelanggan'){
                if($request->q==='popup'){
                    DB::table('pelayanans')
                        -> where('rowid', '=', $request->rowid)
                        -> update([
                                'kepuasan'  => $request->data,
                                'updated_at'=> now()
                            ]);
                    return '0';
                }else{
                    return '404. Page not found!';
                }
            }else{
                return '404. Page not found!';
            }
        }
    }
}
