@extends('front.home')

@section('title','Orders - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset('/')}}images/banners/Cart.png"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Orders</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-begin"><a href="{{route('dashboard')}}"><span>Dashboard</span></a></li>
                    <li class="trail-item trail-end active"><span>Orders</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="page-main-content">
                        <div class="kreen">
                            @include('front.user.sidebar')
                            <div class="kreen-MyAccount-content">
                                <div class="kreen-notices-wrapper"></div>
                                <table class="kreen-orders-table kreen-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                    <thead>
                                        <tr>
                                            <th class="kreen-orders-table__header kreen-orders-table__header-order-number"><span class="nobr">Order</span></th>
                                            <th class="kreen-orders-table__header kreen-orders-table__header-order-date"><span class="nobr">Date</span></th>
                                            <th class="kreen-orders-table__header kreen-orders-table__header-order-status"><span class="nobr">Order Status</span></th>
                                            <th class="kreen-orders-table__header kreen-orders-table__header-order-total"><span class="nobr">Total</span></th>
                                            <th class="kreen-orders-table__header kreen-orders-table__header-order-actions"><span class="nobr">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $key => $order)
                                            <tr class="kreen-orders-table__row kreen-orders-table__row--status-on-hold order">
                                                <td class="kreen-orders-table__cell kreen-orders-table__cell-order-number" data-title="Order">
                                                    <a href="#">#{{$order->order_id}}</a>
                                                </td>
                                                <td class="kreen-orders-table__cell kreen-orders-table__cell-order-date" data-title="Date">
                                                    <time datetime="">{{date('F d, Y',strtotime($order->created_at))}}</time>
                                                </td>
                                                <td class="kreen-orders-table__cell kreen-orders-table__cell-order-status" data-title="Status">
                                                    {{ucwords($order->order_status)}}
                                                </td>
                                                <td class="kreen-orders-table__cell kreen-orders-table__cell-order-total" data-title="Total">
                                                    <span class="kreen-Price-amount amount"><span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>{{$order->total}}</span> for
                                                    {{$order->quantity}} items
                                                </td>
                                                <td class="kreen-orders-table__cell kreen-orders-table__cell-order-actions" data-title="Actions">
                                                    <a href="#" class="kreen-button button view show-details-view" data-key="{{$key}}">View</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:0px" colspan="6">
                                                    <div style="height:0px;overflow: hidden;" class="show-detail show-detail-{{$key}}" >
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <div class="row no-gutters">
                                                                        <div class="col-md-6">
                                                                            <h4>Billing Info</h4>
                                                                            <div style="text-align:left" >
                                                                                <p id="billing-name-view">{{ $order->billing->name }}</p>
                                                                                <p id="billing-email-view">{{ $order->user->email }}</p>
                                                                                <p id="billing-mobile-view">{{ $order->user->mobile_no }}</p>
                                                                                <p id="billing-address-view">{{ $order->billing->house_and_street }}</p>
                                                                                <p id="billing-division-view">{{ $order->billing->city }}</p>
                                                                                <p id="billing-district-view">{{ $order->billing->district->name }}</p>
                                                                                <p id="billing-post-view">{{ $order->billing->zip_code }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $subtotal = 0;
                                                            @endphp


                                                            @if(count($order_details) > 0)
                                                                <tr>
                                                                    <td>
                                                                        <table>
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="product-thumbnail">Item</th>
                                                                                    <th>Name</th>
                                                                                    <th class="cart-product-name">Unit Price</th>
                                                                                    <th class="product-price">Quantity</th>
                                                                                    <th class="product-remove">Total</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @php $subTotal = 0; @endphp
                                                                            @foreach($order_details as $detail)
                                                                                @if($order->order_id == $detail->order_id)
                                                                                    <tr>
                                                                                        <td class="product-thumbnail-3">
                                                                                            <a href="javascript:void(0)">
                                                                                                @if($detail->productInfo->productItem)
                                                                                                    <img src="{{asset($detail->productInfo->productItem->image)}}"
                                                                                                         alt="{{$detail->productInfo->productItem->product_item_name}}" width="120"  style="height: 120px;">
                                                                                                @endif
                                                                                            </a>
                                                                                        </td>
                                                                                        <td>{{$detail->productInfo->productItem->product_item_name}}  {{$detail->productInfo->productWeight->weight}}{{$detail->productInfo->productWeight->weight_unit}}</td>
                                                                                        <td >{{$currency_symbol}} {{$detail->unit_price}}</td>
                                                                                        <td >{{$detail->quantity}}</td>
                                                                                        <td >{{$currency_symbol}}{{$detail->total_price}}</td>
                                                                                    </tr>
                                                                                    @php $subTotal += $detail->total_price; @endphp
                                                                                @endif
                                                                            @endforeach
                                                                            <tr>
                                                                                <td colspan="2">Subtotal : {{$currency_symbol}}{{$subTotal}}</td>
                                                                                <td colspan="3">Total : {{$currency_symbol}}{{$order->total}}</td>
                                                                            </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    </div>
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
    </main>
@endsection

@section('js')
    <script>
        $('.show-details-view').on('click', function (e) {
            e.preventDefault();
            let serial = $(this).attr('data-key');
            let maintr =  $(this).closest('tr').siblings();
            let className = $('.show-detail-'+serial);
            if(className.css('height') == '0px')
            {
                className.css('height','auto');
            }
            else
            {
                className.css('height','0px');
            }
        });
    </script>
@endsection
