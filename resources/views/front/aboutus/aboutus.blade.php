@extends('front.home')
@section('title','About Us - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        @foreach($aboutus_banner as $banner)
            <a href="{{$banner->add_link}}" target="_blank">
                <img src="{{$banner->image}}"
                     class="img-responsive attachment-1920x447 size-1920x447" alt="banner image">
            </a>
        @endforeach
            <div class="banner-wrapper-inner">
                <h1 class="page-title">About Us</h1>
                <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                        <li class="trail-item trail-end active"><span>About</span>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    <div class="site-main  main-container no-sidebar">
        <div class="section-037">
            <div class="container">
                <div class="kreen-popupvideo style-01">
                    <div class="popupvideo-inner">
                        @foreach ($whowe as $who)
                        <div class="icon">
                            <img src="{{$who->image}}"
                                 class="attachment-full size-full" alt="img">
                        </div>
                        <div class="popupvideo-wrap">
                            <h4 class="title">
                                {{$who->title}} </h4>
                          {!!$who->description!!}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="section-001">
            <div class="container">
                <div class="kreen-heading style-01">
                    <div class="heading-inner">
                        <h3 class="title">
                            Meet Our Team </h3>
                        <div class="subtitle">
                            A perfect blend of creativity and technical wizardry<br>
                            The best people fomula for great websites!
                        </div>
                    </div>
                </div>
                <div class="kreen-slide">
                    <div class="owl-slick equal-container better-height"
                         data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:3,&quot;rows&quot;:1}"
                         data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                        @if(count($sliders) > 0)
                            @foreach($sliders as $slider)
                        <div class=" style-01">
                            <div class="team-inner">
                                <div class="thumb-avatar">
                                    <a target="_self" tabindex="0">
                                        <img src="{{asset($slider->image)}}"
                                             class="attachment-full size-full" alt="img"></a>
                                </div>
                                <div class="content-team">
                                    <h3 class="name">
                                        <a href="#" target="_self" tabindex="0">{{$slider->name}} </a>
                                    </h3>
                                    <p class="positions">{{$slider->designation}}</p>
                                </div>
                            </div>
                        </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
