@extends('backend.home')
@section('title','Privacy')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div id="">
                <div class="card">
                    <div class="card-header">
                        Privacy Policy
                    </div>
                    <div class="card-body">
                        <form id="faq-category-add-form" action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <?php
                            $privacy = \App\Models\Privacypolicy::all();
                            if ($privacy->isEmpty()) { ?>
                            <div class="form-group">
                                <label for="faq-question-answer">Description</label>
                                <textarea class="summernote" name="answer" id="faq-question-answer"> </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                              <?php }else {
                                echo "You can update or create new entry";
                              } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div id="reload-slider">
                <div class="card">
                    <div class="card-header">
                        Content
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" table table-bordered" id="faq-category-list" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">summary</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="faq-category-body">
                                @foreach($policies as $policy)
                                    <tr class="faq-category-row-s">
                                        <td class="faq-category-column-name-">
                                            {!!\Illuminate\Support\Str::words($policy->answer,10).'...'!!}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-outline-primary btn-sm faq-category-edit"
                                                    data-id="{{$policy->id}}" title="Edit"><i class="ti-pencil"></i> Edit
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm faq-category-delete"
                                                    title="Delete" onclick="deleteData({{$policy->id}})"><i
                                                    class="ti-trash"></i> Delete
                                            </button>
                                            <form id="delete-form-{{$policy->id}}" method="post"
                                                  action="{{route('admin.privacy_policy.destroy', $policy->id )}}"
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
        <div class="modal fade" id="faq-modal" tabindex="-1" role="dialog" aria-labelledby="faq-category-2"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Privacy Policy Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @foreach($policies as $policy)
                        <form id="terms-edit-form" action="{{route('admin.privacy_policy.udpate' , $policy->id )}}"
                              method="post" enctype="multipart/form-data">
                            @endforeach
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <textarea class="summernote" name="answer"
                                              id="terms-question-answer-edit"></textarea>
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
    <br>
<br>
<br>
    {{-- Banner Portion --}}
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Privacy Policy Banner
                </div>
                <div class="card-body">
                    <form id="slider-add-form" action="{{route('admin.privacy_policy_banner.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <?php
                        $banner = \App\Models\PrivacyBanner::all();
                        if ($banner->isEmpty()) {?>
                        <div class="form-group">
                            <label for="slider">Image (1920 x 447)</label>
                            <input type="file" name="image" id="slider" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <?php }else echo "You can delete & create new" ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div id="reload-slider">
                <div class="card">
                    <div class="card-header">
                        Banner Info
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="slider-list" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="slider-body">
                                @foreach($banner as $bn)
                                    <tr class="slider-row-{{$bn->id}}">

                                        <td class="slider-column-name-{{$bn->id}} text-center">
                                            <a href="{{asset($bn->image)}}" target="_blank"><img
                                                    src="{{asset($bn->image)}}" width="150"/></a>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-outline-danger btn-sm slider-delete" title="Delete"
                                                    onclick="deleteData({{$bn->id}})"><i class="ti-trash"></i>
                                                Delete
                                            </button>
                                            <form id="delete-form-{{$bn->id}}" method="post"
                                                  action="{{route('admin.privacy_policy_banner.destroy', $bn->id)}}"
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
    </div>

@endsection

@section('scripts')
    <script src="{{asset('backend')}}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/jszip.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/buttons.html5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reload-slider').on('click', '.faq-category-edit', function () {
                let id = $(this).attr('data-id');

                $.ajax({
                    url: "{{url('admin/privacy-policy')}}/" + id + '/edit',
                    method: "get",
                    data: {},
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#terms-edit-form').find('#terms-question-answer-edit').summernote('code', data.answer);

                        $('#faq-modal').modal('show');
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
