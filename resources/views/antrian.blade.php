<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href=" {{asset('css/file.css')}} ">
    <script src="{{asset ('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <title>Display Antrian Utama</title>
</head>
<body class="container-fluid" style="background-image:url({{('img/log/bg-log.jpg')}})">
    <div class="container">

        <div class="row" style="margin-top:20px;">
            <div class="col-sm-12" style="height:70px; background-color:darkgrey;">
                <img src="{{asset('img/log/logo_bpom.png')}}" style="margin-top:7px;" width="100px" height="55px" >
                <span style="float:right; width:180px; height:30px; background-color:green; margin-right:-15px; text-align:center;"> 01/Oktober/2018 | 20:10 </span>
            </div>
            <div class="col-md-12" style="background-image:url({{asset('img/come.jpg')}}); width:auto; height:auto;">
            </div>
            <div class="col-md-12" style="background-color:green; height:30px;">
                <p><marquee>Badan Pengawas Obat dan Makanan, Jalan Percetakan Negara Nomor 23 Jakarta - 10560 - Indonesia </marquee></p>
            </div>

            <div class="col-md-12" style="width:100%; height:600px; background-image:url( {{asset('img/come.jpg')}} ); background-size:cover; background-position:center; background-repeat:no-repeat;">
                <div class="container">	
                <section class="main" style="margin-top:20px;">		
                    <ul class="ch-grid">
                        <li>
                            <div class="ch-item">				
                                <div class="ch-info" id="flip-1" >
                                    <div class="ch-info-front ch-front-1"><h4 style="margin-top:50px;">LANTAI <br>  1</h4></div>
                                    <div class="ch-info-back">
                                        @if($layanan_loket->count() > 0)
                                        @foreach($layanan_loket->get() as $value)
                                        <h3>{{$value->nama_layanan}}</h3> 
                                        @endforeach
                                        @endif
                                    </div>	
                                </div>
                            </div>
                        </li>
                        
                        <li>
                            <div class="ch-item">
                                <div class="ch-info" id="flip-2">
                                    <div class="ch-info-front ch-front-2"><h4 style="margin-top:50px;">LANTAI <br> 2</h4></div>
                                    <div class="ch-info-back">
                                        @if($layanan_loket_2->count() > 0)
                                        @foreach($layanan_loket_2->get() as $value)
                                        <h3>{{$value->nama_layanan}}</h3> 
                                        @endforeach
                                        @endif                                        
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <div class="ch-item">
                                <div class="ch-info" id="flip-3">
                                    <div class="ch-info-front ch-front-3"><h4 style="margin-top:50px;">LANTAI <br> 3</h4></div>
                                    <div class="ch-info-back">
                                        @if($layanan_loket_3->count() > 0)
                                        @foreach($layanan_loket_3->get() as $value)
                                        <h3>{{$value->nama_layanan}}</h3> 
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li> <br><br><br>
                        <li>
                            <div class="ch-item">
                                <div class="ch-info" id="flip-4">
                                    <div class="ch-info-front ch-front-4"><h4 style="margin-top:50px;">LANTAI <br> 4</h4></div>
                                    <div class="ch-info-back">
                                     @if($layanan_loket_4->count() > 0)
                                        @foreach($layanan_loket_4->get() as $value)
                                        <h3>{{$value->nama_layanan}}</h3> 
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                        <div class="ch-item">
                            <div class="ch-info" id="flip-5">
                                <div class="ch-info-front ch-front-5"><h4 style="margin-top:50px;">LANTAI <br> 5</h4></div>
                                <div class="ch-info-back">
                                   @if($layanan_loket_5->count() > 0)
                                         @foreach($layanan_loket_5->get() as $value)
                                        <h3>{{$value->nama_layanan}}</h3> 
                                        @endforeach
                                    @endif  
                                </div>
                            </div>
                        </div>
                        </li>
                        <li>
                            <div class="ch-item">
                                <div class="ch-info" id="flip-6">
                                    <div class="ch-info-front ch-front-6"><h4 style="margin-top:50px;">LANTAI <br>  6</h4></div>
                                    <div class="ch-info-back">
                                     @if($layanan_loket_5->count() > 0)
                                        @foreach($layanan_loket_6->get() as $value)
                                        <h3>{{$value->nama_layanan}}</h3> 
                                        @endforeach
                                       @endif 
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                        </div>
                    </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="background-color:black; height:40px;">
                <p style="text-align:center; color:aliceblue; padding-top:1%;">
                    Copyright BPOM @2018
                </p>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<script type="text/javascript">
$("#flip-1").click(function () {
  window.location.href = "{{URL::to('layanan/1')}}"
});
$("#flip-2").click(function () {
  window.location.href = "{{URL::to('layanan/2')}}"
});
$("#flip-3").click(function () {
  window.location.href = "{{URL::to('layanan/3')}}"
});
$("#flip-4").click(function () {
  window.location.href = "{{URL::to('layanan/4')}}"
});
$("#flip-5").click(function () {
  window.location.href = "{{URL::to('layanan/5')}}"
});
$("#flip-6").click(function () {
  window.location.href = "{{URL::to('layanan/6')}}"
});
</script>
