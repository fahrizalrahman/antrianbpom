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
						<input required name="ed_nama" value="{{ @$_user_profile->nama }}" type="text" data-role="input" id="ed_name" data-clear-button="false" placeholder="Nama" data-prepend="<span class='mif-user'></span>">
					</div>

					<div class="cell-12 w-100 input_container">
						<input required name="ed_npwp" value="{{ @$_user_profile->npwp }}" id="ed_npwp" minlength="20" maxlength="20" type="text" data-role="input" data-clear-button="false" placeholder="NPWP" data-prepend="<span class='mif-qrcode'></span>">
					</div>

					<div class="cell-12 w-100 input_container">
						<textarea name="ed_alamat" placeholder="Alamat" data-clear-button="false" id="ed_alamat" data-role="textarea" data-auto-size="false" data-max-height="200" data-prepend="<span class='mif-map2'></span>">{{ @$_user_profile->alamat }}</textarea>
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_phone" type="text" value="{{ @$_user_profile->no_telp }}" id="ed_phone" data-role="input" data-clear-button="false" placeholder="Telpon" data-prepend="<span class='mif-phone'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_nik" type="text" value="{{ @$_user_profile->nik }}" id="ed_nik" minlength="16" maxlength="16" data-role="input" data-clear-button="false" placeholder="NIK" data-prepend="<span class='mif-phonelink'></span>">
					</div>
					<div class="cell-12 w-100 input_container">
						<input name="ed_email" type="email" value="{{ @$_user_profile->email_1 }}" id="ed_email" data-role="input" data-clear-button="false" placeholder="Email alternatif" data-prepend="<span class='mif-envelop'></span>">
					</div>
					<div class="cell-12 w-100 mt-5 text-center">
						<button type="submit" class="image-button primary">
							<span class="mif-floppy-disk icon"></span>
							<span class="caption" id="update">Update Profile</span>
						</button>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
			
		</div>
	</div>
</div>
	{{ Html::script('/js/sweetalert2.all.min.js') }}
<script type="text/javascript">
	$(document).on('blur', '#ed_npwp', function(e){
	var ed_npwp = $(this).val();
				$.get('{{ Url("cek_npwp_over") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_npwp:ed_npwp}, function(resp){  
           					if (resp == 0) {
								swal({
				                 html: "NPWP <br><b>("+ed_npwp+")</b></br> sudah digunakan 3 kali!!"
				             	});
				             	$('#ed_npwp').val('');
							}
         		 });
});
</script>
