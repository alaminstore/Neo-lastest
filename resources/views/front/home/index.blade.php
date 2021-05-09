@extends('front.home')

@section('content')


<style>
    .qt-btn-ad-to-cart{
        cursor: pointer;
    }
</style>


    <div class="fullwidth-template">
        @if(count($sliders) > 0)
        <div class="slide-home-03">
            <div class="response-product product-list-owl owl-slick main-banner equal-container better-height"
                 data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:0,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;autoplay&quot;:true,&quot;speed&quot;:500,&quot;slidesToShow&quot;:1,&quot;rows&quot;:1,&quot;pauseOnFocus&quot;:false}"
                 data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}}]">
                @foreach($sliders as $slider)
                <div class="slide-wrap">
                    <a href="{{$slider->add_link}}" target="_blank">
                        <img src="{{asset($slider->image)}}" alt="image">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @if(count($new_arrival_products) > 0)
            <!-- new arrival -->
            <div class="section-001 pb-0 shop-page">
            <div class="container">
                <div class="kreen-heading style-01">
                    <div class="heading-inner">
                        <h3 class="title">New Arrival</h3>
                    </div>
                </div>
                <div class="kreen-products style-04">
                    <div class="response-product product-list-owl owl-slick equal-container better-height"
                         data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}"
                         data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                        @forelse($new_arrival_products as $product)
                        <div class="product-item recent-product style-04 rows-space-0 post-93 product type-product status-publish has-post-thumbnail product_cat-light product_cat-table product_cat-new-arrivals product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-simple">
                            <form action="" class="product-single-add-to-cart">
                                <div class="product-inner tooltip-top tooltip-all-top">
                                    <div class="product-thumb">
                                        <a class="thumb-link"
                                           href="{{route('shop.single',['id'=> $product->product_item_id, 'slug'=> $product->slug])}}" tabindex="0">
                                            <img class="img-responsive"
                                                 src="{{asset($product->image)}}"
                                                 alt="Wanuts" width="270" height="350">
                                        </a>
                                        <div class="qt-drop-wrapper qt-multiple">
                                            <div class="add-to-cart-top" style="display: flex; justify-content: space-between;">
                                                <div class="qt-multiple-close mt-1 qt-multiple-out-of-stock" >
                                                    @if($new_arrival_product_info_min_price[$product->product_item_id])
                                                        @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->price == $new_arrival_product_info_min_price[$product->product_item_id])
                                                                @if(!$product_info->product_quantity)
                                                                    <span class="sold-out"><span> Out of stock</span></span>
                                                                    @break
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="qt-btn-close qt-multiple-close">
                                                    <span>Close </span>
                                                    <span class="qt-close">&times;</span>
                                                </div>
                                            </div>


                                            <div class="select-weight-wrapper">

                                                <label for="">Weight:</label>
                                                @if(count($new_arrival_product_infos[$product->product_item_id]) > 1)
                                                    <select name="product_info" class="variable-product-option-change">
                                                        <option value="">Choose an Option</option>
                                                        @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->productWeight)
                                                                <option value="{{$product_info->product_info_id}}" {{ $product_info->price == $new_arrival_product_info_min_price[$product->product_item_id] ? 'selected' : ''  }}>
                                                                    {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @else
                                                    @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                        <input type="hidden" name="product_info" value="{{$product_info->product_info_id}}">
                                                        @if($product_info->productWeight)
                                                            {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="qt-price-wrapper">
                                                <span class="price qt-price">
                                                    @if($new_arrival_product_info_min_price[$product->product_item_id])
                                                        @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->price == $new_arrival_product_info_min_price[$product->product_item_id])
                                                                @if($product_info->sales_price)
                                                                    <del>
                                                                        <span class="kreen-Price-amount amount">
                                                                            <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                            {{$product_info->price}}
                                                                        </span>
                                                                    </del>
                                                                    <ins>
                                                                        <span class="kreen-Price-amount amount">
                                                                            <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                            {{$product_info->sales_price}}
                                                                        </span>
                                                                    </ins>
                                                                    @break
                                                                @else
                                                                    <ins>
                                                                        <span class="kreen-Price-amount amount">
                                                                            <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                            {{$product_info->price}}
                                                                        </span>
                                                                    </ins>
                                                                    @break
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </div>

                                            <div class="qt-ad-to-cart">
                                                <button type="submit" class="qt-btn-ad-to-cart cart-multiple"
                                                        @if($new_arrival_product_info_min_price[$product->product_item_id])
                                                        @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                        @if($product_info->price == $new_arrival_product_info_min_price[$product->product_item_id])
                                                        data-product-id="{{$product_info->product_info_id}}"
                                                    @break
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                >Add to cart</button>
                                                <div class="quantity-wrapper multiple-quantity">
                                                    <div class="quantity ">
                                                        <span class="qty-label">Quantiy:</span>
                                                        <div class="control">
                                                            <a class="btn-number qtyminus quantity-minus nb-shops-quantity-minus" href="#">-</a>
                                                            <input type="text" data-step="1" min="0" max="" name="quantity" readonly value="0" title="Qty" class="input-qty input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
                                                            <a class="btn-number qtyplus quantity-plus nb-shops-quantity-plus" href="#" style="pointer-events: auto;">+</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flash">
                                            @if($new_arrival_product_info_min_price[$product->product_item_id])
                                                @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                    @if($product_info->price == $new_arrival_product_info_min_price[$product->product_item_id])
                                                        @if($product_info->product_quantity)
                                                            @if($product_info->percent)
                                                                <span class="onsale"><span class="number">-{{$product_info->percent}}%</span></span>
                                                                @break
                                                            @endif
                                                        @else
                                                            <span class="sold-out"><span> Out of stock</span></span>
                                                            @break
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="group-button">
                                            <div class="add-to-cart">
                                                <a href="#" onclick="return false"
                                                   class="button product_type_simple add_to_cart_button ajax_add_to_cart qt-select-open qt-multiple-open ">Add to
                                                    cart</a>
                                            </div>
                                            <a href="#" class="button yith-wcqv-button product-quick-view" role="button" data-product-id="{{$product->product_item_id}}">Quick View</a>
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <div class="yith-wcwl-add-button show">
                                                    <a href="#" class="add_to_wishlist add-to-favorite-shop"
                                                       @if($new_arrival_product_info_min_price[$product->product_item_id])
                                                           @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                               @if($product_info->price == $new_arrival_product_info_min_price[$product->product_item_id])
                                                               data-product-id="{{$product_info->product_info_id}}"
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    >Add to Favorite</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-name product_title">
                                            <a href="{{route('shop.single',['id'=> $product->product_item_id, 'slug'=> $product->slug])}}"
                                               tabindex="0">{{$product->product_item_name}}</a>
                                        </h3>
                                        <span class="price">
                                            @if($new_arrival_product_info_min_price[$product->product_item_id])
                                                @foreach($new_arrival_product_infos[$product->product_item_id] as $product_info)
                                                    @if($product_info->price == $new_arrival_product_info_min_price[$product->product_item_id])
                                                        @if($product_info->sales_price)
                                                            <del>
                                                                <span class="kreen-Price-amount amount">
                                                                    <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                    {{$product_info->price}}
                                                                </span>
                                                            </del>
                                                            <ins>
                                                                <span class="kreen-Price-amount amount">
                                                                    <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                    {{$product_info->sales_price}}
                                                                </span>
                                                            </ins>
                                                            @break
                                                        @else
                                                            <ins>
                                                                    <span class="kreen-Price-amount amount">
                                                                        <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                        {{$product_info->price}}
                                                                    </span>
                                                                </ins>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                        <div class="rating">
                                            <?php
                                                $rating=floor($product->product_rating);
                                                $star = intval($rating);
                                                $i = 0;

                                            ?>
                                            @if ($rating)
                                            @for($i=0;$i<$star;$i++)
                                            <i  style="color:#eebe19;" class="fa fa-star"></i>
                                            @endfor
                                            @else
                                            @for($i=0;$i<5;$i++)
                                            <i  style="color:;" class="fa fa-star-o"></i>
                                            @endfor
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
                <div class="view-btn-wrapper">
                    <div class="view-btn-inner">
                        <a href="{{route('shop')}}?show=newarrival"><span>view all</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(count($popular_products) > 0)
            <!-- Top Trend / Popular This Week -->
            <div class="section-001 pb-0 shop-page">
            <div class="container">
                <div class="kreen-heading style-01">
                    <div class="heading-inner">
                        <h3 class="title">Popular This Week</h3>
                    </div>
                </div>
                <div class="kreen-products style-04">
                    <div class="response-product product-list-owl owl-slick equal-container better-height"
                         data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}"
                         data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                        @forelse($popular_products as $product)

                            <div class="product-item recent-product style-04 rows-space-0 post-93 product type-product status-publish has-post-thumbnail product_cat-light product_cat-table product_cat-new-arrivals product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-simple  ">
                                <form action="" class="product-single-add-to-cart">
                                    <div class="product-inner tooltip-top tooltip-all-top">
                                        <div class="product-thumb">
                                            <a class="thumb-link"
                                               href="{{route('shop.single',['id'=> $product->product_item_id, 'slug'=> $product->slug])}}" tabindex="0">
                                                <img class="img-responsive"
                                                     src="{{asset($product->image)}}"
                                                     alt="Wanuts" width="270" height="350">
                                            </a>
                                            <div class="qt-drop-wrapper qt-multiple">
                                                <div class="add-to-cart-top" style="display: flex; justify-content: space-between;">
                                                    <div class="qt-multiple-close mt-1 qt-multiple-out-of-stock" >
                                                        @if($popular_product_info_min_price[$product->product_item_id])
                                                            @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                                @if($product_info->price == $popular_product_info_min_price[$product->product_item_id])
                                                                    @if(!$product_info->product_quantity)
                                                                        <span class="sold-out"><span> Out of stock</span></span>
                                                                        @break
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="qt-btn-close qt-multiple-close">
                                                        <span>Close </span>
                                                        <span class="qt-close">&times;</span>
                                                    </div>
                                                </div>

                                                <div class="select-weight-wrapper">

                                                    <label for="">Weight:</label>
                                                    @if(count($popular_product_infos[$product->product_item_id]) > 1)
                                                        <select name="product_info" class="variable-product-option-change">
                                                            <option value="">Choose an Option</option>
                                                            @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                                @if($product_info->productWeight)
                                                                    <option value="{{$product_info->product_info_id}}" {{ $product_info->price == $popular_product_info_min_price[$product->product_item_id] ? 'selected' : ''  }}>
                                                                        {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @else
                                                        @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                            <input type="hidden" name="product_info" value="{{$product_info->product_info_id}}">
                                                            @if($product_info->productWeight)
                                                                {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>


                                                <div class="qt-price-wrapper">
                                                    <span class="price qt-price">
                                                        @if($popular_product_info_min_price[$product->product_item_id])
                                                            @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                                @if($product_info->price == $popular_product_info_min_price[$product->product_item_id])
                                                                    @if($product_info->sales_price)
                                                                        <del>
                                                                            <span class="kreen-Price-amount amount">
                                                                                <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                                {{$product_info->price}}
                                                                            </span>
                                                                        </del>
                                                                        <ins>
                                                                            <span class="kreen-Price-amount amount">
                                                                                <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                                {{$product_info->sales_price}}
                                                                            </span>
                                                                        </ins>
                                                                        @break
                                                                    @else
                                                                        <ins>
                                                                            <span class="kreen-Price-amount amount">
                                                                                <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                                {{$product_info->price}}
                                                                            </span>
                                                                        </ins>
                                                                        @break
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                    </span>



{{-- here..................................................................................................................................... --}}
                                                </div>

                                                <div class="qt-ad-to-cart">
                                                    <button type="submit" class="qt-btn-ad-to-cart cart-multiple"
                                                            @if($popular_product_info_min_price[$product->product_item_id])
                                                            @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->price == $popular_product_info_min_price[$product->product_item_id])
                                                            data-product-id="{{$product_info->product_info_id}}"
                                                        @break
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                    >Add to cart</button>
                                                    <div class="quantity-wrapper multiple-quantity">
                                                        <div class="quantity ">
                                                            <span class="qty-label">Quantiy:</span>
                                                            <div class="control">
                                                                <a class="btn-number qtyminus quantity-minus nb-shops-quantity-minus" href="#">-</a>
                                                                <input type="text" data-step="1" min="0" max="" name="quantity" readonly value="0" title="Qty" class="input-qty input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
                                                                <a class="btn-number qtyplus quantity-plus nb-shops-quantity-plus" href="#" style="pointer-events: auto;">+</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flash">
                                                @if($popular_product_info_min_price[$product->product_item_id])
                                                    @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                        @if($product_info->price == $popular_product_info_min_price[$product->product_item_id])
                                                            @if($product_info->product_quantity)
                                                                @if($product_info->percent)
                                                                    <span class="onsale"><span class="number">-{{$product_info->percent}}%</span></span>
                                                                    @break
                                                                @endif
                                                            @else
                                                                <span class="sold-out"><span> Out of stock</span></span>
                                                                @break
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="group-button">
                                                <div class="add-to-cart">
                                                    <a href="#" onclick="return false"
                                                       class="button product_type_simple add_to_cart_button ajax_add_to_cart qt-select-open qt-multiple-open ">Add to
                                                        cart</a>
                                                </div>
                                                <a href="#" class="button yith-wcqv-button product-quick-view" role="button" data-product-id="{{$product->product_item_id}}">Quick View</a>
                                                <div class="yith-wcwl-add-to-wishlist">
                                                    <div class="yith-wcwl-add-button show">
                                                        <a href="#" class="add_to_wishlist add-to-favorite-shop"
                                                           @if($popular_product_info_min_price[$product->product_item_id])
                                                           @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                           @if($product_info->price == $popular_product_info_min_price[$product->product_item_id])
                                                           data-product-id="{{$product_info->product_info_id}}"
                                                            @break
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                        >Add to Favorite</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="product-name product_title">
                                                <a href="{{route('shop.single',['id'=> $product->product_item_id, 'slug'=> $product->slug])}}"
                                                   tabindex="0">{{$product->product_item_name}}</a>
                                            </h3>
                                            <span class="price">
                                                @if($popular_product_info_min_price[$product->product_item_id])
                                                    @foreach($popular_product_infos[$product->product_item_id] as $product_info)
                                                        @if($product_info->price == $popular_product_info_min_price[$product->product_item_id])
                                                            @if($product_info->sales_price)
                                                                <del>
                                                                    <span class="kreen-Price-amount amount">
                                                                        <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                        {{$product_info->price}}
                                                                    </span>
                                                                </del>
                                                                <ins>
                                                                    <span class="kreen-Price-amount amount">
                                                                        <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                        {{$product_info->sales_price}}
                                                                    </span>
                                                                </ins>
                                                                @break
                                                            @else
                                                                <ins>
                                                                        <span class="kreen-Price-amount amount">
                                                                            <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                            {{$product_info->price}}
                                                                        </span>
                                                                    </ins>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </span>
                                            <div class="rating">
                                                <?php
                                                    $rating=floor($product->product_rating);
                                                    $star = intval($rating);
                                                    $i = 0;

                                                ?>
                                                @if ($rating)
                                                @for($i=0;$i<$star;$i++)
                                                <i  style="color:#eebe19;" class="fa fa-star"></i>
                                                @endfor
                                                @else
                                                @for($i=0;$i<5;$i++)
                                                <i  style="color:;" class="fa fa-star-o"></i>
                                                @endfor
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
                <div class="view-btn-wrapper">
                    <div class="view-btn-inner">
                        <a href="{{route('shop')}}?show=popular"><span>view all</span></a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(count($testimonails) > 0)
        <!-- testimonial -->
        <div class="section-043">
            <div class="container">
                <div class="kreen-heading style-01">
                    <div class="heading-inner">
                        <h3 class="title">
                            Testimonials</h3>
                    </div>
                </div>
            </div>
            <div class="section-033">
                <div class="container">
                    <div class="section-034">
                        <div class="row">
                            <div class="col-xs-12 col-sm-10 col-md-6 offset-sm-1 col-xl-5 col-lg-5">
                                <div class="kreen-slide">
                                    <div class="owl-slick equal-container better-height"
                                         data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:0,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:1,&quot;rows&quot;:1}"
                                         data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}}]">
                                        @foreach($testimonails as $testimonial)
                                        <div class="kreen-testimonial style-02">
                                            <div class="testimonial-inner">
                                                <p class="desc">{!! $testimonial->description !!}</p>
                                                <div class="testimonial-info">
                                                    <div class="intro">
                                                        <h3 class="name">
                                                            <a href="#" target="_self" tabindex="0">
                                                                {{$testimonial->person_name}} </a>
                                                        </h3>
                                                        <div class="position">
                                                            {{$testimonial->designation}}
                                                        </div>
                                                    </div>
                                                    <div class="thumb">
                                                        <img src="{{asset('front')}}/assets/images/avater.png"
                                                             class="attachment-full size-full" alt="img" width="97"
                                                             height="97"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="section-001 pb-0">
            <div class="container">
                <div class="kreen-heading style-01">
                    <div class="heading-inner">
                        <h3 class="title">
                            Why Us</h3>
                    </div>
                </div>
            </div>
            <div class="section-014">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="kreen-iconbox style-02">
                                <div class="iconbox-inner">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M509.605,171.075l-99.3-99.301c-3.193-3.194-8.37-3.194-11.565,0l-49.65,49.65c-1.533,1.533-2.394,3.613-2.394,5.782    c0,2.169,0.861,4.249,2.394,5.782l4.953,4.953l-11.382,11.38c-7.389,7.386-18.854,9.402-28.528,5.011    c-9.07-4.117-19.153-6.292-29.161-6.292c-11.883,0-23.496,2.983-33.814,8.633c-4.303-1.06-8.719-1.603-13.179-1.603    c-6.45,0-12.785,1.113-18.829,3.31c-9.651,3.506-19.996,1.333-27.003-5.672L171.71,132.27l2.434-2.434    c1.533-1.533,2.394-3.613,2.394-5.782c0-2.169-0.861-4.249-2.394-5.782l-49.65-49.65c-3.195-3.194-8.371-3.194-11.565,0    L2.395,179.156c-3.193,3.194-3.193,8.371,0,11.564l49.649,49.65c1.534,1.534,3.613,2.395,5.783,2.395s4.248-0.861,5.783-2.395    l2.961-2.961l14.414,14.414c3.637,3.637,6.048,8.178,6.971,13.131c4.786,25.683,17.086,49.032,35.57,67.526l2.715,2.715    c-5.214,5.491-8.082,12.645-8.082,20.245c0,7.861,3.062,15.252,8.62,20.811c5.738,5.738,13.273,8.606,20.811,8.606    c0.491,0,0.98-0.013,1.471-0.038c-0.398,8.019,2.458,16.17,8.568,22.282c5.559,5.559,12.95,8.62,20.811,8.62    c0.219,0,0.437-0.011,0.656-0.016c-0.168,7.749,2.691,15.552,8.591,21.453c5.559,5.56,12.95,8.62,20.812,8.62    c7.861,0,15.251-3.062,20.811-8.62c0.468-0.468,0.909-0.952,1.34-1.442c2.895,1.009,5.957,1.546,9.052,1.546    c7.353,0,14.261-2.865,19.441-8.062c2.757-2.756,4.849-5.998,6.211-9.529l0.837,0.837c5.359,5.359,12.398,8.039,19.437,8.039    c7.039,0,14.078-2.68,19.437-8.039c2.848-2.848,4.988-6.211,6.344-9.878c4.797,3.489,10.476,5.236,16.158,5.236    c7.039,0,14.082-2.679,19.446-8.036c5.191-5.191,8.05-12.097,8.05-19.445c0-2.22-0.266-4.397-0.773-6.502    c5.237-1.064,10.049-3.635,13.91-7.501c5.191-5.191,8.05-12.094,8.05-19.437c0-5.785-1.782-11.292-5.073-15.91l6.56-6.56    c18.699-18.708,31.052-42.35,35.725-68.371c0.783-4.357,2.941-8.404,6.243-11.707l24.398-24.398l4.289,4.289    c1.597,1.597,3.69,2.395,5.783,2.395c2.092,0,4.186-0.798,5.783-2.395l49.65-49.65c1.533-1.533,2.394-3.613,2.394-5.782    S511.138,172.609,509.605,171.075z M57.827,223.025l-38.086-38.086L118.71,85.97l38.087,38.086L57.827,223.025z M156.836,364.689    c-5.097,5.096-13.392,5.098-18.493,0c-2.47-2.471-3.83-5.754-3.83-9.247c0-3.492,1.361-6.776,3.831-9.246    c2.549-2.549,5.896-3.824,9.245-3.824c3.348,0,6.698,1.275,9.246,3.824C161.933,351.294,161.933,359.59,156.836,364.689z     M187.684,395.537c-2.468,2.471-5.751,3.83-9.246,3.83c-3.492,0-6.776-1.361-9.245-3.83c-5.099-5.098-5.099-13.394,0-18.493    c2.549-2.549,5.896-3.824,9.246-3.824c3.347,0,6.697,1.275,9.245,3.824C192.784,382.142,192.784,390.439,187.684,395.537z     M217.742,425.594c-2.47,2.47-5.753,3.83-9.245,3.83c-3.493,0-6.777-1.361-9.246-3.83c-5.099-5.098-5.099-13.394,0-18.493    c2.549-2.549,5.896-3.824,9.246-3.824c3.347,0,6.697,1.275,9.245,3.824C222.841,412.2,222.841,420.496,217.742,425.594z     M356.63,362.822c-2.102,2.104-4.897,3.263-7.869,3.263s-5.767-1.159-7.873-3.268l-79.33-79.312    c-3.196-3.193-8.372-3.192-11.565,0.002c-3.192,3.193-3.191,8.371,0.002,11.564l85.451,85.442c2.103,2.102,3.26,4.898,3.26,7.872    c0,2.98-1.158,5.779-3.257,7.878c-4.347,4.343-11.416,4.344-15.756,0.003l-14.416-14.416c-0.08-0.083-0.158-0.167-0.241-0.249    c-0.024-0.024-0.051-0.045-0.076-0.069l-66.267-66.267c-3.195-3.193-8.371-3.193-11.565,0c-3.194,3.193-3.194,8.371,0,11.564    l66.48,66.479c2.032,2.083,3.151,4.839,3.151,7.763c0,2.974-1.159,5.77-3.261,7.872c-4.338,4.341-11.401,4.341-15.743,0    l-72.085-72.086c-3.195-3.194-8.371-3.194-11.565,0c-3.194,3.193-3.194,8.371,0,11.564l53.434,53.435    c0.015,0.015,0.027,0.032,0.043,0.046c2.101,2.097,3.257,4.888,3.257,7.859c0,2.973-1.158,5.769-3.269,7.88    c-2.099,2.104-4.893,3.263-7.87,3.263c-0.719,0-1.422-0.074-2.11-0.204c1.323-8.913-1.436-18.32-8.282-25.167    c-5.559-5.558-12.95-8.62-20.811-8.62c-0.219,0-0.437,0.011-0.656,0.016c0.168-7.749-2.69-15.552-8.591-21.453    c-5.56-5.558-12.95-8.62-20.812-8.62c-0.492,0-0.981,0.012-1.469,0.036c0.393-8.014-2.463-16.158-8.57-22.266    c-7.434-7.433-17.884-10.044-27.444-7.847l-5.864-5.864c-16.14-16.147-26.878-36.535-31.057-58.96    c-1.531-8.213-5.502-15.717-11.483-21.699l-14.415-14.415l82.01-82.01l20.438,20.438c7.856,7.856,18.552,12.06,29.507,12.06    c4.906,0,9.867-0.844,14.646-2.581c2.318-0.843,4.715-1.448,7.144-1.832l-50.632,50.633c-6.195,6.194-9.607,14.43-9.607,23.191    c0,8.76,3.412,16.996,9.606,23.19c6.394,6.394,14.79,9.59,23.19,9.589c8.398,0,16.797-3.198,23.192-9.589l25.43-25.43l6.883,6.888    c0.002,0.002,0.003,0.003,0.005,0.005l0.286,0.286l0.275,0.275c0.001,0.001,0.003,0.003,0.005,0.004l0.005,0.005    c0.079,0.078,0.156,0.152,0.233,0.226l95.881,95.881c2.103,2.102,3.26,4.898,3.26,7.872    C359.893,357.921,358.736,360.717,356.63,362.822z M408.137,240.834c-5.674,5.675-9.4,12.723-10.774,20.381    c-4.08,22.72-14.867,43.364-31.193,59.698l-6.284,6.285l-51.731-51.731c1.124,0.083,2.253,0.138,3.39,0.138    c5.238,0,10.598-0.918,15.934-3.101c4.18-1.71,6.182-6.485,4.472-10.664c-1.71-4.179-6.481-6.182-10.664-4.472    c-21.046,8.611-46.278-15.12-49.087-17.855c-0.047-0.046-0.094-0.091-0.142-0.135l-0.29-0.29    c-0.001-0.001-0.002-0.001-0.003-0.002l-0.253-0.252c-0.001-0.001-0.003-0.003-0.005-0.004l-6.884-6.889l7.806-7.807    c3.195-3.194,3.195-8.371,0.001-11.565c-3.194-3.192-8.371-3.193-11.564,0l-13.57,13.57c-0.005,0.005-0.011,0.01-0.016,0.015    c-0.005,0.005-0.01,0.011-0.015,0.016l-31.2,31.2c-6.412,6.411-16.842,6.409-23.252,0c-3.105-3.105-4.815-7.234-4.815-11.626    c0-4.392,1.71-8.521,4.816-11.626l53.852-53.854c2.996-2.995,6.326-5.63,9.905-7.837c8.503-5.256,18.324-8.034,28.401-8.034    c7.693,0,15.439,1.67,22.403,4.831c15.842,7.188,34.671,3.839,46.851-8.338l11.383-11.381l66.929,66.929L408.137,240.834z     M454.172,214.944l-87.736-87.736l38.087-38.086l87.736,87.736L454.172,214.944z"/>
                                            </g>
                                        </g>
                                            <g>
                                                <g>
                                                    <circle cx="462.41" cy="183.11" r="8.177"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <circle cx="53.567" cy="191.189" r="8.177"/>
                                                </g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                        </svg>
                                        <!-- <img class="" src="assets/images/icon/handshake.svg" alt=""> -->
                                        <!-- <span class="pe-7s-rocket"></span> -->
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Truth of Honesty</h4>
                                        <div class="desc">Reaching Authentic products at the right price to the customers is our main objective
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="kreen-iconbox style-02">
                                <div class="iconbox-inner">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-41 0 374 374"><path d="m287.664062 75.746094-140.605468-74.921875c-2.085938-1.113281-4.585938-1.097657-6.65625.039062l-136.714844 74.921875c-2.242188 1.230469-3.6328125 3.582032-3.6328125 6.140625v97.867188c.0820315 80.449219 47.7460935 153.230469 121.4570315 185.460937l18.976562 8.269532c1.773438.773437 3.792969.777343 5.570313.007812l21.382812-9.234375c75.078125-31.53125 123.921875-105.015625 123.929688-186.445313v-95.925781c0-2.585937-1.425782-4.964843-3.707032-6.179687zm-10.292968 102.105468c-.015625 75.816407-45.503906 144.226563-115.410156 173.566407l-.046876.023437-18.621093 8.039063-16.179688-7.058594c-68.613281-30-112.984375-97.742187-113.0625-172.628906v-93.722657l129.761719-71.117187 133.558594 71.167969zm0 0"/><path d="m92.167969 175.253906c-2.511719-2.941406-6.929688-3.289062-9.871094-.777344-2.941406 2.507813-3.289063 6.929688-.777344 9.867188l36.976563 43.300781c2.46875 2.890625 6.792968 3.285157 9.738281.886719l86.117187-70.0625c3-2.4375 3.453126-6.847656 1.011719-9.847656-2.4375-2.996094-6.847656-3.453125-9.847656-1.011719l-80.8125 65.742187zm0 0"/></svg>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512"><g><path d="m481.854 119.657c-.28-5.394-3.44-10.221-8.271-12.636l-210.875-105.438c-4.223-2.111-9.193-2.111-13.416 0l-210.875 105.438c-4.831 2.415-7.991 7.242-8.271 12.636-.16 3.07-3.628 76.168 21.273 161.035 14.734 50.214 36.406 94.071 64.414 130.354 35.295 45.722 80.659 79.357 134.832 99.973 1.719.653 3.526.98 5.335.98s3.616-.327 5.335-.98c54.173-20.615 99.537-54.251 134.832-99.973 28.008-36.283 49.68-80.141 64.414-130.354 24.901-84.867 21.433-157.965 21.273-161.035zm-50.304 153.419c-30.538 103.343-89.584 173.231-175.55 207.816-85.966-34.585-145.013-104.473-175.55-207.816-18.868-63.854-20.604-121.982-20.516-143.272l196.066-98.034 196.065 98.032c.089 21.301-1.649 79.425-20.515 143.274z"/><path d="m412.927 143.775-150.22-75.109c-4.223-2.111-9.193-2.11-13.416 0l-150.218 75.109c-5.384 2.691-8.638 8.341-8.263 14.349 1.63 26.162 6.272 66.288 19.133 108.871 25.712 85.138 72.616 145.052 139.408 178.076 2.095 1.036 4.372 1.554 6.648 1.554s4.554-.518 6.648-1.554c66.792-33.024 113.696-92.938 139.408-178.076 12.859-42.579 17.503-82.706 19.134-108.87.376-6.008-2.878-11.659-8.262-14.35zm-39.589 114.546c-22.335 73.956-61.793 126.543-117.338 156.427-55.545-29.884-95.003-82.471-117.338-156.427-10.518-34.825-15.165-67.992-17.189-92.205l134.527-67.264 134.528 67.264c-2.026 24.215-6.674 57.383-17.19 92.205z"/></g></svg> -->
                                        <!-- <span class="pe-7s-unlock"></span> -->
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Pure & Safe Products</h4>
                                        <div class="desc">We are hardly trying to ensure the health of the consumers by providing unadulterated, additive and chemical free products to their doorsteps
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="kreen-iconbox style-02">
                                <div class="iconbox-inner">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 490.667 490.667" style="enable-background:new 0 0 490.667 490.667;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M245.333,0C110.059,0,0,110.059,0,245.333s110.059,245.333,245.333,245.333s245.333-110.059,245.333-245.333    S380.608,0,245.333,0z M245.333,469.333c-123.52,0-224-100.48-224-224s100.48-224,224-224s224,100.48,224,224    S368.853,469.333,245.333,469.333z"/>
                                            </g>
                                        </g>
                                            <g>
                                                <g>
                                                    <path d="M348.885,333.803L256,240.917V74.667C256,68.779,251.221,64,245.333,64s-10.667,4.779-10.667,10.667v170.667    c0,2.837,1.131,5.547,3.115,7.552l96,96c2.091,2.069,4.821,3.115,7.552,3.115c2.731,0,5.461-1.045,7.552-3.115    C353.045,344.725,353.045,337.963,348.885,333.803z"/>
                                                </g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                        </svg>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 443.294 443.294" viewBox="0 0 443.294 443.294"><path d="m221.647 0c-122.214 0-221.647 99.433-221.647 221.647s99.433 221.647 221.647 221.647 221.647-99.433 221.647-221.647-99.433-221.647-221.647-221.647zm0 415.588c-106.941 0-193.941-87-193.941-193.941s87-193.941 193.941-193.941 193.941 87 193.941 193.941-87 193.941-193.941 193.941z"/><path d="m235.5 83.118h-27.706v144.265l87.176 87.176 19.589-19.589-79.059-79.059z"/></svg> -->
                                        <!-- <span class="pe-7s-piggy"></span> -->
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Fastest Delivery</h4>
                                        <div class="desc">We are committed to delivering our products to the consumer in the shortest possible time</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="kreen-iconbox style-02">
                                <div class="iconbox-inner">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M353.001,344.115c-3.945-3.865-10.276-3.8-14.142,0.144l-0.284,0.29c-3.865,3.945-3.8,10.276,0.145,14.142    c1.946,1.907,4.473,2.857,6.998,2.857c2.593,0,5.185-1.003,7.144-3.001l0.284-0.29    C357.011,354.312,356.946,347.981,353.001,344.115z"/>
                                            </g>
                                        </g>
                                            <g>
                                                <g>
                                                    <path d="M460.574,239.276H434v-26.574c0-5.523-4.477-10-10-10s-10,4.477-10,10v26.574h-26.574c-5.523,0-10,4.477-10,10    s4.477,10,10,10H414v26.574c0,5.523,4.477,10,10,10s10-4.477,10-10v-26.574h26.574c5.523,0,10-4.477,10-10    S466.097,239.276,460.574,239.276z"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M456.694,167.577c-9.34-69.03-67.048-120.678-135.545-120.678c-34.577,0-66.922,12.889-92.149,36.514    c-25.228-23.625-57.573-36.514-92.149-36.514C61.391,46.899,0,109.752,0,187.009c0,15.264,4.453,32.373,13.312,51.259H10    c-5.523,0-10,4.477-10,10s4.477,10,10,10h13.962c18.677,31.62,48.213,67.577,88.487,107.623    c54.58,54.271,109.924,96.73,110.477,97.153c1.792,1.371,3.933,2.056,6.074,2.056s4.281-0.685,6.074-2.056    c0.422-0.323,42.75-32.781,89.658-77.007c4.019-3.789,4.205-10.118,0.416-14.136c-3.788-4.018-10.117-4.205-14.136-0.416    c-35.774,33.729-68.801,60.472-82.011,70.92c-15.698-12.42-59.4-47.873-102.593-90.838c-34.58-34.399-61.052-65.747-78.949-93.299    h89.526c4.461,0,8.382-2.955,9.612-7.242l17.472-60.902l48.384,155.018c1.304,4.176,5.171,7.021,9.546,7.021    s8.242-2.845,9.545-7.021l26.795-85.873h44.644c5.523,0,10-4.477,10-10s-4.477-10-10-10h-51.999c-4.375,0-8.243,2.844-9.546,7.021    l-19.442,62.305L173.21,152.289c-1.316-4.217-5.234-7.081-9.662-7.02c-4.417,0.051-8.278,2.995-9.497,7.242l-24.603,85.758H35.624    C25.287,218.753,20,201.552,20,187.009c0-66.229,52.419-120.11,116.851-120.11c32.384,0,62.5,13.312,84.799,37.482    c1.894,2.052,4.558,3.219,7.35,3.219s5.457-1.167,7.35-3.219c22.299-24.17,52.415-37.482,84.799-37.482    c55.707,0,103.068,40.174,114.325,95.125c-3.757-0.491-7.586-0.748-11.475-0.748c-48.523,0-88,39.477-88,88s39.477,88,88,88    s88-39.477,88-88C512,212.3,489.075,180.582,456.694,167.577z M424,317.276c-37.495,0-68-30.505-68-68s30.505-68,68-68    s68,30.505,68,68S461.495,317.276,424,317.276z"/>
                                                </g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                            <g>
                                            </g>
                                        </svg>
                                        <!-- <span class="pe-7s-help2"></span> -->
                                    </div>
                                    <div class="content">
                                        <h4 class="title">Healthy Habit</h4>
                                        <div class="desc">Use of healthy products and foods may boost a person's mood and provide them with more energy to build up a healthy society & community
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- our media -->
        <div class="section-002">
            <div class="container">
                <div class="kreen-heading style-01">
                    <div class="heading-inner">
                        <h3 class="title">
                            Media</h3>
                    </div>
                </div>
                <div class="kreen-blog style-01">
                    <div class="blog-list-grid row auto-clear equal-container better-height ">
                        @foreach($medias as $media)
                        <article
                                class="post-item post-grid rows-space-30 col-bg-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-ts-12 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                            <div class="post-inner blog-grid">
                                <div class="post-thumb">
                                    <iframe width="100%" height="220" src="{{$media->media_link}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- our blog -->
        <div class="section-001">
            <div class="container">
                <div class="kreen-heading style-01">
                    <div class="heading-inner">
                        <h3 class="title">
                            From Our Blog</h3>
                    </div>
                </div>
                <div class="kreen-blog style-01">
                    <div class="blog-list-owl owl-slick equal-container better-height"
                         data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:3,&quot;rows&quot;:1}"
                         data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                        @forelse($blogs as $blog)
                            <article
                                class="post-item post-grid col-bg-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-ts-12 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                                <div class="post-inner blog-grid">
                                    <div class="post-thumb">
                                        <a href="{{route('blog.single',['id'=> $blog->blog_id, 'slug'=> $blog->slug])}}">
                                            <img src="{{asset($blog->thumbnail_image)}}"
                                                 class="img-responsive attachment-370x330 size-370x330" alt="img" width="370"
                                                 height="330"> </a>
                                        <a class="datebox" href="#">
                                            <span>{{ date('d',strtotime($blog->post_date))}}</span>
                                            <span>{{ date('M',strtotime($blog->post_date))}}</span>
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <div class="post-meta">
                                            <div class="post-author">
                                                By:<a href="#"> {{$blog->user->name}} </a>
                                            </div>
                                            <div class="post-comment-icon">
                                                <a href="#">{{$blog->blog_review_count}}</a>
                                            </div>
                                        </div>
                                        <div class="post-info equal-elem">
                                            <h3 class="post-title">
                                                <a href="{{route('blog.single',['id'=> $blog->blog_id, 'slug'=> $blog->slug])}}">{{$blog->blog_header}}</a>
                                            </h3>
                                            {!! Str::limit($blog->description , 70) !!}
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        @include('front.quick_view.quick_view')
    </div>
@endsection
@section('js')
    <script src="{{asset('front')}}/assets/js/quick.view.js"></script>
    <script src="{{asset('front')}}/assets/js/cart.js"></script>
@endsection
