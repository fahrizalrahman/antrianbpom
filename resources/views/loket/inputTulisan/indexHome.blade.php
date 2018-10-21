@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home Text</h1>
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
                <a href="{{ route('tulisan.createUtama') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Tulisan</a>
            
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
                @foreach($tampilTulHome as $value)
                 <tr>
                  <td width="200px">{{$value->judul}}</td>
                  <td width="700px">{{$value->isi}}</td>
                  <td align="center" width="100px">{{$value->lantai}}</td>
                  <td align="center" width="100px">
                    <a href="{{ route('inputTulisan.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> || 
                    
                     <a href="{{route('loket.delete',$value->id)}}" class="btn btn-danger btn-sm"><i class="nav-icon fa fa-trash"></i></a>

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
