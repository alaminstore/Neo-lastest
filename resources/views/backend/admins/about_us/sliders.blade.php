@extends('backend.home')
@section('title','Sliders')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div id="">
                <div class="card">
                    <div class="card-header">
                        Add New Member
                    </div>
                    <div class="card-body">
                        <form id="slider-add-form" action="{{route('admin.about_us.slider.store')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="slider">Image (Dimension: 370 x 370)</label>
                                <input type="file" name="image" id="slider" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="slider-add-link">Name</label>
                                <input type="text" name="name" id="slider-add-link" class="form-control"
                                       placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="slider-add-link">Designation</label>
                                <input type="text" name="designation" id="slider-add-link" class="form-control"
                                       placeholder="Designation">
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div id="reload-slider">
                <div class="card">
                    <div class="card-header">
                        Members List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign" id="slider-list" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center"> Designation</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="slider-body">
                                @foreach($sliders as $slider)
                                    <tr class="slider-row-{{$slider->id}}">
                                        <td class="text-center">{{$slider->id}}</td>
                                        <td class="slider-column-name-{{$slider->id}} text-center">
                                            <a href="{{asset($slider->image)}}" target="_blank"><img
                                                    src="{{asset($slider->image)}}" width="150"/></a>
                                        </td>
                                        <td class="slider-column-name-{{$slider->id}} text-center">
                                            {{$slider->name}}
                                        </td>
                                        <td class="slider-column-name-{{$slider->id}} text-center">
                                            {{$slider->designation}}
                                        </td>


                                        <td class="text-center">
                                            <button class="btn btn-outline-primary btn-sm slider-edit"
                                                    data-id="{{$slider->id}}" title=" Edit
                                            "><i class="ti-pencil"></i> Edit</button>
                                            <button class="btn btn-outline-danger btn-sm slider-delete" title="Delete"
                                                    onclick="deleteData({{$slider->id}})"><i class="ti-trash"></i>
                                                Delete
                                            </button>
                                            <form id="delete-form-{{$slider->id}}" method="post"
                                                  action="{{route('admin.about_us.slider.delete',$slider->id)}}"
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
                    <form id="slider-edit-form" action="{{route('admin.about_us.slider.update')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="slider-edit">Image</label>
                                <input type="file" name="image" id="slider-edit" class="form-control">
                                <input type="hidden" name="id" id="slider-edit-id" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="slider-edit-name">Name</label>
                                <input type="text" name="name" id="slider-edit-add-name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="slider-edit-designation">Designation</label>
                                <input type="text" name="designation" id="slider-edit-designation" class="form-control">
                            </div>
                            <div class="form-group" id="slider-edit-image">

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
                    url: "{{url('admin/aboutus-team-members')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        let url = window.location.origin;
                        $('#slider-edit-form').find('#slider-edit-id').val(data.id);
                        $('#slider-edit-form').find('#slider-edit-add-name').val(data.name);
                        $('#slider-edit-form').find('#slider-edit-designation').val(data.designation);
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
