 <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="referrer" content="origin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Antrian Badan Pengawasan Obat dan Makanan</title>
    @yield('header_style_script')
</head>
<body>
	@yield('body')
	@yield('footer_style_script')
</body>
</html>