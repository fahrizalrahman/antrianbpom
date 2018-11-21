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
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">
          <div >
            <!-- LINE CHART -->
               {!! Form::open(['url' => '/update-user/web','method' => 'post','enctype'=>'multipart/form-data' ]) !!}
              @csrf
                  <label class="control-label">Type <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                          <select name="type" id="type" class="form-control" required>
                            <option @if(@$data_user->type==='0') selected @endif value="0">Belum dipilih</option>
                            <option @if(@$data_user->type==='1') selected @endif value="1">Perorangan</option>
                            <option @if(@$data_user->type==='2') selected @endif value="2">Perusahaan</option>
                          </select>

                        </div>
                    </div>

                    

                    <label class="control-label">Nama<span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="name" name="name" value="{{$data_user->nama}}" class="form-control" placeholder="Masukan Nama" required />
                        </div>
                    </div>
                    
                   <label class="control-label">NPWP <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="npwp" name="npwp" value="{{$data_user->npwp}}" class="form-control" minlength="20" maxlength="20" placeholder="Masukan NPWP" required />
                        </div>
                    </div>

                    <label class="control-label">Alamat<span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="alamat" name="alamat" value="{{$data_user->alamat}}" class="form-control" placeholder="Masukan Alamat" required />
                        </div>
                    </div>


                    <label class="control-label">No Telp <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="no_telp" name="no_telp" value="{{$data_user->no_telp}}" class="form-control" placeholder="Masukan No Telp" required />
                        </div>
                    </div>


                 <label class="control-label">NIK <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="nik"  name="nik" value="{{$data_user->nik}}" minlength="16" maxlength="16" class="form-control" placeholder="Masukan NIK" required />
                        </div>
                    </div>

                    <label class="control-label">Email <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="email" id="email" name="email" value="{{$data_user->email_1}}" class="form-control" placeholder="Masukan Email" required />
                        </div>
                    </div>

                        <label class="control-label">Foto</label>
                        <div class="row row-m-b-15">
                          <div class="col-md-12">
                              <input type="file" id="foto" name="foto" value="{{$data_user->foto}}" class="form-control" placeholder="Masukan foto" />
                          </div>
                        </div>
                      <input type="hidden" name="id" value="{{$data_user->id}}" id="id">
                <div class="register-buttons" style="padding-top:10px;padding-bottom:10px">
                        <button type="submit" id="ubah" class="btn btn-primary btn-block btn-lg">Ubah</button>
                </div>
             {!! Form::close() !!}
          </div>
            <!-- /.card -->
        </div><!-- penutup div col sm -->
         <div class="col-md-6">
                        <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="refresh-table-cek">

                  <tr>
                    <td style="background-color:grey;">Type : </td>
                    @if(@$data_user->type==='1')
                    <td>Perorangan</td>
                    @elseif(@$data_user->type==='2')
                    <td>Perusahaan</td>
                    @endif
                  </tr>

                  <tr>
                    <td style="background-color:grey;">Nama : </td>
                    <td>{{$data_user->nama}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:grey;">Email : </td>
                    <td>{{$data_user->email_1}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:grey;">NIK : </td>
                    <td>{{$data_user->nik}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:grey;">NPWP : </td>
                    <td>{{$data_user->npwp}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:grey;">No Telp : </td>
                    <td>{{$data_user->no_telp}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:grey;">Alamat : </td>
                    <td>{{$data_user->alamat}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:grey;">Foto : </td>
                    @if($data_user->foto == null)
                    <td><img src="{{asset('img/default-avatar.jpg')}}" style="height:50px;"></td>
                    @else
                    <td><img src="{{asset('foto-profile/'.$data_user->foto.'')}}" style="height:50px;"></td>
                    @endif
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
            </div>
            <!-- /.card -->
         </div><!-- penutup div col sm -->
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
    
    $(document).on('blur', '#npwp', function (e) { 
     
     var npwp = $("#npwp").val();
  
      $.get('{{ Url("cek_npwp_over") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_npwp:npwp}, function(resp){  
          if (resp == 0 ){
              swal({
                        html: "NPWP "+npwp+" SUDAH DIGUNAKAN 3 KALI!!"
                   });
            $('#npwp').val('');
          }
      });
  });
  </script>
@endsection

<?php
}
?>