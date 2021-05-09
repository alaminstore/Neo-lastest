@extends('backend.home')
@section('title','FAQ Categories')
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
                        FAQ Category Create
                    </div>
                    <div class="card-body">
                        <form id="faq-category-add-form" action="{{route('admin.faqcategories.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="faq-category">Name</label>
                                <input type="text"  name="name" id="faq-category" class="form-control" placeholder="Name">
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
                        FAQ Category List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign" id="faq-category-list" width="100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="faq-category-body">
                                @foreach($faq_categories as $faq_category)
                                    <tr class="faq-category-row-{{$faq_category->faq_category_id}}">
                                        <td>{{$faq_category->faq_category_id}}</td>
                                        <td class="faq-category-column-name-{{$faq_category->faq_category_id}}">
                                            {{$faq_category->name}}
                                        </td>
                                        <td >
                                            <button class="btn btn-outline-primary btn-sm faq-category-edit"  data-id="{{$faq_category->faq_category_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                                            <button class="btn btn-outline-danger btn-sm faq-category-delete"  title="Delete" onclick="deleteData({{$faq_category->faq_category_id}})"><i class="ti-trash"></i> Delete</button>
                                            <form id="delete-form-{{$faq_category->faq_category_id}}" method="post" action="{{route('admin.faqcategories.destroy', $faq_category->faq_category_id)}}" style="display: none">
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
        <div class="modal fade" id="faq-category-modal" tabindex="-1" role="dialog" aria-labelledby="faq-category-2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel-2">Slider Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="faq-category-edit-form" action="{{route('admin.faqcategories.updated')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="faq-category-edit">Name</label>
                                <input type="text"  name="name" id="faq-category-edit" class="form-control" placeholder="Name">
                                <input type="hidden"  name="faq_category_id" id="faq-category-edit-id" class="form-control"   >
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
                let faq_category_id =  $(this).attr('data-id');

                $.ajax({
                    url:"{{url('admin/faqcategories')}}/"+faq_category_id+'/edit',
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        let url = window.location.origin;
                        $('#faq-category-edit-form').find('#faq-category-edit-id').val(data.faq_category_id);
                        $('#faq-category-edit-form').find('#faq-category-edit').val(data.name);

                        $('#faq-category-modal').modal('show');
                    },

                });
            });
        });
    </script>
@endsection
