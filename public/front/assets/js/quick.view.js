(function($) {
    'use strict';
    const url =  window.location.origin;

    $('.shop-page').on('click', '.product-quick-view', function (event) {
        event.preventDefault();
        let product_id = $(this).attr('data-product-id');
        quickView(product_id)
    });

    $('.shop__area').on('click', '.product-quick-view', function (event) {
        event.preventDefault();
        let product_id = $(this).attr('data-product-id');
        quickView(product_id)
    });

    $('.related__product').on('click', '.product-quick-view', function (event) {
        event.preventDefault();
        let product_id = $(this).attr('data-product-id');
        quickView(product_id)
    });

    function quickView(product_id) {

        $.ajax({
            url: url+"/shop-quick-view/"+product_id,
            method:"get",
            data:{},
            dataType: 'json',
            success:function(data){

                let product_stock_status = '';
                let product_price = '';
                let product_sku = '';
                let product_category = '';
                let product_quantity = '';
                let parentDivQuickView      = $('#productQuickViewModal');
                if(data.product_info_min_price)
                {
                    $.each(data.product_infos, function (i, product_info){
                        if(product_info.price == data.product_info_min_price)
                        {

                            if(product_info.product_quantity)
                            {
                                product_stock_status = 'In stock';
                            }
                            else
                            {
                                product_stock_status = 'Out of stock';
                            }

                            if(product_info.sales_price)
                            {
                                product_price += `<del>
                                    <span class="kreen-Price-amount amount">
                                        <span class="kreen-Price-currencySymbol">${currency_symbol}</span>${product_info.price}
                                    </span>
                                </del>`;
                            }
                            else
                            {
                                product_price += `<ins>
                                    <span class="kreen-Price-amount amount">
                                        <span class="kreen-Price-currencySymbol">${currency_symbol}</span>${product_info.price}
                                    </span>
                                </ins>`;
                            }

                            if(product_info.sales_price)
                            {
                                product_price += `<ins>
                                    <span class="kreen-Price-amount amount">
                                        <span class="kreen-Price-currencySymbol">${currency_symbol}</span>${product_info.sales_price}
                                    </span>
                                </ins>`;
                            }

                            if(product_info.sku)
                            {
                                product_sku = `SKU: <span class="sku">${product_info.sku}</span>`;
                            }
                        }

                    });
                }

                $.each(data.product_infos, function (i, product_info){
                    if(product_info.price == data.product_info_min_price)
                    {
                        if(product_info.product_quantity)
                        {
                            product_stock_status = 'In stock';
                        }
                        else
                        {
                            product_stock_status = 'Out of stock';
                        }
                    }

                });

                if(data.product.product_category)
                {
                    product_category = `Categories: <a href="#" rel="${data.product.product_category.product_category_name}">${data.product.product_category.product_category_name}</a>`;
                }
                let main_image      = `<img src="${url}/${data.product.image}" alt="img">`;

                let title           = data.product.product_item_name ? `<a href="${url}/shop-single/${data.product.product_item_id}/${data.product.product_item_name}">${data.product.product_item_name}</a>`: '';



                let product_description = data.product.product_item_description
                    ? data.product.product_item_description.substring(0, 500)
                    : "";

                if(data.product_infos.length > 1)
                {

                    product_quantity +=`<select name="product_info" class="variable-product-option-change" required> <option value="">Choose an Option</option>`;
                    $.each(data.product_infos, function (i, product_info)
                    {
                        if(product_info.product_weight)
                        {
                            product_quantity += `<option value="${product_info.product_info_id}" ${ product_info.price == data.product_info_min_price ? 'selected' : ''  }>
                                                    ${product_info.product_weight.weight}${product_info.product_weight.weight_unit}
                                                 </option>`;
                        }
                    });
                }
                else
                {
                    $.each(data.product_infos, function (i, product_info) {
                        product_quantity = `<input type="hidden" name="product_info" value="${product_info.product_info_id}">
                                        ${product_info.product_weight.weight}${product_info.product_weight.weight_unit}`;
                    });
                }
                if(data.cart_quantity_count >= 1)
                {
                    parentDivQuickView.find('button.single_add_to_cart_button.button').removeClass('disabled');
                    parentDivQuickView.find('div.kreen-variation-add-to-cart.variations_button').removeClass('kreen-variation-add-to-cart-disabled');
                }
                else
                {
                    parentDivQuickView.find('button.single_add_to_cart_button.button').addClass('disabled');
                    parentDivQuickView.find('div.kreen-variation-add-to-cart.variations_button').addClass('kreen-variation-add-to-cart-disabled');
                }

                $('.input-qty.input-text.qty.text').val(data.cart_quantity_count);
                $('#quickview-image').html(main_image);
                $('#product-title-quick').html(title);
                $('#product-quick-price').html(product_price);
                $('#product-quick-stock').html(product_stock_status);
                $('#product-quick-view-sku').html(product_sku);
                $('#product-quick-view-category').html(product_category);
                $('#product-quick-view-description').html(product_description);
                $('#product-quick-view-quantity').html(product_quantity);
                $('#productQuickViewModal').modal('show');
            },
            error: function (error) {
                toastr.error('product not found!');
            }
        });
    }

    $('#sidebar-cart-product-view').on('click', '.sidebar-delete-cart-product',function (event) {
        event.preventDefault();
        let row_id = $(this).attr('data-delete-row-id');
        $.ajax({
            url: url+"/cart-delete/"+row_id,
            method:"get",
            data:{},
            dataType: 'json',
            success:function(data) {
                cartCount();
                if(data.rowid)
                {
                    $('.cart-single-row-'+data.rowid).remove();
                    $('.single-product-sidebar-total').empty();
                    $('.single-product-sidebar-total').append(`<div class="cart-total">
                            <p class="text-success mb-0" style="font-size: 12px !important;">${data.discount_total != 0 ? 'coupon apply : ' : ''} <span class="text-success" style="font-size:10px;">${data.discount_total != 0 ? ' -'+currency_symbol+data.discount_total : ''}</span></p>
                            <h4>Total : <span id="cart-total-sidebar s">${currency_symbol} ${data.total} </span></h4>
                        </div>`);
                }
                toastr.success(data.notification.message);
            }
        });
    });

    $('#product-quick-modal').on('click', '.wishlist-add', function (event) {
        event.preventDefault();
        wishlistAdd();
    });

    $('#product-quick-modal').on('submit', '.add-to-cart', function (event) {
        event.preventDefault();
        let cart_new_product = '';
        let formEditData = $(this).serialize();
        $.ajax({
            type: 'post',
            url: url+"/add-cart",
            data: formEditData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                if(data.cart_add == false)
                {
                    toastr.error(data.notification.message);
                }
                else
                {
                    cartCount();
                    $.each(data.carts, function (j, cart) {
                        cart_new_product += `<li class="single-product-cart cart-single-row-${cart.rowId}" >
                            <div class="cart-img">
                                <a href="#"><img src="${url}/${cart.options.image}" alt="" style="width: 80px; height: 80px;"></a>
                            </div>
                            <div class="cart-title">
                                <h3><a href="#">${cart.name} </a></h3>
                                <span>${cart.qty} x ${cart.price}</span>
                                <span style="font-size:12px;display: block;">${cart.options.attribute_one}</span>
                                <span style="font-size:12px;display: block;">${cart.options.attribute_two}</span>
                            </div>
                            <div class="cart-delete">
                                <a href="#"  class="sidebar-delete-cart-product" data-delete-row-id="${cart.rowId}"><i class="ti-trash"></i></a>
                            </div>
                        </li>`;
                    });
                    cart_new_product += `<li class="single-product-cart single-product-sidebar-total">
                        <div class="cart-total">
                          <p class="text-success mb-0" style="font-size: 12px !important;"> ${data.discount_total != 0 ? 'coupon apply :' : ''} ${data.discount_total != 0 ? '-Tk'+data.discount_total : ''}</p>
                          <h4>Total : <span id="cart-total-sidebar">${currency_symbol} ${data.total}</span></h4>
                        </div>
                    </li>`;
                    $('#sidebar-cart-product-view').html(cart_new_product);

                    $('.onepage-sidebar-area').addClass('inside');
                    $('.warpper').addClass('overlay-active');
                }

                $('#product-quick-modal').modal('hide');
            },
            error: function (error) {
                if (error.status == 422) {
                    $.each(error.responseJSON.errors, function (i, message) {
                        toastr.error(message);
                    });
                }
                if (error.status == 404) {
                    toastr.error(error.statusText);
                }
            }
        });
    });

    function wishlistAdd() {
        let formEditData = $('.add-to-cart').serialize();
        const url = window.location.origin;
        $.ajax({
            type: 'post',
            url: url+"/wishlist-add",
            data: formEditData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {

                if(data['alert-type'] == 'error')
                {
                    toastr.error(data.message);
                }
                if(data['alert-type'] == 'success')
                {
                    toastr.success(data.message);
                }
            },
            error: function (error) {
                if (error.status == 422) {
                    $.each(error.responseJSON.errors, function (i, message) {

                        toastr.error(message);
                    });
                }
                if (error.status == 404) {
                    toastr.error(error.statusText);
                }
            }
        });
    }

    function cartCount() {
        $.ajax({
            url: url+"/cart-count",
            method:"get",
            data:{},
            dataType: 'json',
            success:function(data) {
                $('#header-cart-count').empty();
                $('#header-cart-count').append(data);
            }
        });
    }
})(jQuery);
