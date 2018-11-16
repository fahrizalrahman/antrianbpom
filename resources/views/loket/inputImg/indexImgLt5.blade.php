@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gambar Utama Lantai 5</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="card-body">
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fa fa-ban"></i> Informasi !</h5>
            Gambar atau Video yang diupload pada halaman (<i>Gambar Utama</i>) ini akan ditampilkan dilayar utama masing-masing lantai. 
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @include('layouts._flash')
           <div class="card">
            <div class="card-header">
                <a href="{{ route('inputImg.create') }}" class="btn btn-primary" type="button" ><i class="nav-icon fa fa-plus"></i> Tambah Gambar</a>
                <a href="{{route('inputImg.index')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 1</a>
                <a href="{{route('loket.inputImg.indexImgLt2')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 2</a>
                <a href="{{route('loket.inputImg.indexImgLt3')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 3</a>
                <a href="{{route('loket.inputImg.indexImgLt4')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 4</a>
                <a href="{{route('loket.inputImg.indexImgLt5')}}" id="admin_filter" class="btn btn-danger">Lantai 5</a>
                <a href="{{route('loket.inputImg.indexImgLt6')}}" id="admin_filter" class="btn btn-outline-primary">Lantai 6</a>
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
                @foreach($Lt5 as $value)
                 <tr>
                  <td>{{$value->id}}</td>
                  <td>{{$value->title}}</td>
                  <td>{{$value->lantai}}</td>
                  <td>{{$value->type}}</td>
                  <td><button data-id="{{$value->id}}" class="btn btn-success btn-sm ">{{$value->status}}</button></td>
                  <td align="center">
                    
                          <button data-id="{{$value->id}}" class="btn btn-primary btn-sm bt_on">On</button>
                          <button data-id="{{$value->id}}" class="btn btn-danger btn-sm bt_off">Off</button>
                          <button data-id="{{$value->id}}" class="btn btn-warning btn-sm bt_del">Del</button>
                      
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

@section('scripts')

<script type="text/javascript">
$(document).on('click', '.bt_on', function(e){
	e.preventDefault();
	if(e.which===1){
		if(confirm('Yakin Aktifkan File?')){
			$.ajax({
				headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				dataType: 'html',
				url		: '/proses/image/status',
				data 	: 'q=proses aktif&data=' + $(this).attr('data-id'),
				success	: function(data){
					if(data.length > 0){
						alert('Data berhasil Di Aktifkan');
					}
          location.reload();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText);
				}
			});
		}
	}
});

$(document).on('click', '.bt_off', function(e){
	e.preventDefault();
	if(e.which===1){
		if(confirm('Yakin Ingin Non-Aktifkan File ?')){
			$.ajax({
				headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				dataType: 'html',
				url		: '/proses/image/status',
				data 	: 'q=proses non&data=' + $(this).attr('data-id'),
				success	: function(data){
					if(data.length > 0){
						alert('File berhasil Di Non-Aktifkan');
					}
          location.reload();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText);
				}
			});
		}
	}
});

$(document).on('click', '.bt_del', function(e){
	e.preventDefault();
	if(e.which===1){
		if(confirm('Yakin Ingin Menghapus Gambar/Video ?')){
			$.ajax({
				headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				dataType: 'html',
				url		: '/proses/image/status',
				data 	: 'q=proses del&data=' + $(this).attr('data-id'),
				success	: function(data){
					if(data.length > 0){
						alert('Data berhasil Dihapus !');
					}
          location.reload();
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText);
				}
			});
		}
	}
});
</script>
@endsection