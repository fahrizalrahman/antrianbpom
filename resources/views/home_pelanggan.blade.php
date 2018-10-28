<?php
function isMobile() {
    if(isset($_SERVER['HTTP_USER_AGENT'])) {
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/(tablet|ipad|amazon|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($useragent))) {
        return true ;
    } ;
    
    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
            return true ;
        }
    }
}
if(isMobile()){
  /*
    include_once(app_path().'/routes/mobile_routes.php');
    */
?>
<script type="text/javascript">
  window.location = "/home?mobile=0";
</script>
<?php
} else {
?>
@extends('layouts.app_pelanggan')

@section('content')
  <div class="content-wrapper">

<!-- MODAL -->
@include('pelanggan.modal')

<!-- END MODAL -->

        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
                <div class="container"> 
                <section class="main" style="margin-top:20px;">   
                    <div class="row">    
                        <div class="col-sm-4">                  
                          <div class="card" >
                            <div class="card-body" style="height:200px;background: #ff9900">
                              <center><h1 style="color:white">LANTAI 1</h1></center>
                              <hr style="border-color:dimgray; margin-top:-5px;">
                              @if ($judul_layanan->count() > 0)
                                  <h6 style="color:white; text-align:center;">{{$judul_layanan->first()->keterangan}}</h6>  
                              @else
                                  judul_layanan
                              @endif

                            </div>
                             <div class="card-footer" style="background-color:grey;">
                                <div class="row">
                                 @if($agent->isMobile())
                                  <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" class="card-link btn btn-primary" id="flip-1" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                  </div>
                                @else
                                <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                  </div>

                                  <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" class="card-link btn btn-primary" id="flip-1" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                </div>
                                @endif
                                </div>
                            </div>
                          </div>
                        </div>                       
                         <div class="col-sm-4">                  
                          <div class="card" >
                            <div class="card-body" style="height:200px;background: #ff3300">
                              <center><h1 style="color:white">LANTAI 2</h1></center>
                              <hr style="border-color:dimgray; margin-top:-5px;">
                              @if ($judul_layanan2->count() > 0)
                                  <h6 style="color:white; text-align:center;">{{$judul_layanan2->first()->keterangan}}</h6>  
                              @else
                                  judul_layanan
                              @endif

                            </div>
                             <div class="card-footer" style="background-color:grey;">
                                <div class="row">
                                  @if($agent->isMobile())
                                  <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" class="card-link btn btn-primary" id="flip-2" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                  </div>
                                @else
                                <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                  </div>

                                  <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" class="card-link btn btn-primary" id="flip-2" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                </div>
                                @endif
                                </div>
                            </div>
                          </div>
                        </div>                        
                         <div class="col-sm-4">                  
                          <div class="card" >
                            <div class="card-body" style="height:200px;background: #85adad">
                              <center><h1 style="color:white">LANTAI 3</h1></center>
                              <hr style="border-color:dimgray; margin-top:-5px;">
                              @if ($judul_layanan3->count() > 0)
                                  <h6 style="color:white; text-align:center;">{{$judul_layanan3->first()->keterangan}}</h6>  
                              @else
                                  judul_layanan
                              @endif
                            </div>
                             <div class="card-footer" style="background-color:grey;">
                                <div class="row">
                                  @if($agent->isMobile())
                                  <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" class="card-link btn btn-primary" id="flip-3" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                  </div>
                                @else
                                <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                  </div>

                                  <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" class="card-link btn btn-primary" id="flip-3" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                </div>
                                @endif
                                </div>
                            </div>
                          </div>
                        </div> 
                    </div>
                    <div class="row">    
                        <div class="col-sm-4">                  
                          <div class="card" >
                            <div class="card-body" style="height:200px;background: #1a53ff">
                              <center><h1 style="color:white">LANTAI 4</h1></center>
                              <hr style="border-color:dimgray; margin-top:-5px;">
                              @if ($judul_layanan4->count() > 0)
                                  <h6 style="color:white; text-align:center;">{{$judul_layanan4->first()->keterangan}}</h6>  
                              @else
                                  judul_layanan
                              @endif
                            </div>
                             <div class="card-footer" style="background-color:grey;">
                                <div class="row">
                                @if($agent->isMobile())
                                  <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" class="card-link btn btn-primary" id="flip-4" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                  </div>
                                @else
                                <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                  </div>

                                  <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" class="card-link btn btn-primary" id="flip-4" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                </div>
                                @endif
                                </div>
                            </div>
                          </div>
                        </div>                       
                         <div class="col-sm-4">                  
                          <div class="card" >
                            <div class="card-body" style="height:200px;background: #33ff33">
                              <center><h1 style="color:white">LANTAI 5</h1></center>
                              <hr style="border-color:dimgray; margin-top:-5px;">
                              @if ($judul_layanan5->count() > 0)
                                  <h6 style="color:white; text-align:center;">{{$judul_layanan5->first()->keterangan}}</h6>  
                              @else
                                  judul_layanan
                              @endif
                            </div>
                             <div class="card-footer" style="background-color:grey;">
                                <div class="row">
                                  @if($agent->isMobile())
                                  <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" class="card-link btn btn-primary" id="flip-5" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                  </div>
                                @else
                                <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                  </div>

                                  <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" class="card-link btn btn-primary" id="flip-5" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                </div>
                                @endif
                                </div>
                            </div>
                          </div>
                        </div>                        
                         <div class="col-sm-4">                  
                          <div class="card" >
                            <div class="card-body" style="height:200px;background: #c44dff">
                              <center><h1 style="color:white">LANTAI 6</h1></center>
                              <hr style="border-color:dimgray; margin-top:-5px;">
                              @if ($judul_layanan6->count() > 0)
                                  <h6 style="color:white; text-align:center;">{{$judul_layanan6->first()->keterangan}}</h6>  
                              @else
                                  judul_layanan
                              @endif
                            </div>
                             <div class="card-footer" style="background-color:grey;">
                                <div class="row">
                                    @if($agent->isMobile())
                                  <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-sm-12 col-xs-12">
                                    <button style="width:270px" class="card-link btn btn-primary" id="flip-6" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                  </div>
                                @else
                                <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" data-toggle="modal" data-target="#myModal1" class="card-link btn btn-primary" type="button"><i class="fa fa-info"></i> Info </button>
                                  </div>

                                  <div class="col-sm-6 col-xs-6">
                                  <button style="width:150px" class="card-link btn btn-primary" id="flip-6" type="button"><i class="fa fa-briefcase"></i> Pilih</button> 
                                </div>
                                @endif
                                </div>
                            </div>
                          </div>
                        </div> 
                        </div>
                  </section>
                </div>
            <!-- /.card -->
        </div>
    </div>
</div>
</section>
</div>

    <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>BPOM</strong>
   
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
@endsection
@section('scripts')
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
@endsection

<?php
}
?>