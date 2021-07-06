@extends('admin.master.master')
@section('tab_title', 'Manage Evidence | SODDS Admin')
@section('is_active5', 'active')
@section('page_title', 'Manage Evidence')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Evidence</div>
            </div>
            <div class="card-body">
                <div class="card-sub">
                    This is list of <b>Evidence</b>
                </div>
                <table class="display" id="evidence_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Evidence Code</th>
                            <th scope="col">Evidence</th>
                        </tr>
                    </thead>
                    <tbody id="diagds">
                        @foreach($evidences as $key => $evidence)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$evidence->code}}</td>
                            <td>{{$evidence->evidence}}</td>
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
    $('#evidence_table').DataTable();
</script>

@endpush
@endsection
