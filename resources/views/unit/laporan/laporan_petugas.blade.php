@extends('layouts.app_unit')

@section('content')
<div class="content-wrapper">


	   <!-- The Modal 1-->
<div class="modal" id="myModal1" >
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title"><span id="nama-petugas-pelayanan"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" >
      	<div class="col-md-12">
				<table  class="table table-bordered table-striped table-responsive">
					<thead>
						<tr>
							<th style="width:200px;"> Tanggal</th>
							<th style="width:200px;"> Pelanggan</th>
							<th style="width:200px;"> Layanan</th>
							<th style="width:200px;"> Sub Layanan</th>
							<th style="width:200px;"> Kepuasan</th>
							<th style="width:200px;"> Durasi Layanan</th>
						</tr>
					</thead>
					<tbody id="refresh-list-pelayanan">
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success bt_export_pdf" data-petugas="0"  style="align-items:left;">Download <span class="fa fa-file-pdf-o"></span></button>
				<h4>Total Layanan : <span id="count-list-pelayanan"></span></h4>
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
					<h3 class="judul">Laporan Petugas</h3>
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
								<input class="form-control" id="ed_mulai" name="ed_mulai" type="text" value="{{ date_format(now(), "Y-m-d") }}" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Mulai">
							</div>
							<div class="col-md-2">
								<label class="label-input">Sampai : </label>
								<input class="form-control" id="ed_sampai" name="ed_sampai" type="text" value="{{ date_format(now(), "Y-m-d") }}" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Sampai">
							</div>
							<div class="col-md-3">
								<label class="label-input">Petugas : </label>
								<select id="petugas" class="form-control">
									<option value="all">Semua Petugas</option>
									<?php
									$data_petugas = App\User::select('id','name')->where('unit', Auth::user()->unit)->get();
									?>
									@foreach($data_petugas as $data_petugass)
									<option value="{{$data_petugass->id}}">{{$data_petugass->name}}</option>
									@endforeach									
								</select>
							</div>
							<div class="col-md-5" style="margin-top:30px">
								<button id="proses" class="btn btn-success">Proses</button>
							</div>

						</div>
						<br>
						<div class="row">
							<span id="refresh-table">
								@include('unit.laporan.refresh_table_lap_petugas')
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


          $.get('{{ Url("unit-filter-laporan-petugas") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas}, function(resp){  

            $("#refresh-table").html(resp);
             
          });


    });
      
        $(document).on('click', '#proses', function (e) { 
         
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();
         var petugas = $("#petugas").val();

          $.get('{{ Url("unit-filter-laporan-petugas") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas}, function(resp){  

            $("#refresh-table").html(resp);
             
          });
    });

     $(document).on('click', '.modal-list', function (e) { 
          	var id_petugas = $(this).attr('data-petugas');
         	var tglmulai = $("#ed_mulai").val();
         	var tglsampai = $("#ed_sampai").val();


         $("#myModal1").modal('show');
         $.get('{{ Url("unit-lihat-list-pelayanan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id_petugas:id_petugas,tglmulai:tglmulai,tglsampai:tglsampai}, function(resp){ 
              $("#refresh-list-pelayanan").html(resp.tables);
		      $("#count-list-pelayanan").html(resp.count);
		      $("#nama-petugas-pelayanan").html(resp.petugas);  
              $(".bt_export_pdf").attr("data-petugas",id_petugas);


          });

     });

        $(document).on('click', '.bt_export_pdf', function(e){
        	e.preventDefault();
        	if(e.which===1){
        		 var id_petugas  = $(this).attr("data-petugas");
                 var tglmulai = $("#ed_mulai").val();
                 var tglsampai = $("#ed_sampai").val();

        		$.ajax({
                    cache: false,
                    type: 'GET',
                    url: '/petugas/report/create_pdf_presensi_unit',
                    contentType: false,
                    processData: false,
                    data: 'q=create_pdf&tglmulai=' + tglmulai + '&tglsampai=' + tglsampai+ '&id_petugas=' + id_petugas,
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

