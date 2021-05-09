@extends('backend.home')
@section('title','Product Item Edit')
@section('content')
	<div class="row">
		<div class="col-md-12 align-right mb-1">
			<a href="{{route('admin.blogs.index')}}" class="btn btn-sm btn-outline-dark">Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div>
				<form id="product-add-form" method="post" action="{{route('admin.blogs.update',$blog->blog_id)}}" enctype="multipart/form-data">
					@csrf
					{{ method_field('PATCH') }}
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									Blog Create
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="blog-title">Title</label>
												<input type="text"  name="blog_header" id="blog-title" class="form-control"  placeholder="Title" required value="{{$blog->blog_header}}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="blog-description">Description</label>
												<textarea class="summernote" name="description" id="blog-description">{!! $blog->description  !!}</textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div  class="form-group">
												<label for="post-date">Post Date</label>
												<input type="date" value="{{date('Y-m-d', strtotime($blog->post_date))}}"  name="post_date" id="post-date" class="form-control"  required >
											</div>
										</div>
									</div>

									<button type="submit" class="btn btn-primary mr-2">Update</button>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									Category
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<select name="blog_category" id="sub-category" class="form-control" required>
												<option value="">Select Category</option>
												@foreach($categories as $category)
													<option value="{{$category->blog_category_id}}" {{$blog->blog_category_id == $category->blog_category_id ? 'selected' : ''}}>{{$category->category_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>


							<div class="card mt-3">
								<div class="card-header">
									Images
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="full-image">Image (1024 x 512)</label>
												<input type="file"  name="full_image" id="full-image" class="form-control">
											</div>
											@if($blog->full_image)
												<img src="{{asset($blog->full_image)}}" style="max-height: 120px">
											@endif
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="thumbnail-image">Thumbnail (970 x 330)</label>
												<input type="file"  name="thumbnail_image" id="thumbnail-image" class="form-control">
											</div>
											@if($blog->thumbnail_image)
												<img src="{{asset($blog->thumbnail_image)}}" style="max-height: 120px">
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
        $(document).ready(function (){
            $('.summernote').summernote({
                height: 120,
                width: "100%",
                styleTags: [
                    'p',
                    { title: 'Blockquote', tag: 'blockquote', className: 'blockquote', value: 'blockquote' },
                    'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'
                ],
            });
        });
	</script>
@endsection
