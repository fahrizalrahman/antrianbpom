<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Session;
use PDF;

class UnitController extends Controller
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
        if (Auth::check()) {
            if (Auth()->user()->jabatan==='admin_unit') {
              
              $data = DB::table('summary_pelanggan')
                -> select('tanggal', DB::raw('count(jumlah) AS jml'))
                -> where('nama_unit',Auth()->user()->unit)
                -> groupBy('tanggal')
                -> get();

            $tanggal = '';
            $batas =  31;
            $nilai = '';
            for($_i=1; $_i <= $batas; $_i++){
                $tanggal = $tanggal . (string)$_i . ',';
                $_check = false;
                foreach($data as $_data){
                    if((int)@$_data->tanggal === $_i){
                        $nilai = $nilai . (string)$_data->jml . ',';
                        $_check = true;
                    }
                }
                if(!$_check){
                    $nilai = $nilai . '0,';
                }
            }

            $data1 = DB::table('view_pelayanan')
                -> select('kepuasan', DB::raw('count(id_antrian) AS jml'))
                -> where('nama_unit',Auth()->user()->unit)
                -> groupBy('kepuasan')
                -> get();

            $hasil = '';
            foreach($data1 as $data){
                if($data->kepuasan==='0'){$param = 'Tidak Survey';}
                elseif($data->kepuasan==='1'){$param = 'Sangat Puas';}
                elseif($data->kepuasan==='2'){$param = 'Puas';}
                elseif($data->kepuasan==='3'){$param = 'Tidak Puas';}
                $hasil = $hasil . '{name: "' . $param . '", y: ' . $data->jml . '},';
            }
             $count_antri = DB::table('view_antrian')
                    -> whereRaw('status="antri" and tgl_antrian= curdate() and ( unit_sublayanan="' . Auth::user()->unit . '" or unit_layanan="' . Auth::user()->unit . '")')
                    ->count();

            
            $count_batal = DB::table('view_antrian')
                    -> whereRaw('status="batal" and tgl_antrian= curdate() and ( unit_sublayanan="' . Auth::user()->unit . '" or unit_layanan="' . Auth::user()->unit . '")')
                    ->count();

            $count_terima = DB::table('view_antrian')
                    -> whereRaw('status="diterima" and tgl_antrian= curdate() and ( unit_sublayanan="' . Auth::user()->unit . '" or unit_layanan="' . Auth::user()->unit . '")')
                    ->count();
            
            $count_selesai = DB::table('view_antrian')
                    -> whereRaw('status="selesai" and tgl_antrian= curdate() and ( unit_sublayanan="' . Auth::user()->unit . '" or unit_layanan="' . Auth::user()->unit . '")')
                    ->count();

            return view('unit.home')
                -> with('_tanggal', substr($tanggal, 0,-1))
                -> with('_hasil', substr($hasil, 0, -1))
                -> with('_nilai', substr($nilai, 0, -1))
                -> with('count_antri',$count_antri)
                -> with('count_batal',$count_batal)
                -> with('count_terima',$count_terima)
                -> with('count_selesai',$count_selesai);

            }
        } else {
            return "Anda Tidak Memiliki Akses";
        }
        
        // return view('unit.home');
    }

    public function petugas()
    {
        $petugas = User::where('jabatan','petugas_loket')->where('unit', Auth::user()->unit)->orderBy('id','DESC')->get();
        return view('unit.petugas.indexPetugas', compact('petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.petugas.addPetugas');
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


        return redirect()->route('unit.petugas');
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
        $petugas = User::findorfail($id);
        return view('unit.petugas.editPetugas', compact('petugas'));
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
        $petugas->email_verified_at = now();
        $petugas->nik = $request->nik;
        $petugas->no_telp = $request->no_telp;
        $petugas->alamat = $request->alamat;
        $petugas->lantai = $request->lantai;
        $petugas->unit = $request->unit;
        $petugas->password = $request->password;
        $petugas->save();

        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengedit Petugas"
            ]);


        return redirect()->route('unit.petugas');
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
            "level"=>"danger",
            "message"=>"Berhasil Menghapus Petugas"
            ]);

        return redirect()->route('unit.petugas');
        
    }
    
        public function delete($id)
    {
        
        $petugas = User::findorfail($id);
        $petugas->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Menghapus Petugas"
            ]);

        return redirect()->route('unit.petugas');
        
    }
    

  

    // function Pengunjung
    public function laporanPengunjung(){
        $datass = DB::table('view_pelayanan')
                       -> select('pelanggan','email','no_telp','id_user','tanggal')
                       ->where(DB::raw('DATE(tanggal)'),'>=',DB::raw('curdate()'))
                       ->where(DB::raw('DATE(tanggal)'),'<=',DB::raw('curdate()'))
                       ->groupBy('id_user')
                       ->get();
           return view('unit.laporan.laporan_pengunjung')
                   ->with('_data',$datass);
   }


   public function filterLaporanPengunjung(Request $request){

           if ($request->petugas == 'all') {
                $datass = DB::table('view_pelayanan')
                       -> select('pelanggan','email','no_telp','id_user','tanggal','nama_unit')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                       ->where('nama_unit', '=', Auth()->user()->unit)
                       ->groupBy('id_user')
                       ->get();
           }else{
               $datass = DB::table('view_pelayanan')
                       -> select('pelanggan','email','no_telp','id_user','tanggal')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                       ->where('petugas',$request->petugas)
                       ->groupBy('id_user')
                       ->get();                    
           }

           return view('unit.laporan.refresh_table_lap_pengunjung')
                   ->with('_data',$datass);
   }   



   public function lihatListKunjungan(Request $request){

       if ($request->petugas == 'all') {
           
           $datass = DB::table('view_pelayanan')
                       -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan','pelanggan','nama_unit')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                       ->where('nama_unit', '=', Auth()->user()->unit)
                       ->where('id_user',$request->id_user);
                       
           }else{

           $datass = DB::table('view_pelayanan')
                       -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                       ->where('petugas',$request->petugas)
                       ->where('id_user',$request->id_user);

           }
           
           $_i=0; 
           $emosi = array("TIDAK SURVEY", "SANGAT PUAS", "PUAS", "TIDAK PUAS");

           $tables = '';
               foreach ($datass->get() as $value) {
                   if ($_i % 2===0) {
           $tables .=   '<tr>';
                   }else{
           $tables .=   '<tr style="background-color: #dddddd">';
                   }
           $tables .=   '<td>'. $value->tanggal .'</td>
                           <td>'. $value->nama_loket .'</td>
                           <td>'. $value->nama_layanan .'</td>
                           <td>'. $value->sub_layanan .'</td>
                           <td>'. $value->nama_petugas .'</td>
                           <td>'. strtoupper($emosi[$value->kepuasan]) .'</td>
                       </tr>';
                       $_i++;
                       }
           $tables .=  '';

           $response['count'] = $datass->count();
           $response['pelanggan'] = strtoupper($datass->first()->pelanggan);
           $response['tables'] = $tables;
           return $response;
       }

