@extends('backend.home')
@section('title','Order Details')
@section('content')
    <div class="row ">
        <div class="col-md-12 text-right mb-2">
            <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-dark text-light">Back</a>
        </div>
    </div>

    <div class="row order-details-view">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Order No: #{{$order->order_id }} Order Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>General Info</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Date</label>
                                    <p>{{date('d-m-Y h:i a',strtotime($order->created_at))}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Order Status</label>
                                    <p id="order-status-view">{{$order->order_status}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Payment Method</label>
                                    <p>{{$order->payment_method}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Payment Status</label>
                                    <p id="payment-status-view">{{$order->payment_status}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <h4>Customer Info</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <p>{{$order->user->name}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Email Address</label>
                                    <p>{{$order->user->email}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>Contact Number</label>
                                    <p>{{$order->user->mobile_no}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="d-flex align-items-center pb-3">
                                <div class="">
                                    <h4 class="mb-0">Billing Info</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 ">
                                    <p id="shipping-name-view">{{ $order->billing->name }}</p>
                                    <p id="shipping-email-view">{{ $order->user->email }}</p>
                                    <p id="shipping-mobile-view">{{ $order->billing->phone }}</p>
                                    <p id="shipping-address-view">{{ $order->billing->house_and_street }}</p>
                                    <p id="shipping-division-view">{{ $order->billing->city }}</p>
                                    <p id="shipping-district-view">{{ $order->billing->district->name }}</p>
                                    <p id="shipping-post-view">{{ $order->billing->zip_code }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(count($order_items) > 0)
                <div class="card mt-3">
                    <div class="card-header">
                        Order item
                    </div>
                    <div class="card-body">
                        <div class="table-responsive w-100  order-item-table">
                            <table class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="4">Item</th>
                                        <th class="text-right">price</th>
                                        <th  class="text-right">Quantity</th>
                                        <th  class="text-right">Total</th>
                                    </tr>
                                </thead>
                                @php
                                    $subtotal = 0;
                                @endphp

                                @foreach($order_items as $order_item)
                                <tr>
                                    <td colspan="4">
                                        <div class="order-details-item">
                                            <img class="img-sm rounded-circle" src="{{asset($order_item->productInfo->productItem->image)}}">
                                            {{$order_item->productInfo->productItem->product_item_name}} {{$order_item->productInfo->productWeight->weight}}{{$order_item->productInfo->productWeight->weight_unit}}
                                        </div>
                                    </td>
                                    <td  class="text-right">{{$currency_symbol}} {{$order_item->unit_price}}</td>
                                    <td  class="text-right">{{$order_item->quantity}}</td>
                                    <td  class="text-right">{{$currency_symbol}}{{$order_item->total_price}}</td>
                                </tr>
                                    @php $subtotal += $order_item->total_price;  @endphp
                                @endforeach

                                <tr>
                                    <td colspan="4">
                                        &nbsp;
                                    </td>
                                    <td  class="text-right" colspan="2"><b>Subtotal</b></td>
                                    <td  class="text-right">{{$currency_symbol}}{{$subtotal}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        &nbsp;
                                    </td>
                                    <td  class="text-right" colspan="2"><b>Newsletter Discount</b></td>
                                    <td  class="text-right">{{$currency_symbol}}{{$order->newsletter_subscription_discount}}</td>
                                </tr>

                                @if($order->shipping_price)
                                    <tr>
                                        <td colspan="4">
                                            &nbsp;
                                        </td>
                                        <td  class="text-right" colspan="2"><b>Shipping</b></td>
                                        <td  class="text-right">{{$currency_symbol}}{{$order->shipping_price}}</td>
                                    </tr>
                                @endif

                                @if($order->coupon_amount)
                                    <tr>
                                        <td colspan="4">
                                            &nbsp;
                                        </td>
                                        <td  class="text-right" colspan="2"><b>Coupon</b></td>
                                        <td  class="text-right">{{$currency_symbol}}{{$order->coupon_amount}}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <td colspan="4">
                                        &nbsp;
                                    </td>
                                    <td  class="text-right" colspan="2"><b>Total</b></td>
                                    <td  class="text-right">{{$currency_symbol}}{{$order->total}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Order Status
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="order-status-change">
                                <div class="form-group">
                                    <label for="order-status-select">Status</label>
                                    <select class="form-control" name="order_status" id="order-status-select">
                                        <option value=""> Select Status</option>
                                        <option value="order confirmed" {{$order->order_status == 'order confirmed' ? 'selected' : ''}}>Order Confirmed</option>
                                        <option value="processing" {{$order->order_status == 'processing' ? 'selected' : ''}}>Processing</option>
                                        <option value="order shipping" {{$order->order_status == 'order shipping' ? 'selected' : ''}}>Order Shipping</option>
                                        <option value="order delivered" {{$order->order_status == 'order delivered' ? 'selected' : ''}}>Order Delivered</option>
                                        <option value="canceled" {{$order->order_status == 'canceled' ? 'selected' : ''}}>Canceled</option>
                                    </select>
                                    <input type="hidden" name="order_id" value="{{$order->order_id}}">
                                </div>
                                <button  type="submit" class="btn btn-info btn-sm mt-1"  style="color: #ffffff;"> update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    Payment Status
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="payment-status-change">
                                <div class="form-group">
                                    <label for="payment-status-select">Status</label>
                                    <select class="form-control" name="payment_status" id="payment-status-select">
                                        <option value=""> Select Payment Status</option>
                                        <option value="Pending" {{$order->payment_status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                        <option value="Complete" {{$order->payment_status == 'Complete' ? 'selected' : ''}}>Complete</option>
                                        <option value="Canceled" {{$order->payment_status == 'Canceled' ? 'selected' : ''}}>Canceled</option>
                                        <option value="Refund" {{$order->payment_status == 'Refund' ? 'selected' : ''}}>Refund</option>
                                        <option value="Failed" {{$order->payment_status == 'Failed' ? 'selected' : ''}}>Failed</option>
                                    </select>
                                    <input type="hidden" name="order_id" value="{{$order->order_id}}">
                                </div>
                                <button  type="submit" class="btn btn-info btn-sm mt-1"  style="color: #ffffff;"> update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            // validation order status change
            $("#order-status-change").validate({
                ignore: [],
                debug: true,
                rules: {
                    order_status: {
                        required: true,
                    }
                }
            });

            $("#payment-status-change").validate({
                ignore: [],
                debug: true,
                rules: {
                    payment_status: {
                        required: true,
                    }
                }
            });

            $("#shipping-edit-form").validate({
                ignore: [],
                debug: true,
                rules: {
                    name: {
                        required: true,
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        minlength: 11,
                        maxlength: 11,
                    },
                    division: {
                        required: true,
                    },
                    district: {
                        required: true,
                    },
                    postal_code: {
                        required: true,
                    },
                    street_address: {
                        required: true,
                    },
                }
            });

            $('#order-status-change').on('submit', function (event) {
                event.preventDefault();

                let formData = $(this).serialize();

                if($('#order-status-change').valid())
                {
                    $.ajax({
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:'{{route("admin.order.status")}}',
                        data :formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            if(data.order_status)
                            {
                                $('#order-status-view').html(data.order_status.order_status);
                                $('#order-status-select').val(data.order_status.order_status);
                            }


                            if(data.notification['alert-type'] == 'success')
                            {
                                toastr.success(data.notification.message);
                            }

                            if(data.notification['alert-type'] == 'error')
                            {
                                toastr.success(data.notification.message);
                            }

                        },
                        error: function(error){
                            if (error.status == 422) {
                                $.each(error.responseJSON.errors, function (i, message) {
                                    toastr.error(message);
                                });
                            }
                        },
                    });
                }

            });

            $('#payment-status-change').on('submit', function (event) {
                event.preventDefault();

                let formData = $(this).serialize();

                if($('#payment-status-change').valid())
                {
                    $.ajax({
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:'{{route('admin.order.payment.status')}}',
                        data :formData,
                        dataType: 'json',
                        success: function(data)
                        {
                            $('#payment-status-view').html(data.payment_status.payment_status);
                            $('#payment-status-select').val(data.payment_status.payment_status);

                            if(data.notification['alert-type'] == 'success')
                            {
                                toastr.success(data.notification.message);
                            }

                            if(data.notification['alert-type'] == 'error')
                            {
                                toastr.success(data.notification.message);
                            }
                        },
                        error: function(error){
                            if (error.status == 422) {
                                $.each(error.responseJSON.errors, function (i, message) {
                                    toastr.error(message);
                                });
                            }
                        },
                    });
                }

            });

            $('.order-details-view').on('click', '.shipping-info-edit' , function (event) {
                event.preventDefault();
                let shipping_id =  $(this).attr('data-shipping-id');
                $.ajax({
                    url:"{{url('shipping/edit')}}/"+shipping_id,
                    method:"get",
                    data:{},
                    dataType: 'json',
                    success:function(data){
                        $('#shipping-edit-form').find('#shipping-name').val(data.name).focus();
                        $('#shipping-edit-form').find('#shipping-mobile').val(data.mobile);
                        $('#shipping-edit-form').find('#shipping-division').val(data.division);
                        $('#shipping-edit-form').find('#shipping-district').val(data.district);
                        $('#shipping-edit-form').find('#shipping-postal-code').val(data.postal_code);
                        $('#shipping-edit-form').find('#shipping-address').val(data.street_address);

                        $('#shipping-modal').modal('show');
                    },

                });
            });

            $('#shipping-modal').on('submit', '#shipping-edit-form', function (e) {
                e.preventDefault();

                let formEditData = $(this).serialize();
                if($('#shipping-edit-form').valid()) {
                    $.ajax({
                        type: 'post',
                        url: "",
                        data: formEditData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function (data) {

                            $('#shipping-name-view').html(data.shipping.name);
                            $('#shipping-mobile-view').html(data.shipping.mobile);
                            $('#shipping-division-view').html(data.shipping.division);
                            $('#shipping-district-view').html(data.shipping.district);
                            $('#shipping-post-view').html(data.shipping.postal_code);
                            $('#shipping-address-view').html(data.shipping.street_address);
                            if(data.notification['alert-type'] == 'success')
                            {
                                toastr.success(data.notification.message);
                            }

                            if(data.notification['alert-type'] == 'error')
                            {
                                toastr.success(data.notification.message);
                            }

                            $('#shipping-modal').modal('hide');
                        },
                        error: function (error) {
                            if (error.status == 422) {
                                $.each(error.responseJSON.errors, function (i, message) {
                                    toastr.error(message);
                                });
                            }
                        },

                    });
                }
            });
        });
    </script>
@endsection
