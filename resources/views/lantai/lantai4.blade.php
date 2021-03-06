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
<body class="container-fluid" style="background-image:url({{url(Storage::url(@$Background->first()->filename))}}); background-size:cover; background-position:center; background-repeat:no-repeat;">

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
                        <h1 style="text-align:center; color:#252525;; margin-top:8px;">Lantai 4</h1> 
                    </div>
                </span>
            </div>
    <div class="col-md-12" style="height:3px; width:100%; background-color:deepskyblue;">
    </div>

    <div class="col-md-4" style="width:119%; height:auto;">
      <table border="1px" style=" width:132%; height:auto; margin-left:-15px; ">
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
        @if(@$imgSid4->count() > 0)
          <img src="{{asset('img/'.@$imgSid4->first()->gambar)}}" style="background-position:center; background-repeat:no-repeat; height:400px; margin-left:-15px; width:132%;">
        @else
         <img style="background-color:black; background-position:center; margin-left:-15px; background-repeat:no-repeat; height:410px; width:132%;">
         @endif
      </div>
    </div>
    
    <div class="col-sm-7" style="background-image:url({{asset('img/'.@$bgLantai4->first()->gambar)}}); margin-left:129px; width:820px; height:auto; background-size:cover; background-position:center; background-repeat:no-repeat;">                
    </div>
    <div class="col-md-12" style="height:3px; width:100%; background-color:deepskyblue;">
    </div>
    
    <div class="row">
        <div class="col-md-12" style="width:103%;">
            <table border="0px" style="width:100.4%; height:40px;">
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
