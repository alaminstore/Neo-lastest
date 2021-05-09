@extends('backend.home')
@section('title','SubCategories')
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
            SubCategory Create
          </div>
          <div class="card-body">
            <form id="category-add-form" action="{{route('admin.subcategories.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="product_category" id="category" class="form-control" required>
                      <option value="">Select Category</option>
                      @foreach($categories as $categoy)
                          <option value="{{$categoy->product_category_id}}">{{$categoy->product_category_name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="subcategory-name">Name</label>
                    <input type="text"  name="product_sub_category_name" id="subcategory-name" class="form-control" value="{{old('product_sub_category_name')}}"  placeholder="Subcategory Name" required>
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
            SubCategories List
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="category-list" width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="category-body">
                    @foreach($sub_categories as $sub_category)
                      <tr class="category-row-{{$sub_category->product_sub_category_id}}">
                        <td>{{$sub_category->product_sub_category_id}}</td>
                        <td class="category-column-name-{{$sub_category->product_sub_category_id}}">{{$sub_category->product_sub_category_name}}</td>
                        <td class="category-column-name-{{$sub_category->product_sub_category_id}}">{{$sub_category->ProductCategory->product_category_name}}</td>
                        <td >
                          <button class="btn btn-outline-primary btn-sm category-edit"  data-id="{{$sub_category->product_sub_category_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                          <button class="btn btn-outline-danger btn-sm category-delete"  title="Delete" onclick="deleteData({{$sub_category->product_sub_category_id}})"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$sub_category->product_sub_category_id}}" method="post" action="{{route('admin.subcategories.destroy', $sub_category->product_sub_category_id)}}" style="display: none">
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
            <h5 class="modal-title" >SubCategory Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="subcategory-edit-form" action="{{route('admin.subcategories.updated')}}" method="post">
              @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit-category">Category</label>
                    <select name="product_category" id="edit-category" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $categoy)
                            <option value="{{$categoy->product_category_id}}">{{$categoy->product_category_name}}</option>
                        @endforeach
                    </select>
                </div>
              <div class="form-group">
                <label for="subcategory-edit-name">Name</label>
                <input type="text"  name="product_sub_category_name" id="subcategory-edit-name" class="form-control"  placeholder="Subcategory Name" required>
                <input type="hidden"  name="product_sub_category" id="subcategory-edit-id" class="form-control"   >
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
                  url:"{{url('admin/subcategories')}}/"+category_id+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      console.log(data);
                      $('#subcategory-edit-form').find('#subcategory-edit-name').val(data.product_sub_category_name).focus();
                      $('#subcategory-edit-form').find('#subcategory-edit-id').val(data.product_sub_category_id);
                      $('#subcategory-edit-form').find('#edit-category').val(data.product_category_id);

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