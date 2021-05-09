@extends('backend.home')
@section('title','Admins')
@section('content')
  <div class="row">
    <div class="col-md-12">
        <div id="">
            <div class="card">
              <div class="card-header">
                Create Admin
              </div>
              <div class="card-body">
                <form id="admin-add-form" enctype="multipart/form-data">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="user-name">Name</label>
                        <input type="text"  name="name" id="user-name" class="form-control"  placeholder="Name" >
                      </div>

                      <div class="form-group col-md-6">
                        <label for="user-email">Email</label>
                        <input type="email"  name="email" id="user-email" class="form-control"  placeholder="Email" >
                      </div>

                      <div class="form-group col-md-6">
                        <label for="user-phone">Contact Number</label>
                        <input type="text"  name="phone" id="user-phone" class="form-control"  placeholder="Phone Number" >
                      </div>

                      <div class="form-group col-md-6">
                        <label for="user-password">Password</label>
                        <input type="password"  name="password" id="user-password" class="form-control"  placeholder="Password" >
                      </div>

                      <div class="form-group col-md-6">
                        <label for="user-confirm-password">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="user-confirm-password" class="form-control"  placeholder="Confirm Password" >
                      </div>

                      <div class="form-group col-md-6">
                        <label for="user-role">Role</label>
                        <select id="user-role" name="role" class="form-control">
                          @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="user-photo">Photo <span class="image-size">(300* 300)</span></label>
                        <input type="file" name="photo" id="user-photo" class="form-control" >
                      </div>
                    </div>
                  <button type="submit" class="btn btn-primary mr-2">Submit</button>

                </form>
              </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 mt-3">
      <div id="reload-admin">
        <div class="card">
          <div class="card-header">
            Admins List
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign" width="100%">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Photo</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody id="user-body">
                @foreach($admins as $admin)
                  <tr class="user-row-{{$admin->id}}">
                    <td>{{$admin->id}}</td>
                    <td class="user-name-{{$admin->id}}">{{$admin->name}}</td>
                    <td class="user-email-{{$admin->id}}">{{$admin->email}}</td>
                    <td class="user-phone-number-{{$admin->id}}">{{$admin->phone_number}}</td>
                    <td class="user-image-{{$admin->id}}">@if($admin->photo) <img src="{{asset($admin->photo)}}" >@endif</td>
                    <td class="user-role-{{$admin->id}}">{{$admin->role->name}}</td>
                    <td class="status-column-{{$admin->id}}"><a href="" class="btn btn-sm {{$admin->status == 1 ? 'btn-outline-success' : 'btn-outline-danger'}}  mr-1 status-change" title="{{$admin->status == 1 ? 'Deactive' : 'Active'}}" data-status="{{$admin->status}}" data-status-admin-id="{{$admin->id}}"><i class="ti-angle-{{$admin->status == 1 ? 'up' : 'down'}}"></i></a></td>
                    <td >
                      <button class="btn btn-primary btn-sm admin-edit" data-toggle="modal" data-id="{{$admin->id}}" title="Edit"><i class="ti-pencil"></i></button>
                      <button class="btn btn-danger btn-sm admin-delete" data-delete-id="{{$admin->id}}" title="Delete"><i class="ti-trash"></i></button>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- modal --}}
    <div class="modal fade" id="admin-modal" tabindex="-1" role="dialog" aria-labelledby="admin-2" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel-2">Admin Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="admin-edit-form" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="user-edit-name">Name</label>
                <input type="text"  name="name" id="user-edit-name" class="form-control"  placeholder="Name" >
                <input type="hidden"  name="admin_id" id="user-edit-id" class="form-control"  >
              </div>

              <div class="form-group">
                <label for="user-edit-email">Email</label>
                <input type="email"  name="email" id="user-edit-email" class="form-control"  placeholder="Email" >
              </div>

              <div class="form-group">
                <label for="user-edit-phone">Phone Number</label>
                <input type="text"  name="phone" id="user-edit-phone" class="form-control"  placeholder="Phone Number" >
              </div>

              <div class="form-group">
                <label for="user-password">Password</label>
                <input type="password"  name="password" id="user-edit-password" class="form-control"  placeholder="Password" >
              </div>

              <div class="form-group">
                <label for="user-confirm-password">Confirm Password</label>
                <input type="password" name="password_confirmation" id="user-confirm-edit-password" class="form-control"  placeholder="Confirm Password" >
              </div>

              <div class="form-group">
                <label for="user-role">Role</label>
                <select id="user-edit-role" name="role" class="form-control">
                  @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="user-edit-photo">Photo</label>
                <input type="file" name="photo" id="user-edit-photo" class="form-control" >
                <img src="" width="100" id="user-edit-image-show" class="mt-2">
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
          $('.summernote').summernote({
              height: 200,
              width: "100%",
          });
          // validation add amdin
          $("#admin-add-form").validate(
              {
                  ignore: [],
                  debug: true,
                  rules: {
                      name: {
                          required: true,
                      },
                      email: {
                          required: true,
                          email: true,
                      },
                      password: {
                          required: true,
                          minlength: 8,
                      },
                      password_confirmation: {
                          required: true,
                          minlength: 8,
                          equalTo: "#user-password"
                      },
                      phone: {
                          required: true,
                          digits: true,
                          minlength: 11,
                          maxlength: 11,
                      },
                      role: {
                          required: true,
                      }
                  },
              });
          //validation edit admin
          $("#admin-edit-form").validate(
          {
              ignore: [],
              debug: false,
              rules: {
                  name: {
                      required : true,
                  },
                  email: {
                      required : true,
                      email: true,
                  },
                  password: {
                      required: false,
                      minlength: 8,
                  },
                  password_confirmation : {
                      required: false,
                      minlength : 8,
                      equalTo : "#user-confirm-edit-password"
                  },
                  phone: {
                      required: true,
                      digits: true,
                      minlength: 11,
                      maxlength: 11,
                  }
              }
          });


          $('#admin-add-form').on('submit', function (event) {
              event.preventDefault();
              let urlI = '{{url('/')}}';
              let formData = new FormData($(this)[0]);

              if($('#admin-add-form').valid())
              {
                  $.ajax({
                      method: 'POST',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:'{{ route('admins.store') }}',
                      data :formData,
                      cache: false,
                      contentType: false,
                      processData: false,
                      enctype: 'multipart/form-data',
                      success: function(data)
                      {
                          $('#admin-add-form')[0].reset();
                          if(data.user_last)
                          {
                              let user_image = (data.user_last.photo != null ? '<img src="'+urlI+'/'+data.user_last.photo+'">' : '');
                              $('#user-body').prepend(`<tr class="user-row-${data.user_last.id}">
                                <td>${data.user_last.id}</td>
                                <td class="user-name-${data.user_last.id}">${data.user_last.name}</td>
                                <td class="user-email-${data.user_last.id}">${data.user_last.email}</td>
                                <td class="user-phone-number-${data.user_last.id}">${data.user_last.phone_number}</td>
                                <td class="user-image-${data.user_last.id}">${user_image}</td>
                                <td class="user-role-${data.user_last.id}">${data.user_last.role['name']}</td>
                                <td class="status-column-${data.user_last.id}"><a href="" class="btn btn-sm ${data.user_last.status == 1 ? 'btn-outline-success' : 'btn-outline-danger'}  mr-1 status-change" title="${data.user_last.status == 1 ? 'Deactive' : 'Active'}" data-status="${data.user_last.status}" data-status-admin-id="${data.user_last.id}"><i class="ti-angle-${data.user_last.status == 1 ? 'up' : 'down'}"></i></a></td>
                                <td >
                                  <button class="btn btn-primary btn-sm admin-edit" data-toggle="modal" data-id="${data.user_last.id}"><i class="ti-pencil"></i></button>
                                  <button class="btn btn-danger btn-sm admin-delete" data-delete-id="${data.user_last.id}" ><i class="ti-trash"></i></button>
                                </td>
                              </tr>`);
                          }

                          if(data.notification['alert-type'] == 'error')
                          {
                              toastr.error(data.notification.message);
                          }
                          if(data.notification['alert-type'] == 'success')
                          {
                              toastr.success(data.notification.message);
                          }
                      },
                      error: function(error){
                          if (error.status == 422) {
                              $.each(error.responseJSON.errors, function (i, message) {
                                  toastr.error(message);
                              });
                          }
                      },
                  });
              }

          });

          $('#reload-admin').on('click', '.admin-edit' , function () {
              let admin_id =  $(this).attr('data-id');

              $.ajax({
                  url:"{{url('admins')}}/"+admin_id+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){

                      $('#admin-edit-form').find('#user-edit-name').val(data.name).focus();
                      $('#admin-edit-form').find('#user-edit-id').val(data.id);
                      $('#admin-edit-form').find('#user-edit-email').val(data.email);
                      $('#admin-edit-form').find('#user-edit-phone').val(data.phone_number);
                      $('#admin-edit-form').find('#user-edit-role').val(data.role_id);
                      $('#admin-edit-form').find('#user-edit-photo').val('');

                      image = "{{url('/')}}/"+(data.photo != null ? data.photo : '');
                      if(data.photo)
                      {
                          $('#admin-edit-form').find('#user-edit-image-show').css('display','block');
                          $('#admin-edit-form').find('#user-edit-image-show').attr('src',image);
                      }
                      else
                      {
                          $('#admin-edit-form').find('#user-edit-image-show').css('display','none');

                      }
                      $('#admin-modal').modal('show');
                  },

              });
          });

          $('#admin-modal').on('submit', '#admin-edit-form', function (e) {
              e.preventDefault();
              let urlI = '{{url('/')}}';
              let formEditData = new FormData($('#admin-edit-form')[0]);
              if($('#admin-edit-form').valid()) {
                  $.ajax({
                      type: 'post',
                      url: "{{route('admins.update.info')}}",
                      data: formEditData,
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType: "json",
                      enctype: 'multipart/form-data',
                      success: function (data) {
                          let user_image = (data.user_update.photo != null ? '<img src="'+urlI+'/'+data.user_update.photo+'">' : '');

                          $('.user-name-'+data.user_update.id).html(data.user_update.name);
                          $('.user-email-'+data.user_update.id).html(data.user_update.email);
                          $('.user-phone-number-'+data.user_update.id).html(data.user_update.phone_number);
                          $('.user-image-'+data.user_update.id).html(user_image);
                          $('.user-role-'+data.user_update.id).html(data.user_update.role['name']);

                          if(data.notification['alert-type'] == 'error')
                          {
                              toastr.error(data.notification.message);
                          }
                          if(data.notification['alert-type'] == 'success')
                          {
                              toastr.success(data.notification.message);
                          }
                          $('#admin-modal').modal('hide');
                      },
                      error: function (error) {
                          if (error.status == 422) {
                              $.each(error.responseJSON.errors, function (i, message) {
                                  toastr.error(message);
                              });
                          }
                      },

                  });
              }
          });

          $('#reload-admin').on('click', '.admin-delete', function (event) {
              event.preventDefault();
              let admin_id = $(this).attr('data-delete-id');
              Swal.fire({
                  title: 'Are you sure to delete this?',
                  text: "",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Do it!',

              }).then((result) => {
                  if (result.value)
                  {

                      $.ajax({
                          url: "{{route('admins.delete')}}",
                          method: "post",
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          data: {
                              id: admin_id,
                          },
                          dataType: 'json',
                          success: function (data) {

                              if (data.user_delete == true) {
                                  $('.user-row-'+admin_id).remove();
                              }

                              if (data.notification['alert-type'] == 'error') {

                                  toastr.error(data.notification.message);
                              }
                              if (data.notification['alert-type'] == 'success') {
                                  toastr.success(data.notification.message);
                              }

                          },

                      });
                  }
              });
          });

          $('#user-body').on('click', '.status-change',function (event) {
              event.preventDefault();
              let status_list = '';
              let status = $(this).attr('data-status');
              let admin_id = $(this).attr('data-status-admin-id');
              Swal.fire({
                  title: 'Are you sure to Change Status?',
                  text: "",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Do it!',

              }).then((result) => {
                  if (result.value)
              {
                  $.ajax({
                      method: 'get',
                      url:'{{ url('admins/status/change') }}/'+admin_id+'/'+status,
                      data :{},
                      contentType: false,
                      processData: false,
                      cache: false,
                      dataType: 'json',
                      success: function(data) {
                          if(data.status_change == true)
                          {
                              if(data.status == 1)
                              {
                                  $('.status-column-'+admin_id).html(`<a href="" class="btn btn-sm btn-outline-success mr-1 status-change" title="Deactive" data-status="${data.status}" data-status-admin-id="${admin_id}"><i class="ti-angle-up"></i></a>`);
                              }
                              else
                              {
                                  $('.status-column-'+admin_id).html(`<a href="" class="btn btn-sm btn-outline-danger mr-1 status-change" title="Active" data-status="${data.status}" data-status-admin-id="${admin_id}"><i class="ti-angle-down"></i></a>`);
                              }
                          }

                          if(data.notification['alert-type'] == 'error')
                          {
                              toastr.error(data.notification.message);
                          }

                          if(data.notification['alert-type'] == 'success')
                          {
                              toastr.success(data.notification.message);
                          }
                      }
                  });
              }

          });
          });
      });


  </script>
@endsection