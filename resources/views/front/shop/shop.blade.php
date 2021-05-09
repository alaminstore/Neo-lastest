@extends('front.home')

@section('title','Shop - NeoBazaar')

@section('content')
    <div class="banner-wrapper has_background">
        @foreach ($banner as $bn)
        <img src="{{asset($bn->image)}}"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        @endforeach
        <div class="banner-wrapper-inner">
            <h1 class="page-title">
                @if(request()->input('show'))
                    @if(request()->input('show') == 'newarrival')
                        New Arrival
                        @elseif(request()->input('show') == 'popular')
                        Popular This Week
                        @else
                            Shop
                    @endif
                @else
                    Shop
                @endif

            </h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Shop</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-container shop-page no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="shop-control shop-before-control">
                        <form  class="kreen-ordering" method="get" id="shop-filter-form">
                            @if(request()->input('show'))
                                <input type="hidden" name="show" value="{{request()->input('show')}}">
                            @endif
                            <select title="product_cat" name="orderby" class="orderby" id="order-by-filter">
                                <option value="" selected="selected">Default sorting</option>
                                <option value="popularity"  {{request()->query('orderby') == 'popularity' ? 'selected' : ''}}>Sort by popularity</option>
                                <option value="date" {{request()->query('orderby') == 'date' ? 'selected' : ''}}>Sort by new arrival</option>
                                <option value="price" {{request()->query('orderby') == 'price' ? 'selected' : ''}}>Sort by price: low to high</option>
                                <option value="pricedesc" {{request()->query('orderby') == 'pricedesc' ? 'selected' : ''}}>Sort by price: high to low</option>
                            </select>
                            <label>
                                <select class="option-perpage" name="perpageshow" id="per-page-show">
                                    <option value="12"  {{request()->query('perpageshow') == '12' ? 'selected' : ''}}>
                                        Show 12
                                    </option>
                                    <option value="16" {{request()->query('perpageshow') == '16' ? 'selected' : ''}}>
                                        Show 16
                                    </option>
                                    <option value="20" {{request()->query('perpageshow') == '20' ? 'selected' : ''}}>
                                        Show 20
                                    </option>
                                </select>
                            </label>
                        </form>
                    </div>

                    <div class=" auto-clear kreen-products">

                        <ul class="row products columns-3">
                            @forelse($products as $product)

                            <li class="product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-04 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes"
                                data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">
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
                                                    @if($product_info_min_price[$product->product_item_id])
                                                        @foreach($product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->price == $product_info_min_price[$product->product_item_id])
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
                                                @if(count($product_infos[$product->product_item_id]) > 1)
                                                    <select name="product_info" class="variable-product-option-change">
                                                        <option value="">Choose an Option</option>
                                                        @foreach($product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->productWeight)
                                                                <option value="{{$product_info->product_info_id}}" {{ $product_info->price == $product_info_min_price[$product->product_item_id] ? 'selected' : ''  }}>
                                                                    {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                @else
                                                    @foreach($product_infos[$product->product_item_id] as $product_info)
                                                        <input type="hidden" name="product_info" value="{{$product_info->product_info_id}}">
                                                    @if($product_info->productWeight)
                                                        {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                    @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="qt-price-wrapper">
                                                <span class="price qt-price">
                                                    @if($product_info_min_price[$product->product_item_id])
                                                        @foreach($product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->price == $product_info_min_price[$product->product_item_id])
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
                                                    @if($product_info_min_price[$product->product_item_id])
                                                        @foreach($product_infos[$product->product_item_id] as $product_info)
                                                            @if($product_info->price == $product_info_min_price[$product->product_item_id])
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
                                            @if($product_info_min_price[$product->product_item_id])
                                                @foreach($product_infos[$product->product_item_id] as $product_info)
                                                    @if($product_info->price == $product_info_min_price[$product->product_item_id])
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
                                                       @if($product_info_min_price[$product->product_item_id])
                                                            @foreach($product_infos[$product->product_item_id] as $product_info)
                                                                @if($product_info->price == $product_info_min_price[$product->product_item_id])
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
                                            @if($product_info_min_price[$product->product_item_id])
                                                @foreach($product_infos[$product->product_item_id] as $product_info)
                                                    @if($product_info->price == $product_info_min_price[$product->product_item_id])
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
                                    </div>
                                </div>
                                </form>
                            </li>

                            @empty

                            @endforelse
                        </ul>
                    </div>
                    <div class="shop-control shop-after-control">
                        {!! $products->appends(request()->query())->links('front.pagination.default') !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.quick_view.quick_view')
@endsection

@section('js')
    <script src="{{asset('front')}}/assets/js/quick.view.js"></script>
    <script src="{{asset('front')}}/assets/js/cart.js"></script>
    <script>
        $('#per-page-show, #order-by-filter').on('change', function (){

            $('#shop-filter-form').submit();
        })
    </script>
@endsection
