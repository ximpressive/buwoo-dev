<?php
function buwoo_demo_import_func() {

  define('DEMO_DIR', get_template_directory_uri().'/buwoo-demo/' );

  return array(

    /* demo 1 
    ==========*/
    array(
      'import_file_name'           => 'Fashion',
      'categories'                 => array( 'Fashion' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-1/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-1/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-1/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-1/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-1/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo1/',
    ),

    /* demo 2 
    ==========*/
    array(
      'import_file_name'           => 'Fashion II',
      'categories'                 => array( 'Fashion' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-2/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-2/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-2/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-2/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-2/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo2/',
    ),

    /* demo 3
    ==========*/
    array(
      'import_file_name'           => 'Skate',
      'categories'                 => array( 'Sports' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-3/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-3/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-3/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-3/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-3/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo3/',
    ),
    
    /* demo 4
    ==========*/
    array(
      'import_file_name'           => 'Fashion III',
      'categories'                 => array( 'Fashion' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-4/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-4/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-4/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-4/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-4/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo4/',
    ),

    /* demo 5
    ==========*/
    array(
      'import_file_name'           => 'Fashion IV',
      'categories'                 => array( 'Fashion' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-5/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-5/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-5/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-5/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-5/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo5/',
    ),

    /* demo 6
    ==========*/
    array(
      'import_file_name'           => 'Helmets',
      'categories'                 => array( 'Accesories' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-6/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-6/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-6/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-6/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-6/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo6/',
    ),

    /* demo 7
    ==========*/
    array(
      'import_file_name'           => 'Fashion V',
      'categories'                 => array( 'Fashion' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-7/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-7/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-7/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-7/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-7/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo7/',
    ),

    /* demo 8
    ==========*/
    array(
      'import_file_name'           => 'Food',
      'categories'                 => array( 'Food' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-8/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-8/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-8/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-8/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-8/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo8/',
    ),

    /* demo 9
    ==========*/
    array(
      'import_file_name'           => 'Bicycle',
      'categories'                 => array( 'Sports', 'Business' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-9/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-9/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-9/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-9/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-9/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo9/',
    ),

    /* demo 10
    ==========*/
    array(
      'import_file_name'           => 'Sneakers',
      'categories'                 => array( 'Accesories' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-10/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-10/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-10/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-10/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-10/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo10/',
    ),

    /* demo 11
    ==========*/
    array(
      'import_file_name'           => 'Technolog',
      'categories'                 => array( 'Accesories', 'Business' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-11/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-11/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-11/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-11/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-11/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo11/',
    ),

    /* demo 12
    ==========*/
    array(
      'import_file_name'           => 'Fitness',
      'categories'                 => array( 'Fitness' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-12/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-12/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-12/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-12/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-12/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo12/',
    ),

    /* demo 13
    ==========*/
    array(
      'import_file_name'           => 'Car Performance',
      'categories'                 => array( 'Accesories', 'Business' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-13/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-13/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-13/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-13/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-13/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo13/',
    ),

    /* demo 14
    ==========*/
    array(
      'import_file_name'           => 'Cafe Racer',
      'categories'                 => array( 'Accesories', 'Business' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-14/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-14/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-14/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-14/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-14/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo14/',
    ),

    /* demo 15
    ==========*/
    array(
      'import_file_name'           => 'FURNITURE',
      'categories'                 => array( 'Business' ),
      'import_file_url'            => DEMO_DIR . 'buwoo-15/buwoo-content.xml',
      'import_widget_file_url'     => DEMO_DIR . 'buwoo-15/buwoo-widgets.wie',
      'import_customizer_file_url' => DEMO_DIR . 'buwoo-15/buwoo-customizer.dat',
      'import_redux'               => array(
        array(
          'file_url'    => DEMO_DIR . 'buwoo-15/buwoo-options.json',
          'option_name' => 'boutique',
        ),
      ),
      'import_preview_image_url'   => DEMO_DIR . 'buwoo-15/screenshot.jpg',
      'import_notice'              => __( '', 'boutique' ),
      'preview_url'                => 'https://buwoo.krocant.com/demo15/',
    ),

  );
}
add_filter( 'pt-ocdi/import_files', 'buwoo_demo_import_func' );


function buwoo_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
      'mega_menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'buwoo_after_import_setup' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );



