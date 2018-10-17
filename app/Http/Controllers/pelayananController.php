<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use DB;
use Auth;
use App\Loket;

class pelayananController extends Controller{

	public function total_antrian(Request $Request){
		if(Auth::check()){
			$response = new StreamedResponse();
			$response->headers->set('Content-Type', 'text/event-stream');
			$response->headers->set('Cache-Control', 'no-cache');
			$response->setCallback(
				 function() {
				 	$id_loket = DB::table('lokets')
						-> select('id', 'kode_antrian')
						-> where('petugas', '=', Auth::user()->id)
						-> first();

					$total = DB::table('antrians')
						-> whereRaw('id_loket=' . $id_loket->id)
						-> count('id');
					
					if($total){
				 		$hasil['total'] = (string)@$total;
	                }else{
	                	$hasil['total'] = '0';
	                }

	                $sisa = DB::table('antrians')
				 		-> whereRaw('status="antri" and id_loket=' . $id_loket->id)
				 		-> count('id');
				 	if($sisa){
				 		$hasil['sisa'] = (string)@$sisa;
	                }else{
	                	$hasil['sisa'] = '0';
	                }

	                $berikut = DB::table('antrians')
				 		-> select('no_antrian')
				 		-> whereRaw('status="antri" and id_loket=' . $id_loket->id)
				 		-> first();
				 	if($berikut){
				 		$hasil['berikut'] = $id_loket->kode_antrian . (string)@$berikut->no_antrian;
	                }else{
	                	$hasil['berikut'] = '0';
	                }

	                $saat_ini = DB::table('pelayanans')
				 		-> select('no_antrian')
				 		-> where(['keterangan'=>'Pemanggilan', 'id_petugas' => Auth()->user()->id])
				 		-> first();

				 	if(is_null($saat_ini)){
				 		$sekarang = DB::table('pelayanans')
				 			-> select('no_antrian')
					 		-> where(['keterangan'=>'Diterima', 'id_petugas' => Auth()->user()->id])
					 		-> first();
					 	if(is_null($sekarang)){
    	                	$hasil['sekarang'] = '0';
    	            	}else{
    	                	$hasil['sekarang'] = $id_loket->kode_antrian . (string)@$sekarang->no_antrian;
    	            	}
				 	}else{
	                    $hasil['sekarang'] = $id_loket->kode_antrian . (string)@$saat_ini->no_antrian;
				 	}

                    echo "data: " . json_encode($hasil) . "\n\n";
                    ob_flush();
           	        flush();
                });
			$response->send();
		}
	}

