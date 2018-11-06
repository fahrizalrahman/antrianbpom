             <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Tambah Perorangan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('user.store')}}" role="form" method="POST" data-parsley-validate>
                        @csrf
                        {{ method_field('post') }}
                      <div class="card-body">
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
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" maxlength="16" minlength="16" required>
                        @if ($errors->has('nik'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('nik') }}</strong>
                                </span>
                               @endif
                        </div>

                        <div class="form-group">
                            <label for="no_telp">No Telp</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No Telp" required>
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
                var mincar = 16;
                if (form.nik.value.length < mincar){
                  alert("Panjang Angka NIK Harus 16 Karater!");
                  form.nik.focus();
                  return (false);
                }
                 return (true);
              }
    
              </script> --}}