
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Gambar Utama</h1>
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
              <form role="form" action="{{route('gambar-utama.update', $edit_gambar->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Judul Gambar</label>
                      <input type="text" class="form-control" id="judul_gambar" name="judul_gambar" value="{{$edit_gambar->judul_gambar}} " placeholder="Masukan Judul">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Lantai</label>
                      <input type="text" class="form-control" id="lantai" name="lantai" value="{{$edit_gambar->lantai}} " readonly>
                    </div>

                    <div class="form-group">
                      <label for="name">Gambar Utama</label>
                      <input type="file" name="gambar" value="{{$edit_gambar->gambar}}" class="form-control">
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
