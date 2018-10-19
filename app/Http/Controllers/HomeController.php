<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Loket;
use App\Antrian;
use App\SettingHari;
use App\File;
use App\Footer;
use App\Sidebar;
use App\Tulisan;
use Storage;
use Redirect;
use DB;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function home(){
        if(Auth::check()){
            if(Auth()->user()->jabatan==='admin'){
                return Redirect::to('/home');
            }else if(Auth()->user()->jabatan==='petugas_loket'){
                return Redirect::to('/home');
            }else if(Auth()->user()->jabatan==='pelanggan'){
                return Redirect::to('/home');
            }else{
                Auth::logout();
            }
        }
    }

    public function index()
    {
        if (Auth::user()->jabatan == "admin"){
            $data = DB::table('summary_pelanggan')
                -> select('tanggal', DB::raw('count(jumlah) AS jml'))
                -> groupBy('tanggal')
                -> get();

            $tanggal = '';
            $batas =  date("t");
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
            return view('home')
                -> with('_tanggal', substr($tanggal, 0,-1))
                -> with('_hasil', substr($hasil, 0, -1))
                -> with('_nilai', substr($nilai, 0, -1));
                
        }elseif(Auth::user()->jabatan == "petugas_loket"){
            $layanan = Loket::select()
                -> where('petugas', '=', Auth::user()->id)->first();
            return view('petugas_loket')
                -> with('_layanan', $layanan);
        }elseif (Auth::user()->jabatan == "pelanggan"){
            $agent = new Agent();
            $layanan_loket   = Loket::select()->where('lantai',1);
            $layanan_loket_2 = Loket::select()->where('lantai',2);
            $layanan_loket_3 = Loket::select()->where('lantai',3);
            $layanan_loket_4 = Loket::select()->where('lantai',4);
            $layanan_loket_5 = Loket::select()->where('lantai',5);
            $layanan_loket_6 = Loket::select()->where('lantai',6);
            return view('home_pelanggan', ['layanan_loket' => $layanan_loket,'layanan_loket_2'=>$layanan_loket_2,'layanan_loket_3'=>$layanan_loket_3,'layanan_loket_4'=>$layanan_loket_4,'layanan_loket_5'=>$layanan_loket_5,'layanan_loket_6'=>$layanan_loket_6,'agent'=>$agent]);

        }elseif (Auth::user()->jabatan ==="petugas_loket"){
            return view('petugas_loket.home');
        }


        /*}elseif (Auth::user()->jabatan == "petugas_loket" AND Auth::user()->lantai == 1 ){
            return view('lantai.lantai1'); 
        }elseif (Auth::user()->jabatan == "petugas_loket" AND Auth::user()->lantai == 2 ){
            return view('lantai.lantai2'); 
        }elseif (Auth::user()->jabatan == "petugas_loket" AND Auth::user()->lantai == 3 ){
            return view('lantai.lantai3'); 
        }elseif (Auth::user()->jabatan == "petugas_loket" AND Auth::user()->lantai == 4 ){
            return view('lantai.lantai4'); 
        }elseif (Auth::user()->jabatan == "petugas_loket" AND Auth::user()->lantai == 5 ){
            return view('lantai.lantai5'); 
        }elseif (Auth::user()->jabatan == "petugas_loket" AND Auth::user()->lantai == 6 ){
            return view('lantai.lantai6'); 
        }*/
        
    }

    public function survey_pengunjung(Request $request){
        if(Auth::check()){
            if(Auth()->user()->jabatan==='admin'){
                $data = DB::table('view_pelayanan')
                    -> select('tanggal', 'nama_petugas', 'email', 'pelanggan', 'no_telp', 'nama_layanan', 'kepuasan')
                     ->where(DB::raw('DATE(tanggal)'),'>=',DB::raw('curdate()'))
                     ->where(DB::raw('DATE(tanggal)'),'<=',DB::raw('curdate()'))
                    -> get();
                return view('laporan.laporan survey pelanggan')
                    -> with('_data', $data);
            }
        }
    }
