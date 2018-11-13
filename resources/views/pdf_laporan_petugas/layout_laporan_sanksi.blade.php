<!DOCTYPE html>
<html>
<head>
	<title>Laporan Daftar Sanksi</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;font-size:15px;">
<img src="{{ asset('logo/bpom.png') }}" style="height:35px;">

<center><h3>LAPORAN DAFTAR SANKSI</h3></center>
<hr>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Petugas</b> : {{$petugas}}</p>
<hr>
						<table class="table table-border">
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Email</th>
											<th>Nama</th>
											<th>No. Telp</th>
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
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>

								</table>
								</body>
</html>