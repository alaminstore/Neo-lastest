@extends('front.home')
@section('title',$product->product_item_name.'- NeoBazaar')
@section('content')
<style>
    .single_add_to_cart_button{
        cursor: pointer;
    }
    input.sub_btn{
        display: none;
    }
    .clr{
        clear:both;
    }
</style>

    <div class="banner-wrapper no_background " style="">
        <div class="banner-wrapper-inner">
            <nav class="kreen-breadcrumb" style="text-align: left;"><a href="{{url('/')}}">Home</a><i class="fa fa-angle-right"></i><a href="{{route('shop')}}">Shop</a>
                <i class="fa fa-angle-right"></i>{{$product->product_item_name}}
            </nav>
        </div>
    </div>
    <div class="single-thumb-vertical main-container shop-page no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="kreen-notices-wrapper"></div>
                    <div id="product-27"
                         class="post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-variable has-default-attributes">
                        <div class="main-contain-summary">
                            <div class="contain-left has-gallery">
                                <div class="single-left">
                                    <div class="kreen-product-gallery kreen-product-gallery--with-images kreen-product-gallery--columns-4 images">

                                        <div class="flex-viewport">
                                            <figure class="kreen-product-gallery__wrapper">
                                                <div class="kreen-product-gallery__image">
                                                    <img src="{{asset($product->image)}}"
                                                         class="" alt="{{$product->product_item_name}}">
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary entry-summary">
                                    <h1 class="product_title entry-title">{{$product->product_item_name}}</h1>

                                    <p class="price single-product-price-area">
                                        @if($product_info_min_price)
                                            @foreach($product_infos as $product_info)
                                                @if($product_info->price == $product_info_min_price)
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
                                    </p>
                                    <div class="rating">
                                        Product Rating:

                                        <?php
                                            $rating=floor($product->product_rating);
                                            $star = intval($rating);
                                            $i = 0;

                                        ?>
                                        @for($i=0;$i<$star;$i++)
                                        <i  style="color:#eebe19;" class="fa fa-star"></i>
                                        @endfor
                                    </div>
                                    <p class="stock in-stock">
                                        Availability:
                                        <span>
                                            @if($product_info_min_price)
                                                @foreach($product_infos as $product_info)
                                                    @if($product_info->price == $product_info_min_price)
                                                        @if($product_info->product_quantity)
                                                            In stock
                                                        @else
                                                            Out of stock
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    </p>
                                    <div class="kreen-product-details__short-description">
                                        @php use Illuminate\Support\Str; @endphp
                                        {!! Str::words($product->product_item_description , '50') !!}

                                    </div>
                                    <div class="clr"></div>
                                    <form action="" class="variations_form cart" id="product-single-add-to-cart-form">
                                        <div class="select-weight-wrapper">
                                            <label for="">Weight:</label>
                                            @if(count($product_infos) > 1)
                                                <select name="product_info" class="product-quantity-change" @if(Auth::check()) data-user-id="{{Auth::user()->user_id}}"  @endif>
                                                    <option value="">Choose an Option</option>
                                                    @foreach($product_infos as $product_info)
                                                        @if($product_info->productWeight)
                                                            <option value="{{$product_info->product_info_id}}"
                                                                {{ $product_info->price == $product_info_min_price ? 'selected' : ''  }}
                                                            >
                                                                {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                            </option>

                                                        @endif
                                                    @endforeach
                                                </select>
                                            @else
                                                @foreach($product_infos as $product_info)
                                                    <input type="hidden" name="product_info" value="{{$product_info->product_info_id}}">
                                                    @if($product_info->productWeight)
                                                        {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="single_variation_wrap">
                                            <div class="kreen-variation single_variation mt-4"></div>
                                            <div class="kreen-variation-add-to-cart variations_button kreen-variation-add-to-cart-disabled">
                                                <div class="quantity">
                                                    <span class="qty-label">Quantiy:</span>
                                                    <div class="control">
                                                        <a class="btn-number qtyminus quantity-minus nb-single-product-cart-quantity-minus" href="#">-</a>
                                                        <input type="text" data-step="1" min="0" max="" name="quantity" value="{{$cart_quantity_count ?? 0}}" title="Qty"
                                                               class="input-qty input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric" readonly>
                                                        <a class="btn-number qtyplus quantity-plus nb-single-product-cart-quantity-plus " href="#">+</a>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                        class="single_add_to_cart_button button alt disabled kreen-variation-selection-needed" id="nb-single-product-add-to-cart-button">
                                                    Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="yith-wcwl-add-to-wishlist add-to-favorite-area-single

                                        @if(Auth::check())
                                            @foreach($product_infos as $product_info)
                                                @if($product_info->productWeight)
                                                    @if($product_info->price == $product_info_min_price)
                                                        @if(count($favorites) > 0)
                                                            @foreach($favorites as $favorite)
                                                                @if($favorite->product_info_id == $product_info->product_info_id)
                                                                    text-active
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        ">
                                        <div class="yith-wcwl-add-button show">
                                            <a href="#" rel="nofollow"
                                               @foreach($product_infos as $product_info)
                                                   @if($product_info->productWeight)
                                                      @if($product_info->price == $product_info_min_price)
                                                        data-product-id="{{$product_info->product_info_id}}"
                                                        @break
                                                      @endif
                                                   @endif
                                               @endforeach
                                               data-product-type="variable" class="add_to_wishlist add-to-favorite-shop">
                                                @if(Auth::check())
                                                    @forelse($product_infos as $product_info)
                                                        @if($product_info->productWeight)
                                                            @if($product_info->price == $product_info_min_price)
                                                                @if(count($favorites) > 0)
                                                                    @foreach($favorites as $favorite)
                                                                        @if($favorite->product_info_id == $product_info->product_info_id)
                                                                            Added
                                                                        @else
                                                                            Add
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    Add
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @empty
                                                        Add
                                                    @endforelse
                                                @else
                                                    Add
                                                @endif to Favorites</a>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="product_meta">
                                        @if($product_info_min_price)
                                            @foreach($product_infos as $product_info)
                                                @if($product_info->price == $product_info_min_price)
                                                    @if($product_info->sku)
                                                        <span class="sku_wrapper">SKU: <span class="sku">{{$product_info->sku}}</span></span>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                        <span class="posted_in">Categories: <a href="#" rel="{{$product->ProductCategory->product_category_name}}">{{$product->ProductCategory->product_category_name}}</a>
                                        </span>
                                    </div>
                                    <div class="kreen-share-socials">
                                        <h5 class="social-heading">Share: </h5>
                                        <a target="_blank" class="facebook" href="#" id="fb_btn">
                                            <i class="fa fa-facebook-f"></i>
                                        </a>
                                        <a style="display:none;" target="_blank" class="twitter" href="#" id="twitter_btn">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a target="_blank" class="linkedin" href="#" id="linkedin_btn">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kreen-tabs kreen-tabs-wrapper">
                            <ul class="tabs dreaming-tabs" role="tablist">
                                <li class="description_tab @if(request()->query('review') == 'view') @else  active @endif" id="tab-title-description" role="tab"
                                    aria-controls="tab-description">
                                    <a href="#tab-description">Description</a>
                                </li>
                                <li class="reviews_tab @if(request()->query('review') == 'view') active @endif" id="tab-title-reviews" role="tab" aria-controls="tab-reviews">
                                    <a href="#tab-reviews">Reviews ({{$reviews->total()}})</a>
                                </li>
                                <li class="reviews_tab @if(request()->query('review') == 'view') active @endif" id="tab-title-rating" role="tab" aria-controls="tab-rating">
                                    <a href="#tab-rating">Rating</a>
                                </li>
                            </ul>
                            <div class="kreen-Tabs-panel kreen-Tabs-panel--description panel entry-content kreen-tab"
                                 id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                                <h2>Description</h2>
                                <div class="container-table">
                                    <div class="container-cell">
                                        {!! $product->product_item_description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="kreen-Tabs-panel kreen-Tabs-panel--reviews panel entry-content kreen-tab"
                                 id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
                                <div id="reviews" class="kreen-Reviews">
                                    <div id="comments">
                                        <h2 class="kreen-Reviews-title">Reviews</h2>

                                    </div>
                                    <div class="postbox-comments">
                                        <div class="postbox-comment-title">
                                            <h3>Reviews ({{$reviews->total()}})</h3>
                                        </div>
                                        <div class="latest-comments">
                                            <ul>
                                                @forelse($reviews as $review)
                                                <li>
                                                    <div class="comments-box">
                                                        <div class="comments-avatar">
                                                            <img src="{{asset('/')}}images/avater.png" alt="">
                                                        </div>
                                                        <div class="comments-text">
                                                            <div class="avatar-name">
                                                                <h5>{{$review->user->name}}</h5>
                                                                <span> - {{$review->created_at->diffForhumans()}} </span>
                                                            </div>
                                                            <p>{!! $review->review !!}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @if($review->status)
                                                <li class="children">
                                                    <div class="comments-box">
                                                        <div class="comments-avatar">
                                                            <img src="{{asset('/')}}images/avater.png" alt="">
                                                        </div>
                                                        <div class="comments-text">
                                                            <div class="avatar-name">
                                                                <h5>Neo Bazaar</h5>
                                                                <span> - {{$review->created_at->diffForhumans()}}  </span>
                                                            </div>
                                                            <p> {!! $review->reply !!}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                    @endif
                                                @empty
                                                    <p class="kreen-noreviews">There are no reviews yet.</p>
                                                @endforelse
                                            </ul>
                                            {!! $reviews->appends(['review'=>'view'])->fragment('review')->links('front.pagination.default') !!}
                                        </div>
                                    </div>
                                    <!-- postbox end -->
                                    @if(Auth::check())
                                    <div id="review_form_wrapper" class="mt-5">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">
                                                <span id="reply-title" class="comment-reply-title">Be the first to review “{{$product->product_item_name}}”</span>
                                                <form id="commentform" class="comment-form" action="{{route('product.review.store')}}" method="post">
                                                    @csrf

                                                    <p class="comment-notes">Required fields are marked <span class="required">*</span></p>
                                                    <p class="comment-form-author">
                                                        <label for="author">Name&nbsp;<span
                                                                    class="required">*</span></label>
                                                        <input id="author" name="name"  size="100" value="{{Auth::user()->name ?? ''}}" required=""
                                                               type="text"></p>
                                                    <p class="comment-form-email"><label for="email">Email&nbsp;
                                                            <span class="required">*</span></label>
                                                        <input id="email" name="email" value="{{Auth::user()->email ?? ''}}"  size="100" required=""
                                                               type="email"></p>

                                                    <p class="comment-form-comment"><label for="comment">Your
                                                            review&nbsp;<span class="required">*</span></label><textarea
                                                                id="comment" name="review" cols="45" rows="8"
                                                                required=""></textarea></p>
                                                    <p class="form-submit">
                                                        <button class="submit" type="submit">Post a review</button>
                                                        <input name="product" value="{{$product->product_item_id}}" type="hidden">
                                                    </p></form>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <h4>You must be <a href="{{route('account')}}" style="color: #3084bb;">logged in</a>  to post a review.</h4>
                                    @endif

                                    <div class="clear"></div>
                                </div>
                            </div>

                             {{-- Product Rating System --}}
                             <div class="kreen-Tabs-panel kreen-Tabs-panel--description panel entry-content kreen-tab"
                             id="tab-rating" role="tabpanel" aria-labelledby="tab-title-description">
                             @if(Auth::check())
                             <div class="col-md-6 col-md-offset-3">
                                <p>Give your rating for *{{$product->product_item_name}}* </p><br>
                                <div class="rating_main_section" style="display:flex;justify-content:space-around;align-items: baseline;">
                                    <div id="rateYo"></div>
                                 <form action="{{route('product.rating')}}" method="POST">
                                    @csrf
                                     <input type="hidden" name="rating"  id="product_rating" class="product_rating" class="form-control">
                                     <input type="hidden" name="product_id"  id="product_id" class="product_id" class="form-control" value={{$product->product_item_id}}>
                                     <input style="cursor:pointer;" class="sub_btn" type="submit" onclick="submitClick()" value="Submit">
                                 </form>
                                </div>
                                 <br>
                             </div>
                            @else
                                <h4>You must be <a href="{{route('account')}}" style="color: #3084bb;">logged in</a>  for the product a Rating.</h4>
                             @endif
                            </div>




                        </div>
                    </div>
                </div>
                <div class="clr"></div>
                @if(count($related_products) > 0)
                    <div class="col-md-12 col-sm-12 dreaming_related-product">
                        <div class="block-title">
                            <h2 class="product-grid-title">
                                <span style="font-family: 'Kaushan Script';">Related Products</span>
                            </h2>
                        </div>
                        <div class="kreen-products style-04">
                            <div class="response-product product-list-owl owl-slick equal-container better-height"
                                 data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}"
                                 data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                                @forelse($related_products as $product_related)
                                <div class="product-item recent-product style-04 rows-space-0 post-93 product type-product status-publish has-post-thumbnail product_cat-light product_cat-table product_cat-new-arrivals product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-simple">
                                    <form action="" class="product-single-add-to-cart">
                                        <div class=" product_inner tooltip-top tooltip-all-top">
                                            <div class="product-thumb">
                                                <a class="thumb-link"
                                                   href="{{route('shop.single',['id'=> $product_related->product_item_id, 'slug'=> $product_related->slug])}}" tabindex="0">
                                                    <img class="img-responsive"
                                                         src="{{asset($product_related->image)}}"
                                                         alt="Wanuts" width="270" height="350">
                                                </a>
                                                <div class="qt-drop-wrapper qt-multiple">
                                                    <div class="add-to-cart-top" style="display: flex; justify-content: space-between;">
                                                        <div class="qt-multiple-close mt-1 qt-multiple-out-of-stock" >
                                                            @if($new_arrival_product_info_min_price[$product_related->product_item_id])
                                                                @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                                    @if($product_info->price == $new_arrival_product_info_min_price[$product_related->product_item_id])
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
                                                        @if(count($new_arrival_product_infos[$product_related->product_item_id]) > 1)
                                                            <select name="product_info" class="variable-product-option-change">
                                                                <option value="">Choose an Option</option>
                                                                @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                                    @if($product_info->productWeight)
                                                                        <option value="{{$product_info->product_info_id}}" {{ $product_info->price == $new_arrival_product_info_min_price[$product_related->product_item_id] ? 'selected' : ''  }}>
                                                                            {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                                <input type="hidden" name="product_info" value="{{$product_info->product_info_id}}">
                                                                @if($product_info->productWeight)
                                                                    {{$product_info->productWeight->weight}}{{$product_info->productWeight->weight_unit}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="qt-price-wrapper">
                                                    <span class="price qt-price">
                                                        @if($new_arrival_product_info_min_price[$product_related->product_item_id])
                                                            @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                                @if($product_info->price == $new_arrival_product_info_min_price[$product_related->product_item_id])
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
                                                                @if($new_arrival_product_info_min_price[$product_related->product_item_id])
                                                                @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                                @if($product_info->price == $new_arrival_product_info_min_price[$product_related->product_item_id])
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
                                                    @if($new_arrival_product_info_min_price[$product_related->product_item_id])
                                                        @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                            @if($product_info->price == $new_arrival_product_info_min_price[$product_related->product_item_id])
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
                                                    <a href="#" class="button yith-wcqv-button product-quick-view" role="button" data-product-id="{{$product_related->product_item_id}}">Quick View</a>
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <div class="yith-wcwl-add-button show">
                                                            <a href="#" class="add_to_wishlist add-to-favorite-shop"
                                                               @if($new_arrival_product_info_min_price[$product_related->product_item_id])
                                                               @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                               @if($product_info->price == $new_arrival_product_info_min_price[$product_related->product_item_id])
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
                                                    <a href="{{route('shop.single',['id'=> $product_related->product_item_id, 'slug'=> $product_related->slug])}}"
                                                       tabindex="0">{{$product_related->product_item_name}}</a>
                                                </h3>
                                                <span class="price">
                                                @if($new_arrival_product_info_min_price[$product_related->product_item_id])
                                                        @foreach($new_arrival_product_infos[$product_related->product_item_id] as $product_info)
                                                            @if($product_info->price == $new_arrival_product_info_min_price[$product_related->product_item_id])
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
                                </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @include('front.quick_view.quick_view')
    </div>
@endsection

@section('js')

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
{{-- <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6075294dbf0b9770"></script> --}}

    <script>
        const fb_btn = document.getElementById('fb_btn');
        const twitter_btn = document.getElementById('twitter_btn');
        const linkedin_btn = document.getElementById('linkedin_btn');
        const googleplus_btn = document.getElementById('googleplus_btn');

        let postUrl = encodeURI(document.location.href);
        let postTitle = encodeURI(`{{$product->product_item_name}}`);
        fb_btn.setAttribute("href",`https://www.facebook.com/sharer.php?u=${postUrl}`);
        twitter_btn.setAttribute("href",`https://twitter.com/share?url=${postUrl}&text=${postTitle}`);
        linkedin_btn.setAttribute("href",`https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);
        googleplus_btn.setAttribute("href",`https://www.plus.google.com/sharer.php?u=${postUrl}`);
    </script>
    <script src="{{asset('front')}}/assets/js/quick.view.js"></script>
    <script src="{{asset('front')}}/assets/js/cart.js"></script>
    <script>
        $(document).ready(function (){
            const cartQuantity = $('input.input-qty.input-text.qty.text').val();
            if(cartQuantity > 0)
            {
                $('#product-single-add-to-cart-form').find('button.single_add_to_cart_button.button').removeClass('disabled');
                $('#product-single-add-to-cart-form').find('div.kreen-variation-add-to-cart.variations_button').removeClass('kreen-variation-add-to-cart-disabled');
            }
        });
    </script>

     <script>
         $(function () {

        $("#rateYo").rateYo({
        starWidth: "20px",
        fullStar: true,
        onSet:function(rating,rateYoInstance){
            // alert(rating);
            // console.log(rating);
            var rating_value = rating;
            $('#product_rating').val(rating_value);

        }
        });

        });

        $(document).ready(function(){
            $("#rateYo").click(function() {
             $('.sub_btn').show();
            });
        });
     </script>


@endsection
