@extends('front.home')

@section('title','Reset Password - NeoBazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset('front')}}/assets/images/banner-for-all2.jpg"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Password Reset</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Password Reset</span></li>
                </ul>
            </div>
        </div>
    </div>

    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="page-main-content">
                        <div class="kreen">
                            <div class="kreen-notices-wrapper"></div>
                            <div class="u-columns col2-set" id="customer_login">

                                <div class="u-column2 col-2">
                                    <h4>Please provide your registered email id</h4>
                                    <form action="{{route('password.send.email')}}" method="post">
                                        @csrf
                                        <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                            <input type="email" class="kreen-Input kreen-Input--text input-text"
                                                   name="email" id="full_name" value="{{old('email')}}" required>
                                        </p>
                                        <p class="kreen-FormRow form-row">
                                            <button type="submit" class="kreen-Button button" name="register"
                                                    value="Register">Send
                                            </button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
