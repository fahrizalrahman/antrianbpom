
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Input Gambar Untuk Home Mainbar</h1>
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
              <form role="form" action="{{route('imgHome.storeHome')}} " method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Judul Gambar</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Masukan Judul Gambar">
                    </div>

                    <div class="form-group">
                        <label>Pilih Lantai</label>
                        <select class="form-control" name="lantai">
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>

                    <div class="form-group">
                        <label>Penempatan</label>
                        <select class="form-control" name="type">
                            <option value="ImgHome">Gambar Mainbar</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="file" id="file">
                        </div>
                      </div>
                    </div>
                    
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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
