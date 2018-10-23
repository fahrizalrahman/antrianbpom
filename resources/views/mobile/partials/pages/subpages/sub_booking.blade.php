<div class="w3-container" style="padding: 0px; margin: 0px;">
	<div class="w3-animate-right">
		<div class="layanan_container_1">
			<div class="layanan_label bg-darkCobalt">
				<div id="search_layanan_container" style="display: block; width: 100%;">
					<label class="fg-white">
						<span data="booking" id="bt_back" style="margin: 0px 10px; font-weight: bold" class="mif-chevron-thin-left fg-yellow"></span> {{ $layanan->keterangan }}
					</label>
				</div>
			</div>
			<div class="isi_layanan">
				@foreach($loket as $_loket)
					<div id="{{ $_loket->id }}" data="{{ $_loket->sub_layanan }}" jenis="{{ $jenis }}" class="booking_layanan">
					<label>{{ $_loket->kode }}</label>
					<span class="mif-folder-open fg-darkYellow"></span>
					<footer>{{ strtoupper($_loket->nama_layanan) }}</footer>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>