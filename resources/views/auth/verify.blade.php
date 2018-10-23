@extends('layouts.app_metro')

@section('header_style_script')
	{{ Html::style('/plugins/metro/metro/css/metro-all.css') }}
	{{ Html::style('/custom/css/w3.css') }}
	{{ Html::style('/custom/css/mobile.css') }}
	{{ Html::script('/plugins/metro/js/jquery-3.3.1.min.js') }}
@endsection

@section('body')
<div style="width: 100%; height: 50%; display: block;">
<div class="w3-container">
    <div class="w3-animate-right">
        <div class="flex-center position-ref p-5">
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ url('/logo/logo-kecil.png') }}">
                    <p style="color: rgb(0,0,128); font-weight: bold;">Sistem Antrian Online<br />Badan POM</p>
                </div>
                <div>
                	<p>Terima kasih telah melakukan registrasi di Sistem Antrian Online Badan POM. Kami telah mengirimkan email verifikasi ke alamat email anda.</p>
                    <p>Sebelum melakukan verifikasi, maka anda tidak bisa melanjutkan ke dalam aplikasi Sistem Antrian Online Badan POM.</p>
                	<p>Jika anda tidak menerima email tersebut, <a class="button success" href="{{ route('verification.resend') }}"> klick di sini</a> untuk mengirim ulang email verivikasi.<p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('footer_style_script')
	{{ Html::script('/plugins/metro/metro/js/metro.js') }}
@endsection