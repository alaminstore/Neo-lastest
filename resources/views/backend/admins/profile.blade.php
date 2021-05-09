@extends('backend.home')
@section('title','Admins')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="">
                <div class="card">
                    <div class="card-header">
                        Profile Update
                    </div>
                    <div class="card-body">
                        <form id="admin-add-form" action="{{route('admin.profile.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="user-name">Name</label>
                                    <input type="text"  name="name" id="user-name" class="form-control"  placeholder="Name" value="{{Auth::user()->name}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user-email">Email</label>
                                    <input type="email"  name="email" id="user-email" class="form-control"  placeholder="Email" value="{{Auth::user()->email}}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user-phone">Contact Number</label>
                                    <input type="text"  name="phone" id="user-phone" class="form-control"  placeholder="Phone Number" value="{{Auth::user()->phone}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="user-password">Old Password</label>
                                    <input type="password"  name="password" id="user-password" class="form-control"  placeholder="Password" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="user-new-password">New Password</label>
                                    <input type="password"  name="new_password" id="user-new-password" class="form-control"  placeholder="New Password" >
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="user-photo">Photo <span class="image-size">(300* 300)</span></label>
                                    <input type="file" name="photo" id="user-photo" class="form-control" >
                                    <div>
                                        @if(Auth::user()->photo)
                                            <img src="{{asset(Auth::user()->photo)}}" width="100" class="mt-1">
                                        @endif
                                    </div>
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