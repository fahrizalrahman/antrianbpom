@extends('layouts.app_unit')

@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3>Daftar Pembatalan</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-container">
						
						<div class="row">
							<div class="col-md-4" style="margin-left: 20px;">
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
							<div class="col-md-4" style="margin-top: 30px;">
								<button id="proses" class="btn btn-success">Proses</button> <button  class="btn btn-danger bt_export_pdf">Download <span class="fa fa-file-pdf-o"></span></button>
							</div>
						</div>
						<br>
						<div class="row">
							<span>
							<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="100px">Tanggal</th>
											<th width="100px">Nama</th>
											<th width="100px">No Antrian</th>
											<th width="100px">Layanan</th>
											<th width="100px">Loket</th>
											<th width="100px">Sub Layanan</th>
											<th width="100px">Loket Sub</th>
											<th width="130px">Keterangan Batal</th>
										</tr>
									</thead>
									<tbody id="refresh-table">
										
									</tbody>
				                </table>
				              </div>
						</span>
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

<script type="text/javascript">

	$(document).ready(function() {
      	var petugas = $("#petugas").val();
          $.get('{{ Url("unit-filter-daftar-pembatalan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),petugas:petugas}, function(resp){  
           			 $("#refresh-table").html(resp);
          });
	});
	$(document).on('click', '#proses', function (e) { 
         var petugas = $("#petugas").val();
          $.get('{{ Url("unit-filter-daftar-pembatalan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),petugas:petugas}, function(resp){  
           			 $("#refresh-table").html(resp);
          });
    });

	$(document).on('click', '.bt_export_pdf', function(e){
	e.preventDefault();
	if(e.which===1){

		var petugas = $("#petugas").val();
		$.ajax({
            cache: false,
            type: 'GET',
            url: '/petugas/report/create_pdf_pembatalan_unit',
            contentType: false,
            processData: false,
            data: 'q=create_pdf&petugas=' + petugas,
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
 $(function () {
            $("#example1").DataTable({
            });
          });
</script>


@endsection