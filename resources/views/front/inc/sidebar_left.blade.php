<div id="mySidenavLarge" class="sidenav shadow">
    <div class="side-nav-wrapper">
        <div id="" class="main-nav-list main-nav-list-large">
            <div class="nav-close-wrapper">
                <h3>categories</h3>
                <div class="nav-close-btn-wrapper">
                    <h4 onclick="closeNav()" class="nav-close-button nav-close-back-button">&times;</h4>
                </div>
            </div>
            <div class="cat-menu">
                @foreach($menu_categories as $menu_category)
                <div id="cat1-menu" class="categories">
                    <span class="link-menu">{{$menu_category->product_category_name}}
                        @if(count($menu_category->subcategories) > 0)<i class="fa fa-angle-right"></i> @endif
                    </span>

                    @if(count($menu_category->subcategories) > 0)
                    <div class="cat1-extra" style="width:{{(220 * (count($menu_category->subcategories) <= 4 ? count($menu_category->subcategories) : 4))}}px;">
                        <div class="row">
                            @foreach($menu_category->subcategories as $menu_sub_category)
                                    <div class="cat-links col-md-{{(12 / (count($menu_category->subcategories) <= 4 ? count($menu_category->subcategories) : 4))}}">
                                        <h5>{{$menu_sub_category->product_sub_category_name}} </h5>
                                        @if(count($menu_sub_category->productItems) > 0)
                                            @foreach($menu_sub_category->productItems as $menu_productItem)
                                            <a href="{{route('shop.single',['id'=> $menu_productItem->product_item_id, 'slug'=> $menu_productItem->slug])}}">{{$menu_productItem->product_item_name}}</a>
                                            @endforeach
                                        @endif
                                    </div>

                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
                @if($discount_product_exist)
                    <div id="cat4-menu" class="categories">
                        <a href="{{route('shop')}}?show=discount" style="padding: 0px">
                            <span class="link-menu" style="font-size: 18px; font-weight: 500; color: #000;">Discount</span>
                        </a>
                    </div>
                @endif
                @if(count($menu_more_categories) > 0)
                <div id="cat3-menu" class="categories open-more open-more-large">
                    <span class="link-menu">More
                        <i class="fa fa-angle-right"></i>
                    </span>
                </div>
                @endif
            </div>
        </div>
        @if(count($menu_more_categories) > 0)
        <!-- more nav list start -->
        <div id="" class="more-nav-list more-nav-list-large">
            <div class="nav-close-wrapper">
                <h3>categories</h3>
                <div class="more-nav-list-btn-wrapper">
                    <h4 class="more-nav-list-btn-back-large nav-close-back-button">&#x2039;</h4>
                </div>
            </div>
            <div class="cat-menu">
                @foreach($menu_more_categories as $menu_more_category)
                <div id="cat1-menu" class="categories">
                    <span class="link-menu">{{$menu_more_category->product_category_name}}
                        @if(count($menu_more_category->subcategories) > 0)<i class="fa fa-angle-right"></i>@endif
                    </span>
                    @if(count($menu_more_category->subcategories) > 0)
                    <div class="cat1-extra" style="width:{{(220 * (count($menu_more_category->subcategories) <= 4 ? count($menu_more_category->subcategories) : 4))}}px;">
                        <div class="row">
                            @foreach($menu_more_category->subcategories as $more_sub_category)
                                <div class="cat-links col-md-{{(12 / (count($more_sub_category->subcategories) <= 4 ? count($more_sub_category->subcategories) : 4))}}">
                                    <h5>{{$more_sub_category->product_sub_category_name}} </h5>
                                    @if(count($more_sub_category->productItems) > 0)
                                        @foreach($more_sub_category->productItems as $productItem)
                                            <a href="{{route('shop.single',['id'=> $productItem->product_item_id, 'slug'=> $productItem->slug])}}">{{$productItem->product_item_name}}</a>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <!-- more nav list end -->
        @endif
    </div>
</div>

<div id="mySidenavMobile" class="sidenav shadow">
    <div class="side-nav-wrapper">
        <div id="" class="main-nav-list main-nav-list-mobile">
            <div class="nav-close-wrapper">
                <h3>categories</h3>
                <div class="nav-close-btn-wrapper">
                    <h4 onclick="closeNav2()" class="nav-close-button nav-close-back-button">&times;</h4>
                </div>
            </div>
            <div class="cat-menu">
                @foreach($menu_categories as $menu_category)
                    <div id="m-cat1-menu{{$loop->index}}" class="categories mobile-categories">
                        <span class="link-menu" >{{$menu_category->product_category_name}}
                            @if(count($menu_category->subcategories) > 0)<i class="fa fa-angle-right"></i> @endif
                        </span>

                        @if(count($menu_category->subcategories) > 0)
                        <div class="sub-category">
                            <ul>
                                @foreach($menu_category->subcategories as $menu_sub_category)

                                    <li>
                                        <a class="" href="javascript:void(0)" style="font-size: 14px;  font-weight: 500;">{{$menu_sub_category->product_sub_category_name}}</a>
                                        @if(count($menu_sub_category->productItems) > 0)
                                            @foreach($menu_sub_category->productItems as $productItem)
                                                <a class="sub-ctg-link" style="font-size: 12px;" href="{{route('shop.single',['id'=> $productItem->product_item_id, 'slug'=> $productItem->slug])}}">{{$productItem->product_item_name}}</a>
                                            @endforeach
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                @endforeach
                @if($discount_product_exist)
                    <div id="cat4-menu" class="categories">
                        <a href="{{route('shop')}}?show=discount" style="padding: 0px">
                            <span class="link-menu" style="font-size: 18px; font-weight: 500; color: #000;">Discount</span>
                        </a>
                    </div>
                @endif
                @if(count($menu_more_categories) > 0)
                    <div id="cat3-menu" class="categories open-more open-more-mobile">
                        <span class="link-menu">More
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </div>
                @endif
            </div>
        </div>

        <!-- more nav list start -->
        <div id="" class="more-nav-list more-nav-list-mobile">
            <div class="nav-close-wrapper">
                <h3>categories</h3>
                <div class="more-nav-list-btn-wrapper">
                    <h4 class="more-nav-list-btn-back-mobile nav-close-back-button">&#x2039;</h4>
                </div>
            </div>
            <div class="cat-menu">
                @foreach($menu_more_categories as $menu_more_category)
                <div id="mo-cat1-menu{{$loop->index}}" class="categories mobile-categories">
                    <span class="link-menu">{{$menu_more_category->product_category_name}}
                        @if(count($menu_more_category->subcategories) > 0)<i class="fa fa-angle-right"></i>@endif
                    </span>
                    @if(count($menu_more_category->subcategories) > 0)
                    <div class="sub-category">
                        <ul>
                            @foreach($menu_more_category->subcategories as $more_sub_category)
                            <li>
                                <a class="" href="javascript:void(0)" style="font-size: 14px; font-weight: 500;">{{$more_sub_category->product_sub_category_name}}</a>
                                @if(count($more_sub_category->productItems) > 0)
                                    @foreach($more_sub_category->productItems as $productItem)
                                        <a class="sub-ctg-link" style="font-size: 12px;" href="{{route('shop.single',['id'=> $productItem->product_item_id, 'slug'=> $productItem->slug])}}">{{$productItem->product_item_name}}</a>
                                    @endforeach
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <!-- more nav list end -->
    </div>
</div>
