<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">

        <a class="navbar-brand brand-logo mr-5" href="{{route('home')}}"><img
            @if($setting_for_all)
                @if($setting_for_all->logo)
                    src="{{asset($setting_for_all->logo)}}"
                @else
                    src="{{asset('/')}}images/logo.png"
                @endif
            @else
                src="{{asset('/')}}images/logo.png"
            @endif
            class="mr-2" alt="logo"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{route('home')}}"><img
            @if($setting_for_all)
                @if($setting_for_all->small_logo)
                    src="{{asset($setting_for_all->small_logo)}}"
                @else
                    src="{{asset('/')}}images/favicon.png"
                @endif
            @else
                src="{{asset('/')}}images/favicon.png"
            @endif
            alt="logo"/>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="ti-layout-grid2"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                <a class="nav-link"  href="{{url('/')}}" target="_blank">Go to Website</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @if(Auth::user()->photo)

                        <img src="{{asset(Auth::user()->photo)}}" alt="profile"/>
                    @else
                        <img src="{{asset('/')}}images/avater.png" alt="profile"/>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    {{--<a class="dropdown-item" href="{{ route('admin.profile') }}" >--}}
                        {{--<i class="ti-user text-primary"></i>--}}
                        {{--Profile--}}
                    {{--</a>--}}

                    {{--<a class="dropdown-item" href="{{ route('admin.web.setting') }}" >--}}
                        {{--<i class="ti-settings text-primary"></i>--}}
                        {{--Setting--}}
                    {{--</a>--}}
                    {{--<a class="dropdown-item" href="{{ route('admin.general.setting') }}" >--}}
                        {{--<i class="ti-settings text-primary"></i>--}}
                        {{--General Setting--}}
                    {{--</a>--}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="ti-layout-grid2"></span>
        </button>
    </div>
</nav>
