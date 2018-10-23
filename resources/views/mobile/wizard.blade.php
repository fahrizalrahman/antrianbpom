@extends('layouts.app_metro')

@section('header_style_script')
	{{ Html::style('/plugins/metro/metro/css/metro-all.css') }}
	{{ Html::style('/custom/css/w3.css') }}
	{{ Html::style('/custom/css/mobile.css') }}
	{{ Html::script('/plugins/metro/js/jquery-3.3.1.min.js') }}
@endsection

@section('body')
	@include('mobile.partials.wizard.index')
@endsection

@section('footer_style_script')
	{{ Html::script('/plugins/metro/metro/js/metro.js') }}
	{{ Html::script('/custom/js/mobile.js') }}
@endsection