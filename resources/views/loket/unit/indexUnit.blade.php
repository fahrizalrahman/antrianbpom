@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="judul">Admin Unit</h1>
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
                <a href="{{route('AdminUnit.create')}}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Admin Unit</a>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Petugas</th>
                  <th>Unit</th>
                  <th>Lantai</th>
                  <th>Email </th>
                  <th>NIK </th>
                  <th>Reset</th>

                   <th style="width:auto">Aksi</th> 
                   {{-- <th>Reset</th> --}}
                </tr>
                </thead>
                <tbody>
                @foreach($AdminUnit as $value)
                 <tr>
                  <td>{{$value->name}}</td>
                  <td>{{$value->unit}} </td>
                  <td>{{$value->lantai}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->nik}}</td>
                  <td align="center">
                      <form action="{{route('AdminUnit.destroy', $value->id)}}" method="POST">
                        <a href="{{ route('AdminUnit.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> |
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="nav-icon fa fa-trash"></i></button>
                      </form>
                  </td>
                  <td align="center">
                   <a href="{{ route('unit.reset', $value->id) }}" class="btn btn-info btn-sm"><i class="nav-icon fa fa-refresh"></i></a> 
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
