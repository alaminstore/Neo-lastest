@extends('front.home')

@section('title','Dashboard - Neo Bazaar')

@section('content')
{{-- banner-for-all2.jpg --}}
    <div class="banner-wrapper has_background">

        <img src="{{asset('/')}}banner-for-all2.jpg"
        class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Dashboard</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
                    <li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li class="trail-item trail-end active"><span>Dashboard</span>
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
                            @include('front.user.sidebar')
                            <div class="kreen-MyAccount-content">
                                <div class="kreen-notices-wrapper"></div>
                                <p>Hello <strong>{{Auth::user()->name}}</strong>
                                     (<a class="dash-log" href="{{ route('logout') }}"
                                                              onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                                    )</p>
                                <p>From your account dashboard you can view your manage your shipping and billing addresses, and edit your password and account details.</p>
                            </div>
                        </div>
                        <div class="referral">
                            <form action="{{route('dashboard.store')}}" method="POST">
                                @csrf
                                <p>
                                    <label> Refferal Mail Id &nbsp;
                                        <span class="wpcf7-form-control-wrap your-email">
                                          <input name="referrer" placeholder="referrer mail here.." size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" type="email">
                                        </span>
                                        <?php
                                        $user_id = auth()->user()->user_id;
//                                        echo $user_id;
                                        ?>
                                        <input type="hidden" name="user_id" value="{{$user_id}}">
                                        <button type="submit" style="cursor: pointer;">
                                            send
                                        </button>
                                    </label>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>
        {{--let accounts = '{{request()->query("account")}}';--}}

        {{--if( accounts == 'orders')--}}
        {{--{--}}
            {{--let order = document.getElementById("id2");--}}
            {{--order.click();--}}
        {{--}--}}

        {{--if( accounts == 'wishlist')--}}
        {{--{--}}
            {{--document.getElementById("id3").click();--}}
        {{--}--}}

        {{--if(accounts == 'details')--}}
        {{--{--}}
            {{--document.getElementById("id4").click();--}}
        {{--}--}}
        {{--$('.show-details-view').on('click', function () {--}}
            {{--let serial = $(this).attr('data-key');--}}
           {{--let maintr =  $(this).closest('tr').siblings();--}}
           {{--let className = $('.show-detail-'+serial);--}}
            {{--if(className.css('height') == '0px')--}}
            {{--{--}}
                {{--className.css('height','auto');--}}
            {{--}--}}
            {{--else--}}
            {{--{--}}
                {{--className.css('height','0px');--}}
            {{--}--}}
        {{--});--}}
    </script>
@endsection
