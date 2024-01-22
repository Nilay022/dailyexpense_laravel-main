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
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-center">Yearly Expenses</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_line" height="150"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
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
  </script>
@endsection
