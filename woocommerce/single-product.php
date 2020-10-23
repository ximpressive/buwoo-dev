<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 

global $boutique;

	$spagelayout	=	$boutique['boutique-snprd_layout'];
	$sidebar 		=	$boutique['boutique-single_shop_sidebar'];
	$displaybanner 	=	$boutique['display_singleshop_banner'];
	$pagebanner		=	$boutique['singleshopbanner']['url'];
	$breadcumb_sp 	=	$boutique['buwoo_show_bdrm'];

	$gn_layout   	=   $boutique['boutique-select-header-layout'];
	$in_layout   	=   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );
 
	if( $in_layout == '' || $in_layout == 'default' ){  
	    $gh_ly  =  $gn_layout; 
	} 

?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

<?php if ( $displaybanner == 1 ) { ?>

<div class="breadcumb-area background-image"  data-src="<?php echo $pagebanner; ?>">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2>
				<?php endif; ?>
                <ul>
                    <?php
		           	$args = array(
							'delimiter' 	=>	'<i class="fa fa-angle-right" aria-hidden="true"></i>',
							'wrap_before' 	=>	'<li>',
							'wrap_after' 	=>	'</li>',
						);	
	                	woocommerce_breadcrumb($args);
	    	        ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<?php if( $breadcumb_sp == 1 ): ?>
<div class="breadcumb-area spp_breadcumb">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul>
                	<?php
		           		$args = array(
							'delimiter' 	=>	'<i class="fa fa-angle-right" aria-hidden="true"></i>',
							'wrap_before' 	=>	'<li>',
							'wrap_after' 	=>	'</li>',
						);	
	                	woocommerce_breadcrumb($args);
    	        	?>
            	</ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="section pb-0 single-product-area">
    <div class="<?php if( $spagelayout == 'wide' || $in_layout == 'header5' || $gh_ly == 5 ){ echo 'container-fluid'; } else { echo 'container'; } ?>">
        <div class="row">
        	<?php if( $sidebar == 'left-sidebar' ){ ?>
				<div class="col-md-2 col-sm-2 col-xs-12">	
					<?php do_action( 'woocommerce_sidebar' ); ?>
				</div>
			<?php } ?>
			<div class="<?php if( $sidebar == 'full-width' ){ echo 'col-md-12 col-sm-12 col-xs-12 p-0'; } else { echo 'col-md-10 col-sm-10 col-xs-12'; }  ?> ">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div>
			<?php if( $sidebar == 'right-sidebar' ){ ?>
				<div class="col-md-2 col-sm-2 col-xs-12">	
					<?php
					/**
					 * Hook: woocommerce_sidebar.
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>		
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