	public function update_status(Request $request){
		if(Auth::check()){
			if($request->q==='update'){

				$id_loket = DB::table('lokets')
					-> select('id')
					-> where('petugas', '=', Auth::user()->id)
					-> first();

				DB::table('antrians')
					-> where([
						'id_loket'=>$id_loket->id,
						'no_antrian'=>intval(substr($request->id, 1)),
						'status'	=> 'antri'
						])
					-> update([
						'status'=>'dipanggil',
						'updated_at'=>now()
					]);

				$dipanggil = DB::table('antrians AS a')
					-> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
					-> select('a.id', 'a.id_loket', 'a.no_antrian', 'a.id_user', 'b.name')
					-> where([
						'a.status'	=> 'dipanggil',
						'a.id_loket'	=> $id_loket->id
					])->first();

				$rowid = (DB::table('pelayanans')->count()) + intval(1);
				DB::table('pelayanans')
					-> insert([
						'rowid'			=> $rowid,
						'id_antrian'	=> $dipanggil->id,
						'no_antrian'	=> $dipanggil->no_antrian,
						'id_petugas'	=> Auth()->user()->id,
						'keterangan'	=> 'Pemanggilan',
						'created_at'	=> now(),
						'updated_at'	=> now()
					]);
				return '0';
			}elseif($request->q==='lewati'){
				$id_loket = DB::table('lokets')
					-> select('id')
					-> where('petugas', '=', Auth::user()->id)
					-> first();

				DB::table('antrians')
					-> where([
						'id_loket'	=> $id_loket->id,
						'no_antrian'=> $request->data,
						'status'	=> 'dipanggil'
						])
					-> update([
						'status'=>'lewati',
						'updated_at'=>now()
					]);

				DB::table('pelayanans')
					-> where([
						'id_petugas'	=> Auth()->user()->id,
						'no_antrian'	=> $request->data,
						'keterangan'	=> 'Pemanggilan'
						])
					-> update([
						'keterangan'=>'Lewati',
						'updated_at'=>now()
					]);
					
				return '0';
			}elseif($request->q==='terima'){
				$id_loket = DB::table('lokets')
					-> select('id')
					-> where('petugas', '=', Auth::user()->id)
					-> first();

				DB::table('antrians')
					-> where([
						'id_loket'	=> $id_loket->id,
						'no_antrian'=> substr($request->data,1),
						'status'	=> 'dipanggil'
						])
					-> update([
						'status'=>'diterima',
						'updated_at'=>now()
					]);

				DB::table('pelayanans')
					-> where([
						'id_petugas'	=> Auth()->user()->id,
						'no_antrian'	=> substr($request->data,1),
						'keterangan'	=> 'Pemanggilan'
						])
					-> update([
						'keterangan'=>'Diterima',
						'mulai'			=> now(),
						'updated_at'=>now()
					]);
					
				return '0';
			}elseif($request->q==='proses ulang'){
				$id_loket = DB::table('lokets')
					-> select('id')
					-> where('petugas', '=', Auth::user()->id)
					-> first();

				DB::table('antrians')
					-> where([
						'id'		=> substr($request->data,1)
						])
					-> update([
						'status'=>'diterima',
						'updated_at'=>now()
					]);

				DB::table('pelayanans')
					-> where([
						'id_antrian'	=> substr($request->data,1)
						])
					-> update([
						'keterangan'=>'Diterima',
						'mulai'			=> now(),
						'updated_at'=>now()
					]);
					
				return '0';
			}elseif($request->q==='selesai'){
				$id_loket = DB::table('lokets')
					-> select('id')
					-> where('petugas', '=', Auth::user()->id)
					-> first();

				DB::table('antrians')
					-> where([
						'id_loket'	=> $id_loket->id,
						'no_antrian'=> substr($request->data,1),
						'status'	=> 'diterima'
						])
					-> update([
						'status'=>'selesai',
						'updated_at'=>now()
					]);

				DB::table('pelayanans')
					-> where([
						'id_petugas'	=> Auth()->user()->id,
						'no_antrian'	=> substr($request->data,1),
						'keterangan'	=> 'Diterima'
						])
					-> update([
						'keterangan'=>'selesai',
						'selesai'	=> now(),
						'updated_at'=>now()
					]);
					
				return '0';
			}elseif($request->q==='refresh antrian'){
				$loket = Loket::select('id', 'kode_antrian')
                    -> where ('petugas', '=', Auth::user()->id)
                    -> first();

				$data = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.no_antrian', 'b.name', 'a.status')
                    -> whereRaw('(a.status="antri" or a.status="dipanggil" or a.status="diterima") And a.id_loket="' . $loket->id . '"')
                    -> get();
				$_content = '';
				foreach($data as $_data){
					$_content = $_content . '<tr><td align="center">' . $loket->kode_antrian . $_data->no_antrian . '</td>' .
						'<td>' . strtoupper($_data->name) . '</td>' .
						'<td align="center">' . strtoupper($_data->status) . '</td></tr>'; 
				}
				return $_content;
			}elseif($request->q==='refresh lewati'){
				$loket = Loket::select('id', 'kode_antrian')
                    -> where ('petugas', '=', Auth::user()->id)
                    -> first();

                $lewati = DB::table('antrians AS a')
                    -> leftJoin('users AS b', 'b.id', '=', 'a.id_user')
                    -> select('a.id', 'a.no_antrian', 'b.name')
                    -> whereRaw('a.status="lewati" And a.id_loket="' . $loket->id . '" and substr(a.created_at, 1, 10) = date_format(now(), "%Y-%m-%d")')
                    -> get();

				$_content = '';
				foreach($lewati as $_data){
					$_content = $_content  . '<tr id="' . $_data->id . '"><td align="center">' . $loket->kode_antrian . $_data->no_antrian . '</td>' .
						'<td>' . strtoupper($_data->name) . '</td>' .
						'<td align="center"><button class="bt_ulangi_proses btn btn-success">Proses</button></td></tr>'; 
				}
				return $_content;
			}
		}else{
			return '404. Page Not Found!';
		}
	}

