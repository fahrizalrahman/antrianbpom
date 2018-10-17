@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="judul">Layanan</h1>
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
                <a href="{{ route('loket.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Layanan</a>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Loket</th>
                  <th>Pelayanan</th>
                  <th>Lantai</th>
                  <th>Petugas</th>
                  <th>Buka</th>
                  <th>Tutup</th>
                  <th>Max</th>
                  <th width="75px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($loket as $value)
                 <tr>
                  <td>{{$value->kode}}</td>
                  <td>{{$value->nama_layanan}}</td>
                  <td>{{$value->lantai}}</td>
                  <td>{{$value->petugas}}</td>
                  <td>{{$value->batas_dari_jam}}</td>
                  <td>{{$value->batas_sampai_jam}}</td>
                  <td>{{$value->batas_antrian}}</td>
                  <td align="center">
                    <a href="{{ route('loket.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> || 
                    
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
