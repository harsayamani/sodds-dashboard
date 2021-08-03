@extends('admin.master.master')
@section('tab_title', 'Account Settings | SODDS Admin')
@section('page_title', 'Account Settings')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form method="POST" action="/admin/account-settings/update">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input autocomplete="off" type="text" class="form-control input-pill" name="name" placeholder="Enter name" value="{{$currentName}}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
