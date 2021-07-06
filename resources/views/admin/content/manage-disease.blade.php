@extends('admin.master.master')
@section('tab_title', 'Manage Disease | SODDS Admin')
@section('is_active5', 'active')
@section('page_title', 'Manage Disease')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Disease</div>
            </div>
            <div class="card-body">
                <div class="card-sub">
                    This is list of <b>Disease</b>
                </div>
                <table class="display" id="disease_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Disease Code</th>
                            <th scope="col">Disease</th>
                            <th scope="col">Treatment</th>
                        </tr>
                    </thead>
                    <tbody id="diagds">
                        @foreach($diseases as $key => $disease)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$disease->code}}</td>
                            <td>{{$disease->disease}}</td>
                            <td>{{$disease->treatment}}</td>
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
    $('#disease_table').DataTable();
</script>

@endpush
@endsection
