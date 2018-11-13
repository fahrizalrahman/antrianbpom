@extends('layouts.app_admin')

@section('content')
<div class="content-wrapper">


	   <!-- The Modal 1-->
<div class="modal" id="myModal1" >
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title"><span id="nama-pelanggan-kunjungan"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" >
      	<div class="col-md-12">
				<table  class="table table-bordered table-striped table-responsive">
					<thead>
						<tr>
							<th style="width:200px;"> Tanggal</th>
							<th style="width:200px;"> Loket</th>
							<th style="width:200px;"> Layanan</th>
							<th style="width:200px;"> Sub Layanan</th>
							<th style="width:200px;"> Petugas</th>
							<th style="width:200px;"> Kepuasan</th>
						</tr>
					</thead>
					<tbody id="refresh-list-kunjungan">
					</tbody>
				</table>
			</div>
		<div class="modal-footer">
			<h4>Total Kunjungan : <span id="count-list-kunjungan"></span></h4>
		</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 1-->



	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3 class="judul">Laporan Pengunjung</h3>
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
								<input class="input_date" id="ed_mulai" name="ed_mulai" type="text" value="{{ date_format(now(), "Y-m-d") }}" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Mulai">
							</div>
							<div class="col-md-2">
								<label class="label-input">Sampai : </label>
								<input class="input_date" id="ed_sampai" name="ed_sampai" type="text" value="{{ date_format(now(), "Y-m-d") }}" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Sampai">
							</div>
							<div class="col-md-4">
								<label class="label-input">Petugas : </label>
								<select id="petugas" class="ed_sel_petugas input_date full-width">
									<option value="all">Semua Petugas</option>
									<?php
									$data_petugas = App\User::select('id','name')->where('jabatan','petugas_loket')->get();
									?>
									@foreach($data_petugas as $data_petugass)
									<option value="{{$data_petugass->id}}">{{$data_petugass->name}}</option>
									@endforeach									
								</select>
							</div>

						</div>
						<div class="row">
							<div class="col-md-12" style="margin-top: 10px;">
								<button id="proses" class="btn btn-success">Proses</button>
								<button class="btn btn-danger bt_export_pdf">Download <span class="fa fa-file-pdf-o"></span></button>
								<hr />
							</div>
						</div>
							<div class="col-md-12">
								<table id="example2" width="100%" class="table table-stripedtable-responsive">
									<thead>
										<tr>
											<th width="300px">Nama Pelanggan</th>
											<th width="300px">Email</th>
											<th width="300px">No Telp</th>
											<th width="100px">Lihat</th>
										</tr>
									</thead>
									<tbody>
										@foreach($_data as $data)
										<tr>
										<td>{{ strtoupper($data->pelanggan) }}</td>
										<td>{{ $data->email }}</td>
										<td>{{ strtoupper($data->no_telp) }}</td>
										<td><button style="background-color:#17A2B8;color:white;" class="btn btn-sm modal-list" data-user="{{$data->id_user}}" ><i class="nav-icon fa fa-eye"></i> Kunjungan</button></td>
										</td>
										</tr>
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
table.dataTable thead tr {
  padding: 0px;
  margin: 0px;
  color: white;
  background-color: green;
}
</style>
@endsection

@section('scripts')
<script type="text/javascript">
      $(document).ready(function() {
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();
         var petugas = $("#petugas").val();


          $.get('{{ Url("filter-laporan-pengunjung") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas}, function(resp){  

            $("#refresh-table").html(resp);
             
          });


    });
      
        $(document).on('click', '#proses', function (e) { 
         
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();
         var petugas = $("#petugas").val();

          $.get('{{ Url("filter-laporan-pengunjung") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas}, function(resp){  

            $("#refresh-table").html(resp);
             
          });
    });

     $(document).on('click', '.modal-list', function (e) { 
          	var id_user = $(this).attr('data-user');
         	var tglmulai = $("#ed_mulai").val();
         	var tglsampai = $("#ed_sampai").val();
         	var petugas = $("#petugas").val();


          $("#myModal1").modal('show');
          $.get('{{ Url("lihat-list-kunjungan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id_user:id_user,tglmulai:tglmulai,tglsampai:tglsampai,petugas:petugas}, function(resp){ 
              $("#refresh-list-kunjungan").html(resp.tables);
              $("#count-list-kunjungan").html(resp.count);
              $("#nama-pelanggan-kunjungan").html(resp.pelanggan);

          });

     });
</script>

	<script type="text/javascript">
		$(document).on('click', '.bt_export_pdf', function(e){
		e.preventDefault();
		if(e.which===1){
	
			$.ajax({
							cache: false,
							type: 'GET',
							url: '/petugas/report/create_pdf_pengunjung',
							contentType: false,
							processData: false,
							data: 'q=create_pdf',
								//xhrFields is what did the trick to read the blob to pdf
							xhrFields: {
									responseType: 'blob'
							},
							success: function (response, status, xhr) {
	
									var filename = "";                   
									var disposition = xhr.getResponseHeader('Content-Disposition');
	
										if (disposition) {
											var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
											var matches = filenameRegex.exec(disposition);
											if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
									} 
									var linkelem = document.createElement('a');
									try {
											var blob = new Blob([response], { type: 'application/octet-stream' });                        
	
											if (typeof window.navigator.msSaveBlob !== 'undefined') {
													//   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
													window.navigator.msSaveBlob(blob, filename);
											} else {
													var URL = window.URL || window.webkitURL;
													var downloadUrl = URL.createObjectURL(blob);
	
													if (filename) { 
															// use HTML5 a[download] attribute to specify filename
															var a = document.createElement("a");
	
															// safari doesn't support this yet
															if (typeof a.download === 'undefined') {
																	window.location = downloadUrl;
															} else {
																	a.href = downloadUrl;
																	a.download = filename;
																	document.body.appendChild(a);
																	a.target = "_blank";
																	a.click();
															}
													} else {
															window.location = downloadUrl;
													}
											}   
	
									} catch (ex) {
											console.log(ex);
									} 
							}
				});
		}
	});
	
	</script>
@endsection

