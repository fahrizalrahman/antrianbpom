<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard Lantai 4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href=" {{asset('css/file.css')}} ">
  <script src="{{asset('js/main.js')}}"></script>

  <script src="{{asset('bootstrap.min.js')}}"></script>
</head>
<body class="container-fluid" style="background-image:url({{('img/log/bg-log.jpg')}})">

<div class="container-fluid">
  <div class="row" style="margin-top:0px;">

        <div class="col-sm-12" style="height:70px; background-color:#e6e6e6;">
                <img src="{{asset('img/log/logo-bpom.png')}}" style="margin-top:7px;" width="220px" height="55px" >
                <span style="float:right; text-align:center; height:30px; margin-left:-15px; margin-right:-15px; width:20%;">
                    <div class="time">
                        <h1 style="text-align:center; color:#252525;; margin-top:8px;">Lantai 4</h1> 
                        {{-- <p style="color:forestgreen; text-align:center;"><h1><b></b></h1></p> --}}
                    </div>
                </span>
            </div>
    <div class="col-md-12" style="height:5px; width:100%; background-color:deepskyblue;">
    </div>

    <div class="col-md-4" style="width:119%; height:auto;">
      <table border="1px" style=" width:105.8%; height:auto; margin-left:-15px; ">
        <?php $_i = 1; ?>
          @foreach ($lantai4 as $lantai4)
          <tr>
              <td class="col-md-4" style="color:white;background-color:#2b869d; height:55px; width:388px;">{{$lantai4->nama_layanan}}</td>
              <td rowspan="2" style="color:white;background-color:#236c7d; width:100px; height:55px; text-align:center; border-color:honeydew;"><h3 style="float:left; margin-left:25px;">{{$lantai4->kode_antrian}} - </h3><h3 style="float:left; margin-left:8px;" id="lok_{{ $_i }}"></h3></td>
          </tr>
          
          <tr>
              <td class="col-md-4" style="color:white;background-color:#34a1bc; height:55px; width:100px;">{{$lantai4->kode}}</td>
          </tr>
          <?php $_i++; ?>
          @endforeach
      </table>

      <div>
        @if($imgSid4->count() > 0)
          <img src="{{url(Storage::url($imgSid4->first()->filename))}}" style="background-position:center; background-repeat:no-repeat; height:auto; margin-left:-15px; width:105.8%;">
        @else
         <img style="background-color:white;background-position:center; margin-left:-15px; background-repeat:no-repeat; height:410px; width:109%;">
         @endif
      </div>
    </div>
      @if($bgLantai4->count() > 0)
      <div class="col-md-8" style="background-image:url({{url(Storage::url($bgLantai4->first()->filename))}}); width:820px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat;" >
      </div>
      @else
      <div class="col-md-8" style="background-color:white; margin-right:-13px; width:820px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat;" >
      </div>
      @endif

    {{-- <div class="col-md-12" style="background-color:#252525;">
            <span style="float:left; height:45px; color:white;background-color:#3badc9; text-align:center; width:10%; margin-left:-15px;"> <h3 id="time-part"></h3></span> 
    </div> --}}

    <div class="col-md-12" style="width:103%;">
        <table border="0px" style="width:102%; height:40px; margin-left:-15px;">
            <tr>
                <td style="width:150px; margin-right:10px; background-color:#34a1bc; text-align:center; "><b> <h3 id="time-part"></h3></b></td>
                <td style="width:1500px; background-color:#252525; color:antiquewhite; size:19px;"><marquee>SELAMAT DATANG</marquee></td>
            </tr>
        </table>
    </div>

</div>


 {{-- Javascript --}}
    
 <script src="{{asset('js/jquery.min.js')}}"></script>
 <script src="{{asset('js/popper.min.js')}}"></script>
 <script src="{{asset('js/bootstrap.min.js')}}"></script>
 <script src="{{asset('js/moment.min.js')}}"></script>
 <script src="{{asset('js/jquery.nicescroll.js')}}"></script>
 <!-- custom -->
 <script src="{{asset('js/main.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
      $('input').iCheck({
       checkboxClass: 'icheckbox_flat-aero',
       radioClass: 'iradio_flat-aero'
     });
    });
   </script>
  <!-- end: Javascript -->

<script type="text/javascript">
 $(document).ready(function() {
      var interval = setInterval(function() {
      var momentNow = moment();
      $('#time-part').html(momentNow.format('hh:mm'));
      }, 100);
  });

var es = new EventSource("<?php echo action('Monitoring\monitoring4Controller@layanan_satu'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#lok_1').html(f.data);
  }else{
      $('#lok_1').html('0');
  }
}


var es = new EventSource("<?php echo action('Monitoring\monitoring4Controller@layanan_dua'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#lok_2').html(f.data);
  }else{
      $('#lok_2').html('0');
  }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring4Controller@layanan_tiga'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#lok_3').html(f.data);
  }else{
      $('#lok_3').html('0');
  }
}


var es = new EventSource("<?php echo action('Monitoring\monitoring4Controller@layanan_aktif'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#td_style').css('background-color', '#34a1bc');
      $('#lok_' + f.data).parent('td').css('background-color', 'red');
  }
}
</script>

</body>
</html>
