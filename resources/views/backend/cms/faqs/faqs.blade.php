@extends('backend.home')
@section('title','FAQ')
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
                        FAQ Create
                    </div>
                    <div class="card-body">
                        <form id="faq-category-add-form" action="{{route('admin.faqs.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="faq-category">FAQ Category</label>
                                <select name="faq_category_id" class="form-control" id="faq-category" required>
                                    <option value="">Select FAQ Category</option>
                                    @foreach($faq_categories as $faq_category)
                                        <option value="{{$faq_category->faq_category_id}}">{{$faq_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="faq-question">Question</label>
                                <input type="text"  name="question" id="faq-question" class="form-control" value="{{old('question')}}" placeholder="FAQ Question">
                            </div>
                            <div class="form-group">
                                <label for="faq-question-answer">Description</label>
                                <textarea class="summernote" name="answer" id="faq-question-answer">
                                    {{old('answer')}}
                                </textarea>
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
                        FAQ List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign" id="faq-category-list" width="100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Faq Category</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="faq-category-body">
                                    @foreach($faqs as $faq)
                                        <tr class="faq-category-row-{{$faq->faq_id}}">
                                            <td>{{$faq->faq_id}}</td>
                                            <td>{{$faq->faqCategory->name}}</td>
                                            <td class="faq-category-column-name-{{$faq->faq_id}}">
                                                {{$faq->question}}
                                            </td>

                                            <td class="faq-category-column-name-{{$faq->faq_id}}">
                                                {{$faq->answer}}
                                            </td>
                                            <td >
                                                <button class="btn btn-outline-primary btn-sm faq-category-edit"  data-id="{{$faq->faq_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                                                <button class="btn btn-outline-danger btn-sm faq-category-delete"  title="Delete" onclick="deleteData({{$faq->faq_id}})"><i class="ti-trash"></i> Delete</button>
                                                <form id="delete-form-{{$faq->faq_id}}" method="post" action="{{route('admin.faqs.destroy', $faq->faq_id)}}" style="display: none">
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
        <div class="modal fade" id="faq-modal" tabindex="-1" role="dialog" aria-labelledby="faq-category-2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Slider Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="faq-edit-form" action="{{route('admin.faqs.updated')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="faq-category-edit">FAQ Category</label>
                                <select name="faq_category_id" class="form-control" id="faq-category-edit" required>
                                    <option value="">Select FAQ Category</option>
                                    @foreach($faq_categories as $faq_category)
                                        <option value="{{$faq_category->faq_category_id}}">{{$faq_category->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden"  name="faq_id" id="faq-edit-id" class="form-control"   >
                            </div>
                            <div class="form-group">
                                <label for="faq-question-edit">Question</label>
                                <input type="text"  name="question" id="faq-question-edit" class="form-control"  placeholder="FAQ Question">
                            </div>
                            <div class="form-group">
                                <label for="faq-question-answer-edit">Description</label>
                                <textarea class="summernote" name="answer" id="faq-question-answer-edit">

                                </textarea>
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
                let faq_id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('admin/faqs')}}/"+faq_id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                        $('#faq-edit-form').find('#faq-category-edit').val(data.faq_category_id);
                        $('#faq-edit-form').find('#faq-edit-id').val(data.faq_id);
                        $('#faq-edit-form').find('#faq-question-edit').val(data.question);
                        $('#faq-edit-form').find('#faq-question-answer-edit').summernote('code', data.answer);

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
