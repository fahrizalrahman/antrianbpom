
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Setting Hari Sublayanan</h1>
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
             {!! Form::model($settingharisub, ['url' => route('settingharisub.update', $settingharisub->id), 'method' => 'put']) !!}
            {{csrf_field()}}                
            <div class="card-body">
                  
                   <div class="form-group{{ $errors->has('hari') ? ' has-error' : '' }}">
                          {!! Form::label('hari', 'Hari', ['class'=>'col-md-2 control-label']) !!}
                          <select class="form-control{{ $errors->has('hari') ? ' is-invalid' : '' }}" id="hari" name="hari">
                                    <option value="{{$settingharisub->hari}}">{{$settingharisub->hari}}</option>
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

                   <div class="form-group{{ $errors->has('id_sublayanan') ? ' has-error' : '' }}">
                        {!! Form::label('id_sublayanan', 'Nama Sublayanan', ['class'=>'col-md-2 control-label']) !!}
                        {!! Form::select('id_sublayanan',App\Sublayanan::pluck('nama_sublayanan','id')->all(), $settingharisub->id_sublayanan,['class'=>'form-control','name'=>'id_sublayanan','id'=>'id_sublayanan']) !!}
                            {!! $errors->first('id_sublayanan', '<p class="help-block">:message</p>') !!}

                             @if ($errors->has('id_sublayanan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id_sublayanan') }}</strong>
                                    </span>
                            @endif
                        </div>

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
