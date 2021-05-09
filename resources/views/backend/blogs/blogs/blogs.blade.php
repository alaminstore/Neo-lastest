@extends('backend.home')
@section('title','Blogs')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/datatable.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend')}}/vendors/datatables.net/buttons.dataTables.min.css">
@endsection
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div id="reload-weight">
        <div class="card">
          <div class="card-header">
              <div class="row">
                  <div class="col-4">
                      <h4 class="card-title" style="margin-bottom: 0px;">Blogs List</h4>
                  </div>
                  <div class="col-8" style="text-align: right;">
                      <a href="{{route('admin.blogs.create')}}" class="btn btn-sm btn-outline-primary " style="padding: 3px 6px;"><i class="ti-plus"></i> Create</a>
                  </div>
              </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign"  width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Image</th>
                      <th>Thumbnail</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="weight-body">
                    @foreach($blogs as $blog)
                      <tr class="weight-row-{{$blog->blog_id}}">
                        <td>{{$blog->blog_id}}</td>
                        <td>{{$blog->blog_header}}</td>
                        <td class="item-column-name-{{$blog->blog_id}}">{{$blog->blogCategory->category_name}}</td>
                          <td class="item-column-name-{{$blog->blog_id}}"><img src="{{asset($blog->full_image)}}" ></td>
                          <td class="item-column-name-{{$blog->blog_id}}"><img src="{{asset($blog->thumbnail_image)}}" ></td>
                          <td class="item-column-name-{{$blog->blog_id}}">{{date('d-m-Y', strtotime($blog->post_date))}}</td>
                        <td class="item-column-name-{{$blog->blog_id}}">{!! Str::limit($blog->description, 100)!!}</td>
                        <td >
                          <a class="btn btn-outline-primary btn-sm item-edit"  href="{{route('admin.blogs.edit', $blog->blog_id)}}" title="Edit"><i class="ti-pencil"></i> Edit</a>
                          <button class="btn btn-outline-danger btn-sm item-delete"   onclick="deleteData({{$blog->blog_id}})" title="Delete"><i class="ti-trash"></i> Delete</button>
                            <form id="delete-form-{{$blog->blog_id}}" method="post" action="{{route('admin.blogs.destroy', $blog->blog_id)}}" style="display: none">
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

@section('scripts')
    <script src="{{asset('backend')}}/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/dataTables.buttons.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/jszip.min.js"></script>
    <script src="{{asset('backend')}}/vendors/datatables.net/buttons.html5.min.js"></script>

@endsection