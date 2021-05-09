@extends('backend.home')
@section('title','Blog-Banner')
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Blog Banner (1920 x 447)
                </div>
                <div class="card-body">
                    <form id="slider-add-form" action="{{route('admin.order_blog_banner.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <?php
                        $banner = \App\Models\Blogbanner::all();
                        if ($banner->isEmpty()) {?>
                        <div class="form-group">
                            <label for="slider">Image</label>
                            <input type="file" name="image" id="slider" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <?php }else echo "You can delete & create new" ?>
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
                                @foreach($banner as $bn)
                                    <tr class="slider-row-{{$bn->id}}">

                                        <td class="slider-column-name-{{$bn->id}} text-center">
                                            <a href="{{asset($bn->image)}}" target="_blank"><img
                                                    src="{{asset($bn->image)}}" width="150"/></a>
                                        </td>

                                        <td class="text-center">
                                            <button class="btn btn-outline-danger btn-sm slider-delete" title="Delete"
                                                    onclick="deleteData({{$bn->id}})"><i class="ti-trash"></i>
                                                Delete
                                            </button>
                                            <form id="delete-form-{{$bn->id}}" method="post"
                                                  action="{{route('admin.forder_blog_banner.delete', $bn->id)}}"
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
