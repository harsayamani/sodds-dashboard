@extends('admin.master.master')
@section('tab_title', 'Dempster-Shafer Rules | SODDS Admin')
@section('is_active6', 'active')
@section('page_title', 'Dempster-Shafer Rules')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Dempster Shafer Rules</div>
            </div>
            <div class="card-body">
                <div class="card-sub">
                    This is list of <b>Dempster-Shafer Rules</b> from expert
                </div>
                <table class="display" id="rulesds_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Evidence Code</th>
                            <th scope="col">Diseases Code</th>
                            <th scope="col">Belief</th>
                            <th scope="col">Plausability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rulesds as $key => $rule)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$rule->evcode}}</td>
                            <td>{{$rule->discode}}</td>
                            <td>{{$rule->belief}}</td>
                            <td>{{1 - $rule->belief}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    $('#rulesds_table').DataTable();
</script>

@endpush
@endsection
