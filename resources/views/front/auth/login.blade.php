@extends('front.home')

@section('title','Login - NeoBazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset('/')}}images/banners/multiple-pages-banner.png"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Log In</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Log In</span></li>
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
                                <div class="u-column1 col-1">
                                    <h2>Login</h2>
                                    <form class="kreen-form kreen-form-login login" method="post" action="{{route('account')}}{{request('page') == 'checkout' ? '?page=checkout' : ''}}">
                                        @csrf
                                        <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                            <label for="email">Email/Mobile Number&nbsp;<span
                                                    class="required">*</span></label>
                                            <input type="text" class="kreen-Input kreen-Input--text input-text"
                                                   name="email" id="email" autocomplete="username" value=""></p>
                                        <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                            <label for="password">Password&nbsp;<span class="required">*</span></label>
                                            <input class="kreen-Input kreen-Input--text input-text"
                                                   type="password" name="password" id="password"
                                                   autocomplete="current-password">
                                        </p>
                                        <p class="form-row lost-pass">
                                            <button type="submit" style="cursor: pointer;" class="kreen-Button button" name="login"
                                                    value="Log in">Log in
                                            </button>
                                            <label class="kreen-form__label kreen-form__label-for-checkbox inline">
                                                <input class="kreen-form__input kreen-form__input-checkbox"
                                                       name="remember" type="checkbox" id="rememberme" >
                                                <span>Remember me</span>
                                            </label>
                                            <label class="kreen-LostPassword lost_password">
                                                <a href="{{route('password.email')}}">Lost your password?</a>
                                            </label>
                                        </p>
{{--                                        <div class="kreen-social-login">--}}
{{--                                            <h6>Login with social network</h6>--}}
{{--                                            <ul>--}}
{{--                                                <li>--}}
{{--                                                    <a class="login-facebook" href="{{url('login/facebook')}}">--}}
{{--                                                        <i class="fa fa-facebook"></i>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                                <li>--}}
{{--                                                    <a  class="login-google" href="#" target="_blank">--}}
{{--                                                        <i class="fa fa-google"></i>--}}
{{--                                                    </a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}

                                        <div class="kreen-create-account">
                                            <p>No account yet?</p>
                                            <p>
                                                <a class="create-account-link" href="{{route('account.register')}}">create an account</a>
                                            </p>
                                        </div>
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
