<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
    

<div class="all_prd">
    <div class="row">
        <?php
            do_action( 'woocommerce_review_order_before_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12 m-0 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
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
                    <?php
                }
            }

            do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </div>
    <div class="total_prd">
        <div class="subtotal"><?php _e( 'Subtotal', 'woocommerce' ); ?> <?php wc_cart_totals_subtotal_html(); ?></div>
        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

            <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

            <div class="subtotal"><?php wc_cart_totals_shipping_html(); ?></div>

            <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

        <?php endif; ?>

        <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
            <div class="subtotal"><?php echo esc_html( $fee->name ); ?> <?php wc_cart_totals_fee_html( $fee ); ?>
            </div>
        <?php endforeach; ?>

        
		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

        <div class="total_prz"><?php _e( 'Total', 'woocommerce' ); ?> <?php wc_cart_totals_order_total_html(); ?></div>

        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
        

        <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
            <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                    <div class="ext_tx text-right tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>"><?php echo esc_html( $tax->label ); ?> <?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="ext_tx text-right"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?> <?php wc_cart_totals_taxes_total_html(); ?></div>
            <?php endif; ?>
        <?php endif; ?>
        </div>
    </div>
</div>
