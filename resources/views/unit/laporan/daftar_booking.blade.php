@extends('layouts.app_petugas_loket')

@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3>Daftar Booking</h3>
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
							<div class="col-md-4">
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

						</div>

						<div class="row">
							<div class="col-md-1" style="padding-left:20px;">
								<button class="btn btn-danger bt_export_pdf">Download <span class="fa fa-file-pdf-o"></span></button>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<table id="example2" width="100%" class="table table-stripedtable-responsive">
									<thead>
										<tr>
											<th width="90px">Tanggal</th>
											<th width="175">Email</th>
											<th width="175px">Nama Pengunjung</th>
											<th width="100px">No. Telp</th>
											<th>No Antrian</th>
											<th>Layanan</th>
											<th width="80px">Loket</th>
											<th>Sub Layanan</th>
											<th width="80px">Loket Sub</th>
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
												<td>{{ $data->no_antrian }}</td>
												<td>{{ strtoupper($data->nama_layanan) }}</td>
												<td>{{ strtoupper($data->nama_loket) }}</td>
												<td>{{ strtoupper($data->sub_layanan) }}</td>
												<td>{{ strtoupper($data->nama_loket_sub) }}</td>
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
            cache: false,
            type: 'GET',
            url: '/petugas/report/create_pdf_booking',
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
