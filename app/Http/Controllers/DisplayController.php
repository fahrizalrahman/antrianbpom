<?php

namespace App\Http\Controllers;
use App\Loket;
use App\Tulisan;
use App\File;
use App\judulLayanan;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function display()
    {
        $MonitorLt1 = Loket::where('lantai','1')->get();
        $MonitorLt2 = Loket::where('lantai','2')->get();
        $MonitorLt3 = Loket::where('lantai','3')->get();
        $MonitorLt4 = Loket::where('lantai','4')->get();
        $MonitorLt5 = Loket::where('lantai','5')->get();
        $MonitorLt6 = Loket::where('lantai','6')->get();
        $textmonitor = Tulisan::where('lantai','monitor');
       
        $judul_layanan1 = judulLayanan::where('id',1)->first();
        $judul_layanan2 = judulLayanan::where('id',2)->first();
        $judul_layanan3 = judulLayanan::where('id',3)->first();
        $judul_layanan4 = judulLayanan::where('id',4)->first();
        $judul_layanan5 = judulLayanan::where('id',5)->first();
        $judul_layanan6 = judulLayanan::where('id',6)->first();

        $bgMonitor  =   File::where('lantai','monitor')->where('type','background');
        return view('monitor', compact('MonitorLt1','MonitorLt2','MonitorLt3','MonitorLt4','MonitorLt5','MonitorLt6','textmonitor','bgMonitor','judul_layanan1','judul_layanan2','judul_layanan2','judul_layanan3','judul_layanan4','judul_layanan5','judul_layanan6'));
        /*s
        $data = DB::table('view_monitoring_utama')
            -> get();
        $_lantai = DB::table('view_monitoring_utama')
            -> select('lantai', DB::raw('count(id) as jumlah'))
            -> groupBy('lantai')
            -> get();
        return view('monitor')
            -> with('_lantai', $lantai)
            -> with('_data', $data);
            */
    }
}
