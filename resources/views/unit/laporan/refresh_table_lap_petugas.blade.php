							<div class="col-md-12">
									<table id="example1" class="table table-bordered table-striped table-responsive">
										<thead>
											<tr>
												<th width="450px">Loket</th>
												<th width="450px">Nama Petugas</th>
												<th width="100px">Lihat</th>
											</tr>
										</thead>
										<tbody>
											@foreach($_data as $data)
											<tr>
											<td>{{ strtoupper($data->nama_loket) }}</td>
											<td>{{ $data->nama_petugas }}</td>
											<td><button style="background-color:#17A2B8;color:white;" class="btn btn-sm modal-list" data-petugas="{{$data->petugas}}" ><i class="nav-icon fa fa-eye"></i> Pelayanan</button></td>
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