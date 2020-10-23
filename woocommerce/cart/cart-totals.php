<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<!-- <h2><?php _e( 'Cart totals', 'woocommerce' ); ?></h2> -->


        <div class="cart-total">
            <div class="subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
            	<?php _e( 'Subtotal', 'woocommerce' ); ?> <?php wc_cart_totals_subtotal_html(); ?>
            </div>
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<?php wc_cart_totals_coupon_label( $coupon ); ?>
					<div data-title="<?php echo esc_attr( wc_cart_totals_coupon_label( $coupon, false ) ); ?>"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
				</div>
			<?php endforeach; ?>
            <div class="delivery_cost" data-title="<?php esc_attr_e( 'Shipping', 'woocommerce' ); ?>">


				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

					<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

				<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

					<?php _e( 'Estimated delivery costs', 'woocommerce' ); ?>
						<?php woocommerce_shipping_calculator(); ?>

				<?php endif; ?>

				<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<tr class="fee">
						<th><?php echo esc_html( $fee->name ); ?></th>
						<td data-title="<?php echo esc_attr( $fee->name ); ?>"><?php wc_cart_totals_fee_html( $fee ); ?></td>
					</tr>
				<?php endforeach; ?>
            </div>

            <?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
                <div class="total_prz" data-title="<?php esc_attr_e( 'Total', 'woocommerce' ); ?>"><?php _e( 'Total', 'woocommerce' ); ?> <?php wc_cart_totals_order_total_html(); ?>
                </div>
            <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

            <div class="ext_tx text-right">+ VAT Included


				<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
					$taxable_address = WC()->customer->get_taxable_address();
					$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
							? sprintf( ' <small>' . __( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
							: '';

					if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
						<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
							<div class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>"  data-title="<?php echo esc_attr( $tax->label ); ?>">
								<?php echo esc_html( $tax->label ) . $estimated_text; ?> 
								<?php echo wp_kses_post( $tax->formatted_amount ); ?>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<div class="tax-total" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>">
							<?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?> 
							<?php wc_cart_totals_taxes_total_html(); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
            </div>
        </div>
        <div class="button text-right">
            <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
        </div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
