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
        swal({
          html: 'Terima kasih atas survey yang anda berikan!'
          });
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.responseText);
      }
    });
  }
});

$(document).ready(function(){
var _tampil = false;

var es_total = new EventSource('/pelanggan/popup');
es_total.addEventListener('error', function(e) {
  if (e.readyState == EventSource.CLOSED) {
  }
}, false);

es_total.onmessage = function(e) {
  if(!_tampil){
    var _check = e.data;
    if(_check==='1'){
      $.ajax({
        headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'html',
        url   : '/pelanggan/popup/show',
        data  : 'q=show popup',
        success : function(data){
          if(data!=='0'){
            $('body').append(data);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.responseText);
        }
      });
      _tampil = true;
    }else{
      _tampil = true;
    }
  }
}

});