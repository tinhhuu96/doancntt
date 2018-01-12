@extends('templates.admin.template')
@section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>65</h3>

        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{ route('admin.listproduct') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{!! $products !!}</h3>

        <p>Products</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="{{ route('admin.listproduct') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>{!! $orders !!}</h3>

        <p>New Orders</p>
      </div>
      <div class="icon">
        <i class="ion-android-cart"></i>
      </div>
      <a href="{{ url('adminpc/orders') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{!! $members !!}</h3>
        <p>Members</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="{{ route('admin.users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- /.col -->
</div>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px;"></div>
<br>
<div id="sales" style="height: 400px;min-width: 310px;max-width: 800px;"></div>
<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Summary of Orders from 2017 to today'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Status',
        colorByPoint: true,
        data: [{
            name: 'shipped',
            y: {{ $shipped }}
        }, {
            name: 'delivered',
            y: {{ $delivered }},
            sliced: true,
            selected: true
        }]
    }]
});
</script>
<script type="text/javascript">
  Highcharts.chart('sales', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: '3D chart with null values'
    },
    subtitle: {
        text: 'Notice the difference between a 0 value and a null point'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: Highcharts.getOptions().lang.shortMonths,
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Sales',
        data: [2, 3, null, 4, 0, 5, 1, 4, 6, 3]
    }]
});
</script>
  @stop

