@extends('layouts.app_unit')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="judul">Petugas</h1>
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
                <a href="{{ route('unit.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Petugas</a>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped table-responsive">
                <thead>
                <tr>
                  <th style="width:200px;">Petugas</th>
                  <th style="width:300px;">Email </th>
                  <th style="width:100px;">NIK </th>
                  <th style="width:100px;">No Telp</th>
                  <th style="width:400px;">Unit</th>
                  <th style="width:50px;">Lantai</th>
                  <th style="width:100px;">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($petugas as $value)
                 <tr>
                  <td>{{$value->name}}</td>
                  <td>{{$value->email}}</td>
                  <td>{{$value->nik}}</td>
                  <td>{{$value->no_telp}}</td> 
                  @if($value->unit == "Direktorat_Pengawasan_Keamanan")
                  <td>Direktorat Pengawasan Keamanan, Mutu dan Ekspor Impor Obat, Narkotika, Psikotropika, Prekursor dan Zat Adiktif</td>
                  @elseif($value->unit == "Direktorat_Pengawasan_Produksi_Obat")
                  <td>Direktorat Pengawasan Produksi Obat, Narkotika, Psikotropika dan Prekursor</td>
                  @elseif($value->unit == "Pusat_Pengembangan")
                  <td>Pusat Pengembangan Pengujian Obat dan Makanan Nasional</td>
                  @elseif($value->unit == "Biro_Hubungan_Masyarakat")
                  <td>Biro Hubungan Masyarakat dan Dukungan Strategis Pimpinan</td>
                  @elseif($value->unit == "Pusat_Data_Informasi")
                  <td>Pusat Data dan Informasi Obat & Makanan</td>
                  @elseif($value->unit == "Direktorat_Registrasi_Obat")
                  <td>Direktorat Registrasi Obat Tradisional, Suplemen Kesehatan dan Kosmetik</td>
                  @elseif($value->unit == "Direktorat_Obat")
                  <td>Direktorat Registrasi Obat</td>
                  @elseif($value->unit == "Direktorat_Registrasi_Pangan")
                  <td>Direktorat Registrasi Pangan Olahan</td>
                  @endif
                  <td>{{$value->lantai}}</td>
                  <td style="width:100px">
                        <a href="{{ route('unit.edit', $value->id) }}" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> |
                        <a href="{{route('unit.delete', $value->id)}}" class="btn btn-danger btn-sm"><i class="nav-icon fa fa-trash"></i></a>
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

<script>
    $(function () {
    $("#example1").DataTable();
    });
  </script>

<style type="text/css">
table.dataTable thead tr {
  padding: 0px;
  margin: 0px;
  color: white;
  background-color: green;
}
</style>
@endsection
