<div class="w3-container" style="padding: 0px; margin: 0px;">
	<div class="w3-animate-right">
		<div class="grid">
			<div class="cell-12 bg-blue background-profile" style="background-image: url('/img/log/background-top.jpg');">
				<label>Update Profiles</label>
			</div>
			<div class="cell-12">
				<div class="img_profile">
					<span class="mif-camera"></span>
					<input type="file" id="ed_photo" hidden="hidden">
				</div>
			</div>
			{!! Form::open(['url' => route('mobile.store'),'method' => 'post']) !!}
			<div class="cell-12 text-center">
				<div class="row text-left profile_container">
					<div class="cell-12 w-100 input_container">
						<select name="ed_type" data-role="select" data-prepend="<span class='mif-train'></span>">
							<option selected value="1">Perorangan</option>
							<option value="0">Perusahaan</option>
						</select>
					</div>
					<div class="cell-12 w-100 input_container">
						<input required name="ed_nama" type="text" data-role="input" data-clear-button="false" placeholder="Nama" data-prepend="<span class='mif-user'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_npwp" type="text" data-role="input" data-clear-button="false" placeholder="NPWP" data-prepend="<span class='mif-qrcode'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<textarea name="ed_alamat" placeholder="Alamat" data-clear-button="false" data-role="textarea" data-auto-size="false" data-max-height="200" data-prepend="<span class='mif-map2'></span>"></textarea>
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_phone" type="text" data-role="input" data-clear-button="false" placeholder="Telpon" data-prepend="<span class='mif-phone'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_fax" type="text" data-role="input" data-clear-button="false" placeholder="Fax" data-prepend="<span class='mif-phonelink'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_email" type="email" data-role="input" data-clear-button="false" placeholder="Email alternatif" data-prepend="<span class='mif-envelop'></span>">
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