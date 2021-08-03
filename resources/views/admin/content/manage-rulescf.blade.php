@extends('admin.master.master')
@section('tab_title', 'Certainty Factor Rules | SODDS Admin')
@section('is_active7', 'active')
@section('page_title', 'Certainty Factor Rules')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Rules</div>
            </div>
            <form action="/admin/manage/rules-cf/add" method="POST">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="evcode">Evidence</label>
                            <select class="form-control input-pill" name="evcode" id="evcode" required>
                                <option value="">------</option>
                                @foreach ($evidences as $evidence)
                                <option value="{{$evidence->code}}">{{$evidence->code}} - {{$evidence->evidence}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="discode">Diseases</label>
                            <select class="form-control input-pill" name="discode" id="discode" required>
                                <option value="">------</option>
                                @foreach ($diseases as $disease)
                                <option value="{{$disease->code}}">{{$disease->code}} - {{$disease->disease}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cfvalcode">Certainty Value</label>
                            <select class="form-control input-pill" name="cfvalcode" id="cfvalcode" required>
                                <option value="">------</option>
                                @foreach ($cfvalues as $cfvalue)
                                <option value="{{$cfvalue->code}}">{{$cfvalue->code}} - {{$cfvalue->certainty}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($rulescf as $key => $rule)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$rule->evcode}}</td>
                            <td>{{$rule->discode}}</td>
                            <td>{{$rule->cfvalcode}}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="modalUpdate" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title"><i class="la la-edit"></i> Update Rule CF</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/rules-cf/update">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert_modal"></div>
                    </div>
                </div>
                <div class="row" hidden>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="id">Disease ID</label>
                            <input type="text" class="form-control input-pill" name="id" id="id" placeholder="Disease Id" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="evcode">Evidence</label>
                            <select class="form-control input-pill" name="evcode" id="evcode2" style="width: 100%" required>
                                <option value="">------</option>
                                @foreach ($evidences as $evidence)
                                <option value="{{$evidence->code}}">{{$evidence->code}} - {{$evidence->evidence}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="discode">Diseases</label>
                            <select class="form-control input-pill" name="discode" id="discode2" style="width: 100%" required>
                                <option value="">------</option>
                                @foreach ($diseases as $disease)
                                <option value="{{$disease->code}}">{{$disease->code}} - {{$disease->disease}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cfvalcode">Certainty Value</label>
                            <select class="form-control input-pill" name="cfvalcode" id="cfvalcode2" style="width: 100%" required>
                                <option value="">------</option>
                                @foreach ($cfvalues as $cfvalue)
                                <option value="{{$cfvalue->code}}">{{$cfvalue->code}} - {{$cfvalue->certainty}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title"><i class="la la-trash"></i> Delete Rule CF</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/rules-cf/delete">
                {{ csrf_field() }}
            <div class="modal-body text-center">
                <div class="row" hidden>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="id">Disease ID</label>
                            <input type="text" class="form-control input-pill" name="id" id="id" placeholder="Disease Id" required>
                        </div>
                    </div>
                </div>
                <br>
                <h5>Are you sure?</h5>
                <br>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('script')

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
	function notificationAlert(title, message, state) {
        var placementFrom = 'top';
        var placementAlign = 'right';
        // var state = 'success';
        var style = 'withicon';
        var content = {};

        content.message = message;
        content.title = title;
        if (style == "withicon") {
            content.icon = 'la la-bell';
        } else {
            content.icon = 'none';
        }
        content.target = '_blank';

        $.notify(content,{
            type: state,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            time: 1000,
        });
    }
</script>

<script>
    let rulescfTable = $('#rulescf_table').DataTable({
        responsive: true
    });
</script>

<script>
    $(document).ready(function(){
        $('#modalUpdate').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var evcode = button.data('evcode');
            var discode = button.data('discode');
            var cfvalcode = button.data('cfvalcode');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #evcode2').val(evcode).trigger('change');
            modal.find('.modal-body #discode2').val(discode).trigger('change');
            modal.find('.modal-body #cfvalcode2').val(cfvalcode).trigger('change');
        });
    });

    $(document).ready(function(){
        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
        });
    });
</script>

<script>
    const BASE_URL = 'https://sodds-app.herokuapp.com';
</script>

<script>
    axios.get(
			BASE_URL+'/api/v1/rulecf/get-all-rule',
            {
                auth: {
                    username: 'sodds',
                    password: '12345678',
                },
            }
		).then((response)=>{
			let rules = response.data.data;
			let x = 0;

			for(let i=0; i<rules.length; i++) {
				x++;

				let html = `
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" data-id="${rules[i]._id.$oid}" data-evcode="${rules[i].evcode}" data-discode="${rules[i].discode}" data-cfvalcode="${rules[i].cfvalcode}">
                    <i class="la la-edit"></i>
                </button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="${rules[i]._id.$oid}">
                    <i class="la la-trash"></i>
                </button>
				`;

				rulescfTable.row.add([
					x,
					rules[i].evcode,
					rules[i].discode,
                    rules[i].cfvalcode,
					html
				]).draw();
			}
		}, (error) => {
            if(error.message === 'Request failed with status code 500'){
                notificationAlert('SODDS Notify', error.message, 'danger');
            }else if(error.message === 'Request failed with status code 409'){
                notificationAlert('SODDS Notify', error.message, 'danger');
            }else if(error.message === 'Request failed with status code 400'){
                notificationAlert('SODDS Notify', error.message, 'danger');
            }
        });
</script>

<script>
    $('#evcode2').select2();
    $('#discode2').select2();
    $('#cfvalcode2').select2();
    $('#evcode').select2();
    $('#discode').select2();
    $('#cfvalcode').select2();
</script>

@endpush
@endsection
