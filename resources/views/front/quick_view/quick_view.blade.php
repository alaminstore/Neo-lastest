<!-- Quick view Modal -->
<div class="modal fade" id="productQuickViewModal" tabindex="-1" role="dialog" aria-labelledby="productQuickViewModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body main-contain-summary">
				<div class="contain-left has-gallery">
					<div class="single-left">
						<div class="">
							<figure id="quickview-image"></figure>
						</div>
					</div>
					<div class="summary entry-summary">
						<div class="flash">
							<span class="onnew"><span class="text">New</span></span>
                        </div>
						<h1 class="product_title entry-title" id="product-title-quick"></h1>
						<p class="price">
                            <span class="kreen-Price-amount amount" id="product-quick-price"></span>
                        </p>
						<p class="stock in-stock">
							Availability: <span id="product-quick-stock"> </span>
						</p>

                        <div class="kreen-product-details__short-description" id="product-quick-view-description"></div>
                        <form class="variations_form cart" id="product-quick-view-add-to-cart-form">
                            <div class="select-weight-wrapper ">
                                <label for="">Weight:</label>
                                <span id="product-quick-view-quantity">
                                </span>
                            </div>

							<div class="single_variation_wrap">
								<div class="kreen-variation single_variation mt-3"></div>
								<div class="kreen-variation-add-to-cart variations_button kreen-variation-add-to-cart-disabled">
									<div class="quantity">
										<span class="qty-label">Quantity:</span>
										<div class="control">
											<a class="btn-number qtyminus quantity-minus" href="#">-</a>
											<input type="text" data-step="1" min="0" max="" name="quantity" value="0" title="Qty"
                                                   class="input-qty input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
											<a class="btn-number qtyplus quantity-plus" href="#">+</a>
										</div>
									</div>
									<button type="submit"   style="cursor: pointer;"  class="single_add_to_cart_button button alt disabled kreen-variation-selection-needed" id="nb-quick-view-product-add-to-cart-button">
										Add to cart
									</button>
								</div>
							</div>

						</form>
						<div class="clear"></div>
						<div class="product_meta">
							<span class="sku_wrapper" id="product-quick-view-sku"></span>
                            <span class="posted_in" id="product-quick-view-category"> </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
