
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Sublayanan</h1>
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
             {!! Form::model($sublayanan, ['url' => route('sublayanan.update', $sublayanan->id), 'method' => 'put']) !!}
            {{csrf_field()}}
                <div class="card-body">


                  <div class="form-group{{ $errors->has('nama_sublayanan') ? ' has-error' : '' }}">
                    {!! Form::label('nama_sublayanan', 'Nama Sublayanan', ['class'=>'col-md-2 control-label']) !!}
                      {!! Form::text('nama_sublayanan', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Nama Sublayanan', 'id' => 'nama_sublayanan' ,'name'=>'nama_sublayanan']) !!}
                      {!! $errors->first('nama_sublayanan', '<p class="help-block" id="nama_layanan_error">:message</p>') !!}
                  </div>


                   <div class="form-group{{ $errors->has('kode_loket') ? ' has-error' : '' }}">
                    {!! Form::label('kode_loket', 'Loket', ['class'=>'col-md-2 control-label']) !!}
                      {!! Form::text('kode_loket', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'Loket', 'id' => 'kode_loket' ,'name'=>'kode_loket']) !!}
                      {!! $errors->first('kode_loket', '<p class="help-block" id="nama_layanan_error">:message</p>') !!}
                  </div>


                       <div class="form-group{{ $errors->has('lantai') ? ' has-error' : '' }}">
                          {!! Form::label('lantai', 'Lantai', ['class'=>'col-md-2 control-label']) !!}
                          <select class="form-control{{ $errors->has('lantai') ? ' is-invalid' : '' }}" id="lantai" name="lantai">
                                    <option value="{{$sublayanan->lantai}}">Lantai {{$sublayanan->lantai}}</option>
                                    <option value="1">Lantai 1 </option>
                                    <option value="2">Lantai 2</option>
                                    <option value="3">Lantai 3</option>
                                    <option value="4">Lantai 4</option>
                                    <option value="5">Lantai 5</option>
                                    <option value="6">Lantai 6</option>
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
                              <option value="{{$sublayanan->id_loket}}">{{$sublayanan->nama_layanan}}</option>
                            </select> 
                        </div>
                      </span>

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
                                    <option value="{{$sublayanan->batas_dari_jam}}">{{$sublayanan->batas_dari_jam}}</option>
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
                                    <option value="{{$sublayanan->batas_sampai_jam}}">{{$sublayanan->batas_sampai_jam}}</option>
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
                      {!! Form::number('batas_antrian', null, ['class'=>'form-control','required','autocomplete'=>'off', 'placeholder' => 'No Loket', 'id' => 'batas_antrian','name' => 'batas_antrian']) !!}
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

@section('scripts')
<script type="text/javascript">
        $(document).on('change', '#lantai', function (e) { 
         var lantai = $(this).val();

          $.get('{{ Url("cek-pilih-lantai") }}',{'_token': $('meta[name=csrf-token]').attr('content'),lantai:lantai}, function(resp){  

            $("#select-layanan").html(resp);
             
          });
    });
</script>
@endsection