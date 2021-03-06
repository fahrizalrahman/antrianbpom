<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingHariSub;
use App\Sublayanan;
use Auth;
use Session;


class SettingHariSubUnitController extends Controller
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
        $data_setting_hari_sub = SettingHariSub::select([
            'sublayanans.nama_sublayanan as nama_sublayanan',
            'setting_hari_subs.hari as hari',
            'setting_hari_subs.id as id',
            'lokets.nama_layanan as nama_layanan',
            'lokets.lantai as lantai',
        ])->leftjoin('sublayanans','sublayanans.id', '=', 'setting_hari_subs.id_sublayanan')
        ->leftjoin('lokets','lokets.id', '=', 'sublayanans.id_loket')
        ->leftjoin('users','users.id','=','sublayanans.petugas')
        ->where('users.unit',Auth::user()->unit)
        ->orderBy('sublayanans.nama_sublayanan', 'DESC')
        ->orderBy('setting_hari_subs.hari', 'DESC')
        ->orderBy('lokets.lantai','DESC')->get();

        return view('unit.settingharisub.index')->with(compact('data_setting_hari_sub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
             return  view('unit.settingharisub.create');
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
                'hari'  => 'required|string',
                'id_sublayanan' => 'required',
                ]);

                $settingharisub = SettingHariSub::create([
                    'hari'      => $request->hari,
                    'id_sublayanan'  => $request->id_sublayanan,
                ]);

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menambah Setting Hari Sublayanan"
            ]);

         return redirect()->route('unit-settingharisub.index');
    }

    public function prosesSettingHariSubUnit(Request $request){
            $cek_hari = SettingHariSub::where('id_sublayanan',$request->id_sublayanan)->where('hari',$request->hari)->count();
            if($cek_hari > 0){
                $return = 0;
            }else{
                $settingharisub = SettingHariSub::create([
                    'hari'      => $request->hari,
                    'id_sublayanan'  => $request->id_sublayanan,
                ]);
                $return = 1;
            }
            return $return;
    }

    public function editSettingHariSubUnit(Request $request){
            $cek_hari = SettingHariSub::where('id_sublayanan',$request->id_sublayanan)->where('hari',$request->hari)->where('id','!=',$request->id)->count();
            if($cek_hari > 0){
                $return = 0;
            }else{
                 $settingharisub = SettingHariSub::find($request->id);
                 $settingharisub->update([
                    'hari'          => $request->hari,
                    'id_sublayanan'      => $request->id_sublayanan,
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
        if (Auth::check()) {
            $settingharisub = SettingHariSub::select([
                'sublayanans.nama_sublayanan as nama_sublayanan',
                'setting_hari_subs.hari as hari',
                'setting_hari_subs.id_sublayanan as id_sublayanan',
                'setting_hari_subs.id as id'
            ])->leftjoin('sublayanans','sublayanans.id', '=', 'setting_hari_subs.id_sublayanan')
            ->where('setting_hari_subs.id',$id)
            ->first();

            return view('unit.settingharisub.edit')->with(compact('settingharisub'));
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
                'hari'  => 'required|string',
                'id_sublayanan' => 'required',
                ]);


        $settingharisub = SettingHariSub::find($id);
        $settingharisub->update([
                    'hari'          => $request->hari,
                    'id_sublayanan'      => $request->id_sublayanan,
                ]);

          Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengubah Setting Hari Sublayanan"
            ]);

         return redirect()->route('unit-settingharisub.index');
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
        SettingHariSub::where('id', $id)->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Mengapus Setting Hari Sublayanan"
            ]);
            return redirect()->route('unit-settingharisub.index');
    }

}