// Controller Lantai
    public function lantai()
    {
        $lantai1 = Loket::where('lantai','1')->get();
        $bgLantai1 = File::where('lantai','1')->where('status','Aktif')->whereNotIn('type',['background'])->orderby('id','desc');
        $imgFotL1    = Footer::where('lantai','1')->where('float','footer_L')->orderby('id','desc');
        $imgFotR1    = Footer::where('lantai','1')->where('float','footer_R')->orderby('id','desc');
        $Text        = Tulisan::where('lantai','1')->where('float','footer')->orderby('id','desc');
        $TextUtama   = Tulisan::where('lantai','1')->where('float','utama')->orderby('id','desc');
        $Background   = File::where('lantai','1')->where('type','background')->orderby('id','desc');
        return view('lantai.lantai1', compact('lantai1','bgLantai1','imgFooter','imgFotL1','imgFotR1','Text','TextUtama','Background'));
    }

    public function lantai2()
    {
        $lantai2 = Loket::where('lantai','2')->get();
        $bgLantai2 = File::where('lantai','2')->where('status','Aktif')->whereNotIn('type',['background'])->orderby('id','desc');
        $Text        = Tulisan::where('lantai','2')->where('float','footer')->orderby('id','desc');
        $TextUtama   = Tulisan::where('lantai','2')->where('float','utama')->orderby('id','desc');
        $Background   = File::where('lantai','1')->where('type','background')->orderby('id','desc');
        return view('lantai.lantai2', compact('lantai2','bgLantai2','Text','TextUtama','Background'));
    }

    public function lantai3()
    {
        $lantai3 = Loket::where('lantai','3')->get();
        $bgLantai3 = File::where('lantai','3')->where('status','Aktif')->whereNotIn('type',['background'])->orderby('id','desc');
        $Text        = Tulisan::where('lantai','3')->where('float','footer')->orderby('id','desc');
        $Background   = File::where('lantai','1')->where('type','background')->orderby('id','desc');
        return view('lantai.lantai3', compact('lantai3','bgLantai3','Text','Background'));
    }

    public function lantai4()
    {
        $lantai4 = Loket::where('lantai','4')->get();
        $bgLantai4 = File::where('lantai','4')->where('status','Aktif')->whereNotIn('type',['background'])->orderby('id','desc');
        $imgSid4 = Sidebar::where('lantai','4')->orderby('id','desc');
        $Text        = Tulisan::where('lantai','4')->where('float','footer')->orderby('id','desc');
        $Background   = File::where('lantai','1')->where('type','background')->orderby('id','desc');
        return view('lantai.lantai4', compact('lantai4','bgLantai4','imgSid4','Text','Background'));
    }

    public function lantai5()
    {
        $lantai5 = Loket::where('lantai','5')->get();
        $bgLantai5 = File::where('lantai','5')->where('status','Aktif')->whereNotIn('type',['background'])->orderby('id','desc');
        $imgSid5 = Sidebar::where('lantai','5')->orderby('id','desc');
        $imgFotL5    = Footer::where('lantai','5')->where('float','footer_L')->orderby('id','desc');
        $imgFotR5    = Footer::where('lantai','5')->where('float','footer_R')->orderby('id','desc');
        $Text        = Tulisan::where('lantai','5')->where('float','footer')->orderby('id','desc');
        $Background   = File::where('lantai','1')->where('type','background')->orderby('id','desc');
        return view('lantai.lantai5', compact('lantai5','bgLantai5','imgSid5','imgFotL5','imgFotR5','Text','Background'));
    }

    public function lantai6()
    {
        $lantai6 = Loket::where('lantai','6')->get();
        $bgLantai6 = File::where('lantai','6')->where('status','Aktif')->whereNotIn('type',['background'])->orderby('id','desc');
        $imgFotL6    = Footer::where('lantai','6')->where('float','footer_L')->orderby('id','desc');
        $imgFotR6    = Footer::where('lantai','6')->where('float','footer_R')->orderby('id','desc');
        $Text        = Tulisan::where('lantai','6')->where('float','footer')->orderby('id','desc');
        $Background   = File::where('lantai','1')->where('type','background')->orderby('id','desc');
        return view('lantai.lantai6', compact('lantai6','bgLantai6','imgFotL6','imgFotR6','Text','Background'));
    }

    public function display()
    {
        $layanan_loket   = Loket::select()->where('lantai',1);
        $layanan_loket_2 = Loket::select()->where('lantai',2);
        $layanan_loket_3 = Loket::select()->where('lantai',3);
        $layanan_loket_4 = Loket::select()->where('lantai',4);
        $layanan_loket_5 = Loket::select()->where('lantai',5);
        $layanan_loket_6 = Loket::select()->where('lantai',6);
        return view('home_pelanggan', ['layanan_loket' => $layanan_loket,'layanan_loket_2'=>$layanan_loket_2,'layanan_loket_3'=>$layanan_loket_3,'layanan_loket_4'=>$layanan_loket_4,'layanan_loket_5'=>$layanan_loket_5,'layanan_loket_6'=>$layanan_loket_6]);
    }
    

    public function monitor()
    {
        return view('monitor');
    }

    public function layanan($lantai)
    {   
        $layanan_lantai = Loket::select()->where('lantai',$lantai)->get();
        return view('pelanggan.layanan',['layanan_lantai' => $layanan_lantai,'lantai'=>$lantai]);
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

              return view('laporan.refresh_table_survey')
                    ->with('_data', $data);

            }

