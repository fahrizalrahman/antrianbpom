<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard Lantai 6</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href=" {{asset('css/file.css')}} ">
  <script src="{{asset ('jquery.min.js')}}"></script>
  <script src="{{asset('popper.min.js')}}"></script>
  <script src="{{asset('bootstrap.min.js')}}"></script>
</head>
<body class="container-fluid" style="background-image:url({{url(Storage::url($Background->first()->filename))}});">

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

      <div class="col-sm-12" style="height:70px; background-color:#e6e6e6;">
          <img src="{{asset('img/log/logo-bpom.png')}}" style="margin-top:7px;" width="220px" height="55px" >
          <span style="float:right; text-align:center; height:30px; margin-left:-15px; margin-right:-15px; width:20%;">
              <div class="time">
                  <h1 style="text-align:center; color:#252525;; margin-top:8px;">Lantai 6</h1> 
                  {{-- <p style="color:forestgreen; text-align:center;"><h1><b></b></h1></p> --}}
              </div>
          </span>
      </div>

    <div class="col-md-12" style="height:5px; width:100%; background-color:#3badc9;">
    </div>

    @if($bgLantai6->first()->type == 'Video')
        <div class="col-md-7" style="width:626px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat;">             
            <video style="margin-top:-0px; margin-left:-15px; min-width:480px; min-height:515px; position:center;" controls autoplay loop>
                <source src="{{Storage::url($bgLantai6->first()->filename)}}" type="video/mp4">
            </video>
            @if ($TextUtama->count()> 0)
                 <div style="background-color:#2b869d; margin-left:-15px; margin-top:-5px; width:917px; height:120px;">
                    <b><h4 style="margin-left:10px; color:gold; padding-top:10px; text-decoration:underline;">{{$TextUtama->first()->judul}}</h4></b>
                    <p style="margin-left:10px; color:#e6e6e6;">{{$TextUtama->first()->isi}}</p>
                </div>
            @else
                <div style="background-color:#2b869d; margin-left:-15px; margin-top:-5px; width:917px; height:120px;">
                </div>
            @endif
            
        </div>
    @else
        <div class="col-md-7" style="background-image:url({{url(Storage::url($bgLantai6->first()->filename))}}); margin-left:-15px; width:626px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat;">             
        </div>               
    </div>
    @endif
    
    <div class="col-md-4" style="width:132%; height:auto;">
      <table border="1px;" style=" width:132%; margin-left:-12px; border-color:gray;">
        <?php $_i=1; ?>
          @foreach ($lantai6 as $lantai6)
          <tr>
              <td class="col-md-4" style="color:white;background-color:#2b869d; width:388px; height:53px;">{{$lantai6->nama_layanan}}</td>
              <td rowspan="2" style="color:white;background-color:#236c7d; width:100px; height:53px; text-align:center; border-color:honeydew;"><h3 style="float:left; margin-left:25px;">{{$lantai6->kode_antrian}} - </h3><h3 style="float:left; margin-left:8px;" id="lok_{{ $_i }}"></h3></td>
          </tr>
          
          <tr>
              <td class="col-md-4" style="color:white;background-color:#34a1bc; width:100px; height:53px;">{{$lantai6->kode}}</td>
          </tr>
          <?php $_i++; ?>
          @endforeach
      </table>
     
    </div>
    <div class="col-md-12" style="height:5px; width:100%; background-color:#3badc9;">
      </div>

    @if($imgFotL6->count() > 0)
      <div class="col-md-6" style="background-image:url({{url(Storage::url($imgFotL6->first()->filename))}}); width:auto; height:95px;">
    </div>
    @else
      <div class="col-md-6" style="background-color:white; width:auto; height:95px;">
    </div>   
     @endif

    @if($imgFotR6->count() > 0)
        <div class="col-md-6" style="background-image:url({{url(Storage::url($imgFotR6->first()->filename))}}); width:auto; height:95px;">
        </div>
      @else
        <div class="col-md-6" style="background-color:white; width:auto; height:95px;">
        </div>  
    @endif

    <div class="col-md-12" style="width:103%;">
        <table border="0px" style="width:102%; height:40px; margin-left:-15px;">
            <tr>
                <td style="width:150px; margin-right:10px; padding-top:10px; background-color:#34a1bc; text-align:center; "><b style="color:#e6e6e6;"> <h3 id="time-part"></h3></b></td>
                @if ($Text->count() > 0)
                    <td style="width:1500px; background-color:#252525; padding-top:5px; color:antiquewhite; size:19px;"><marquee>{{$Text->first()->isi}}</marquee></td>    
                @else
                    <td style="width:1500px; background-color:#252525; padding-top:5px; color:antiquewhite; size:19px;"><marquee>SELAMAT DATANG</marquee></td>
                @endif
                
            </tr>
        </table>
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

var es = new EventSource("<?php echo action('Monitoring\monitoring6Controller@layanan_satu'); ?>");
    es.onmessage = function(f) {
    if(f.data.length > 0){
        $('#lok_1').html(f.data);
    }else{
        $('#lok_1').html('0');
    }
}


var es = new EventSource("<?php echo action('Monitoring\monitoring6Controller@layanan_dua'); ?>");
    es.onmessage = function(f) {
    if(f.data.length > 0){
       $('#lok_2').html(f.data);
    }else{
       $('#lok_2').html('0');
    }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring6Controller@layanan_tiga'); ?>");
    es.onmessage = function(f) {
    if(f.data.length > 0){
       $('#lok_3').html(f.data);
    }else{
       $('#lok_3').html('0');
    }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring6Controller@layanan_empat'); ?>");
    es.onmessage = function(f) {
    if(f.data.length > 0){
       $('#lok_4').html(f.data);
    }else{
        $('#lok_4').html('0');
    }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring6Controller@layanan_lima'); ?>");
    es.onmessage = function(f) {
    if(f.data.length > 0){
       $('#lok_5').html(f.data);
    }else{
        $('#lok_5').html('0');
    }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring6Controller@layanan_enam'); ?>");
    es.onmessage = function(f) {
    if(f.data.length > 0){
       $('#lok_6').html(f.data);
    }else{
        $('#lok_6').html('0');
    }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring6Controller@layanan_aktif'); ?>");
    es.onmessage = function(f) {
    if(f.data.length > 0){
        $('#td_style').css('background-color', '#34a1bc');
        $('#lok_' + f.data).parent('td').css('background-color', 'red');
    }
}
</script>

</body>
</html>
