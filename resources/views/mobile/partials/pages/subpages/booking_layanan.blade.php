<div class="w3-container" style="padding: 0px; margin: 0px;">
	<div class="w3-animate-right">
		<div class="layanan_container_1">
			<div class="layanan_label bg-darkCobalt">
				<div id="search_layanan_container" style="display: block; width: 100%;">
					<label class="fg-white">
						<span data="booking" id="bt_back" style="margin: 0px 10px; font-weight: bold" class="mif-home fg-yellow"></span> Booking Antrian
					</label>
				</div>
			</div>
			<div class="isi_layanan">
				<div data="">
					<div class="form-group">
						<label>Nama Loket</label>
						<input type="text" value="{{ $_data->kode }}" readonly="true">
					</div>
					<div class="form-group">
						<label>Nama Layanan</label>
						<input type="text" value="{{ $_data->nama_layanan }}" readonly="true">
					</div>
					@if($jenis==='sub_layanan')
					<div class="form-group">
						<label>Nama Sub Layanan</label>
						<input type="text" value="{{ $_data->nama_sublayanan}}" readonly="true">
					</div>
					@endif
					<div class="form-group">
						<label>Tanggal Booking Antrian</label>
						<input id="ed_tanggal" class="booking_tanggal" data-role="datepicker">
					</div>
					<div class="form-group">
						<button id="btn_ambil_antrian" rowid="{{ $rowid }}" jenis="{{ $jenis }}" class="button success w-100">Ambil Antrian</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
