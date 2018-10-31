<div class="w3-container" style="padding: 0px; margin: 0px;">
	<div class="w3-animate-right">
		<div class="row">
			<div class="cell-12 text-center">
				<div class="img_profile_edit">
					<span class="mif-pencil"></span>
					<input type="file" id="ed_photo" hidden="hidden">
				</div>
			</div>
			{!! Form::open(['url' => route('mobile.store'),'method' => 'post']) !!}
			<div class="cell-12 text-center">
				<div class="row text-left">
					<div class="cell-12 w-100 input_container">
						<select name="ed_type" data-role="select" data-prepend="<span class='mif-train'></span>">
							<option @if(@$_user_profile->type==='0') selected @endif value="0">Belum dipilih</option>
							<option @if(@$_user_profile->type==='1') selected @endif value="1">Perorangan</option>
							<option @if(@$_user_profile->type==='2') selected @endif value="2">Perusahaan</option>
						</select>
					</div>
					<div class="cell-12 w-100 input_container">
						<input required name="ed_nama" value="{{ @$_user_profile->nama }}" type="text" data-role="input" data-clear-button="false" placeholder="Nama" data-prepend="<span class='mif-user'></span>">
					</div>

					<div class="cell-12 w-100 input_container">
						<input required name="ed_npwp" value="{{ @$_user_profile->npwp }}" type="text" data-role="input" data-clear-button="false" placeholder="NPWP" data-prepend="<span class='mif-qrcode'></span>">
					</div>

					<div class="cell-12 w-100 input_container">
						<textarea name="ed_alamat" placeholder="Alamat" data-clear-button="false" data-role="textarea" data-auto-size="false" data-max-height="200" data-prepend="<span class='mif-map2'></span>">{{ @$_user_profile->alamat }}</textarea>
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_phone" type="text" value="{{ @$_user_profile->no_telp }}" data-role="input" data-clear-button="false" placeholder="Telpon" data-prepend="<span class='mif-phone'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_fax" type="text" value="{{ @$_user_profile->no_fax }}" data-role="input" data-clear-button="false" placeholder="Fax" data-prepend="<span class='mif-phonelink'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_email" type="email" value="{{ @$_user_profile->email_1 }}" data-role="input" data-clear-button="false" placeholder="Email alternatif" data-prepend="<span class='mif-envelop'></span>">
					</div>
					<div class="cell-12 w-100 mt-5 text-center">
						<button type="submit" class="image-button primary">
							<span class="mif-floppy-disk icon"></span>
							<span class="caption">Update Profile</span>
						</button>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>