@extends('backend.home')
@section('title','Testimonial')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div id="">
                <div class="card">
                    <div class="card-header">
                        Testimonial Create
                    </div>
                    <div class="card-body">
                        <form id="testimonial-add-form" action="{{route('admin.testimonials.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="testimonial-name">Name</label>
                                <input type="text"  name="person_name" id="testimonial-name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label for="testimonial-designation">Designation</label>
                                <input type="text"  name="designation" id="testimonial-designation" class="form-control" placeholder="Designation" required>
                            </div>

                            <div class="form-group">
                                <label for="testimonial-description">Description</label>
                                <textarea type="text"  name="description" id="testimonial-description" class="form-control summernote"> </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div id="reload-testimonial">
                <div class="card">
                    <div class="card-header">
                        Testimonial List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign" id="testimonial-list" width="100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="testimonial-body">
                                @foreach($testimonials as $testimonial)
                                    <tr class="testimonial-row-{{$testimonial->testimonial_id}}">
                                        <td>{{$testimonial->testimonial_id}}</td>
                                        <td class="testimonial-column-name-{{$testimonial->testimonial_id}}">
                                            {{$testimonial->person_name}}
                                        </td>
                                        <td class="testimonial-column-name-{{$testimonial->testimonial_id}}">
                                            {{$testimonial->designation}}
                                        </td>
                                        <td class="testimonial-column-name-{{$testimonial->testimonial_id}}">
                                            {!!  wordwrap( $testimonial->description, 50,"<br>\n")  !!}
                                        </td>
                                        <td >
                                            <button class="btn btn-outline-primary btn-sm testimonial-edit"  data-id="{{$testimonial->testimonial_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                                            <button class="btn btn-outline-danger btn-sm testimonial-delete"  title="Delete" onclick="deleteData({{$testimonial->testimonial_id}})"><i class="ti-trash"></i> Delete</button>
                                            <form id="delete-form-{{$testimonial->testimonial_id}}" method="post" action="{{route('admin.testimonials.destroy', $testimonial->testimonial_id)}}" style="display: none">
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
        <div class="modal fade" id="testimonial-modal" tabindex="-1" role="dialog" aria-labelledby="testimonial-2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Testimonial Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="testimonial-edit-form" action="{{route('admin.testimonials.updated')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="testimonial-name-edit">Name</label>
                                <input type="text"  name="person_name" id="testimonial-name-edit" class="form-control" placeholder="Name" required>
                                <input type="hidden"  name="testimonial_id" id="testimonial-id-edit" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="testimonial-designation-edit">Designation</label>
                                <input type="text"  name="designation" id="testimonial-designation-edit" class="form-control" placeholder="Designation">
                            </div>

                            <div class="form-group">
                                <label for="testimonial-description-edit">Description</label>
                                <textarea type="text"  name="description" id="testimonial-description-edit" class="form-control summernote"> </textarea>
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
        {{-- modal --}}
    </div>
@endsection

@section('scripts')
    <script src="{{asset('backend')}}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/jszip.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/buttons.html5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reload-testimonial').on('click', '.testimonial-edit' , function () {
                let testimonial_id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('admin/testimonials')}}/"+testimonial_id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        let url = window.location.origin;
                        $('#testimonial-edit-form').find('#testimonial-id-edit').val(data.testimonial_id);
                        $('#testimonial-edit-form').find('#testimonial-name-edit').val(data.person_name);
                        $('#testimonial-edit-form').find('#testimonial-designation-edit').val(data.designation);
                        $('#testimonial-edit-form').find('#testimonial-description-edit').summernote('code', data.description);

                        $('#testimonial-modal').modal('show');
                    },

                });
            });
            $('.summernote').summernote({
                height: 120,
                width: "100%",
            });
        });
    </script>
@endsection
