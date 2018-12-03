
@extends('layouts.app_unit')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Setting Hari Layanan</h1>
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
                <h3 class="card-title">Isi Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::open(['url' => route('unit-settinghari.store'),'method' => 'post']) !!}
                <div class="card-body">
                  
                   <div class="form-group{{ $errors->has('hari') ? ' has-error' : '' }}">
                          {!! Form::label('hari', 'Hari', ['class'=>'col-md-2 control-label']) !!}
                          <select class="form-control{{ $errors->has('hari') ? ' is-invalid' : '' }}" id="hari" name="hari">
                                    <option value="">Silakan Pilih</option>
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
                              @if ($errors->has('lantai'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('lantai') }}</strong>
                                </span>
                               @endif
                        </div>

                  <span id="select-layanan">

                    </span>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
      $(document).ready(function() {
         var lantai = $("#lantai").val();

          $.get('{{ Url("cek-pilih-lantai") }}',{'_token': $('meta[name=csrf-token]').attr('content'),lantai:lantai}, function(resp){  

            $("#select-layanan").html(resp);
             
          });
    });
      
        $(document).on('change', '#lantai', function (e) { 
         var lantai = $(this).val();

          $.get('{{ Url("cek-pilih-lantai") }}',{'_token': $('meta[name=csrf-token]').attr('content'),lantai:lantai}, function(resp){  

            $("#select-layanan").html(resp);
             
          });
    });
</script>
@endsection
