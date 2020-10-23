<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
	<h3> <i class="fa fa-check" aria-hidden="true"></i> This item has been added to your cart</h3>
	<div class="items-list">
		<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
			<?php
				do_action( 'woocommerce_before_mini_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
						$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>

						<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
							<div class="media">
			                    <div class="pull-left">
			                    	<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo $thumbnail; ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo $thumbnail; ?>
										</a>
									<?php endif; ?>
			                    </div>
			                    <div class="media-body">
			                        <h4 class="media-heading">
			                        	<?php if ( empty( $product_permalink ) ) : ?>
											<?php echo $product_name; ?>
										<?php else : ?>
											<a href="<?php echo esc_url( $product_permalink ); ?>">
												<?php echo $product_name; ?>
											</a>
										<?php endif; ?>
			                        </h4>
			                        <div class="rating">
			                        	<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
			                            <ul>
			                                <li> <span>QTY</span> : <?php echo $cart_item['quantity']; ?></li>
			                            </ul>
			                        </div>
			                        <span><?php echo $product_price; ?></span>
			                    </div>
			                </div>
							
							<?php 
							//echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
						</li>
						<?php
					}
				}

				do_action( 'woocommerce_mini_cart_contents' );
			?>
		</ul>
	</div>
	<hr>
    <h2 class="woocommerce-mini-cart__total total"><?php _e( 'Subtotal', 'woocommerce' ); ?>  :  <span> <?php echo WC()->cart->get_cart_subtotal(); ?></span></h2>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
	<div class="form-inline woocommerce-mini-cart__buttons buttons">
        <ul>
        	<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
        </ul>
    </div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
