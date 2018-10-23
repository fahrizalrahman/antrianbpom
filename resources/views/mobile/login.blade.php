@extends('layouts.mobile.app_login')

@section('content')
	<div class="page_over">
		<div class="grid">
			<div class="row">
				<div class="cell-12" style="text-align: center;">
					<img class="logo" src="{{ asset('/img/log/logo-bpom.png') }}">
				</div>
			</div>
			<div class="row">
				<div class="cell-12 p-8 ">
					<div style="border: 1px solid #cccccc;">

						<div class="row bg-gray" style="height: 40px; width: 100%; margin-left: 0px;">
							<div class="bt_login cell-6 p-2 bg-white">Login</div>
							<div class="bt_register cell-6 p-2">Register</div>
						</div>
						<div id="content_login">
							<form action="{{ route('login') }}" method="POST">
							@csrf
							<div class="p-5" style="background-color: rgba(255,255,255,0.5);">
								<div class="form-group">
									<input type="email" required name="email" data-role="input" data-prepend="<span class='mif-envelop'>" placeholder="Alamat Email" data-validate="required email">
								</div>
								<div class="form-group">
									<input type="password" required name="password" data-role="input" data-prepend="<span class='mif-key'>" placeholder="Password" data-validate="required minlength=6" data-clear-button="false">
								</div>
								<div class="form-group mt-2">
									<input type="checkbox" data-role="checkbox" data-caption="Pengingat Password">
								</div>
								<div class="form-group mt-8">
									<button class="button primary w-100">Login</button>
								</div>
								<div class="form-group mt-2">
									<a href="{{ route('password.request') }}" style="font-size: 10pt;">Lupa Password</a>
								</div>
							</div>
							<div class="w-100 bg-gray fg-white" style="text-align: center;">
								<label style="font-size: 9pt;">&copy Copyright Badan POM RI - 2018</label>
							</div>
							</form>
						</div>

						<div id="content_register" style="display: none">

							<form method="post" action="{{ route('register') }}">
							@csrf
							<div class="p-5" style="background-color: rgba(255,255,255,0.5);">

								<div class="form-group">
									<input name="name" type="text" data-role="input" data-prepend="<span class='mif-user'>" placeholder="Nama Lengkap" data-validate="required">
								</div>
								<div class="form-group">
									<input name="email" type="email" data-role="input" data-prepend="<span class='mif-envelop'>" placeholder="Alamat Email" data-validate="required email">
								</div>
								<div class="form-group">
									<input name="password" type="password" data-role="input" data-prepend="<span class='mif-key'>" placeholder="Password" data-validate="required minlength=6" data-clear-button="false">
								</div>
								<div class="form-group">
									<input name="password_confirmation" type="password" data-role="input" data-prepend="<span class='mif-key'>" placeholder="Ulangi Password" data-validate="required minlength=6" data-clear-button="false">
								</div>
								<div class="form-group mt-2">
									<input type="checkbox" data-role="checkbox" data-caption="Menyetujui semua peraturan">
								</div>
								<div class="form-group mt-8">
									<button type="submit" class="button success w-100">Register</button>
								</div>
							</div>
							</form>

							<div class="w-100 bg-gray fg-white" style="text-align: center;">
								<label style="font-size: 9pt;">&copy Copyright Badan POM RI - 2018</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection