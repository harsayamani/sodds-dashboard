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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Dempster Shafer Diagnosis in Current Week</h4>
            </div>
            <div class="card-body">
                <div id="dschart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Certainty Factor Diagnosis in Current Week</h4>
            </div>
            <div class="card-body">
                <div id="cfchart" class="responsive"></div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var curr = new Date; // get current date
    var sunday = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
    var monday = sunday + 1
    var tuesday = sunday + 2;
    var wednesday = sunday + 3;
    var thursday = sunday + 4;
    var friday = sunday + 5;
    var saturday = sunday + 6; // last day is the first day + 6

    sunday = new Date(curr.setDate(sunday)).toLocaleDateString("en-US");
    monday = new Date(curr.setDate(monday)).toLocaleDateString("en-US");
    tuesday = new Date(curr.setDate(tuesday)).toLocaleDateString("en-US");
    wednesday = new Date(curr.setDate(wednesday)).toLocaleDateString("en-US");
    thursday = new Date(curr.setDate(thursday)).toLocaleDateString("en-US");
    friday = new Date(curr.setDate(friday)).toLocaleDateString("en-US");
    saturday = new Date(curr.setDate(saturday)).toLocaleDateString("en-US");

    let sundaycount = 0;
    let mondaycount = 0;
    let tuesdaycount = 0;
    let wednesdaycount = 0;
    let thursdaycount = 0;
    let fridaycount = 0;
    let saturdaycount = 0;

    $.ajax({
        url: "/admin/diagnosis/history/get-all-diagds",
        type:"GET",
        dataType: "json",
        success: function(res) {
            for(let i=0; i<res.length; i++) {
                let date = new Date(res[i].created_at).toLocaleDateString("en-US");

                if(date === sunday) {
                    sundaycount++;
                }else if(date === monday) {
                    mondaycount++;
                }else if(date === tuesday) {
                    tuesdaycount++;
                }else if(date === wednesday) {
                    wednesdaycount++;
                }else if(date === thursday) {
                    thursdaycount++;
                }else if(date === friday) {
                    fridaycount++;
                }else if(date === saturday) {
                    saturdaycount++;
                }else {
                    continue;
                }
            }

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Day', 'Dempster-Shafer'],
                ['Sunday',  parseInt(sundaycount)],
                ['Monday',  parseInt(mondaycount)],
                ['Tuesday',  parseInt(tuesdaycount)],
                ['Wednesday',  parseInt(wednesdaycount)],
                ['Thursday',  parseInt(thursdaycount)],
                ['Friday',  parseInt(fridaycount)],
                ['Saturday',  parseInt(saturdaycount)],
            ]);

            var options = {
                title: 'Diagnosis Hits',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('dschart'));

            chart.draw(data, options);
            }
        }
    });
</script>

<script type="text/javascript">
    var curr2 = new Date; // get current date
    var sunday2 = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
    var monday2 = sunday2 + 1
    var tuesday2 = sunday2 + 2;
    var wednesday2 = sunday2 + 3;
    var thursday2 = sunday2 + 4;
    var friday2 = sunday2 + 5;
    var saturday2 = sunday2 + 6; // last day is the first day + 6

    sunday2 = new Date(curr2.setDate(sunday2)).toLocaleDateString("en-US");
    monday2 = new Date(curr2.setDate(monday2)).toLocaleDateString("en-US");
    tuesday2 = new Date(curr2.setDate(tuesday2)).toLocaleDateString("en-US");
    wednesday2 = new Date(curr2.setDate(wednesday2)).toLocaleDateString("en-US");
    thursday2 = new Date(curr2.setDate(thursday2)).toLocaleDateString("en-US");
    friday2 = new Date(curr2.setDate(friday2)).toLocaleDateString("en-US");
    saturday2 = new Date(curr2.setDate(saturday2)).toLocaleDateString("en-US");

    let sundaycount2 = 0;
    let mondaycount2 = 0;
    let tuesdaycount2 = 0;
    let wednesdaycount2 = 0;
    let thursdaycount2 = 0;
    let fridaycount2 = 0;
    let saturdaycount2 = 0;

    $.ajax({
        url: "/admin/diagnosis/history/get-all-diagcf",
        type:"GET",
        dataType: "json",
        success: function(res) {
            console.log(res);

            for(let i=0; i<res.length; i++) {
                let date = new Date(res[i].created_at).toLocaleDateString("en-US");

                if(date === sunday2) {
                    sundaycount2++;
                }else if(date === monday2) {
                    mondaycount2++;
                }else if(date === tuesday2) {
                    tuesdaycount2++;
                }else if(date === wednesday2) {
                    wednesdaycount2++;
                }else if(date === thursday2) {
                    thursdaycount2++;
                }else if(date === friday2) {
                    fridaycount2++;
                }else if(date === saturday2) {
                    saturdaycount2++;
                }else {
                    continue;
                }
            }

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Day', 'Certainty Factor'],
                ['Sunday',  parseInt(sundaycount2)],
                ['Monday',  parseInt(mondaycount2)],
                ['Tuesday',  parseInt(tuesdaycount2)],
                ['Wednesday',  parseInt(wednesdaycount2)],
                ['Thursday',  parseInt(thursdaycount2)],
                ['Friday',  parseInt(fridaycount2)],
                ['Saturday',  parseInt(saturdaycount2)],
            ]);

            var options = {
                title: 'Diagnosis Hits',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('cfchart'));

            chart.draw(data, options);
            }
        }
    });
</script>
@endpush
@endsection
