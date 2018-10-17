@extends('layouts.app_admin')

@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3 class="judul">Laporan Survey Pengunjung</h3>
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
							<div class="col-md-2">
								<label class="label-input">Mulai : </label>
								<input class="input_date" name="ed_mulai" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Mulai">
							</div>
							<div class="col-md-2">
								<label class="label-input">Sampai : </label>
								<input class="input_date" name="ed_mulai" type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Sampai">
							</div>
							<div class="col-md-4">
								<label class="label-input">Petugas : </label>
								<select class="ed_sel_petugas input_date full-width">
									<option value="ALL">Semua Petugas</option>
								</select>
							</div>
							<div class="col-md-4">
								<label class="label-input">Pelayanan : </label>
								<select class="ed_sel_layanan input_date full-width">
									<option value="ALL">Semua Layanan</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="margin-top: 10px;">
								<button class="btn btn-success">Proses</button>
								<hr />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr style="border-bottom: 3px solid black !important;">
											<th width="90px">Tanggal</th>
											<th width="150px">Petugas</th>
											<th width="150px">Email</th>
											<th width="150px">Pengunjung</th>
											<th width="100px">No. Telp</th>
											<th>Pelayanan</th>
											<th width="100px">Survey</th>
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
												<td>{{ $data->nama_petugas }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ strtoupper($data->pelanggan) }}</td>
												<td>{{ strtoupper($data->no_telp) }}</td>
												<td>{{ strtoupper($data->nama_layanan) }}</td>
												<td>{{ strtoupper($emosi[$data->kepuasan]) }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>
									<tfoot>
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
.full-width{
	width: 100% !important;
	display: block;
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