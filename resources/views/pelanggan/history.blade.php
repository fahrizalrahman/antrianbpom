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
                <h3>History Antrian</h3>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-responsive">
                <thead>
                <tr>
                  <th style="width:100px;font-size:14px;">Tanggal</th>
                  <th style="width:100px;font-size:14px;">Loket</th>
                  <th style="width:500px;font-size:14px;">Layanan</th>
                  <th style="width:500px;font-size:14px;">Sub Layanan</th>
                  <th style="width:100px;font-size:14px;">Antrian</th>
                  <th style="width:100px;font-size:14px;">Lantai</th>
                  <th style="width:100px;font-size:14px;">Kepuasan</th>
                  <th style="width:300px;font-size:14px;">Lama Proses</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($_data as $data)
                   <?php
                  $mulai = new DateTime($data->mulai);
                  $selesai = new DateTime($data->selesai);

                  $dteDiff  = $mulai->diff($selesai);
                  $survey = array('TIDAK SURVEY','SANGAT PUAS', 'PUAS', 'TIDAK PUAS');
                  ?>
                    <tr>
                      <td style="width:100px;font-size:14px;">{{ $data->tgl_antrian }}</td>
                      <td style="width:100px;font-size:14px;">{{ $data->nama_loket }}</td>
                      <td style="width:500px;font-size:14px;">{{ $data->nama_layanan }}</td>
                      <td style="width:500px;font-size:14px;">{{ $data->nama_loket_sub_layanan }}</td>
                      <td style="width:100px;font-size:14px;">{{ $data->no_antrian }}</td>
                      <td style="width:100px;font-size:14px;">{{ $data->lantai }}</td>
                      <td style="width:100px;font-size:14px;">{{ $survey[$data->kepuasan] }}</td>
                      <td style="width:300px;font-size:14px;">{{ $dteDiff->format("%H:%I:%S") }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

             
             <div class="card-header">
                <h3>History Batal</h3>
              </div>
              <div class="card-body">
              <table id="example2" class="table table-bordered table-responsive">
                <thead>
                <tr style="padding: 0px;margin: 0px;color:white;background-color: red;">
                  <th style="width:300px;font-size:14px;">Tanggal</th>
                  <th style="width:100px;font-size:14px;">Loket</th>
                  <th style="width:500px;font-size:14px;">Layanan</th>
                  <th style="width:500px;font-size:14px;">Sub Layanan</th>
                  <th style="width:100px;font-size:14px;">Antrian</th>
                  <th style="width:100px;font-size:14px;">Lantai</th>
                  <th style="width:100px;font-size:14px;">Status</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($_data_batal as $data_batal)
                   <?php
                  $mulai = new DateTime($data->mulai);
                  $selesai = new DateTime($data->selesai);

                  $dteDiff  = $mulai->diff($selesai);
                  $survey = array('TIDAK SURVEY','SANGAT PUAS', 'PUAS', 'TIDAK PUAS');
                  ?>
                    <tr>
                      <td style="width:300px;font-size:14px;">{{ $data_batal->tgl_antrian }}</td>
                      <td style="width:100px;font-size:14px;">{{ $data_batal->nama_loket }}</td>
                      <td style="width:500px;font-size:14px;">{{ $data_batal->nama_layanan }}</td>
                      <td style="width:500px;font-size:14px;">{{ $data_batal->nama_loket_sub_layanan }}</td>
                      <td style="width:100px;font-size:14px;">{{ $data_batal->no_antrian }}</td>
                      <td style="width:100px;font-size:14px;">{{ $data_batal->lantai }}</td>
                      <td style="width:100px;font-size:14px;">{{ strtoupper($data_batal->status) }}</td>
                    </tr>
                  @endforeach
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

@section('scripts')
        <script>
          $(function () {
            $("#example2").DataTable();
          });
        </script>
@endsection