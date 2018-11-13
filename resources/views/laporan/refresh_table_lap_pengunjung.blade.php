					<div class="row">
						<div class="col-md-1" style="padding-left:20px;">
							<button class="btn btn-danger bt_export_pdf">Download <span class="fa fa-file-pdf-o"></span></button>
						</div>
					</div> <br>
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

	@section('footer_script')
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