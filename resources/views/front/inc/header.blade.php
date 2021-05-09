@include('front.inc.sidebar_left')
<header id="header" class="header style-03 header-dark header-sticky">
    <div class="header-wrap-stick">
        <div class="header-position">
            <div class="header-middle">
                <div class="kreen-menu-wapper"></div>
                <div class="header-middle-inner">
                    <div class="header-menu">
                        <div class="box-header-nav menu-nocenter">
                            <div class="main-ham-menu">
                                <span class="sidenav-icon" style="font-size:25px;cursor:pointer"
                                      onclick="openNav()">
                                    <div class="header-mobile-left">
                                        <div class="block-menu-bar-2">
                                            <a class="menu-bar " href="#">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </a>
                                        </div>
                                    </div>
                                </span>
                                <ul id="menu-primary-menu"
                                    class="clone-main-menu kreen-clone-mobile-menu kreen-nav main-menu">
                                    <li class="menu-item">
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{route('shop')}}">Shop</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="header-logo">
                        <a href="{{url('/')}}"><img alt="NEO Bazaar" src="{{asset('images/logo.png')}}"
                                                    class="logo"></a></div>
                    <div class="header-control">
                        <div class="header-control-inner">
                            <div class="meta-dreaming">
                                <div class="box-header-nav">
                                    <ul id="menu-primary-menu"
                                        class="clone-main-menu kreen-clone-mobile-menu kreen-nav main-menu">
                                        <li class="menu-item">
                                            <a href="{{route('blogs')}}">Blog</a>
                                        </li>
                                        @if(Auth::check())
                                        <li class="menu-item">
                                            <a href={{url('/order-traking')}}>Track Order</a>
                                        </li>
                                        @endif
                                        <li class="menu-item">
                                            <a href="{{route('contactus')}}">Contact Us</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="cs-header-search">
                                    <div class="cs-block-search">
                                        <form action="" class="cs-form-search">
                                            <div class="cs-form-content">
                                                <div class="cs-inner">
                                                    <input autocomplete="off" class="cs-txt-livesearch"
                                                           id="search-product-header" name="search"
                                                           placeholder="Search here..." type="text">
                                                </div>
                                                <div type="" class="cs-btn-submit">
                                                    <span class="pe-7s-search"></span>
                                                </div>
                                                <div type="" class="cs-btn-close">
                                                    <span class="pe-7s-close"></span>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="cs-prd-wrapper">
                                            <ul class="p-0 product-list-view">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="menu-item block-user block-dreaming kreen-dropdown">
                                    @if(Auth::check())
                                        <a class="block-link" href="javascript:void(0)">
                                            <span class="pe-7s-user"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--dashboard is-active">
                                                <a href="{{route('dashboard')}}">Dashboard</a>
                                            </li>
                                            <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--orders">
                                                <a href="{{route('orders')}}">Orders</a>
                                            </li>
                                            <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--downloads">
                                                <a href="{{route('favorites')}}">Favorites</a>
                                            </li>
                                            <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--edit-adchair">
                                                <a href="{{route('address')}}">Addresses</a>
                                            </li>
                                            <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--edit-account">
                                                <a href="{{route('account.details')}}">Account details</a>
                                            </li>
                                            <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--customer-logout">
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                </prm>
                                            </li>
                                        </ul>
                                    @else
                                        <a class="block-link nb-user-logo-color" href="{{route('account')}}">
                                            <span class="pe-7s-user"></span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="header-mobile-left">
            <span class="sidenav-icon" style="font-size:25px;cursor:pointer" onclick="openNav2()">
                <div class="block-menu-bar-2">
                    <a class="menu-bar " href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
            </span>
            <div class="header-search kreen-dropdown" id="mobile-header-search">
                <div class="header-search-inner" data-kreen="kreen-dropdown">

                </div>
                <div class="block-search">
                    <form role="search" method="get"
                          class="form-search block-search-form kreen-live-search-form" onclick="return false;">
                        <div class="form-content search-box results-search">
                            <div class="inner">
                                <input autocomplete="off" class="searchfield txt-livesearch input" name="search"
                                       id="product-mobile-search"
                                       placeholder="Search here..." type="text">
                            </div>
                        </div>
                        <button class="btn-submit">
                            <span class="pe-7s-search"></span>
                        </button>
                    </form><!-- block search -->
                    <div class="cs-prd-wrapper">
                        <ul class="p-0 product-list-view">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mobile-mid">
            <div class="header-logo">
                <a href="{{url('/')}}"><img alt="NEO Bazaar" src="{{asset('/')}}images/logo.png" class="logo"></a></div>
        </div>
        <div class="header-mobile-right">
            <div class="header-control-inner">
                <div class="meta-dreaming">
                    <div class="menu-item block-user  d-xl-block block-dreaming kreen-dropdown">
                        @if(Auth::check())
                            <a class="block-link" href="javascript:void(0)">
                                <span class="pe-7s-user"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--dashboard is-active">
                                    <a href="{{route('dashboard')}}">Dashboard</a>
                                </li>
                                <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--orders">
                                    <a href="{{route('orders')}}">Orders</a>
                                </li>
                                <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--downloads">
                                    <a href="{{route('favorites')}}">Favorites</a>
                                </li>
                                <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--edit-adchair">
                                    <a href="{{route('address')}}">Addresses</a>
                                </li>
                                <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--edit-account">
                                    <a href="{{route('account.details')}}">Account details</a>
                                </li>
                                <li class="menu-item kreen-MyAccount-navigation-link kreen-MyAccount-navigation-link--customer-logout">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a class="block-link nb-user-logo-color" href="{{route('account')}}">
                                <span class="pe-7s-user"></span>
                            </a>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
