
@extends('layouts.app_unit')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Petugas</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <!-- Content Header (Page header) -->
            <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Tambah Petugas</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action=" {{route('unit.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            {{-- <div class="form-group">
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
                                </select>
                            </div> --}}
                            <div class="form-group">
                              <label for="unit">Unit</label>
                              <input type="text" class="form-control" id="unit" name="unit" placeholder="Masukan Unit" value="{{Auth::user()->unit }}" required readonly>
                            </div>

                          <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama" required>
                          </div>
                          
                          <div class="form-group">
                              <label for="exampleInputEmail1">E-Mail</label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" required>
                          </div>
  
                          <div class="form-group">
                              <label for="exampleInputEmail1">NIK</label>
                              <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" required>
                          </div>
  
                          <div class="form-group">
                              <label for="exampleInputEmail1">No Telp</label>
                              <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No Telp" required>
                          </div>
  
                          <div class="form-group">
                              <label for="exampleInputEmail1">Alamat</label>
                              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" required>
                          </div>
  
                          <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value=" petugas_loket " placeholder="Masukan Jabatan" readonly required>
                          </div>

                          {{-- <div class="form-group">
                              <label>Pilih Petugas</label>
                              <select class="form-control" name="jabatan">
                                  <option value="petugas_loket">Petugas Loket</option>                              
                              </select>
                          </div> --}}

                          <div class="form-group">
                            <label for="lantai">Lantai</label>
                            <input type="text" class="form-control" id="lantai" name="lantai" placeholder="Masukan Lantai" value=" {{Auth::user()->lantai}} " required>
                          </div>
                        
                        {{-- <div class="form-group">
                            <label>Pilih Lantai</label>
                            <select class="form-control" name="lantai">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div> --}}


                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
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