// function Pengunjung
        public function laporanPengunjung(){
             $datass = DB::table('view_pelayanan')
                            -> select('pelanggan','email','no_telp','id_user','tanggal')
                            ->where(DB::raw('DATE(tanggal)'),'>=',DB::raw('curdate()'))
                            ->where(DB::raw('DATE(tanggal)'),'<=',DB::raw('curdate()'))
                            ->groupBy('id_user')
                            ->get();
            


                return view('laporan.laporan_pengunjung')
                        ->with('_data',$datass);
        }


        public function filterLaporanPengunjung(Request $request){

                if ($request->petugas == 'all') {
                     $datass = DB::table('view_pelayanan')
                            -> select('pelanggan','email','no_telp','id_user','tanggal')
                            ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                            ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
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

                return view('laporan.refresh_table_lap_pengunjung')
                        ->with('_data',$datass);
        }   



        public function lihatListKunjungan(Request $request){
                $datass = DB::table('view_pelayanan')
                            -> select('tanggal','nama_loket','nama_layanan','sub_layanan','nama_petugas','kepuasan')
                            ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                            ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                            ->where('petugas',$request->petugas)
                            ->where('id_user',$request->id_user);
                
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


                return $tables;
            }

// function Petugas
            public function laporanPetugas(){
                $datass = DB::table('view_pelayanan')
                            -> select('nama_petugas','nama_loket','id_user','tanggal','petugas')
                            ->where(DB::raw('DATE(tanggal)'),'>=',DB::raw('curdate()'))
                            ->where(DB::raw('DATE(tanggal)'),'<=',DB::raw('curdate()'))
                            ->groupBy('petugas')
                            ->get();
            
                return view('laporan.laporan_petugas')
                        ->with('_data',$datass);
            }

        public function filterLaporanPetugas(Request $request){

                if ($request->petugas == 'all') {
                     $datass = DB::table('view_pelayanan')
                            -> select('nama_petugas','nama_loket','id_user','tanggal','petugas')
                            ->where(DB::raw('DATE(tanggal)'),'>=',$request->ed_mulai)
                            ->where(DB::raw('DATE(tanggal)'),'<=',$request->ed_sampai)
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

                return view('laporan.refresh_table_lap_petugas')
                        ->with('_data',$datass);
        }   


        public function lihatListPelayanan(Request $request){
                $datass = DB::table('view_pelayanan')
                            -> select('tanggal','nama_layanan','sub_layanan','kepuasan','pelanggan',DB::raw('SEC_TO_TIME(TIMESTAMPDIFF(SECOND, mulai, selesai)) as lama'))
                            ->where(DB::raw('DATE(tanggal)'),'>=',$request->tglmulai)
                            ->where(DB::raw('DATE(tanggal)'),'<=',$request->tglsampai)
                            ->where('petugas',$request->id_petugas);
                
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
                                <td>'. strtoupper($value->pelanggan) .'</td>
                                <td>'. $value->nama_layanan .'</td>
                                <td>'. $value->sub_layanan .'</td>
                                <td>'. strtoupper($emosi[$value->kepuasan]) .'</td>
                                <td>'. $value->lama.'</td>
                            </tr>';
                            $_i++;
                            }
                $tables .=  '';


                return $tables;
            }


}
