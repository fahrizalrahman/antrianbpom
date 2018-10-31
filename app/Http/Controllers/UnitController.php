<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use Session;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth()->user()->jabatan==='admin_unit') {
                return view('unit.home');
            }
        } else {
            return "Anda Tidak Memiliki Akses";
        }
        
        // return view('unit.home');
    }

    public function petugas()
    {
        $petugas = User::where('jabatan','petugas_loket')->where('unit', Auth::user()->unit)->get();
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
            "level"=>"success",
            "message"=>"Berhasil Menghapus Petugas"
            ]);

        return redirect()->route('unit.petugas');
        
    }
    

    // public function laporan_pengunjung(Request $request){
    //     if(Auth::check()){
    //         if(Auth()->user()->jabatan==='admin_unit'){

    //                 $datas = DB::table('pelayanans as pel')
    //                     -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as nama_pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub', DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
    //                     -> leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
    //                     -> leftJoin('users as us', 'us.id', '=', 'ans.id_user')
    //                     ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
    //                     ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
    //                     -> where(DB::raw('DATE(ans.tgl_antrian)'),'>=',DB::raw('curdate()'))
    //                     -> where(DB::raw('DATE(ans.tgl_antrian)'),'<=',DB::raw('curdate()'))
    //                     -> where('pel.id_petugas', '=', Auth()->user()->unit)
    //                     -> get();

    //             return view('unit.petugas.daftar pengunjung')
    //                 -> with('_data', $datas);
    //         }else{
    //             return "Anda tidak memiliki hak akses";
    //         }
    //     }else{
    //         return "Anda tidak memiliki hak akses";
    //     }
    // }

    // public function presensi(Request $request){
    //     if(Auth::check()){
    //         if(Auth()->user()->jabatan==='admin_unit'){
                   
    //             $datas = DB::table('pelayanans as pel')
    //                     -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, pel.mulai, pel.selesai)) as lama'))
    //                     -> leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
    //                     -> leftJoin('users as us', 'us.id', '=', 'ans.id_user')
    //                     ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
    //                     ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
    //                     -> where(DB::raw('DATE(ans.tgl_antrian)'),'>=',DB::raw('curdate()'))
    //                     -> where(DB::raw('DATE(ans.tgl_antrian)'),'<=',DB::raw('curdate()'))
    //                     -> where('pel.id_petugas', '=', Auth()->user()->unit);

    //              return view('unit.petugas.presensi')
    //                     -> with('_data', $datas);
    //         }else{
    //             return "Anda tidak memiliki hak akses";
    //         }
    //     }else{
    //         return "Anda tidak memiliki hak akses";
    //     }
    // }

    // public function survey_pengunjung(Request $request){
    //     if(Auth::check()){
    //         if(Auth()->user()->jabatan==='admin_unit'){
    //             $datas = DB::table('pelayanans as pel')
    //                     -> select('ans.tgl_antrian as tanggal', 'us.email as email', 'us.name as pelanggan', 'us.no_telp as no_telp', 'lok.nama_layanan as nama_layanan', 'sub.nama_sublayanan as sub_layanan', 'lok.kode as nama_loket','sub.kode_loket as nama_loket_sub','pel.kepuasan')
    //                     -> leftJoin('antrians as ans', 'ans.id', '=', 'pel.id_antrian')
    //                     -> leftJoin('users as us', 'us.id', '=', 'ans.id_user')
    //                     ->leftJoin('lokets as lok', 'lok.id', '=', 'ans.id_loket')
    //                     ->leftJoin('sublayanans as sub', 'sub.id', '=', 'ans.id_sublayanan')
    //                     -> where(DB::raw('DATE(ans.tgl_antrian)'),'>=',DB::raw('curdate()'))
    //                     -> where(DB::raw('DATE(ans.tgl_antrian)'),'<=',DB::raw('curdate()'))
    //                     -> where('pel.id_petugas', '=', Auth()->user()->unit)
    //                     -> get();

    //             return view('unit.petugas.survey pengunjung')
    //                 -> with('_data', $datas);
    //         }else{
    //             return "Anda tidak memiliki hak akses";
    //         }
    //     }else{
    //         return "Anda tidak memiliki hak akses";
    //     }
    // }

    // //

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
                       -> select('pelanggan','email','no_telp','id_user','tanggal')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                       ->where('petugas',$request->petugas)
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
                       -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan','pelanggan')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                       ->where('petugas',$request->petugas)
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
                       -> select('nama_petugas','nama_loket','id_user','tanggal','petugas')
                       ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                       ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
                       ->where('petugas',$request->petugas)
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
                -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                 ->where(DB::raw('DATE(tanggal)'),'>=',DB::raw('curdate()'))
                 ->where(DB::raw('DATE(tanggal)'),'<=',DB::raw('curdate()'))
                -> get();
            return view('unit.laporan.laporan survey pelanggan')
                -> with('_data', $data);
        }
    }
}

public function filterDataSurvey(Request $request){

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

  return view('unit.laporan.refresh_table_survey')
        ->with('_data', $data);

}

}
