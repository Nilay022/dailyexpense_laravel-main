@extends('layouts/app')
@section('content')

<div class="content">
      <div class="container-fluid">
      
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <p>Limit Remain</p>
                    <div>
                      <h3>{{$remain_limit}}</h3>
                    </div>
                </div>

                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a href="{{route('add')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                   <p>Total Expense</p>
                   <div>
                      <h3>{{$exp}}</h3>
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a href="{{route('manage')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                <p>Manage Expense</p>
                 <div>
                  <h3>&nbsp;</h3>
                  
                    </div>
                </div>
                <div class="icon">
                    <i class="ion ion-plus"></i>
                </div>
                <a href="{{route('profile')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        </div>
        <h3 class="mt-4">Full-Expense Report</h3>
        <div class="row">
                <div class="col-md-6">
              <div class="card-header">
                <h3 class="card-title">Yearly Expense</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Monthly Expenses</h5>
              </div>
              <div class="card-body">
                <div class="card card-danger">
              <div class="card-header">
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    @endsection
@section('js')
  <script>
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData = {
      labels: [
           @foreach ($limit as $l)
              '{{$l['category']}}',
            @endforeach
      ],
      datasets: [
        {
          data: [
            @foreach ($limit as $l)
              {{$l['expense']}},
            @endforeach
          ],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
        }
      ]
    }
    var donutOptions = {
      maintainAspectRatio : false,
      responsive : true,
    }
      new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

     var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

  </script>
@endsection
