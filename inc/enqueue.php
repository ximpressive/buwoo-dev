<?php

/**
 * Enqueue scripts and styles.
 */
function boutique_scripts_and_styles() {
  // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  global $wp_styles, $smof_data;
  if ( !is_admin() ) {
  /*
   * Theme CSS
   */
   wp_enqueue_style( 'main-style', get_stylesheet_uri() );
    wp_enqueue_style( 'font-awesome-min', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0', 'all' );
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CPlayfair+Display:400,700,900', array(), 'all' );
    wp_enqueue_style( 'boutique-fonts', get_template_directory_uri() . '/assets/fonts/flaticon.css', array(), '3.1.3', 'all' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '3.3.7', 'all' );
    wp_enqueue_style( 'boutique-animate-stylesheet', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.4.0', 'all' );
    wp_enqueue_style( 'boutique-slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'boutique-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), '3.1.3', 'all' );
    wp_enqueue_style( 'boutique-owl.carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '1.3.3', 'all' );
    wp_enqueue_style( 'boutique-owl.theme.css', get_template_directory_uri() . '/assets/css/owl.theme.default.css', array(), '1.3.3', 'all' );
    wp_enqueue_style( 'boutique-owl.transitions', get_template_directory_uri() . '/assets/css/owl.transitions.css', array(), '1.3.3', 'all' );
    wp_enqueue_style( 'boutique-fancybox', get_template_directory_uri() . '/assets/inc/fancybox/jquery.fancybox.css', array(), '2.1.5', 'all' );
    wp_enqueue_style( 'boutique-custom-main', get_template_directory_uri() . '/assets/css/custom-main.css', array(), 'all' );
    wp_enqueue_style( 'boutique-custom-responsive', get_template_directory_uri() . '/assets/css/custom-responsive.css', array(), 'all' );
    wp_enqueue_style( 'boutique-megamenu', get_template_directory_uri() . '/assets/css/megamenu.css', array(), 'all' );
    wp_enqueue_style( 'boutique-dynamic-css', get_template_directory_uri() . '/inc/helpers/dynamic-css.php');
/*
 * Theme Js
 */
    //Protocol
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery-1.12.0.min.js', array(), '1.12.0', false );
    wp_enqueue_script( 'jquery-ui', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array(), '1.11.3', false );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/assets/inc/fancybox/jquery.fancybox.js', array(), '2.1.5', false );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( ), '3.3.7' );
    wp_enqueue_script( 'boutique-wow-js', get_template_directory_uri() . '/assets/js/wow.min.js', array(), '1.1.2' );
    wp_enqueue_script( 'boutique-scrollup', get_template_directory_uri() . '/assets/js/scrollup.js', array(), '2.4.1' );
    wp_enqueue_script( 'boutique-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array(), '2.0.44' );
    wp_enqueue_script( 'boutique-retina', get_template_directory_uri() . '/assets/js/retina.min.js', array(), '1.3.0' );
    wp_enqueue_script( 'boutique-owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), '2.0.4' );
    wp_enqueue_script( 'boutique-isotope.pkgd', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), '3.0.5' );
    wp_enqueue_script( 'boutique-google-api', '//maps.googleapis.com/maps/api/js?key=AIzaSyCcvAXp35fi4q7HXm7vcG9JMtzQbMzjRe8', array(), '1.0' );

    wp_enqueue_script( 'boutique-gmaps', get_template_directory_uri() . '/assets/js/gmaps.js', array(), '0.4.9');
    wp_enqueue_script( 'boutique-custom-script', get_template_directory_uri() . '/assets/js/custom-script.js', 'all');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
  }// ! is_admin
}
add_action( 'wp_enqueue_scripts', 'boutique_scripts_and_styles' );

?>