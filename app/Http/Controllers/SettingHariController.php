<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SettingHari;
use App\Loket;
use Auth;
use Session;


class SettingHariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data_setting_hari = SettingHari::select([
            'lokets.nama_layanan as nama_layanan',
            'setting_haris.hari as hari',
            'setting_haris.id as id',
            'lokets.lantai as lantai'
        ])->leftjoin('lokets','lokets.id', '=', 'setting_haris.id_loket')
        ->orderBy('lokets.nama_layanan', 'DESC')
        ->orderBy('setting_haris.hari', 'DESC')
        ->orderBy('lokets.lantai','DESC')
        ->get();

        return view('settinghari.index')->with(compact('data_setting_hari'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       if (Auth::check()) {
             return  view('settinghari.create');
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

         return redirect()->route('settinghari.index');
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
            $settinghari = SettingHari::select([
                'lokets.nama_layanan as nama_layanan',
                'setting_haris.hari as hari',
                'setting_haris.id as id',
                'lokets.lantai as lantai'
            ])->leftjoin('lokets','lokets.id', '=', 'setting_haris.id_loket')
            ->where('setting_haris.id',$id)
            ->first();
            return view('settinghari.edit')->with(compact('settinghari'));
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

         return redirect()->route('settinghari.index');
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
        SettingHari::where('id', $id)->delete();

        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Berhasil Mengapus Setting Hari"
            ]);
            return redirect()->route('settinghari.index');
    }

    public function cekPilihLantai(Request $request){

            $data_loket = Loket::select('nama_layanan','id')->where('lantai',$request->lantai)->get();

             $select = '';
             $select .= '<div class="form-group">
                         <label for="id_loket" class="col-md-2 control-label">Nama Layanan</label>
                         <select id="id_loket" class="form-control" name="id_loket">
                         ';
                        foreach ($data_loket as $data_lokets) {

            $select .= '<option value="'.$data_lokets->id.'">'.$data_lokets->nama_layanan.'         </option>';
                            }'
                            </select> 
                        </div>';

            return $select;
    }
}
