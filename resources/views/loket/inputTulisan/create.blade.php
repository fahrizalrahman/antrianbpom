
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Tulisan</h1>
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
                <h3 class="card-title">Isi Tulisan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('inputTulisan.store')}}" role="form" method="POST">
                @csrf
                {{ method_field('post') }}
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Judul Tulisan</label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Judul Tulisan" required>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Isi Tulisan</label>
                    {{-- <input type="text" class="form-control" id="isi" name="isi" placeholder="Masukan Text" required> --}}
                    <textarea name="isi" class="form-control" placeholder="Tuliskan Text" id="isi" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                  <label>Pilih Lantai</label>
                  <select class="form-control" name="lantai">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="monitor">Monitor</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Pilih Letak</label>
                  <select class="form-control" name="float">
                      <option value="footer">Footer</option>
                      <option value="monitor">Monitor</option>
                  </select>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Input Tulisan</button>
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