// function Petugas
       public function laporanPetugas(){
           $datass = DB::table('view_pelayanan')
                       -> select('nama_petugas','nama_loket','id_user','tanggal','petugas')
                       ->where(DB::raw('DATE(tanggal)'),'>=',DB::raw('curdate()'))
                       ->where(DB::raw('DATE(tanggal)'),'<=',DB::raw('curdate()'))
                       ->groupBy('petugas')
                       ->get();
       
           return view('unit.laporan.laporan_petugas')
                   ->with('_data',$datass);
       }

   public function filterLaporanPetugas(Request $request){

           if ($request->petugas == 'all') {
                $datass = DB::table('view_pelayanan')
                       -> select('nama_petugas','nama_loket','id_user','tanggal','petugas','nama_unit')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                       ->where('nama_unit', '=', Auth()->user()->unit)
                       ->groupBy('petugas')
                       ->get();
           }else{
               $datass = DB::table('view_pelayanan')
                       -> select('nama_petugas','nama_loket','id_user','tanggal','petugas')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                       ->where('petugas',$request->petugas)
                       ->groupBy('petugas')
                       ->get();                    
           }

           return view('unit.laporan.refresh_table_lap_petugas')
                   ->with('_data',$datass);
   }   


   public function lihatListPelayanan(Request $request){
           $datass = DB::table('view_pelayanan')
                       -> select('nama_petugas','tanggal','nama_layanan','sub_layanan','kepuasan','pelanggan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, mulai, selesai)) as lama'))
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                       ->where('petugas',$request->id_petugas);
           
           $_i=0; 
           $emosi = array("TIDAK SURVEY", "SANGAT PUAS", "PUAS", "TIDAK PUAS");

           $tables = '';
               foreach ($datass->get() as $value) {
                   if ($_i % 2===0) {
           $tables .=   '<tr id="table-modal">';
                   }else{
           $tables .=   '<tr id="table-modal" style="background-color: #dddddd">';
                   }
           $tables .=   '<td>'. $value->tanggal .'</td>
                           <td>'. strtoupper($value->pelanggan) .'</td>
                           <td>'. $value->nama_layanan .'</td>
                           <td>'. $value->sub_layanan .'</td>
                           <td>'. strtoupper($emosi[$value->kepuasan]) .'</td>
                           <td>'. $value->lama.'</td>
                       </tr>';
                       $_i++;
                       }
           $tables .=  '';


           $response['count'] = $datass->count();
           $response['petugas'] = $datass->first()->nama_petugas;                
           $response['tables'] = $tables;
           return $response;
       }

   public function laporanDataPengunjung(Request $request){

               $datas = DB::table('pelayanans as pel')
                   -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as nama_pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub', DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
                   ->leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                   ->leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                   ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                   ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                   ->where(DB::raw('DATE(ans.tgl_antrian)'),'>=',$request->ed_mulai)
                   ->where(DB::raw('DATE(ans.tgl_antrian)'),'<=',$request->ed_sampai)
                   ->where('pel.id_petugas', '=', Auth()->user()->unit)
                   ->get();

           $_i=0; 
           $tables = '';
               foreach ($datas as $data) {
                   if ($_i % 2===0) {
           $tables .=   '<tr>';
                   }else{
           $tables .=   '<tr style="background-color: #dddddd">';
                   }
           $tables .=   '<td align="center">'. substr($data->tanggal,0,10).'</td>
                           <td>'. $data->email.'</td>
                           <td>'. strtoupper($data->nama_pelanggan).'</td>
                           <td>'. strtoupper($data->no_telp).'</td>
                           <td>'. strtoupper($data->nama_layanan).'</td>
                           <td>'. strtoupper($data->nama_loket).'</td>
                           <td>'. strtoupper($data->sub_layanan).'</td>
                           <td>'. strtoupper($data->nama_loket_sub).'</td>
                           <td align="center">'. $data->lama.'</td>
                       </tr>';
                   $_i++;
                       }
           $tables .=  '';
           return $tables;
   }

   public function laporanSurveyPengunjung(Request $request){

               $datas = DB::table('pelayanans as pel')
                   -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as nama_pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan')
                   ->leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                   ->leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                   ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                   ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                   ->where(DB::raw('DATE(ans.tgl_antrian)'),'>=',$request->ed_mulai)
                   ->where(DB::raw('DATE(ans.tgl_antrian)'),'<=',$request->ed_sampai)
                   ->where('pel.id_petugas', '=', Auth()->user()->unit)
                   ->get();

           $_i=0; 
           $emosi = array("TIDAK SURVEY", "SANGAT PUAS", "PUAS", "TIDAK PUAS");
           $tables = '';
               foreach ($datas as $data) {
                   if ($_i % 2===0) {
           $tables .=   '<tr>';
                   }else{
           $tables .=   '<tr style="background-color: #dddddd">';
                   }
           $tables .=   '<td align="center">'. substr($data->tanggal,0,10).'</td>
                           <td>'. $data->email.'</td>
                           <td>'. strtoupper($data->nama_pelanggan).'</td>
                           <td>'. strtoupper($data->no_telp).'</td>
                           <td>'. strtoupper($data->nama_layanan).'</td>
                           <td>'. strtoupper($data->nama_loket).'</td>
                           <td>'. strtoupper($data->sub_layanan).'</td>
                           <td>'. strtoupper($data->nama_loket_sub).'</td>
                           <td align="center">'. strtoupper($emosi[$data->kepuasan]) .'</td>
                       </tr>';
                   $_i++;
                       }
           $tables .=  '';
           return $tables;
   }


           public function laporanPresensiPetugas(Request $request){

               $datas = DB::table('pelayanans as pel')
                   ->select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
                   ->leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
                   ->leftJoin('users as us', 'us.id', '=', 'ans.id_user')
                   ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
                   ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
                   ->where(DB::raw('DATE(ans.tgl_antrian)'),'>=',$request->ed_mulai)
                   ->where(DB::raw('DATE(ans.tgl_antrian)'),'<=',$request->ed_sampai)
                   ->where('pel.id_petugas', '=', Auth()->user()->unit)
                   ;

           $_i=0; 
           $emosi = array("TIDAK SURVEY", "SANGAT PUAS", "PUAS", "TIDAK PUAS");
           $tables = '';
               if($datas->count() > 0){
               foreach ($datas->get() as $data) {
                   if ($_i % 2===0) {
           $tables .=   '<tr>';
                   }else{
           $tables .=   '<tr style="background-color: #dddddd">';
                   }
           $tables .=   '<td align="center">'. substr($data->tanggal,0,10).'</td>
                           <td>'. strtoupper($data->pelanggan).'</td>
                           <td>'. strtoupper($data->nama_layanan).'</td>
                           <td>'. strtoupper($data->nama_loket).'</td>
                           <td>'. strtoupper($data->sub_layanan).'</td>
                           <td>'. strtoupper($data->nama_loket_sub).'</td>
                           <td align="center">'. $data->lama.'</td>
                           <td align="center">'. strtoupper($emosi[$data->kepuasan]) .'</td>
                       </tr>';
                   $_i++;
                       }
               }else{
                  $tables .= '<tr>
                       <td colspan="8"><center>Tidak Ada Data</center></td>
                  </tr>'; 
               }
           $tables .=  '';
           return $tables;
   }

   // Survey Pengunjung
   public function survey_pengunjung(Request $request){
    if(Auth::check()){
        if(Auth()->user()->jabatan==='admin_unit'){
            $data = DB::table('view_pelayanan')
                -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan','nama_unit')
                 ->where(DB::raw('DATE(tanggal)'),'>=',DB::raw('curdate()'))
                 ->where(DB::raw('DATE(tanggal)'),'<=',DB::raw('curdate()'))
                 ->where('nama_unit', '=', Auth()->user()->unit)
                -> get();
            return view('unit.laporan.laporan survey pelanggan')
                -> with('_data', $data);
        }
    }
}

