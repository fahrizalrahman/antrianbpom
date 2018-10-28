<div class="w3-container" style="padding: 0px; margin: 0px;">
	<div class="w3-animate-right">
		<div class="bg-white w-100 p-1" style="border-bottom: 2px solid darkBlue; height: 45px">
			<img src="{{ url('/logo/logo-kecil.png') }}" style="height: 30px; margin: 0px 10px;">
			<label class="fg-black"><strong>Sistem Antrian BPOM</strong></label>
			<div class="drop-group">
				<button class="button square dropdown-toggle bg-darkCobalt">
					<span class="mif-menu fg-white"></span>
				</button>
				<ul class="d-menu place-right context bg-darkCobalt fg-white" data-role="dropdown" style="box-shadow: 1px 1px 3px black;">
					<li>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><strong>
							{{ __('Logout') }}</strong>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
					</li>
				</ul>
			</div>
		</div>
		<div class="image_slider_container">
			<div class="image_slider" style="background-image: url('{{ url("/img/slider/001.png") }}');"></div>
		</div>
		<div class="layanan_container">
			<div class="isi_layanan">
				@foreach($judulLayanan as $_judulLayanan)
				<div id="{{ $_judulLayanan->id }}" class="box_layanan">
					<label>Lantai {{ $_judulLayanan->id }}</label>
					<span class="mif-library fg-green"></span>
					<footer>{{ strtoupper($_judulLayanan->keterangan) }}</footer>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>