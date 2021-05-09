@extends('front.home')
@section('title',$page.'- NeoBazaar')

@section('content')
    <!-- page title area end -->
    <div class="banner-wrapper has_background">


        @if($page == 'terms-conditions')
        @foreach ($banner_terms as $bn)
        <img src="{{asset($bn->image)}}"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        @endforeach
        @else
        @foreach ($banner_privacy as $bn)
        <img src="{{asset($bn->image)}}"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        @endforeach
        @endif
        <div class="banner-wrapper-inner">
            <h1 class="page-title">{{$page_title}}</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>{{$page_title}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- contact area start -->
    <section class="main-container no-sidebar">
        <div class="container">
            <div class="row">
                @if($page == 'terms-conditions')

                    <div class="pp-main-content">
                        @foreach($terms as $term)
                            {!!$term->answer!!}
                        @endforeach
                    </div>
                @endif

                @if($page == 'privacy-policy')

                    <div class="pp-main-content">
                        @foreach($privacy as $prv)
                            {!!$prv->answer!!}
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </section>
    <!-- contact area end -->
@endsection
