@extends('backend.home')
@section('title','Customers')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="reload-customer">
                <div class="card">
                    <div class="card-header">
                        Customers List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign" id="customer-list" width="100%">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                </tr>
                                </thead>
                                <tbody id="customer-body">
                                @foreach($customers as $customer)
                                    <tr class="customer-row-{{$customer->id}}">
                                        <td>{{$customer->id}}</td>
                                        <td class="customer-column-name-{{$customer->id}}">{{$customer->name}}</td>
                                        <td class="customer-column-name-{{$customer->id}}">{{$customer->email}}</td>
                                        <td class="customer-column-name-{{$customer->id}}">{{$customer->phone}}</td>
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