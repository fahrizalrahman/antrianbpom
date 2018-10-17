<div id="survey_container" data="{{ $_check->rowid }}" style="position: fixed; top: 0px; left: 0px; right: 0px; bottom: 0px; background-color: rgba(0,0,0,0.75); z-index: 99999">
  <div class="emotion_container">
    <label class="lb_judul_survey">Survey Kepuasan Pelanggan</label>
    <label class="lb_judul_survey ed_layanan"></label>
    <div style="text-align: center; width: 100%;">
      <button data="1" class="bt_sangat_puas btn btn-success"><span class="fa fa-smile-o"></span> Sangat Puas</button>
      <button data="2" class="bt_puas btn btn-primary"><span class="fa fa-meh-o"></span> Puas</button>
      <button data="3" class="bt_tidak_puas btn btn-danger"><span class="fa fa-frown-o"></span> Tidak Puas</button>
    </div>
  </div>
</div>

<style type="text/css">
@media screen and (max-width: 700px){
  .emotion_container{
    position: fixed; top: calc(50% - 125px); left: 0px; right: 0px; height: auto; background-color: white; border: 3px solid darkGreen; box-shadow: 0px 0px 10px white; padding: 20px
  }
}

@media screen and (min-width: 701px){
  .emotion_container{
    position: fixed; top: 25px; left: 25px; right: 25px; bottom: 25px; background-color: white; border: 3px solid darkGreen; box-shadow: 0px 0px 10px white; padding: 20px
  }
}

button > span{
  font-size: 32pt !important;
  color: white;
  display: block !important;
}
table > tr > td{
  padding: 50px;
}
.lb_judul_survey{
  width: 100%;
  text-align: center;
  font-size: 12pt;
  color: black;
}  
</style>