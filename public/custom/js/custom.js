$(document).on('click', '.bt_sangat_puas, .bt_puas, .bt_tidak_puas', function(e){
  e.preventDefault();
  if(e.which===1){
    $.ajax({
      headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: 'html',
      url   : '/pelanggan/popup/survey',
      data  : 'q=popup&data=' + $(this).attr('data') + '&rowid=' + $('#survey_container').attr('data'),
      success : function(data){
        $('#survey_container').remove();
        alert('Terima kasih atas survey yang anda berikan!');
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
      }
    });
  }
});

$(document).ready(function(){
var _check = false;

setInterval(function(){
  if(!_check){
  $.ajax({
      headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: 'html',
      url   : '/pelanggan/popup',
      data  : 'q=popup',
      success : function(data){
        if(data!==''){
          $('body').append(data);
          _check = true;
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
      }
    });
  }
  }, 3000);

});
