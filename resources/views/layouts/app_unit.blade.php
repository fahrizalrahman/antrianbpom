<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Antrian BPOM') }}</title>

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

                <li><a class="nav-link" href="#" style="color: white; font-size: 13pt;"><strong>Sistem Antrian BPOM</strong></a></li>
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
                <img src="{{ asset('logo/logo-kecil.png') }}" style="height:35px;">
                </a>
            </center>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('unit.index') }}" class="nav-link">
                                <i class="fa fa-tachometer nav-icon"></i><p>Dashboard</p>
                            </a>
                        </li>
                   
        
                        <li class="nav-item">
                            <a href=" {{route('unit.petugas')}}" class="nav-link">
                                <i class="fa fa-user nav-icon"></i><p>Petugas</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                              <i class="nav-icon fa fa-image"></i>
                              <p>
                                Tambah Gambar
                                <i class="right fa fa-angle-left"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{route('inputImg.index')}}" class="nav-link">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p> Gambar Utama</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{route('inputImgSid.index')}} " class="nav-link">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>Gambar Sidebar</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{route('inputImgFoot.index')}}" class="nav-link">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>Gambar Footer</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{route('imgHome.view')}}" class="nav-link">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>Gambar Mainbar</p>
                                  </a>
                                </li>
                              <li class="nav-item">
                                <a href="{{route('bgunit.index')}}" class="nav-link">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>Gambar Background</p>
                                </a>
                              </li>
                            </ul>
                          </li>
                     </li>
                     <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-pencil"></i>
                          <p>
                            Tambah Text
                            <i class="right fa fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{ route('inputTulisan.index') }}" class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p> Running Text</p>
                            </a>
                          </li> 
                          <li class="nav-item">
                            <a href="{{route('tampil.tulisan')}} " class="nav-link">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>Home Text</p>
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
                              <a href="{{ url('/unit-laporan-pengunjung') }}" class="nav-link">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p> Pengunjung</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{ url('/unit-survey-pengunjung') }}" class="nav-link">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                <p>Survey Pengunjung</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{ url('/unit-laporan-petugas') }}" class="nav-link">
                                {{-- <a href="" class="nav-link"> --}}
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
    <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="{{ asset('plugins/morris/morris.min.js')}}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- jvectormap -->
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('plugins/knob/jquery.knob.js')}}"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <!-- datepicker -->
        <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <!-- Slimscroll -->
        <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('plugins/chartjs-old/Chart.min.js')}}"></script>
        <script src="{{ asset('dist/js/adminlte.js')}}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('dist/js/demo.js')}}"></script>
        <!-- DataTables -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js')}}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('plugins/datatables/pdfmake.min.js')}}"></script>
        <script src="{{ asset('plugins/datatables/vfs_fonts.js')}}"></script>
        <script src="{{ asset('plugins/datatables/buttons.html5.min.js')}}"></script>

        <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>



<script>
    $(function () {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>

@yield('footer_script')
</body>
</html>