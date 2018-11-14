				<div class="col-md-12">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr style="border-bottom: 3px solid black !important;">
											<th width="90px">Tanggal</th>
											<th width="150px">Petugas</th>
											<th width="150px">Email</th>
											<th width="150px">Pengunjung</th>
											<th width="100px">No. Telp</th>
											<th>Pelayanan</th>
											<th width="100px">Survey</th>
										</tr>
									</thead>
									<tbody>
										<?php $_i=0; 
										$emosi = array("TIDAK SURVEY", "SANGAT PUAS", "PUAS", "TIDAK PUAS");
										?>
										@foreach($_data as $data)
											@if($_i % 2===0)
												<tr>
											@else
												<tr style="background-color: #dddddd">
											@endif
												<td align="center">{{ substr($data->tanggal,0,10) }}</td>
												<td>{{ $data->nama_petugas }}</td>
												<td>{{ $data->email }}</td>
												<td>{{ strtoupper($data->pelanggan) }}</td>
												<td>{{ strtoupper($data->no_telp) }}</td>
												<td>{{ strtoupper($data->nama_layanan) }}</td>
												<td>{{ strtoupper($emosi[$data->kepuasan]) }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>
									<tfoot>
									</tfoot>
								</table>
							</div>
	<script>
          $(function () {
            $("#example1").DataTable();
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