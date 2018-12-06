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
                <h3>Monitoring Tiket</h3>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-responsive">
                <thead>
                <tr>
                  <th style="width:200px;font-size:15px;">Tanggal</th>    
                  <th style="width:500px;font-size:15px;">Layanan</th>
                  <th style="width:100px;font-size:15px;">Loket</th>
                  <th style="width:100px;font-size:15px;">Sublayanan</th>
                  <th style="width:100px;font-size:15px;">Loket</th>
                  <th style="width:100px;font-size:15px;">Lantai</th>
                  <th style="width:100px;font-size:15px;">Antrian</th>
                  <th style="width:100px;font-size:15px;">Saat Ini</th>
                  <th style="width:100px;font-size:15px;">Aksi</th>
                  <th style="width:100px;font-size:15px;">Batal</th>
                </tr>
                </thead>
                <tbody>
                  @if($monitor_tiket->count() < 1)
                  <tr>
                    <td colspan="8" style="background-color:grey;"><center><b >Belum Ada Antrian</b></center></td></tr>
                  @else
                  @foreach ($monitor_tiket->get() as $monitor_lokets)

                  <?php $no_antrian_sekarang = \App\Antrian::where('status','dipanggil')->where('id_loket',$monitor_lokets->id_loket)->orderBy('id','desc')?>

                 <tr>
                  <td style="width:200px;font-size:14px;">{{$monitor_lokets->tgl_antrian}}</td>
                  <td style="width:500px;font-size:14px;">{{$monitor_lokets->nama_layanan}}</td>
                  <td style="width:100px;font-size:14px;">{{$monitor_lokets->kode}}</td>
                  <td style="width:100px;font-size:14px;">{{$monitor_lokets->nama_sublayanan}}</td>
                  <td style="width:100px;font-size:14px;">{{$monitor_lokets->kode_loket}}</td>
                  <td style="width:100px;font-size:14px;">{{$monitor_lokets->lantai}}</td>
                  <td style="width:100px;font-size:14px;">{{$monitor_lokets->kode_antrian}}{{$monitor_lokets->no_antrian}}</td>
                   
                  @if($no_antrian_sekarang->count() == 0)
                  <td style="width:500px;font-size:14px;background-color:red;color:white;"><center><p>Tidak Ada Panggilan</p></center></td>
                  @elseif($no_antrian_sekarang->first()->no_antrian == $monitor_lokets->no_antrian)
                  <td style="width:500px;font-size:14px;background-color:green;color:white;"><center><p>Panggilan Anda</p></center></td>
                  @else
                  <td style="width:500px;font-size:14px;" ><center><p>{{$no_antrian_sekarang->first()->kode_antrian}}{{$no_antrian_sekarang->first()->no_antrian}}</p></center></td>
                  @endif
                  <td style="width:100px;font-size:14px;"><a href="{{ route('lihat-tiket',$monitor_lokets->id) }}" style="background-color:#17A2B8; color:white;" class="btn btn-sm"><i class="nav-icon fa fa-eye" ></i> Lihat</a>
                  <td style="width:100px;font-size:14px;">
                 @if($monitor_lokets->hitung_mundur < -11)
                    <button id="btn_batal_booking" data-id="{{ $monitor_lokets->id }}" class="btn btn-danger btn-sm"> <i class="nav-icon fa fa-remove" ></i> Batal</button>
                  @else
                    <button id="btn_batal_booking" disabled="true" data-id="{{ $monitor_lokets->id }}" class="btn btn-danger btn-sm"> <i class="nav-icon fa fa-remove" ></i> Batal</button>
                  @endif
                </td>
            </td>
                </tr>
                @endforeach
                @endif
                </tbody>
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
  $(document).on('click', '#btn_batal_booking', function(e){
  var id_antrian = $(this).attr('data-id');
  e.preventDefault();
  if(e.which===1){
    swal({
      title: 'Apakah Anda Ingin Membatalkan Booking , Silakan Tulis Keterangan Alasan',
      input: 'select',
      inputOptions: {
        'Keperluan Mendadak': 'Keperluan Mendadak',
        'Sakit': 'Sakit',
        'Alasan Lain': 'Alasan Lain'
      },
      inputPlaceholder: '-- Pilih Alasan --',
      showCancelButton: true,
      inputValidator: (value) => {
        return new Promise((resolve) => {
          if (value === 'Alasan Lain') {
             swal({
            input: 'text',
            inputPlaceholder:'Isi Alasan Disini ...',
          }).then(function (text) {
              update_keterangan(String(text.value),id_antrian);
          })
          }else{
            update_keterangan(value,id_antrian);
          }
        })
      }
    })
  }
});



function update_keterangan(ket,id_antrian){           
          $.ajax({
            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'html',
            url   : '/mobile/content/update_batal_keterangan',
            data  : 'q=update_batal_keterangan&ket=' + ket + '&id_antrian=' + id_antrian,
            success : function(data){
                swal({
                  html: 'Berhasil Membatalkan Booking',
                                showConfirmButton :  false,
                                type: "success",
                                timer: 1000
                 });
                window.location.href = "{{URL::to('/monitor-tiket')}}"
            },
            error: function (xhr, ajaxOptions, thrownError) {
            swal({
                       html: "Terjadi Kesalahan , Silakan Hubungi IT"
                });
          }
        });
}
</script>
@endsection