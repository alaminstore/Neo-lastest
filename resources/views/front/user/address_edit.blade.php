@extends('front.home')

@section('title','Address - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset('front')}}/assets/images/banner-for-all2.jpg"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Address</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
					<li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
					<li class="trail-item trail-begin"><a href="{{route('dashboard')}}"><span>Dashboard</span></a></li>
                    <li class="trail-item trail-end active"><span>Address</span>
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
                            @include('front.user.sidebar')
                            <div class="kreen-MyAccount-content">
                                <div class="kreen-notices-wrapper"></div>

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
