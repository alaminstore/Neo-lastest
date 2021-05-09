@extends('backend.home')
@section('title','Product Attributes')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row text-right">
                <div class="col-12">

                    <a href="{!! (URL::previous() == Request::url() ? route('products.index') :  URL::previous()) !!}" class="btn btn-sm btn-dark rounded-1 text-white">Back</a>
                </div>
            </div>
        </div>
    </div>
  <div class="row">
    <div class="col-md-12">
      <div id="">
        <div class="card">
          <div class="card-header">
            Product Attribute ({{$product->product_name}})
              @if($product->attribute_type == 2)
              <a href="" class="btn btn-sm btn-primary float-right attriubte-add" data-toggle="modal" data-target="#add-attribute-value-modal"><i class="ti-plus"></i> Add New Attribute Value</a>
                  @endif
          </div>
          <div class="card-body">
            <form id="product-attribute-add-form">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="product-type">Product Type</label>
                            <select id="product-type" name="attribute_type" class="form-control" required>
                                {{--<option value=""> Select Product Type</option>--}}
                                @if($product->attribute_type  == 1)
                                    <option value="1" {{$product->attribute_type == 1 ? 'selected' : ''}}> Single Product </option>
                                @endif

                                @if($product->attribute_type == 2)
                                    <option value="2" {{$product->attribute_type == 2 ? 'selected' : ''}}> Variable product </option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 variable-product">
                        <div class="form-group">
                            <label for="show-home-price">Show Price</label>
                            <select id="show-home-price" name="show_home_price" class="form-control" required>
                                <option value=""> Select Show Price</option>
                                <option value="0"> No </option>
                                <option value="1"> Yes </option>
                            </select>
                        </div>
                    </div>
                    @if($product->attribute_type == 2)
                    <div class="col-md-3 variable-product">
                        <div class="form-group">
                            <label for="attribute-one-value">
                                @if(!empty($attributes))
                                    @foreach($attributes as $key => $attribute)
                                        @if($key == 0){{$attribute->attribute_name}}
                                        @endif
                                    @endforeach
                                @endif
                            </label>
                            <select id="attribute-one-value" name="attribute_value_one_id" class="form-control attribute-option-add-one" required>
                                <option value=""> Select
                                    @if(!empty($attributes))
                                        @foreach($attributes as $key => $attribute)
                                            @if($key == 0){{$attribute->attribute_name}}
                                            @endif
                                        @endforeach
                                    @endif
                                </option>
                                @foreach($attribute_value_one as $attribute_value)
                                    <option value="{{$attribute_value->id}}">{{$attribute_value->attribute_value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 variable-product">
                        <div class="form-group">
                            <label for="attribute-two-value">
                                @if(!empty($attributes))
                                    @foreach($attributes as $key => $attribute)
                                        @if($key == 1){{$attribute->attribute_name}}
                                        @endif
                                    @endforeach
                                @endif
                            </label>
                            <select id="attribute-two-value" name="attribute_value_two_id" class="form-control attribute-option-add-two" required>
                                <option value=""> Select
                                    @if(!empty($attributes))
                                        @foreach($attributes as $key => $attribute)
                                            @if($key == 1){{$attribute->attribute_name}}
                                            @endif
                                        @endforeach
                                    @endif
                                </option>
                                @foreach($attribute_value_two as $attribute_value)
                                    <option value="{{$attribute_value->id}}">{{$attribute_value->attribute_value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="regular-price">Regular Price</label>
                            <input type="number"  name="regular_price" id="regular-price" class="form-control"  placeholder="Regular Price" required>
                            <input type="hidden"  name="product_id" value="{{$product->id}}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sale-price">Sales Price</label>
                            <input type="number"  name="sale_price" id="sale-price" class="form-control"  placeholder="Sale Price" >
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stock_quantity">Quantity</label>
                            <input type="number"  name="stock_quantity" id="stock_quantity" class="form-control"  placeholder="Quantity" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sku">SKU</label>
                            <input type="text"  name="sku" id="sku" class="form-control"  placeholder="SKU" >
                        </div>
                    </div>
                </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 mt-3">
      <div id="reload-product-attribute">
        <div class="card">
          <div class="card-header">
            Attributes List ({{$product->product_name}})
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table data-table-assign" id="product-attribute-list" width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>
                          @if(!empty($attributes))
                              @foreach($attributes as $key => $attribute)
                                  @if($key == 0){{$attribute->attribute_name}}
                                  @endif
                              @endforeach
                          @endif
                      </th>
                      <th>
                          @if(!empty($attributes))
                              @foreach($attributes as $key => $attribute)
                                  @if($key == 1){{$attribute->attribute_name}}
                                  @endif
                              @endforeach
                          @endif
                      </th>
                      <th>Regular Price</th>
                      <th>Sale Price</th>
                      <th>Quantity</th>
                      <th>SKU</th>
                      <th>Show Price</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody id="product-attribute-body">
                @foreach($product_attributes as $product_attribute)
                  <tr class="product-attribute-row-{{$product_attribute->id}}">
                    <td class="product-attribute-row-id-{{$product_attribute->id}}">{{$product_attribute->id}}</td>
                    <td class="attribute-one-column-name-{{$product_attribute->id}}">{{$product_attribute->attribute_one != null ? $product_attribute->attribute_one->attribute_value : ''}}</td>
                     <td class="attribute-two-column-name-{{$product_attribute->id}}">{{$product_attribute->attribute_two != null ? $product_attribute->attribute_two->attribute_value : ''}}</td>
                     <td  class="product-attribute-column-regular-price-{{$product_attribute->id}}"> {{$product_attribute->regular_price}}</td>
                     <td  class="product-attribute-column-sale-price-{{$product_attribute->id}}"> {{$product_attribute->sale_price}}</td>
                     <td  class="product-attribute-column-stock-quantity-{{$product_attribute->id}}"> {{$product_attribute->stock_quantity}}</td>
                     <td  class="product-attribute-column-sku-{{$product_attribute->id}}"> {{$product_attribute->sku}}</td>
                      <td class="show-home-column-{{$product_attribute->id}}">
                         {{$product_attribute->show_home_price == 1 ? 'Yes' : ''}}
                      </td>

                     <td class="status-column-{{$product_attribute->id}}">
                        <a href="" class="btn btn-sm {{$product_attribute->status == 1 ? 'btn-outline-success' : 'btn-outline-danger'}}  mr-1 status-change" title="{{$product_attribute->status == 1 ? 'Deactive' : 'Active'}}" data-status="{{$product_attribute->status}}" data-status-product-attribute-id="{{$product_attribute->id}}"><i class="ti-angle-{{$product_attribute->status == 1 ? 'up' : 'down'}}"></i></a>
                     </td>


                     <td >
                        <button class="btn btn-primary btn-sm product-attribute-edit" data-toggle="modal" data-id="{{$product_attribute->id}}" title="Edit"><i class="ti-pencil"></i></button>
                        <button class="btn btn-danger btn-sm product-attribute-delete" data-delete-id="{{$product_attribute->id}}" title="Delete"><i class="ti-trash"></i></button>
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
  {{-- modal --}}
  <div class="modal fade" id="attribute-value-modal" tabindex="-1" role="dialog" aria-labelledby="attribute-value-2" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="">Product Attribute Edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form id="product-attribute-edit-form">
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="product-type-edit">Product Type</label>
                                  <select id="product-type-edit"  class="form-control" disabled>
                                      <option value=""> Select Product Type</option>
                                      <option value="1"> Single Product </option>
                                      <option value="2"> Variable product </option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="show-home-price-edit">Show Price</label>
                                  <select id="show-home-price-edit" name="show_home_price" class="form-control">
                                      <option value=""> Select Show Price</option>
                                      <option value="0"> No </option>
                                      <option value="1"> Yes </option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-3 variable-product-edit" style="display: none">
                              <div class="form-group">
                                  <label for="attribute-one-value-edit">
                                      @if(!empty($attributes))
                                          @foreach($attributes as $key => $attribute)
                                              @if($key == 0){{$attribute->attribute_name}}
                                              @endif
                                          @endforeach
                                      @endif
                                  </label>
                                  <select id="attribute-one-value-edit" name="attribute_value_one_id" class="form-control attribute-option-add-one">
                                      <option value=""> Select
                                          @if(!empty($attributes))
                                              @foreach($attributes as $key => $attribute)
                                                  @if($key == 0){{$attribute->attribute_name}}
                                                  @endif
                                              @endforeach
                                          @endif
                                      </option>
                                      @foreach($attribute_value_one as $attribute_value)
                                          <option value="{{$attribute_value->id}}">{{$attribute_value->attribute_value}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <div class="col-md-3 variable-product-edit" style="display: none">
                              <div class="form-group">
                                  <label for="attribute-two-value-edit">
                                      @if(!empty($attributes))
                                          @foreach($attributes as $key => $attribute)
                                              @if($key == 1){{$attribute->attribute_name}}
                                              @endif
                                          @endforeach
                                      @endif
                                  </label>
                                  <select id="attribute-two-value-edit" name="attribute_value_two_id" class="form-control attribute-option-add-two">
                                      <option value=""> Select
                                          @if(!empty($attributes))
                                              @foreach($attributes as $key => $attribute)
                                                  @if($key == 1){{$attribute->attribute_name}}
                                                  @endif
                                              @endforeach
                                          @endif
                                      </option>
                                      @foreach($attribute_value_two as $attribute_value)
                                          <option value="{{$attribute_value->id}}">{{$attribute_value->attribute_value}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="regular-price-edit">Regular Price</label>
                                  <input type="number"  name="regular_price" id="regular-price-edit" class="form-control"  placeholder="Regular Price" required>
                                  <input type="hidden"  name="attribute_id" id="product-attribute-edit-id"  required>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="sale-price-edit">Sales Price</label>
                                  <input type="number"  name="sale_price" id="sale-price-edit" class="form-control"  placeholder="Sale Price" >
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="stock-quantity-edit">Quantity</label>
                                  <input type="number"  name="stock_quantity" id="stock-quantity-edit" class="form-control"  placeholder="Quantity" required>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="sku-edit">SKU</label>
                                  <input type="text"  name="sku" id="sku-edit" class="form-control"  placeholder="SKU" >
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <div class="modal fade" id="add-attribute-value-modal" tabindex="-1" role="dialog" aria-labelledby="attribute-value-2" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="">Attribute Value Add</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form id="attribute-value-add-form">
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="attribute-add">Attribute</label>
                          <select id="attribute-add" name="attribute_id" class="form-control">
                          <option value="">Select Attribute</option>
                          @foreach($attributes as $attribute)
                                <option value="{{$attribute->id}}">{{$attribute->attribute_name}}</option>
                          @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="attribute-value-add-name">Name</label>
                          <input type="text"  name="attribute_value" id="attribute-value-add-name" class="form-control"  placeholder="Attribute Value Name" >
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Submit</button>
                      <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
    {{-- modal --}}
@endsection

@section('scripts')
  <script type="text/javascript">
      $(document).ready(function () {
          // validation add product attribute
          $("#product-attribute-add-form").validate({
              ignore: [],
              debug: true,
              rules: {
                  attribute_type: {
                      required: true,
                  },
                  product_id: {
                      required: true,
                  }
              }
          });

          $("#product-attribute-edit-form").validate({
              ignore: [],
              debug: true,
              rules: {
                  attribute_type: {
                      required: true,
                  },
                  product_id: {
                      required: true,
                  }
              }
          });

          $('#product-type').on('change',function () {
            let product_type  = $(this).val();
            if(product_type == 2)
            {
                $('.variable-product').css('display', 'inline-block');
                $('.attriubte-add').css('display', 'inline-block');
                $('#show-home-price').attr('required', 'required');
                $('#attribute-one-value').attr('required', 'required');
                $('#attribute-two-value').attr('required', 'required');
            }
            if(product_type == 1  || product_type == '')
            {
                $('.variable-product').css('display', 'none');
                $('.attriubte-add').css('display', 'none');
                $('#show-home-price').removeAttr('required', 'required');
                $('#attribute-one-value').removeAttr('required', 'required');
                $('#attribute-two-value').removeAttr('required', 'required');
            }
          });

          // $('#attribute-value-modal').on('change', '#product-type-edit',function () {
          //   let product_type  = $(this).val();
          //   if(product_type == 2)
          //   {
          //       $('.variable-product-edit').css('display', 'inline-block');
          //       $('.attriubte-add-edit').css('display', 'inline-block');
          //       $('#show-home-price-edit').attr('required', 'required');
          //       $('#attribute-one-value-edit').attr('required', 'required');
          //       $('#attribute-two-value-edit').attr('required', 'required');
          //   }
          //   if(product_type == 1  || product_type == '')
          //   {
          //       $('.variable-product-edit').css('display', 'none');
          //       $('.attriubte-add-edit').css('display', 'none');
          //       $('#show-home-price-edit').removeAttr('required', 'required');
          //       $('#attribute-one-value-edit').removeAttr('required', 'required');
          //       $('#attribute-two-value-edit').removeAttr('required', 'required');
          //   }
          // });

          $('#product-attribute-add-form').on('submit', function (event) {
              event.preventDefault();

              let formData = $(this).serialize();

              if($('#product-attribute-add-form').valid())
              {
                  $.ajax({
                      method: 'POST',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:'{{ route('product.attribute.store') }}',
                      data :formData,
                      dataType: 'json',
                      success: function(data)
                      {
                          if(data.product_attribute)
                          {
                              $('#product-attribute-body').prepend(`<tr class="product-attribute-row-${data.product_attribute.id}">
                                 <td class="product-attribute-row-id-${data.product_attribute.id}">${data.product_attribute.id}</td>
                                 <td class="attribute-one-column-name-${data.product_attribute.id}">${data.product_attribute.attribute_one != null ? data.product_attribute.attribute_one.attribute_value : ''}</td>
                                 <td class="attribute-two-column-name-${data.product_attribute.id}">${data.product_attribute.attribute_two != null ? data.product_attribute.attribute_two.attribute_value : ''}</td>
                                 <td  class="product-attribute-column-regular-price-${data.product_attribute.id}"> ${data.product_attribute.regular_price != null ? data.product_attribute.regular_price : ''}</td>
                                 <td  class="product-attribute-column-sale-price-${data.product_attribute.id}"> ${data.product_attribute.sale_price != null ? data.product_attribute.sale_price : ''}</td>
                                 <td  class="product-attribute-column-stock-quantity-${data.product_attribute.id}"> ${data.product_attribute.stock_quantity != null ? data.product_attribute.stock_quantity : ''}</td>
                                 <td  class="product-attribute-column-sku-${data.product_attribute.id}"> ${data.product_attribute.sku != null ? data.product_attribute.sku : ''}</td>
                                 <td class="show-home-column-${data.product_attribute.id}">
                                  ${data.product_attribute.show_home_price == 1 ? 'Yes' : ''}
                                 </td>
                                 <td class="status-column-${data.product_attribute.id}">
                                    <a href="" class="btn btn-sm ${data.product_attribute.status == 1 ? 'btn-outline-success' : 'btn-outline-danger'}  mr-1 status-change" title="${data.product_attribute.status == 1 ? 'Deactive' : 'Active'}" data-status="${data.product_attribute.status}" data-status-product-attribute-id="${data.product_attribute.id}"><i class="ti-angle-${data.product_attribute.status == 1 ? 'up' : 'down'}"></i></a>
                                 </td>
                                 <td >
                                    <button class="btn btn-primary btn-sm product-attribute-edit" data-toggle="modal" data-id="${data.product_attribute.id}"><i class="ti-pencil"></i></button>
                                    <button class="btn btn-danger btn-sm product-attribute-delete" data-delete-id="${data.product_attribute.id}"><i class="ti-trash"></i></button>
                                 </td>
                              </tr>`);

                          }
                          showHomePrice(data.product_attribute.product_id);


                          if(data.notification['alert-type'] == 'error')
                          {
                              toastr.error(data.notification.message);
                          }
                          if(data.notification['alert-type'] == 'success')
                          {
                              $('#product-attribute-add-form')[0].reset();
                              toastr.success(data.notification.message);
                              let product_type  = $('#product-type').val();
                              if(product_type == 2)
                              {
                                  $('.variable-product').css('display', 'inline-block');
                                  $('.attriubte-add').css('display', 'inline-block');
                                  $('#show-home-price').attr('required', 'required');
                                  $('#attribute-one-value').attr('required', 'required');
                                  $('#attribute-two-value').attr('required', 'required');
                              }
                              if(product_type == 1  || product_type == '')
                              {
                                  $('.variable-product').css('display', 'none');
                                  $('.attriubte-add').css('display', 'none');
                                  $('#show-home-price').removeAttr('required', 'required');
                                  $('#attribute-one-value').removeAttr('required', 'required');
                                  $('#attribute-two-value').removeAttr('required', 'required');
                              }
                          }

                      },
                      error: function(error){
                          if (error.status == 422) {
                              $.each(error.responseJSON.errors, function (i, message) {
                                  toastr.error(message);
                              });
                          }
                      },
                  });
              }

          });

          $('#product-attribute-body').on('click', '.product-attribute-edit' , function () {
              let product_attribute_id =  $(this).attr('data-id');

              $.ajax({
                  url:"{{url('product/attribute/edit')}}/"+product_attribute_id,
                  method:"get",
                  data:{},
                  dataType: 'json',
                  success:function(data){
                      let product_type  = data.attribute_type;
                      $('#product-attribute-edit-form').find('#product-type-edit').val(product_type).focus();
                      $('#product-attribute-edit-form').find('#show-home-price-edit').val(data.show_home_price);
                      $('#product-attribute-edit-form').find('#attribute-one-value-edit').val(data.attribute_value_one_id);
                      $('#product-attribute-edit-form').find('#attribute-two-value-edit').val(data.attribute_value_two_id);
                      $('#product-attribute-edit-form').find('#regular-price-edit').val(data.regular_price);
                      $('#product-attribute-edit-form').find('#sale-price-edit').val(data.sale_price);
                      $('#product-attribute-edit-form').find('#stock-quantity-edit').val(data.stock_quantity);
                      $('#product-attribute-edit-form').find('#sku-edit').val(data.sku);
                      $('#product-attribute-edit-form').find('#product-attribute-edit-id').val(data.id);
                      $('#product-attribute-edit-form').find('#show-home-price-edit').val(data.show_home_price);

                      if(product_type == 2)
                      {
                          $('.variable-product-edit').css('display', 'inline-block');
                          $('.attriubte-add-edit').css('display', 'inline-block');
                          $('#show-home-price-edit').attr('required', 'required');
                          $('#attribute-one-value-edit').attr('required', 'required');
                          $('#attribute-two-value-edit').attr('required', 'required');
                      }
                      if(product_type == 1  || product_type == '')
                      {
                          $('.variable-product-edit').css('display', 'none');
                          $('.attriubte-add-edit').css('display', 'none');
                          $('#show-home-price-edit').removeAttr('required', 'required');
                          $('#attribute-one-value-edit').removeAttr('required', 'required');
                          $('#attribute-two-value-edit').removeAttr('required', 'required');
                      }

                      $('#attribute-value-modal').modal('show');
                  },
                  error:function (error) {
                      toastr.error('Record not match!');
                  }
              });
          });

          $('#attribute-value-modal').on('submit', '#product-attribute-edit-form', function (e) {
              e.preventDefault();

              let formEditData          = $(this).serialize();
              let product_attribute_id  = $('#product-attribute-edit-id').val();
              if($('#product-attribute-edit-form').valid()) {
                  $.ajax({
                      type: 'post',
                      url: "{{ url('product/attribute/update') }}/"+product_attribute_id,
                      data: formEditData,
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      dataType: 'json',
                      success: function (data) {
                          $('.product-attribute-row-id-'+data.product_attribute.id).html(data.product_attribute.id);
                          $('.attribute-one-column-name-'+data.product_attribute.id).html(data.product_attribute.attribute_one != null ? data.product_attribute.attribute_one.attribute_value : '');
                          $('.attribute-two-column-name-'+data.product_attribute.id).html(data.product_attribute.attribute_two != null ? data.product_attribute.attribute_two.attribute_value : '');
                          $('.product-attribute-column-regular-price-'+data.product_attribute.id).html(data.product_attribute.regular_price != null ? data.product_attribute.regular_price : '');
                          $('.product-attribute-column-sale-price-'+data.product_attribute.id).html(data.product_attribute.sale_price != null ? data.product_attribute.sale_price : '');
                          $('.product-attribute-column-stock-quantity-'+data.product_attribute.id).html(data.product_attribute.stock_quantity != null ? data.product_attribute.stock_quantity : '');
                          $('.product-attribute-column-sku-'+data.product_attribute.id).html(data.product_attribute.sku != null ? data.product_attribute.sku : '');

                          // $('.show-home-column-'+data.product_attribute.id).html(`${data.product_attribute.show_home_price == 1 ? 'Yes' : ''}`);
                            showHomePrice(data.product_attribute.product_id);


                          if(data.notification['alert-type'] == 'error')
                          {
                              toastr.error(data.notification.message);
                          }
                          if(data.notification['alert-type'] == 'success')
                          {
                              toastr.success(data.notification.message);
                          }
                          $('#attribute-value-modal').modal('hide');
                      },
                      error: function (error) {
                          if (error.status == 422) {
                              $.each(error.responseJSON.errors, function (i, message) {
                                  toastr.error(message);
                              });
                          }
                      },

                  });
              }
          });

          $('#product-attribute-body').on('click', '.product-attribute-delete', function (event) {
              event.preventDefault();
              let attribute_id = $(this).attr('data-delete-id');
              Swal.fire({
                  title: 'Are you sure to delete this?',
                  text: "",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Do it!',

              }).then((result) => {
                  if (result.value)
                  {
                      $.ajax({
                          method: "get",
                          url: "{{ url('product/attribute/delete') }}/"+attribute_id,
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          data: {},
                          dataType: 'json',
                          success: function (data) {

                              if (data.product_delete == true) {
                                  $('.product-attribute-row-'+attribute_id).remove();
                              }

                              if (data.notification['alert-type'] == 'error')
                              {
                                  toastr.error(data.notification.message);
                              }

                              if (data.notification['alert-type'] == 'success')
                              {
                                  toastr.success(data.notification.message);
                              }

                          },

                      });
                  }
              });
          });

          $('#attribute-value-add-form').on('submit', function (event) {
              event.preventDefault();

              let formData = $(this).serialize();

              if($('#attribute-value-add-form').valid())
              {
                  $.ajax({
                      method: 'POST',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:'{{ route('values.store') }}',
                      data :formData,
                      dataType: 'json',
                      success: function(data)
                      {
                          $('#attribute-value-add-form')[0].reset();
                          if(data.attribute_value_last.attribute_id == 1)
                          {
                              $('.attribute-option-add-one').each(function () {
                                  $(this).prepend(`<option value="${data.attribute_value_last.id}">${data.attribute_value_last.attribute_value}</option>`);
                              })
                          }

                          if(data.attribute_value_last.attribute_id == 2)
                          {
                              $('.attribute-option-add-two').each(function () {
                                  $(this).prepend(`<option value="${data.attribute_value_last.id}">${data.attribute_value_last.attribute_value}</option>`);
                              })
                          }
                          $('#add-attribute-value-modal').modal('hide');
                          toastr.success(data.notification.message);

                      },
                      error: function(error){
                          if (error.status == 422) {
                              $.each(error.responseJSON.errors, function (i, message) {
                                  toastr.error(message);
                              });
                          }
                      },
                  });
              }
          });

          $('#product-attribute-body').on('click', '.status-change',function (event) {
              event.preventDefault();
              let status_list = '';
              let status = $(this).attr('data-status');
              let product_attribute_id = $(this).attr('data-status-product-attribute-id');

              Swal.fire({
                  title: 'Are you sure to Change Status?',
                  text: "",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Do it!',

              }).then((result) => {
                  if (result.value)
                  {
                      $.ajax({
                          method: 'get',
                          url:'{{ url('product/attribute/status/change') }}/'+product_attribute_id+'/'+status,
                          data :{},
                          contentType: false,
                          processData: false,
                          cache: false,
                          dataType: 'json',
                          success: function(data) {

                              if(data.status_change == true)
                              {
                                  if(data.status == 1)
                                  {
                                      $('.status-column-'+product_attribute_id).html(`<a href="" class="btn btn-sm btn-outline-success mr-1 status-change" title="Deactive" data-status="${data.status}" data-status-product-attribute-id="${product_attribute_id}"><i class="ti-angle-up"></i></a>`);
                                  }
                                  else
                                  {
                                      $('.status-column-'+product_attribute_id).html(`<a href="" class="btn btn-sm btn-outline-danger mr-1 status-change" title="Active" data-status="${data.status}" data-status-product-attribute-id="${product_attribute_id}"><i class="ti-angle-down"></i></a>`);
                                  }
                              }
                              if(data.notification['alert-type'] == 'error')
                              {
                                  toastr.error(data.notification.message);
                              }
                              if(data.notification['alert-type'] == 'success')
                              {
                                  toastr.success(data.notification.message);
                              }
                          }
                      });
                  }
              });
          });
      });

      function showHomePrice(product_id) {
          $.ajax({
              method: 'get',
              url:'{{ url('product/attribute/show/price') }}/'+product_id,
              data :{},
              contentType: false,
              processData: false,
              cache: false,
              dataType: 'json',
              success: function(data) {
                $.each(data, function (i, value) {
                    $('.show-home-column-'+value.id).html(`${value.show_home_price == 1 ? 'Yes' : ''}`);
                })
              }
          });
      }
  </script>
@endsection