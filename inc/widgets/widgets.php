<?php

boutique_require_file( get_template_directory() . '/inc/widgets/subscribe-widget.php');
boutique_require_file( get_template_directory() . '/inc/widgets/footer-boxes.php');

add_action( 'widgets_init', 'boutique_widgets_init' );
function boutique_widgets_init() {
    global $boutique;
    $footerstyle    =   $boutique['boutique-footer-style'];
    register_sidebar( array(
        'name' => __( 'Primary Sidebar', 'boutique' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'boutique' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    if( $footerstyle == 'footer1' ){
        register_sidebar( array(
            'name' => __( 'Footer 1 (style1)', 'boutique' ),
            'id' => 'footer-1',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 2 (style1)', 'boutique' ),
            'id' => 'footer-2',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 3 (style1)', 'boutique' ),
            'id' => 'footer-3',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 4 (style1)', 'boutique' ),
            'id' => 'footer-4',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Boxes (style1)', 'boutique' ),
            'id' => 'footer-box-widget',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Copyright Section (style1)', 'boutique' ),
            'id' => 'footer-5',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Payment Boxes (style1)', 'boutique' ),
            'id' => 'payment-boxes',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
    
    if( $footerstyle == 'footer2' ){
        register_sidebar( array(
            'name' => __( 'Footer 1 (style2)', 'boutique' ),
            'id' => 'footer2-s2-w1',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 2 (style2)', 'boutique' ),
            'id' => 'footer2-s2-w2',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 3 (style2)', 'boutique' ),
            'id' => 'footer2-s2-w3',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Copyright (style2)', 'boutique' ),
            'id' => 'footer2-s2-cpy',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    } 
    if( $footerstyle == 'footer3' ){
        register_sidebar( array(
            'name' => __( 'Footer 1 (style3)', 'boutique' ),
            'id' => 'footer3-s3-w1',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Bottom Left (style3)', 'boutique' ),
            'id' => 'footer3-s3-left',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Bottom Right (style3)', 'boutique' ),
            'id' => 'footer3-s3-right',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }   
    if( $footerstyle == 'footer4' ){
        register_sidebar( array(
            'name' => __( 'Footer 1 (style4)', 'boutique' ),
            'id' => 'footer4-s4-w1',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Bottom Left (style4)', 'boutique' ),
            'id' => 'footer4-s4-left',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer Bottom Right (style4)', 'boutique' ),
            'id' => 'footer4-s4-right',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
    if( $footerstyle == 'footer5' ){
        register_sidebar( array(
            'name' => __( 'Footer 1 (style5)', 'boutique' ),
            'id' => 'footer5-s5-w1',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 2 (style5)', 'boutique' ),
            'id' => 'footer5-s5-w2',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div class="col-sm-4"><div id="%1$s" class="widget single-footer-menu %2$s">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Copyright (style5)', 'boutique' ),
            'id' => 'copyright-right',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
    if( $footerstyle == 'footer6' ){
        register_sidebar( array(
            'name' => __( 'Footer 1 (style6)', 'boutique' ),
            'id' => 'footer6-s6-w1',
            'description' => __( 'Widgets in this area will be shown in the footer.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 2 (style6)', 'boutique' ),
            'id' => 'footer6-s6-w2',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Footer 3 (style6)', 'boutique' ),
            'id' => 'footer6-s6-w3',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
            'name' => __( 'Copyright (style6)', 'boutique' ),
            'id' => 'copyright-w5',
            'description' => __( 'Widgets in this area will be shown in the copyright footer section.', 'boutique' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}


?>