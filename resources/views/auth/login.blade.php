<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Antrian BPOM | Login Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{asset('frontend/plugin/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
	<link href="{{asset('frontend/plugin/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('frontend/plugin/font-awesome/5.0/css/fontawesome-all.min.css')}}" rel="stylesheet" />
	<link href="{{asset('frontend/plugin/animate/animate.min.css')}}" rel="stylesheet" />
	<link href="{{asset('frontend/plugin/transparent/style.min.css')}}" rel="stylesheet" />
	<link href="{{asset('frontend/plugin/transparent/style-responsive.min.css')}}" rel="stylesheet" />
	<link href="{{asset('frontend/plugin/transparent/theme/default.css')}}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('frontend/plugin/pace/pace.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image" style="background-image: url({{asset('img/log/bg-log.jpg')}})" data-id="login-cover-image"></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <img src=" {{asset('img/log/logo-bpom.png')}} " width="100px" height="50px"/> <h1 tyle="font-size:8vw;">Antrian BPOM</h1>
                    {{-- <small>Sistem Antrian Berbasis Web</small> --}}
                </div>
                <span class="icon">
                    <i class="fa fa-lock"></i>
				</span>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
				<form action="{{ route('login') }}" method="POST" class="margin-bottom-0">
					@csrf
                    <div class="form-group m-b-20">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Masukan Email" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukan Password" required />
                    </div>
          
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Masuk</button>
                    </div>
                    <div class="m-t-20">
                        Belum Punya Akun ? Daftar <a href="{{ route('register') }}">disini</a>.
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('frontend/plugin/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>

	<script src="{{asset('frontend/plugin/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/js-cookie/js.cookie.js')}}"></script>
	<script src="{{asset('frontend/plugin/theme/transparent.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/js/apps.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{asset('frontend/plugin/demo/login-v2.demo.min.js')}}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
</body>
</html>
