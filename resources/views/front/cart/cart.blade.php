@extends('front.home')

@section('title','Cart - NeoBazaar')

@section('content')

    <div class="banner-wrapper has_background">
        <img src="{{asset('/')}}images/banners/Cart.png"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Cart</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Cart</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <main class="site-main main-container no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="page-main-content">
                        <div class="kreen cart-page">
                            <div class="kreen-notices-wrapper"></div>
                            <div class="row">
                                <div class="col-lg-9 col-sm-12">
                                    <form class="kreen-cart-form">
                                        <table class="shop_table shop_table_responsive cart kreen-cart-form__contents"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th class="product-remove">&nbsp;</th>
                                                <th class="product-thumbnail">&nbsp;</th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody id="table-body-cart">
                                            @if(Cart::count())
                                            @forelse(Cart::content() as $cart)
                                                    <tr class="kreen-cart-form__cart-item cart_item nb-remove-mini-cart-{{$cart->rowId}} cart-item-cart-page-tr-{{$cart->rowId}}">

                                                            <td class="product-remove">
                                                                <a href="#" class="remove remove_from_cart_button" aria-label="Remove this item"  data-delete-row-id="{{$cart->rowId}}">×</a>
                                                            </td>
                                                            <td class="product-thumbnail">
                                                                <a href="#">
                                                                    <img src="{{asset($cart->options->image)}}" class="attachment-kreen_thumbnail size-kreen_thumbnail"
                                                                            alt="img" width="600" height="778">
                                                                </a>
                                                            </td>
                                                            <td class="product-name" data-title="Product">
                                                                <a href="#">{{$cart->name}} @if($cart->weight) ({{$cart->weight.''.$cart->options->weight_unit}}) @endif</a>
                                                            </td>
                                                            <td class="product-price" data-title="Price">
                                                                <span class="kreen-Price-amount amount">
                                                                    <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                    {{$cart->price}}
                                                                </span>
                                                            </td>
                                                            <td class="product-quantity" data-title="Quantity">

                                                                <div class="quantity">
                                                                    <span class="qty-label">Quantiy:</span>
                                                                    <div class="control">
                                                                        <a class="btn-number qtyminus quantity-minus" data-rowid="{{$cart->rowId}}" href="#">-</a>
                                                                        <input type="text" data-step="1" min="1" max="" name="quantity"
                                                                                value="{{$cart->qty}}" title="Qty"
                                                                               class="input-qty input-text qty text" size="4"
                                                                               pattern="[0-9]*" inputmode="numeric" />
                                                                        <a class="btn-number qtyplus quantity-plus" data-rowid="{{$cart->rowId}}" href="#">+</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="product-subtotal" data-title="Total">
                                                                <span class="kreen-Price-amount amount">
                                                                    <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                    <span class="nb-cart-page-product-total-{{$cart->rowId}}">{{$cart->price * $cart->qty}}</span>
                                                                </span>
                                                            </td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                                @endif
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <div class="cart-collaterals sticky-top">
                                        <div class="cart_totals ">
                                            <h2>Cart totals</h2>
                                            <table class="shop_table shop_table_responsive" cellspacing="0">
                                                <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td data-title="Subtotal"><span class="kreen-Price-amount amount"><span
                                                                    class="kreen-Price-currencySymbol">{{$currency_symbol}}</span><span id="cart-page-subtotal">{{Cart::subtotal()}}</span></span></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td data-title="Total"><strong><span
                                                                    class="kreen-Price-amount amount"><span
                                                                        class="kreen-Price-currencySymbol">{{$currency_symbol}}</span><span id="cart-page-total">{{Cart::total()}}</span></span></strong>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="kreen-proceed-to-checkout">
                                                <a href="{{route('checkout')}}"
                                                   class="checkout-button button alt kreen-forward">
                                                    Proceed to checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{asset('front')}}/assets/js/cart.js"></script>
@endsection
