@extends('backend.home')
@section('title','Out Of Stock Products')
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
                      <h4 class="card-title" style="margin-bottom: 0px;">Out Of Stock Products List</h4>
                  </div>

              </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign"  width="100%">
                <thead>
                    <tr>
                      <th class="text-center">Product Id</th>
                      <th class="text-center">Product Name</th>
                      <th class="text-center">Image</th>
                      <th class="text-center">Weight</th>
                      <th class="text-center">Quantity</th>
                    </tr>
                </thead>
                <tbody id="weight-body">
                    @foreach($product_infos as $product_info)
                      <tr class="weight-row-{{$product_info->product_info_id}}">
                          <td class="text-center">{{$product_info->product_info_id}}</td>
                          <td class="text-center">{{$product_info->productItem->product_item_name}}</td>
                          <td class="text-center"><img src="{{asset($product_info->productItem->image)}}" alt="Product Image"></td>
                          <td class="text-center">{{$product_info->productweight->weight}} {{$product_info->productweight->weight_unit}}</td>
                          <td class="text-center">{{$product_info->product_quantity}}</td>
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
