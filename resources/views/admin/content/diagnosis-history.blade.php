@extends('admin.master.master')
@section('tab_title', 'Diagnosis History | SODDS Admin')
@section('is_active3', 'active')
@section('page_title', 'Diagnosis History')
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Diagnosis Dempster-Shafer</div>
                <p class="card-category">History</p>
            </div>
            <div class="card-body">
                <div class="card-sub">
                    This is <b>Dempster-Shafer</b> diagnostic history
                </div>
                <table class="display table-responsive" id="diagds_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Disease</th>
                            <th scope="col">Belief Weight</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody id="diagds">
                        {{-- @foreach($diagds_history as $key => $diagds)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$diagds->max_bel}}</td>
                            <td>{{$diagds->max_bel_weight}}</td>
                            <td>{{date('c', strtotime($diagds->created_at))}}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Diagnosis Certainty Factor</div>
                <p class="card-category">History</p>
            </div>
            <div class="card-body">
                <div class="card-sub">
                    This is <b>Certainty Factor</b> diagnostic history
                </div>
                <table class="display table-responsive" id="diagcf_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Disease</th>
                            <th scope="col">Confidence Level</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody id="diagcf">
                        {{-- @foreach($diagcf_history as $key => $diagcf)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$diagcf->disease}}</td>
                            <td>{{$diagcf->cf_persen}}</td>
                            <td>{{$diagcf->created_at}}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    let diagdsTable = $('#diagds');
    let diagcfTable = $('#diagcf');

    let datatableDiagds = $('#diagds_table').DataTable();
    let datatableDiagcf = $('#diagcf_table').DataTable();

    $.ajax({
        url: "/admin/diagnosis/history/get-all-diagds",
        type:"GET",
        dataType: "json",
        success: function(res) {
            let x = 0;
            res = res.reverse();
            for(let i=0; i<res.length; i++) {
                const dateObj = new Date(res[i].created_at);
                let weight = res[i].max_bel_weight;
                x++;

                datatableDiagds.row.add([
                    x,
                    res[i].disease_result.disease,
                    weight.toFixed(3),
                    dateObj,
                ]).draw();

                $('.even').last().animate({
                    "height":"50px"
                },1000);
            }
        }
    });

    $.ajax({
        url: "/admin/diagnosis/history/get-all-diagcf",
        type:"GET",
        dataType: "json",
        success: function(res) {
            let x = 0;
            res = res.reverse();
            for(let i=0; i<res.length; i++) {
                const dateObj = new Date(res[i].created_at);
                x++;

                datatableDiagcf.row.add([
                    x,
                    res[i].disease,
                    res[i].cf_persen,
                    dateObj,
                ]).draw();

                $('.even').last().animate({
                    "height":"50px"
                },1000);
            }
        }
    });

    var pusher = new Pusher('9cc252851cc7a8311c0c', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('diagnosis');
    channel.bind('diagnosis-added', function(data) {
        datatableDiagds.clear().draw();
        $.ajax({
            url: "/admin/diagnosis/history/get-all-diagds",
            type:"GET",
            dataType: "json",
            success: function(res) {
                let x = 0;
                res = res.reverse();
                for(let i=0; i<res.length; i++) {
                    const dateObj = new Date(res[i].created_at);
                    let weight = res[i].max_bel_weight;
                    x++;

                    datatableDiagds.row.add([
                        x,
                        res[i].max_bel,
                        weight.toFixed(3),
                        dateObj,
                    ]).draw();
                }
            }
        });
    });

    channel.bind('diagnosiscf-added', function(data) {
        datatableDiagcf.clear().draw();
        $.ajax({
            url: "/admin/diagnosis/history/get-all-diagcf",
            type:"GET",
            dataType: "json",
            success: function(res) {
                let x = 0;
                res = res.reverse();
                for(let i=0; i<res.length; i++) {
                    const dateObj = new Date(res[i].created_at);
                    x++;

                    datatableDiagcf.row.add([
                        x,
                        res[i].disease,
                        res[i].cf_persen,
                        dateObj,
                    ]).draw();

                    $('.even').last().animate({
                        "height":"50px"
                    },1000);
                }
            }
        });
    });
</script>

@endpush
@endsection
