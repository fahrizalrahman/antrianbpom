<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pengunjung Per Unit</title>

</head>
<body style="font-family: Arial, Helvetica, sans-serif;font-size:15px;">
<img src="{{ asset('logo/bpom.png') }}" style="height:35px;">

<center><h3>LAPORAN DAFTAR PENGUNJUNG PER UNIT</h3></center>
<hr>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Periode</b> : {{$ed_mulai}} sd {{$ed_sampai}}</p>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Unit</b> : {{$unit}}</p>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Petugas</b> : @if($petugas == "all") 
Semua 
@else{{$nama_petugas}}
@endif</p>
<hr>
								<table class="table table-border">
									<thead>
										<tr>
											<th> Tanggal</th>
											<th> Loket</th>
											<th> Layanan</th>
											<th> Sub Layanan</th>
											<th> Petugas</th>
											<th> Kepuasan</th>
										</tr>
									</thead>
									<tbody id="tbody_pengunjung">
												<?php $_i=0; 
												 $emosi = array("TIDAK SURVEY", "SANGAT PUAS", "PUAS", "TIDAK PUAS");
												 ?>
												 @foreach ($_data as $value)
                  								 @if ($_i % 2===0)
														<tr>
													@else
														<tr style="background-color: #dddddd">
													@endif
												<td>{{ $value->tanggal }}</td>
												<td>{{ $value->nama_loket }}</td>
												<td>{{ $value->nama_layanan }}</td>
												<td>{{ $value->sub_layanan }}</td>
												<td>{{ $value->nama_petugas }}</td>
												<td>{{ strtoupper($emosi[$value->kepuasan]) }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>
							</table>
				</body>
				</html>