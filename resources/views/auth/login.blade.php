<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Admin Login</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('backend')}}/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="{{asset('backend')}}/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('backend')}}/css/vertical-layout-light/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{asset('backend')}}/images/favicon.png" />
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <h4>Hello! Let's get started</h4>
                                <h6 class="font-weight-light">Sign in to continue.</h6>
                                @if(Session::has('message'))
                                    <span class="text-danger">{{ Session::get('message') }}</span>
                                @endif
                                <form class="pt-3" method="POST" action="{{ route('admin.logged') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--<div class="my-2 d-flex justify-content-between align-items-center">--}}
                                        {{--<div class="form-check">--}}
                                            {{--<label class="form-check-label text-muted">--}}
                                                {{--<input type="checkbox" class="form-check-input" name="remember" value="{{ old('remember') ? 'checked' : '' }}">--}}
                                                {{--Keep me signed in--}}
                                            {{--</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="mt-3">
                                        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="">SIGN IN</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('backend')}}/vendors/js/vendor.bundle.base.js"></script>

        <script src="{{asset('backend')}}/js/off-canvas.js"></script>
        <script src="{{asset('backend')}}/js/hoverable-collapse.js"></script>
        <script src="{{asset('backend')}}/js/template.js"></script>
        <script src="{{asset('backend')}}/js/settings.js"></script>
        <script src="{{asset('backend')}}/js/todolist.js"></script>

    </body>

</html>
