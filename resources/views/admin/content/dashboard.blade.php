@extends('admin.master.master')
@section('tab_title', 'Dashboard | SODDS Admin')
@section('is_active1', 'active')
@section('page_title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-stats card-warning">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-line-chart"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">Evidence</p>
                            <h4 class="card-title">{{count($evidences)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-danger">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-line-chart"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">Disease</p>
                            <h4 class="card-title">{{count($diseases)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-success">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-check-square"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">Diagnosis DS</p>
                            <h4 class="card-title">{{count($diagds)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stats card-success">
            <div class="card-body ">
                <div class="row">
                    <div class="col-5">
                        <div class="icon-big text-center">
                            <i class="la la-check-square"></i>
                        </div>
                    </div>
                    <div class="col-7 d-flex align-items-center">
                        <div class="numbers">
                            <p class="card-category">Diagnosis CF</p>
                            <h4 class="card-title">{{count($diagcf)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Diagnosis DS Per Day</h4>
                <p class="card-category">
                Number of products sold</p>
            </div>
            <div class="card-body">
                <div id="dschart"></div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Month'],
        ['Jan',  1000],
        ['Feb',  1000],
        ['Mar',  1000],
        ['Apr',  1000],
        ['May',  1000],
        ['Jun',  1000],
        ['Jul',  1000],
        ['Aug',  1000],
        ['Sep',  1000],
        ['Oct',  1000],
        ['Nov',  1000],
        ['Dec',  1000]
      ]);

      var options = {
        title: 'Company Performance',
        curveType: 'function',
        legend: { position: 'bottom' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('dschart'));

      chart.draw(data, options);
    }
</script>
@endpush
@endsection
