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

class LoketController extends Controller
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

    public function generatePDFPengunjung(Request $request){
                $datas = DB::table('pelayanans as pel')
                        -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as nama_pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub', DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
                        ->leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                        ->leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                        ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                        ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                        ->where(DB::raw('DATE(ans.tgl_antrian)'),'>=',$request->ed_mulai)
                        ->where(DB::raw('DATE(ans.tgl_antrian)'),'<=',$request->ed_sampai)
                        ->where('pel.id_petugas', '=', Auth()->user()->id)
                        ->get();

             $pdf = PDF::loadView('pdf_laporan_petugas.layout_laporan_pengunjung',['_data' => $datas,'ed_mulai'=>$request->ed_mulai,'ed_sampai'=>$request->ed_sampai,'petugas'=> Auth()->user()->name]);
      
            return $pdf->download('layout_laporan_pengunjung.pdf');
    }

    public function generatePDFSurvey(Request $request){
                    $datas = DB::table('pelayanans as pel')
                        -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as nama_pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan')
                        ->leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                        ->leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                        ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                        ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                        ->where(DB::raw('DATE(ans.tgl_antrian)'),'>=',$request->ed_mulai)
                        ->where(DB::raw('DATE(ans.tgl_antrian)'),'<=',$request->ed_sampai)
                        ->where('pel.id_petugas', '=', Auth()->user()->id)
                        ->get();
            
             $pdf = PDF::loadView('pdf_laporan_petugas.layout_laporan_survey',['_data' => $datas,'ed_mulai'=>$request->ed_mulai,'ed_sampai'=>$request->ed_sampai,'petugas'=> Auth()->user()->name]);
      
            return $pdf->download('layout_laporan_survey.pdf');
    }

    public function generatePDFPresensi(Request $request){
                    $datas = DB::table('pelayanans as pel')
                        ->select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
                        ->leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                        ->leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                        ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                        ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                        ->where(DB::raw('DATE(ans.tgl_antrian)'),'>=',$request->ed_mulai)
                        ->where(DB::raw('DATE(ans.tgl_antrian)'),'<=',$request->ed_sampai)
                        ->where('pel.id_petugas', '=', Auth()->user()->id)
                        ->get();
            
             $pdf = PDF::loadView('pdf_laporan_petugas.layout_laporan_presensi',['_data' => $datas,'ed_mulai'=>$request->ed_mulai,'ed_sampai'=>$request->ed_sampai,'petugas'=> Auth()->user()->name]);
      
            return $pdf->download('layout_laporan_presensi.pdf');
    }
    

        public function generatePDFBooking(Request $request){
            
                $datas = DB::table('view_antrian')
                            -> select('tgl_antrian as tanggal', 'email as email', 'name as nama_pelanggan', 'no_telp as no_telp', 'nama_layanan as nama_layanan', 'nama_sub_layanan as sub_layanan', 'nama_loket as nama_loket','nama_loket_sub_layanan as nama_loket_sub','no_antrian as no_antrian')
                            -> where(DB::raw('DATE(tgl_antrian)'),'>',DB::raw('curdate()'))
                            ->where('petugas_layanan',Auth()->user()->id)
                            ->orWhere('petugas_sub_layanan',Auth()->user()->id)
                            ->get();

             $pdf = PDF::loadView('pdf_laporan_petugas.layout_laporan_booking',['_data' => $datas,'petugas'=> Auth()->user()->name]);
      
            return $pdf->download('layout_laporan_booking.pdf');
    }
    
        public function generatePDFPembatalan(Request $request){

                        $datas = DB::table('view_antrian')
                            -> select('tgl_antrian as tanggal', 'email as email', 'name as nama_pelanggan', 'no_telp as no_telp', 'nama_layanan as nama_layanan', 'nama_sub_layanan as sub_layanan', 'nama_loket as nama_loket','nama_loket_sub_layanan as nama_loket_sub','no_antrian as no_antrian','keterangan_batal as keterangan_batal')
                            -> where('status','batal')
                            ->where('petugas_layanan',Auth()->user()->id)
                            ->orWhere('petugas_sub_layanan',Auth()->user()->id)
                            ->get();

             $pdf = PDF::loadView('pdf_laporan_petugas.layout_laporan_pembatalan',['_data' => $datas,'petugas'=> Auth()->user()->name]);
      
            return $pdf->download('layout_laporan_pembatalan.pdf');

    }

        public function generatePDFSanksi(Request $request){

                    $datas = DB::table('view_antrian')
                        -> select('tgl_antrian as tanggal', 'email as email', 'name as nama_pelanggan', 'no_telp as no_telp', 'nama_layanan as nama_layanan', 'nama_sub_layanan as sub_layanan', 'nama_loket as nama_loket','nama_loket_sub_layanan as nama_loket_sub','no_antri','status', 'id_antrian as id')
                        -> where('status','sanksi')
                        ->where('petugas_layanan',Auth()->user()->id)
                        ->orWhere('petugas_sub_layanan',Auth()->user()->id)
                        ->get();

            $pdf = PDF::loadView('pdf_laporan_petugas.layout_laporan_sanksi',['_data' => $datas,'petugas'=> Auth()->user()->name]);

            return $pdf->download('layout_laporan_sanksi.pdf');
        }
        
        public function generatePDFAdminPengunjung(Request $request){
           
            if ($request->petugas == 'all') {
                
                $datass = DB::table('view_pelayanan')
                            -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan','pelanggan')
                            ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                            ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                            ->where('id_user',$request->id_user)
                            ->get();
                            
                }else{

                $datass = DB::table('view_pelayanan')
                            -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan')
                            ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                            ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                            ->where('petugas',$request->petugas)
                            ->where('id_user',$request->id_user)
                            ->get();

                }
            $nama_petugas = User::select('name')->where('id',$request->petugas)->first();

            $pdf = PDF::loadView('pdf_laporan_admin.layout_laporan_pengunjung',['_data' => $datass,'ed_mulai'=>$request->ed_mulai,'ed_sampai'=>$request->ed_sampai,'petugas'=>$request->petugas,'nama_petugas'=>$nama_petugas ]);
    
            return $pdf->download('layout_laporan_pengunjung_admin.pdf');
        }

        public function generatePDFAdminPetugas(Request $request){
           
            $datass = DB::table('view_pelayanan')
                            -> select('nama_petugas','tanggal','nama_layanan','sub_layanan','kepuasan','pelanggan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, mulai, selesai)) as lama'))
                            ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                            ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                            ->where('petugas',$request->petugas)
                            ->get();    
                
            $nama_petugas = User::select('name')->where('id',$request->petugas)->first();

            $pdf = PDF::loadView('pdf_laporan_admin.layout_laporan_petugas',['_data' => $datass,'ed_mulai'=>$request->ed_mulai,'ed_sampai'=>$request->ed_sampai,'petugas'=>$request->petugas,'nama_petugas'=>$nama_petugas ]);
    
            return $pdf->download('layout_laporan_petugas.pdf');
        }

        public function generatePDFAdminSurvey(Request $request)
        {
            if ($request->petugas == 'all' and $request->pelayanan == 'all') {
                $data = DB::table('view_pelayanan')
                        -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                        ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                        ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                        -> get();
            }elseif($request->petugas == 'all' and $request->pelayanan != 'all'){
                $data = DB::table('view_pelayanan')
                        -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                        ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                        ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                        ->where('kepuasan',$request->pelayanan)
                        -> get();                    
            }elseif($request->petugas != 'all' and $request->pelayanan == 'all'){
                $data = DB::table('view_pelayanan')
                        -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                        ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                        ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                        ->where('petugas',$request->petugas)
                        -> get();
             }else{
               $data = DB::table('view_pelayanan')
                        -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                        ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                        ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                        ->where('petugas',$request->petugas)
                        ->where('kepuasan',$request->pelayanan)
                        -> get();  
            }

            if ($request->petugas != 'all') {
                $nama_petugas = User::select('name')->where('id',$request->petugas)->first();
            }else{
                $nama_petugas = 'Semua';
            }

            $pdf = PDF::loadView('pdf_laporan_admin.layout_laporan_survey',['_data' => $data,'ed_mulai'=>$request->ed_mulai,'ed_sampai'=>$request->ed_sampai,'petugas'=>$request->petugas,'nama_petugas'=>$nama_petugas,'kepuasan'=>$request->pelayanan ]);
            
    
            return $pdf->download('layout_laporan_survey_admin.pdf');
            
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
                // ->where('lokets.lantai',$request->data_lantai)
                ->orderBy('lokets.lantai','asc')
                ->get();  
                return view('loket.index', compact('loket'));
            }elseif(Auth::user()->jabatan==='petugas_loket'){

                $loket = Loket::select('id', 'nama_layanan', 'kode', 'lantai', 'kode_antrian')
                    -> where ('petugas', '=', Auth::user()->id);

                if ($loket->count() > 0){

                $lokets = Loket::select('id', 'nama_layanan', 'kode', 'lantai', 'kode_antrian')
                    -> where ('petugas', '=', Auth::user()->id);

                $data = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.no_antrian', 'b.name', 'a.status')
                    -> whereRaw('(a.status="antri" or a.status="dipanggil" or a.status="diterima") And a.id_loket="' . $lokets->first()->id . '"')
                    -> get();

                $lewati = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.id', 'a.no_antrian', 'b.name')
                    -> whereRaw('a.status="lewati" And a.id_loket="' . $lokets->first()->id . '" and substr(a.created_at, 1, 10)=date_format(now(), "%Y-%m-%d")')
                    -> get();
                $kosong = 1;

                }else{

                $lokets = DB::table('sublayanans AS sub')
                    -> leftJoin('lokets AS lok', 'lok.id', '=', 'sub.id_loket')
                    -> select('sub.id as id', 'sub.nama_sublayanan as nama_layanan', 'sub.kode_loket as kode','lok.lantai as lantai','lok.kode_antrian as kode_antrian')
                    -> where ('sub.petugas', '=', Auth::user()->id);

                if ($lokets->count() > 0) {
                    $data = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.no_antrian', 'b.name', 'a.status')
                    -> whereRaw('(a.status="antri" or a.status="dipanggil" or a.status="diterima") And a.id_loket="' . $lokets->first()->id . '"')
                    -> get();

                    $lewati = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.id', 'a.no_antrian', 'b.name')
                    -> whereRaw('a.status="lewati" And a.id_loket="' . $lokets->first()->id . '" and substr(a.created_at, 1, 10)=date_format(now(), "%Y-%m-%d")')
                    -> get();

                    $kosong = 1;
                }else{
                    $data = "";
                    $lewati= "";
                    $kosong = 0;
                }


                }



                return view('petugas_loket.loket')
                    -> with('_loket', $lokets->first())
                    -> with('_data', $data)
                    -> with('_lewati', $lewati)
                    -> with('kosong', $kosong);
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


    public function cekPilihPetugas(Request $request){

        $data_loket = User::select('name','id')->where('lantai',$request->lantai)->where('jabatan','petugas_loket')->get();

         $select = '';
         $select .= '<div class="form-group">
                     <label for="petugas" class="col-md-2 control-label">Nama Petugas</label>
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
                     <label for="petugas" class="col-md-2 control-label">Nama Petugas</label>
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
            Auth::logout();
            return redirect('/login');
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
            Auth::logout();
            return redirect('/login');
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
            Auth::logout();
            return redirect('/login');
        }
    }

    public function popup_pelanggan(Request $request){
        if(Auth::check()){
            $response = new StreamedResponse();
            $response->headers->set('Content-Type', 'text/event-stream');
            $response->headers->set('Cache-Control', 'no-cache');
            $response->setCallback(
                function() {
                    $check = DB::table('pelayanans as a')
                        -> leftJoin('antrians as b', 'a.id_antrian', '=', 'b.id')
                        -> select('a.rowid', 'a.kepuasan')
                        -> whereRaw('substr(a.created_at, 1, 10)=date_format(now(), "%Y-%m-%d") and b.id_user="' . Auth()->user()->id . '" and a.kepuasan="0" and a.keterangan="selesai"')
                        -> first();

                    echo "retry: 5000\n";
                    if(!is_null($check)){
                        echo "data: 1\n\n";
                    }else{
                        echo "data: 0\n\n";
                    }
                    ob_flush();
                    flush();
                });
            $response->send();
        }else{
            Auth::logout();
            return redirect('/login');
        }
        /*
        if(Auth::check()){
            if((Auth()->user()->jabatan==='pelanggan')){
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
        */
    }

    public function show_popup(Request $request){
        if(Auth::check()){
            if($request->q==='show popup'){
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
            }else{
                return "0";
            }
        }else{
            Auth::logout();
            return redirect('/login');
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
        }else{
            Auth::logout();
            return redirect('/login');
        }
    }


    // public function tableLantaiLayanan(Request $request){
    //             $loket = Loket::select(
    //                 'lokets.id AS id',
    //                  'lokets.nama_layanan',
    //                  'lokets.kode',
    //                  'users.name AS petugas',
    //                  'lokets.lantai', 
    //                  'lokets.batas_dari_jam',
    //                  'lokets.batas_sampai_jam',
    //                  'lokets.batas_antrian'
    //              )
    //             ->leftJoin('users', 'users.id', '=', 'lokets.petugas')
    //             // ->where('lokets.lantai',$request->data_lantai)
    //             ->orderBy('id','asc')
    //             ->get();  

    //             $tables = '';
    //                 foreach ($loket as $value) {
    //             $tables .= '';
    //                         }
    //             $tables .=  '';

    //             return $tables;
             
    //         }
}
