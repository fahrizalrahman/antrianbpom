@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
           <div class="card">
            <div class="card-header">
                <a href="{{ route('user.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah User</a>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>E-Mail</th>
                  <th>Jabatan</th>
                  <th>Lantai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Petugas as $value)
                 <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->nama}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->jabatan}}</td>
                  <td>{{$value->lantai}}</td>
                  <td><a href="{{ route('user.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> || 
                        <form action=" {{route('user.destroy', $value->id)}}" method="POST" class="btn btn-danger btn-sm"><i class="nav-icon fa fa-trash"></i>
                          @csrf
                          {{ method_field('DELETE') }}
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
