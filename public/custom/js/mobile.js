$(document).on('click', '#bt_edit_profile', function(e){
	e.preventDefault();
	if(e.which===1){
		load_content_profile('edit_profile');
	}
});

$(document).ready(function(){
	load_content('landing');
	/*
	window.setTimeout(function(){
		load_content('booking');
	}, 2000);
	*/
});

$(document).on('click', '.booking_layanan', function(e){
	e.preventDefault();
	if(e.which===1){
		booking_layanan($(this).attr('id'), $(this).attr('data'), $(this).attr('jenis'));
	}
});

$(document).on('click', '.box_layanan', function(e){
	e.preventDefault();
	if(e.which===1){
		load_content_data($(this).attr('id'));
	}
});

$(document).on('click', '#bt_back_1', function(e){
	e.preventDefault();
	if(e.which===1){
		load_content_data($(this).attr('data'));
	}
});

$(document).on('click', '#bt_back', function(e){
	e.preventDefault();
	if(e.which===1){
		load_content($(this).attr('data'));
	}
});

$(document).on('click', '#btn_ambil_antrian', function(e){
	e.preventDefault();
	if(e.which===1){
		$.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/mobile/content/booking/booking_antrian',
			data 	: 'q=booking_antrian&data=' + $(this).attr('rowid') + '&jenis=' + $(this).attr('jenis') + '&tanggal=' + $('#ed_tanggal').val(),
			success	: function(data){
				if (data == "hari tidak bisa") {
					swal({
		                html: "Hari ini Tidak Melayani Layanan yang Anda Pilih !!"
		             });
				}else if (data == "sudah tutup"){
					swal({
                          html: "Batas Pengambilan Tiket Sudah Ditutup !!"
                     });
				}else if (data == "belum buka"){
					swal({
                          html: "Batas Pengambilan Tiket Belum Dibuka !!"
                    });
				}else if (data == "tiket habis"){
					swal({
                          html: "Batas Pengambilan Tiket Habis !!"
                    });
				} else if (data == "masih bisa"){
					swal({
                            html :  "Berhasil Mengambil Antrian",
                            showConfirmButton :  false,
                            type: "success",
                            timer: 1000
                        });

				}else if(data == "bulan over"){
					swal({
                          html: "Booking hanya bisa 2 kali dalam sebulan !!"
                    });
				}
				load_content('booking');
			},
			error: function (xhr, ajaxOptions, thrownError){
				alert(xhr.responseText);
				load_content('monitor');
			}
		});
	}
});

function booking_layanan(_content, _data, _jenis){
	$.ajax({
		headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		dataType: 'html',
		url		: '/mobile/content/booking/layanan',
		data 	: 'q=booking&content=' + _content + '&data=' + _data + '&jenis=' + _jenis,
		success	: function(data){
			$(".page_content").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
		}
	});
}

function load_content_profile(_content){
	$.ajax({
		headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		dataType: 'html',
		url		: '/mobile/content/edit/profile',
		data 	: 'q=edit_profile&data=' + _content,
		success	: function(data){
			$(".page_content").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
		}
	});
}

function load_content_data(_content){
	$.ajax({
		headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		dataType: 'html',
		url		: '/mobile/content/load/subcontent',
		data 	: 'q=load_sub_content&data=' + _content,
		success	: function(data){
			$(".page_content").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
		}
	});
}

function load_content(_content){
	$.ajax({
		headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		dataType: 'html',
		url		: '/mobile/content/load',
		data 	: 'q=load_content_data&data=' + _content,
		success	: function(data){
			$(".page_content").html(data);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.responseText);
		}
	});
}

$(document).on('click', '.tm_normal', function(e){
	e.preventDefault();
	if(e.which===1){
		$('.tm_active').addClass('tm_normal');
		$('.tm_normal').removeClass('tm_active')
		$(this).addClass('tm_active').removeClass('tm_normal');
		load_content($(this).attr('data'));
	}
});

 $(document).on('change', '#ed_tanggal', function () { 	
	cek_quota_booking($(this).attr('rowid'), $(this).attr('jenis'), $(this).val());
});

function cek_quota_booking(_data,_jenis,_tanggal){
	 $.ajax({
			headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			dataType: 'html',
			url		: '/mobile/content/cek_quota_booking',
			data 	: 'q=cek_quota_booking&data=' + _data + '&jenis=' + _jenis + '&tanggal=' + _tanggal,
			success	: function(data){
				$('#table_quota').html(data);
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.responseText);
			}
		});
}

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
						headers	: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						dataType: 'html',
						url		: '/mobile/content/update_batal_keterangan',
						data 	: 'q=update_batal_keterangan&ket=' + ket + '&id_antrian=' + id_antrian,
						success	: function(data){
								swal({
									html: 'Berhasil Membatalkan Booking',
		                            showConfirmButton :  false,
		                            type: "success",
		                            timer: 1000
								 });
								  	load_content('monitor');
						},
						error: function (xhr, ajaxOptions, thrownError) {
						swal({
			                 html: "Terjadi Kesalahan , Silakan Hubungi IT"
			             });
					}
				});
}
