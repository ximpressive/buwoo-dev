<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header('shop');

global $boutique;

$pagelayout	=	$boutique['boutique-shop_layout'];
$pagestyle	=	$boutique['boutique-shop_style'];
$displaybnr	=	$boutique['display_shoppage_banner'];
$shopbanner	=	$boutique['shopbanner']['url'];
$sidebar 	=	$boutique['boutique-shop_sidebar'];
$numofpost	=	$boutique['boutique-shop_count'];
$gn_layout  =   $boutique['boutique-select-header-layout'];
$in_layout  =   get_post_meta( get_queried_object_id(), 'boutique_hdr_layout', true );

if( $in_layout == '' || $in_layout == 'default' ){  
    $gh_ly  =  $gn_layout; 
}

switch ($pagestyle) {
	case 'style1':
		$parentclass	=	'co4';
		$classlayout	=	'col-md-3 col-sm-6 col-xs-12';
		break;
	case 'style2':
		$parentclass	=	'co3';
		$classlayout	=	'col-md-4 col-sm-6 col-xs-12';
		break;
	case 'style3':
		$parentclass	=	'co2';
		$classlayout	=	'col-md-6 col-sm-6 col-xs-12';
		break;
	case 'style4':
		$parentclass	=	'co6';
		$classlayout	=	'col-md-2 col-sm-6 col-xs-12';
		break;
}


//echo $shopbanner;

if( $shopbanner =="" ){
	$shopbanner	=	get_template_directory_uri() .'/assets/images/breadcumb/1.jpg';
}


if ( is_product_category() ){
    global $wp_query;
    $cat = $wp_query->get_queried_object();
    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
    $shopbanner = wp_get_attachment_url( $thumbnail_id );
}



/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

do_action( 'woocommerce_before_main_content' );

?>
<?php if( $displaybnr 	==	1 ){ ?>
<div class="breadcumb-area background-image"  data-src="<?php echo $shopbanner; ?>">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-sm-12 text-center">
                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2>
				<?php endif; ?>
				<?php
					/**
					 * Hook: woocommerce_archive_description.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );

				?>
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
<?php } else{ ?>


<div class="breadcumb-area without-bg">
    <div class="<?php if ( $in_layout == 'header5' || $gh_ly == 5 ) { echo 'container-fluid'; }else{ echo 'container'; } ?>">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <h2><?php woocommerce_page_title(); ?></h2>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 text-right">
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

<div class="category-product-area">
	<div class="<?php if( $pagelayout == 'wide' || $in_layout == 'header5' || $gh_ly == 5 ){ echo 'container-fluid'; } else { echo 'container'; } ?>">
		<div class="row">
			<?php if( $sidebar == 'left-sidebar' ){ ?>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<?php do_action( 'woocommerce_sidebar' ); ?>
				</div>
			<?php } ?>
			<div class="<?php if( $sidebar == 'full-width' ){ echo 'col-md-12 col-sm-12 col-xs-12'; } else { echo 'col-md-9 col-sm-9 col-xs-12'; }  ?> ">

			<?php
			if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );

						?>

						<li <?php wc_product_class($parentclass); ?>>
							<div class="<?php echo $classlayout; ?> single-products">
								<?php wc_get_template_part( 'content', 'product' ); ?>
							</div>
						</li>

						<?php
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				//remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
				do_action( 'woocommerce_after_shop_loop' );

			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
		?>
		</div>
		<?php if( $sidebar == 'right-sidebar' ){ ?>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<?php
				/**
				 * Hook: woocommerce_sidebar.
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
				?>
			</div>
		<?php }elseif( is_product_category() ) { ?>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<?php
				/**
				 * Hook: woocommerce_sidebar.
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action( 'woocommerce_sidebar' );
				?>
			</div>
		<?php } ?>
	<?php
	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );

	?>

	</div>
</div>

<?php
get_footer();