public function filterDataSurvey(Request $request){

    if ($request->petugas == 'all' and $request->pelayanan == 'all') {
        $data = DB::table('view_pelayanan')
                -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan','nama_unit')
                ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                ->where('nama_unit', '=', Auth()->user()->unit)
                -> get();
    }elseif($request->petugas == 'all' and $request->pelayanan != 'all'){
        $data = DB::table('view_pelayanan')
                -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan','nama_unit')
                ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                ->where('kepuasan',$request->pelayanan)
                ->where('nama_unit', '=', Auth()->user()->unit)
                -> get();                    
    }elseif($request->petugas != 'all' and $request->pelayanan == 'all'){
        $data = DB::table('view_pelayanan')
                -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                ->where('petugas',$request->petugas)
                ->where('nama_unit', '=', Auth()->user()->unit)
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

  return view('unit.laporan.refresh_table_survey')
        ->with('_data', $data);

}

    public function generatePDFPengunjung(Request $request){
                     
                     if ($request->petugas == 'all') {
           
                       $datass = DB::table('view_pelayanan')
                                   -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan')
                                   ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                                   ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                                   ->where('id_user',$request->id_user);
                                   
                       }else{

                       $datass = DB::table('view_pelayanan')
                                   -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan')
                                   ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                                   ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                                   ->where('petugas',$request->petugas)
                                   ->where('id_user',$request->id_user);

                       }

             $pdf = PDF::loadView('pdf_laporan_unit.layout_laporan_pengunjung',['_data' => $datass->get(),'ed_mulai'=>$request->tglmulai,'ed_sampai'=>$request->tglsampai,'petugas'=> $request->petugas,'unit'=>Auth()->user()->unit,'nama_petugas'=>$datass->first()->nama_petugas]);
      
            return $pdf->download('layout_laporan_pengunjung_unit.pdf');
    }

        public function generatePDFSurvey(Request $request){

              if ($request->petugas == 'all' and $request->pelayanan == 'all') {
                  $data = DB::table('view_pelayanan')
                          -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan','nama_unit')
                          ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                          ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                          ->where('nama_unit', '=', Auth()->user()->unit)
                          -> get();
              }elseif($request->petugas == 'all' and $request->pelayanan != 'all'){
                  $data = DB::table('view_pelayanan')
                          -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan','nama_unit')
                          ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                          ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                          ->where('kepuasan',$request->pelayanan)
                          ->where('nama_unit', '=', Auth()->user()->unit)
                          -> get();                    
              }elseif($request->petugas != 'all' and $request->pelayanan == 'all'){
                  $data = DB::table('view_pelayanan')
                          -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                          ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                          ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                          ->where('petugas',$request->petugas)
                          ->where('nama_unit', '=', Auth()->user()->unit)
                          -> get();
               }else{
                 $data = DB::table('view_pelayanan')
                          -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                          ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                          ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                          ->where('petugas',$request->petugas)
                          ->where('kepuasan',$request->pelayanan)
                          -> get();  
              }

             $pdf = PDF::loadView('pdf_laporan_unit.layout_laporan_survey',['_data' => $data,'ed_mulai'=>$request->tglmulai,'ed_sampai'=>$request->tglsampai,'petugas'=> $request->petugas,'unit'=>Auth()->user()->unit,'nama_petugas'=>$data->first()->nama_petugas]);
      
            return $pdf->download('layout_laporan_survey_unit.pdf');
      }


      public function generatePDFPresensi(Request $request){
                     $datass = DB::table('view_pelayanan')
                       -> select('nama_petugas','tanggal','nama_layanan','sub_layanan','kepuasan','pelanggan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, mulai, selesai)) as lama'))
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                       ->where('petugas',$request->id_petugas)
                       ->get();


             $pdf = PDF::loadView('pdf_laporan_unit.layout_laporan_presensi',['_data' => $datass,'ed_mulai'=>$request->tglmulai,'ed_sampai'=>$request->tglsampai,'petugas'=> $request->id_petugas,'unit'=>Auth()->user()->unit,'nama_petugas'=>$datass->first()->nama_petugas]);
      
            return $pdf->download('layout_laporan_pengunjung_unit.pdf');
    }


      public function generatePDFBooking(Request $request){
            
            if ($request->petugas == 'all') {
                     $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('DATE(va.tgl_antrian) > curdate() and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();
           }else{
                     $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('DATE(va.tgl_antrian) > curdate() and (va.petugas_layanan = "'.$request->petugas.'" or va.petugas_sub_layanan = "'.$request->petugas.'") and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();                   
           }

            $nama_petugas = User::select('name')->where('id',$request->petugas)->first();

            $pdf = PDF::loadView('pdf_laporan_unit.layout_laporan_booking',['_data' => $datas,'petugas'=> $request->petugas,'unit'=>Auth()->user()->unit,'nama_petugas'=>$nama_petugas ]);
      
            return $pdf->download('layout_laporan_booking_unit.pdf');
    }

         public function generatePDFPembatalan(Request $request){
            
           if ($request->petugas == 'all') {

                            $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian','va.keterangan_batal as keterangan_batal')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('va.status = "batal" and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();

                            
                    }else{
                          
                           $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian','va.keterangan_batal as keterangan_batal')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('va.status = "batal" and (va.petugas_layanan = "'.$request->petugas.'" or va.petugas_sub_layanan = "'.$request->petugas.'") and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();

                    }

           $nama_petugas = User::select('name')->where('id',$request->petugas)->first();

             $pdf = PDF::loadView('pdf_laporan_unit.layout_laporan_pembatalan',['_data' => $datas,'petugas'=> $request->petugas,'unit'=>Auth()->user()->unit,'nama_petugas'=>$nama_petugas ]);
      
            return $pdf->download('layout_laporan_pembatalan_unit.pdf');
    }

    public function daftarBooking(Request $request){
            if(Auth::check()){
                if(Auth()->user()->jabatan==='admin_unit'){
                        
                    $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> where(DB::raw('DATE(va.tgl_antrian)'),'>',DB::raw('curdate()'))
                            ->where('upl.unit', '=', Auth()->user()->unit)
                            ->orWhere('ups.unit', '=', Auth()->user()->unit);

                        return view('unit.laporan.daftar_booking')
                            -> with('_data', $datas->get());
                }else{
                    Auth::logout();
                }
            }else{
                Auth::logout();
            }
    }

    public function daftarPembatalan(Request $request){
        if(Auth::check()){
                    if(Auth()->user()->jabatan==='admin_unit'){
                            
                        $datas = DB::table('view_antrian as va')
                                -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian','va.keterangan_batal as keterangan_batal')
                                ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                                ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')            
                                ->where('va.status','batal')
                                ->where('upl.unit', '=', Auth()->user()->unit)
                                ->orWhere('ups.unit', '=', Auth()->user()->unit);

                            return view('unit.laporan.daftar_pembatalan')
                                -> with('_data', $datas->get());
                    }else{
                        Auth::logout();
                    }
                }else{
                    Auth::logout();
                }
    }
       public function filterDaftarBooking(Request $request){

           if ($request->petugas == 'all') {
                    $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('DATE(va.tgl_antrian) > curdate() and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();

           }else{

                    $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('DATE(va.tgl_antrian) > curdate() and (va.petugas_layanan = "'.$request->petugas.'" or va.petugas_sub_layanan = "'.$request->petugas.'") and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();
                 
                      }

                     $_i=0; 
                     $return = "";
                    foreach($datas as $data){
                      if($_i % 2===0){
                        $return .= "<tr>";
                      }
                      else{
                        $return .= "<tr style='background-color: #dddddd'>";
                      }
                      $return .= "<td align='center'>".substr($data->tanggal,0,10)."</td>
                        <td>".strtoupper($data->nama_pelanggan)."</td>
                        <td>".strtoupper($data->no_telp)."</td>
                        <td>".$data->no_antrian."</td>
                        <td>".strtoupper($data->nama_layanan)."</td>
                        <td>".strtoupper($data->nama_loket)."</td>
                        <td>".strtoupper($data->sub_layanan)."</td>
                        <td>".strtoupper($data->nama_loket_sub)."</td>
                      </tr>";
                       $_i++;
                  }
                  $return .=  "";

           return $return;
   } 

          public function filterDaftarPembatalan(Request $request){

                    if ($request->petugas == 'all') {

                            $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian','va.keterangan_batal as keterangan_batal')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('va.status = "batal" and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();

                            
                    }else{
                          
                           $datas = DB::table('view_antrian as va')
                            -> select('va.tgl_antrian as tanggal', 'va.email as email', 'va.name as nama_pelanggan', 'va.no_telp as no_telp', 'va.nama_layanan as nama_layanan', 'va.nama_sub_layanan as sub_layanan', 'va.nama_loket as nama_loket','va.nama_loket_sub_layanan as nama_loket_sub','va.no_antrian as no_antrian','va.keterangan_batal as keterangan_batal')
                            ->leftJoin('users as upl', 'upl.id', '=', 'va.petugas_layanan')
                            ->leftJoin('users as ups', 'ups.id', '=', 'va.petugas_sub_layanan')
                            -> whereRaw('va.status = "batal" and (va.petugas_layanan = "'.$request->petugas.'" or va.petugas_sub_layanan = "'.$request->petugas.'") and (upl.unit = "'.Auth()->user()->unit.'" or ups.unit = "'.Auth()->user()->unit.'")')->get();

                    }

                      $_i=0; 
                     $return = "";
                    foreach($datas as $data){
                      if($_i % 2===0){
                        $return .= "<tr>";
                      }
                      else{
                        $return .= "<tr style='background-color: #dddddd'>";
                      }
                      $return .= "<td align='center'>".substr($data->tanggal,0,10)."</td>
                        <td>".$data->nama_pelanggan."</td>
                        <td>".$data->no_antrian."</td>
                        <td>".$data->nama_layanan."</td>
                        <td>".$data->nama_loket."</td>
                        <td>".$data->sub_layanan."</td>
                        <td>".$data->nama_loket_sub."</td>
                        <td>".$data->keterangan_batal."</td>";
                       $_i++;
                  }
                  $return .=  "";

           return $return;
   }  

}
