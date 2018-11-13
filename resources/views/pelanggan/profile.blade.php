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
             <form>
              {{csrf_field()}}
                    <label class="control-label">Nama <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="name" name="name" value="{{$data_user->name}}" class="form-control" placeholder="Masukan Nama" required />
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <label class="control-label">Email <span class="text-danger">*</span></label>
                    <div class="row m-b-15">
                        <div class="col-md-12">
                            <input type="email" id="email" name="email" value="{{$data_user->email}}" class="form-control" placeholder="Masukan Email" required />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <label class="control-label">NIK <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="nik"  name="nik" value="{{$data_user->nik}}" minlength="16" maxlength="16" class="form-control" placeholder="Masukan NIK" required />
                            @if ($errors->has('nik'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nik') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <label class="control-label">NPWP <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="npwp" name="npwp" value="{{$data_user->npwp}}" class="form-control" minlength="20" maxlength="20" placeholder="Masukan NPWP" required />
                            @if ($errors->has('npwp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('npwp') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    

                    <label class="control-label">No Telp <span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="no_telp" name="no_telp" value="{{$data_user->no_telp}}" class="form-control" placeholder="Masukan No Telp" required />
                            @if ($errors->has('no_telp'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('no_telp') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <label class="control-label">Alamat<span class="text-danger">*</span></label>
                    <div class="row row-m-b-15">
                        <div class="col-md-12 m-b-15">
                            <input type="text" id="alamat" name="alamat" value="{{$data_user->alamat}}" class="form-control" placeholder="Masukan Alamat" required />
                            @if ($errors->has('alamat'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

<!--                <label class="control-label">Foto<span class="text-danger">*</span></label>
                <div class="row row-m-b-15">
                     <div class="col-md-12 m-b-15">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            @if ($data_user->foto == null)
                            <img src="{{ asset('img/default-avatar.png') }}" alt="Foto Akan Tampil Disini">
                            @else
                            {!! Html::image(asset('foto_produk/'.$barang->foto), null, ['class' => 'img-rounded img-responsive']) !!}
                             @endif
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file">
                                <span class="fileinput-new" type="button" >Ambil Foto</span>
                                {!! Form::file('foto',null,['id'=>'foto','name'=>'foto']) !!}
                            </span>
                        </div>
                        {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
                        <a style="color: red;">Size Foto ( Max : 3MB || Ukuran : 200 X 200)</a>
                    </div>
                </div>
                </div>-->
                <div class="register-buttons" style="padding-top:10px;padding-bottom:10px">
                        <button type="button" id="ubah" class="btn btn-primary btn-block btn-lg">Ubah</button>
                </div>
             </form>
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
                    <td style="background-color:grey;">Nama : </td>
                    <td>{{$data_user->name}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:grey;">Email : </td>
                    <td>{{$data_user->email}}</td>
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
                    <td><img src="{{asset('foto_user/$data_user->foto')}}" style="height:50px;"></td>
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
    
    $(document).on('click', '#ubah', function (e) { 
     
     var name = $("#name").val();
     var email = $("#email").val();
     var nik = $("#nik").val();
     var npwp = $("#npwp").val();
     var no_telp = $("#no_telp").val();
     var alamat = $("#alamat").val();
     var id = {{$data_user->id}}
  
      $.get('{{ Url("cek_npwp") }}',{'_token': $('meta[name=csrf-token]').attr('content'),npwp:npwp}, function(resp){  
          if (resp == 0 ){
              swal({
                        html: "NPWP "+npwp+" SUDAH DIGUNAKAN 3 KALI!!"
                   });
          } else {
              $.get('{{ Url("update-user") }}',{'_token': $('meta[name=csrf-token]').attr('content'),name:name,email:email,nik:nik,npwp:npwp,no_telp:no_telp,alamat:alamat,id:id}, function(resp){
                    swal({
                          html :  "Berhasil Melakukan Update Profile",
                          showConfirmButton :  false,
                          type: "success",
                          timer: 1000
                      });
                      location.reload()
              });
          } 
      });
  });
  </script>
@endsection
