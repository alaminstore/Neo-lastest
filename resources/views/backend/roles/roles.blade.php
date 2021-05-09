@extends('backend.home')
@section('title','Roles')
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div id="reload-roles">
                <div class="card">
                    <div class="card-header">
                        Roles List
                    </div>
                    <div class="card-body">
                        <div class="">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td class="role-name-column-{{$role->id}}">{{$role->name}}</td>
                                        <td >
                                            <button class="btn btn-primary btn-sm role-edit" data-toggle="modal" data-id="{{$role->id}}" title="Edit"><i class="ti-pencil"></i></button>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- modal --}}
        <div class="modal fade" id="role-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Role Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="role-edit-form">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="role-name">Name</label>
                                <input type="text"  name="name" id="role-name" class="form-control"  placeholder="Role Name" >
                                <input type="hidden"  name="role_id" id="role-id" class="form-control" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- modal --}}
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            // validation
            $("#role-edit-form").validate(
                {
                    ignore: [],
                    debug: false,
                    rules: {
                        name : "required",
                    },
                });

            $('#reload-roles').on('click', '.role-edit' , function () {
                let role_id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('roles')}}/"+role_id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        $('#role-edit-form').find('#role-name').val(data.name).focus();
                        $('#role-edit-form').find('#role-id').val(data.id);
                        $('#role-modal').modal('show');
                    },

                });
            });
            $('#role-modal').on('submit','#role-edit-form', function (event) {
                event.preventDefault();
                let role = $(this).serialize();

                let role_id =  $('#role-id').val();

                $.ajax({
                    type: 'PATCH',
                    url:"{{url('roles')}}/"+role_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: role,
                    dataType: 'json',
                    success:function(data){
                        $('.role-name-column-'+data.update_role.id).html(data.update_role.name);
                        if(data.notification['alert-type'] == 'error')
                        {
                            toastr.error(data.notification.message);
                        }
                        if(data.notification['alert-type'] == 'success')
                        {
                            toastr.success(data.notification.message);
                        }

                        $('#role-modal').modal('hide');
                    },
                    error: function(error){
                        if (error.status == 422) {
                            $.each(error.responseJSON.errors, function (i, message) {
                                toastr.error(message);
                            });
                        }
                    },

                });
            });
        });

    </script>
@endsection