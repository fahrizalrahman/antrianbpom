@extends('layouts.app_petugas_loket')

@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3>Laporan Daftar Pengunjung</h3>
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
								<input class="input_date" name="ed_mulai" id="ed_mulai" type="text" value="{{ date_format(now(), "Y-m-d") }}"  onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Mulai">
							</div>
							<div class="col-md-1">
								<label class="label-input">Sampai : </label>
							</div>
							<div class="col-md-2">
								<input class="input_date" name="ed_sampai" id="ed_sampai" type="text" value="{{ date_format(now(), "Y-m-d") }}" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Sampai">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button id="proses" class="btn btn-success">Proses</button>
								<hr />
							</div>
						</div>
						<!--
						<div class="row">
							<div class="col-md-11">
							</div>
							<div class="col-md-1" style="padding: 0px 0px 10px 0px;">
								<button class="btn btn-danger bt_export_pdf"><span class="fa fa-file-pdf-o"></span></button>
							</div>
						</div>
						-->
						<div class="row">
							<div class="col-md-12">
								<table id="example2" width="100%" class="table-responsive">
									<thead>
										<tr>
											<th width="90px">Tanggal</th>
											<th width="175">Email</th>
											<th width="175px">Nama Pengunjung</th>
											<th width="100px">No. Telp</th>
											<th>Layanan</th>
											<th width="80px">Loket</th>
											<th>Sub Layanan</th>
											<th width="80px">Loket Sub</th>
											<th width="50px">Durasi</th>
										</tr>
									</thead>
									<tbody id="tbody_pengunjung">
										<?php $_i=0; ?>
										@foreach($_data as $data)
											@if($_i % 2===0)
												<tr>
											@else
												<tr style="background-color: #dddddd">
											@endif
												<td align="center">{{ substr($data->tanggal,0,10) }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ strtoupper($data->nama_pelanggan) }}</td>
												<td>{{ strtoupper($data->no_telp) }}</td>
												<td>{{ strtoupper($data->nama_layanan) }}</td>
												<td>{{ strtoupper($data->nama_loket) }}</td>
												<td>{{ strtoupper($data->sub_layanan) }}</td>
												<td>{{ strtoupper($data->nama_loket_sub) }}</td>
												<td align="center">{{ $data->lama }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">

$(document).on('click', '.bt_export_pdf', function(e){
	e.preventDefault();
	if(e.which===1){
		$.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/petugas/report/create_pdf',
			data 	: 'q=create_pdf',
			success	: function(data){
				/*
				$('#body_antrian').html('');
				$('#body_antrian').html(data);
				*/

			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
	}
});


$(document).on('click', '#proses', function (e) { 
         
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();

          $.get('{{ Url("laporan-data-pengunjung") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai}, function(resp){  

            $("#tbody_pengunjung").html(resp);             
          });
    });


</script>

<style type="text/css">
table > tbody > tr > td{
	padding: 5px 10px;
	border: 1px solid #aaaaaa;
	font-size: 10pt;
}
table > thead > tr > th{
	padding: 5px 10px;
	font-weight: bold;
	border: 1px solid #888888;
	border-bottom: 3px solid black !important;
	cursor: default;
	background-color: #aaaaaa;
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