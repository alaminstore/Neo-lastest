@extends('backend.home')
@section('title','Product Item Create')
@section('content')
	<div class="row">
		<div class="col-md-12 align-right mb-1">
			<a href="{{route('admin.productitems.index')}}" class="btn btn-sm btn-outline-dark">Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div>
				<form id="product-add-form" method="post" action="{{route('admin.productitems.store')}}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									Product Item Create
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="product-item-name">Product Item Name</label>
												<input type="text"  name="product_item_name" id="product-item-name" class="form-control"  placeholder="Product Name" required value="{{old('product_item_name')}}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="product-item-description">Description</label>
												<textarea class="summernote" name="product_item_description" id="product-item-description">{{old('product_item_description')}}</textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-check form-check-flat form-check-primary mt-4" style="float: right;">
												<label for="new-arrival" class="form-check-label"><input type="checkbox"   name="new_arrival" id="new-arrival" class="form-group form-check-input" value="1">New Arrival</label>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-check form-check-flat form-check-primary mt-4" style="display: none;">
												<label for="popular" class="form-check-label"><input type="checkbox"   name="popular" id="popular" class="form-check-input" value="1">Popular</label>
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
									SubCategory
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<select name="product_sub_category" id="sub-category" class="form-control" required>
												<option value="">Select SubCategory</option>
												@foreach($sub_categories as $sub_category)
													<option value="{{$sub_category->product_sub_category_id}}">{{$sub_category->product_sub_category_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
							</div>


							<div class="card mt-3">
								<div class="card-header">
									Image (870 x 870)
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<input type="file"  name="image" id="product-home-image" class="form-control" required>
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
            });
        });
	</script>
@endsection
