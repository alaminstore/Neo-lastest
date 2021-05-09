@extends('backend.home')
@section('title','Product Items')
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
                      <h4 class="card-title" style="margin-bottom: 0px;">Product Items List</h4>
                  </div>
                  <div class="col-8" style="text-align: right;">
                      <a href="{{route('admin.productitems.create')}}" class="btn btn-sm btn-outline-primary " style="padding: 3px 6px;"><i class="ti-plus"></i> Create</a>
                  </div>
              </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign"  width="100%">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Product Item</th>
                        <th>Product SubCategory</th>
                        <th>Image</th>
                        <th>NewArival</th>
                        <th>Popular</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="weight-body">
                    @foreach($product_items as $product_item)
                      <tr class="weight-row-{{$product_item->product_item_id}}">
                        <td>{{$product_item->product_item_id}}</td>
                        <td class="item-column-name-{{$product_item->product_item_id}}">{{$product_item->product_item_name}}</td>
                        <td class="item-column-name-{{$product_item->product_item_id}}">{{$product_item->subCategoriy->product_sub_category_name}}</td>
                        <td class="item-column-name-{{$product_item->product_item_id}}"><img src="{{asset($product_item->image)}}" alt="{{$product_item->product_item_name}}"></td>
                          <td class="item-column-name-{{$product_item->product_item_id}}">{{$product_item->new_arrival == 1 ? 'New Arival' : ''}}</td>
                          <td class="item-column-name-{{$product_item->product_item_id}}">{{$product_item->popular == 1 ? 'Popular' : ''}}</td>
                        <td >
                          <a class="btn btn-outline-primary btn-sm item-edit"  href="{{route('admin.productitems.edit', $product_item->product_item_id)}}" title="Edit"><i class="ti-pencil"></i> Edit</a>
                          <button class="btn btn-outline-danger btn-sm item-delete"   onclick="deleteData({{$product_item->product_item_id}})" title="Delete"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$product_item->product_item_id}}" method="post" action="{{route('admin.productitems.destroy', $product_item->product_item_id)}}" style="display: none">
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
      });
    </script>
@endsection