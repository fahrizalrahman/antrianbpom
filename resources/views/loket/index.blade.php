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
              
               <?php for ($x = 1; $x <= 6; $x++) { ?>
                  <button type="button" class="btn btn-default btn-lantai"  style="background-color:#17A2B8;color:white;" data-lantai="{{$x}}">lantai {{$x}}</button>
                <?php } ?>
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
                <tbody id="refresh-table">

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


@section('scripts')
<script type="text/javascript">
      $(document).ready(function() {

          $.get('{{ Url("table-lantai-layanan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),data_lantai:1}, function(resp){

            $("#refresh-table").html(resp);
             
          });
    });
      
        $(document).on('click', '.btn-lantai', function (e) { 
         var data_lantai = $(this).attr('data-lantai');

          $.get('{{ Url("table-lantai-layanan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),data_lantai:data_lantai}, function(resp){  

            $("#refresh-table").html(resp);
            $(this).attr('style','background-color:#ffffff;');
             
          });
    });
</script>
@endsection
