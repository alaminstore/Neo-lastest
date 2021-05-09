@extends('backend.home')
@section('title','Product Infos')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div id="reload-weight">
        <div class="card">
          <div class="card-header">
              <div class="row">
                  <div class="col-4">
                      <h4 class="card-title" style="margin-bottom: 0px;">Product Infos List</h4>
                  </div>
                  <div class="col-8" style="text-align: right;">
                      <a href="{{route('admin.productinfos.create')}}" class="btn btn-sm btn-outline-primary " style="padding: 3px 6px;"><i class="ti-plus"></i> Create</a>
                  </div>
              </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign table-striped"  width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Product Item</th>
                      <th>Regular Price</th>
                      <th>Sales Price</th>
                      <th>Percent</th>
                      <th>Weight</th>
                      <th>Quantity</th>
                      <th>SKU</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="weight-body">
                    @foreach($product_infos as $product_info)
                      <tr class="weight-row-{{$product_info->product_info_id}}">
                        <td>{{$product_info->product_info_id}}</td>
                          <td class="item-column-name-{{$product_info->product_info_id}}">{{$product_info->productItem->product_item_name}}</td>
                          <td class="item-column-name-{{$product_info->product_info_id}}">{{$product_info->price}}</td>
                          <td class="item-column-name-{{$product_info->product_info_id}}">{{$product_info->sales_price ? $product_info->sales_price : ''}}</td>
                          <td class="item-column-name-{{$product_info->product_info_id}}">{{$product_info->percent ? $product_info->percent : ''}}</td>
                          <td class="item-column-name-{{$product_info->product_info_id}}">{{$product_info->productweight->weight}}{{$product_info->productweight->weight_unit}}</td>
                          <td class="item-column-name-{{$product_info->product_info_id}}">{{$product_info->product_quantity}}</td>
                          <td class="item-column-name-{{$product_info->product_info_id}}">{{$product_info->sku}}</td>
                        <td >
                          <a class="btn btn-outline-primary btn-sm item-edit"  href="{{route('admin.productinfos.edit', $product_info->product_info_id)}}" title="Edit"><i class="ti-pencil"></i> Edit</a>
                          <button class="btn btn-outline-danger btn-sm item-delete"   onclick="deleteData({{$product_info->product_info_id}})" title="Delete"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$product_info->product_info_id}}" method="post" action="{{route('admin.productinfos.destroy', $product_info->product_info_id)}}" style="display: none">
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
          $('#reload-weight').on('click', '.weight-edit' , function () {
              let weight =  $(this).attr('data-id');

              $.ajax({
                  url:"{{url('admin/productweights')}}/"+weight+'/edit',
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      $('#weight-edit-form').find('#weight-edit').val(data.weight).focus();
                      $('#weight-edit-form').find('#weight-unit-edit').val(data.weight_unit);
                      $('#weight-edit-form').find('#weight-edit-id').val(data.product_weight_id);
                      $('#weight-modal').modal('show');
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
