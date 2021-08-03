@extends('admin.master.master')
@section('tab_title', 'Dempster-Shafer Rules | SODDS Admin')
@section('is_active6', 'active')
@section('page_title', 'Dempster-Shafer Rules')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Rules</div>
            </div>
            <form action="/admin/manage/rules-ds/add" method="POST">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="evcode">Evidence</label>
                            <select class="form-control input-pill" name="evcode" id="evcode2" required>
                                <option value="">------</option>
                                @foreach ($evidences as $evidence)
                                <option value="{{$evidence->code}}">{{$evidence->code}} - {{$evidence->evidence}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="discodes">Diseases</label>
                            <select class="form-control input-pill" name="discodes[]" id="discodes2" multiple="multiple" required>
                                <option value="">------</option>
                                @foreach ($diseases as $disease)
                                <option value="{{$disease->code}}">{{$disease->code}} - {{$disease->disease}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="belief">Belief</label>
                            <input type="text" class="form-control input-pill" name="belief" id="belief" placeholder="Enter belief" required>
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($rulesds as $key => $rule)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$rule->evcode}}</td>
                            <td>{{$rule->discode}}</td>
                            <td>{{$rule->belief}}</td>
                            <td>{{1 - $rule->belief}}</td>
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
                <h6 class="modal-title"><i class="la la-edit"></i> Update Rule DS</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/rules-ds/update">
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
                            <select class="form-control input-pill" name="evcode" id="evcode" style="width: 100%" required>
                                <option value="">------</option>
                                @foreach ($evidences as $evidence)
                                <option value="{{$evidence->code}}">{{$evidence->code}} - {{$evidence->evidence}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="discodes">Diseases</label>
                            <select class="form-control input-pill" name="discodes[]" id="discodes" multiple="multiple" style="width: 100%" required>
                                <option value="">------</option>
                                @foreach ($diseases as $disease)
                                <option value="{{$disease->code}}">{{$disease->code}} - {{$disease->disease}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="belief">Belief</label>
                            <input type="text" class="form-control input-pill" name="belief" id="belief" placeholder="Enter belief" required>
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
                <h6 class="modal-title"><i class="la la-trash"></i> Delete Rule</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/rules-ds/delete">
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
    let rulesdsTable = $('#rulesds_table').DataTable({
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
            var belief = button.data('belief');
            var discodes = Array.from(discode);
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #evcode').val(evcode).trigger('change');
            modal.find('.modal-body #discodes').val(discodes).trigger('change');
            modal.find('.modal-body #belief').val(belief);
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
			BASE_URL+'/api/v1/rule/get-all-rule',
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
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" data-id="${rules[i]._id.$oid}" data-evcode="${rules[i].evcode}" data-discode="${rules[i].discode}" data-belief="${rules[i].belief}">
                    <i class="la la-edit"></i>
                </button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="${rules[i]._id.$oid}">
                    <i class="la la-trash"></i>
                </button>
				`;

				rulesdsTable.row.add([
					x,
					rules[i].evcode,
					rules[i].discode,
                    rules[i].belief,
                    1-rules[i].belief,
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
    $('#discodes2').select2();
    $('#evcode').select2();
    $('#discodes').select2();
</script>

@endpush
@endsection
