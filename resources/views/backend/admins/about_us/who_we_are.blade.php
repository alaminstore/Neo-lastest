@extends('backend.home')
@section('title','About-Us')
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
                        About Us(Who We Are)
                    </div>
                    <div class="card-body">
                        <?php
                        $data = \App\Models\Whoweare::all();
                        if ($data->isEmpty()) {?>
                        <form id="faq-category-add-form" action="{{route('admin.about_us.Whoweare.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="image">Image (Dimension: 570 x 570)</label>
                                <input type="file"  name="image" id="image" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"  name="title" id="title" class="form-control" value="" placeholder="Title here...">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="summernote" name="description" id="Description here...">

                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                        <?php }else echo "Already Data exist" ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div id="reload-slider">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="faq-category-list" width="100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="faq-category-body">
                                    @foreach($whowe as $who)
                                        <tr class="faq-category-row-{{$who->id}}">
                                            <td>{{$who->id}}</td>
                                            <td class="slider-column-name-{{$who->id}} text-center">
                                                <img src="{{asset($who->image)}}" width="150"/>
                                            </td>
                                            <td class="faq-category-column-name-{{$who->id}}">
                                                {{$who->title}}
                                            </td>

                                            <td class="faq-category-column-name-{{$who->id}}">
                                                {!!$who->description!!}
                                            </td>
                                            <td >
                                                <button class="btn btn-outline-primary btn-sm faq-category-edit"  data-id="{{$who->id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                                                <button class="btn btn-outline-danger btn-sm faq-category-delete"  title="Delete" onclick="deleteData({{$who->id}})"><i class="ti-trash"></i> Delete</button>
                                                <form id="delete-form-{{$who->id}}" method="post" action="{{route('admin.about_us.Whoweare.delete', $who->id)}}" style="display: none">
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
        <div class="modal fade" id="who-we-are-modal" tabindex="-1" role="dialog" aria-labelledby="faq-category-2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @foreach($whowe as $who)
                    <form id="who-we-are-edit-form" action="{{route('admin.about_us.Whoweare.update',$who->id)}}" method="post" enctype="multipart/form-data">
                        @endforeach
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="slider-edit">Image</label>
                                <input type="file"  name="image" id="who-we-are-name-edit" class="form-control" >
                                <input type="hidden"  name="id" id="slider-edit-id" class="form-control"   >
                            </div>

                            <div class="form-group">
                                <label for="slider-edit-name">Title</label>
                                <input type="text"  name="title" id="who-we-are-title-edit" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="faq-question-answer-edit">Description</label>
                                <textarea class="summernote" name="description" id="fwho-we-are-description-edit">

                                </textarea>
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
            $('#reload-slider').on('click', '.faq-category-edit' , function () {
                let id =  $(this).attr('data-id');
                console.log('id here',id);

                $.ajax({
                    url:"{{url('admin/aboutus-who-we-are')}}/"+id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                        $('#who-we-are-edit-form').find('#who-we-are-title-edit').val(data.title);
                        $('#who-we-are-edit-form').find('#fwho-we-are-description-edit').summernote('code', data.description);

                        $('#who-we-are-modal').modal('show');
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
