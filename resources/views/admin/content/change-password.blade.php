@extends('admin.master.master')
@section('tab_title', 'Change Password | SODDS Admin')
@section('page_title', 'Change Password')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form method="POST" action="/admin/change-password/process">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="old_pass">Old Password</label>
                            <input type="password" class="form-control input-pill" name="old_pass" placeholder="Enter old password" required>
                        </div>
                        <div class="form-group">
                            <label for="new_pass">New Password</label>
                            <input type="password" class="form-control input-pill" name="new_pass" placeholder="Enter new password" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="reold_pass">Re-type Old Password</label>
                            <input type="password" class="form-control input-pill" name="reold_pass" placeholder="Enter re-type old password" required>
                        </div>
                        <div class="form-group">
                            <label for="renew_pass">Re-type New Password</label>
                            <input type="password" class="form-control input-pill" name="renew_pass" placeholder="Enter re-type new password" required>
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

