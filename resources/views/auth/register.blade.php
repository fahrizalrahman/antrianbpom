<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Antrian BPOM | Register Page</title>
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
<body class="pace-top bg-black-darker">
	
<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin register -->
    <div class="register register-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url({{asset('img/register.jpg')}})" data-id="login-cover-image"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>Sistem Antrian BPOM</b>

            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin register-header -->
            <h1 class="register-header">
                <center><img src="{{asset('img/log/bpom.png')}}" width="100px" height="100px"/></center>
            </h1>
            <!-- end register-header -->
            <!-- begin register-content -->
            <div class="register-content">
                <form action=" {{route('register')}} " file="true" method="POST" class="margin-bottom-0">
                    @csrf
                    <label class="control-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="name" name="name" value="{{ old('name')}}" class="form-control" placeholder="Masukan Nama" required />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <label class="control-label">Email <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="email" id="email" name="email" value=" {{old('email')}} " class="form-control" placeholder="Masukan Email" required />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <label class="control-label">Password <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password" required />
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <label class="control-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                    </div>
            
                    <div class="register-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
                    </div>
                    <div class="m-t-20 m-b-40 p-b-40">
                        Sudah Punya Akun ? Login <a href=" {{route('login')}} ">disini</a>.
                    </div>
                    <h4 style="text-align:center;">Badan Pengawas Obat dan Makanan</h4 style="text-align:center;">
                    <hr />
                    <p class="text-center">
                        &copy;  2018
                    </p>
                </form>
            </div>
            <!-- end register-content -->
        </div>
        <!-- end right-content -->
    </div>
    <!-- end register -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('frontend/plugin/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/bootstrap/4.0.0/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/js-cookie/js.cookie.js')}}"></script>
	<script src="{{asset('frontend/plugin/theme/transparent.min.js')}}"></script>
	<script src="{{asset('frontend/plugin/js/apps.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
