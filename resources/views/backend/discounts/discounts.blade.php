@extends('backend.home')
@section('title','Discounts')
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
            Discount Create
          </div>
          <div class="card-body">
            <form id="discount-add-form" action="{{route('admin.discounts.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="discount-parcent">Discount Percentage</label>
                    <input type="number" step="0.01"  name="discount_percentage" id="discount-parcent" class="form-control" value="{{old('discount_percentage')}}"  placeholder="Discount Parcentage" required>
                </div>
                <div class="form-group">
                    <label for="discount-subcategory">SubCategory</label>
                    <select name="product_sub_category" id="discount-subcategory" class="form-control" required>
                      <option value="">Select SubCategory</option>
                      @foreach($sub_categories as $subcategory)
                          <option value="{{$subcategory->product_sub_category_id}}">{{$subcategory->product_sub_category_name}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="discount-status">Status</label>
                    <select name="active" id="discount-status" class="form-control" required>
                      <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div id="reload-discount">
        <div class="card">
          <div class="card-header">
            Discount List
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign"  width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Discount Percentage</th>
                      <th>SubCategory</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="discount-body">
                    @foreach($discounts as $discount)
                      <tr class="discount-row-{{$discount->discount_id}}">
                        <td>{{$discount->discount_id}}</td>
                        <td class="discount-column-name-{{$discount->discount_id}}">{{$discount->discount_percentage}}%</td>
                        <td class="discount-column-name-{{$discount->discount_id}}">{{$discount->ProductSubcategory->product_sub_category_name}}</td>
                        <td class="discount-column-name-{{$discount->discount_id}}">{{$discount->active == 1 ? 'Active' : 'Inactive'}}</td>
                        <td >
                          <button class="btn btn-outline-primary btn-sm discount-edit"  data-id="{{$discount->discount_id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
                          <button class="btn btn-outline-danger btn-sm discount-delete"  title="Delete" onclick="deleteData({{$discount->discount_id}})"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$discount->discount_id}}" method="post" action="{{route('admin.discounts.destroy', $discount->discount_id)}}" style="display: none">
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
    <div class="modal fade" id="discount-modal" tabindex="-1" role="dialog" aria-labelledby="discount-2" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Discount Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="discount-edit-form" action="{{route('admin.discounts.updated')}}" method="post">
              @csrf
            <div class="modal-body">

                <div class="form-group">
                    <label for="discount-parcent-edit">Discount Percentage</label>
                    <input type="number" step="0.01"  name="discount_percentage" id="discount-parcent-edit" class="form-control" value="{{old('discount_percentage')}}"  placeholder="Discount Parcentage" required>
                    <input type="hidden"  name="discount_id" id="discount-id-edit" class="form-control"   >
                </div>
                <div class="form-group">
                    <label for="discount-subcategory-edit">SubCategory</label>
                    <select name="product_sub_category" id="discount-subcategory-edit" class="form-control" required>
                        <option value="">Select SubCategory</option>
                        @foreach($sub_categories as $subcategory)
                            <option value="{{$subcategory->product_sub_category_id}}">{{$subcategory->product_sub_category_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="discount-status-edit">Status</label>
                    <select name="active" id="discount-status-edit" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
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
          $('#reload-discount').on('click', '.discount-edit' , function () {
              let discount_id =  $(this).attr('data-id');

              $.ajax({
                  url:"{{url('admin/discounts')}}/"+discount_id+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){

                      $('#discount-edit-form').find('#discount-parcent-edit').val(data.discount_percentage).focus();
                      $('#discount-edit-form').find('#discount-id-edit').val(data.discount_id);
                      $('#discount-edit-form').find('#discount-status-edit').val(data.active);
                      $('#discount-edit-form').find('#discount-subcategory-edit').val(data.product_sub_category_id);

                      $('#discount-modal').modal('show');
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
