@extends('front.home')
@section('title','Contact Us - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        @foreach ($banner as $bn)
        <img src="{{asset($bn->image)}}"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        @endforeach
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Contact Us</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Contact</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="site-main main-container no-sidebar">
        <div class="section-041">
            <div class="container">
                <div class="kreen-google-maps">
                    {{-- <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1cP78pF0PTdF0dikydhFXhM6ah9GKa4Fc" width="640" height="480"></iframe> --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.2738618016047!2d90.40781711450258!3d23.773260293820673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c779ca3ebc23%3A0x6b23f0659cde3323!2sNiketan%2C%20Gulshan%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1611730281486!5m2!1sen!2sbd" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
                <!-- <div class="kreen-google-maps" id="kreen-google-maps" data-hue="" data-lightness="1" data-map-style="2"
					 data-saturation="-99" data-longitude="-73.985130" data-latitude="40.758896" data-pin-icon=""
					 data-zoom="14" data-map-type="ROADMAP"></div> -->
            </div>
        </div>
        <div class="section-042">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 offset-xl-1 col-xl-10 col-lg-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="az-custom-box">
                                    @foreach ($contactus_info as $info )
                                    <h4 class="az_custom_heading">Factory:</h4>
                                    <p>{{$info->factory}}</p>
                                    <h4 class="az_custom_heading">Marketing & Distribution:</h4>
                                    <p>{{$info->marketing_distribution}}</p>
                                    <h4 class="az_custom_heading">Phone: <span>{{$info->phone}}</span></h4>
                                    <h4 class="az_custom_heading">Email: <span>{{$info->email}}</span></h4>
                                    <h4 class="az_custom_heading">Messenger: <span>{{$info->messenger}}</span></h4>
                                    @endforeach
                                </div>
                                <!-- <h4 class="az_custom_heading">Store Hours</h4>
								<p>Monday-Saturday 11am-7pm ET<br>
									Sunday 11am-6pm ET</p>
								<h4 class="az_custom_heading">Specialist Hours</h4>
								<p>Monday-Friday 9am-5pm ET</p> -->
                            </div>
                            <div class="col-md-6">
                                <div role="form" class="wpcf7">
                                    <form class="wpcf7-form" action="{{route('contactus.send')}}" method="post">
                                        @csrf
                                        <p><label> Name *<br>
                                                <span class="wpcf7-form-control-wrap your-name">
                                            <input name="name" value="" size="40"
                                                   class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                   type="text"></span>
                                            </label></p>
                                        <p><label> Email *<br>
                                                <span class="wpcf7-form-control-wrap your-email">
                                            <input name="email" value="" size="40"
                                                   class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                   type="email"></span>
                                            </label></p>
                                        <p><label> Your Message *<br>
                                                <span class="wpcf7-form-control-wrap your-message">
                                            <textarea name="message"
                                                      cols="40" rows="10"
                                                      class="wpcf7-form-control wpcf7-textarea"></textarea></span>
                                            </label></p>
                                        <p><input value="Send" class="wpcf7-form-control wpcf7-submit" type="submit"></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
