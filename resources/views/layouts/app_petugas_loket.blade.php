<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

         <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
      <!-- jvectormap -->
      <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
      <!-- Date Picker -->
      <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
             
      <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css')}}">

{{ Html::script('/plugins/jquery/jquery.min.js') }}
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        <nav class="main-header navbar navbar-expand navbar-light border-bottom" style="background-color:#17A2B8">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" data-toggle="dropdown" style="color:white;">
                        <i class="nav-icon fa fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        <a class="dropdown-item">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                        <span class="float-right text-sm text-danger"></span>
                                    </h3>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <center><a href="/home" class="brand-link" style="background-color:#17A2B8">
                <img src="{{ asset('logo/logo-kecil.png') }}" style="height:50px;">
                </a>
            </center>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!--
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">
                                <i class="fa fa-tachometer nav-icon"></i><p>Dashboard</p>
                            </a>
                        </li>
                        -->
                        <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>Loket<i class="right fa fa-angle-right"></i></p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="/loket" class="nav-link">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>Sistem Antrian</p>
                              </a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item has-treeview">
                          <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-file-text-o"></i>
                            <p>Laporan<i class="right fa fa-angle-right"></i></p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="/laporan/daftar-pengunjung" class="nav-link">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>Daftar Pengunjung</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="/laporan/survey-pengunjung" class="nav-link">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>Survey Pengunjung</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="/laporan/presensi-petugas" class="nav-link">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>Presensi Petugas</p>
                              </a>
                            </li>
                          </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        @yield('content')
    </div>

{{ Html::script('/plugins/jQueryUI/jquery-ui.min.js') }}
{{ Html::script('/plugins/bootstrap/js/bootstrap.min.js') }}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') }}
{{ Html::script('/plugins/morris/morris.min.js') }}
{{ Html::script('/plugins/sparkline/jquery.sparkline.min.js') }}
{{ Html::script('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}
{{ Html::script('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}
{{ Html::script('/plugins/knob/jquery.knob.js') }}
{{ Html::script('/plugins/bootstrap/js/bootstrap.min.js') }}
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js') }}
{{ Html::script('/plugins/daterangepicker/daterangepicker.js') }}
{{ Html::script('/plugins/datepicker/bootstrap-datepicker.js') }}
{{ Html::script('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}
{{ Html::script('/plugins/slimScroll/jquery.slimscroll.min.js') }}
{{ Html::script('/plugins/fastclick/fastclick.js') }}
{{ Html::script('/dist/js/adminlte.min.js') }}


@yield('footer_script')
</body>
</html>