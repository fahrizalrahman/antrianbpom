@extends('layouts.app_pelanggan')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         <div class="col-md-12 col-sm-12">
              <div class="card">

              <div class="card-header">
                <h3>Monitoring Tiket</h3>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-hover table-bordered table-responsive">
                <thead>
                <tr>
                  
                  <th>Layanan</th>
                  <th>Loket</th>
                  <th>Sublayanan</th>
                  <th>Loket</th>
                  <th>Lantai</th>
                  <th>No Antrian Anda</th>
                  <th>No Antrian Sekarang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @if($monitor_tiket->count() < 1)
                  <tr>
                    <td colspan="6"><center>Belum Ada Antrian</center></td></tr>
                  @else
                  @foreach ($monitor_tiket->get() as $monitor_lokets)

                  <?php $no_antrian_sekarang = \App\Antrian::where('status','dipanggil')->where('id_loket',$monitor_lokets->id_loket)->orderBy('id','desc')?>

                 <tr>
                  <td>{{$monitor_lokets->nama_layanan}}</td>
                  <td>{{$monitor_lokets->kode}}</td>
                  <td>{{$monitor_lokets->nama_sublayanan}}</td>
                  <td>{{$monitor_lokets->kode_loket}}</td>
                  <td>{{$monitor_lokets->lantai}}</td>
                  <td>{{$monitor_lokets->kode_antrian}}{{$monitor_lokets->no_antrian}}</td>
                   
                  @if($no_antrian_sekarang->count() == 0)
                  <td style="background-color:red;color:white;"><center><h5>Tidak Ada Panggilan</h5></center></td>
                  @elseif($no_antrian_sekarang->first()->no_antrian == $monitor_lokets->no_antrian)
                  <td style="background-color:green;color:white;"><center><h5>Panggilan Anda</h5></center></td>
                  @else
                  <td><center><h4>{{$no_antrian_sekarang->first()->kode_antrian}}{{$no_antrian_sekarang->first()->no_antrian}}</h4></center></td>
                  @endif
                  <td><a href="{{ route('lihat-tiket',$monitor_lokets->id) }}" style="background-color:#17A2B8;color:white;" class="btn btn-sm"><i class="nav-icon fa fa-eye" ></i> Lihat Tiket</a></td>
                </tr>
                @endforeach
                @endif
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              </div>
            </div>
            <!-- /.card -->
         </div><!-- penutup div col sm -->
    </div>
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
