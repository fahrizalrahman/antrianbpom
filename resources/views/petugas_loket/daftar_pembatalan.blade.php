@extends('layouts.app_petugas_loket')

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
							<div class="col-md-1" style="padding-left:20px;">
								<button class="btn btn-danger bt_export_pdf">Download <span class="fa fa-file-pdf-o"></span></button>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<table id="example2" width="100%" class="table table-striped table-responsive">
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Nama</th>
											<th>No Antrian</th>
											<th>Layanan</th>
											<th>Loket</th>
											<th>Sub Layanan</th>
											<th>Loket Sub</th>
											<th>Keterangan Batal</th>
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
												<td>{{ strtoupper($data->nama_pelanggan) }}</td>
												<td>{{ $data->no_antrian }}</td>
												<td>{{ strtoupper($data->nama_layanan) }}</td>
												<td>{{ strtoupper($data->nama_loket) }}</td>
												<td>{{ strtoupper($data->sub_layanan) }}</td>
												<td>{{ strtoupper($data->nama_loket_sub) }}</td>
												<td>{{ $data->keterangan_batal }}</td>
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
            url: '/petugas/report/create_pdf_pembatalan',
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