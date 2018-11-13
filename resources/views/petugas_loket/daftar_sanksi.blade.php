@extends('layouts.app_petugas_loket')

@section('content')
<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3>Daftar Sanksi</h3>
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
									<table id="example2" width="100%" class="table table-stripedtable-responsive">
									<thead>
										<tr>
											<th width="90px">Tanggal</th>
											<th width="175">Email</th>
											<th width="175px">Nama Pengunjung</th>
											<th width="100px">No. Telp</th>
											{{-- <th>Sub Layanan</th>
											<th width="80px">Loket Sub</th> --}}
											<th width="130px">Action</th>
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
												<td>{{ $data->nama_pelanggan }}</td>
												<td>{{ $data->no_telp }}</td>
												
												<td align="center">
												<button id="del_sanksi" data-id="{{$data->id }}" class="btn btn-danger btn-sm">Buka Sanksi</button>
												</td>
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
@endsection
@section('footer_script')
<script type="text/javascript">	
$(document).on('click', '#del_sanksi', function(e){
		e.preventDefault();
		if(e.which===1){
			if(confirm('Anda yakin ingin menghapus sanksi?')){
				$.ajax({
					headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					dataType: 'html',
					url		: '/proses/layanan/sanksi',
					data 	: 'q=buka&data=' + $(this).attr('data-id'),
					success	: function(data){
						if(data.length > 0){
							alert('Data berhasil diterima');
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						alert(xhr.responseText);
					}
				});
			}
		}
	});
	</script>

<script type="text/javascript">
	$(document).on('click', '.bt_export_pdf', function(e){
	e.preventDefault();
	if(e.which===1){

		$.ajax({
            cache: false,
            type: 'GET',
            url: '/petugas/report/create_pdf_sanksi',
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
