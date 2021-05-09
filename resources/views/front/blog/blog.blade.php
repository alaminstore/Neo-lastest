@extends('front.home')

@section('title','Blogs - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        @foreach ($banner as $bn)
        <img src="{{asset($bn->image)}}"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        @endforeach
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
        <div class="container-fluid px-0">
            <div class="blog-main-content blog-grid d-block d-md-none">
                @forelse($blogs as $blog)
                <div class="container-table @if($loop->odd) odd @endif @if($loop->even) even @endif">
                    <div class="container-cell img-wrapper">
                        <div class="az_single_image-wrapper az_box_border_grey">
                            <img src="{{asset($blog->full_image)}}"
                                 class="az_single_image-img attachment-full" alt="img">
                        </div>
                    </div>
                    <div class="container-cell content-wrapper post-item">
                        <h2 class="az_custom_heading">{{$blog->blog_header}}</h2>
                        <div class="blog-grid">
                            <div class="post-meta">
                                <div class="post-author">
                                    By:<a href="#" tabindex="0">{{$blog->user->name}} </a>
                                </div>
                                <div class="post-comment-icon">
                                    <a href="#" tabindex="0">{{$blog->blogReview ? $blog->blog_review_count : 0}} </a>
                                </div>
                                <div class="date">
                                    <a href="#">{{ date('F d, Y',strtotime($blog->post_date))}} </a>
                                </div>
                            </div>
                        </div>
                        {!! Str::limit($blog->description , 150) !!}
                        <br/>
                        <a href="{{route('blog.single',['id'=> $blog->blog_id, 'slug'=> $blog->slug])}}" class="readmore">Read more</a>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
            <div class="blog-main-content blog-main-content blog-grid d-none d-md-block">
                @forelse($blogs as $blog)
                <div class="container-table @if($loop->odd) odd @endif @if($loop->even) even @endif">
                    @if($loop->odd)
                    <div class="container-cell img-wrapper">
                        <div class="az_single_image-wrapper az_box_border_grey">
                            <img src="{{asset($blog->full_image)}}"
                                 class="az_single_image-img attachment-full" alt="img">
                        </div>
                    </div>
                    @endif
                    <div class="container-cell content-wrapper post-item">
                        <h2 class="az_custom_heading">{{$blog->blog_header}}</h2>
                        <div class="blog-grid">
                            <div class="post-meta">
                                <div class="post-author">
                                    By:<a href="#" tabindex="0">{{$blog->user->name}} </a>
                                </div>
                                <div class="post-comment-icon">
                                    <a href="#" tabindex="0">{{$blog->blog_review_count }} </a>
                                </div>
                                <div class="date">
                                    <a href="#">{{ date('F d, Y',strtotime($blog->post_date))}} </a>
                                </div>
                            </div>
                        </div>
                        {!! Str::limit($blog->description , 150) !!}
                        <br/>
                        <a href="{{route('blog.single',['id'=> $blog->blog_id, 'slug'=> $blog->slug])}}" class="readmore">Read more</a>
                    </div>
                        @if($loop->even)
                    <div class="container-cell img-wrapper">
                        <div class="az_single_image-wrapper az_box_border_grey">
                            <img src="{{asset($blog->full_image)}}"
                                 class="az_single_image-img attachment-full" alt="img"></div>
                    </div>
                    @endif
                </div>
                @empty

                @endforelse
            </div>
            <div class="container">
                <div class="post-footer">
                    <div class="categories">
                        <span>View by categories: </span>
                        @forelse($categories as $category)
                            <a href="{{route('category.blogs',['id'=> $category->blog_category_id, 'slug'=> $category->slug])}}">
                                {{$category->category_name}}@if($loop->last)@else, @endif
                            </a>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
            <nav class="navigation pagination">
            {!! $blogs->links('front.pagination.default') !!}
            </nav>
    </div>
</div>
@endsection

@section('js')

@endsection
