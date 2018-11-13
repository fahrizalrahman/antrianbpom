<!DOCTYPE html>
<html>
<head>
	<title>Laporan Petugas</title>

</head>
<body style="font-family: Arial, Helvetica, sans-serif;font-size:15px;">
<img src="{{ asset('logo/bpom.png') }}" style="height:35px;">

<center><h3>LAPORAN DAFTAR PETUGAS</h3></center>
<hr>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Periode</b> : {{$ed_mulai}} sd {{$ed_sampai}}</p>
<p style="margin-top:-2px;margin-bottom:-2px;"><b>Petugas</b> : @if($petugas == "all") 
Semua 
@else{{$nama_petugas->name}}
@endif</p>
<hr>
								<table class="table table-border">
									<thead>
										<tr>
											<th> Tanggal</th>
											<th> Pelanggan</th>
											<th> Layanan</th>
											<th> Sub Layanan</th>
											<th> Kepuasan</th>
											<th> Durasi</th>
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
												<td>{{ $value->pelanggan }}</td>
												<td>{{ $value->nama_layanan }}</td>
												<td>{{ $value->sub_layanan }}</td>
												<td>{{ strtoupper($emosi[$value->kepuasan]) }}</td>
												<td>{{ $value->lama }}</td>
											</tr>
											<?php $_i++;?>
										@endforeach
									</tbody>
							</table>
				</body>
				</html>