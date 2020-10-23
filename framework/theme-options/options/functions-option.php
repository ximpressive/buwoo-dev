<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    $opt_name = "boutique";
    $opt_name = apply_filters( 'boutique/opt_name', $opt_name );
    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../options/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../options/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    $theme = wp_get_theme();
    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__( 'Theme Options', 'boutique' ),
        'page_title'           => esc_html__( 'Theme Options', 'boutique' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => true,
        'disable_google_fonts_link' => true,
        'admin_bar'            => false,
        'admin_bar_icon'       => 'dashicons-art',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => false,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => 'dashicons-art',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => 'boutique',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'footer_credit'       => 'Options panel created using Boutique.',
        'database'             => '',
        'use_cdn'              => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => esc_html__( 'Documentation', 'boutique' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'boutique' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'boutique' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    Redux::setArgs( $opt_name, $args );

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'boutique' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'boutique' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'boutique' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'boutique' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'boutique' );
    Redux::setHelpSidebar( $opt_name, $content );
    /*
     * <--- END HELP TABS
     */

    /********************/
   	/** Start Sections **/
   	/********************/

   Redux::setSection( $opt_name, array(
       'title'            => esc_html__( 'Header', 'boutique' ),
       'id'               => 'boutique-header',
       'customizer_width' => '400px',
       'icon'             => 'el el-align-left',
       'fields'           => array(
         array(
             'id'       => 'boutique-opt-show-header',
             'type'     => 'switch',
             'title'    => esc_html__( 'Show Top Header?', 'boutique' ),
             'on'       => esc_html__( 'Yes', 'boutique' ),
             'off'      => esc_html__( 'No', 'boutique' ),
             'subtitle' => esc_html__( 'Choose "Yes" to enable top header.', 'boutique' ),
             'default'  => false
         ),
         array(
             'id'       => 'wide_box_opt',
             'type'     => 'switch',
             'title'    => 'Top header width',
             'on'       => 'Wide',
             'off'      => 'Boxed',
             'subtitle' => 'Select Top Header width, Wide and Box.',
             'default'  => true,
             'required' => array( 'boutique-opt-show-header', '=', true )
         ),
         array(
             'id'       => 'opt-header-bg-style',
             'type'     => 'switch',
             'title'    => 'Top Header Background Style',
             'on'       => 'Light',
             'off'      => 'Dark',
             'subtitle' => 'Select Top Header Background Style. Dark = White Text and Black Background; Light = Black Text and White Background.',
             'default'  => false,
             'required' => array( 'boutique-opt-show-header', '=', true )
         ),
         array(
             'id'       => 'boutique-opt-show-mobile',
             'type'     => 'switch',
             'title'    => 'Top Header on Mobile?',
             'on'       => 'Show',
             'off'      => 'Hide',
             'subtitle' => 'Choose "Show" or "Hide" top header on Mobile.',
             'default'  => false
         ),
        array(
             'id'       => 'boutique-hdr-textarea',
             'type'     => 'text',
             'title'    => esc_html__( 'Top Header Text', 'boutique' ),
             'subtitle'     => esc_html__( 'Please Enter Text Here.', 'boutique' ),
             'placeholder'  => 'Enter Your Text...',
        ),
        array(
              'id'       => 'header_version',
              'type'     => 'switch', 
              'title'    => __('Use header Light or Dark version', 'boutique'),
              'subtitle' => __('Use light or dark version of header.', 'boutique'),
              'on'       => 'Light',
              'off'      => 'Dark',
              'default'  => false,
        ),
        array(
            'id'       => 'boutique-select-header-layout',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Main Header Layout', 'boutique' ),
            //Must provide key => value(array:title|img) pairs for radio options
            'options'  => array(
                'default' => array(
                    'alt' => 'Default',
                    'img' => ReduxFramework::$_url . 'assets/img/default.jpg'
                ),
                '1' => array(
                    'alt' => '1 style',
                    'img' => ReduxFramework::$_url . 'assets/img/hd1.jpg'
                ),
                '2' => array(
                    'alt' => '2 style',
                    'img' => ReduxFramework::$_url . 'assets/img/hd2.jpg'
                ),
                '3' => array(
                    'alt' => '3 style',
                    'img' => ReduxFramework::$_url . 'assets/img/hd3.jpg'
                ),
                '4' => array(
                    'alt' => '4 style',
                    'img' => ReduxFramework::$_url . 'assets/img/hd4.jpg'
                ),
                '5' => array(
                    'alt' => '5 style',
                    'img' => ReduxFramework::$_url . 'assets/img/hd5.jpg'
                ),
                '6' => array(
                    'alt' => '6 style',
                    'img' => ReduxFramework::$_url . 'assets/img/hd6.jpg'
                )
            ),
            'default'  => 'default'
        ),
        array(
            'id'       => 'boutique-hdr-sticky',
            'type'     => 'switch',
            'title'    => 'Sticky Header',
            'on'       => 'Yes',
            'off'      => 'No',
            'subtitle' => 'Yes or no Sticky Header from here',
            'default'  => false
        ),
        array(
            'id'       => 'boutique-hdr-m_sticky',
            'type'     => 'switch',
            'title'    => 'Enable Sticky Header on Mobile Devices?',
            'on'       => 'Yes',
            'off'      => 'No',
            'subtitle' => 'Yes or No Sticky Header on Mobile Devices from here',
            'default'  => false
        ),
        array(
            'id'       => 'boutique-hdr-m_nav',
            'type'     => 'switch',
            'title'    => 'Menu on Mobile?',
            'on'       => 'Yes',
            'off'      => 'No',
            'subtitle' => 'Choose Yes or No Menu on Mobile.',
            'default'  => false
        ),
        array(
            'id'       => 'show_lang_sel',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Language Selector', 'boutique' ),
            'on'       => 'Yes',
            'off'      => 'No',
            'subtitle' => esc_html__( 'Do you want to display language selector?', 'boutique' ),
            'default'  => false
        ),
        array(
            'title'    => esc_html__( 'Show Language Selector', 'boutique' ),
            'subtitle' => esc_html__( 'Do you want to display language selector?', 'boutique' ),
            'id'       => 'wpml_lang_style',
            'type'     => 'select',
            'default'  => 'dropdown',
            'options'  => array(
              'normal'   => esc_html__( 'Normal', 'boutique' ),
              'dropdown' => esc_html__( 'Dropdown', 'boutique' )
            ),
        ),
        array(
            'title'    => esc_html__( 'WPML Language Display Style', 'boutique' ),
            'subtitle' => esc_html__( 'Choose Language Display Style', 'boutique' ),
            'id'      => 'language_style',
            'default' => 'flag',
            'type'    => 'select',
            'options' => array(
              'lang_code'      => esc_html__( 'Language Code', 'boutique' ),
              'lang_name'      => esc_html__( 'Language Name', 'boutique' ),
              'flag'           => esc_html__( 'Flag', 'boutique' ),
              'flag_with_name' => esc_html__( 'Flag With Name', 'boutique' ),
              'flag_with_code' => esc_html__( 'Flag With Language Code', 'boutique' )
            )
        ),
        array(
          'title'       => esc_html__( 'How to handle languages without translation', 'boutique' ),
          'subtitle'    => esc_html__( 'What you want to do when pages/elements not translationed for that language? Skip missing language or Link to home of language for missing translations', 'boutique' ),
          'id'      => 'skip_missing_lang',
          'default' => true,
          'type'    => 'switch',
          'on'      => esc_html__( 'Skip language', 'boutique' ),
          'off'     => esc_html__( 'Link to home of language', 'boutique' ),
        ),
      )
  ) );
  // -> START General Option
  Redux::setSection( $opt_name, array(
      'title' => esc_html__( 'General', 'boutique' ),
      'id'    => 'boutique-general',
      'customizer_width' => '400px',
      'desc'  => esc_html__( '', 'boutique' ),
      'icon'  => 'el el-home'
  ) );
  Redux::setSection( $opt_name, array(
      'title'      => esc_html__( 'General Options', 'boutique' ),
      'id'         => 'boutique-gopt',
      'subsection' => true,
      'fields'     => array(
          array(
              'id'       => 'boutique-logo',
              'type'     => 'media',
              'url'      => true,
              'title'    => esc_html__( 'Upload Logo', 'boutique' ),
              'compiler' => 'true',
              'subtitle' => esc_html__( 'Upload a custom logo. Height should be within 130px.', 'boutique' ),
              'default'  => array( 'url' => 'https://krocant.com/boutique_wp/wp-content/themes/boutique/assets/images/logo.png' ),
          ),
          array(
              'id'       => 'boutique-logo_retina',
              'type'     => 'media',
              'url'      => true,
              'title'    => esc_html__( 'Upload Retina Logo', 'boutique' ),
              'compiler' => 'true',
              'subtitle' => esc_html__( 'Upload a retina logo. width and should be double size (width X 2 & height X 2) of above (original) logo.', 'boutique' ),
              'default'  => array( 'url' => 'https://krocant.com/boutique_wp/wp-content/themes/boutique/assets/images/logo.png' ),
          ),
          array(
              'id'       => 'logo_light',
              'type'     => 'media',
              'url'      => true,
              'title'    => esc_html__( 'Upload light Logo', 'boutique' ),
              'compiler' => 'true',
              'subtitle' => esc_html__( 'Upload a custom logo light. Height should be within 130px.', 'boutique' ),
              'default'  => array( 'url' => 'https://krocant.com/boutique_wp/wp-content/themes/boutique/assets/images/logo2.png' ),
          ),
          array(
              'id'       => 'logo_lretina',
              'type'     => 'media',
              'url'      => true,
              'title'    => esc_html__( 'Upload light Retina Logo', 'boutique' ),
              'compiler' => 'true',
              'subtitle' => esc_html__( 'Upload a retina light logo. width and should be double size (width X 2 & height X 2) of above (original) logo.', 'boutique' ),
              'default'  => array( 'url' => 'https://krocant.com/boutique_wp/wp-content/themes/boutique/assets/images/logo.png' ),
          ),
          array(
              'id'       => 'sticky_hdr_logo',
              'type'     => 'media',
              'url'      => true,
              'title'    => esc_html__( 'Upload Sticky Logo', 'boutique' ),
              'compiler' => 'true',
              'subtitle' => esc_html__( 'Upload a sticky logo.', 'boutique' ),
              'default'  => array( 'url' => 'https://krocant.com/boutique_wp/wp-content/themes/boutique/assets/images/logo2.png' ),
          ),
          array(
              'id'       => 'boutique-favicon',
              'type'     => 'media',
              'title'    => esc_html__( 'Fav Icon', 'boutique' ),
              'subtitle' => esc_html__( 'Upload a 16px x 16px Png/Gif image that will represent your website favicon.', 'boutique' ),
              'default'  => array( 'url' => 'https://krocant.com/boutique_wp/wp-content/themes/boutique/assets/images/favicon.png' ),
          ),
          array(
              'id'       => 'site_preloader',
              'type'     => 'switch',
              'title'    => esc_html__( 'Enable Preloader', 'boutique' ),
              'subtitle' => esc_html__( 'Do you want to like to enable preloader?', 'boutique' ),
              'on'       => 'Yes',
              'off'      => 'No',
              'default'  => false
          ),
          array(
              'id'          => 'phonenumber',
              'type'        => 'text',
              'title'       => esc_html__( 'Phone Number', 'boutique' ),
              'subtitle'    => esc_html__( 'Put the phone number display in page.', 'boutique' ),
              'placeholder' => '(012) 345 - 6789',
          ),
          array(
              'id'       => 'boutique-responsive',
              'type'     => 'switch',
              'title'    => esc_html__('Responsive','boutique'),
              'subtitle' => esc_html__('Please choose responsive.', 'boutique'),
              'on'       => 'Yes',
              'off'      => 'No',
              'default'  => true
          ),
          array(
              'id'       => 'boutique-menu_mobile',
              'type'     => 'switch',
              'title'    => esc_html__('Menu on Mobile','boutique'),
              'subtitle' => esc_html__('Do you want to display menu on mobile?', 'boutique'),
              'on'       => 'Show',
              'off'      => 'Hide',
              'default'  => true
          ),
          array(
              'id'       => 'boutique-gtb',
              'type'     => 'switch',
              'title'    => esc_html__('Show Go to Top Button', 'boutique'),
              'on'       => 'Yes',
              'off'      => 'No',
              'subtitle' => 'Yes and No Go to Top Button in the page.',
              'default'  => true
          ),
		      array(
              'id'       => 'boutique-quick-category',
              'type'     => 'text',
              'title'    => esc_html__( 'See More Slide', 'boutique' ),
              'subtitle' => esc_html__( 'Please Enter Product Category to show Quick Shop Products On Home Page.(Separate With Comma)', 'boutique' ),
              'default'  => '',
          ),
        )
      ));
      Redux::setSection( $opt_name, array(
          'title'      => esc_html__( 'Social Network', 'boutique' ),
          'id'         => 'boutique-social-opt',
          'desc'       => esc_html__( 'Enter the url to display social networking icons you want, Leave it empty if you don&apos;t want display', 'boutique' ),
          'subsection' => true,
          'fields'     => array(
              array(
                  'id'       => 'boutique-facebook',
                  'type'     => 'text',
                  'title'    => esc_html__( 'Facebook', 'boutique' ),
                  'subtitle' => esc_html__( 'Please Enter Facebook URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-twiiter',
                  'type'     => 'text',
                  'title'    => esc_html__( 'Twitter', 'boutique' ),
                  'subtitle' => esc_html__( 'Please Enter Twitter Username, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-gplus',
                  'type'     => 'text',
                  'title'    => esc_html__( 'Google Plus URL', 'boutique' ),
                  'subtitle' => esc_html__( 'Please Enter Google Plus URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-linkedin',
                  'type'     => 'text',
                  'title'    => esc_html__( 'LinkedIn URL', 'boutique' ),
                  'subtitle' => esc_html__( 'Enter your full linkedIn URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-insta',
                  'type'     => 'text',
                  'title'    => esc_html__( 'Instagram URL', 'boutique' ),
                  'subtitle' => esc_html__( 'Enter your full instagram URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-flicker',
                  'type'     => 'text',
                  'title'    => esc_html__( 'Flickr URL', 'boutique' ),
                  'subtitle' => esc_html__( 'Enter your full flickr URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-pinterest',
                  'type'     => 'text',
                  'title'    => esc_html__( 'Pinterest URL', 'boutique' ),
                  'subtitle' => esc_html__( 'Enter your full pinterest URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-youtube',
                  'type'     => 'text',
                  'title'    => esc_html__( 'YouTube URL', 'boutique' ),
                  'subtitle' => esc_html__( 'Enter your full youtube URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
              array(
                  'id'       => 'boutique-vimeo',
                  'type'     => 'text',
                  'title'    => esc_html__( 'Vimeo URL', 'boutique' ),
                  'subtitle' => esc_html__( 'Enter your full vimeo URL, This will display in footer.', 'boutique' ),
                  'default'  => '',
              ),
            )
        ));
        Redux::setSection( $opt_name, array(
          'title'      => esc_html__( 'Custom Scripts', 'boutique' ),
          'id'         => 'boutique-custom-scrpt',
          'subsection' => true,
          'fields'     => array(
            array(
                'id'       => 'boutique-editor-css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom CSS', 'boutique' ),
                'subtitle' => esc_html__( 'Type your custom CSS rules.', 'boutique' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => "/*#header{\n margin: 0 auto;\n}*/"
            ),
            array(
                'id'       => 'editor-footer-js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS below Footer', 'boutique' ),
                'subtitle' => esc_html__( 'Type your footer custom JS.', 'boutique' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => "/*jQuery(document).ready(function(){\n\n});*/"
            ),
          )
        ));

        if ( class_exists( 'WooCommerce' ) ) {

        // -> START Shop Option
        Redux::setSection( $opt_name, array(
            'title'             =>  esc_html__( 'Shop', 'boutique' ),
            'id'                =>  'boutique-shop',
            'desc'              =>  esc_html__( '', 'boutique' ),
            'customizer_width'  =>  '400px',
            'icon'              =>  'el el-shopping-cart'
        ) );
        Redux::setSection( $opt_name, array(
            'title'       => esc_html__( 'Shop Page', 'boutique' ),
            'id'          => 'boutique-shoppage',
            'subsection'  => true,
            'fields'      => array(
                array(
                    'id'       => 'boutique-cart_opt',
                    'type'     => 'switch',
                    'title'    => esc_html__('Cart Button', 'boutique'),
                    'subtitle' => esc_html__('Do you want to display Cart Button?', 'boutique'),
                    'on'       => 'Show',
                    'off'      => 'Hide',
                    'default'  => true,
                ),
                array(
                    'id'       => 'boutique-shop_layout',
                    'type'     => 'radio',
                    'title'    => esc_html__( 'Shop layout', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose shop page layout. Boxed = max footer width is 1200px; Wide = page covers the viewport.', 'boutique' ),
                    'options'  => array(
                        'wide' => 'Wide',
                        'box'  => 'Boxed'
                    ),
                    'default'  => 'box'
                ),
                array(
                    'id'       => 'boutique-shop_style',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Page Style', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose shop page style', 'boutique' ),
                    'options'  => array(
                        'style1' => '4 Column',
                        'style2' => '3 Column',
                        'style3' => '2 Column',
                        'style4' => '6 Column'
                    ),
                    'default'  => 'style1'
                ),
                array(
                  'id'       => 'display_shoppage_banner',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Display Banner', 'boutique' ),
                  'on'       => esc_html__( 'Show', 'boutique' ),
                  'off'      => esc_html__( 'Hide', 'boutique' ),
                  'subtitle' => esc_html__( 'Display Shop page banner', 'boutique' ),
                  'default'  => false
                ),
                array(
                  'id'       => 'shopbanner',
                  'type'     => 'media',
                  'url'      => true,
                  'title'    => esc_html__('Shop Banner image', 'boutique'),
                  'desc'     => esc_html__('Use image size 1920x500.', 'boutique'),
                  'subtitle' => esc_html__('Upload image to display in shop page', 'boutique'),
                  'default'  => array(
                      'url'=>'https://dummyimage.com/1920x500.jpg'
                  ),
                  'required' => array( 'display_shoppage_banner', '=', true )
                ),
                array(
                    'id'       => 'boutique-shop_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Page Sidebar', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose shop page sidebar position, it applies shop page only.', 'boutique' ),
                    'options'  => array(
                        'left-sidebar'  => 'Left Sidebar',
                        'right-sidebar' => 'Right Sidebar',
                        'full-width'    => 'Full Width',
                    ),
                    'default'  => 'full-width'
                ),
                array(
                  'id'          => 'boutique-shop_count',
                  'type'        => 'text',
                  'title'       => esc_html__( 'Number of Products', 'boutique' ),
                  'subtitle'    => esc_html__( 'How many products you want to display per page?', 'boutique' ),
                  'placeholder' => 'Number of Products',
                  'default'     => 9,
                ),
              ),
            ));
            Redux::setSection( $opt_name, array(
              'title'       => esc_html__( 'Shop Single Page', 'boutique' ),
              'id'          => 'boutique-snproduct',
              'subsection'  => true,
              'fields'      => array(
                array(
                    'id'       => 'snprd_design',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Single page style', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose single product page style.', 'boutique' ),
                    'options'  => array(
                          'sn_style_1' => array(
                              'alt'   => 'Style 1',
                              'img'   => ReduxFramework::$_url . 'assets/img/spp_style1.jpg'
                          ),
                          'sn_style_2' => array(
                              'alt' => 'Style 2',
                              'img' => ReduxFramework::$_url . 'assets/img/spp_style2.jpg'
                          ),
                          'sn_style_3' => array(
                              'alt' => 'Style 3',
                              'img' => ReduxFramework::$_url . 'assets/img/spp_style3.jpg'
                          ),
                    ),
                    'default'  => 'sn_style_1'
                ),
                array(
                    'id'       => 'boutique-snprd_layout',
                    'type'     => 'radio',
                    'title'    => esc_html__( 'Single page layout', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose single product page layout. Boxed = max footer width is 1200px; Wide = page covers the viewport.', 'boutique' ),
                    'options'  => array(
                        'wide' => 'Wide',
                        'box'  => 'Boxed'
                    ),
                    'default'  => 'box'
                ),
                array(
                    'id'       => 'buwoo_show_bdrm',
                    'type'     => 'switch',
                    'title'    => esc_html__('Display Breadcumb', 'boutique'),
                    'subtitle' => esc_html__('Display Breadcumb on single page.', 'boutique'),
                    'on'       => 'Show',
                    'off'      => 'Hide',
                    'default'  => true,
                ),
                array(
                  'id'       => 'display_singleshop_banner',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Display Banner', 'boutique' ),
                  'on'       => esc_html__( 'Show', 'boutique' ),
                  'off'      => esc_html__( 'Hide', 'boutique' ),
                  'subtitle' => esc_html__( 'Display Single page banner', 'boutique' ),
                  'default'  => false
                ),

                array(
                  'id'       => 'singleshopbanner',
                  'type'     => 'media',
                  'url'      => true,
                  'title'    => esc_html__('Banner image', 'boutique'),
                  'desc'     => esc_html__('Use image size 1920x500.', 'boutique'),
                  'subtitle' => esc_html__('Upload image to display in single shop page', 'boutique'),
                  'default'  => array(
                      'url'=>'https://dummyimage.com/1920x500.jpg'
                  ),
                  'required' => array( 'display_shop_banner', '=', true )
                ),
                array(
                    'id'       => 'boutique-single_shop_sidebar',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Single Shop Sidebar Position', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose single shop page sidebar position, it applies single shop page only.', 'boutique' ),
                    'options'  => array(
                        'left-sidebar'  => 'Left Sidebar',
                        'right-sidebar' => 'Right Sidebar',
                        'full-width'    => 'Full Width',
                    ),
                    'default'  => 'full-width'
                ),
                array(
                    'id'       => 'boutique-related_products',
                    'type'     => 'switch',
                    'title'    => esc_html__('Related Products', 'boutique'),
                    'subtitle' => esc_html__('Display related products on single page.', 'boutique'),
                    'on'       => 'Show',
                    'off'      => 'Hide',
                    'default'  => true,
                ),
              ),
            ));
          }

            // -> START Blog Option
        Redux::setSection( $opt_name, array(
            'title' => esc_html__( 'Blog', 'boutique' ),
            'id'    => 'boutique-blog',
            'desc'  => esc_html__( '', 'boutique' ),
            'customizer_width' => '400px',
            'icon'  => 'el el-list-alt',
            'fields'     => array(
                array(
                    'id'       => 'boutique-recent-post',
                    'type'     => 'switch',
                    'title'    => 'Display recent posts',
                    'on'       => 'Yes',
                    'off'      => 'No',
                    'subtitle' => 'Do you want to display recent posts?',
                    'default'  => false
                ),
                array(
                    'id'       => 'boutique-banner-big',
                    'type'     => 'switch',
                    'title'    => 'Display Banner',
                    'on'       => 'Yes',
                    'off'      => 'No',
                    'subtitle' => 'Do you want to display banner?',
                    'default'  => false
                ),
                array(
                  'id'       => 'archive-banner',
                  'type'     => 'media',
                  'url'      => true,
                  'title'    => esc_html__('Archive Banner image', 'boutique'),
                  'desc'     => esc_html__('Use image size 1920x500.', 'boutique'),
                  'subtitle' => esc_html__('Upload image to display in archive pages', 'boutique'),
                  'default'  => array(
                      'url'=>'https://dummyimage.com/1920x500.jpg'
                  ),
                ),

                array(
                    'id'       => 'boutique-single_layout',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Single post layout', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose single post page layout.', 'boutique' ),
                    'options'  => array(
                        'left-sidebar'  => 'Left Sidebar',
                        'right-sidebar' => 'Right Sidebar',
                        'full-width'    => 'Full Width',
                    ),
                    'default'  => 'full-width'
                ),
              ),
            ));

                // -> START 404 Option
        Redux::setSection( $opt_name, array(
            'title' => esc_html__( '404', 'boutique' ),
            'id'    => 'boutique-404',
            'desc'  => esc_html__( '', 'boutique' ),
            'customizer_width' => '400px',
            'icon'  => 'el el-warning-sign',
            'fields'     => array(
                array(
                    'id'       => 'boutique-bner404',
                    'type'     => 'switch',
                    'title'    => 'Display Banner',
                    'on'       => 'Yes',
                    'off'      => 'No',
                    'subtitle' => 'Do you want to display banner?',
                    'default'  => false
                ),
                array(
                  'id'       => 'b404-banner',
                  'type'     => 'media',
                  'url'      => true,
                  'title'    => esc_html__('404 Banner image', 'boutique'),
                  'desc'     => esc_html__('Use image size 1920x500.', 'boutique'),
                  'subtitle' => esc_html__('Upload image to display in 404 page', 'boutique'),
                  'default'  => array(
                      'url'=>'https://dummyimage.com/1920x500.jpg'
                  ),
                ),
              ),
            ));


        // -> START Footer Option
        Redux::setSection( $opt_name, array(
            'title' => esc_html__( 'Footer', 'boutique' ),
            'id'    => 'boutique-footer',
            'desc'  => esc_html__( '', 'boutique' ),
            'customizer_width' => '400px',
            'icon'  => 'el el-website-alt',
            'fields'     => array(
                array(
                    'id'       => 'boutique-ftlg',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => esc_html__( 'Upload Logo', 'boutique' ),
                    'compiler' => 'true',
                    'subtitle' => esc_html__( 'Upload a custom logo. Height should be within 116px.', 'boutique' ),
                    'default'  => array( 'url' => 'https://krocant.com/boutique_wp/wp-content/themes/boutique/assets/images/footer-logo.png' ),
                ),
                array(
                    'id'       => 'footer-layout',
                    'type'     => 'radio',
                    'title'    => esc_html__('Footer Layout Style.', 'boutique'),
                    'subtitle' => esc_html__('Choose Footer Layout. Boxed = max footer width is 1200px; Wide = footer covers the viewport.', 'boutique'),
                    'options'  => array(
                        'full' => 'Wide',
                        'box'  => 'Boxed'
                    ),
                    'default'  => 'box',
                ),
                array(
                    'id'       => 'boutique-footer-style',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Footer style', 'boutique' ),
                    'subtitle' => esc_html__( 'Choose footer style.', 'boutique' ),
                    //Must provide key => value(array:title|img) pairs for radio options
                    'options'  => array(
                        'footer1' => array(
                            'alt' => 'Style 1',
                            'img' => ReduxFramework::$_url . 'assets/img/footer1.jpg'
                        ),
                        'footer2' => array(
                            'alt' => 'Style 2',
                            'img' => ReduxFramework::$_url . 'assets/img/footer2.jpg'
                        ),
                        'footer3' => array(
                            'alt' => 'Style 3',
                            'img' => ReduxFramework::$_url . 'assets/img/footer3.jpg'
                        ),
                        'footer4' => array(
                            'alt' => 'Style 4',
                            'img' => ReduxFramework::$_url . 'assets/img/footer4.jpg'
                        ),
                        'footer5' => array(
                            'alt' => 'Style 5',
                            'img' => ReduxFramework::$_url . 'assets/img/footer5.jpg'
                        ),
                        'footer6' => array(
                            'alt' => 'Style 6',
                            'img' => ReduxFramework::$_url . 'assets/img/footer6.jpg'
                        ),
                    ),
                    'default'  => 'footer1'
                ),
              )
            ));

          // START TYPOGRAPHY
          Redux::setSection( $opt_name, array(
            'title' => esc_html__( 'Typography', 'boutique' ),
            'id'    => 'boutique-typography',
            'desc'  => esc_html__( '', 'boutique' ),
            'customizer_width' => '400px',
            'icon'  => 'el el-font',
            'fields'     => array(
                array(
                  'id'          =>  'body_fonts',
                  'type'        =>  'typography',
                  'title'       =>  esc_html__('Body Fonts', 'boutique'),
                  'google'      =>  true,
                  'font-backup' =>  true,
                  'color'       =>  false,
                  'output'      =>  array('body','a','li','p','button','blockquote','input','textarea','span','header','footer','article','section','ol','ul','h4','h5','h6','label','form','iframe','address','b','u','strong','table','caption','nav','audio','video','sub','sup','summary','tr','th','td',),
                  'units'       =>  'px',
                  'subtitle'    =>  esc_html__('Choose google webfont and Fallback fonts (incase google webfonts not loaded, fallback websafe fonts will apply). This font will for body texts.', 'boutique'),
                  'default'     => array(
                      'font-style'  => '600',
                      'font-family' => 'Open Sans',
                      'google'      => true,
                      'font-size'   => '15px',
                      'line-height' => '30px',
                      'subsets'     => 'Latin',
                  ),
                  'preview' => array(
                    'always_display'  =>  true,
                    'font-size'       =>  '33px',
                  ),
                ),
                array(
                  'id'          =>  'primary_fonts',
                  'type'        =>  'typography',
                  'title'       =>  esc_html__('Primary Fonts', 'boutique'),
                  'google'      =>  true,
                  'font-backup' =>  true,
                  'font-size'   =>  false,
                  'line-height' =>  false,
                  'color'       =>  false,
                  'subsets'     =>  false,
                  'text-align'  =>  false,
                  'output'      =>  array('h1','h2','h3'),
                  'units'       =>  'px',
                  'subtitle'    =>  esc_html__('Choose google webfont and Fallback fonts (incase google webfonts not loaded, fallback websafe fonts will apply). This font will apply for Headings, main menu, Titles etc.', 'boutique'),
                  'default'     => array(
                      'font-style'  => '600',
                      'font-family' => 'Playfair Display',
                      'google'      => true,
                  ),
                  'preview' => array(
                    'always_display'  =>  true,
                    'font-size'       =>  '33px',
                  ),
                ),
                array(
                  'id'          => 'content_fonts',
                  'type'        => 'typography',
                  'title'       => esc_html__('Content Fonts', 'boutique'),
                  'font-backup' =>  true,
                  'font-size'   =>  false,
                  'font-style'  =>  false,
                  'line-height' =>  false,
                  'color'       =>  false,
                  'subsets'     =>  false,
                  'text-align'  =>  false,
                  'output'      => array('p','li','blockquote','a','select','input'),
                  'units'       =>'px',
                  'subtitle'    => esc_html__('Choose google webfont and Fallback fonts (incase google webfonts not loaded, fallback websafe fonts will apply). This font will apply for most of the sections in the theme including paragraph, lists, blockquote, testimonial, sub menu etc.', 'boutique'),
                  'default'     => array(
                      'font-family' => 'Open Sans',
                      'google'      => true,
                  ),
                  'preview' => array(
                    'always_display'  =>  true,
                    'font-size'       =>  '33px',
                  ),
                ),
              )
          ));
          Redux::setSection( $opt_name, array(
              'title'            => esc_html__( 'Styling Options', 'boutique' ),
              'id'               => 'boutique-style_opt',
              'desc'             => esc_html__( '', 'boutique' ),
              'customizer_width' => '400px',
              'icon'             => 'el el-magic'
          ) );
          Redux::setSection( $opt_name, array(
              'title'            => __( 'General', 'boutique' ),
              'id'               => 'general_styles',
              'subsection'       => true,
              'customizer_width' => '450px',
              'fields'           => array(
                array(
                  'id'       => 'custom_styles',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Custom Styles', 'boutique' ),
                  'on'       => esc_html__( 'Yes', 'boutique' ),
                  'off'      => esc_html__( 'No', 'boutique' ),
                  'subtitle' => esc_html__( 'Do you like to use Custom Styles, Please enable it and choose the Background color, Primary color, Selection text color, selection background color, link hover color. If it\'s disabled, the default style will apply and custom styles are won\'t apply.', 'boutique' ),
                  'default'  => false
                ),
                array(
                  'id'       => 'body_bg_clr',
                  'type'     => 'color',
                  'title'    => __( 'Body Background Color', 'boutique' ),
                  'subtitle' => __( 'This is the default Body background color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'body_clr',
                  'type'     => 'color',
                  'title'    => __( 'Body Color', 'boutique' ),
                  'subtitle' => __( 'This is the default content color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'link_clr',
                  'type'     => 'color',
                  'title'    => __( 'Link Color', 'boutique' ),
                  'subtitle' => __( 'This is the default link color.', 'boutique' ),
                  'default'  => '#86c0cc',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'link_hover_clr',
                  'type'     => 'color',
                  'title'    => __( 'Link Hover Color', 'boutique' ),
                  'subtitle' => __( 'This is the default link hover color.', 'boutique' ),
                  'default'  => '#50a4b5',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'selection_text_clr',
                  'type'     => 'color',
                  'title'    => __( 'Selection Text Color', 'boutique' ),
                  'subtitle' => __( 'This is the text color when selecting the text.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'selection_bg_clr',
                  'type'     => 'color',
                  'title'    => __( 'Selection Text Background Color', 'boutique' ),
                  'subtitle' => __( 'This is the text background color when selecting the text.', 'boutique' ),
                  'default'  => '#86c0cc',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),

                array(
                  'id'       => 'scrolltotop_bg',
                  'type'     => 'color',
                  'title'    => __( 'Scroll to Top Background', 'boutique' ),
                  'subtitle' => __( 'This is the button background color.', 'boutique' ),
                  'default'  => '#86c0cc',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'scrolltotop_clr',
                  'type'     => 'color',
                  'title'    => __( 'Scroll to Top Text', 'boutique' ),
                  'subtitle' => __( 'This is the button text color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'scrolltotop_bg_hover',
                  'type'     => 'color',
                  'title'    => __( 'Scroll to Top Hover Background', 'boutique' ),
                  'subtitle' => __( 'This is the button hover background color.', 'boutique' ),
                  'default'  => '#19353a',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
                array(
                  'id'       => 'scrolltotop_clr_hover',
                  'type'     => 'color',
                  'title'    => __( 'Scroll to Top Hover Text', 'boutique' ),
                  'subtitle' => __( 'This is the button hover text color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles', '=', true )
                ),
              )
          ) );
          Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Header', 'boutique' ),
            'id'         => 'header_opt',
            'subsection' => true,
            'fields'     => array(
              array(
                  'id'       => 'custom_styles_header',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Custom Styles', 'boutique' ),
                  'on'       => esc_html__( 'Yes', 'boutique' ),
                  'off'      => esc_html__( 'No', 'boutique' ),
                  'subtitle' => esc_html__( 'Do you like to use Custom Styles, Please enable it and choose the Background color, Primary color, Selection text color, selection background color, link hover color. If it\'s disabled, the default style will apply and custom styles are won\'t apply.', 'boutique' ),
                  'default'  => false
              ),
              array(
                'id'       => 'section-one-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Top header bar Styling Options.', 'boutique' ),
                'subtitle' => '',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
              array(
                  'id'       => 't_header_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Top Header Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the top header background color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 't_header_txt_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Top Header Text Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the top header color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 't_header_link_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Top Header Link Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the top header link color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 't_header_lhover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Top Header Link Hover Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the top header link hover color.', 'boutique' ),
                  'default'  => '#50a4b5',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                'id'     => 'section-one-end',
                'type'   => 'section',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),

              array(
                'id'       => 'section-two-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Main Header', 'boutique' ),
                'subtitle' => '',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
              array(
                  'id'       => 'header_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Header Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the header background color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'header_txt_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Header Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the header color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'header_link_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Header Link Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the header link color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'header_lhover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Header Link Hover Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the header link hover color.', 'boutique' ),
                  'default'  => '#50a4b5',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'header_link_bg_hover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Header Link Hover Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the header link hover background color.', 'boutique' ),
                  'default'  => 'transparent',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                'id'     => 'section-two-end',
                'type'   => 'section',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),

              array(
                'id'       => 'section-third-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Menu', 'boutique' ),
                'subtitle' => '',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
              array(
                  'id'       => 'menu_text_transform',
                  'type'     => 'select',
                  'title'    => esc_html__( 'Menu Text Transform', 'boutique' ),
                  'subtitle' => esc_html__( 'Choose Menu Text Transform. Uppercase = text in all capital letters;<br> Lowercase = text in all small letters;<br> Capitalize = first letter only capital letter.', 'boutique' ),
                  'options'  => array(
                    'capitalize'  => 'Capitalize',
                    'uppercase'   => 'Uppercase',
                    'lowercase'   => 'Lowercase',
                  ),
                  'default'  => 'capitalize',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'sub_menu_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Sub Menu Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the sub menu background color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'sub_menu_link_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Sub Menu Link Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the sub menu link color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'sub_menu_bg_hover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Sub Menu Hover Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the sub menu hover background color.', 'boutique' ),
                  'default'  => '#86c0cc',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'sub_menu_lhover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Header Link Hover Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the sub menu link hover color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),

              array(
                  'id'       => 'sticky_bg_clr',
                  'type'     => 'color_rgba',
                  'title'    => esc_html__( 'Sticky Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the sticky background color.', 'boutique' ),
                  'default'  => array(
                      'color' => '#a9a9a9',
                      'alpha' => '.8'
                    ),
                  'output'   => array( 'background-color' => '.sticky_bg' ),
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'sticky_link_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Sticky Link Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the sticky link color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'sticky_lhover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Sticky Link Hover Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the sticky link hover color and active color.', 'boutique' ),
                  'default'  => '#86c0cc',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),




              array(
                'id'     => 'section-third-end',
                'type'   => 'section',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),

              array(
                'id'       => 'section-four-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Mega Menu', 'boutique' ),
                'subtitle' => '',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
                array(
                    'id'       => 'mega_menu_title_clr',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Mega Menu Title Color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the mega menu title color.', 'boutique' ),
                    'default'  => '#252525',
                    'validate' => 'color',
                    'required' => array( 'custom_styles_header', '=', true )
                ),
                array(
                  'id'       => 'mega_menu_text_transform',
                  'type'     => 'select',
                  'title'    => esc_html__( 'Mega Menu Text Transform', 'boutique' ),
                  'subtitle' => esc_html__( 'Choose Mega Menu Text Transform. Uppercase = text in all capital letters;<br> Lowercase = text in all small letters;<br> Capitalize = first letter only capital letter.', 'boutique' ),
                  'options'  => array(
                    'capitalize'  => 'Capitalize',
                    'uppercase'   => 'Uppercase',
                    'lowercase'   => 'Lowercase',
                  ),
                  'default'  => 'capitalize',
                  'required' => array( 'custom_styles_header', '=', true )
                ),
                array(
                    'id'       => 'mega_menu_bg_clr',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Mega Menu Background Color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the mega menu background color.', 'boutique' ),
                    'default'  => '#ffffff',
                    'validate' => 'color',
                    'required' => array( 'custom_styles_header', '=', true )
                ),
                array(
                    'id'       => 'mega_menu_link_clr',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Mega Menu Link Color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is mega sub menu link color.', 'boutique' ),
                    'default'  => '#252525',
                    'validate' => 'color',
                    'required' => array( 'custom_styles_header', '=', true )
                ),
                array(
                    'id'       => 'mega_menu_lhover_clr',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Mega Menu Link Hover Color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the mega menu link hover color.', 'boutique' ),
                    'default'  => '#86c0cc',
                    'validate' => 'color',
                    'required' => array( 'custom_styles_header', '=', true )
                ),
              array(
                'id'     => 'section-four-end',
                'type'   => 'section',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),

              array(
                'id'       => 'section-five-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Hambarger Icon', 'boutique' ),
                'subtitle' => '',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
              array(
                  'id'       => 'hambarger_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Hambarger Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the hambarger background color.', 'boutique' ),
                  'default'  => 'transparent',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'hambarger_link_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Hambarger Link Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the hambarger link color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'hambarger_link_hover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Hambarger Link Hover Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the hambarger link hover color and active color.', 'boutique' ),
                  'default'  => '',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                  'id'       => 'hambarger_hover_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Hambarger Hover Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the hambarger hover background color and active color.', 'boutique' ),
                  'default'  => '',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_header', '=', true )
              ),
              array(
                'id'     => 'section-five-end',
                'type'   => 'section',
                'required' => array( 'custom_styles_header', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),
            )
          ) );
          Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Mobile Menu', 'boutique' ),
            'id'         => 'mob_menu',
            'subsection' => true,
            'fields'     => array(
              array(
                  'id'       => 'custom_styles_mob_nav',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Custom Styles', 'boutique' ),
                  'on'       => esc_html__( 'Yes', 'boutique' ),
                  'off'      => esc_html__( 'No', 'boutique' ),
                  'subtitle' => esc_html__( 'Do you like to use Custom Styles, Please enable it and choose the Background color, Primary color, Selection text color, selection background color, link hover color. If it\'s disabled, the default style will apply and custom styles are won\'t apply.', 'boutique' ),
                  'default'  => false
              ),
              array(
                  'id'       => 'mob_headr_bg_clr',
                  'type'     => 'color',
                  'title'    => __( 'Mobile Header Background Color', 'boutique' ),
                  'subtitle' => __( 'This is the mobile header background color.', 'boutique' ),
                  'default'  => '#f5f5f5',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_mob_nav', '=', true )
              ),
              array(
                  'id'       => 'mob_menu_bg_clr',
                  'type'     => 'color',
                  'title'    => __( 'Mobile Menu Background Color', 'boutique' ),
                  'subtitle' => __( 'This is the mobile menu background color.', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_mob_nav', '=', true )
              ),
              array(
                  'id'       => 'mob_menu_text_clr',
                  'type'     => 'color',
                  'title'    => __( 'Mobile Menu Text Color', 'boutique' ),
                  'subtitle' => __( 'This is the mobile menu text color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_mob_nav', '=', true )
              ),
              array(
                  'id'       => 'mob_menu_hover_bg_clr',
                  'type'     => 'color',
                  'title'    => __( 'Mobile Menu Hover background Color', 'boutique' ),
                  'subtitle' => __( 'This is the mobile menu hover background color.', 'boutique' ),
                  'default'  => 'transparent',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_mob_nav', '=', true )
              ),
              array(
                  'id'       => 'mob_menu_lhover_clr',
                  'type'     => 'color',
                  'title'    => __( 'Mobile Menu Text Hover Color', 'boutique' ),
                  'subtitle' => __( 'This is the mobile menu hover color.', 'boutique' ),
                  'default'  => '#86c0cc',
                  'validate' => 'color',
                  'required' => array( 'custom_styles_mob_nav', '=', true )
              ),
            )
          ) );
          Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Title Bar', 'boutique' ),
            'id'         => 'title_bar',
            'subsection' => true,
            'fields'     => array(
              array(
                  'id'       => 'custom_title_bar_styles',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Title Bar Style', 'boutique' ),
                  'on'       => esc_html__( 'Custom', 'boutique' ),
                  'off'      => esc_html__( 'Default', 'boutique' ),
                  'subtitle' => esc_html__( 'Select title bar style', 'boutique' ),
                  'default'  => false
              ),
              array(
                  'id'       => 'title_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Title bar background color', 'boutique' ),
                  'subtitle' => esc_html__( 'It applies title bar background color', 'boutique' ),
                  'default'  => '',
                  'validate' => 'color',
                  'required' => array( 'custom_title_bar_styles', '=', true )
              ),
              array(
                  'id'       => 'title_bg_img',
                  'type'     => 'media',
                  'url'      => true,
                  'title'    => esc_html__( 'Upload Title bar background image', 'boutique' ),
                  'subtitle' => esc_html__( 'It applies title bar background image.', 'boutique' ),
                  'compiler' => 'true',
                  'default'  => '',
                  'required' => array( 'custom_title_bar_styles', '=', true )
              ),
              array(
                  'id'       => 'title_overlay_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Overlay Gradient Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the overlay background color.', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_title_bar_styles', '=', true )
              ),
              array(
                  'id'       => 'title_overlay_opacity',
                  'type'     => 'slider',
                  'title'    => esc_html__( 'Overlay Gradient Opacity', 'boutique' ),
                  'subtitle' => esc_html__( 'Type the alpha value. Eg: 0.1 to 1.0', 'boutique' ),
                  'default'  => .6,
                  "min"      => 0,
                  "step"     => .1,
                  "max"      => 1,
                  'resolution' => 0.1,
                  'display_value' => 'text',
                  'required' => array( 'custom_title_bar_styles', '=', true )
              ),
              array(
                  'id'       => 'title_text_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Title bar text color', 'boutique' ),
                  'subtitle' => esc_html__( 'It applies title bar text color', 'boutique' ),
                  'default'  => '#000',
                  'validate' => 'color',
                  'required' => array( 'custom_title_bar_styles', '=', true )

              ),
              array(
                  'id'       => 'breadcumb_bg_clr',
                  'type'     => 'color',
                  'title'    => __( 'Breadcumb Background Color', 'boutique' ),
                  'subtitle' => __( 'This is the breadcumb background color.', 'boutique' ),
                  'default'  => '#f5f5f5',
                  'validate' => 'color',
                  'required' => array( 'custom_title_bar_styles', '=', true )
                ),
                array(
                  'id'       => 'breadcumb_text_clr',
                  'type'     => 'color',
                  'title'    => __( 'Breadcumb Text Color', 'boutique' ),
                  'subtitle' => __( 'This is the text color.', 'boutique' ),
                  'default'  => '#111111',
                  'validate' => 'color',
                  'required' => array( 'custom_title_bar_styles', '=', true )
                ),
            )
          ) );

          Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Shop', 'boutique' ),
            'id'         => 'shop_style',
            'subsection' => true,
            'fields'     => array(
              array(
                  'id'       => 'custom_shop_styles',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Choose Shop Custom Style', 'boutique' ),
                  'on'       => esc_html__( 'Yes', 'boutique' ),
                  'off'      => esc_html__( 'No', 'boutique' ),
                  'subtitle' => esc_html__( 'Do you want to customize the shop appearance?', 'boutique' ),
                  'default'  => false
              ),

              array(
                'id'       => 'section-one-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Product Color', 'boutique' ),
                'subtitle' => esc_html__( 'Set the product color', 'boutique' ),
                'required' => array( 'custom_shop_styles', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
                array(
                    'id'       => 'title_pd_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Product Title Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Set the product title color and related product title color.', 'boutique' ),
                    'default'  => '#000000',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'price_txt_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Price Color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the price color', 'boutique' ),
                    'default'  => '#a5a5a5',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'atc_button_text_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart text color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the add to cart button text color', 'boutique' ),
                    'default'  => '#000',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'atc_button_bg_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart background color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the add to cart button background color', 'boutique' ),
                    'default'  => '#ffb700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'atc_button_text_hover_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart text hover color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the add to cart button text hover color', 'boutique' ),
                    'default'  => '#000',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'atc_button_bg_hover_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart background hover color', 'boutique' ),
                    'subtitle' => esc_html__( 'This is the add to cart button background hover color', 'boutique' ),
                    'default'  => '#ffb700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'label_sale_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Sale Label background color', 'boutique' ),
                    'subtitle' => esc_html__( 'Set the label background color', 'boutique' ),
                    'default'  => '#ffb700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'label_soldout_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Out of Stock Label background color', 'boutique' ),
                    'subtitle' => esc_html__( 'Set the label background color', 'boutique' ),
                    'default'  => '#F2702E',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'btn_radius',
                    'type'     => 'slider',
                    'title'    => __('Select the button radius', 'boutique'),
                    'subtitle' => __('This button radius all over the shop.', 'boutique'),
                    "default"  => 6,
                    "min"      => 0,
                    "step"     => 1,
                    "max"      => 100,
                    'display_value' => 'text',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
              array(
                'id'     => 'section-one-end',
                'type'   => 'section',
                'required' => array( 'custom_shop_styles', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),
              array(
                'id'       => 'section-two-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Shop Sidebar color', 'boutique' ),
                'subtitle' => '',
                'required' => array( 'custom_shop_styles', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
                array(
                    'id'       => 'sidebar_title_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Sidebar Title Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the sidebar widget title color.', 'boutique' ),
                    'default'  => '#000000',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'price_slide_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Price Rang Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the sidebar widget title color.', 'boutique' ),
                    'default'  => '#FFB700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'attributes_item_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Attributes Item Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the attributes items color eg: categories, size, color.', 'boutique' ),
                    'default'  => '#000000',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'attributes_itemhover_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Attributes Item hover Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the attributes items hover color eg: categories, size, color.', 'boutique' ),
                    'default'  => '#FFB700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
              array(
                'id'     => 'section-two-end',
                'type'   => 'section',
                'required' => array( 'custom_shop_styles', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),
              array(
                'id'       => 'section-three-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Shop Single Product', 'boutique' ),
                'subtitle' => '',
                'required' => array( 'custom_shop_styles', '=', true ),
                'indent'   => true, // Indent all options below until the next 'section' option is set.
              ),
                array(
                    'id'       => 'sp_title_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Product Title Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the product title color.', 'boutique' ),
                    'default'  => '#000000',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'sp_price_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Product Price Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the product price and category color.', 'boutique' ),
                    'default'  => '#FFB700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'sp_button_text_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart Color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the button text color.', 'boutique' ),
                    'default'  => '#ffffff',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'sp_button_texthover_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart hover', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the button text hover color.', 'boutique' ),
                    'default'  => '#FFB700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'sp_button_bg_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart background color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the button background color.', 'boutique' ),
                    'default'  => '#000000',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
                array(
                    'id'       => 'sp_button_bg_hover_clr',
                    'type'     => 'color',
                    'compiler' => 'true',
                    'title'    => esc_html__( 'Add to cart background hover color', 'boutique' ),
                    'subtitle' => esc_html__( 'Change the button background hover color.', 'boutique' ),
                    'default'  => '#FFB700',
                    'validate' => 'color',
                    'required' => array( 'custom_shop_styles', '=', true )
                ),
              array(
                'id'     => 'section-three-end',
                'type'   => 'section',
                'required' => array( 'custom_shop_styles', '=', true ),
                'indent' => false, // Indent all options below until the next 'section' option is set.
              ),
            )
          ) );

          Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Footer', 'boutique' ),
            'id'         => 'footer_style',
            'subsection' => true,
            'fields'     => array(
              array(
                  'id'       => 'custom_footer_styles',
                  'type'     => 'switch',
                  'title'    => esc_html__( 'Choose Footer Custom Style', 'boutique' ),
                  'on'       => esc_html__( 'Yes', 'boutique' ),
                  'off'      => esc_html__( 'No', 'boutique' ),
                  'subtitle' => esc_html__( 'Do you want to customize the footer appearance?', 'boutique' ),
                  'default'  => false
              ),

              array(
                  'id'       => 'ft_bg_clr',
                  'type'     => 'color',
                  'compiler' => 'true',
                  'title'    => esc_html__( 'Footer Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the footer background color', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
              array(
                  'id'       => 'ft_title_clr',
                  'type'     => 'color',
                  'compiler' => 'true',
                  'title'    => esc_html__( 'Footer Title Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the footer title color', 'boutique' ),
                  'default'  => '#000',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
              array(
                  'id'       => 'ft_text_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Footer Text Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the footer text color', 'boutique' ),
                  'default'  => '#999999',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
              array(
                  'id'       => 'ft_link_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Footer Link Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the footer link color', 'boutique' ),
                  'default'  => '#999',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
              array(
                  'id'       => 'ft_link_hover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Footer Link Hover Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the footer link hover color', 'boutique' ),
                  'default'  => '#50a4b5',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),

              array(
                  'id'       => 'cp_bg_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Copyright Background Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the copyright background color', 'boutique' ),
                  'default'  => '#ffffff',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
              array(
                  'id'       => 'cp_text_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Copyright Text Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the copyright text color', 'boutique' ),
                  'default'  => '',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
              array(
                  'id'       => 'cp_link_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Copyright Link Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the copyright link color', 'boutique' ),
                  'default'  => '#252525',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
              array(
                  'id'       => 'cp_link_hover_clr',
                  'type'     => 'color',
                  'title'    => esc_html__( 'Copyright Link Hover Color', 'boutique' ),
                  'subtitle' => esc_html__( 'This is the copyright link hover color', 'boutique' ),
                  'default'  => '#86c0cc',
                  'validate' => 'color',
                  'required' => array( 'custom_footer_styles', '=', true )
              ),
            )
          ) );


    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => esc_html__( 'Documentation', 'boutique' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field  set with compiler=>true is changed.
     * */
    //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            echo print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    // function compiler_action($options, $css, $changed_values) {
    //     global $wp_filesystem;

    //     $filename = dirname(__FILE__) . '/style.css';

    //     if( empty( $wp_filesystem ) ) {
    //         require_once( ABSPATH .'/wp-admin/includes/file.php' );
    //         WP_Filesystem();
    //     }

    //     if( $wp_filesystem ) {
    //         $wp_filesystem->put_contents(
    //             $filename,
    //             $css,
    //             FS_CHMOD_FILE // predefined mode settings for WP files
    //         );
    //     }
    // }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'boutique' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'boutique' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }
