<?php

/*************************/
/****** WOOCOMMERCE *****/
/************************/

if ( class_exists( 'WooCommerce' ) ) {

	add_theme_support( 'wc-product-gallery-lightbox' );


	// for shop page only

	register_sidebar( array(
	    'name' 			=>	__( 'Shop Page', 'boutique' ),
	    'id' 			=>	'shop',
	    'description' 	=>	__( 'Widgets in this area will be shown on the Shop.', 'boutique' ),
	    'before_widget' =>	'<div id="%1$s" class="widget %2$s">',
	    'after_widget'  =>	'</div>',
	    'before_title'  =>	'<h2 class="widget-title">',
	    'after_title'   =>	'</h2>',
	) );


	// Variable & intelligent excerpt length.
	function print_excerpt($length) { // Max excerpt length. Length is set in characters
	    global $post;
	    $text = $post->post_excerpt;
	    if ( '' == $text ) {
	        $text = get_the_content('');
	        $text = apply_filters('the_content', $text);
	        $text = str_replace(']]>', ']]>', $text);
	    }
	    $text = strip_shortcodes($text); // optional, recommended
	    $text = strip_tags($text); // use ' $text = strip_tags($text,'&lt;p&gt;&lt;a&gt;'); ' if you want to keep some tags

	    $text = substr($text,0,$length);
	    $excerpt = reverse_strrchr($text, '.', 1);
	    if( $excerpt ) {
	        echo apply_filters('the_excerpt',$excerpt);
	    } else {
	        echo apply_filters('the_excerpt',$text);
	    }
	}
	// Returns the portion of haystack which goes until the last occurrence of needle
	function reverse_strrchr($haystack, $needle, $trail) {
	    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
	}


	add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
		<?php

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}


	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
	//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
	remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);

	// Add product meta in new position

	//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 40 );
	add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
	add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );
	//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


	add_action( 'woocommerce_before_shop_loop_item_title', 'bbloomer_display_sold_out_loop_woocommerce' );
	function bbloomer_display_sold_out_loop_woocommerce() {
	    global $product;
	    if ( !$product->is_in_stock() ) {
	        echo '<span class="onsale soldout">' . __( 'Out of Stock', 'boutique' ) . '</span>';
	    }
	    if ( $product->get_gallery_image_ids() ) {
	    	$id = $product->get_gallery_image_ids();
		    $url_attachment	=	wp_get_attachment_image_src( $id[0], 'shop_catalog', true );
		    echo "<div class='hvr_img'>";
		    echo "<img src='".$url_attachment[0]."' class='galleryimage' alt='product-image-".$id[0]."'>";
		    echo "</div>";
		}
	}


	add_filter('woocommerce_form_field_args','wc_form_field_args',10,3);
	function wc_form_field_args($args, $key, $value) {
		$args['input_class'][] = 'form-control';
		$args['select_class'][] = 'form-control';
		return $args;
	}

	add_action( 'woocommerce_review_order_after_order_total', 'output_payment_button' );
	function output_payment_button() {
	    echo '<div class="button">';
	    $order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'woocommerce' ) );
	    echo '<button type="submit" class="placeorder alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '<i class="fa fa-caret-right" aria-hidden="true"></i></button>';
	    echo '</div>';
	}


	add_filter( 'woocommerce_order_button_html', 'remove_woocommerce_order_button_html' );
	function remove_woocommerce_order_button_html() {
	    return '';
	}


	// remove Order Notes from checkout field in Woocommerce
	add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields' );
	function alter_woocommerce_checkout_fields( $fields ) {
	     unset($fields['order']['order_comments']);
	     return $fields;
	}

	function paypal_checkout_icon_boutique() {
		return get_template_directory_uri() .'/assets/images/payment/paypal.png';
	}
	add_filter( 'woocommerce_paypal_icon', 'paypal_checkout_icon_boutique' );

    add_filter( 'woocommerce_product_related_posts',
                'wpse_123436_change_wc_related_products_relation_to_and' );
    function wpse_123436_change_wc_related_products_relation_to_and() {
            $get_related_products_args = array(
                'orderby' => 'rand',
                'posts_per_page' => $limit,
                'post_type' => 'product',
                'fields' => 'ids',
                'meta_query' => $meta_query,
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => $cats_array
                    ),
                    array(
                        'taxonomy' => 'product_tag',
                        'field' => 'id',
                        'terms' => $tags_array
                    )
                )
            );
            return $get_related_products_args;
    }

    remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
	remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

	function boutique_widget_shopping_cart_proceed_to_checkout() {
	    echo '<li><a href="' . esc_url( wc_get_checkout_url() ) . '" class="btn btn-lg update">' . esc_html__( 'Proceed to Checkout ', 'woocommerce' ) . '<i class="fa fa-caret-right" aria-hidden="true"></i></a></li>';
	}
	function boutique_widget_shopping_cart_button_view_cart() {
	    echo '<li><a href="' . esc_url( wc_get_cart_url() ) . '" class="btn btn-lg checkout">' . esc_html__( 'View cart ', 'woocommerce' ) . '<i class="fa fa-caret-right" aria-hidden="true"></i></a></li>';
	}
	add_action( 'woocommerce_widget_shopping_cart_buttons', 'boutique_widget_shopping_cart_proceed_to_checkout', 10 );
	add_action( 'woocommerce_widget_shopping_cart_buttons', 'boutique_widget_shopping_cart_button_view_cart', 20 );

	/**
	 * Change number of products that are displayed per page (shop page)
	 */
	add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
	function new_loop_shop_per_page( $cols ) {
		global $boutique;
		$cols = $boutique['boutique-shop_count'];
		return $cols;
	}

	function wooc_extra_register_fields() { ?>

	    <p class="form-row form-row-first">
	        <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
	        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
	    </p>
	    <p class="form-row form-row-last">
	        <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
	        <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
	    </p>
	    <p class="form-row form-row-wide">
	        <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
	        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
	    </p>
	    <div class="clear"></div>
	<?php
	}
	add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );


	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    add_action( 'woocommerce_after_single_product_summary', 'wootab_to_accordian', 10 );
    function wootab_to_accordian(){
    	$tabs = apply_filters( 'woocommerce_product_tabs', array() );
		if ( ! empty( $tabs ) ) : ?>
		  <div id="accordion" class="woocommerce-tabs wc-tabs-wrapper panel-group">
		  	<?php  $i = 1;  ?>
		    <?php foreach ( $tabs as $key => $tab ) : ?>
			    <div class="panel panel-default">
			    	<div class="panel-heading" data-target="#<?php echo esc_attr( $key ); ?>_tab" data-toggle="collapse" data-parent="#accordion">
						<h4 class="panel-title">
							<a href="#."><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?><span class="glyphicon glyphicon-plus"></span></a>
						</h4>
					</div>
					<!--By default open <?php //if( $i == 1 ){ echo 'in'; } ?>-->
					<div class="panel-collapse collapse" id="<?php echo esc_attr( $key ); ?>_tab">
						<div class="panel-body">
							<?php call_user_func( $tab['callback'], $key, $tab ); ?>
						</div>
					</div>
			    </div>
			    <?php $i++; ?>
		    <?php endforeach; ?>
		  </div>
		<?php endif;
    }

    add_action( 'after_setup_theme', 'buWOO_woocommerce_theme_support' );
	function buWOO_woocommerce_theme_support(){

		global $boutique;

		$sn_style	=	$boutique['snprd_design'];

			//echo $sn_style;

	    add_theme_support( 'wc-product-gallery-lightbox' );

	    if( $sn_style == 'sn_style_1' ){
			add_theme_support( 'woocommerce', array(
				'gallery_thumbnail_image_width' => 600,
			) );
		}
		if( $sn_style == 'sn_style_2' ){
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-slider' );
			add_theme_support( 'woocommerce', array(
				'gallery_thumbnail_image_width' => 150,
			) );
		}
		if( $sn_style == 'sn_style_3' ){
			add_theme_support( 'woocommerce', array(
				//'single_image_width' =>	400,
				//'gallery_thumbnail_image_width' => 400,
			) );

			add_filter( 'woocommerce_get_image_size_single', function( $size ) {
				return array(
					'width' => 400,
					'height' => 500,
					'crop' => 1,
				);
			} );

			add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
				return array(
					'width' => 400,
					'height' => 500,
					'crop' => 1,
				);
			} );
		}

	}

	function buwoo_categories_postcount_filter_4554($variable) {
		$variable = str_replace('(', ' ', $variable);
		$variable = str_replace(')', ' ', $variable);
		return $variable;
	}
	add_filter('wp_list_categories','buwoo_categories_postcount_filter_4554');
	function buwoo_archive_postcount_filter_1287 ($variable) {
		$variable = str_replace('(', ' ', $variable);
	   	$variable = str_replace(')', ' ', $variable);
		return $variable;
	}
	add_filter('get_archives_link', 'buwoo_archive_postcount_filter_1287');


}// WooCommerce exist
