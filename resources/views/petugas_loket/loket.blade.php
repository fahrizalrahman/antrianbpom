@extends('layouts.app_petugas_loket')

@section('content')
	<div class="content-wrapper">
		<section class="content">
			<div class="container-fluid">
				<br />
				<div class="row">
					<div class="col-md-12">
						<div class="card card-info">
							<div class="card-header">
								<h3 class="card-title"><strong>{{ $_loket->nama_layanan }} <br /> Lantai {{ $_loket->lantai . ' - ' . $_loket->kode }}</strong></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
								</div>
							</div>
<style type="text/css">
.card-shadow{
	box-shadow: 1px 1px 5px black;
}
</style>
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="card card-shadow">
											<label class="lb_total_antri" style="width: 100%; text-align: center; font-size: 80pt">0</label>
											<div class="card-body bg-primary text-center">
												<h4 class="card-title"><strong>TOTAL ANTRIAN</strong></h4>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="card card-shadow">
											<label class="lb_sisa_antri" style="width: 100%; text-align: center; font-size: 80pt">0</label>
											<div class="card-body bg-primary text-center">
											<h4 class="card-title"><strong>SISA ANTRIAN</strong></h4>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="card card-shadow">
											<label class="lb_no_saat_ini" style="width: 100%; text-align: center; font-size: 80pt">0</label>
											<div class="card-body bg-danger text-center">
												<h4 class="card-title"><strong>NOMOR SAAT INI</strong></h4>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="card card-shadow">
											<label class="lb_no_berikut" style="width: 100%; text-align: center; font-size: 80pt">0</label>
											<div class="card-body bg-primary text-center">
												<h4 class="card-title"><strong>NOMOR BERIKUTNYA</strong></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
