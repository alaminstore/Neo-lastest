@extends('backend.home')
@section('title','Product Item Edit')
@section('content')
	<div class="row">
		<div class="col-md-12 align-right mb-1">
			<a href="{{route('admin.productinfos.index')}}" class="btn btn-sm btn-outline-dark">Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div>
				<form id="product-add-form" method="post" action="{{route('admin.productinfos.update',$product_info->product_info_id)}}" enctype="multipart/form-data">
					@csrf
					{{ method_field('PATCH') }}
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									Product Info Edit
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="product-price">Regular Price</label>
												<input type="number"  name="price" id="product-price" class="form-control"  placeholder="Regular Price" required value="{{$product_info->price}}" step="0.01">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="product-price">Sales Price</label>
												<input type="number"  name="sales_price" id="product-price" class="form-control"  placeholder="Sales Price"  value="{{$product_info->sales_price ? $product_info->sales_price : ''}}" step="0.01">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="product-price">Product Item</label>
												<select name="product_item" id="sub-category" class="form-control" required>
													<option value="">Select Product Item</option>
													@foreach($product_items as $product_item)
														<option value="{{$product_item->product_item_id}}" {{$product_item->product_item_id  == $product_info->product_item_id ? 'selected' : ''}}>{{$product_item->product_item_name}}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="product-weight">Weight</label>
												<select name="weight" id="product-weight" class="form-control" required>
													<option value="">Select Weight</option>
													@foreach($weights as $weight)
														<option value="{{$weight->product_weight_id}}" {{$weight->product_weight_id  == $product_info->product_weight_id ? 'selected' : ''}}>{{$weight->weight .' '.$weight->weight_unit}}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="product-quantity">Quantity</label>
												<input type="number"  name="product_quantity" id="product-quantity" class="form-control"  placeholder="Quantity" required  value="{{$product_info->product_quantity}}" >
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="product-sku">SKU</label>
												<input type="text"  name="sku" id="product-sku" class="form-control"  placeholder="SKU" value="{{$product_info->sku}}">
											</div>
										</div>

									</div>
									<div class="row">
										<div class="col-md-6">
											<button type="submit" class="btn btn-primary mr-2">Update</button>
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