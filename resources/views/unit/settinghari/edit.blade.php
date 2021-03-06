
@extends('layouts.app_unit')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Setting Hari</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             {!! Form::model($settinghari, ['url' => route('unit-settinghari.update', $settinghari->id), 'method' => 'put']) !!}
            {{csrf_field()}}
                <div class="card-body">
                  <input type="hidden" name="id" id="id" value="{{$settinghari->id}}">
                   <div class="form-group{{ $errors->has('hari') ? ' has-error' : '' }}">
                          {!! Form::label('hari', 'Hari', ['class'=>'col-md-2 control-label']) !!}
                              <select class="form-control{{ $errors->has('hari') ? ' is-invalid' : '' }}" id="hari" name="hari">
                                    <option value="{{$settinghari->hari}}">{{$settinghari->hari}}</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                              </select>
                              @if ($errors->has('hari'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('hari') }}</strong>
                                </span>
                               @endif
                        </div>

                       <div class="form-group{{ $errors->has('lantai') ? ' has-error' : '' }}">
                          {!! Form::label('lantai', 'Lantai', ['class'=>'col-md-2 control-label']) !!}
                          {!! Form::text('lantai', Auth::user()->lantai, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Lantai', 'id' => 'lantai','name' => 'lantai','disabled']) !!}
                          </select>
                              @if ($errors->has('lantai'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('lantai') }}</strong>
                                </span>
                               @endif
                        </div>

                    <span id="select-layanan">
                       <div class="form-group">
                         <label for="id_loket" class="col-md-2 control-label">Nama Layanan</label>
                         <select id="id_loket" class="form-control" name="id_loket">
                              <option value="{{$settinghari->id_loket}}">{{$settinghari->nama_layanan}}</option>
                            </select> 
                        </div>
                      </span>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button"  id="proses" class="btn btn-primary">Submit</button>
                </div>
             {!! Form::close() !!}
            </div>

          <!-- /.card -->
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
        $(document).on('change', '#lantai', function (e) { 
         var lantai = $(this).val();

          $.get('{{ Url("cek-pilih-lantai") }}',{'_token': $('meta[name=csrf-token]').attr('content'),lantai:lantai}, function(resp){  

            $("#select-layanan").html(resp);
             
          });
    });

    $(document).on('click', '#proses', function (e) { 
          var hari = $("#hari").val();
          var id_loket = $("#id_loket").val();
          var id = $("#id").val();
          
          $.get('{{ Url("edit-settinghari-unit") }}',{'_token': $('meta[name=csrf-token]').attr('content'),hari:hari,id_loket:id_loket,id:id}, function(resp){ 
            if (resp == 0) {
              swal({
                 html: "Hari Yang Anda Pilih Sudah Terpakai !"
              });
            }else{
              window.location.href = '/unit-settinghari';
              swal({
                 html :  "Berhasil Mengubah Setting Hari",
                 showConfirmButton :  false,
                 type: "success",
                 timer: 2000
              });
            }
          });
     });
</script>
@endsection
