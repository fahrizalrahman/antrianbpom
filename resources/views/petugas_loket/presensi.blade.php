@extends('layouts.app_petugas_loket')

@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3>Laporan Presensi Petugas</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-container">
						<div class="row">
							<div class="col-md-12">
								<label class="label-input"><strong>Filter Data</strong></label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<label class="label-input">Mulai : </label>
							</div>
							<div class="col-md-2">
								<input class="input_date" name="ed_mulai" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Mulai">
							</div>
							<div class="col-md-1">
								<label class="label-input">Sampai : </label>
							</div>
							<div class="col-md-2">
								<input class="input_date" name="ed_mulai" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Sampai">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-success">Proses</button>
								<hr />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label class="label-input">Batas Data Yang Ditampilkan : </label>
								<select name="page" class="input-custom">
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="30">30</option>
									<option value="40">40</option>
									<option value="50">50</option>
								</select>
								<label class="label-input">baris </label>
								<hr />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table width="100%">
									<thead>
										<tr>
											<th width="150px">Tanggal</th>
											<th width="100px">No. Antri</th>
											<th width="350px">Nama Pengunjung</th>
											<th>Pelayanan</th>
											<th width="100px">Loket</th>
											<th width="100px">Hasil Survey</th>
											<th width="100px">Tingkat Kepuasan</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
									<tfoot>
										<tr style="border-top: 2px solid #aaaaaa;">
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<style type="text/css">
table > tbody > tr > td{
	padding: 5px 10px;
	border: 1px solid #aaaaaa;
}
table > thead > tr > th{
	padding: 5px 10px;
	font-weight: bold;
	border: 1px solid #aaaaaa;
	cursor: default;
	background-color: #dddddd;
}
.input_date{
	border: 1px solid #aaaaaa;
	width: 160px;
	height: 30px;
	outline-width: 0px;
	font-family: arial;
	color: black;
	padding: 5px 10px;
}
.input-custom{
	padding: 5px 10px;
}
.label-input{
	font-weight: normal !important;
}
.table-container{
	padding: 10px;
	border: 1px solid #dddddd;
}
</style>
@endsection