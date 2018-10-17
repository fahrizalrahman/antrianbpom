
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Layanan</h1>
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
              {!! Form::open(['url' => route('loket.store'),'method' => 'post']) !!}
                <div class="card-body">
                  <div class="form-group{{ $errors->has('nama_layanan') ? ' has-error' : '' }}">
                    {!! Form::label('nama_layanan', 'Nama Layanan', ['class'=>'col-md-2 control-label']) !!}
                      {!! Form::text('nama_layanan', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama Layanan', 'id' => 'nama_layanan' ,'name'=>'nama_layanan']) !!}
                      {!! $errors->first('nama_layanan', '<p class="help-block" id="nama_layanan_error">:message</p>') !!}
                  </div>

                  <div class="form-group{{ $errors->has('kode') ? ' has-error' : '' }}">
                    {!! Form::label('kode', 'Loket', ['class'=>'col-md-2 control-label']) !!}
                      {!! Form::text('kode', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Loket', 'id' => 'kode','name' => 'kode']) !!}
                      {!! $errors->first('kode', '<p class="help-block" id="kode_error" style="color:red;">:message</p>') !!}
                  </div>

                  <div class="form-group{{ $errors->has('kode_antrian') ? ' has-error' : '' }}">
                    {!! Form::label('kode_antrian', 'Kode Antrian', ['class'=>'col-md-2 control-label']) !!}
                      {!! Form::text('kode_antrian', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Loket', 'id' => 'kode_antrian','name' => 'kode_antrian']) !!}
                      {!! $errors->first('kode_antrian', '<p class="help-block" id="kode_error" style="color:red;">:message</p>') !!}
                  </div>

                  <div class="form-group{{ $errors->has('lantai') ? ' has-error' : '' }}">
                      {!! Form::label('lantai', 'Lantai', ['class'=>'col-md-2 control-label']) !!}
                                <select class="form-control{{ $errors->has('lantai') ? ' is-invalid' : '' }}" id="lantai" name="lantai">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                          </select>
                          @if ($errors->has('lantai'))
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('lantai') }}</strong>
                            </span>
                           @endif
                    </div>

                   <div class="form-group{{ $errors->has('petugas') ? ' has-error' : '' }}">
                        {!! Form::label('petugas', 'Petugas', ['class'=>'col-md-2 control-label']) !!}
                        {!! Form::select('petugas',App\User::where('jabatan','petugas_loket')->pluck('name','id')->all(), null,['class'=>'form-control','name'=>'petugas','id'=>'petugas']) !!}
                            {!! $errors->first('petugas', '<p class="help-block">:message</p>') !!}

                             @if ($errors->has('petugas'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('petugas') }}</strong>
                                    </span>
                            @endif
                        </div>

                      <div class="form-group{{ $errors->has('batas_dari_jam') ? ' has-error' : '' }}">
                          {!! Form::label('batas_dari_jam', 'Batas Dari Jam', ['class'=>'col-md-2 control-label']) !!}
                              <select class="form-control{{ $errors->has('batas_dari_jam') ? ' is-invalid' : '' }}" id="batas_dari_jam" name="batas_dari_jam">
                                    <option value="">Silakan Pilih</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                              </select>
                              @if ($errors->has('batas_dari_jam'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('batas_dari_jam') }}</strong>
                                </span>
                               @endif
                        </div>

                      <div class="form-group{{ $errors->has('batas_sampai_jam') ? ' has-error' : '' }}">
                          {!! Form::label('batas_sampai_jam', 'Batas Sampai Jam', ['class'=>'col-md-2 control-label']) !!}
                              <select class="form-control{{ $errors->has('batas_sampai_jam') ? ' is-invalid' : '' }}" id="batas_sampai_jam" name="batas_sampai_jam">
                                    <option value="">Silakan Pilih</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                              </select>
                              @if ($errors->has('batas_sampai_jam'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('batas_sampai_jam') }}</strong>
                                </span>
                               @endif
                        </div>
                  <div class="form-group{{ $errors->has('batas_antrian') ? ' has-error' : '' }}">
                    {!! Form::label('batas_antrian', 'Batas Antrian', ['class'=>'col-md-2 control-label']) !!}
                      {!! Form::number('batas_antrian', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Batas Antrian', 'id' => 'batas_antrian','name' => 'batas_antrian']) !!}
                      {!! $errors->first('batas_antrian', '<p class="help-block" id="kode_error" style="color:red;">:message</p>') !!}
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
