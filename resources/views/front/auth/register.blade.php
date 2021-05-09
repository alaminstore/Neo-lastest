@extends('front.home')

@section('title','Register - NeoBazaar')

@section('content')

<div class="banner-wrapper has_background">
    <img src="{{asset("/")}}/images/banners/multiple-pages-banner.png"
         class="img-responsive attachment-1920x447 size-1920x447" alt="img">
    <div class="banner-wrapper-inner">
        <h1 class="page-title">Registration</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                <li class="trail-item trail-end active"><span>Registration</span></li>
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
                                <h2>Register Here</h2>
                                <form method="post" class="kreen-form kreen-form-register register" action="{{route('account.register')}}">
                                    @csrf
                                    <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                        <label for="full_name">Username&nbsp;<span
                                                class="required">*</span></label>
                                        <input type="text" class="kreen-Input kreen-Input--text input-text"
                                               name="name" id="full_name" value="{{old('name')}}" required>
                                    </p>
                                    <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                        <label for="mobile_number">Mobile Number&nbsp;<span
                                                class="required">*</span></label>
                                        <input type="text" class="kreen-Input kreen-Input--text input-text"
                                               name="mobile_number" id="mobile_number" value="{{old('mobile_number')}}" required>
                                    </p>
                                    <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                        <label for="reg_email">Email Address&nbsp;<span
                                                class="required">*</span></label>
                                        <input type="email" class="kreen-Input kreen-Input--text input-text"
                                               name="email" id="reg_email" autocomplete="email" value="{{old('email')}}" required>
                                    </p>
                                    <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                        <label for="password">Password&nbsp;<span
                                                class="required">*</span></label>
                                        <input type="password" class="kreen-Input kreen-Input--text input-text"
                                               name="password" id="password" required>
                                    </p>
                                    <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                        <label for="conf_password">Confirm Password&nbsp;<span
                                                class="required">*</span></label>
                                        <input type="password" class="kreen-Input kreen-Input--text input-text"
                                               name="password_confirmation" id="conf_password" required>
                                    </p>
                                    <div class="kreen-privacy-policy-text"><p>Your personal data will be used to
                                            support your experience throughout this website, to manage access to your
                                            account, and for other purposes described in our <a
                                                href="{{route('page',['page'=>'privacy-policy'])}}" class="kreen-privacy-policy-link"
                                                target="_blank">privacy policy</a>.</p>
                                    </div>
                                    <p class="kreen-FormRow form-row">
                                        <button type="submit" class="kreen-Button button" name="register"
                                                value="Register">Create Account
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
