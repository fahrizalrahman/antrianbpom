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
                <h3>History Data</h3>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table width="100%">
                <thead>
                <tr>
                  
                  <th>Tanggal</th>
                  <th>Loket</th>
                  <th>Layanan</th>
                  <th>Sub Layanan</th>
                  <th>Petugas</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($_data as $data)
                    <tr>
                      <td>{{ $data->tanggal }}</td>
                      <td>{{ $data->nama_loket }}</td>
                      <td>{{ $data->nama_layanan }}</td>
                      <td>{{ $data->sub_layanan }}</td>
                      <td>{{ $data->nama_petugas }}</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <td style="padding-top: 15px" colspan="5">{{ $_data->render() }}</td>
                  </tr>
                </tfoot>
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
<style type="text/css">
table > tbody > tr > td{
  padding: 5px 10px;
  border: 1px solid #aaaaaa;
}
table > thead > tr > th{
  padding: 5px 10px;
  font-weight: bold;
  border: 1px solid #aaaaaa;
  cursor: default;
  background-color: #dddddd;
}
.input_date{
  border: 1px solid #aaaaaa;
  width: 160px;
  height: 30px;
  outline-width: 0px;
  font-family: arial;
  color: black;
  padding: 5px 10px;
}
.input-custom{
  padding: 5px 10px;
}
.label-input{
  font-weight: normal !important;
}
.table-container{
  padding: 10px;
  border: 1px solid #dddddd;
}
</style>
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
