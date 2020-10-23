<?php

	/********************/
	/* Define Constants */
	/********************/
	define('BOUTIQUE_NAME', 'boutique');
	define('BOUTIQUE_VERSION', '1.0.0');
	define('BOUTIQUE_THEMEROOT_DIR', get_template_directory());
	define('BOUTIQUE_THEMEROOT', get_template_directory_uri());

	define('BOUTIQUE_FRAMEWORK',     BOUTIQUE_THEMEROOT_DIR . '/framework');
	define('BOUTIQUE_FRAMEWORK_URI', BOUTIQUE_THEMEROOT . '/framework');

	define('BOUTIQUE_IMAGES', BOUTIQUE_THEMEROOT . '/assets/images');
	define('BOUTIQUE_IMAGES_DIR', BOUTIQUE_THEMEROOT_DIR . '/assets/images');
	define('BOUTIQUE_CSS', BOUTIQUE_THEMEROOT . '/assets/css');
	define('BOUTIQUE_CSS_DIR', BOUTIQUE_THEMEROOT_DIR . '/assets/css');
	define('BOUTIQUE_SCRIPTS', BOUTIQUE_THEMEROOT . '/assets/js');
	define('BOUTIQUE_SCRIPTS_DIR', BOUTIQUE_THEMEROOT_DIR . '/assets/js');

	define('BOUTIQUE_FOOTER_STYLE', BOUTIQUE_THEMEROOT . '/template-parts/footer/');

	//Wordpress Admin
	require_once( BOUTIQUE_FRAMEWORK. '/tgm-config.php'); //Install required plugins

	boutique_require_file ( BOUTIQUE_FRAMEWORK . '/custom-metaboxes/init.php' );
	boutique_require_file ( BOUTIQUE_FRAMEWORK . '/custom-metaboxes/metaboxes.php' );

	/*******************/
	/* Reguire Files */
	/*******************/

	boutique_require_file(  __DIR__ . '/enqueue.php');
	boutique_require_file(  BOUTIQUE_THEMEROOT_DIR . '/inc/menu_walker.php');

	/*********************/
	/* Custom Image Sizes */
	/*********************/

	add_image_size('topcatimg', 462, 952, true);
	add_image_size('blockthumb', 402, 285, true);
	add_image_size('post_thumb', 560, 310, true);
	add_image_size('blog_thumb', 825, 310, true);
	add_image_size('sn_img', 920, 508, true);
	add_image_size('pd_cro_thumb', 400, 460, true);
	add_image_size('hover_product', 270, 342, true);


	/*****************************************/
	/*********** Essential Files *************/
	/*****************************************/

	boutique_require_file( get_template_directory() . '/inc/widgets/widgets.php');
	boutique_require_file( get_template_directory() . '/inc/breadcrumb.php');
	boutique_require_file( get_template_directory() . '/inc/helpers/woo-helpers.php');
	boutique_require_file( get_template_directory() . '/inc/helpers/helpers.php');

	/***********************************/
	/****** Elementor Integrated ******/
	/**********************************/
// style enqueue

function elementor_plg_scripts() {
    wp_enqueue_style( 'elementor-custom-style', BOUTIQUE_FRAMEWORK_URI . '/elementor/assets/css/elementor.css', '2.0.6' );
    //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'elementor_plg_scripts' );


// Load the theme's custom Widgets so that they appear in the Elementor element panel.
add_action( 'elementor/widgets/widgets_registered', 'register_elementor_widgets' );
function register_elementor_widgets() {
	// We check if the Elementor plugin has been installed / activated.
	if ( defined( 'ELEMENTOR_PATH' ) && class_exists('Elementor\Widget_Base') ) {
		boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/blog-posts.php' );
		boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/social.php' );
		boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/page-banner-boxes.php' );
		boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/page-feature-boxes.php' );
		/*Woo*/
		if ( class_exists( 'WooCommerce' ) ) {
			boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/products.php' );
			boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/featured-product.php' );
			boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/isotope-grid-categories.php' );
			boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/masonry-categories.php' );
			boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/banner-categories.php' );
			boutique_require_file ( BOUTIQUE_FRAMEWORK . '/elementor/woo-categories-carousel.php' );
		}
 	}
}
// Add a custom 'mld' category for to the Elementor element panel so that
// our theme's widgets have their own category.
add_action( 'elementor/init', function() {
	\Elementor\Plugin::$instance->elements_manager->add_category(
		'boutique',
		[
			'title' => __( 'BuWoo', 'boutique' ),
			'icon' => 'fa fa-plug', //default icon
		],
		1 // position
	);
});

function boutique_wpmm_init() {
    $location 	=	'mega_menu';
    $css_class 	=	'mega-menu-parent';
    $locations 	=	get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
        $menu = get_term( $locations[ $location ], 'nav_menu' );
        if ( $items = wp_get_nav_menu_items( $menu->name ) ) {
            foreach ( $items as $item ) {
                //if ( in_array( $css_class, $item->classes ) ) {
                if( get_post_meta( $item->ID, 'menu-item-mm_megamenu', true ) == '1' ){
                    register_sidebar( array(
                        'id'   => 'mega-menu-item-' . $item->ID,
                        'name' => $item->title . ' - Mega Menu',
                        'description' => __( 'The widget data display on mega menu', 'boutique' )
                    ) );
                }
            }
        }
    }
}
add_action( 'widgets_init', 'boutique_wpmm_init' );
