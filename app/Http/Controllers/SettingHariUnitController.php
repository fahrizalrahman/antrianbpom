<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingHari;
use App\Loket;
use Auth;
use Session;


class SettingHariUnitController extends Controller
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
        $data_setting_hari = SettingHari::select([
            'lokets.nama_layanan as nama_layanan',
            'setting_haris.hari as hari',
            'setting_haris.id as id',
            'lokets.lantai as lantai',
        ])->leftjoin('lokets','lokets.id', '=', 'setting_haris.id_loket')
        ->leftjoin('users','users.id', '=', 'lokets.petugas')
        ->where('users.unit',Auth::user()->unit)
        ->orderBy('lokets.nama_layanan', 'DESC')
        ->orderBy('setting_haris.hari', 'DESC')
        ->orderBy('lokets.lantai','DESC')
        ->get();

        return view('unit.settinghari.index')->with(compact('data_setting_hari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
             return  view('unit.settinghari.create');
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
                'hari'  => 'required|string',
                'id_loket' => 'required',
                ]);

                $settinghari = SettingHari::create([
                    'hari'      => $request->hari,
                    'id_loket'  => $request->id_loket,
                ]);

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Setting Hari"
            ]);

         return redirect()->route('unit-settinghari.index');
    }

    public function prosesSettingHariUnit(Request $request){
            $cek_hari = SettingHari::where('id_loket',$request->id_loket)->where('hari',$request->hari)->count();
            if($cek_hari > 0){
                $return = 0;
            }else{
                 $settinghari = SettingHari::create([
                    'hari'      => $request->hari,
                    'id_loket'  => $request->id_loket,
                ]);
                 $return = 1;
            }

            return $return;

    }

    public function editSettingHariUnit(Request $request){
        $cek_hari = SettingHari::where('id_loket',$request->id_loket)->where('id','!=',$request->id)->where('hari',$request->hari)->count();
            if($cek_hari > 0){
                $return = 0;
            }else{
                $settinghari = SettingHari::find($request->id);
                $settinghari->update([
                    'hari'  => $request->hari,
                    'id_loket'  => $request->id_loket,
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
            $settinghari = SettingHari::select([
                'lokets.nama_layanan as nama_layanan',
                'setting_haris.id_loket as id_loket',
                'setting_haris.hari as hari',
                'setting_haris.id as id',
                'lokets.lantai as lantai'
            ])->leftjoin('lokets','lokets.id', '=', 'setting_haris.id_loket')
            ->where('setting_haris.id',$id)
            ->first();
            return view('unit.settinghari.edit')->with(compact('settinghari'));
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
                'hari'  => 'required|string',
                'id_loket' => 'required',
                ]);


        $settinghari = SettingHari::find($id);
        $settinghari->update([
                    'hari'  => $request->hari,
                    'id_loket'          => $request->id_loket,
                ]);

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Setting Hari"
            ]);

         return redirect()->route('unit-settinghari.index');
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
        SettingHari::where('id',$id)->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Mengapus Setting Hari"
            ]);
            return redirect()->route('unit-settinghari.index');
    }

        public function delete($id)
    {
        //
        SettingHari::where('id',$id)->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Mengapus Setting Hari"
            ]);
            return redirect()->route('unit-settinghari.index');
    }
}
