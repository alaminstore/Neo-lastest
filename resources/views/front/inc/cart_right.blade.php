<div class="meta-dreaming p-fixed" id="mobile-cart">
    <div class="block-minicart block-dreaming kreen-mini-cart kreen-dropdown">
        <div class="shopcart-dropdown block-cart-link" data-kreen="kreen-dropdown">
            <a class="block-link link-dropdown" href="">
                <span class="pe-7s-shopbag"></span>
                <span class="count" id="cart-count-short-float">{{Cart::count()}}</span>
            </a>
        </div>
        <div class="widget kreen widget_shopping_cart">
            <div class="widget_shopping_cart_content">
                <h3 class="minicart-title">Your Cart<span
                        class="minicart-number-items" id="cart-count-short-top">{{Cart::count()}}</span></h3>
                <ul class="kreen-mini-cart cart_list product_list_widget" id="sidebar-product-cart-mini-widget">
                    @forelse(Cart::content() as $cart)
                    <li class="kreen-mini-cart-item mini_cart_item nb-remove-mini-cart-{{$cart->rowId}}">
                        <a href="#" class="remove remove_from_cart_button" data-delete-row-id="{{$cart->rowId}}">×</a>
                        <a href="#">
                            <img src="{{asset($cart->options->image)}}"
                                 class="attachment-kreen_thumbnail size-kreen_thumbnail"
                                 alt="img" width="600" height="778">{{$cart->name}} @if($cart->weight) ({{$cart->weight.''.$cart->options->weight_unit}}) @endif
                        </a>
                        <span class="quantity">{{$cart->qty}} × <span
                                class="kreen-Price-amount amount"><span
                                    class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>{{$cart->price}}</span></span>
                    </li>
                    @empty

                    @endforelse
                </ul>
                <p class="kreen-mini-cart__total total"><strong>Subtotal:</strong>
                    <span class="kreen-Price-amount amount"><span
                            class="kreen-Price-currencySymbol">{{$currency_symbol}}<span id="ct-cart-subtotal">{{Cart::subtotal()}}</span></span></span>
                </p>
                <p class="kreen-mini-cart__buttons buttons">
                    <a href="{{route('cart')}}" class="button kreen-forward">Viewcart</a>
                    <a href="{{Auth::check() ? route('checkout') : route('account.login')}}"
                       class="button checkout kreen-forward">Checkout</a>
                </p>
            </div>
        </div>
    </div>
</div>