	public function terbilang($bilangan){
		$angka = array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
        '0', '0', '0');
        $kata = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh',
        'delapan', 'sembilan');
        $tingkat = array('', 'ribu', 'juta', 'milyar', 'triliun');
        $panjang_bilangan = strlen($bilangan);
        if ($panjang_bilangan > 15){
        	$kalimat = "Diluar Batas";
        	return $kalimat;
        }

        for ($i = 1; $i <= $panjang_bilangan; $i++){
        	$angka[$i] = substr($bilangan, -($i), 1);
        }
        $i = 1;
        $j = 0;
        $kalimat = "";
        while ($i <= $panjang_bilangan){
        	$subkalimat = "";
        	$kata1 = "";
        	$kata2 = "";
        	$kata3 = "";
        	if ($angka[$i + 2] != "0"){
        		if ($angka[$i + 2] == "1"){
        			$kata1 = "seratus";
        		}else{
        			$kata1 = $kata[$angka[$i + 2]] . " ratus";
        		}
        	}

        	if ($angka[$i + 1] != "0"){
        		if ($angka[$i + 1] == "1"){
        			if ($angka[$i] == "0"){
        				$kata2 = "sepuluh";
        			}elseif ($angka[$i] == "1"){
        				$kata2 = "sebelas";
        			}else{
        				$kata2 = $kata[$angka[$i]] . " belas";
        			}
        		}else{
        			$kata2 = $kata[$angka[$i + 1]] . " puluh";
        		}
        	}

        	if ($angka[$i] != "0"){
        		if ($angka[$i + 1] != "1"){
        			$kata3 = $kata[$angka[$i]];
        		}
        	}

        	if (($angka[$i] != "0") or ($angka[$i + 1] != "0") or ($angka[$i + 2] != "0")){
        		$subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
        	}

        	$kalimat = $subkalimat . $kalimat;
        	$i = $i + 3;
        	$j = $j + 1;
        }

        if (($angka[5] == "0") and ($angka[6] == "0")){
        	$kalimat = str_replace("satu ribu", "seribu", $kalimat);
        }
        return trim($kalimat);
    }


	public function konversi(Request $request){
		if(Auth::check()){
			if($request!==''){
				$_loket = DB::table('lokets')
					-> selectRaw('substr(kode,7) AS loket, kode_antrian')
					-> where('petugas', '=', Auth()->user()->id)
					-> first();
				if($request->jenis==='baru'){
					$_hasil = $_loket->kode_antrian . ' ' . $this->terbilang(intval(substr($request->q, 1))) . ' silahkan-menuju-loket ' . $_loket->kode_antrian . ' ' . $this->terbilang(intval($_loket->loket));
					return $_hasil;
				}elseif($request->jenis==='ulang'){
					$_hasil = $_loket->kode_antrian . ' ' . $this->terbilang(intval(substr($request->q, 1))) . ' silahkan-menuju-loket ' . $_loket->kode_antrian . ' ' . $this->terbilang(intval($_loket->loket));
					return $_hasil;
				}
			}else{
				return 'Angka kosong!';
			}
		}
	}

	public function check_status(Request $request){
		if(Auth::check()){
			$response = new StreamedResponse();
			$response->headers->set('Content-Type', 'text/event-stream');
			$response->headers->set('Cache-Control', 'no-cache');
			$response->setCallback(
				function() {
					$saat_ini = DB::table('pelayanans')
				 		-> select('no_antrian')
				 		-> where(['keterangan'=>'Diterima', 'id_petugas' => Auth()->user()->id])
				 		-> first();

				 	if(!is_null($saat_ini)){
						echo "data: " . @$saat_ini->no_antrian . "\n\n";
					}else{
						echo "data: 0\n\n";
					}
					ob_flush();
           	        flush();
				});
			$response->send();
		}
	}

}
