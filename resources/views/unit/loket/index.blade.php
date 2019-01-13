@extends('layouts.app_unit')

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
                <a href="{{ route('unit-loket.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Layanan</a>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:100px">Loket</th>
                  <th style="width:50px">Kode Antrian</th>
                  <th style="width:200px">Pelayanan</th>
                  <th style="width:100px">Lantai</th>
                  <th style="width:100px">Petugas</th>
                  <th style="width:100px">Buka</th>
                  <th style="width:100px">Tutup</th>
                  <th style="width:100px">Max</th>
                  <th style="width:150px">Aksi</th>
                </tr>
                </thead>
                <tbody id="refresh-table">
                     @foreach($loket as $value)
                      <tr>
                            <td style="width:100px">{{$value->kode}}</td>
                            <td style="width:50px">{{$value->kode_antrian}}</td>
                            <td style="width:200px">{{$value->nama_layanan}}</td>
                            <td style="width:100px">{{$value->lantai}}</td>
                            <td style="width:100px">{{$value->petugas}}</td>
                            <td style="width:100px">{{$value->batas_dari_jam}}</td>
                            <td style="width:100px">{{$value->batas_sampai_jam}}</td>
                            <td style="width:100px">{{$value->batas_antrian}}</td>
                            <td align="center" style="width:150px">
                            <a href="{{ route('unit-loket.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> || 
                            
                             <a href="{{route('unit-loket.delete',$value->id)}}" class="btn btn-danger btn-sm"><i class="nav-icon fa fa-trash"></i></a>
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

