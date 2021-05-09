(function($) {
    'use strict';
    const url = window.location.origin;

    $('.shop-page').on('click', '.add-to-favorite-shop', function (event) {
        event.preventDefault();
        let formEditData = {product_info_id: parseInt($(this).attr('data-product-id'))};
        favoriteAdd(formEditData);
    });

    //open cart quantity
    $(".shop-page").on('click','.qt-btn-ad-to-cart.cart-multiple',function(event) {
        event.preventDefault();
        $(this).parents('div.qt-ad-to-cart').children('.quantity-wrapper.multiple-quantity').css("top","0");
        productQuantity($(this).attr('data-product-id'), $(this).parents('.qt-ad-to-cart').find('input.input-qty'));
    });

    $(".shop-page").on('click', ".btn-number.qtyminus.quantity-minus.nb-shops-quantity-minus", function(e) {
        e.preventDefault();
        let formEditData    = $(this).closest('form.product-single-add-to-cart').serialize();
        let quantity        = parseInt($(this).parents('.control').children("input.input-qty").val()) -1;
        const  newForm      = formEditData.replace(/quantity=\d+/g,'quantity='+quantity);
        if(quantity <= 0)
        {
            $(this).parents('.qt-ad-to-cart').children("div.quantity-wrapper.multiple-quantity").css('top','');

        }
        if(quantity <= -1)
        {
            return false;
        }
        cartAdd(newForm);

    });

    $(".shop-page").on('click', ".btn-number.qtyplus.quantity-plus.nb-shops-quantity-plus", function(e) {
        e.preventDefault();
        let formEditData = $(this).closest('form.product-single-add-to-cart').serialize();
        let quantity = parseInt($(this).parents('.control').children("input.input-qty").val()) + 1;
        const  newForm = formEditData.replace(/quantity=\d+/g,'quantity='+quantity);
        if(quantity <= -1)
        {
            return false;
        }
        if(quantity > 0)
        {
            cartAdd(newForm);
        }
        quantity = 0;
    });

    $(".shop-page").on('click', ".btn-number.qtyminus.quantity-minus.nb-single-product-cart-quantity-minus", function(e) {
        e.preventDefault();
        let quantity = parseInt($(this).parents('.control').children("input.input-qty").val()) -1;
        if(quantity <= 0)
        {
            $(this).parents('.single_variation_wrap').find('div.kreen-variation-add-to-cart').addClass('kreen-variation-add-to-cart-disabled');
            $(this).parents('.single_variation_wrap').find('button.single_add_to_cart_button').addClass('disabled');
        }
    });

    $(".shop-page").on('click', ".btn-number.qtyplus.quantity-plus.nb-single-product-cart-quantity-plus", function(e) {
        e.preventDefault();

        const quantity = parseInt($(this).parents('.control').children("input.input-qty").val()) + 1;
        if(quantity > 0)
        {
            $(this).parents('.single_variation_wrap').find('div.kreen-variation-add-to-cart').removeClass('kreen-variation-add-to-cart-disabled');
            $(this).parents('.single_variation_wrap').find('button.single_add_to_cart_button').removeClass('disabled');
        }
    });

    $("#productQuickViewModal").on('click', ".btn-number.qtyminus.quantity-minus", function(e) {
        e.preventDefault();
        let quantity = parseInt($(this).parents('.control').children("input.input-qty").val()) -1;
        if(quantity <= 0)
        {
            $(this).parents('.single_variation_wrap').find('div.kreen-variation-add-to-cart').addClass('kreen-variation-add-to-cart-disabled');
            $(this).parents('.single_variation_wrap').find('button.single_add_to_cart_button').addClass('disabled');
        }
    });

    $("#productQuickViewModal").on('click', ".btn-number.qtyplus.quantity-plus", function(e) {
        e.preventDefault();

        const quantity = parseInt($(this).parents('.control').children("input.input-qty").val()) + 1;
        if(quantity > 0)
        {
            $(this).parents('.single_variation_wrap').find('div.kreen-variation-add-to-cart').removeClass('kreen-variation-add-to-cart-disabled');
            $(this).parents('.single_variation_wrap').find('button.single_add_to_cart_button').removeClass('disabled');
        }
    });

    $("#table-body-cart").on('click', ".btn-number.qtyminus.quantity-minus", function(e) {
        e.preventDefault();
        const rowId = $(this).attr('data-rowid');
        let quantity = parseInt($(this).parents('.control').children("input.input-qty").val()) -1;
        cartUpdate(rowId, quantity)
    });

    $("#table-body-cart").on('click', ".btn-number.qtyplus.quantity-plus", function(e) {
        // e.preventDefault();
        const rowId = $(this).attr('data-rowid');
        const quantity = parseInt($(this).parents('.control').children("input.input-qty").val()) + 1;

        cartUpdate(rowId, quantity)
    });

    $("#product-single-add-to-cart-form").on('click', "#nb-single-product-add-to-cart-button", function(e) {
        e.preventDefault();
        let formEditData = $('#product-single-add-to-cart-form').serialize();
        cartAdd(formEditData);
    });

    $("#productQuickViewModal").on('click', "#nb-quick-view-product-add-to-cart-button", function(e) {
        e.preventDefault();
        let formEditData = $('#product-quick-view-add-to-cart-form').serialize();
        cartAdd(formEditData);
    });


    // $(".shop-page").on('click', ".qt-btn-ad-to-cart.cart-single", function() {
        // $(this).parents('div.qt-ad-to-cart').children(".quantity-wrapper.single-quantity").css("top","0");
    // });

    $('.product-details-area').on('submit', '.add-to-cart', function (event) {
        event.preventDefault();
        let formEditData = $('.add-to-cart').serialize();
        cartAdd(formEditData);
    });

    $('.product__area').on('click', '.product-add-to-cart', function (event) {
        event.preventDefault();
        let formData = {product_id: parseInt($(this).attr('data-product-id')),product_attribute: '', quantity: 1};
        cartAdd(formData);
    });

    $('.product-area-quick').on('click', '.product-wishlist-added', function (event) {
        event.preventDefault();
        let formData = {product_id: parseInt($(this).attr('data-product-id')), product_attribute: parseInt($(this).attr('data-product-attribute-id')), quantity: 1};
        favoriteAdd(formData);
    });

    $('.meta-dreaming.p-fixed').on('click', '.remove_from_cart_button',function (event) {
        event.preventDefault();
        let row_id = $(this).attr('data-delete-row-id');
        cartRemove(row_id);
    });

    $('#table-body-cart').on('click', '.remove.remove_from_cart_button',function (event) {
        event.preventDefault();
        let row_id = $(this).attr('data-delete-row-id');
        cartRemove(row_id);
    });

    function cartAdd(formEditData) {
        let cart_new_product = '';

        const url = window.location.origin;

        $.ajax({
            type: 'post',
            url: url+"/add-to-cart",
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
                        cart_new_product += `<li class="kreen-mini-cart-item mini_cart_item nb-remove-mini-cart-${cart.rowId}">
                            <a href="#" class="remove remove_from_cart_button" data-delete-row-id="${cart.rowId}">×</a>
                            <a href="#">
                                <img src="${url}/${cart.options.image}"
                                     class="attachment-kreen_thumbnail size-kreen_thumbnail"
                                     alt="img" width="600" height="778">${cart.name} ${cart.weight ?  cart.weight+''+cart.options.weight_unit  : ''}
                            </a>
                            <span class="quantity">${cart.qty} × <span
                                    class="kreen-Price-amount amount"><span
                                        class="kreen-Price-currencySymbol">${currency_symbol}</span>${cart.price}</span></span>
                        </li>`;
                    });

                    $('#sidebar-product-cart-mini-widget').html(cart_new_product);
                    $('#ct-cart-subtotal').html(data.sub_total);
                    toastr.success(data.notification.message);
                }
            },
            error: function (error) {
                if (error.status == 422) {
                    $.each(error.responseJSON.errors, function (i, message) {
                        toastr.error(message);
                    });
                }
                if(error.status == 404){
                    toastr.error('Product not found!');
                }
            }
        });
    }

    function favoriteAdd(formEditData) {

        const url = window.location.origin;
        $.ajax({
            type: 'post',
            url: url+"/favorites/add",
            data: formEditData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                
                if(data.notification['alert-type'] == 'error')
                {
                    toastr.error(data.notification.message);
                }
                if(data.notification['alert-type'] == 'success')
                {
                    toastr.success(data.notification.message);
                }
            },
            error: function (error) {
                if (error.status == 422) {
                    $.each(error.responseJSON.errors, function (i, message) {
                        toastr.error(message);
                    });
                }
                if(error.status == 404){
                    toastr.error('Some went wrong!');
                }
            }
        });
    }

    function cartCount() {
        $.ajax({
            url: url+"/cart/count",
            method:"post",
            data:{},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success:function(data) {
                $('#cart-count-short-top').html(data);
                $('#cart-count-short-float').html(data);
                $('#mobile-view-count-cart').html(data);

            }
        });
    }

    $('.shop-page').on('change','.variable-product-option-change', function (){
        const product_info  = $(this).val();
        const targetClass = $(this).parents('.qt-drop-wrapper.qt-multiple');
        const productPrice = targetClass.children('div.qt-price-wrapper').children('span.price.qt-price');
        const productStock = targetClass.children('div.add-to-cart-top').children('div.qt-multiple-out-of-stock');
        const mainParrents = $(this).parents('.product-thumb');
        mainParrents.find('a.add_to_wishlist.add-to-favorite-shop').attr('data-product-id',product_info);
        mainParrents.find('button.qt-btn-ad-to-cart.cart-multiple').attr('data-product-id',product_info);
        mainParrents.find("div.quantity-wrapper.multiple-quantity").css('top','');
        let product_price    = '';
        let product_quantity = '';
        if(product_info)
        {
            $.ajax({
                url: url+"/shop-product-info/"+product_info,
                method:"get",
                data:{},
                dataType: 'json',
                success:function(data) {
                    if(!data.product_info.product_quantity)
                    {
                        productStock.html(`<span class="sold-out"><span> Out of stock</span></span>`);
                    }
                    else
                    {
                        productStock.html(``);
                    }

                    if(data.product_info.sales_price)
                    {
                        productPrice.html(`<del>
                                            <span class="kreen-Price-amount amount">
                                                <span class="kreen-Price-currencySymbol">${currency_symbol}</span>
                                                ${data.product_info.price}
                                            </span>
                                        </del>
                                        <ins>
                                            <span class="kreen-Price-amount amount">
                                                <span class="kreen-Price-currencySymbol">${currency_symbol}</span>
                                                ${data.product_info.sales_price}
                                            </span>
                                        </ins>`);
                    }
                    else
                    {
                        productPrice.html(`<ins>
                                            <span class="kreen-Price-amount amount">
                                                <span class="kreen-Price-currencySymbol">${currency_symbol}</span>
                                                ${data.product_info.price}
                                            </span>
                                        </ins>`);
                    }
                },
                error: function (error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function (i, message) {
                            toastr.error(message);
                        });
                    }
                    if(error.status == 404){
                        toastr.error('Some went wrong!');
                    }
                }
            });
        }

    });

    $('.shop-page').on('change','.product-quantity-change', function (){
        const product_info = $(this).val();
        let user           = $(this).attr('data-user-id');
        $('.add-to-favorite-shop').attr('data-product-id',product_info);
        if(user && product_info)
        {
            productFavoriteChack(user, product_info);
        }
        if(product_info)
        {
            productPriceCartCheck(product_info);
        }
    });

    $('#productQuickViewModal').on('change','.variable-product-option-change', function (){
        const product_info = $(this).val();
        if(product_info)
        {
            productPriceCartCheck(product_info);
        }
    });

    function productQuantity(productInfoId , addQuantityView) {
        $.ajax({
            url: url+"/cart/product/quantity/"+productInfoId,
            method:"get",
            data:{},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success:function(data) {
                addQuantityView.val(data);
            }
        });
    }

    function cartRemove(row_id) {
        $.ajax({
            url: url+"/cart/remove/"+row_id,
            method:"get",
            data:{},
            dataType: 'json',
            success:function(data) {
                if(data.exist)
                {
                    $('.nb-remove-mini-cart-'+data.rowid).remove();
                    $('#ct-cart-subtotal').html(data.sub_total);
                    $('#cart-page-subtotal').html(data.sub_total);
                    $('#cart-page-total').html(data.total);
                    cartCount();
                }

                toastr.success(data.notification.message);
            }
        });
    }

    function cartUpdate(row_id,quantity) {
        $.ajax({
            url: url+"/cart/update",
            method:"post",
            data:{rowid:row_id,quantity:quantity},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success:function(data) {
                if(data.exist)
                {
                    $('#ct-cart-subtotal').html(data.sub_total);
                    $('#cart-page-subtotal').html(data.sub_total);
                    $('#cart-page-total').html(data.total);
                    let itemPriceTotal = $('.cart-item-cart-page-tr-'+data.item.rowId).children('td.product-subtotal').children('span.kreen-Price-amount.amount');
                    itemPriceTotal.children('span.nb-cart-page-product-total-'+data.item.rowId).html(data.item.price * data.item.qty);
                    cartCount();
                }
                else
                {
                    $('.nb-remove-mini-cart-'+data.rowid).remove();
                }

                toastr.success(data.notification.message);
            }
        });
    }

    function productFavoriteChack(user, product_info)
    {
        if(user && product_info)
        {
            $.ajax({
                url: url+"/favorites/check/"+product_info+'/'+user,
                method:"get",
                data:{},
                dataType: 'json',
                success:function(data) {
                    if(data.set == false) {
                        $('.add-to-favorite-area-single').removeClass('text-active');
                        $('.add_to_wishlist.add-to-favorite-shop').html('Add to Favorites');
                    }
                    if(data.set == true) {
                        $('.add-to-favorite-area-single').addClass('text-active');
                        $('.add_to_wishlist.add-to-favorite-shop').html('Added to Favorites');
                    }
                },
                error: function (error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function (i, message) {
                            toastr.error(message);
                        });
                    }
                    if(error.status == 404){
                        toastr.error('Some went wrong!');
                    }
                }
            });
        }
    }

    function productPriceCartCheck(product_info)
    {
        if(product_info)
        {
            $.ajax({
                url: url+"/shop-product-info/"+product_info,
                method:"get",
                data:{},
                dataType: 'json',
                success:function(data) {
                    let parentDivQuickView      = $('#productQuickViewModal');
                    let parentDiv               = $('.main-contain-summary');
                    let productPrice            = parentDiv.find('p.price.single-product-price-area');
                    let productPriceQuickView   = parentDiv.find('span#product-quick-price');
                    let productPriceContentDel  = `<del>
                                                        <span class="kreen-Price-amount amount">
                                                            <span class="kreen-Price-currencySymbol">${currency_symbol}</span>
                                                            ${data.product_info.price}
                                                        </span>
                                                    </del>
                                                    <ins>
                                                        <span class="kreen-Price-amount amount">
                                                            <span class="kreen-Price-currencySymbol">${currency_symbol}</span>
                                                            ${data.product_info.sales_price}
                                                        </span>
                                                    </ins>`;
                    let productPriceContentIns  = `<ins>
                                                        <span class="kreen-Price-amount amount">
                                                            <span class="kreen-Price-currencySymbol">${currency_symbol}</span>
                                                            ${data.product_info.price}
                                                        </span>
                                                    </ins>`;

                    if(data.cart_quantity_count >= 0)
                    {
                        parentDiv.find('input.input-qty.input-text.qty.text').val(data.cart_quantity_count);
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

                    if(data.product_info.sales_price)
                    {

                        productPrice.html(productPriceContentDel);
                        productPriceQuickView.html(productPriceContentDel);

                    }
                    else
                    {
                        productPrice.html(productPriceContentIns);
                        productPriceQuickView.html(productPriceContentIns);
                    }
                },
                error: function (error) {
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function (i, message) {
                            toastr.error(message);
                        });
                    }
                    if(error.status == 404){
                        toastr.error('Some went wrong!');
                    }
                }
            });
        }
    }
})(jQuery);
