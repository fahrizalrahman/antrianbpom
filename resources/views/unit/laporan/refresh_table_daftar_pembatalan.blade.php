					<div class="col-md-12">
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
									<tbody id="tbody_pengunjung">
										<?php $_i=0; ?>
										@foreach($_data as $data)
											@if($_i % 2===0)
												<tr>
											@else
												<tr style="background-color: #dddddd">
											@endif
												<td align="center">{{ substr($data->tanggal,0,10) }}</td>
												<td>{{ $data->nama_pelanggan }}</td>
												<td>{{ $data->no_antrian }}</td>
												<td>{{ $data->nama_layanan }}</td>
												<td>{{ $data->nama_loket }}</td>
												<td>{{ $data->sub_layanan }}</td>
												<td>{{ $data->nama_loket_sub }}</td>
												<td>{{ $data->keterangan_batal }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>
								</table>
							</div>

<script>
          $(function () {
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