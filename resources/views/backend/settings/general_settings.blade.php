@extends('backend.home')

@section('title','General Settings')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="">
                <div class="card">
                    <div class="card-header">
                        General Settings
                    </div>
                    <div class="card-body">
                        <form id="admin-add-form" action="{{route('admin.general.setting.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="site-name">Shipping Cost</label>
                                    <input type="text"  name="shipping" id="site-name" class="form-control"  placeholder="Enter Your Shipping Cost" value="{{$general_setting->shipping ?? old('shipping')}}">
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