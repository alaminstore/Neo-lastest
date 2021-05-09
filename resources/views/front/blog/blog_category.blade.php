@extends('front.home')

@section('title','Blogs - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset('/')}}images/banners/Blog.png"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Our Blog</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Blog</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-container no-sidebar">
        <!-- POST LAYOUT -->
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12 col-sm-12">
                    <div class="blog-grid auto-clear content-post row">
                        @forelse($blogs as $blog)
                        <article
                            class="post-item post-grid col-bg-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-ts-12 post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                            <div class="post-inner">
                                <div class="post-thumb">
                                    <a href="single-post.html">
                                        <img src="{{asset($blog->thumbnail_image)}}"
                                             class="img-responsive attachment-370x330 size-370x330" alt="img" width="370"
                                             height="330"> </a>
                                    <a class="datebox" href="#">
                                        <span>{{ date('d',strtotime($blog->post_date))}}</span>
                                        <span>{{ date('M',strtotime($blog->post_date))}}</span>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <div class="post-author">
                                            By:<a href="#"> {{$blog->user->name}} </a>
                                        </div>
                                        <div class="post-comment-icon">
                                            <a href="#">{{$blog->blog_review_count}}</a>
                                        </div>
                                    </div>
                                    <div class="post-info equal-elem">
                                        <h2 class="post-title"><a href="{{route('blog.single',['id'=> $blog->blog_id, 'slug'=> $blog->slug])}}">{{$blog->blog_header}}</a></h2>
                                        {!! Str::limit($blog->description , 70) !!}
                                    </div>
                                </div>
                            </div>
                        </article>
                        @empty

                        @endforelse
                    </div>
                    <nav class="navigation pagination">
                        {!! $blogs->links('front.pagination.default') !!}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
