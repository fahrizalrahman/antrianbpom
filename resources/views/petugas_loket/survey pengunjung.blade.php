@extends('layouts.app_petugas_loket')

@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3>Laporan Survey Pengunjung</h3>
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
											<th width="250px">Email</th>
											<th width="250px">Nama Pengunjung</th>
											<th width="125px">No. Telp</th>
											<th>Pelayanan</th>
											<th width="100px">Loket</th>
											<th width="150px">Survey</th>
										</tr>
									</thead>
									<tbody>
										<?php $_i=0; 
										$emosi = array("TIDAK SURVEY", "SANGAT PUAS", "PUAS", "TIDAK PUAS");
										?>
										@foreach($_data as $data)
											@if($_i % 2===0)
												<tr>
											@else
												<tr style="background-color: #dddddd">
											@endif
												<td align="center">{{ substr($data->tanggal,0,10) }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ strtoupper($data->pelanggan) }}</td>
												<td>{{ strtoupper($data->no_telp) }}</td>
												<td>{{ strtoupper($data->nama_layanan) }}</td>
												<td>{{ strtoupper($data->nama_loket) }}</td>
												<td>{{ strtoupper($emosi[$data->kepuasan]) }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>
									<tfoot>
										<tr style="border-top: 2px solid #aaaaaa;">
											<td colspan="6" style="padding: 10px;">{{ $_data->render() }}</td>
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