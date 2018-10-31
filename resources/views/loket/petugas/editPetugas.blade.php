
@extends('layouts.app_admin')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Petugas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Edit Petugas</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action=" {{route('petugas.update',$editPetugas->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                      <div class="card-body">
                          <div class="form-group">
                              <label>Pilih Unit</label>
                              <select class="form-control" name="unit">
                                  <option value="Direktorat_Pengawasan_Keamanan">Direktorat Pengawasan Keamanan, Mutu dan Ekspor Impor Obat, Narkotika, Psikotropika, Prekursor dan Zat Adiktif</option>
                                  <option value="Direktorat_Pengawasan_Produksi_Obat">Direktorat Pengawasan Produksi Obat, Narkotika, Psikotropika dan Prekursor</option>
                                  <option value="Pusat_Pengembangan">Pusat Pengembangan Pengujian Obat dan Makanan Nasional</option>
                                  <option value="Biro_Hubungan_Masyarakat">Biro Hubungan Masyarakat dan Dukungan Strategis Pimpinan</option>
                                  <option value="Pusat_Data_Informasi">Pusat Data dan Informasi Obat & Makanan</option>
                                  <option value="Direktorat_Registrasi_Obat">Direktorat Registrasi Obat Tradisional, Suplemen Kesehatan dan Kosmetik</option>
                                  <option value="Direktorat_Obat">Direktorat Obat</option>
                                  <option value="Direktorat_Registrasi_Pangan">Direktorat Registrasi Pangan Olahan</option>
                                  <option value="Pengawasan_Produksi_ONPP">Pengawasan Produksi ONPP</option>
                                  <option value="Standart_Pangan">Standart Pangan</option>
                                  <option value="Distribusi_ONPP">Distribusi ONPP</option>
                              </select>
                          </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama</label>
                          <input type="text" class="form-control" value="{{$editPetugas->name}}" name="name" placeholder="Masukan Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-Mail</label>
                            <input type="email" class="form-control" value="{{$editPetugas->email}}" name="email" placeholder="Masukan Email">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">NIK</label>
                          <input type="text" class="form-control" value="{{$editPetugas->nik}}" name="nik" placeholder="Masukan NIK">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">No Telpn</label>
                        <input type="text" class="form-control" value="{{$editPetugas->no_telp}}" name="no_telp" placeholder="Masukan no_telp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" class="form-control" value="{{$editPetugas->alamat}}" name="alamat" placeholder="Masukan Alamat">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lantai</label>
                        <input type="text" class="form-control" value="{{$editPetugas->lantai}}" name="lantai" placeholder="Lantai" readonly>
                      </div>
                  {{-- <div class="form-group">
                      <label>Pilih Lantai</label>
                      <select class="form-control" value="{{$editPetugas->lantai}}" name="lantai">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                      </select>
                  </div> --}}

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" value="{{$editPetugas->password}}" name="password" placeholder="Masukan Password baru">
                  </div>
                      </div>
                      <!-- /.card-body -->
      
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                      </div>
                    </form>
                  </div>
                
             {!! Form::close() !!}
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
