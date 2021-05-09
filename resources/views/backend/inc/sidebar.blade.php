<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @if(Auth::user()->role_id == 1)
        <li class="nav-item  {{url()->current() == route('home') ? 'active' : ''}}" href="{{ route('home')  }}">
            <a class="nav-link" href="{{route('home')}}">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-products" aria-expanded="false" aria-controls="ui-products">
                    <i class="ti-palette menu-icon"></i>
                    <span class="menu-title">Products</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-products">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.categories.index') ? 'active' : ''}}" href="{{route('admin.categories.index')}}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.subcategories.index') ? 'active' : ''}}" href="{{route('admin.subcategories.index')}}">Subcategories</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.productweights.index') ? 'active' : ''}}" href="{{route('admin.productweights.index')}}">Weights</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.productitems.index') ? 'active' : ''}}{{url()->current() == route('admin.productitems.create') ? 'active' : ''}}  {{url()->current() == Request::is('admin/productitems/*/edit') ? 'active' : ''}}" href="{{route('admin.productitems.index')}}">Product Items</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.productinfos.index') ? 'active' : ''}}{{url()->current() == route('admin.productinfos.create') ? 'active' : ''}}  {{url()->current() == Request::is('admin/productinfos/*/edit') ? 'active' : ''}}" href="{{route('admin.productinfos.index')}}">Product Infos</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-blog" aria-expanded="false" aria-controls="ui-blog">
                    <i class="ti-agenda menu-icon"></i>
                    <span class="menu-title">Blogs</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-blog">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{url()->current() == route('admin.order_blog_banner') ? 'active' : ''}}" href="{{route('admin.order_blog_banner')}}">Banner</a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.blogcategories.index') ? 'active' : ''}}" href="{{route('admin.blogcategories.index')}}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.blogs.index') ? 'active' : ''}}{{url()->current() == route('admin.blogs.create') ? 'active' : ''}}  {{url()->current() == Request::is('admin/blogs/*/edit') ? 'active' : ''}} " href="{{route('admin.blogs.index')}}">Blogs</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-reivew" aria-expanded="false" aria-controls="ui-reivew">
                    <i class="ti-comments menu-icon"></i>
                    <span class="menu-title">Reviews</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-reivew">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{url()->current() == route('admin.product.reviews') ? 'active' : ''}}" href="{{ route('admin.product.reviews')  }}">
                            Product Reviews
                        </a>
                    </li>

                    <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.blog.reviews') ? 'active' : ''}}" href="{{ route('admin.blog.reviews')  }}">
                                Blog Reviews
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item  {{url()->current() == route('admin.orders') ? 'active' : ''}} {{url()->current() == Request::is('admin/orders/*') ? 'active' : ''}}" href="{{ route('admin.orders')  }}">
                <a class="nav-link" href="{{route('admin.orders')}}">
                    <i class="ti-shopping-cart-full menu-icon"></i>
                    <span class="menu-title">Orders</span>
                </a>
            </li>

            <li class="nav-item  {{url()->current() == route('admin.discounts.index') ? 'active' : ''}}" href="{{ route('admin.discounts.index')  }}">
                <a class="nav-link" href="{{route('admin.discounts.index')}}">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Discounts</span>
                </a>
            </li>

            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-sliders" aria-expanded="false" aria-controls="ui-sliders">
                    <i class="ti-agenda menu-icon"></i>
                    <span class="menu-title">CMS</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-sliders">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.sliders.index') ? 'active' : ''}}" href="{{route('admin.sliders.index')}}">Sliders</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.medias.index') ? 'active' : ''}}" href="{{route('admin.medias.index')}}">Medias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.testimonials.index') ? 'active' : ''}}" href="{{route('admin.testimonials.index')}}">Testimonials</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-faq" aria-expanded="false" aria-controls="ui-sliders">
                    <i class="ti-agenda menu-icon"></i>
                    <span class="menu-title">FAQ</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-faq">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.faq_banner') ? 'active' : ''}}" href="{{route('admin.faq_banner')}}">Banner</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.faqcategories.index') ? 'active' : ''}}" href="{{route('admin.faqcategories.index')}}">Faq Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.faqs.index') ? 'active' : ''}}" href="{{route('admin.faqs.index')}}">Faqs</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-sliders-about" aria-expanded="false" aria-controls="ui-sliders">
                    <i class="ti-agenda menu-icon"></i>
                    <span class="menu-title">About Us</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-sliders-about">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.about_us') ? 'active' : ''}}" href="{{route('admin.about_us')}}">Banner</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.about_us.Whoweare') ? 'active' : ''}}" href="{{route('admin.about_us.Whoweare')}}">Who We Are</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.about_us.slider') ? 'active' : ''}}" href="{{route('admin.about_us.slider')}}">Team Members</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--  Contact us start--}}
            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-sliders-contact" aria-expanded="false" aria-controls="ui-sliders">
                    <i class="ti-agenda menu-icon"></i>
                    <span class="menu-title">Contact Us</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-sliders-contact">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.contact_us.banner') ? 'active' : ''}}" href="{{route('admin.contact_us.banner')}}">Banner</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.contactus') ? 'active' : ''}}" href="{{route('admin.contactus')}}">Information</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- Contact us  End --}}
            <li class="nav-item open-main-menu">
                <a class="nav-link" data-toggle="collapse" href="#ui-sliders-termscondition" aria-expanded="false" aria-controls="ui-sliders">
                    <i class="ti-agenda menu-icon"></i>
                    <span class="menu-title">Legal Issues</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-sliders-termscondition">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.terms_condition') ? 'active' : ''}}" href="{{route('admin.terms_condition')}}">Terms & Conditions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('admin.privacy_policy') ? 'active' : ''}}" href="{{route('admin.privacy_policy')}}">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item  {{url()->current() == route('admin.shop_banner') ? 'active' : ''}}" href="{{ route('admin.shop_banner')  }}">
                <a class="nav-link" href="{{route('admin.shop_banner')}}">
                    <i class="ti-unlink menu-icon"></i>
                    <span class="menu-title">Shop Banner</span>
                </a>
            </li>
            <li class="nav-item  {{url()->current() == route('admin.order_tracking_banner') ? 'active' : ''}}" href="{{ route('admin.order_tracking_banner')  }}">
                <a class="nav-link" href="{{route('admin.order_tracking_banner')}}">
                    <i class="ti-unlink menu-icon"></i>
                    <span class="menu-title">Order Tracking</span>
                </a>
            </li>

            <li class="nav-item  {{url()->current() == route('admin.referral') ? 'active' : ''}}" href="{{ route('admin.referral')  }}">
                <a class="nav-link" href="{{route('admin.referral')}}">
                    <i class="ti-unlink menu-icon"></i>
                    <span class="menu-title">Referrals</span>
                </a>
            </li>
            <li class="nav-item  {{url()->current() == route('admin.newsletter.customer') ? 'active' : ''}}" href="{{ route('admin.newsletter.customer')  }}">
                <a class="nav-link" href="{{route('admin.newsletter.customer')}}">
                    <i class="ti-unlink menu-icon"></i>
                    <span class="menu-title">Newsletter Discount</span>
                </a>
            </li>
            <li class="nav-item  {{url()->current() == route('admin.out_of_stock.produdct') ? 'active' : ''}}" href="{{ route('admin.out_of_stock.produdct')  }}">
                <a class="nav-link" href="{{route('admin.out_of_stock.produdct')}}">
                    <i class="ti-unlink menu-icon"></i>
                    <span class="menu-title">Out Of Stock</span>
                </a>
            </li>
        @endif

    </ul>
</nav>

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection
