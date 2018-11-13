@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mainbar Home Image</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="card-body">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fa fa-ban"></i> Informasi !</h5>
            Gambar atau Video yang diupload pada halaman (<i>Gambar Mainbar</i>) ini akan ditampilkan dilayar utama bagian tengah di masing-masing lantai. 
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @include('layouts._flash')
           <div class="card">
            <div class="card-header">
                <a href="{{ route('imgHome.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Gambar</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                
              <table id="admin" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Title </th>
                  <th>Lantai </th>
                  <th>Status</th>
                  <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ImgHome as $value)
                 <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->title}}</td>
                  <td>{{$value->lantai}}</td>
                  <td><a href="{{ route('indexImg.editBtn', $value->id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">{{$value->status}}</a></td>
                  <td align="center">
                      <form action="{{route('inputImg.destroy', $value->id)}}" method="POST">
                       
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger"><i class="nav-icon fa fa-trash"></i></button>
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
