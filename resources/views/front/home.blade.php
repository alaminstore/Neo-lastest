<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/')}}images/favicon.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/chosen.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/jquery.scrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/lightbox.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/magnific-popup.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/vendors/toast/jquery.toast.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/fonts/flaticon.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/megamenu.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/dreaming-attribute.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('front')}}/assets/css/custom.css"/>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <title>@yield('title','NEO Bazaar')</title>
</head>
<body>
    <div class="loader" >
        <div class="loading-image">
            <img src="{{asset('/')}}images/loader.gif" alt="">
        </div>
    </div>
    @include('front.inc.header')
    <!-- fixed style cart start -->
    @include('front.inc.cart_right')

    @yield('content')
    @include('front.inc.footer')
    <a href="#" class="backtotop active">
        <i class="fa fa-angle-up"></i>
    </a>

<script src="{{asset('front')}}/assets/js/jquery-1.12.4.min.js"></script>
<script src="{{asset('front')}}/assets/js/bootstrap.min.js"></script>
<script src="{{asset('front')}}/assets/js/chosen.min.js"></script>
<script src="{{asset('front')}}/assets/js/countdown.min.js"></script>
<script src="{{asset('front')}}/assets/js/jquery.scrollbar.min.js"></script>
<script src="{{asset('front')}}/assets/js/lightbox.min.js"></script>
<script src="{{asset('front')}}/assets/js/magnific-popup.min.js"></script>
<script src="{{asset('front')}}/assets/vendors/toast/jquery.toast.min.js"></script>
<script src="{{asset('front')}}/assets/js/slick.js"></script>
<script src="{{asset('front')}}/assets/js/jquery.zoom.min.js"></script>
<script src="{{asset('front')}}/assets/js/threesixty.min.js"></script>
<script src="{{asset('front')}}/assets/js/jquery-ui.min.js"></script>
<script src="{{asset('front')}}/assets/js/mobilemenu.js"></script>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyC3nDHy1dARR-Pa_2jjPCjvsOR4bcILYsM'></script>
<script src="{{asset('front')}}/assets/js/functions.js"></script>
<script src="{{asset('front')}}/assets/js/menubar.js"></script>
<script src="{{asset('front')}}/assets/js/search.js"></script>
<script src="{{asset('front')}}/assets/js/newsletter.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script type="text/javascript">
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "300",
        "timeOut": "10000",
        "extendedTimeOut": "300",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    let currency_symbol = '{{$currency_symbol}}';

    @if(Session::has('message'))
        let type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

            case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

            case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

            case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
        }
    @endif

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    $('#co-header-wishlist, .co-check-wishlist').click(function (event) {
        event.preventDefault();
        toastr.error('Please Login first');
    });
    $(window).load(function () {
        $(".loader").addClass("hidden");
    });
</script>
@yield('js')
</body>
</html>
