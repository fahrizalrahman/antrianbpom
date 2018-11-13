
<div class="col-md-12">
<table id="example1" width="100%" class="table table-stripedtable-responsive">
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