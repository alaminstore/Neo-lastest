@extends('backend.home')
@section('title','Reviews')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="reload-review">
                <div class="card">
                    <div class="card-header">
                        Reviews
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign"  width="100%">
                                <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Blog</th>
                                    <th>Email</th>
                                    <th>Review</th>
                                    <th>Reply</th>
                                    <th class="align-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="stock-body">
                                @foreach($reviews as $review)
                                    <tr class="order-row">
                                        <td>{{++$loop->index}}</td>
                                        <td>{{$review->blog->blog_header}}</td>
                                        <td>{{$review->user->email}}</td>
                                        <td>{{Str::limit($review->review, 100)}}</td>
                                        <td>{{Str::limit($review->reply,100)}}</td>
                                        <td class="align-right">
                                            <button class="btn btn-outline-info btn-sm review-view"  data-id="{{$review->blog_review_id}}" title="View"><i class="ti-eye"></i> Message</button>
                                            <button class="btn btn-outline-primary btn-sm replay-review"  data-id="{{$review->blog_review_id}}" title="Edit"><i class="ti-pencil"></i> Reply</button>
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
    {{-- modal --}}
    <div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-labelledby="city-2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Review: <span id="review-product"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="review-view">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog" aria-labelledby="city-2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Reply <span id="reply-product"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="reply-form" action="{{route('admin.blog.reviews.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="replay-text">Reply</label>
                            <textarea type="text"  name="reply" id="replay-text" class="form-control"  placeholder="Reply"></textarea>
                            <input type="hidden"  name="review_id" id="review-id" class="form-control"   >
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
@endsection

@section('scripts')
    <script src="{{asset('backend')}}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/jszip.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/buttons.html5.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#reload-review').on('click', '.review-view' , function () {
                let review_id =  $(this).attr('data-id');
                console.log(review_id)
                $.ajax({
                    url:"{{url('admin/blogreviews/view')}}/"+review_id,
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        if(data.blog_review_id)
                        {
                            $('#review-modal').find('#review-product').html(data.blog.blog_header);
                            $('#review-modal').find('#review-view').html(data.review);

                            $('#review-modal').modal('show');
                        }
                    },
                });
            });

            $('#reload-review').on('click', '.replay-review' , function () {
                let review_id =  $(this).attr('data-id');
                $.ajax({
                    url:"{{url('admin/blogreviews/reply')}}/"+review_id,
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        if(data.blog_review_id)
                        {
                            $('#reply-modal').find('#reply-product').html(data.blog.blog_header);
                            $('#reply-modal').find('#replay-text').html(data.reply);
                            $('#reply-modal').find('#review-id').val(data.blog_review_id);

                            $('#reply-modal').modal('show');
                        }
                    },
                });
            });


        });

    </script>
@endsection
