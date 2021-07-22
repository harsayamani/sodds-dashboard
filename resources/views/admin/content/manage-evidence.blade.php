@extends('admin.master.master')
@section('tab_title', 'Manage Evidence | SODDS Admin')
@section('is_active4', 'active')
@section('page_title', 'Manage Evidence')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Evidence</div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd">
                    <i class="la la-plus"></i> Add
                </button>
                <div class="card-sub">
                    This is list of <b>Evidence</b>
                </div>
                <table class="display" id="evidence_table">
                    <thead>
                        <tr>
                            <th scope="col">Numb.</th>
                            <th scope="col">Code</th>
                            <th scope="col">Evidence</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

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
                <h6 class="modal-title"><i class="la la-plus"></i> Add Evidence</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/evidence/add">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="evidence">Evidence</label>
                            <input type="text" class="form-control input-pill" name="evidence" id="evidence" placeholder="Enter evidence" required>
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

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h6 class="modal-title"><i class="la la-edit"></i> Update Evidence</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/evidence/update">
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
                            <label for="id">Evidence ID</label>
                            <input type="text" class="form-control input-pill" name="id" id="id" placeholder="Customer Id" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" hidden>
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control input-pill" name="code" id="code" placeholder="code" readonly required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="evidence">Evidence</label>
                            <input type="text" class="form-control input-pill" name="evidence" id="evidence" placeholder="Enter evidence" required>
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
                <h6 class="modal-title"><i class="la la-trash"></i> Delete Evidence</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/admin/manage/evidence/delete">
                {{ csrf_field() }}
            <div class="modal-body text-center">
                <div class="row" hidden>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="id2">Evidence ID</label>
                            <input type="text" class="form-control input-pill" name="id" id="id" placeholder="Customer Id" required>
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
    let evidenceTable = $('#evidence_table').DataTable();
</script>

<script>
    $(document).ready(function(){
        $('#modalUpdate').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var code = button.data('code');
            var evidence = button.data('evidence');
            var modal = $(this);
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #code').val(code);
            modal.find('.modal-body #evidence').val(evidence);
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
			BASE_URL+'/api/v1/evidence/get-all-evidence'
		).then((response)=>{
			let evidences = response.data.data;
			let x = 0;
            console.log(evidences);

			for(let i=0; i<evidences.length; i++) {
				x++;

				let html = `
                <button class="btn btn-warning" data-toggle="modal" data-target="#modalUpdate" data-id="${evidences[i]._id.$oid}" data-code="${evidences[i].code}" data-evidence="${evidences[i].evidence}">
                    <i class="la la-edit"></i>
                </button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" data-id="${evidences[i]._id.$oid}">
                    <i class="la la-trash"></i>
                </button>
				`;

				evidenceTable.row.add([
					x,
					evidences[i].code,
					evidences[i].evidence,
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
