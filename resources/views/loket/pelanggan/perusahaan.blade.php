            <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Tambah Perusahaan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('store-perusahaan')}}" role="form" method="POST" onsubmit="return validasi_input(this)">
                        @csrf
                        {{ method_field('post') }}
                      <div class="card-body">

                         <div class="form-group">
                            <label for="npwp">NPWP</label>
                            <input type="text" class="form-control" id="npwp" name="npwp" placeholder="Masukan No NPWP" minlength="20" maxlength="20" required>
                           @if ($errors->has('npwp'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('npwp') }}</strong>
                                </span>
                               @endif
                        </div>

                         <div class="form-group">
                          <label for="nama_perusahaan">Nama Perusahaan</label>
                          <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukan Nama" required>
                          @if ($errors->has('npwp'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('npwp') }}</strong>
                                </span>
                               @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="email_perusahaan">E-Mail Perusahaan</label>
                            <input type="email" class="form-control" id="email_perusahaan" name="email_perusahaan" placeholder="Masukan Email Perusahaan" required>
                        @if ($errors->has('email_perusahaan'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email_perusahaan') }}</strong>
                                </span>
                               @endif
                        </div>

                        <div class="form-group">
                            <label for="no_telp_perusahaan">No Telp Perusahaan</label>
                            <input type="number" class="form-control" id="no_telp_perusahaan" name="no_telp_perusahaan" placeholder="Masukan No Telp Perusahaan" required>
                        @if ($errors->has('no_telp_perusahaan'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('no_telp_perusahaan') }}</strong>
                                </span>
                               @endif
                        </div>

                        <div class="form-group">
                            <label for="alamat_perusahaan">Alamat Perusahaan</label>
                            <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukan Alamat Perusahaan" required>
                        @if ($errors->has('alamat_perusahaan'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('alamat_perusahaan') }}</strong>
                                </span>
                               @endif
                        </div>

                        <div class="form-group">
                          <label for="name">Nama</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Masukan Nama" required>
                        @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('name') }}</strong>
                                </span>
                               @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" required>
                        @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                                </span>
                               @endif
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" minlength="16" maxlength="16" required>
                        @if ($errors->has('nik'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('nik') }}</strong>
                                </span>
                               @endif
                        </div>

                        <div class="form-group">
                            <label for="no_telp">No Telp</label>
                            <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No Telp" required>
                         @if ($errors->has('no_telp'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('no_telp') }}</strong>
                                </span>
                               @endif
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" required>
                        @if ($errors->has('alamat'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                               @endif
                        </div>

                     
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>

            {{-- <script type="text/javascript">
              function validasi_input(form){
                var maxcar = 20;
                if (form.npwp.value.length < maxcar){
                  alert("Panjang Angka NPWP Harus 20 Karater!");
                  form.npwp.focus();
                  return (false);
                }
                 return (true);
              }
            </script> --}}
