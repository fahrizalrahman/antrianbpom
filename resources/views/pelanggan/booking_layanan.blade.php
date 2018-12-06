@extends('layouts.app_pelanggan')

@section('content')
  <div class="content-wrapper">

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

          	<!-- Input addon -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Booking Antrian</h3>
              </div>
              <div class="card-body">
              	<label>Kode Loket</label>
                <div class="input-group mb-3">
                  <input type="text" value="{{ $_data->kode }}" readonly class="form-control" placeholder="Kode Loket">
                </div>
                
                <label>Nama Layanan</label>
                <div class="input-group mb-3">			
                  <input type="text"  value="{{ $_data->nama_layanan }}" readonly class="form-control" placeholder="Nama Layanan">
                </div>
                
                @if($jenis==='sub_layanan')
                	<label>Nama Sublayanan</label>
					<div class="input-group mb-3">
	                  <input type="text" value="{{ $_data->nama_sublayanan }}" readonly class="form-control" placeholder="Nama Sublayanan">
	                </div>
				@endif
				<label>Tanggal Booking</label>
                <div class="input-group mb-3">		
                  <input id="datepicker" value="{{ date_format(now(), "m/d/Y") }}" rowid="{{ $rowid }}" jenis="{{ $jenis }}" class="form-control" placeholder="Tanggal Booking">
                </div> 
                
                 <div class="input-group mb-3">		
               			 <span id="table_quota"></span>	 
				</div> 

                <div class="input-group mb-3">
                	<button id="btn_ambil_antrian" rowid="{{ $rowid }}" jenis="{{ $jenis }}" disabled="false" class="btn btn-success ">Ambil Antrian</button>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div><!-- col-md-6 -->
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
	//Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      dateFormat: 'yy-mm-dd'
    })

$( document ).ready(function() {
	var _data = $("#datepicker").attr('rowid');
     	 var _jenis = $("#datepicker").attr('jenis');
		 var date  =	 $("#datepicker").val();
	   	 var _tanggal  = moment(date).format('YYYY-MM-DD')
		 var _tanggal_string  = moment(_tanggal).format('YYYYMMDD');
		 $.ajax({
				headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				dataType: 'html',
				url		: '/mobile/content/cek_tangal_merah',
				data 	: 'q=cek_tangal_merah&tanggal_string=' + _tanggal_string + '&tanggal=' + _tanggal,
				success	: function(data){
					if (data === "Bukan Tanggal Merah") {
						cek_quota_booking(_data,_jenis,_tanggal);
					}else{
						swal({
						      html: data
						});
						$('#table_quota').html('');
						$('#btn_ambil_antrian').attr("disabled",true);

					}
					

				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.responseText);
				}
			});
		 });
		    $(document).on('change', '#datepicker', function () {
		     	var _data = $(this).attr('rowid');
		     	 var _jenis = $(this).attr('jenis');
		     	 var date  =	 $("#datepicker").val();
	   	 		 var _tanggal  = moment(date).format('YYYY-MM-DD')
		     	 

				 var _tanggal_string  = moment(_tanggal).format('YYYYMMDD');
				 $.ajax({
						headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						dataType: 'html',
						url		: '/mobile/content/cek_tangal_merah',
						data 	: 'q=cek_tangal_merah&tanggal_string=' + _tanggal_string + '&tanggal=' + _tanggal,
						success	: function(data){
							if (data === "Bukan Tanggal Merah") {
								cek_quota_booking(_data,_jenis,_tanggal);
							}else{
								swal({
								      html: data
								});
								$('#table_quota').html('');
								$('#btn_ambil_antrian').attr("disabled",true);

							}
							

						},
						error: function (xhr, ajaxOptions, thrownError) {
							alert(xhr.responseText);
						}
					});

		});

     function cek_quota_booking(_data,_jenis,_tanggal){
	 $.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/mobile/content/cek_quota_booking',
			data 	: 'q=cek_quota_booking&data=' + _data + '&jenis=' + _jenis + '&tanggal=' + _tanggal,
			success	: function(data){
				$('#table_quota').html(data);
				$('#btn_ambil_antrian').attr("disabled",false);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
}

$(document).on('click', '#btn_ambil_antrian', function(e){
	e.preventDefault();
	if(e.which===1){
			var date_pesans = $('#datepicker').val()
			var date_pesan = moment(date_pesans).format('YYYY-MM-DD')
			var date  =	new Date();
			var date_now  = moment(date).format('YYYY-MM-DD')
			var date_plus = moment(date_now).add(7 , 'days').format('YYYY-MM-DD');
				if (date_pesan > date_plus || date_pesan < date_now) {
						swal({
				  	           html: "Maaf, Pengambilan waktu booking hanya bisa dilakukan 1 minggu kedepan !!"
				          });
				}else{
					$.ajax({
						headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						dataType: 'html',
						url		: '/mobile/content/booking/booking_antrian',
						data 	: 'q=booking_antrian&data=' + $(this).attr('rowid') + '&jenis=' + $(this).attr('jenis') + '&tanggal=' + date_pesan,
						success	: function(data){
							if (data == "hari tidak bisa") {
								swal({
					                html: "Maaf, Hari Anda Anda Pilih Tidak Melayani Layanan !!"
					             });
							}else if (data == "sudah tutup"){
								swal({
			                          html: "Maaf, Batas Pengambilan Tiket Sudah Ditutup !!"
			                     });
							}else if (data == "belum buka"){
								swal({
			                          html: "Maaf, Batas Pengambilan Tiket Belum Dibuka !!"
			                    });
							}else if (data == "tiket habis"){
								swal({
			                          html: "Maaf, Batas Pengambilan Tiket Habis !!"
			                    });
							} else if (data == "masih bisa"){
								swal({
			                            html :  "Berhasil Mengambil Antrian",
			                            showConfirmButton :  false,
			                            type: "success",
			                            timer: 1000
			                        });
								window.location.href = "{{URL::to('/monitor-tiket')}}/"

							}else if(data == "bulan over"){
								swal({
			                          html: "Booking hanya bisa 2 kali dalam sebulan !!"
			                    });
							}
							
						},
						error: function (xhr, ajaxOptions, thrownError){
							alert(xhr.responseText);
							
						}
					});
				}
		}
});
</script>
@endsection