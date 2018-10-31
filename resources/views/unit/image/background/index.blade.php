@extends('layouts.app_unit')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Background Image</h1>
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
                <a href="{{ route('bgunit.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Gambar</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
              <table id="admin" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Title </th>
                  <th>Lantai </th>
                  <th>Type File</th>
                  <th>Status</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>
                {{-- @foreach($Lt1 as $value) --}}
                 <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"></a></td>
                  <td align="center">
                      <form action="#" method="POST">
                        <a href="#" class="btn btn-warning btn-sm"><i class="nav-icon fa fa-wrench"></i></a> || 
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger"><i class="nav-icon fa fa-trash"></i></button>
                      </form>
                  </td>
                </tr>
                {{-- @endforeach --}}
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      </div>
       <!-- The Modal -->
      <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Status</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
              {{-- <form role="form" action="{{route('inputImg.update', $editBtn->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" value="">
                          <option value="Aktif">Aktif</option>
                          <option value="Non-Aktif">Tidak Aktif</option>
                      </select>
                  </div>
              </form> --}}
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>
          </div>
          
        </div>
      </div>
    </div>
    {{-- End Modal --}}
  </section>
  </div>

  <script>
    
  </script>

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