<style type="text/css">
.btn > span{
	padding: 5px 15px 5px 5px;
}
</style>
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<button type="button" disabled="true" class="id_panggil btn btn-primary btn-lg">
									<span class="fa fa-microphone"></span>Panggil
								</button>
								<button type="button" disabled="true" class="id_ulang btn btn-primary btn-lg">
									<span class="fa fa-refresh"></span>Panggil Ulang
								</button>
								<button type="button" disabled="true" class="id_terima btn btn-primary btn-lg">
									<span class="fa fa-check-square-o"></span>Terima
								</button>
								<button type="button" disabled="true" class="id_selesai btn btn-primary btn-lg">
									<span class="fa fa-hourglass-end"></span>Selesai
								</button>								
							</div>
							<div class="col-md-6 text-right">
								<button type="button" disabled="true" class="id_lewati btn btn-danger btn-lg">
									<span class="fa fa-fast-forward"></span>Lewati
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
							<audio id="id_audio" hidden controls></audio>
					</div>
				</div>
				<div style="height: 30px;"></div>
				<div class="row">
					<div class="col-md-6">
						<strong>DAFTAR ANTRIAN</strong>
						<table>
							<thead>
								<tr>
									<th width="75px;" align="center">No.</th>
									<th>Nama</th>
									<th width="150px" align="center">Status</th>
								</tr>
							</thead>
							<tbody id="body_antrian">
								@foreach($_data as $data)
								<tr>
									<td align="center">{{ $_loket->kode_antrian . $data->no_antrian }}</td>
									<td>{{ strtoupper($data->name) }}</td>
									<td align="center">{{ strtoupper($data->status) }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<strong>DAFTAR ANTRIAN YANG DILEWATI</strong>
						<table>
							<thead>
								<tr>
									<th width="75px;" align="center">No.</th>
									<th>Nama</th>
									<th width="150px" align="center">Proses</th>
								</tr>
							</thead>
							<tbody id="body_lewati">
								@foreach($_lewati as $lewati)
								<tr id="{{ $lewati-> id }}">
									<td align="center">{{ $_loket->kode_antrian . $lewati->no_antrian }}</td>
									<td>{{ $lewati->name }}</td>
									<td align="center"><button class="bt_ulangi_proses btn btn-success">Proses</button></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<label class="test" style="color: white"></label>
					</div>
				</div>
			</div>
		</section>
	</div>

@endsection

@section('footer_script')
<style type="text/css">

table > tbody > tr > td{
	padding: 5px 10px;
	border: 1px solid #aaaaaa;
}
table > thead > tr >th{
	padding: 5px 10px;
	font-weight: bold;
	border: 1px solid #aaaaaa;
}
table > thead > tr{
	background: #dddddd;
}
table{
	width: 100%;
}
</style>


<script type="text/javascript">

$(function(){
	var curPlaying = 1;
	$('#id_audio').bind('ended', function(){
		var audio = document.getElementById('id_audio');
		var lstsongNames = _data.split(',');
		var urls = audio.getElementsByTagName('source');
		if (urls[0].src.indexOf(lstsongNames[lstsongNames.length - 1]) === -1) {
			urls[0].src = '/custom/audio/' + lstsongNames[curPlaying];
		}
		if(lstsongNames[curPlaying]!=='undefined'){
	   		audio.load();
   			audio.play();
		curPlaying++;
   		}
		if((curPlaying - 1) === lstsongNames.length){
    		curPlaying = 0;
			audio.pause();
	    	audio.currentTime = 0;
		}
	});
});

function refresh_antrian(){
	$.ajax({
		headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		dataType: 'html',
		url		: '/proses/layanan/update',
		data 	: 'q=refresh antrian',
		success	: function(data){
			$('#body_antrian').html('');
			$('#body_antrian').html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
		}
	});
}

function refresh_lewati(){
	$.ajax({
		headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		dataType: 'html',
		url		: '/proses/layanan/update',
		data 	: 'q=refresh lewati',
		success	: function(data){
			$('#body_lewati').html('');
			$('#body_lewati').html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
		}
	});
}

$(document).on('click', '.id_lewati', function(e){
	e.preventDefault();
	if(e.which===1){
		if(confirm('Anda yakin ingin melewati nomor antrian saat ini?')){
			$.ajax({
				headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				dataType: 'html',
				url		: '/proses/layanan/update',
				data 	: 'q=lewati&data=' + $('.lb_no_saat_ini').html(),
				success	: function(data){
					if(data==='0'){
						alert('Nomor Antrian berhasil dilewati');
						load_data();
						refresh_lewati();
						refresh_antrian();
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText);
				}
			});
		}
	}
});

$(document).on('click', '.id_ulang', function(e){
	e.preventDefault();
	if(e.which===1){
		$.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/proses/konversi_nomor',
			data 	: 'jenis=ulang&q=' + $('.lb_no_saat_ini').html(),
			success	: function(data){
				if(data.length > 0){
					_data = 'in.wav,nomor antrian.wav,' + data.replace(/\s+/g, '.wav,') + '.wav,out.wav';
					_obj = '<source src="/custom/audio/in.wav" type="audio/mpeg">' +
						'<source src="/custom/audio/nomor antrian.wav" type="audio/mpeg">' +
						'<source src="/custom/audio/' +  data.replace(/\s+/g, '.wav" type="audio/mpeg">,<source src="/custom/audio/') +
						'.wav" type="audio/mpeg"><source src="/custom/audio/out.wav" type="audio/mpeg">';
					$('#id_audio').html(null);
					$('#id_audio').html(_obj);
					$("#id_audio").prop("currentTime",0);
					$('#id_audio').trigger('play');
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
	}
});

$(document).on('click', '.id_selesai', function(e){
	e.preventDefault();
	if(e.which===1){
		$.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/proses/layanan/update',
			data 	: 'q=selesai&data=' + $('.lb_no_saat_ini').html(),
			success	: function(data){
				if(data.length > 0){
					alert('Data selesai diproses');
					load_data();
					refresh_antrian();
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
	}
});

$(document).on('click', '.bt_ulangi_proses', function(e){
	e.preventDefault();
	if(e.which===1){
		$.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/proses/layanan/update',
			data 	: 'q=proses ulang&data=' + $(this).parent('td').parent('tr').attr('id'),
			success	: function(data){
				if(data.length > 0){
					alert('Data berhasil diterima');
					load_data();
					refresh_lewati();
					refresh_antrian();
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
	}
});

$(document).on('click', '.id_terima', function(e){
	e.preventDefault();
	if(e.which===1){
		$.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/proses/layanan/update',
			data 	: 'q=terima&data=' + $('.lb_no_saat_ini').html(),
			success	: function(data){
				if(data.length > 0){
					alert('Data berhasil diterima');
					load_data();
					refresh_antrian();
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
	}
});

$(document).on('click', '.id_panggil', function(e){
	e.preventDefault();
	if(e.which===1){
		$.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/proses/layanan/update',
			data 	: 'q=update&id=' + $('.lb_no_berikut').html(),
			success	: function(data){
				if(data==='0'){
					load_data();
					$.ajax({
						headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						dataType: 'html',
						url		: '/proses/konversi_nomor',
						data 	: 'jenis=baru&q=' + $('.lb_no_berikut').html(),
						success	: function(data){
							if(data.length > 0){
								_data = 'in.wav,nomor antrian.wav,' + data.replace(/\s+/g, '.wav,') + '.wav,out.wav';
								_obj = '<source src="/custom/audio/in.wav" type="audio/mpeg">' +
									'<source src="/custom/audio/nomor antrian.wav" type="audio/mpeg">' +
									'<source src="/custom/audio/' +  data.replace(/\s+/g, '.wav" type="audio/mpeg">,<source src="/custom/audio/') +
									'.wav" type="audio/mpeg"><source src="/custom/audio/out.wav" type="audio/mpeg">';
								$('#id_audio').html(null);
								$('#id_audio').html(_obj);
								$("#id_audio").prop("currentTime",0);
								$('#id_audio').trigger('play');
							}
							refresh_antrian();
						},
						error: function (xhr, ajaxOptions, thrownError) {
							alert(xhr.responseText);
						}
					});
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
	}
});

function load_data(){

var es = new EventSource('/proses/total');
es_total.addEventListener('error', function(e) {
  if (e.readyState == EventSource.CLOSED) {
    // Connection was closed.
  }
}, false);
es_total.onmessage = function(e) {
	var dt = new Date();
	var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	$('.test').html(time);


	var _text = e.data;
    var _data = JSON.parse(_text);
    $('.lb_total_antri').html(_data.total);
    $('.lb_sisa_antri').html(_data.sisa);
    $('.lb_no_berikut').html(_data.berikut);
    $('.lb_no_saat_ini').html(_data.sekarang);
}

var es = new EventSource("<?php echo action('pelayananController@check_status'); ?>");
es.onmessage = function(e) {
	if(e.data==='a'){
		$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', true);
			$('.id_terima').prop('disabled', true);
			$('.id_selesai').prop('disabled', false);
			$('.id_lewati').prop('disabled', true);
	}else{

	if($('.lb_sisa_antri').html()==='0'){
		if($('.lb_no_saat_ini').html()==='0'){
			$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', true);
			$('.id_terima').prop('disabled', true);
			$('.id_selesai').prop('disabled', true);
			$('.id_lewati').prop('disabled', true);
		}else{
			$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', false);
			$('.id_terima').prop('disabled', false);
			$('.id_selesai').prop('disabled', false);
			$('.id_lewati').prop('disabled', false);
		}
	}else{
		if($('.lb_no_saat_ini').html()==='0'){
			$('.id_panggil').prop('disabled', false);
			$('.id_ulang').prop('disabled', true);
			$('.id_terima').prop('disabled', true);
			$('.id_selesai').prop('disabled', true);
			$('.id_lewati').prop('disabled', true);
		}else{
			$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', false);
			$('.id_terima').prop('disabled', false);
			$('.id_selesai').prop('disabled', false);
			$('.id_lewati').prop('disabled', false);
		}
	}

	}
}

}

$(document).ready(function(){

var es_total = new EventSource('/proses/total');
es_total.addEventListener('error', function(e) {
  if (e.readyState == EventSource.CLOSED) {
    // Connection was closed.
  }
}, false);
es_total.onmessage = function(e) {
	var dt = new Date();
	var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	$('.test').html(time);


	var _text = e.data;
    var _data = JSON.parse(_text);
    $('.lb_total_antri').html(_data.total);
    $('.lb_sisa_antri').html(_data.sisa);
    $('.lb_no_berikut').html(_data.berikut);
    $('.lb_no_saat_ini').html(_data.sekarang);
}

var es_status = new EventSource("<?php echo action('pelayananController@check_status'); ?>");
es_status.addEventListener('error', function(e) {
  if (e.readyState == EventSource.CLOSED) {
    // Connection was closed.
  }
}, false);
es_status.onmessage = function(e) {
	if(e.data==='a'){
		$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', true);
			$('.id_terima').prop('disabled', true);
			$('.id_selesai').prop('disabled', false);
			$('.id_lewati').prop('disabled', true);
	}else{

	if($('.lb_sisa_antri').html()==='0'){
		if($('.lb_no_saat_ini').html()!=='0'){
			$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', false);
			$('.id_terima').prop('disabled', false);
			$('.id_selesai').prop('disabled', false);
			$('.id_lewati').prop('disabled', false);
		}else{
			$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', true);
			$('.id_terima').prop('disabled', true);
			$('.id_selesai').prop('disabled', true);
			$('.id_lewati').prop('disabled', true);
		}
	}else{
		if($('.lb_no_saat_ini').html()==='0'){
			$('.id_panggil').prop('disabled', false);
			$('.id_ulang').prop('disabled', true);
			$('.id_terima').prop('disabled', true);
			$('.id_selesai').prop('disabled', true);
			$('.id_lewati').prop('disabled', true);
		}else{
			$('.id_panggil').prop('disabled', true);
			$('.id_ulang').prop('disabled', false);
			$('.id_terima').prop('disabled', false);
			$('.id_selesai').prop('disabled', false);
			$('.id_lewati').prop('disabled', false);
		}
	}

	}
}

});
/*
$(document).ready(function(){

	window.setInterval(function(){
		get_data();
	}, 5000);
	
});
*/
</script>
@endsection