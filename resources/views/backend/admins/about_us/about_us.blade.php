@extends('backend.home')
@section('title','About-Us')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Add Banner(About Us)
                </div>
                <div class="card-body">
                    <form id="slider-add-form" action="{{route('admin.about_us_banner_store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <?php
                        $banner = \App\Models\AboutUsBanner::all();
                        if ($banner->isEmpty()) {?>
                        <div class="form-group">
                            <label for="slider">Image (1920 x 447)</label>
                            <input type="file" name="image" id="slider" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <?php }else echo "Already have an Banner" ?>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-7">
            <div id="reload-slider">
                <div class="card">
                    <div class="card-header">
                        Banner Info
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table data-table-assign" id="slider-list" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="slider-body">
                                @foreach($sliders as $slider)
                                    <tr class="slider-row-{{$slider->slider_id}}">

                                        <td class="slider-column-name-{{$slider->slider_id}} text-center">
                                            <a href="{{asset($slider->image)}}" target="_blank"><img
                                                    src="{{asset($slider->image)}}" width="150"/></a>
                                        </td>

                                        <td class="text-center">
                                            <button class="btn btn-outline-danger btn-sm slider-delete" title="Delete"
                                                    onclick="deleteData({{$slider->id}})"><i class="ti-trash"></i>
                                                Delete
                                            </button>
                                            <form id="delete-form-{{$slider->id}}" method="post"
                                                  action="{{route('admin.aboutus.banner.destroy', $slider->id)}}"
                                                  style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
