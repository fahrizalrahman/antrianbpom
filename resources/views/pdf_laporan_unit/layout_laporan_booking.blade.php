<!DOCTYPE html>
<html>
<head>
	<title>Laporan Booking Per Unit</title>

</head>
<body style="font-family: Arial, Helvetica, sans-serif;font-size:15px;">
<img src="{{ asset('logo/bpom.png') }}" style="height:35px;">

<center><h3>LAPORAN BOOKING PER UNIT</h3></center>
<hr>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Unit</b> : {{$unit}}</p>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Petugas</b> : @if($petugas == "all") 
Semua 
@else{{$nama_petugas}}
@endif</p>
<hr>
						<table class="table table-bordered">
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Nama Pengunjung</th>
											<th>No Antrian</th>
											<th>Layanan</th>
											<th>Loket</th>
											<th>Sub Layanan</th>
											<th>Loket Sub</th>
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
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>
								</table>
				</body>
				</html>