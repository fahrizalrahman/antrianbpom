<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengunjung</title>

</head>
<body style="font-family: Arial, Helvetica, sans-serif;font-size:15px;">
<img src="{{ asset('logo/bpom.png') }}" style="height:35px;">

<center><h3>LAPORAN SURVEY PENGUNJUNG</h3></center>
<hr>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Periode</b> : {{$ed_mulai}} sd {{$ed_sampai}}</p>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Petugas</b> : {{$petugas}}</p>
<hr>
								<table class="table table-border">
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Nama </th>
											<th>No. Telp</th>
											<th>Pelayanan</th>
											<th>Loket</th>
											<th>Sub Layanan</th>
											<th>Loket Sub</th>
											<th>Survey</th>
										</tr>
									</thead>
									<tbody id="tbody_pengunjung">
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
												<td>{{ $data->nama_pelanggan }}</td>
												<td>{{ $data->no_telp }}</td>
												<td>{{ $data->nama_layanan }}</td>
												<td>{{ $data->nama_loket }}</td>									
												<td>{{ $data->sub_layanan }}</td>
												<td>{{ $data->nama_loket_sub }}</td>
												<td>{{ $emosi[$data->kepuasan] }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
								</tbody>
							</table>
							</center>
					</div>
			</div>
</body>
</html>