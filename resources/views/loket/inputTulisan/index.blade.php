@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Running Text</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="card-body">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fa fa-ban"></i> Informasi !</h5>
            Tulisan yang diinputkan pada halaman (<i>Running Text</i>) ini akan ditampilkan dilayar utama bagian bawah sebagai text berjalan di masing-masing lantai. 
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @include('layouts._flash')
           <div class="card">
            <div class="card-header">
                <a href="{{ route('inputTulisan.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Tulisan</a>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="admin" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Isi Tulisan</th>
                  <th>Lantai</th>
                  <th >Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tampilTulisan as $value)
                 <tr>
                  <td width="150px">{{$value->judul}}</td>
                  <td width="900px">{{$value->isi}}</td>
                  <td width="150px">{{$value->lantai}}</td>
                  <td align="center">
                    <form action="{{route('inputTulisan.destroy', $value->id)}}" method="POST">
                      <a href="{{ route('inputTulisan.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> || 
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
