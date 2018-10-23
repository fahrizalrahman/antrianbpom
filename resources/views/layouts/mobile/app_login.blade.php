<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Antrian Online BPOM') }}</title>
    {{ Html::style('/plugins/metro/metro/css/metro-all.min.css') }}
    {{ Html::script('/js/jquery-3.1.0.min.js') }}
    {{ Html::script('/plugins/metro/metro/js/metro.js') }}
    <style type="text/css">
    body{
        height: 100%;
        width: 100%;
        padding: 0px;
        margin: 0px;
        background-image: url('/img/log/bg-log.jpg');
        background-repeat: no-repeat;
        background-position: center;
    }
    </style>
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
