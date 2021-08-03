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
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                    <i class="la la-plus"></i> Add
                </button>
                <div class="card-sub">
                    This is list of <b>Disease</b>
                </div>
                <table class="display" id="disease_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Code</th>
                            <th scope="col">Disease</th>
                            <th scope="col">Desc</th>
                            <th scope="col">Treatment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($diseases as $key => $disease)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$disease->code}}</td>
                            <td>{{$disease->disease}}</td>
                            <td>{{$disease->treatment}}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title"><i class="la la-plus"></i> Add Disease</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/disease/add">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="alert_modal"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="disease">Disease</label>
                        <input type="text" class="form-control input-pill" name="disease" id="disease" placeholder="Enter disease" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea class="form-control input-pill" name="desc" id="desc" placeholder="Enter description of disease" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="desc">Treatment</label>
                        <textarea class="form-control input-pill" name="treatment" id="treatment" placeholder="Enter treatment of disease" required></textarea>
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

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title"><i class="la la-edit"></i> Update Disease</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/disease/update">
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
                    <div class="col-md-12" hidden>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control input-pill" name="code" id="code" placeholder="Enter code" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="disease">Disease</label>
                            <input type="text" class="form-control input-pill" name="disease" id="disease" placeholder="Enter disease" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control input-pill" name="desc" id="desc" placeholder="Enter description of disease" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">Treatment</label>
                            <textarea class="form-control input-pill" name="treatment" id="treatment" placeholder="Enter treatment of disease" required></textarea>
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
                <h6 class="modal-title"><i class="la la-trash"></i> Delete Disease</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/disease/delete">
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
    let diseaseTable = $('#disease_table').DataTable();
</script>

<script>
    $(document).ready(function(){
        $('#modalUpdate').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var code = button.data('code');
            var disease = button.data('disease');
            var desc = button.data('desc');
            var treatment = button.data('treatment');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #code').val(code);
            modal.find('.modal-body #disease').val(disease);
            modal.find('.modal-body #desc').val(desc);
            modal.find('.modal-body #treatment').val(treatment);
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
			BASE_URL+'/api/v1/disease/get-all-disease',
            {
                auth: {
                    username: 'sodds',
                    password: '12345678',
                },
            }
		).then((response)=>{
			let diseases = response.data.data;
			let x = 0;

			for(let i=0; i<diseases.length; i++) {
				x++;

				let html = `
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" data-id="${diseases[i]._id.$oid}" data-code="${diseases[i].code}" data-disease="${diseases[i].disease}" data-desc="${diseases[i].desc}" data-treatment="${diseases[i].treatment}">
                    <i class="la la-edit"></i>
                </button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="${diseases[i]._id.$oid}">
                    <i class="la la-trash"></i>
                </button>
				`;

				diseaseTable.row.add([
					x,
					diseases[i].code,
					diseases[i].disease,
                    diseases[i].desc,
                    diseases[i].treatment,
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

@endpush
@endsection
