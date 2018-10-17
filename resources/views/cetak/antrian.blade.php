<!DOCTYPE doctype html>
<html lang="en">
<head>
	<!-- Bootstrap core CSS     -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
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
          <link rel="stylesheet" href=" {{asset('css/file.css')}} ">
       
      <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap4.css')}}">
</head>
<style type="text/css">

p{
	margin-top: 1px; margin-bottom: 1px;
}
.marginProduk{
	margin-top: 1px; margin-bottom: 1px;
	padding-left: 3px; padding-right: 3px;
}

</style>
<body style="font-size:13px">

	<div class="row">
		<div class="col-md-3">
      <img src="{{ asset('logo/bpom.png') }}" style="height:35px;margin-left:60px">
			<p>--------------------------------------------------------</p>
			<p>Jalan Percetakan Negara Nomor 23 <br> Jakarta - 10560 - Indonesia </p>
			<p>--------------------------------------------------------</p>
      <p style="margin-left:20px">Nomor Antrian Anda</p>
        <h1 style="margin-left:50px">{{ $data_loket->kode_antrian }}{{$data_antri->no_antrian}}</h1>
      <p>--------------------------------------------------------</p>
      <p> Loket  : {{ $data_loket->kode }} </p>
      <p> Lantai : {{ $data_loket->lantai }}</p>

      <i><b>{{ $data_loket->nama_layanan }}</b></i>
      <p>--------------------------------------------------------</p>
      <p>{{$data_antri->created_at}}</p>
      <p>Terima Kasih Atas Kunjungan Anda</p>
      <p>No. Telp : +6221 4244691</p> 
		</div>
	</div>
			

</body>
<!--   Core JS Files   -->
</html>

    <!-- jQuery -->
        <script src="{{ asset('js/jquery.min.js')}}"></script>
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
        <script src="/highchart/js/highcharts.js"></script>
        <script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript">
    </script>

<script>
  $( document ).ready(function() {
		window.print();
	  });
</script>
