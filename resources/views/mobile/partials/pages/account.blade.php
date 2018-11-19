<div class="w3-container" style="padding: 0px; margin: 0px;">
	<div class="w3-animate-right">
		<div class="grid">
			<div class="cell-12 bg-blue background-profile" style="background-image: url('/img/log/background-top.jpg');">
				<label>User Profiles</label>
				<div class="drop-group">
				<button class="button square dropdown-toggle">
					<span class="mif-menu fg-white"></span>
				</button>
				<ul class="d-menu place-right context bg-darkCobalt fg-white" data-role="dropdown" style="box-shadow: 1px 1px 3px black; background-color: rgba(255,255,255,0.5)">
					<li>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
					</li>
				</ul>
				</div>
			</div>
			<div class="cell-12">
				@if(@$profile->foto == null)
				<div class="img_profile" style="background-image: url('/img/default-avatar.jpg')">
				@else
				<div class="img_profile" style="background-image: url('{{ url("/foto-profile/".@$profile->foto."") }}');">
				@endif
				</div>
			</div>
			<div class="cell-12 text-center" style="margin-top: 50px;">
				<label class="profile_nama">{{ Auth()->user()->name }}</label>
				<div class="row text-left profile_container" style="padding: 0px 10px">
					<div class="cell-12 w-100 input_container" style="border-bottom: 1px solid #aaaaaa">
						<label class="profile_sub_title"><span class="mif-train"></span>@if($profile->type === '1')
							Perorangan
						@elseif($profile->type === '2')
							Perusahaan
						@endif
						 </label>
					</div>
					<div class="cell-12 w-100 input_container" style="border-bottom: 1px solid #aaaaaa">
						<label class="profile_sub_title"><span class="mif-user"></span> {{ @$profile->nama }}</label>
					</div>
					<div class="cell-12 w-100 input_container" style="border-bottom: 1px solid #aaaaaa">
						<label class="profile_sub_title"><span class="mif-qrcode"></span> {{ @$profile->npwp }}</label>
					</div>
					<div class="cell-12 w-100 input_container" style="border-bottom: 1px solid #aaaaaa">
						<p class="profile_sub_title"><span class="mif-pin"></span>{{ @$profile->alamat }}</p>
					</div>
					<div class="cell-12 w-100 input_container" style="border-bottom: 1px solid #aaaaaa">
						<label class="profile_sub_title"><span class="mif-phone"></span> {{ @$profile->no_telp }}</label>
					</div>
					<div class="cell-12 w-100 input_container" style="border-bottom: 1px solid #aaaaaa">
						<label class="profile_sub_title"><span class="mif-phonelink"></span> {{ @$profile->nik }}</label>
					</div>
					<div class="cell-12 w-100 input_container" style="border-bottom: 1px solid #aaaaaa">
						<label class="profile_sub_title"><span class="mif-envelop"></span> {{ @$profile->email_1 }}</label>
					</div>
					<div class="cell-12 w-100 mt-5 text-center">
						<button id="bt_edit_profile" class="button primary"><span class="mif-pencil"></span> Edit Profile</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>