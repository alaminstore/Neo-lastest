@extends('backend.home')

@section('title','Settings')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="">
                <div class="card">
                    <div class="card-header">
                        Settings Update
                    </div>
                    <div class="card-body">
                        <form id="admin-add-form" action="{{route('admin.web.setting.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="site-name">App Name</label>
                                    <input type="text"  name="name" id="site-name" class="form-control"  placeholder="Enter Your Site Name" value="{{$setting->name ?? old('name')}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email"  name="email" id="email" class="form-control"  placeholder="Email" value="{{$setting->email ?? old('email')}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Contact Number</label>
                                    <input type="text"  name="phone" id="phone" class="form-control"  placeholder="Phone Number" value="{{$setting->phone ?? old('phone')}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="facebook">Facebook</label>
                                    <input type="text"  name="facebook" id="facebook" class="form-control"  placeholder="Facebook Page Link" value="{{$setting->facebook ?? old('facebook')}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="twitter">Twitter</label>
                                    <input type="text"  name="twitter" id="twitter" class="form-control"  placeholder="Twitter Page Link" value="{{$setting->twitter ?? old('twitter')}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <textarea type="text"  name="address" id="phone" class="form-control"  placeholder="Address">{!! $setting->address ?? old('address') !!}</textarea>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="logo">Logo <span class="image-size"></span></label>
                                    <input type="file" name="logo" id="logo" class="form-control" >
                                    @if($setting->logo)
                                        <img class="mt-2" src="{{asset($setting->logo)}}">
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="small-logo">Small Logo <span class="image-size"></span></label>
                                    <input type="file" name="small_logo" id="small-logo" class="form-control" >
                                    @if($setting->small_logo)
                                        <img class="mt-2" src="{{asset($setting->small_logo)}}">
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="favicon">Favicon <span class="image-size"></span></label>
                                    <input type="file" name="favicon" id="favicon" class="form-control" >
                                    @if($setting->favicon)
                                        <img class="mt-2" src="{{asset($setting->favicon)}}">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
        });
    </script>
@endsection