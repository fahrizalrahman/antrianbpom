@extends('layouts.app_petugas_loket')

@section('body')
	<div class="content-wrapper" style="min-height: 638px;">
		<section class="content-header">
			<table>
				<tr>
					<td class="lb_caption">Unit</td>
					<td>: <strong>{{ $_layanan->nama_layanan }}</strong></td>
				</tr>
				<tr>
					<td class="lb_caption">Loket</td>
					<td>: <strong>{{ $_layanan->kode }}</strong></td>
				</tr>
			</table>
			<ol class="breadcrumb">
				<li><a href="/home" class="text-blue"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Sistem Antrian</li>
			</ol>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-lg-3 col-xs-6">
					<div class="small-box" style="box-shadow: 1px 1px 5px black;">
						<div class="inner text-center">
							<h1>{{ number_format($_total,0) }}</h1>
						</div>
						<span class="small-box-footer text-black">Total Antrian</span>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box" style="box-shadow: 1px 1px 5px black;">
						<div class="inner text-center">
							<h1>{{ number_format($_sisa,0) }}</h1>
						</div>
						<span class="small-box-footer text-black">Sisa Antrian</span>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box bg-blue" style="box-shadow: 1px 1px 5px black;">
						<div class="inner text-center">
							<h1 class="text-white">@if(is_null(@$_saat_ini->no_antrian)) 0 @endif</h1>
						</div>
						<span class="small-box-footer text-white">Antrian Saat Ini</span>
					</div>
				</div>
				<div class="col-lg-3 col-xs-6">
					<div class="small-box" style="box-shadow: 1px 1px 5px black;">
						<div class="inner text-center">
							<h1>{{ $_berikut->no_antrian }}</h1>
						</div>
						<span class="small-box-footer text-black">Antrian Berikutnya</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<button class="btn btn-primary" id="id_bt_panggil">Panggil Antrian</button>
					<button class="btn btn-primary" disabled><span class="fa fa-next"></span> Ulangi Panggilan</button>
					<button class="btn btn-primary" disabled><span class="fa fa-next"></span> Mulai Proses</button>
					<button class="btn btn-primary" disabled><span class="fa fa-next"></span> Selesai</button>
					<button class="btn btn-danger" disabled><span class="fa fa-next"></span> Lewati Nomor</button>
				</div>
			</div>
			<div class="row"><div class="col-lg-12" style="height: 30px;"></div></div>
			<div class="row">
				<div class="col-lg-6">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title"><strong>Daftar Antrian</strong></h3>
						</div>
						<div class="box-body">
							<table class="table table-bordered table-striped">
								<tbody>
									<tr class="bg-blue">
										<th style="width: 10px">Antrian</th>
										<th>Nama</th>
										<th align="center" width="20">Status</th>
										<th align="center" width="20">Loket</th>
									</tr>
									@foreach($_data as $data)
										@if($data->status==='panggil')
											<tr class="bg-success">
										@else
											<tr>
										@endif
											<td align="center">{{ $data->no_antrian }}</td>
											<td>{{ $data->name }}</td>
											<td width="20" align="center">{{ $data->status }}</td>
											<td width="20" align="center"></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<nav aria-label="Page navigation example">
							<ul class="pagination justify-content-end">
								<li class="page-item"><a class="page-link" href="#">Previous</a></li>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item"><a class="page-link" href="#">Next</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title"><strong>Antrian Yang Dilewati</strong></h3>
						</div>
						<div class="box-body">
							<table class="table table-bordered">
								<tbody>
									<tr class="bg-danger text-white">
										<th style="width: 10px">Antrian</th>
										<th>Nama</th>
										<th>Status</th>
										<th></th>
									</tr>
									<tr>
										<td style="text-align: center;">1.</td>
										<td>Budi Susilo</td>
										<td>Dipanggil</td>
										<td style="text-align: center; width: 100px;"><button style="font-size: 8pt;" class="btn btn-success">Proses Ulang</button></td>
									</tr>
								</tbody>
							</table>
						</div>
						<nav aria-label="Page navigation example">
							<ul class="pagination justify-content-end">
								<li class="page-item"><a class="page-link" href="#">Previous</a></li>
								<li class="page-item"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item"><a class="page-link" href="#">Next</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</section>
	</div>

<script type="text/javascript">

$(document).on('click', '#id_bt_panggil', function(e){
		alert('diproses');
});

</script>

<style type="text/css">
.inner > h1{
	font-size: 36pt;
	font-weight: bold;
	font-family: 'arial narrow';
	text-shadow: 1px 1px 5px black;
	color: black;
	padding: 0px;
}
.lb_caption{
	font-size: 11pt;
	color: #888888;
}
table > tbody > tr > td{
	padding: 5px !important;
}
table{
	font-family: arial;
	font-size: 10pt;
}
.inner{
	padding: 10px !important;
}
</style>
@endsection