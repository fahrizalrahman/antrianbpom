<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href=" {{asset('css/file.css')}} ">
    <title>Dashboard Lantai 1</title>
</head>
<body class="container-fluid" style="background-image:url({{('img/log/bg-log.jpg')}})">
    <div class="container-fluid">
                  <a class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
               
              </div>
            </div>
            <!-- Message End -->
          </a>
        <div class="row">
                
            <div class="col-sm-12" style="height:70px; background-color:#e6e6e6;;">
                <img src="{{asset('img/log/logo-bpom.png')}}" style="margin-top:7px;" width="220px" height="55px" >
                <span style="float:right; text-align:center; height:30px; margin-left:-15px; margin-right:-15px; width:20%;">
                        <div class="time">
                            <h1 style="text-align:center; color:#252525;; margin-top:8px;">Lantai 1</h1> 
                            
                        </div>
                    </span>
            </div>
           
            <div class="col-sm-7" style=" margin-right:-13px; width:820px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat;">
                    @if ($bgLantai1->first()->type == 1 )
                    <video width="890" height="660" controls autoplay loop>
                        <source src="{{Storage::url($bgLantai1->first()->filename)}}" type="video/mp4">
                    </video>    
                    @else 
                        <img src="{{Storage::url($bgLantai1->first()->filename)}}" >
                    @endif             
            </div>

            <div class="col-sm-4" style="width:120.%; height:auto;">
                <table border="1px;" style="width:132.8%; border-color:gray;">
                        <?php $_i=1; ?>
                        @foreach ($lantai1 as $lantai1)
                        <tr>
                            <td class="col-sm-5" style="background-color:#2b869d; height:55px; width:400px;color:white;">{{$lantai1->nama_layanan}}</td>
                            <td id="td_style" rowspan="2" style="background-color:#236c7d; width:100px; height:55px; text-align:center; border-color:honeydew;color:white;"><h3 style="float:left; margin-left:25px;">{{$lantai1->kode_antrian}} - </h3><h3 style="float:left; margin-left:8px;" id="lok_{{ $_i }}"></h3></td>
                        </tr>
                        <tr>
                            <td class="col-sm-5" style="background-color:#34a1bc; height:55px; width:400px;color:white;">{{$lantai1->kode}}</td>
                        </tr>
                        <?php $_i++; ?>
                        @endforeach
                </table>
            </div>
        </div>

        <div class="row">
                <div class="col-md-12" style="height:5px; width:100%; background-color:#236c7d;">
                </div>
                @if($imgFotL1->count() > 0)
                <div class="col-md-6" style="background-image:url({{url(Storage::url($imgFotL1->first()->filename))}}); width:auto; height:75px;">
                </div>
                @else
                 <div class="col-md-6" style="background-color:white; width:auto; height:75px;">
                </div>
                @endif
                @if($imgFotR1->count() > 0)
                <div class="col-md-6" style="background-image:url({{url(Storage::url($imgFotR1->first()->filename))}}); width:auto; height:75px;">
                 </div>
                 @else
                 <div class="col-md-6" style="background-color:white; width:auto; height:75px;">
                </div>
                @endif

            <div class="col-md-12" style="width:102%;">
                <table border="0px" style="width:102%; height:40px; margin-left:-15px;">
                    <tr>
                        <td style="width:150px; margin-right:10px; background-color:#34a1bc; text-align:center; "><b> <h3 id="time-part"></h3></b></td>
                        <td style="width:1500px; background-color:#252525; color:antiquewhite; size:19px;"><marquee>{{$Text->first()->isi}}</marquee></td>
                    </tr>
                </table>
            </div>

            </div>
        </div>
    </div>
    {{-- Javascript --}}
    
    <script src="{{asset ('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
    <!-- custom -->
    <script src="{{asset('js/main.js')}}"></script>

   <script type="text/javascript">
       $(document).ready(function() {
            var interval = setInterval(function() {
            var momentNow = moment();
            $('#time-part').html(momentNow.format('hh:mm'));
            }, 100);
        });

var es = new EventSource("<?php echo action('Monitoring\monitoringController@layanan_satu'); ?>");
es.onmessage = function(f){
    var _text = f.data;
    var _test = JSON.parse(_text);
    $('#lok_1').html(_test.l1);
    $('#lok_2').html(_test.l2);
    $('#lok_3').html(_test.l3);
    $('#lok_4').html(_test.l4);
    $('#lok_5').html(_test.l5);
    $('#lok_6').html(_test.l6);
}

var es = new EventSource("<?php echo action('Monitoring\monitoringController@layanan_aktif'); ?>");
es.onmessage = function(f) {
    if(f.data.length > 0){
        $('#td_style').css('background-color', '#34a1bc');
        $('#lok_' + f.data).parent('td').css('background-color', 'red');
    }
}

   </script>
</body>
</html>