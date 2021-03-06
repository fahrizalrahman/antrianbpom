<div class="w3-container" style="padding: 0px; margin: 0px;">
	<div class="w3-animate-right">
		<div class="bg-white w-100 p-1" style="border-bottom: 2px solid darkBlue; height: 45px">
			<img src="{{ url('/logo/logo-kecil.png') }}" style="height: 30px; margin: 0px 10px;">
			<label class="fg-black" style="font-size:14pt;"><strong>Sistem Antrian BPOM</strong></label>
			<div class="drop-group">
				<button class="button square dropdown-toggle bg-darkCobalt">
					<span class="mif-menu fg-white"></span>
				</button>
				<ul class="d-menu place-right context bg-darkCobalt fg-white" data-role="dropdown" style="box-shadow: 1px 1px 3px black;">
					<li>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
					</li>
				</ul>
			</div>
		</div>
		<div class="layanan_container">
			<div class="isi_layanan_1">
				@foreach($_data as $data)
				<div class="box_monitor bg-white">
					<div class="header">
						<div style="display: block;">
						<div class="lb_nama_layanan">
							<label>{{ $data->nama_layanan }}</label><br />
							@if($data->nama_sub_layanan!=='-')
							<label>{{ $data->nama_sub_layanan }}</label>
							@endif
						</div>
						<div class="lb_lantai">
							<label>Lantai {{ $data->lantai }}</label>
							@if($data->nama_loket_sub_layanan==='-')
								<label>{{ $data->nama_loket }}</label>
							@else
								<label>{{ $data->nama_loket_sub_layanan }}</label>
							@endif
						</div>
						</div>
						<div class="text-center w-100" style="border-bottom: 1px solid #aaaaaa; padding: 15px 0px 5px 0px; font-size: 10pt;">{{ \App\helper\Tanggal::konversi($data->tgl_antrian, '%A, %d %B %G') }}</div>
						<div class="lb_footer">
							<div style="width: calc(100% - 210px)">
								<label>Antrian</label>
								<footer>{{ $data->no_antrian }}</footer>
							</div>
							<?php
							$mulai = new DateTime($data->mulai);
							$selesai = new DateTime($data->selesai);

							$dteDiff  = $mulai->diff($selesai);
							$survey = array('TIDAK SURVEY','SANGAT PUAS', 'PUAS', 'TIDAK PUAS');
							?>
							<div style="text-align: left; width: 200px;">
								<div style="font-size: 10pt; font-family: arial;">
								<label style="text-decoration: underline; font-weight: bold;">Keterangan</label><br />
								<label>Lama Proses : {{ $dteDiff->format("%H:%I:%S") }}</label><br />
								<label>Hasil Survey : {{ $survey[$data->kepuasan] }}</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach

				@foreach($_data_batal as $data_batal)
				<div class="box_monitor bg-white">
					<div class="header">
						<div style="display: block;">
						<div class="lb_nama_layanan">
							<label>{{ $data_batal->nama_layanan }}</label><br />
							@if($data_batal->nama_sub_layanan!=='-')
							<label>{{ $data_batal->nama_sub_layanan }}</label>
							@endif
						</div>
						<div class="lb_lantai">
							<label>Lantai {{ $data_batal->lantai }}</label>
							@if($data_batal->nama_loket_sub_layanan==='-')
								<label>{{ $data_batal->nama_loket }}</label>
							@else
								<label>{{ $data_batal->nama_loket_sub_layanan }}</label>
							@endif
						</div>
						</div>
						<div class="text-center w-100" style="border-bottom: 1px solid #aaaaaa; padding: 15px 0px 5px 0px; font-size: 10pt;">{{ \App\helper\Tanggal::konversi($data_batal->tgl_antrian, '%A, %d %B %G') }}</div>
						<div class="lb_footer">
							<div style="width: calc(100% - 210px)">
								<label>Antrian</label>
								<footer>{{ $data_batal->no_antrian }}</footer>
							</div>

							<div style="text-align: right; width: 200px;">
								
								<div style="font-size: 15pt;">
								Proses : <label style="color:red;"><b> {{ strtoupper($data_batal->status) }}</b></label><br />
								
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>
</div>

