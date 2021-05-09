@extends('front.home')

@section('title','Account - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset('front')}}/assets/images/banner-for-all2.jpg"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Account Details</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
					<li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
					<li class="trail-item trail-begin"><a href="{{route('dashboard')}}"><span>Dashboard</span></a></li>
                    <li class="trail-item trail-end active"><span>Account Details</span>
                    </li>
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
                            <main class="site-main  main-container no-sidebar">
                                <div class="container">
                                    <div class="row">
                                        <div class="main-content col-md-12">
                                            <div class="page-main-content">
                                                <div class="kreen">
													@include('front.user.sidebar')
                                                    <div class="kreen-MyAccount-content">
                                                        <div class="kreen-notices-wrapper"></div>
                                                        <form class="kreen-EditAccountForm edit-account" action="{{route('account.info.change')}}" method="post">
                                                            @csrf
                                                            <fieldset>
                                                            <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                                                <label for="account_first_name">Name&nbsp;<span
                                                                            class="required">*</span></label>
                                                                <input type="text" class="kreen-Input kreen-Input--text input-text"
                                                                       name="name" id="account_first_name" autocomplete="given-name"
                                                                       value="{{Auth::user()->name}}" required>
                                                            </p>
                                                            <div class="clear"></div>
                                                            <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                                                <label for="account_mobile_number">Mobile Number</label>
                                                                <input type="text" class="kreen-Input kreen-Input--text input-text"
                                                                      id="account_mobile_number" value="{{Auth::user()->mobile_no}}" readonly>
                                                            </p>
                                                            <div class="clear"></div>
                                                            <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                                                <label for="account_email">Email&nbsp;</label>
                                                                <input type="email" class="kreen-Input kreen-Input--email input-text"
                                                                       id="account_email" autocomplete="email"
                                                                       value="{{Auth::user()->email}}" readonly>
                                                            </p>
                                                            </fieldset>
                                                            <div class="clear"></div>
                                                            <p>
                                                                <button type="submit" class="kreen-Button button" name="save_account_details">Save changes</button>
                                                            </p>

                                                        </form>
                                                        <form class="kreen-EditAccountForm edit-account" action="{{route('account.change.password')}}" method="post">
                                                            @csrf
                                                            <fieldset>
                                                                <legend>Password change</legend>
                                                                <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                                                    <label for="password_current">Current password</label>
                                                                    <input type="password" class="kreen-Input kreen-Input--password input-text"
                                                                           name="old_password" id="password_current" autocomplete="off" required>
                                                                </p>
                                                                <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                                                    <label for="password_1">New password </label>
                                                                    <input type="password"
                                                                           class="kreen-Input kreen-Input--password input-text"
                                                                           name="password" id="password_1" autocomplete="off" required>
                                                                </p>
                                                                <p class="kreen-form-row kreen-form-row--wide form-row form-row-wide">
                                                                    <label for="password_2">Confirm new password</label>
                                                                    <input type="password"
                                                                           class="kreen-Input kreen-Input--password input-text"
                                                                           name="password_confirmation" id="password_2" autocomplete="off" required>
                                                                </p>
                                                            </fieldset>
                                                            <div class="clear"></div>
                                                            <p>
                                                                <button type="submit" class="kreen-Button button" name="save_account_details"
                                                                        value="Save changes">Save changes
                                                                </button>
                                                            </p>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>

    </script>
@endsection
