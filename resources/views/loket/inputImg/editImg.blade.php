
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit File</h1>
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
              <form role="form" action="{{route('inputImg.update', $updateFile->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Judul File</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{$updateFile->title}} " placeholder="Masukan Judul">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Lantai</label>
                        <input type="text" class="form-control" id="lantai" name="lantai" value="{{$updateFile->lantai}} " readonly>
                      </div>
                    </div> 
                    
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" value="{{$updateFile->status}} ">
                          <option value="Aktif">Aktif</option>
                          <option value="Non-Aktif">Tidak Aktif</option>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Type</label>
                      <input type="text" class="form-control" id="type" name="type" value="{{$updateFile->type}} " readonly>
                    </div>
              
                  {{-- <div class="form-group">
                      <label>Type</label>
                      <select class="form-control" name="type" value="{{$updateFile->type}} " readonly>
                          <option value="1" {{$updateFile->type}}>Video</option>
                          <option value="0" {{$updateFile->type}}>Image</option>
                      </select>
                  </div> --}}

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
