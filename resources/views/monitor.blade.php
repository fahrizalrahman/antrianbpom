<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monitoring Utama</title>
    <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href=" {{asset('css/file.css')}} ">

</head>
<body style="container-fluid; overflow-x:hidden; background-image:url({{asset('img/log/bg-log.jpg')}});">

    <div class="container-fluid">
    {{-- <div class="row"> --}}
            <div class="col-sm-12" style="height:70px; background-color:#e6e6e6;">
                    <img src="{{asset('img/log/logo-bpom.png')}}" style="margin-top:7px;" width="220px" height="55px" >
                    <span style="float:right; text-align:center; height:30px; margin-left:-15px;  margin-right:-35px; width:20%;">
                        <div class="time">
                            <h1 style="text-align:center; color:#252525;; margin-top:8px; float:center;"> Monitoring</h1> 
                                            <div id="test"></div>

                            {{-- <p style="color:forestgreen; text-align:center;"><h1><b></b></h1></p> --}}
                        </div>
                    </span>
                </div>
                <div class="col-md-12" style="height:2px; width:100%; background-color:#3badc9;">
                    </div>
        <div class="col-md-12" style="width:100%; height:auto; background-image:url( {{asset('img/come.jpg')}} ); background-size:cover; background-position:center; background-repeat:no-repeat;">
            <div class="container-fluid" style="margin-left:19px;">
              <div class="row" style="margin-top:0px; margin-left:5px;">
                    <div class="col-sm-6" style="margin-top:1%; height:auto; width:auto;">
                        <table class="table-responsive" style="position:static;">
                        <col width="90">
                        <col width="430">
                        <col width="60">
                        <col width="100">
                        <td rowspan="0" style="background-color:#276a7b; color: white; height:40px; text-align:center; "><h1> <b> 1 </b></h1></td>
                        <?php $_1=1; ?>
                        @foreach ($MonitorLt1 as $Lt1)
                            <tr>
                            <td style="background-color:#278698; height:40px;">{{$Lt1->nama_layanan}}</td>
                                <td style="background-color:#278698; height:40px;">{{$Lt1->kode}}</td>
                                <td style="background-color:#278698; height:40px;"><h4 style="float:left; margin-left:25px;">{{$Lt1->kode_antrian}} - </h4><h4 style="float:left; margin-left:8px;" id="lok1_{{ $_1 }}"></h4></td>
                            </tr>
                        <?php $_1++; ?>    
                        @endforeach
                        
                        </table>
                    </div>

                    <div class="col-sm-6" style="margin-top:1%;">
                        <table class="table-responsive" style=" position:static;">
                        <col width="90">
                        <col width="430">
                        <col width="60">
                        <col width="100">
                        <td rowspan="0" style="background-color:#276a7b; color: white; height:40px; text-align:center; "><h1> <b> 2</b> </h1></td>
                        <?php $_2=1; ?>
                        @foreach ($MonitorLt2 as $Lt2)    
                            <tr>
                                <td style="background-color:#278698; height:40px;">{{$Lt2->nama_layanan}}</td>
                                <td style="background-color:#278698; height:40px;">{{$Lt2->kode}}</td>
                                <td style="background-color:#278698; height:40px;"><h4 style="float:left; margin-left:25px;">{{$Lt2->kode_antrian}} - </h4><h4 style="float:left; margin-left:8px;" id="lok2_{{ $_2 }}"></h4></td>
                                
                            </tr>
                        <?php $_2++; ?>
                        @endforeach
                        </table>
                    </div>

                    <div class="col-sm-6" style="margin-top:-2.3%;">
                        <table class="table-responsive" style=" position:static;">
                        <col width="90">
                        <col width="430">
                        <col width="60">
                        <col width="100">
                        <td style="background-color:#276a7b; height:40px; color: white; text-align:center; " rowspan="0"><h1> <b> 3</b> </h1></td>
                        <?php $_3=1; ?>
                        @foreach ($MonitorLt3 as $Lt3)    
                            <tr>
                                <td style="background-color:#278698; height:40px;">{{$Lt3->nama_layanan}}</td>
                                <td style="background-color:#278698; height:40px;">{{$Lt3->kode}}</td>
                                <td style="background-color:#278698; height:40px;"><h4 style="float:left; margin-left:25px;">{{$Lt3->kode_antrian}} - </h4><h4 style="float:left; margin-left:8px;" id="lok3_{{ $_3 }}"></h4></td>
                            </tr>
                        <?php $_3++; ?>
                        @endforeach
                        </table>
                    </div>

                    <div class="col-sm-6" style="margin-top:0.4%;">    
                        <table class="table-responsive" style=" position:static;">
                        <col width="90">
                        <col width="430">
                        <col width="60">
                        <col width="100">    
                        <td style="background-color:#276a7b; height:40px; color: white; text-align:center; " rowspan="0"><h1> <b> 4</b> </h1></td>
                        <?php $_4=1; ?>
                        @foreach ($MonitorLt4 as $Lt4)    
                            <tr>
                                <td style="background-color:#278698; height:40px;">{{$Lt4->nama_layanan}}</td>
                                <td style="background-color:#278698; height:40px;">{{$Lt4->kode}}</td>
                                <td style="background-color:#278698; height:40px;"><h4 style="float:left; margin-left:25px;">{{$Lt4->kode_antrian}} - </h4><h4 style="float:left; margin-left:8px;" id="lok4_{{ $_4 }}"></h4></td>
                            </tr>
                        <?php $_4++; ?>
                        @endforeach
                        </table>
                    </div>

                    <div class="col-sm-6" style="margin-top:0.4%;">
                        <table class="table-responsive" style=" position:static;">
                        <col width="90">
                        <col width="430">
                        <col width="60">
                        <col width="100">
                        <td style="background-color:#276a7b; height:40px; color: white; text-align:center; " rowspan="0"><h1> <b> 5</b> </h1></td>
                        <?php $_5=1; ?>
                        @foreach ($MonitorLt5 as $Lt5)    
                            <tr>
                                <td style="background-color:#278698; height:40px;">{{$Lt5->nama_layanan}}</td>
                                <td style="background-color:#278698; height:40px;">{{$Lt5->kode}}</td>
                                <td style="background-color:#278698; height:40px;"><h4 style="float:left; margin-left:25px;">{{$Lt5->kode_antrian}} - </h4><h4 style="float:left; margin-left:8px;" id="lok5_{{ $_5 }}"></h4></td>
                            </tr>
                        <?php $_5++; ?>
                        @endforeach
                        </table>
                    </div>

                    <div class="col-sm-6" style="margin-top:-6.9%;">
                        <table class="table-responsive" style=" position:static;">
                        <col width="90">
                        <col width="430">
                        <col width="60">
                        <col width="100">    
                        <td style="background-color:#276a7b; height:40px; color: white; text-align:center; " rowspan="0"><h1> <b> 6</b> </h1></td>
                        <?php $_6=1; ?>
                        @foreach ($MonitorLt6 as $Lt6)    
                            <tr>
                                <td style="background-color:#278698; height:40px;">{{$Lt6->nama_layanan}}</td>
                                <td style="background-color:#278698; height:40px;">{{$Lt6->kode}}</td>
                                <td style="background-color:#278698; height:40px;"><h4 style="float:left; margin-left:25px;">{{$Lt6->kode_antrian}} - </h4><h4 style="float:left; margin-left:8px;" id="lok6_{{ $_6 }}"></h4></td>
                            </tr>
                        <?php $_6++; ?>
                        @endforeach
                        </table>
                    </div>

                    <div class="col-sm-6" style=" margin-top:0.4%;">
                        <table class="table-responsive" style="background-color:beige; position:static; margin-bottom:4px;">
                        <col width="600px">    
                        @foreach ($textmonitor as $text)
                            <tr>
                                <td style="color:blue; padding-left:20px;"> <b> <u> {{$text->judul}}</u></b></td>
                            </tr>
                            <tr>
                                <td style="color:black; font-size:11px; padding-left:20px; ">
                                    {{$text->isi}}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>                    
                </div>
            </div>
           
        </div>
        <div class="col-md-12" style="height:2px; width:100%; background-color:#3badc9;">
            </div>
        <div class="col-md-12" style="width:100%; height:30px; background-color:black;">
            <p style="size:18px; color:#e6e6e6; text-align:center; font-style:bold;"> SELAMAT DATANG DI KANTOR BADAN PENGAWAS OBAT DAN MAKANAN</p>
        </div>
    </div>
</div>
    
    <script src="{{asset ('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

<script type="text/javascript">

var es = new EventSource("<?php echo action('Monitoring\monitoringController@layanan_utama'); ?>");
  es.onmessage = function(e) {
    var _data = JSON.parse(e.data);
    var x = '';
    for (i in _data) {
      x +=  _data[i].id_element + ",";
      $('#' + _data[i].id_element).html(_data[i].nomor);
    }
  }

</script>
</body>
</html>