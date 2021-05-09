@extends('backend.home')
@section('title','Product Create')
@section('content')
    <div class="row">
        <div class="col-md-12 align-right mb-1">
            <a href="{{route('admin.products.index')}}" class="btn btn-sm btn-outline-dark">Back</a>
        </div>
    </div>
      <div class="row">
          <div class="col-md-12">
              <div>
                  <form id="product-add-form" method="post" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-md-8">
                              <div class="card">
                                  <div class="card-header">
                                      Product Create
                                  </div>
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="product-name">Name</label>
                                                  <input type="text"  name="name" id="product-name" class="form-control"  placeholder="Product Name" required value="{{old('name')}}">
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="product-description">Description</label>
                                                  <textarea class="summernote" name="description" id="product-description">{{old('description')}}</textarea>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="product-short-description">Short Description</label>
                                                  <textarea class="summernote" name="short_description" id="product-short-description">{{old('short_description')}}</textarea>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="regular-price">Regular Price</label>
                                                  <input type="number"  name="regular_price" id="regular-price" class="form-control"  placeholder="Regular Price"  step="0.01" value="{{old('regular_price')}}" required>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="sales-price">Sales Price</label>
                                                  <input type="number"  name="sales_price" id="sales-price" class="form-control"  placeholder="Sales Price" value="{{old('sales_price')}}" step="0.01">
                                              </div>
                                          </div>

                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="quantity">Quantity</label>
                                                  <input type="number"  name="quantity" id="quantity" class="form-control"  placeholder="Quantity" value="{{old('quantity')}}">
                                              </div>
                                          </div>

                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="status">Status</label>
                                                  <select id="status" name="status" class="form-control" required>
                                                      <option value="">Select Status</option>
                                                      <option value="1">Active</option>
                                                      <option value="0">Deactive</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="sku">SKU</label>
                                                  <input type="text"  name="sku" id="sku" class="form-control"  placeholder="SKU" value="{{old('sku')}}">
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="form-group">
                                                  <label for="color">Color</label>
                                                  <select id="color" name="color" class="form-control" required>
                                                      <option value="">Select Color</option>
                                                      @if($colors)
                                                          @if($colors->attributeValues)
                                                              @foreach($colors->attributeValues as $color)
                                                                  <option value="{{$color->id}}">{{$color->name}}</option>
                                                              @endforeach
                                                          @endif
                                                      @endif
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-4">
                                            <label>Attributes</label>
                                          </div>
                                          <div class="col-md-8 align-right">
                                              <a href="" class="btn btn-sm btn-outline-primary add-new-attribute" ><i class="ti-plus" ></i></a>
                                          </div>
                                      </div>
                                      <div class="multiple-attribute">

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
                                              <select name="category" id="category" class="form-control" required>
                                                  <option value="">Select Category</option>
                                                  @foreach($categories as $category)
                                                      <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="card mt-3">
                                  <div class="card-header">
                                      Subcategory
                                  </div>
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <select name="subcategory" id="sub-category" class="form-control" required>
                                                  <option value="">Select Subcategory</option>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="card mt-3">
                                  <div class="card-header">
                                      Brand
                                  </div>
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <select name="brand" id="brand" class="form-control">
                                                  <option value="">Select Brand</option>
                                                  @foreach($brands as $brand)
                                                      <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="card mt-3">
                                  <div class="card-header">
                                      Product Image
                                  </div>
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <input type="file"  name="image" id="product-home-image" class="form-control">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="card mt-3">
                                  <div class="card-header">
                                      Gallery Images
                                  </div>
                                  <div class="card-body">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <input type="file"  name="gallery_image[]" id="gallery-image" class="form-control" multiple>
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
      $(document).ready(function () {
          let count = 0;
          let product_attribute_list_one = '';
          let product_attribute_list_two = '';

          $('.summernote').summernote({
              height: 120,
              width: "100%",
          });


          $('#product-add-form').on('click', '.add-new-attribute', function(event) {
              event.preventDefault();
              count += 1;
              if(count > 5)
              {
                  return false;
              }
              let attribute_one = $('.multiple-product-attribute-row').find('#attribute-value-one').val();
              let attribute_two = $('.multiple-product-attribute-row').find('#attribute-value-two').val();


              $('.multiple-attribute').append(`<div class="row multiple-product-attribute-row">
                                          <div class="col-md-5">
                                              <div class="form-group">
                                                  <label for="attribute-`+count+`">Attribute</label>
                                                  <select id="attribute-`+count+`" name="attribute_id[]" class="form-control attribute-option" required>
                                                      <option value="">Select Attribute</option>
                                                      @foreach($attributes as $attribute)
                                                        @if($attribute->slug == 'size')
                                                        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                        @endif
                                                      @endforeach
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="col-md-5">
                                              <div class="form-group">
                                                  <label for="attribute-value-`+count+`">Attribute Value</label>
                                                  <select id="attribute-value-`+count+`" name="attribute_value_id[]" class="form-control attribute-value-option" required>
                                                       <option value="">Select Attribute</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <div class="form-group">
                                                  <label for="attribute-value">&nbsp;</label><br>
                                                  <a href="" class="btn btn-sm btn-outline-danger remove-added-attribute" ><i class="ti-trash "></i></a>
                                              </div>
                                          </div>
                                      </div>`);
          });

          $('.multiple-attribute').on('click', '.remove-added-attribute', function(event) {
              event.preventDefault();
              $(this).parent().parent().parent().remove();
          });
          $('.multiple-attribute').on('change', '.attribute-option', function () {
              let attribute_id  = $(this).val();
              let select_id     = $(this).parent().parent().parent().find('.attribute-value-option').attr('id');
              let options       = '';
              $.ajax({
                  url:"{{url('admin/attribute/values')}}/"+attribute_id,
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      $.each(data, function (i,attribute_value) {
                          options += `<option value="`+attribute_value.id+`">`+attribute_value.name+`</option>`;
                      })
                      $('#'+select_id).html(`<option value="">Select Attribute</option>`+ options +``);

                  },
              });
          });

          $('#category').on('change', function () {
              let category_id  = $(this).val();
              let options = '';
              $.ajax({
                  url:"{{url('admin/subcategories/list')}}/"+category_id,
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      $.each(data, function (i,attribute_value) {
                          options += `<option value="`+attribute_value.id+`">`+attribute_value.name+`</option>`;
                      })
                      $('#sub-category').html(`<option value="">Select Attribute</option>`+ options +``);

                  },
              });
          });
      });

  </script>
@endsection