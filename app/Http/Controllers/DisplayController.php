<?php

namespace App\Http\Controllers;
use App\Loket;
use App\Tulisan;
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
        $textmonitor = Tulisan::where('lantai','monitor')->LIMIT('1')->get();
        return view('monitor', compact('MonitorLt1','MonitorLt2','MonitorLt3','MonitorLt4','MonitorLt5','MonitorLt6','textmonitor'));
        /*
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
