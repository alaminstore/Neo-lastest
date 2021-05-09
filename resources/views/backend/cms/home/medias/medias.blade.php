@extends('backend.home')
@section('title','Medias')
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
                        Media Create
                    </div>
                    <div class="card-body">
                        <form id="media-add-form" action="{{route('admin.medias.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="media">Link</label>
                                <input type="link"  name="media_link" id="media" class="form-control" placeholder="Link" required>
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
                        Medias List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign" id="media-list" width="100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Link</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="media-body">
                                @foreach($medias as $media)
                                    <tr class="media-row-{{$media->media_id}}">
                                        <td>{{$media->media_id}}</td>
                                        <td class="media-column-name-{{$media->media_id}}">
                                            <iframe width="100%" height="100"
                                                    src="{{$media->media_link}}">
                                            </iframe>
                                        </td>
                                        <td >
                                            <button class="btn btn-outline-primary btn-sm media-edit"  data-id="{{$media->media_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                                            <button class="btn btn-outline-danger btn-sm media-delete"  title="Delete" onclick="deleteData({{$media->media_id}})"><i class="ti-trash"></i> Delete</button>
                                            <form id="delete-form-{{$media->media_id}}" method="post" action="{{route('admin.medias.destroy', $media->media_id)}}" style="display: none">
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
        <div class="modal fade" id="media-modal" tabindex="-1" role="dialog" aria-labelledby="media-2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Media Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="media-edit-form" action="{{route('admin.medias.updated')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="media-edit">Link</label>
                                <input type="text"  name="media_link" id="media-edit" class="form-control" placeholder="Link" required>
                                <input type="hidden"  name="media_id" id="media-edit-id" class="form-control"   >
                            </div>
                            <div class="form-group" id="media-edit-video">

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
            $('#reload-slider').on('click', '.media-edit' , function () {
                let media_id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('admin/medias')}}/"+media_id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        $('#media-edit-form').find('#media-edit').val(data.media_link).focus();
                        $('#media-edit-form').find('#media-edit-id').val(data.media_id);
                        if(data.media_link)
                        {
                            $('#media-edit-form').find('#media-edit-video').html(`<iframe width="100%" height="100"
                                                    src="${data.media_link}}">
                                            </iframe>`);
                        }

                        $('#media-modal').modal('show');
                    },

                });
            });

        });

    </script>
@endsection
