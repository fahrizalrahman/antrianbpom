@extends('layouts.app_pelanggan')

@section('content')
  <div class="content-wrapper">

    <!-- The Modal 1-->
<div class="modal" id="myModal1" >
  <div class="modal-dialog" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title">Sub Layanan </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="list-sublayanan">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 1-->

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
                <section class="main" >   
                    <div class="row">  
                    @foreach($layanan_lantai as $layanan_lantais)  
                    <?php $count_sublayanan = \App\Sublayanan::where('id_loket',$layanan_lantais->id)->count() ?>
                        <div class="col-sm-4 col-xs-12" >          
                        <div class="card" style="height:170px">
                          <div class="card-heading" style="font-size:16px; background-color:#17A2B8; color:white; text-align:center"><strong>  {{$layanan_lantais->kode}}</strong></div>
                          <div class="card-body" style="font-size:14px; text-align:center; font-weight:bold">
                            <p data-toggle="tooltip" title="{{$layanan_lantais->nama_layanan}}">{{ str_limit($layanan_lantais->nama_layanan, $limit = 25, $end = '...')}}  ({{$count_sublayanan}})</p>
                          </div>
                          <div class="card-footer" style="background-color:grey;">
                           <center>
                            
                            @if ($count_sublayanan > 0)
                            <button class="btn modal-sub" data-id="{{$layanan_lantais->id}}"" style="background-color:#4dff88; color:white"><i class="fa fa-list"></i> <b>SUB LAYANAN</b></button>
                            @else
                            <button class="btn cek-layanan" data-id-loket="{{$layanan_lantais->id}}" data-batas-dari-jam="{{$layanan_lantais->batas_dari_jam}}" data-batas-sampai-jam="{{$layanan_lantais->batas_sampai_jam}}" data-batas-antrian="{{$layanan_lantais->batas_antrian}}" style="background-color:#f7bc30; color:white"><i class="fa fa-print"></i> <b>CETAK LAYANAN</b></button>
                            @endif

                          </center>
                          </div>
                         </div>
                      </div>
                   @endforeach
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
     $(document).on('click', '.modal-sub', function (e) { 
          var id_loket = $(this).attr('data-id');

          $("#myModal1").modal('show');
          
          $.get('{{ Url("pilih-sublayanan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id:id_loket}, function(resp){ 
              $("#list-sublayanan").html(resp);
          });
     });
</script>


<script type="text/javascript">
  $(document).on('click', '.select-sub', function (e) { 

      var id_sublayanan = $(this).attr('data-id-sublayanan');
      var id_loket = $(this).attr('data-id-loket');
      var batas_dari_jam = $(this).attr('data-batas-dari-jam');
      var batas_sampai_jam = $(this).attr('data-batas-sampai-jam');
      var batas_antrian = $(this).attr('data-batas-antrian');

      var currentdate = new Date();
      var dayNow = currentdate.getDay()

      if (dayNow == 0) {
            var hari = "minggu";
        }else if(dayNow == 1){
            var hari = "senin";
        }else if(dayNow == 2){
            var hari = "selasa";
        }else if(dayNow == 3){
            var hari = "rabu";
        }else if(dayNow == 4){
            var hari = "kamis";
        }else if(dayNow == 5){
            var hari = "jumat";
        }else if(dayNow == 6){
            var hari = "sabtu";
        }

       $.get('{{ Url("cek-setting-hari-sub") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id:id_sublayanan,hari:hari}, function(resp){  

          if (resp > 0) {
                  $.get('{{ Url("count-antrian") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id:id_loket}, function(resp){  

                    if (currentdate.getHours() >= batas_sampai_jam && resp > batas_antrian) {
                        swal({
                          html: "Batas Pengambilan Tiket Sudah Ditutup !!"
                        });
                    }else if (currentdate.getHours() <= batas_dari_jam && resp > batas_antrian){
                        swal({
                          html: "Batas Pengambilan Tiket Belum Dibuka !!"
                        });
                    }else{
                      window.location.href = "{{URL::to('print-antrian-sub/')}}/"+id_loket+"/"+id_sublayanan
                        
                        swal({
                            html :  "Berhasil Mengambil Antrian",
                            showConfirmButton :  false,
                            type: "success",
                            timer: 1000
                        });
                    }
                 });
          }else{
            swal({
                html: "Hari ini Tidak Melayani Sub Layanan yang Anda Pilih !!"
              });
          }

        });

  });
</script>

<script type="text/javascript">
    $(document).on('click', '.cek-layanan', function (e) { 

      var id_loket = $(this).attr('data-id-loket');
      var batas_dari_jam = $(this).attr('data-batas-dari-jam');
      var batas_sampai_jam = $(this).attr('data-batas-sampai-jam');
      var batas_antrian = $(this).attr('data-batas-antrian');

      var currentdate = new Date();
      var dayNow = currentdate.getDay()

      if (dayNow == 0) {
            var hari = "minggu";
        }else if(dayNow == 1){
            var hari = "senin";
        }else if(dayNow == 2){
            var hari = "selasa";
        }else if(dayNow == 3){
            var hari = "rabu";
        }else if(dayNow == 4){
            var hari = "kamis";
        }else if(dayNow == 5){
            var hari = "jumat";
        }else if(dayNow == 6){
            var hari = "sabtu";
        }

       $.get('{{ Url("cek-setting-hari") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id:id_loket,hari:hari}, function(resp){  

          if (resp > 0) {
                  $.get('{{ Url("count-antrian") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id:id_loket}, function(resp){  

                    if (currentdate.getHours() >= batas_sampai_jam && resp > batas_antrian) {
                        swal({
                          html: "Batas Pengambilan Tiket Sudah Ditutup !!"
                        });
                    }else if (currentdate.getHours() <= batas_dari_jam && resp > batas_antrian){
                        swal({
                          html: "Batas Pengambilan Tiket Belum Dibuka !!"
                        });
                    }else{
                      window.location.href = "{{URL::to('print-antrian/')}}/"+id_loket

                       swal({
                            html :  "Berhasil Mengambil Antrian",
                            showConfirmButton :  false,
                            type: "success",
                            timer: 1000
                        });
                    }
                 });
          }else{
            swal({
                html: "Hari ini Tidak Melayani Layanan yang Anda Pilih !!"
              });
          }

        });



  });
</script>

<script>
  $( document ).ready(function() {
      $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
  });
</script>

@endsection

