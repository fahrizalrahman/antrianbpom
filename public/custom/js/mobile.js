$(document).on('click', '#bt_edit_profile', function(e){
	e.preventDefault();
	if(e.which===1){
		load_content_profile('edit_profile');
	}
});

$(document).ready(function(){
	load_content('landing');
	window.setTimeout(function(){
		load_content('booking');
	}, 2000);
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
		load_content('booking');
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
				alert(data);
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
