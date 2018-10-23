<?php

namespace App\helper;
use Carbon\Carbon;
class Tanggal
{

	public static function ambil_hari($date){
		$dt = new Carbon($date);
		setlocale(LC_TIME, 'IND');
		return $dt->formatLocalized('%A');
	}

	public static function bulan_ini(){
		$dt = new Carbon(now());
		setlocale(LC_TIME, 'IND');
		return $dt->formatLocalized('%B');
	}

	public static function konversi($date, $format){
		$dt = new Carbon($date);
		setlocale(LC_TIME, 'IND');
		return $dt->formatLocalized($format);
	}
}