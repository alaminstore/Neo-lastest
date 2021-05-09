@extends('front.home')

@section('title','Favorites - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset("/")}}/images/banners/multiple-pages-banner.png"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Favorites</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-begin"><a href="{{route('dashboard')}}"><span>Dashboard</span></a></li>
                    <li class="trail-item trail-end active"><span>Favorites</span>
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
                                <!-- WISHLIST TABLE -->
                                <table class="shop_table cart wishlist_table" data-pagination="no" data-per-page="5"
                                           data-page="1" data-id="" data-token="">
                                        <thead>
                                            <tr>
                                                <th class="product-remove"></th>
                                                <th class="product-thumbnail"></th>
                                                <th class="product-name">
                                                    <span class="nobr">Product Name</span>
                                                </th>
                                                <th class="product-price">
                                                    <span class="nobr">Unit Price</span>
                                                </th>
                                                <th class="product-stock-status">
                                                    <span class="nobr">Stock Status</span>
                                                </th>
                                                <th class="product-add-to-cart"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($favorites as $favorite)
                                            <tr id="yith-wcwl-row-29" data-row-id="29">
                                                <td class="product-remove">
                                                    <div>
                                                        <a href="{{route('favorites.remove',$favorite->favorite_id)}}"
                                                           class="remove remove_from_wishlist" title="Remove this product">×</a>
                                                    </div>
                                                </td>
                                                <td class="product-thumbnail">
                                                    <a href="#">
                                                        <img src="{{asset($favorite->productInfo->productItem->image)}}"
                                                             class="attachment-kreen_thumbnail size-kreen_thumbnail" alt="img"
                                                             width="600" height="778"> </a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="#">{{$favorite->productInfo->productItem->product_item_name}}</a></td>
                                                <td class="product-price">
                                                    @if($favorite->productInfo->sales_price)
                                                        <del>
                                                            <span class="kreen-Price-amount amount">
                                                                <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                {{$favorite->productInfo->price}}
                                                            </span>
                                                        </del>
                                                    @else
                                                        <ins>
                                                                <span class="kreen-Price-amount amount">
                                                                    <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                    {{$favorite->productInfo->price}}
                                                                </span>
                                                        </ins>
                                                    @endif
                                                    @if($favorite->productInfo->sales_price)
                                                        <ins>
                                                            <span class="kreen-Price-amount amount">
                                                                <span class="kreen-Price-currencySymbol">{{$currency_symbol}}</span>
                                                                {{$favorite->productInfo->sales_price}}
                                                            </span>
                                                        </ins>
                                                    @endif
                                                </td>
                                                <td class="product-stock-status">
                                                    <span class="wishlist-in-stock">
                                                        @if($favorite->productInfo->product_quantity)
                                                            In Stock
                                                        @else
                                                            Out of stock
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="product-add-to-cart">
                                                    <!-- Date added -->
                                                    <!-- Add to cart button -->
                                                    <a href="{{route('shop.single',['id'=> $favorite->productInfo->product_item_id, 'slug'=> $favorite->productInfo->productItem->slug])}}"
                                                       data-quantity="1"
                                                       class="button product_type_simple add_to_cart_button ajax_add_to_cart add_to_cart button alt"
                                                       aria-label="Add “Abstract Sweatshirt” to your cart" target="_blank" rel="nofollow" > View</a>
                                                    <!-- Change wishlist -->
                                                    <!-- Remove from wishlist -->
                                                </td>
                                            </tr>
                                        @empty

                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                </td>
                                            </tr>
                                        </tfoot>
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

    </script>
@endsection
