@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
          <div class="col-sm-6">
            <h1>Banner Mobile</h1>
          </div>
      </div><!-- /.container-fluid -->
      <div class="card-body">
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @include('layouts._flash')
           <div class="card">
            <div class="card-body">
            
            @if($banner_mobile->count() == 0)
            <a href="{{ route('banner-mobile.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Banner </a>
            @endif
               <br>
               <br>
              <table id="admin" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul Banner </th>
                  <th>Gambar Banner</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($banner_mobile->get() as $value)
                 <tr>
                  <td>{{$value->judul_banner}}</td>
                  <td><img src="{{asset('gambar_banner/'.$value->gambar_banner.'')}}"></td>
                  <td><a href="{{ route('banner-mobile.edit', $value->id) }}" class="btn btn-primary">Edit</a></td>
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
