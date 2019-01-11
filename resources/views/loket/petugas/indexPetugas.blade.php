@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="judul">Admin / Petugas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @include('layouts._flash')
           <div class="card">
            <div class="card-header">
                <a href="{{ route('petugas.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Petugas</a>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="admin" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th >ID</th>
                  <th >Petugas</th>
                  <th >No Telp</th>
                  <th >Jabatan</th>
                  <th >Lantai</th>
                  <th >Unit</th>
                  <th style="width:100px">Aksi</th> 
                  <th >Reset</th>
                </tr>
                </thead>
                <tbody>
                @foreach($petugas as $value)
                 <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->name}}</td>
                  <td>{{$value->no_telp}}</td> 
                  <td>{{$value->jabatan}}</td>
                  <td>{{$value->lantai}}</td>
                  <td>{{$value->unit}}</td>
                  
                  <td>
                      
                        <a href="{{ route('petugas.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> |  <a href="{{ route('loket.delete',$value->id) }}" class="btn btn-danger btn-sm"><i class="nav-icon fa fa-trash"></i></a>
                  </td>
                  <td><a href="{{ route('reset', $value->id) }}" class="btn btn-info btn-sm"><i class="nav-icon fa fa-refresh"></i></a> 
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
