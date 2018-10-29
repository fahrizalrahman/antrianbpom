
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Tulisan Utama</h1>
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
                <h3 class="card-title">Edit Tulisan Utama</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('tulisan.updateUtama', $editUtama->id)}}" role="form" method="POST">
                @csrf
                @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Edit Judul Tulisan</label>
                  <input type="text" class="form-control" value="{{$editUtama->judul}}" id="judul" name="judul" placeholder="Edit Judul Tulisan" required>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Isi Tulisan</label>
                    <textarea name="isi" class="form-control" value="{{$editUtama->isi}}" placeholder="Edit Text" id="isi" cols="30" rows="10">{{$editUtama->isi}}</textarea>
                </div>

                <div class="form-group">
                  <label>Pilih Lantai</label>
                  <select class="form-control" name="lantai" value="{{$editUtama->lantai}}">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="monitor">Monitor</option>
                  </select>
                </div>

                {{-- <div class="form-group">
                  <label>Pilih Letak</label>
                  <select class="form-control" name="float" value="{{$editUtama->float}}">
                      <option value="utama">UTAMA</option>
                  </select>
              </div> --}}

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit Tulisan</button>
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
