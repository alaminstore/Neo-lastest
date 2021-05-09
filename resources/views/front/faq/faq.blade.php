@extends('front.home')
@section('title', 'FAQ - NeoBazaar')
@section('content')
    <div class="banner-wrapper has_background">
        @foreach($banner as $ban)
            <img src="{{$ban->image}}" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        @endforeach
        <div class="banner-wrapper-inner">
            <h1 class="page-title">FAQ</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>FAQ</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-container no-sidebar">
        <!-- POST LAYOUT -->
        <div class="container">
            <div class="faq-main-content">
                <div class="row">
                    <div class="col-ts-12 col-md-8 col-lg-9 order-1 order-md-0">
                        <div class="faq-content-wrapper">
                            <div class="tab-content" id="faq-tabContent">
                                @foreach($faq_categories as $faq_category)
                                    <div class="tab-pane fade {{$loop->index == 0 ? 'show active' : ''}}"
                                         id="about-us-{{$loop->index}}" role="tabpanel"
                                         aria-labelledby="about-us-tab{{$loop->index}}">
                                        <div class="faq-accordion" id="aboutUs{{$faq_category->faq_category_id}}">
                                            @foreach($faq_category->faqAll as $faq)

                                                <div class="card">
                                                    <div class="card-header"
                                                         id="aboutHead{{$loop->index}}{{$loop->depth}}">
                                                        <a href="#"
                                                           class="btn btn-header-link {{$loop->index.''.$loop->depth == 02 ? '' : 'collapsed'}}"
                                                           data-toggle="collapse"
                                                           data-target="#aboutUsi{{$loop->index}}{{$loop->depth}}"
                                                           aria-expanded="{{$loop->index.''.$loop->depth == 02 ? 'true' : 'false'}}"
                                                           aria-controls="aboutUsi{{$loop->index}}{{$loop->depth}}">{{$faq->question}}</a>
                                                    </div>

                                                    <div id="aboutUsi{{$loop->index}}{{$loop->depth}}"
                                                         class="collapse {{$loop->index.''.$loop->depth == 02 ? 'show' : ''}}"
                                                         aria-labelledby="aboutHead{{$loop->index}}{{$loop->depth}}"
                                                         data-parent="#aboutUs{{$faq_category->faq_category_id}}">
                                                        <div class="card-body">
                                                            {!! $faq->answer !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-ts-12 col-md-4 col-lg-3 order-0 order-md-1">
                        <div class="faq-tab-wrapper">
                            <div class="nav flex-column nav-pills" id="faq-tab" role="tablist"
                                 aria-orientation="vertical">
                                @foreach($faq_categories as $faq_category)
                                    <a class="nav-link {{$loop->index == 0 ? 'active' : ''}}"
                                       id="about-us-tab{{$loop->index}}"
                                       data-toggle="pill" href="#about-us-{{$loop->index}}" role="tab"
                                       aria-controls="about-us"
                                       aria-selected="{{$loop->index ? 'true' : 'false'}}">{{$faq_category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
