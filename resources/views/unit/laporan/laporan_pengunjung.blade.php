@extends('layouts.app_unit')

@section('content')
<div class="content-wrapper">


	   <!-- The Modal 1-->
<div class="modal" id="myModal1" >
  <div class="modal-dialog modal-lg" >
    <div class="modal-content" style="color:black;">

      <!-- Modal Header -->
      <div class="modal-header" >
        <h4 class="modal-title"><span id="nama-pelanggan-kunjungan"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" >
      	<div class="col-md-12">
				<table  class="table table-bordered table-striped table-responsive">
					<thead>
						<tr>
							<th style="width:200px;"> Tanggal</th>
							<th style="width:200px;"> Loket</th>
							<th style="width:200px;"> Layanan</th>
							<th style="width:200px;"> Sub Layanan</th>
							<th style="width:200px;"> Petugas</th>
							<th style="width:200px;"> Kepuasan</th>
						</tr>
					</thead>
					<tbody id="refresh-list-kunjungan">
					</tbody>
				</table>
			</div>
		<div class="modal-footer">
			<h4>Total Kunjungan : <span id="count-list-kunjungan"></span></h4>
		</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!--modal 1-->



	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h3 class="judul">Laporan Pengunjung</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-container">
						<div class="row">
							<div class="col-md-12">
								<label class="label-input"><strong>Filter Data</strong></label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<label class="label-input">Mulai : </label>
								<input class="input_date" id="ed_mulai" name="ed_mulai" type="text" value="{{ date_format(now(), "Y-m-d") }}" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Mulai">
							</div>
							<div class="col-md-2">
								<label class="label-input">Sampai : </label>
								<input class="input_date" id="ed_sampai" name="ed_sampai" type="text" value="{{ date_format(now(), "Y-m-d") }}" onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="Tanggal Sampai">
							</div>
							<div class="col-md-4">
								<label class="label-input">Petugas : </label>
								<select id="petugas" class="ed_sel_petugas input_date full-width">
									<option value="all">Semua Petugas</option>
									<?php
									$data_petugas = App\User::select('id','name')->where('unit', Auth::user()->unit)->get();
									?>
									@foreach($data_petugas as $data_petugass)
									<option value="{{$data_petugass->id}}">{{$data_petugass->name}}</option>
									@endforeach									
								</select>
							</div>

						</div>
						<div class="row">
							<div class="col-md-12" style="margin-top: 10px;">
								<button id="proses" class="btn btn-success">Proses</button>
								<hr />
							</div>
						</div>
						<div class="row">
							<span id="refresh-table">
								@include('unit.laporan.refresh_table_lap_pengunjung')
							</span> <!--penutup span-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<style type="text/css">
.full-width{
	width: 100% !important;
	display: block;
}
.input_date{
	border: 1px solid #aaaaaa;
	width: 160px;
	height: 30px;
	outline-width: 0px;
	font-family: arial;
	color: black;
	padding: 5px 10px;
}
.input-custom{
	padding: 5px 10px;
}
.label-input{
	font-weight: normal !important;
}
.table-container{
	padding: 10px;
	border: 1px solid #dddddd;
}
table.dataTable thead tr {
  padding: 0px;
  margin: 0px;
  color: white;
  background-color: green;
}
</style>
@endsection

@section('scripts')
<script type="text/javascript">
      $(document).ready(function() {
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();
         var petugas = $("#petugas").val();


          $.get('{{ Url("filter-laporan-pengunjung") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas}, function(resp){  

            $("#refresh-table").html(resp);
             
          });


    });
      
        $(document).on('click', '#proses', function (e) { 
         
         var ed_mulai = $("#ed_mulai").val();
         var ed_sampai = $("#ed_sampai").val();
         var petugas = $("#petugas").val();

          $.get('{{ Url("unit-filter-laporan-pengunjung") }}',{'_token': $('meta[name=csrf-token]').attr('content'),ed_mulai:ed_mulai,ed_sampai:ed_sampai,petugas:petugas}, function(resp){  

            $("#refresh-table").html(resp);
             
          });
    });

     $(document).on('click', '.modal-list', function (e) { 
          	var id_user = $(this).attr('data-user');
         	var tglmulai = $("#ed_mulai").val();
         	var tglsampai = $("#ed_sampai").val();
         	var petugas = $("#petugas").val();


          $("#myModal1").modal('show');
          $.get('{{ Url("unit-lihat-list-kunjungan") }}',{'_token': $('meta[name=csrf-token]').attr('content'),id_user:id_user,tglmulai:tglmulai,tglsampai:tglsampai,petugas:petugas}, function(resp){ 
              $("#refresh-list-kunjungan").html(resp.tables);
              $("#count-list-kunjungan").html(resp.count);
              $("#nama-pelanggan-kunjungan").html(resp.pelanggan);

          });

     });
</script>
@endsection

