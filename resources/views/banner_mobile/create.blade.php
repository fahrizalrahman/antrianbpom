
@extends('layouts.app_admin')
@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Banner Mobile</h1>
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
                <h3 class="card-title">Isi Banner</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('banner-mobile.store')}}" role="form" method="POST"  enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Judul Banner</label>
                  <input type="text" class="form-control" id="judul_banner" name="judul_banner" placeholder="Masukan Judul Tulisan" required>
                </div>
                
                <div class="form-group">
                <label for="name">Gambar Banner</label>
                      <input type="file" name="gambar_banner" class="form-control">
                </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
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
