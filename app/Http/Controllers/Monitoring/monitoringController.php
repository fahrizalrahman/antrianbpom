<?php

namespace App\Http\Controllers\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use DB;

class monitoringController extends Controller
{
// Monitoring Layanan Lantai 1

    public function layanan_utama(Request $request){
    	$response = new StreamedResponse();
			$response->headers->set('Content-Type', 'text/event-stream');
			$response->headers->set('Cache-Control', 'no-cache');
			$response->setCallback(

				 function() {
				 	$data = DB::table('view_monitoring_utama')
				 		-> select('id_element', 'no_antri', 'nomor')
				 		-> get();
	                echo "data: " . json_encode($data) . "\n\n";
                    ob_flush();
                    flush();
                }
            );
			$response->send();

    }

    
    public function layanan_satu(Request $request){
    	$response = new StreamedResponse();
			$response->headers->set('Content-Type', 'text/event-stream');
			$response->headers->set('Cache-Control', 'no-cache');
			$response->setCallback(

				 function() {
				 	$lt1 = DB::table('antrians')
				 		-> select('no_antrian')
				 		-> whereRaw('(status="dipanggil" or status="diproses" or status="selesai") and id_loket=1')
				 		-> orderBy('updated_at', 'DESC')
				 		-> first();

				 	if($lt1){
				 		$hasil['l1'] = (string)@$lt1->no_antrian;
	                }else{
	                	$hasil['l1'] = '0';
	                }

	                $lt2 = DB::table('antrians')
				 		-> select('no_antrian')
				 		-> whereRaw('(status="dipanggil" or status="diproses") and id_loket=2')
				 		-> first();
				 	if($lt2){
				 		$hasil['l2'] = (string)@$lt2->no_antrian;
	                }else{
	                	$hasil['l2'] = '0';
	                }

	                $lt3 = DB::table('antrians')
				 		-> select('no_antrian')
				 		-> whereRaw('(status="dipanggil" or status="diproses") and id_loket=3')
				 		-> first();
				 	if($lt3){
				 		$hasil['l3'] = (string)@$lt2->no_antrian;
	                }else{
	                	$hasil['l3'] = '0';
	                }

	                $lt4 = DB::table('antrians')
				 		-> select('no_antrian')
				 		-> whereRaw('(status="dipanggil" or status="diproses") and id_loket=4')
				 		-> first();
				 	if($lt4){
				 		$hasil['l4'] = (string)@$lt4->no_antrian;
	                }else{
	                	$hasil['l4'] = '0';
	                }

	                $lt5 = DB::table('antrians')
				 		-> select('no_antrian')
				 		-> whereRaw('(status="dipanggil" or status="diproses") and id_loket=6')
				 		-> first();
				 	if($lt5){
				 		$hasil['l5'] = (string)@$lt4->no_antrian;
	                }else{
	                	$hasil['l5'] = '0';
	                }

	                $lt6 = DB::table('antrians')
				 		-> select('no_antrian')
				 		-> whereRaw('(status="dipanggil" or status="diproses") and id_loket=6')
				 		-> first();
				 	if($lt6){
				 		$hasil['l6'] = (string)@$lt4->no_antrian;
	                }else{
	                	$hasil['l6'] = '0';
	                }

	                echo "data: " . json_encode($hasil) . "\n\n";
                    ob_flush();
                    flush();
                });
			$response->send();

    }

    public function layanan_aktif(Request $request){
    	$response = new StreamedResponse();
			$response->headers->set('Content-Type', 'text/event-stream');
			$response->headers->set('Cache-Control', 'no-cache');
			$response->setCallback(
				 function() {
				 	$aktif = DB::table('antrians')
				 		-> select('id_loket')
				 		-> whereRaw('(`status`="dipanggil" or `status`="diproses") and id_loket<=6')
				 		-> orderBy('updated_at', 'ASC')
				 		-> first();

                    echo "retry: 2000\n\n"; // no retry would default to 3 seconds.
                    echo "data: " . (string)@$aktif->no_antrian . "\n\n";
                    ob_flush();
                    flush();
                });
			$response->send();
	}
	
}
