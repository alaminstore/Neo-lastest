@extends('backend.home')
@section('title','Stocks')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="reload-stock">
                <div class="card">
                    <div class="card-header">
                       Stocks
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign"  width="100%">
                                <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Stock</th>
                                    <th class="align-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="stock-body">
                                    @foreach($stocks as $stock)
                                        <tr class="order-row">
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$stock->name}}</td>
                                            <td><img src="{{asset($stock->image)}}" alt=""></td>
                                            <td >{{$stock->quantity}}</td>
                                            <td class="align-right">
                                                <button class="btn btn-outline-primary btn-sm stock-edit"  data-id="{{$stock->id}}" title="Edit"><i class="ti-pencil"></i> Edit</button>
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
    <div class="modal fade" id="stock-modal" tabindex="-1" role="dialog" aria-labelledby="city-2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel-2">City Edit: <span id="stock-product-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="stock-edit-form" action="{{route('admin.stocks.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="stock-quantity">Stock</label>
                            <input type="text"  name="quantity" id="stock-quantity" class="form-control"  placeholder="Stock Quantity" required>
                            <input type="hidden"  name="product_id" id="product-id" class="form-control"   >
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
            $('#reload-stock').on('click', '.stock-edit' , function () {
                let stock_id =  $(this).attr('data-id');
                $.ajax({
                    url:"{{url('admin/stocks/edit')}}/"+stock_id,
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        if(data.id)
                        {
                            $('#stock-edit-form').find('#stock-quantity').val(data.quantity).focus();
                            $('#stock-edit-form').find('#product-id').val(data.id);
                            $('#stock-product-name').html(data.name);
                            $('#stock-modal').modal('show');
                        }
                    },
                });
            });

        });

    </script>
@endsection