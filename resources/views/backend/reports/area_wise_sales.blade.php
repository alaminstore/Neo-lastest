@extends('backend.home')
@section('title','Orders')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="product_id" class="form-control" required>
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}"{{request('product_id') == $product->id ? 'selected' : '' }}>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-daterange d-flex align-items-center">
                                    <input type="text" name="from" class="form-control" value="{{request('from')?? date('d-m-Y', strtotime('-1 months'))}}" autocomplete="off">
                                    <div class="input-group-addon mx-4">to</div>
                                    <input type="text" name="to" class="form-control" value="{{request('to') ?? date('d-m-Y')}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(count($area_wise_sales) > 0)
            <div class="col-md-12">
            <div id="reload-category">
                <div class="card">
                    <div class="card-header">
                        Area Wise Sales
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table"  width="100%">
                                <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Area Name</th>
                                    <th>Quantity</th>
                                    <th class="align-right">Total({{$currency_symbol}})</th>
                                </tr>
                                </thead>
                                <tbody id="category-body">
                                @foreach($area_wise_sales as $area_wise_sale)
                                    <tr class="order-row">
                                        <td>{{++$loop->index}}</td>
                                        <td>{{$area_wise_sale->city->name}}</td>
                                        <td >{{$area_wise_sale->quantity}}</td>
                                        <td class="align-right">{{number_format( $area_wise_sale->sales_total),2}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('scripts')

@endsection