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
							<div class="col-md-4">
								<label class="label-input">Pelayanan : </label>
								<select id="pelayanan" class="ed_sel_layanan input_date full-width">
									<option value="all">Semua Layanan</option>
									<option value="0">TIDAK SURVEY</option>
									<option value="1">SANGAT PUAS</option>
									<option value="2">PUAS</option>
									<option value="3">TIDAK PUAS</option>
								</select>	
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" style="margin-top: 10px;">
									<button class="btn btn-danger bt_export_pdf" data-id="0"  style="align-items:left;">Download <span class="fa fa-file-pdf-o"></span></button>
								<button id="proses" class="btn btn-success">Proses</button>
								<hr />
							</div>
						</div>
						<div class="row">
							<span id="refresh-table">
							@include('laporan.refresh_table_survey')
							</span> <!--penutup span-->
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

@section('scripts')
<script type="text/javascript">
      $(document).ready(function() {
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();
         var petugas = $("#petugas").val();
         var pelayanan = $("#pelayanan").val();


          $.get('{{ Url("filter-data-survey") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas,pelayanan:pelayanan}, function(resp){  

            $("#refresh-table").html(resp);
             
          });
    });
      
        $(document).on('click', '#proses', function (e) { 
         
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();
         var petugas = $("#petugas").val();
         var pelayanan = $("#pelayanan").val();



          $.get('{{ Url("filter-data-survey") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas,pelayanan:pelayanan}, function(resp){  

            $("#refresh-table").html(resp);
             
          });
    });
</script>

<script type="text/javascript">
	$(document).ready(function() {
	   var ed_mulai = $("#ed_mulai").val();
	   var ed_sampai = $("#ed_sampai").val();
	   var petugas = $("#petugas").val();
	   var pelayanan = $("#pelayanan").val();


		$.get('{{ Url("filter-data-survey") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas,pelayanan:pelayanan}, function(resp){  

		  $("#refresh-table").html(resp);
		   
		});
  });
	
	  $(document).on('click', '#proses', function (e) { 
	   
	   var ed_mulai = $("#ed_mulai").val();
	   var ed_sampai = $("#ed_sampai").val();
	   var petugas = $("#petugas").val();
	   var pelayanan = $("#pelayanan").val();

		$.get('{{ Url("filter-data-survey") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas,pelayanan:pelayanan}, function(resp){  

		  $("#refresh-table").html(resp);
		   
		});
  });


	  $(document).on('click', '.bt_export_pdf', function(e){
	  e.preventDefault();
		  if(e.which===1){
		   var ed_mulai = $("#ed_mulai").val();
		   var ed_sampai = $("#ed_sampai").val();
		   var petugas = $("#petugas").val();
		   var pelayanan = $("#pelayanan").val();

	  $.ajax({
		  cache: false,
		  type: 'GET',
		  url: '/petugas/report/create_pdf_survey_admin',
		  contentType: false,
		  processData: false,
		  data: 'q=create_pdf&ed_mulai=' + ed_mulai + '&ed_sampai=' + ed_sampai+ '&petugas=' + petugas+ '&pelayanan=' + pelayanan,
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
