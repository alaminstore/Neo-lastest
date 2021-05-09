@extends('backend.home')
@section('title','Products')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-4">
                                <h4 class="card-title">Products List</h4>
                            </div>
                            <div class="col-8" style="text-align: right;">
                                <a href="{{route('admin.products.create')}}" class="btn btn-outline-primary btn-sm"><i class="ti-plus"></i> Create</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="product-table" class="table data-table-assign">
                                        <thead>
                                            <tr>
                                                <th>SI</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th class="text-right">Quantity</th>
                                                <th class="text-right">Regular Price {{$currency_symbol}}</th>
                                                <th class="text-right">Sale Price {{$currency_symbol}}</th>
                                                <th>Category</th>
                                                <th>Subcategory</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $product)
                                                <tr class="product-row-{{$product->id}}">
                                                    <td>{{ ++$loop->index }}</td>
                                                    <td>{{$product->name}}</td>
                                                    <td> @if($product->image)<img src="{{asset($product->image)}}" style="width: 36px; height: 36px;"/>@endif</td>
                                                    <td class="text-right">{{$product->quantity}}</td>
                                                    <td class="text-right">{{$product->regular_price}}</td>
                                                    <td class="text-right">{{$product->sales_price}}</td>
                                                    <td>{{$product->category  != null ? $product->category->category_name : ''}}</td>
                                                    <td>{{$product->subcategory  != null ? $product->subcategory->name : ''}}</td>
                                                    <td>
                                                        <a href="{{route('shop.single',['id'=> $product->id, 'slug'=> $product->slug])}}" class="btn btn-outline-info mr-1 mb-1 single-product-view"   data-product-id="{{$product->id}}" title="Details View"><i class="ti-eye"></i>View</a>
                                                        <a href="{{route('admin.products.edit',$product->id)}}" class="btn btn-outline-primary mr-1 mb-1" title="Edit"><i class="ti-pencil"></i>Edit</a><br>
                                                        <button type="button" class="btn btn-outline-danger mr-1 product-delete" title="Delete"  onclick="deleteData({{$product->id}})" ><i class="ti-trash"></i>Delete</button>
                                                        <form id="delete-form-{{$product->id}}" method="post" action="{{route('admin.products.destroy', $product->id)}}" style="display: none">
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

            $('#order-listing').on('click', '.product-home-view',function () {
                let home        = $(this).prop('checked') == true ? 1 : 0;
                let product_id  = $(this).attr('data-product-home-id');

                $.ajax({
                    method: 'get',
                    url:'{{ url('product/home/change') }}/'+product_id+'/'+home,
                    data :{},
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        toastr.success(data.message);
                    }
                });
            });

        });
    </script>
@endsection