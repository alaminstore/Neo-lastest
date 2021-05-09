@extends('front.home')

@section('title','Checkout - Coastalino')

@section('content')

    <div class="banner-wrapper has_background">
        <img src="{{asset('/')}}images/banners/Cart.png"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Checkout</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Checkout</span>
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
                            <div class="kreen-notices-wrapper"></div>
                            <form name="checkout" action="{{url('pay')}}" method="post" class="checkout kreen-checkout"
                                  action="" enctype="multipart/form-data"
                                  novalidate="novalidate">
                                @csrf
                                <div class="col2-set" id="customer_details">
                                    <div class="col-1">
                                        <div class="kreen-billing-fields">
                                            <h3>Billing details</h3>
                                            <div class="kreen-billing-fields__field-wrapper">
                                                <p class="form-row form-row-wide validate-required"
                                                   id="billing_first_name_field" data-priority="10"><label
                                                        for="billing_first_name" class="">Name&nbsp;<abbr
                                                            class="required" title="required">*</abbr></label><span
                                                        class="kreen-input-wrapper">
                                                        <input type="text" class="input-text " name="name"
                                                               id="billing_first_name" placeholder=""
                                                               value="{{$address ? ($address->name ?? '') : old('name')}}"
                                                               autocomplete="given-name" required>
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide validate-required"
                                                   id="billing_first_name_field" data-priority="10"><label
                                                        for="billing_first_name" class="">Phone Number&nbsp;<abbr
                                                            class="required" title="required">*</abbr></label><span
                                                        class="kreen-input-wrapper">
                                                        <input type="text" class="input-text " name="phone"
                                                               id="billing_first_name" placeholder=""
                                                               value="{{$address ? ($address->phone ?? '') : old('phone')}}"
                                                               autocomplete="given-name" required>
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide" id="billing_company_field"
                                                   data-priority="30">
                                                    <label for="billing_company" class="">Company name&nbsp;<span
                                                            class="optional">(optional)</span></label><span
                                                        class="kreen-input-wrapper">
                                                        <input type="text" class="input-text" name="company"
                                                               id="billing_company"
                                                               placeholder=""
                                                               value="{{$address ? ($address->company ?? '') : old('company')}}"
                                                               autocomplete="organization">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide adchair-field update_totals_on_change validate-required"
                                                   id="billing_country_field" data-priority="40"><label
                                                        for="billing_country" class="">Country&nbsp;<abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <span class="kreen-input-wrapper">
                                                        <select name="country" id="billing_country"
                                                                class="country_to_state country_select"
                                                                autocomplete="country" tabindex="-1" aria-hidden="true"
                                                                required>
                                                            <option value="">Select a country…</option>
                                                            <option value="bangladesh" selected>Bangladesh</option>

                                                        </select>
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide adchair-field validate-required"
                                                   id="billing_adchair_1_field" data-priority="50">
                                                    <label for="billing_adchair_1" class="">Street address&nbsp;<abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <span
                                                        class="kreen-input-wrapper">
                                                        <input type="text" class="input-text " name="house_and_street"
                                                               id="billing_adchair_1"
                                                               placeholder="House number and street name"
                                                               value="{{$address ? ($address->house_and_street ?? '') : old('house_and_street')}}"
                                                               autocomplete="address"
                                                               data-placeholder="House number and street name" required>
                                                    </span>
                                                </p>

                                                <p class="form-row form-row-wide adchair-field validate-postcode validate-required"
                                                   id="billing_postcode_field" data-priority="65"
                                                   data-o_class="form-row form-row-wide adchair-field validate-postcode">
                                                    <label for="billing_postcode" class="">Postcode / ZIP&nbsp;<abbr
                                                            class="required" title="required">*</abbr>
                                                    </label>
                                                    <span class="kreen-input-wrapper">
                                                        <input type="text" class="input-text " name="zip_code"
                                                               id="billing_postcode"
                                                               placeholder=""
                                                               value="{{$address ? ($address->zip_code ?? '') : old('zip_code')}}"
                                                               autocomplete="postal-code" required>
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide adchair-field validate-required"
                                                   id="billing_city_field" data-priority="70"
                                                   data-o_class="form-row form-row-wide adchair-field validate-required">
                                                    <label for="billing_city" class="">Town / City&nbsp;<abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <span class="kreen-input-wrapper">
                                                        <input type="text" class="input-text " name="city"
                                                               id="billing_city" placeholder=""
                                                               value="{{$address ? ($address->city ?? '') : old('city')}}"
                                                               autocomplete="adchair-level2" required>
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide adchair-field validate-state validate-required"
                                                   id="billing_state_field"
                                                   data-o_class="form-row form-row-wide adchair-field validate-state">
                                                    <label for="billing_state" class="">District&nbsp;<abbr
                                                            class="required" title="required">*</abbr></label>
                                                    <span class="kreen-input-wrapper">
                                                        <select name="district" id="billing_country"
                                                                class="country_to_state country_select"
                                                                autocomplete="country" tabindex="-1" aria-hidden="true"
                                                                required>
                                                            <option value="">Select a district…</option>
                                                            @foreach($districts as $district)
                                                                <option
                                                                    value="{{$district->district_id}}" {{$address? ( $district->district_id == $address->district_id ? 'selected' : '') : ''}}>{{$district->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="kreen-shipping-fields">
                                        </div>
                                        <div class="kreen-additional-fields">
                                            <h3>Additional information</h3>
                                            <div class="kreen-additional-fields__field-wrapper">
                                                <p class="form-row notes" id="order_comments_field" data-priority="">
                                                    <label for="order_comments" class="">Order notes&nbsp;<span
                                                            class="optional">(optional)</span></label>
                                                    <span class="kreen-input-wrapper">
                                                        <textarea name="note" class="input-text " id="order_comments"
                                                                  placeholder="Notes about your order, e.g. special notes for delivery."
                                                                  rows="2" cols="5"></textarea>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 id="order_review_heading">Your order</h3>
                                <div id="order_review" class="kreen-checkout-review-order">
                                    <table class="shop_table kreen-checkout-review-order-table">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(Cart::count())
                                            @forelse(Cart::content() as $cart)
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        {{$cart->name}} @if($cart->weight)
                                                            ({{$cart->weight.''.$cart->options->weight_unit}}) @endif
                                                        &nbsp;&nbsp; <strong class="product-quantity">×
                                                            {{$cart->qty}}</strong></td>
                                                    <td class="product-total">
                                                    <span class="kreen-Price-amount amount"><span
                                                            class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>{{$cart->price * $cart->qty}}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                        <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="kreen-Price-amount amount">
                                                        <span
                                                            class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>{{Cart::subtotal()}}</span>
                                            </td>
                                        </tr>
                                        @if(session()->exists('newsletter_discount') >= 1)
                                            <tr class="cart-subtotal">
                                                <th>Newsletter Discount</th>
                                                <td>
                                                    <strong>
                                                        <span class="kreen-Price-amount amount">
                                                            <span
                                                                class="kreen-Price-currencySymbol">-{{$currency_symbol}}</span>
                                                            {{(session()->exists('newsletter_discount') ? session()->get('newsletter_discount') : '') }}
                                                            {{-- newsletter_discount Session sent after calculation --}}
                                                        </span>
                                                    </strong>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <strong>
                                                        <span class="kreen-Price-amount amount">
                                                            <span
                                                                class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                            {{-- @if (session()->exists('newsletter_discount'))
                                                                {{Cart::total() - session()->get('newsletter_discount')}}
                                                                @else
                                                                {{Cart::total() - 0}}
                                                            @endif --}}

                                                            {{Cart::total() - (session()->exists('newsletter_discount') ? session()->get('newsletter_discount') : 0)}}
                                                        </span>
                                                </strong>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <!--<div class="checkout_coupon kreen-form-coupon kreen-form-show" >-->

                                    <!--    <p>Have a coupon code, please apply it below.</p>-->
                                    <!--    <p class="form-row form-row-first">-->
                                    <!--        <input type="text" name="coupon_code" class="input-text"-->
                                    <!--               placeholder="Coupon code" id="coupon_code" value="">-->
                                    <!--    </p>-->
                                    <!--    <p class="form-row form-row-last">-->
                                    <!--        <button type="submit" class="button" name="apply_coupon" value="Apply coupon">-->
                                    <!--            Apply coupon-->
                                    <!--        </button>-->
                                    <!--    </p>-->
                                    <!--    <div class="clear"></div>-->
                                    <!--</div>-->
                                    <div id="payment" class="kreen-checkout-payment">
                                        <ul class="wc_payment_methods payment_methods methods">
                                            <li class="wc_payment_method payment_method_cod">
                                                <input id="payment_method_cod" type="radio" class="input-radio"
                                                       name="payment_method" value="cash_on_delivery"
                                                       data-order_button_text="" checked="checked">
                                                <label for="payment_method_cod">
                                                    Cash on delivery </label>
                                                <div class="payment_box payment_method_cod">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </li>
                                            <li class="wc_payment_method payment_method_paypal">
                                                <input id="payment_method_ssl_commerz" type="radio" class="input-radio"
                                                       name="payment_method" value="ssl_commerz"
                                                       data-order_button_text="Proceed to PayPal">
                                                <label for="payment_method_ssl_commerz">
                                                    SSLCOMMERZ </label>
                                                <div class="payment_box payment_method_ssl_commerz">
                                                    <p>Pay via SSLCOMMERZ. You can pay with your card and bKash.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-row place-order">
                                            <noscript>
                                                Since your browser does not support JavaScript, or it is disabled,
                                                please
                                                ensure you click the <em>Update Totals</em> button before placing your
                                                order. You may be charged more than the amount stated above if you fail
                                                to
                                                do so. <br/>
                                                <button type="submit" class="button alt"
                                                        name="kreen_checkout_update_totals" value="Update totals">
                                                    Update totals
                                                </button>
                                            </noscript>
                                            <div class="kreen-terms-and-conditions-wrapper">
                                                <div class="kreen-privacy-policy-text"><p>Your personal data will be
                                                        used to process your order, support your experience throughout
                                                        this
                                                        website, and for other purposes described in our <a
                                                            href="{{route('page',['page'=>'privacy-policy'])}}"
                                                            class="kreen-privacy-policy-link" target="_blank">privacy
                                                            policy</a>.</p>
                                                </div>
                                            </div>
                                            <button style="cursor: pointer;" type="submit" class="button alt" name="kreen_checkout_place_order"
                                                    id="place_order" value="Place order" data-value="Place order">Place
                                                order
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        $('#s-district').on('change', function (event) {
            event.preventDefault();
            let district_id = $(this).val();
            let options = '';
            $.ajax({
                url: "{{url('cities/find')}}/" + district_id,
                method: "get",
                data: {},
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (i, city) {
                        options += `<option value="` + city.id + `">` + city.name + `</option>`;
                    })
                    $('#s-city').html(`<option value="">Select Attribute</option>` + options + ``);
                },

            });
        });
    </script>
@endsection
