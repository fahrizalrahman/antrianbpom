
@extends('layouts.app_unit')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Petugas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Edit Petugas</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action=" {{route('unit.update',$petugas->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="card-body">
                          <div class="form-group">
                              <input type="hidden" class="form-control" name="unit" value="{{$petugas->unit}}"> 
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama</label>
                          <input type="text" class="form-control" value="{{$petugas->name}}" name="name" placeholder="Masukan Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-Mail</label>
                            <input type="email" class="form-control" value="{{$petugas->email}}" name="email" placeholder="Masukan Email">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">NIK</label>
                          <input type="number" minlength="16" maxlength="16" class="form-control" value="{{$petugas->nik}}" name="nik" placeholder="Masukan NIK">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">No Telp</label>
                        <input type="number" maxlength="13" class="form-control" value="{{$petugas->no_telp}}" name="no_telp" placeholder="Masukan no_telp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" value="{{$petugas->alamat}}" name="alamat" placeholder="Masukan Alamat">
                    </div>
                    
                    <div class="form-group">
                        <input type="hidden" class="form-control" value="{{$petugas->lantai}}" name="lantai" placeholder="Lantai" readonly>
                      </div>


                  <div class="form-group">
                    <input type="hidden" class="form-control" value="{{$petugas->password}}" name="password" placeholder="Masukan Password baru">
                  </div>
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                      </div>
                    </form>
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
