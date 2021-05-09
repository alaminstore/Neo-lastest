@extends('backend.home')
@section('title','Contact Us Info')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="">
                <div class="card">
                    <div class="card-header">
                        Add Contact Information
                    </div>
                    <div class="card-body">
                        <form id="slider-add-form" action="{{route('admin.contactus.store')}}" method="post"
                              enctype="multipart/form-data">
                              <?php
                                 $contact = \App\Models\ContactusInfo::all();
                                 if ($contact->isEmpty()) {
                               ?>
                            @csrf
                            <div class="form-group">
                                <label for="slider-add-link">Factory</label>
                                <input type="text" name="factory" id="slider-add-link" class="form-control"
                                       placeholder="Factory Info..." value="{{old('factory')}}">
                            </div>
                            <div class="form-group">
                                <label for="slider-add-link">Marketing & Distribution</label>
                                <input type="text" name="marketing_distribution" id="slider-add-link" class="form-control"
                                       placeholder="Marketing & Distribution.." value="{{old('marketing_distribution')}}">
                            </div>

                            <div class="form-group">
                                <label for="slider-add-link">Phone</label>
                                <input type="text" name="phone" id="slider-add-link" class="form-control"
                                       placeholder="Phone number here..." value="{{old('phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="slider-add-link">Email</label>
                                <input type="email" name="email" id="slider-add-link" class="form-control"
                                       placeholder="@ Email here" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="slider-add-link">Messenger</label>
                                <input type="text" name="messenger" id="slider-add-link" class="form-control"
                                       placeholder="Messenger Id" value="{{old('messenger')}}">
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <?php }else{ ?>  <p class="text-center">You can edit or delete  the information </p> <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
             <div id="reload-slider">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="slider-list" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">Factory</th>
                                    <th class="text-center">Marketing & Distribution</th>
                                    <th class="text-center"> Phone</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Messenger</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="slider-body">
                                @foreach($contact_info as $info)
                                    <tr class="slider-row-{{$info->id}}">
                                        <td class="slider-column-name-{{$info->id}} text-center">
                                            {{$info->factory}}
                                        </td>
                                        <td class="slider-column-name-{{$info->id}} text-center">
                                            {{$info->marketing_distribution}}
                                        </td>
                                        <td class="slider-column-name-{{$info->id}} text-center">
                                            {{$info->phone}}
                                        </td>
                                        <td class="slider-column-name-{{$info->id}} text-center">
                                            {{$info->email}}
                                        </td>
                                        <td class="slider-column-name-{{$info->id}} text-center">
                                            {{$info->messenger}}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-outline-primary btn-sm slider-edit" data-id="{{$info->id}}" title=" Edit"><i class="ti-pencil"></i> Edit</button>
                                            <button class="btn btn-outline-danger btn-sm slider-delete" title="Delete" onclick="deleteData({{$info->id}})"><i class="ti-trash"></i>
                                                Delete
                                            </button>
                                            <form id="delete-form-{{$info->id}}" method="post"
                                                  action="{{route('admin.contactus.delete',$info->id)}}"
                                                  style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
        <div class="modal fade" id="slider-modal" tabindex="-1" role="dialog" aria-labelledby="slider-2"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Slider Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="slider-edit-form" action="{{route('admin.contactus.update')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="slider-edit-name">Factory</label>
                                <input type="text" name="factory" id="contact-us-edit-add-factory" class="form-control">
                                <input type="hidden" name="id" id="slider-edit-id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slider-edit-name">Marketing & Distribution</label>
                                <input type="text" name="marketing_distribution" id="contact-us-edit-add-marketing" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slider-edit-name">Phone</label>
                                <input type="text" name="phone" id="contact-us-edit-add-phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slider-edit-name">Email</label>
                                <input type="text" name="email" id="contact-us-edit-add-email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slider-edit-designation">Messenger</label>
                                <input type="text" name="messenger" id="contact-us-edit-messenger" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--         modal--}}
    </div>
@endsection

@section('scripts')
    <script src="{{asset('backend')}}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/jszip.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/buttons.html5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reload-slider').on('click', '.slider-edit', function () {
                let id = $(this).attr('data-id');
                console.log('id here', id);

                $.ajax({
                    url: "{{url('admin/contact-us')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        $('#slider-edit-form').find('#slider-edit-id').val(data.id);
                        $('#slider-edit-form').find('#contact-us-edit-add-factory').val(data.factory);
                        $('#slider-edit-form').find('#contact-us-edit-add-marketing').val(data.marketing_distribution);
                        $('#slider-edit-form').find('#contact-us-edit-add-phone').val(data.phone);
                        $('#slider-edit-form').find('#contact-us-edit-add-email').val(data.email);
                        $('#slider-edit-form').find('#contact-us-edit-messenger').val(data.messenger);
                        if (data.image) {
                            $('#slider-edit-form').find('#slider-edit-image').html(`<img width="100%" height="200px"  src="${url}/${data.image}"/>`);
                        }

                        $('#slider-modal').modal('show');
                    },

                });
            });
        });
    </script>
@endsection
