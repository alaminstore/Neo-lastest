@extends('backend.home')
@section('title','Product Item Edit')
@section('content')
	<div class="row">
		<div class="col-md-12 align-right mb-1">
			<a href="{{route('admin.productitems.index')}}" class="btn btn-sm btn-outline-dark">Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div>
				<form id="product-add-form" method="post" action="{{route('admin.productitems.update',$product_item->product_item_id)}}" enctype="multipart/form-data">
					@csrf
					{{ method_field('PATCH') }}
					<div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									Product Item Edit
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="product-item-name">Product Item Name</label>
												<input type="text"  name="product_item_name" id="product-item-name" class="form-control"  placeholder="Product Name" required value="{{$product_item->product_item_name}}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="product-item-description">Description</label>
												<textarea class="summernote" name="product_item_description" id="product-item-description">{!! $product_item->product_item_description !!}</textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-check form-check-flat form-check-primary mt-4">
												<label for="new-arrival" class="form-check-label"><input type="checkbox"   name="new_arrival" id="new-arrival" class="form-group form-check-input" value="1" {{$product_item->new_arrival  ? 'checked' : ''}}>New Arrival</label>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-check form-check-flat form-check-primary mt-4">
												<label for="popular" class="form-check-label"><input type="checkbox"   name="popular" id="popular" class="form-check-input" value="1" {{$product_item->popular  ? 'checked' : ''}}>Popular</label>
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
									SubCategory
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<select name="product_sub_category" id="sub-category" class="form-control" required>
												<option value="">Select SubCategory</option>
												@foreach($sub_categories as $sub_category)
													<option value="{{$sub_category->product_sub_category_id}}" {{$product_item->product_sub_category_id == $sub_category->product_sub_category_id ? 'selected' : ''}}>{{$sub_category->product_sub_category_name}}</option>
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
												<input type="file"  name="image" id="product-home-image" class="form-control">
											</div>
											@if($product_item->image)
												<img src="{{asset($product_item->image)}}" style="max-height: 190px;">
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
            });
        });
	</script>
@endsection
