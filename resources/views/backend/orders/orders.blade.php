@extends('backend.home')
@section('title','Orders')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="reload-category">
                <div class="card">
                    <div class="card-header">
                        Orders List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign"  width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Payment Method</th>
                                    <th class="align-right">Order Total({{$currency_symbol}})</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="category-body">
                                    @foreach($orders as $order)
                                        <tr class="order-row-{{$order->order_id}}">
                                            <td>{{$order->order_id}}</td>
                                            <td>{{$order->user->name}}</td>
                                            <td>{{$order->order_date}}</td>
                                            <td>{{$order->order_status}}</td>
                                            <td>{{$order->payment_status}}</td>
                                            <td>{{$order->payment_method}}</td>
                                            <td class="align-right">{{$order->total}}</td>
                                            <td>
                                                <a href="{{route('admin.order.details',$order->order_id)}}" class="btn btn-outline-info mr-1 mb-1 single-order-view"title="View"><i class="ti-eye"></i>View</a>
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
