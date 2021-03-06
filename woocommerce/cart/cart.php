<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="cart-page-area">
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<div class="container">
			<div class="row cart_prod">
				<?php do_action( 'woocommerce_before_cart_table' ); ?>
				
					<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<div class="s_product woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							    <div class="row">
							        <div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-2 col-sm-2 col-xs-3">
				                            <div class="images thumbnail">
													<?php
														$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

														if ( ! $product_permalink ) {
															echo $thumbnail; // PHPCS: XSS ok.
														} else {
															printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
														}
													?>
				                            </div>
				                        </div>
				                        <div class="col-md-10 col-sm-10 col-xs-9">
			                        		<div class="content">
												<?php
													echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
														'woocommerce_cart_item_remove_link',
															sprintf(
																'<a href="%s" class="remove close_btn" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
																esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
																esc_html__( 'Remove this item', 'woocommerce' ),
																esc_attr( $product_id ),
																esc_attr( $_product->get_sku() )
															),
														$cart_item_key
													);
												?>
												<div class="product_title" data-title="<?php esc_attr_e( 'Product Title', 'woocommerce' ); ?>">
				                                    <h3>
				                                    	<?php
															if ( ! $product_permalink ) {
																echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
															} else {
																echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
															}

															do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

															// Meta data.
															echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

															// Backorder notification.
															if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
																echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
															}
														?>
				                                    </h3>
				                                    <span class="order_id">SKU #<?php echo $_product->get_sku(); ?></span>
				                                </div>
				                                <div class="product_details">
			                                		<div class="row">
			                                			<?php
			                                				$item_data = $cart_item['data'];
															$attributes = $item_data->get_attributes();
															foreach ( $attributes as $attribute => $attribute_name ) {
																$term = get_term_by('slug', $attribute_name, $attribute);
			                                			?>
				                                			<div class="col-md-3 col-sm-3 col-xs-6">
					                                            <div class="product_pro">
					                                                <h4><?php echo wc_attribute_label( $attribute ); ?></h4>
					                                                <span><?php echo $term->name; ?></span>
					                                            </div>
					                                        </div>
				                                    	<?php } ?>
				                                        <div class="col-md-3 col-sm-3 col-xs-6" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
				                                            <div class="product_pro">
				                                                <h4>Quantity</h4>
				                                                <div class="count-input space-bottom">
				                                                    <!-- <a class="incr-btn" data-action="decrease" href="#">&minus;</a>
				                                                    <input class="quantity" type="text" name="quantity" value="1"/>
				                                                    <a class="incr-btn" data-action="increase" href="#">&plus;</a> -->
				                                                    <?php
																		if ( $_product->is_sold_individually() ) {
																			$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
																		} else {
																			$product_quantity = woocommerce_quantity_input( array(
																				'input_name'   => "cart[{$cart_item_key}][qty]",
																				'input_value'  => $cart_item['quantity'],
																				'max_value'    => $_product->get_max_purchase_quantity(),
																				'min_value'    => '0',
																				'product_name' => $_product->get_name(),
																			), $_product, false );
																		}

																		echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
																	?>
				                                                </div>
				                                            </div>
				                                        </div>
				                                        <div class="col-md-3 col-sm-3 col-xs-6" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
				                                            <div class="final_price text-right">
				                                                <h4><?php
																	echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
																?></h4>
				                                            </div>
				                                        </div>
			                                		</div>
			                                	</div>
											</div>  <!--/.content-->
										</div> <!--/.col-md-10 col-sm-10 col-xs-9-->
									</div>	<!--/col-md-12 col-sm-12 col-xs-12-->
								</div> <!--/.row-->
							</div> <!--/.s_product-->
							<?php
						}
					}
					?>
				</div>
				<?php do_action( 'woocommerce_cart_contents' ); ?>	
				<div class="row alert_sec promo_sec">
		            <div class="col-md-8 col-sm-8 col-xs-12">
		                <div class="cart-button-area">
		                    <h3><i class="fa fa-certificate" aria-hidden="true"></i> Do you have a promotion code?</h3>
		                    <div class="couponbtn">
		                        <?php if ( wc_coupons_enabled() ) { ?>
									<div class="coupon form-inline">
										<div class="form-group col-md-8">
											<input type="text" name="coupon_code" class="input-text form-control-plaintext" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
										</div>
										<button type="submit" class="btn btn-primary" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Use Promo Code', 'woocommerce' ); ?></button>
										<?php do_action( 'woocommerce_cart_coupon' ); ?>
									</div>
								<?php } ?>
									<a href="#" class="refr_frnd">Been reffered by a friend?</a>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 ">
								<div class="updatecart">
								</div>
							</div>
							<?php do_action( 'woocommerce_cart_actions' ); ?>
							<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?> 
		            	</div>
		            </div>
		            <div class="col-md-4 col-sm-4 col-xs-12 ">
						<div class="updatecart">
							<button type="submit" class="btn btn-primary" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
						</div>	
					</div>
	        	</div>	
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>			
		</div>
	</form>	

	<div class="calculate-area">
	    <div class="row">
	        <div class="col-sm-7">

	        </div>
	        <div class="col-sm-5">
	            <!-- <div class="cart-total">
	                <div class="subtotal">Subtotal <span>$60.98</span></div>
	                <div class="delivery_cost">Estimated delivery costs <span>$0.00</span></div>
	                <div class="total_prz">Total <span>$60.98</span></div>
	                <div class="ext_tx text-right">+ VAT Included</div>
	            </div>
	            <div class="button text-right">
	                <a href="#">Proceed to checkout <i class="fa fa-caret-right" aria-hidden="true"></i></a>
	            </div> -->
	            <?php
					/**
					 * Cart collaterals hook.
					 *
					 * @hooked woocommerce_cross_sell_display
					 * @hooked woocommerce_cart_totals - 10
					 */
					do_action( 'woocommerce_cart_collaterals' );
				?>
	        </div>
	    </div>
	</div>

</div>


<?php do_action( 'woocommerce_after_cart' ); ?>