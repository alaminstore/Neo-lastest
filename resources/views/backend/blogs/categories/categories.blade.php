@extends('backend.home')
@section('title','Blog Categories')
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
            Blog Category Create
          </div>
          <div class="card-body">
            <form id="category-add-form" action="{{route('admin.blogcategories.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="category-name">Name</label>
                    <input type="text"  name="category_name" id="category-name" class="form-control" value="{{old('category_name')}}"  placeholder="Category Name" required>
                </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div id="reload-category">
        <div class="card">
          <div class="card-header">
            Blog Categories List
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="category-list" width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="category-body">
                    @foreach($categories as $category)
                      <tr class="category-row-{{$category->blog_category_id}}">
                        <td>{{$category->blog_category_id}}</td>
                        <td class="category-column-name-{{$category->blog_category_id}}">{{$category->category_name}}</td>
                        <td >
                          <button class="btn btn-outline-primary btn-sm category-edit"  data-id="{{$category->blog_category_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                          <button class="btn btn-outline-danger btn-sm category-delete"  title="Delete" onclick="deleteData({{$category->blog_category_id}})"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$category->blog_category_id}}" method="post" action="{{route('admin.blogcategories.destroy', $category->blog_category_id)}}" style="display: none">
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
    <div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-labelledby="category-2" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Category Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="category-edit-form" action="{{route('admin.blogcategories.updated')}}" method="post">
              @csrf
            <div class="modal-body">
              <div class="form-group">
                <label for="category-edit-name">Name</label>
                <input type="text"  name="category_name" id="category-edit-name" class="form-control"  placeholder="Category Name" required>
                <input type="hidden"  name="category_id" id="category-edit-id" class="form-control"   >
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
          $('#reload-category').on('click', '.category-edit' , function () {
              let category_id =  $(this).attr('data-id');

              $.ajax({
                  url:"{{url('admin/blogcategories')}}/"+category_id+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      $('#category-edit-form').find('#category-edit-name').val(data.category_name).focus();
                      $('#category-edit-form').find('#category-edit-id').val(data.blog_category_id);

                      $('#category-modal').modal('show');
                  },
                  error: function (error) {
                      if(error.status == 404){
                          toastr.error('Not found!');
                      }
                  }
              });
          });

      });

  </script>
@endsection