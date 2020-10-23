<?php

/**
 * The Boutique functions and definitions
 *
 * @package Boutique
 */

/**
 * Constants
 *
 * @since 1.0.0
*/
if ( ! defined( 'BUWOO_VERSION' ) ) {
    define( 'BUWOO_VERSION', '1.0.0' );
}

if ( ! defined( 'BUWOO_AUTHOR' ) ) {
    define( 'BUWOO_AUTHOR', 'Krocant' );
}

if ( ! defined( 'BUWOO_NAME' ) ) {
    define( 'BUWOO_NAME', 'BuWoo' );
}

function boutique_require_file ( $file_path ) {
    require_once ( $file_path );
}

if ( ! function_exists( 'boutique_setup' ) ) {

    function boutique_setup() {

        load_theme_textdomain( 'boutique');

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-header' );

        // wp menus
        add_theme_support( 'menus' );

        if ( class_exists( 'WooCommerce' ) ) {
            //WooCommerce theme support
            add_theme_support( 'woocommerce' );
        }

        //registering wp3+ menus
        register_nav_menus(
            array(
                'mega_menu'      => esc_html__( 'The Main Menu', 'boutique' ),   // main nav in header
                'main-nav-left'  => esc_html__( 'Left Main Menu', 'boutique' ),   // main nav Left in header
                'main-nav-right' => esc_html__( 'Right Main Menu', 'boutique' ),   // main nav Right in header
                'top-head-nav'   => esc_html__( 'Top Header Nav', 'boutique' ),
                'footer-nav'     => esc_html__( 'Footer Nav', 'boutique' ),
				'mobile-nav'     => esc_html__( 'Mobile Nav', 'boutique' ),
                'sidebar-nav'    => esc_html__( 'Sidebar Nav', 'boutique' )
            )
        );

        //now see if the main navigation menu is there - if not, create it.

        if ( !wp_get_nav_menu_object('The Main Menu') ){

            $menu_id = wp_create_nav_menu('The Main Menu'); //create the menu
            $locations = get_theme_mod('nav_menu_locations'); //get the menu locations
            $locations['mega_menu'] = $menu_id; //set our new menu to be the main nav
            set_theme_mod('nav_menu_locations', $locations); //update 
        }

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /*
        * Enable support for Post Formats.
        * See http://codex.wordpress.org/Post_Formats
        */
        add_theme_support( 'post-formats', array(
            'audio',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
        ) );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        require( get_template_directory() . '/inc/updater/buwoo-updater.php' );

    }
}
add_action( 'after_setup_theme', 'boutique_setup' );

/*****************************************/
/****** Add theme options files **********/
/*****************************************/

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/framework/theme-options/admin/framework.php' ) ) {

    require_once( dirname( __FILE__ ) . '/framework/theme-options/admin/framework.php' );

}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/framework/theme-options/options/functions-option.php' ) ) {

    require_once( dirname( __FILE__ ) . '/framework/theme-options/options/functions-option.php' );

}

/************************************/
/****** Theme Enqueue Files *********/
/************************************/

require_once( get_template_directory().  '/inc/admin_functions.php');
require_once( get_template_directory().  '/inc/demo-import.php');