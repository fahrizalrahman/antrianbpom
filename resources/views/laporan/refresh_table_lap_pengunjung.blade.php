							<div class="col-md-12">
									<table id="example1" class="table table-bordered table-striped table-responsive">
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

<script type="text/javascript">
      $(document).ready(function() {
            $("#example1").DataTable({
              dom: 'Bfrtip',
              buttons: ['copy', 
                {
                  extend: 'pdfHtml5',
                  title: $('.judul').html(),
                  orientation: 'landscape',
                  pageSize: 'A4',
                  pageMargins: [ 0, 0, 0, 0 ],
                  margin: [ 0, 0, 0, 0 ],
                  text: 'Export PDF',
                }
              ]
            });
          });
</script>

<style type="text/css">
table.dataTable thead tr {
  padding: 0px;
  margin: 0px;
  color: white;
  background-color: green;
}

</style>