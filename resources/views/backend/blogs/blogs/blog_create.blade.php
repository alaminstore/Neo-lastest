@extends('backend.home')

@section('title','Blog Create')

@section('content')
	<div class="row">
		<div class="col-md-12 align-right mb-1">
			<a href="{{route('admin.blogs.index')}}" class="btn btn-sm btn-outline-dark">Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div>
				<form id="product-add-form" method="post" action="{{route('admin.blogs.store')}}" enctype="multipart/form-data">
					@csrf
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
												<input type="text"  name="blog_header" id="blog-title" class="form-control"  placeholder="Title" required value="{{old('blog_header')}}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="blog-description">Description</label>
												<textarea class="summernote" name="description" id="blog-description">{!! old('description') !!}</textarea>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div  class="form-group">
												<label for="post-date">Post Date</label>
												<input type="date"  name="post_date" id="post-date" class="form-control" required value="{{old('post_date')}}">
											</div>
										</div>
									</div>

									<button type="submit" class="btn btn-primary mr-2">Submit</button>
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
												@foreach($categories as $categorie)
													<option value="{{$categorie->blog_category_id}}">{{$categorie->category_name}}</option>
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
												<label for="full-image">Image</label>
												<input type="file"  name="full_image" id="full-image" class="form-control" required>
											</div>

										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="thumbnail-image">Thumbnail</label>
												<input type="file"  name="thumbnail_image" id="thumbnail-image" class="form-control" required>
											</div>

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
