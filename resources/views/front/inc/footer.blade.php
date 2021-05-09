<footer id="footer" class="footer style-01">
    <div class="section-001 section-009">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="logo-wapper">
                        <div class="footer-logo">
                            <a href="{{url('/')}}"><img alt="NEO Bazaar" src="{{asset('/')}}images/logo.png" class="logo"></a>
                        </div>
                        <p>An e-Commerce platform for pure and safe food & products in Bangladesh. We are selling through our website and Facebook page only.</p>

                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="link-wapper">
                        <h3>Addtional Links</h3>
                        <div class="row">
                            <div class="col-5 col-md-5">
                                <ul>
                                    <li><a href="{{route('aboutus')}}">about us</a></li>
                                    <li class="d-block d-xl-none"><a href="{{route('contactus')}}">contact us</a></li>

                                    <li><a href="{{route('faq')}}">FAQ</a></li>
                                    @if(Auth::check())<li class="d-block d-xl-none"><a href={{url('/order-traking')}}>Track Order</a></li> @endif
                                </ul>
                            </div>
                            <div class="col-7 col-md-7">
                                <ul>
                                    <li><a href="{{route('page',['page'=>'terms-conditions'])}}">terms & conditions</a></li>
                                    <li><a href="{{route('page',['page'=>'privacy-policy'])}}">privacy policy</a></li>
                                    {{-- <li><a href="#">Store Locator</a></li> --}}
                                    <li class="d-block d-xl-none"><a href="{{route('blogs')}}">blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="kreen-newsletter style-01">
                        <div class="newsletter-inner">
                            <div class="newsletter-info">
                                <div class="newsletter-wrap">
                                    <h3 class="title">Newsletter</h3>
                                    <h4 class="subtitle">Get Discount
                                        <?php
                                            $subscribtion = \App\Models\NewsletterContent::all();
                                            foreach ($subscribtion as $subs){
                                                echo $subs->discount_amount;} ?>% Off</h4>
                                    <p class="desc">For your first purchase from NeoBazaar. Valid for 30 days.</p>
                                </div>
                            </div>
                            <div class="newsletter-form-wrap">
                                <div class="newsletter-form-inner">
                                    <input class="email email-newsletter" name="email" placeholder="Enter your email ..."
                                           type="email">
                                    <a href="#" class="button btn-submit submit-newsletter">
                                        <span class="text">
                                            <i class="fa fa-envelope-open-o"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-010">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6 order-1 order-lg-0">
                    <p>© Copyright 2021 <a href="{{url('/')}}">NEO Fusion Tech Ltd.</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-12 col-lg-6 order-0 order-lg-1">
                    <div class="kreen-socials style-01">
                        <div class="content-socials">
                            <ul class="socials-list">
                                <li>
                                    <a href="https://www.facebook.com/neobazaar20" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/neobazaar2020" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="fa fa-linkedin-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UCv1w44fv6T0gbIkQV9rhRkA" target="_blank">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!---->
<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="110901744075331">
      </div>
<!---->
<div class="footer-device-mobile">
    <div class="wapper">
        <div class="footer-device-mobile-item device-home">
            <a href="{{route('shop')}}">
					<span class="icon">
						<span class="pe-7s-home"></span>
					</span>
                Shop
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-wishlist">
            <a href="#" class="footer-search-open">
					<span class="icon">
						<span class="pe-7s-search"></span>
					</span>
                Search
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <a href="#" class="footer-cart-open" id="mobile-cart">
					<span class="icon">
						<span class="pe-7s-shopbag"></span>
						<span class="count-icon" id="mobile-view-count-cart">
							{{Cart::count()}}
						</span>
					</span>
                <span class="text">Cart</span>
            </a>
        </div>
    </div>
</div>
