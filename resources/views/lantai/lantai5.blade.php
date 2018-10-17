<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard Lantai 5</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href=" {{asset('css/file.css')}} ">
  <script src="{{asset ('jquery.min.js')}}"></script>
  <script src="{{asset('popper.min.js')}}"></script>
  <script src="{{asset('bootstrap.min.js')}}"></script>
</head>
<body class="container-fluid" style="background-image:url({{('img/log/bg-log.jpg')}})">

<div class="container-fluid">
  <div class="row" style="margin-top:1px;">

      <div class="col-sm-12" style="height:70px; background-color:#e6e6e6;">
          <img src="{{asset('img/log/logo-bpom.png')}}" style="margin-top:7px;" width="220px" height="55px" >
          <span style="float:right; text-align:center; height:30px; margin-left:-15px; margin-right:-15px; width:20%;">
              <div class="time">
                  <h1 style="text-align:center; color:#252525;; margin-top:8px;">Lantai 5</h1> 
                  {{-- <p style="color:forestgreen; text-align:center;"><h1><b></b></h1></p> --}}
              </div>
          </span>
      </div>

    <div class="col-md-12" style="height:5px; width:100%; background-color:deepskyblue;">
    </div>

    <div class="col-md-5" style="width:623px; height:auto;">
      <table border="1px" style="margin-left:-15px; margin-right:-14px; width:104.5%;">
        <?php $_i = 1; ?>
          @foreach ($lantai5 as $lantai5)
          <tr>
              <td class="col-md-4" style="color:white;background-color:#2b869d; height:45px; width:388px;">{{$lantai5->nama_layanan}}</td>
              <td rowspan="2" style="color:white;background-color:#236c7d; width:100px; height:45px; text-align:center; border-color:honeydew;"><h3 style="float:left; margin-left:25px;">{{$lantai5->kode_antrian}} - </h3><h3 style="float:left; margin-left:8px;" id="lok_{{ $_i }}"></h3></td>
          </tr>
          
          <tr>
              <td class="col-md-4" style="color:white;background-color:#34a1bc; height:45px; width:100px;">{{$lantai5->kode}}</td>
          </tr>
        <?php $_i++; ?>
          @endforeach
      </table>

      <div >
          @if($imgSid5->count() > 0)
          <img src="{{url(Storage::url($imgSid5->first()->filename))}}" style="margin-left:-15px; margin-right:-16px; background-position:center; height:310px; width:104.5%;">
          @else
          <img  style="background-color:white;background-position:center;  margin-left:-15px; margin-right:-16px; height:310px; width:102.4%;">
          @endif

      </div>
    </div>
     @if($bgLantai5->count() > 0)
      <div class="col-md-7" style="background-image:url({{url(Storage::url($bgLantai5->first()->filename))}}); width:820px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat;">               
      </div>
      @else
      <div class="col-md-7" style="background-color:white; width:820px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat; ">               
      </div>
      @endif

     @if($imgFotL5->count() > 0)
      <div class="col-md-6" style="background-image:url({{url(Storage::url($imgFotL5->first()->filename))}}); width:auto; height:75px;">
        </div>
        @else
       <div class="col-md-6" style="background-color:white; width:auto; height:75px;">
        </div> 
        @endif
    
         @if($imgFotR5->count() > 0)
        <div class="col-md-6" style="background-image:url({{url(Storage::url($imgFotR5->first()->filename))}}); width:auto; height:75px;">
          </div>
          @else
        <div class="col-md-6" style="background-color:white; width:auto; height:75px;">
        </div> 
        @endif

          {{-- <div class="col-md-12" style="background-color:#252525;">
              <span style="float:left; height:35px; color:white;background-color:#3badc9; text-align:center; width:10%; margin-left:-15px;"> <h3 id="time-part"></h3></span> 
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

var es = new EventSource("<?php echo action('Monitoring\monitoring5Controller@layanan_satu'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#lok_1').html(f.data);
  }else{
      $('#lok_1').html('0');
  }
}


var es = new EventSource("<?php echo action('Monitoring\monitoring5Controller@layanan_dua'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#lok_2').html(f.data);
  }else{
      $('#lok_2').html('0');
  }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring5Controller@layanan_tiga'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#lok_3').html(f.data);
  }else{
      $('#lok_3').html('0');
  }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring5Controller@layanan_empat'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#lok_4').html(f.data);
  }else{
      $('#lok_4').html('0');
  }
}

var es = new EventSource("<?php echo action('Monitoring\monitoring5Controller@layanan_aktif'); ?>");
es.onmessage = function(f) {
  if(f.data.length > 0){
      $('#td_style').css('background-color', '#34a1bc');
      $('#lok_' + f.data).parent('td').css('background-color', 'red');
  }
}
</script>

</body>
</html>