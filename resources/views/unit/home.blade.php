@extends('layouts.app_unit')

@section('content')
  <div class="content-wrapper">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

                                   <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#81D4FA;color:white;">
              <div class="inner">
                <h3>{{$count_antri}}</h3>

                <p>Kunjungan Antri</p>
              </div>
              <div class="icon">
                <i class='fa fa-street-view'></i>
              </div>
              <a  class="small-box-footer"> </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#9FA8DA;color:white;;">
              <div class="inner">
                <h3>{{$count_terima}}</h3>

                <p>Kunjungan Di Terima</p>
              </div>
              <div class="icon">
                <i class="fa fa-handshake-o"></i>
              </div>
              <a  class="small-box-footer"> </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#4DB6AC;color:white;">
              <div class="inner">
                <h3>{{$count_selesai}}</h3>

                <p>Kunjungan Selesai</p>
              </div>
              <div class="icon">
                <i class="fa fa-check-square"></i>
              </div>
              <a  class="small-box-footer"> </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color:#FF5722;color:white;">
              <div class="inner">
                <h3>{{$count_batal}}</h3>

                <p>Kunjungan Batal</p>
              </div>
              <div class="icon">
                <i class="fa fa-close"></i>
              </div>
              <a  class="small-box-footer"> </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        
        
        <div class="row">
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header bg-warning">
                <h3 class="card-title">Grafik Jumlah Pengunjung</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div id="linechart"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header bg-success">
                <h3 class="card-title">Grafik Layanan Pengunjung</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div id="pieChart"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
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
<?php


/*
  for($i=1; $i<=31; $i++){
    $_tgl = $_tgl . $i . ',';
    if($_data[$i]->tanggal===$i){
      $_jumlah = $_jumlah . $_data[$i]->jumlah . ',';
    }else{
      $_jumlah = $_jumlah . '0,';
    }
  }
  $_tgl = substr($_tgl, 0, -1) . ']';
  $_jumlah = substr($_jumlah, 0, -1) . ']';
  */
?>
        <script src="{{asset('/highchart/js/highcharts.js')}}"></script>
        <script src="{{asset('/highchart/js/modules/exporting.js')}}"></script>


       <script type="text/javascript">

$(function () {
    $('#linechart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pengunjung'
        },
        yAxis: {
            title: {
                text: 'Jumlah Pengunjung'
            }

        },
        credits: {enabled: false},
        xAxis: {
            categories: [{{ $_tanggal }}],
            crosshair: true
        },series: [{
            name: 'Jumlah',
            data: [{{ $_nilai }}]
        }]
    });
});

$(function () {

    // Make monochrome colors and set them as default for all pies
    Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());

    // Build the chart
    $('#pieChart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Grafik Kepuasan Pelayanan'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        credits: {enabled: false},
        series: [{
            name: "Kepuasan",
            data: [
                {!! $_hasil !!}
            ]
        }]
    });
});
</script>

@endsection