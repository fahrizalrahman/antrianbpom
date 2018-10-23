$(document).on('click', '.bt_login', function(e){
	e.preventDefault();
	if(e.which===1){
		$('.bt_register').removeClass('bg-white');
		$('#content_register').hide('fast', function(){
			$('#content_login').show('fast');
		});
		$(this).addClass('bg-white');
	}
});

$(document).on('click', '.bt_register', function(e){
	e.preventDefault();
	if(e.which===1){
		$('.bt_login').removeClass('bg-white');
		$('#content_login').hide('fast', function(){
			$('#content_register').show('fast');
		});
		$(this).addClass('bg-white');
	}
});
