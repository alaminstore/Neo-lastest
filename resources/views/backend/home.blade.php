<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','Coastalino')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend')}}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('backend')}}/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{asset('backend')}}/vendors/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="{{asset('backend')}}/vendors/jquery-toast-plugin/jquery.toast.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="{{asset('backend')}}/css/vertical-layout-light/style.css">
    @yield('css')
    <link rel="stylesheet" href="{{asset('backend')}}/css/custom.css">
    <!-- endinject -->
    <link rel="shortcut icon"
          @if($setting_for_all)
                @if($setting_for_all->favicon)
                    href="{{asset($setting_for_all->favicon)}}"
                @else
                    href="{{asset('/')}}images/favicon.png"
                @endif
          @else
                href="{{asset('/')}}images/favicon.png"
          @endif
    />

</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('backend.inc.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        @include('backend.inc.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://theantopolis.com" target="_blank">Antopolis</a>. All rights reserved.</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>

    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
<!-- plugins:js -->
<script src="{{asset('backend')}}/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->

<script src="{{asset('backend')}}/vendors/chart.js/Chart.min.js"></script>
<script src="{{asset('backend')}}/vendors/moment/moment.min.js"></script>
<script src="{{asset('backend')}}/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
<script src="{{asset('backend')}}/vendors/jquery-validation/jquery.validate.min.js"></script>
<script src="{{asset('backend')}}/vendors/summernote/dist/summernote-bs4.min.js"></script>
<script src="{{asset('backend')}}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="{{asset('backend')}}/vendors/select2/select2.min.js"></script>
<script src="{{asset('backend')}}/vendors/sweetalert/sweetalert.min.js"></script>
<!-- inject:js -->
<script src="{{asset('backend')}}/js/off-canvas.js"></script>
<script src="{{asset('backend')}}/js/hoverable-collapse.js"></script>
<script src="{{asset('backend')}}/js/template.js"></script>
<script src="{{asset('backend')}}/js/settings.js"></script>
<script src="{{asset('backend')}}/js/todolist.js"></script>
<script src="{{asset('backend')}}/js/select2.js"></script>
<script src="{{asset('backend')}}/js/data-table.js"></script>
<script src="{{asset('backend')}}/js/formpickers.js"></script>
<!-- endinject -->

<script src="{{asset('backend')}}/js/script.js"></script>
<script src="{{asset('backend')}}/js/dashboard.js"></script>

<script type="text/javascript">


    $( document ).ajaxStart(function() {
        $( "#overlay" ).show();
    });

    $( document ).ajaxComplete(function() {
        $( "#overlay" ).hide();
    });

    $(document).ready(function () {
       let activeMenu = $('.sub-menu li a.active');
       if(activeMenu.length == 1) {
           let element = $('.sub-menu li a.active').closest('.open-main-menu');
           element.children('.collapse').addClass('show');
           element.addClass('active');
       }
    });

    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
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
</script>
@yield('scripts')
</body>
</html>

