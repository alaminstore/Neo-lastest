@extends('front.home')
@section('title',$blog->blog_header.'- Neo Bazaar')
@section('content')
    <div class="banner-wrapper no_background">
        <div class="banner-wrapper-inner">
            <div class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb" style="text-align: left;">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item"><a href="{{route('blogs')}}"><span>Blog</span></a></li>
                    <li class="trail-item trail-end active"><span>{{$blog->blog_header}}.</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-container right-sidebar has-sidebar">
        <!-- POST LAYOUT -->
        <div class="container">
            <div class="row">
                <div class="main-content col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    <article
                            class="post-item post-single post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                        <div class="single-post-thumb">
                            <div class="post-thumb">
                                <img src="{{asset($blog->full_image)}}"
                                     class="attachment-full size-full wp-post-image" alt="img">
                            </div>
                        </div>
                        <div class="single-post-info">
                            <h2 class="post-title">{{$blog->blog_header}}</h2>
                            <div class="post-meta">
                                <div class="date">
                                    <a href="#">{{ date('F d, Y',strtotime($blog->post_date))}} </a>
                                </div>
                                <div class="post-author">
                                    By:<a href="#"> admin </a>
                                </div>
                            </div>
                        </div>
                        <div class="post-content">
                            <div id="output">
                                {!! $blog->description !!}
                            </div>
                            <p>&nbsp;</p>
                        </div>
                        <div class="post-footer">
                            <div class="kreen-share-socials">
                                <h5 class="social-heading">Share: </h5>
                                <a target="_blank" class="facebook" id="fb_btn" href="#"><i class="fa fa-facebook-f"></i></a>
                                <a style="display:none;" target="_blank" class="instagram" id="insta_btn" href="#"><i class="fa fa-instagram"></i></a>
                                <a target="_blank" class="linkedin" href="#" id="linkedin_btn">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </article>

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
                                                                <h5>{{$review->replyUser->name}}</h5>
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
                                    {!! $reviews->links('front.pagination.default') !!}
                                </div>
                            </div>
                            <!-- postbox end -->
                            @if(Auth::check())
                                <div id="review_form_wrapper" class="mt-5">
                                    <div id="review_form">
                                        <div id="respond" class="comment-respond">
                                            <span id="reply-title" class="comment-reply-title">Be the first to review “{{$blog->blog_header}}”</span>
                                            <form id="commentform" class="comment-form" action="{{route('blog.review.store')}}" method="post">
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
                                                    <input name="blog" value="{{$blog->blog_id}}" type="hidden">
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
                </div>

                <div class="sidebar kreen_sidebar col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    <div id="widget-area" class="widget-area sidebar-blog">
                        <div id="categories-3" class="widget widget_categories">
                            <h2 class="widgettitle">Categories<span
                                        class="arrow"></span></h2>
                            <ul>
                                @forelse($categories as $category)
                                    <li class="cat-item cat-item-51"><a href="{{route('category.blogs',['id'=> $category->blog_category_id, 'slug'=> $category->slug])}}">{{$category->category_name}}</a></li>
                                @empty

                                @endforelse
                            </ul>
                        </div>
                        <div id="widget_kreen_post-2" class="widget widget-kreen-post"><h2 class="widgettitle">Recent
                                Post<span class="arrow"></span></h2>
                            <div class="kreen-posts">
                                @forelse($recent_blogs as $recent_blog)
                                <article
                                        class="post-195 post type-post status-publish format-standard has-post-thumbnail hentry category-light category-table category-life-style tag-light tag-life-style">
                                    <div class="post-item-inner">
                                        <div class="post-thumb">
                                            <a href="{{route('blog.single',['id'=> $recent_blog->blog_id, 'slug'=> $recent_blog->slug])}}">
                                                <img src="{{asset($recent_blog->thumbnail_image)}}"
                                                     class="img-responsive attachment-83x83 size-83x83" alt="img" width="83"
                                                     height="83"> </a>
                                        </div>
                                        <div class="post-info">
                                            <div class="block-title">
                                                <h2 class="post-title"><a
                                                            href="{{route('blog.single',['id'=> $recent_blog->blog_id, 'slug'=> $recent_blog->slug])}}">{{$recent_blog->blog_header}}</a></h2>
                                            </div>
                                            <div class="date">{{ date('F d, Y',strtotime($recent_blog->post_date))}}</div>
                                        </div>
                                    </div>
                                </article>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div><!-- .widget-area -->
                </div>
            </div>
        </div>
    </div>
    <script>
        const fb_btn = document.getElementById('fb_btn');
        const insta_btn = document.getElementById('insta_btn');
        const linkedin_btn = document.getElementById('linkedin_btn');

        let postUrl = encodeURI(document.location.href);
        let postTitle = encodeURI(`{{$blog->blog_header}}`);
        fb_btn.setAttribute("href",`https://www.facebook.com/sharer.php?u=${postUrl}`);
        insta_btn.setAttribute("href",`https://www.instagram.com/sharer.php?u=${postUrl}`);
        linkedin_btn.setAttribute("href",`https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);

    </script>
@endsection


