@extends('front.home')
@section('title','Order Traking - Neo Bazaar')

@section('content')

<div class="banner-wrapper has_background">
    @foreach ($banner as $bn)
    <img src="{{ asset($bn->image) }}"
         class="img-responsive attachment-1920x447 size-1920x447" alt="img">
    @endforeach
    <div class="banner-wrapper-inner">
        <h1 class="page-title">Order Tracking</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                <li class="trail-item trail-begin"><a href="order-tracking.html"><span>Order Tracking</span></a></li>
                <li class="trail-item trail-end active"><span>Tracking Step</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="main-container no-sidebar">
    <!-- POST LAYOUT -->
    <div class="container">

        <table style="max-width: 602px; width: 100%; border-spacing: 0; margin-left: auto; margin-right: auto; margin-bottom: 0;">
            <tbody>
                <tr>
                    <td style="background-color: #3084bb; padding: 16px 16px 8px 16px; text-align:center;">
                            <h1 style="font-size: 24px; color: #fff; font-weight: 600; text-transform: uppercase; margin: 0;">order Number:  <span>{{$status->order_id}}</span></h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($order_status == "order confirmed")
                        <img src="{{ url('/images/order_tracking/ot-4.png') }}"  width="" height="" alt="order confirmed" />
                        @elseif ($order_status == "processing")
                        <img src="{{ url('/images/order_tracking/ot-3.png') }}"  width="" height="" alt="processing" />
                        @elseif ($order_status == "order shipping")
                        <img src="{{ url('/images/order_tracking/ot-2.png') }}"  width="" height="" alt="order shipping" />
                        @elseif ($order_status == "order delivered")
                        <img src="{{ url('/images/order_tracking/ot-1.png') }}"  width="" height="" alt="order delivered" />
                        @elseif ($order_status == "Canceled")
                        @else
                        <br>
                          <p class="text-center">The order has been cancelled.</p>
                           <p class="text-center"> <a type="button" class="btn btn-outline-primary btn-sm" href="{{route('order.traking')}}">Go Back</a></p>
                        @endif
                    </td>
                </tr>

            </tbody>
        </table>



        <!-- <div class="tracking-step">
            <img class="w-100 img-fluid" src="assets/images/shipment-tracking.jpg" alt="">
        </div> -->
    </div>
</div>


<footer id="footer" class="footer style-01">
    <div class="section-001 section-009">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="logo-wapper">
                        <div class="footer-logo">
                            <a href="index.html"><img alt="NEO Bazaar" src="assets/img/neo-logo.png" class="logo"></a>
                        </div>
                        <p>After had a long survey we feel that there is a huge lack of pure and safe products in exchange of money. Realizing this we decided to produce and import high quality products for ourselves.</p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="link-wapper">
                        <h3>Addtional Links</h3>
                        <div class="row">
                            <div class="col-5 col-md-5">
                                <ul>
                                    <li><a href="about.html">about us</a></li>
                                    <li class="d-block d-xl-none"><a href="contact.html">contact us</a></li>
                                    <li><a href="order-tracking.html">track order</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                </ul>
                            </div>
                            <div class="col-7 col-md-7">
                                <ul>
                                    <li><a href="terms-condition.html">terms & conditions</a></li>
                                    <li><a href="privacy-policy.html">privacy policy</a></li>
                                    <li><a href="#">Store Locator</a></li>
                                    <li class="d-block d-xl-none"><a href="blog.html">blog</a></li>
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
                                    <h4 class="subtitle">Get Discount 30% Off</h4>
                                    <p class="desc">Suspendisse netus proin eleifend fusce sollicitudin potenti vel magnis
                                        nascetur</p>
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
                    <p>© Copyright 2021 <a href="index.html">NEO Bazaar</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-12 col-lg-6 order-0 order-lg-1">
                    <div class="kreen-socials style-01">
                        <div class="content-socials">
                            <ul class="socials-list">
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class="fa fa-linkedin-square"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
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
<div class="footer-device-mobile">
    <div class="wapper">
        <div class="footer-device-mobile-item device-home">
            <a href="index.html">
					<span class="icon">
						<span class="pe-7s-home"></span>
					</span>
                Home
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-wishlist">
            <a href="wishlist.html">
					<span class="icon">
						<span class="pe-7s-like"></span>
					</span>
                Wishlist
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <a href="cart.html">
					<span class="icon">
						<span class="pe-7s-shopbag"></span>
						<span class="count-icon">
							0
						</span>
					</span>
                <span class="text">Cart</span>
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-user">
            <a href="my-account.html">
					<span class="icon">
						<span class="pe-7s-user"></span>
					</span>
                Account
            </a>
        </div>
    </div>
</div>
<a href="#" class="backtotop active">
    <i class="fa fa-angle-up"></i>
</a>
@endsection
