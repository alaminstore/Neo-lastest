(function ($) {
    $('#search-product-header,#product-mobile-search').on('keyup', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let replace = search.replace(/^\s\s*/, '').replace(/\s\s*$/, '');

        if (replace.length >= 1) {
            searchProduct(replace);
        } else {
            $('.cs-prd-wrapper').css('display', 'none');
        }
    });

    function searchProduct(search) {
        const url = window.location.origin;

        $.ajax({
            url: url + "/live/search",
            method: "post",
            data: {search: search},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                let product_list = '';
                let price_list = '';
                $('.cs-prd-wrapper').css('display', 'block');
                if (data.products.length) {

                    $.each(data.products, function (i, product) {
                        if (data.product_infos[product.product_item_id].sales_price) {
                            price_list = `<del>
                                        <span class="kreen-Price-amount amount">
                                            <span  class="kreen-Price-currencySymbol">${currency_symbol}</span>${data.product_infos[product.product_item_id].price}
                                        </span>
                                   </del>
                                   <ins>
                                        <span class="kreen-Price-amount amount">
                                            <span  class="kreen-Price-currencySymbol">${currency_symbol}</span>${data.product_infos[product.product_item_id].sales_price}
                                        </span>
                                   </ins>`;
                        } else {
                            price_list = `<ins>
                                        <span class="kreen-Price-amount amount">
                                            <span  class="kreen-Price-currencySymbol">${currency_symbol}</span>${data.product_infos[product.product_item_id].price}
                                        </span>
                                   </ins>`;
                        }
                        product_list += `<li>
                                        <a href="${url}/shop-single/${product.product_item_id}/${product.slug}" class="d-block">
                                            <div class="cs-prd-inner">
                                                <div class="img-wrapper">
                                                    <img src="${url}/${product.image}">
                                                </div>
                                                <div class="cnt-wrapper pl-3">
                                                    <div class="product-info">
                                                        <h3 class="product-name text-left">${product.product_item_name}</h3>
                                                        <span class="price" style="float:left;">${price_list}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>`;
                    });
                } else {

                    product_list = `<li style="text-align: center;">No products found</li>`;
                }
                $('.product-list-view').html(product_list);
            },
            error: function (error) {
                $('.cs-prd-wrapper').css('display', 'none');
            }
        });
    }
})(jQuery);
