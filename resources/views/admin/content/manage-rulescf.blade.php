@extends('admin.master.master')
@section('tab_title', 'Certainty Factor Rules | SODDS Admin')
@section('is_active7', 'active')
@section('page_title', 'Certainty Factor Rules')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Certainty Factor Rules</div>
            </div>
            <div class="card-body">
                <div class="card-sub">
                    This is list of <b>Certainty Factor Rules</b> from expert
                </div>
                <table class="display" id="rulescf_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Evidence Code</th>
                            <th scope="col">Disease Code</th>
                            <th scope="col">Certainty Value Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rulescf as $key => $rule)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$rule->evcode}}</td>
                            <td>{{$rule->discode}}</td>
                            <td>{{$rule->cfvalcode}}</td>
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
    $('#rulescf_table').DataTable();
</script>

@endpush
@endsection
