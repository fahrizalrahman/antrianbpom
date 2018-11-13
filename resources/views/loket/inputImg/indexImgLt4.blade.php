@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gambar Utama Lantai 4</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="card-body">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fa fa-ban"></i> Informasi !</h5>
            Gambar atau Video yang diupload pada halaman (<i>Gambar Utama</i>) ini akan ditampilkan dilayar utama masing-masing lantai. 
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @include('layouts._flash')
           <div class="card">
            <div class="card-header">
                <a href="{{ route('inputImg.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Gambar</a>
                <a href="{{route('inputImg.index')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 1</a>
                <a href="{{route('loket.inputImg.indexImgLt2')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 2</a>
                <a href="{{route('loket.inputImg.indexImgLt3')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 3</a>
                <a href="{{route('loket.inputImg.indexImgLt4')}}" id="admin_filter" class="btn btn-danger">Lantai 4</a>
                <a href="{{route('loket.inputImg.indexImgLt5')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 5</a>
                <a href="{{route('loket.inputImg.indexImgLt6')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 6</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="admin" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Title </th>
                  <th>Lantai </th>
                  <th>Type File</th>
                  <th>Status</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Lt4 as $value)
                 <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->title}}</td>
                  <td>{{$value->lantai}}</td>
                  <td>{{$value->type}}</td>
                  <td><a href="{{ route('indexImg.editBtn', $value->id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">{{$value->status}}</a></td>
                  <td align="center">
                      <form action="{{route('inputImg.destroy', $value->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger"><i class="nav-icon fa fa-trash"></i></button>
                      </form>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
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
