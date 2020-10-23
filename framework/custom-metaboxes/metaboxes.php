<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category BoutiqueTheme
 * @package  Boutique
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

if ( file_exists( dirname( __FILE__ ) . '/custom-metaboxes/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/custom-metaboxes/init.php';
}

function boutique_show_if_front_page( $cmb ) {
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}
function boutique_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}
function boutique_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

function boutique_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

function boutique_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}


add_action( 'cmb2_admin_init', 'boutique_header_page_metabox' );
function boutique_header_page_metabox() {
	$prefix = 'boutique_';

	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$menu_list = array();
	$menu_list[] = 'Default';
	foreach ( $menus as $key => $slug ) {
		$menu_list[$slug->slug] = $slug->name;
	}

	$cmb_boutique = new_cmb2_box( array(
		'id'           => $prefix . 'headeroption',
		'title'        => esc_html__( 'Header Options', 'boutique' ),
		'object_types' => array( 'page' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on_cb'   => 'cbfunc',

	) );

	$cmb_boutique->add_field( array(
		'name' => esc_html__('Enable Transparent Header', 'boutique'),
		'desc' => esc_html__( 'Do you like to enable transparent header?', 'boutique' ),
		'id' => $prefix . 'transparenthdr',
		'type' => 'switch',
		'default' => 0,
		'label' => array(
							'on'=> 'Yes',
							'off'=> 'No'
						)
	));

	$cmb_boutique->add_field( array(
		'name'	=>	esc_html__('Dark or Light header', 'boutique'),
		'desc'	=>	esc_html__( 'Use dark or light Header.', 'boutique' ),
		'id' 	=>	$prefix . 'pg_logoversionz',
		'type'             => 'radio',
		'show_option_none' => false,
		'options'          => array(
			'default' 	=> __( 'Default', 'boutique' ),
			'dark'   	=> __( 'Dark', 'boutique' ),
			'light'     => __( 'Light', 'boutique' ),
		),
		'default'		=> 'default',
	));

	$cmb_boutique->add_field( array(
		'name'	=>	esc_html__('Choose header color', 'boutique'),
		'desc'	=>	esc_html__( 'Select header background color', 'boutique' ),
		'id' 	=>	$prefix . 'pg_hdbg',
		'type'             => 'colorpicker',
		'options' => array(
			'alpha' => true,
		),
		'default'		=> '',
	));
	$cmb_boutique->add_field( array(
		'name'	=>	esc_html__('Choose Menu color', 'boutique'),
		'desc'	=>	esc_html__( 'Select menu item color', 'boutique' ),
		'id' 	=>	$prefix . 'pg_navitemclr',
		'type'             => 'colorpicker',
		// 'options' => array(
		// 	'alpha' => true,
		// ),
		'default'		=> '',
	));
	$cmb_boutique->add_field( array(
		'name'	=>	esc_html__('Choose link hover color', 'boutique'),
		'desc'	=>	esc_html__( 'Select menu item hover color', 'boutique' ),
		'id' 	=>	$prefix . 'pg_navitemhclr',
		'type'             => 'colorpicker',
		// 'options' => array(
		// 	'alpha' => true,
		// ),
		'default'		=> '',
	));
	$cmb_boutique->add_field( array(
		'name'	=>	esc_html__('Choose link hover background color', 'boutique'),
		'desc'	=>	esc_html__( 'Select menu item hover background color', 'boutique' ),
		'id' 	=>	$prefix . 'pg_navitembghclr',
		'type'             => 'colorpicker',
		'options' => array(
			'alpha' => true,
		),
		'default'		=> '',
	));

	$cmb_boutique->add_field( array(
		'name' => __('Header Layout', 'boutique'),
		'desc' => __('Choose header layout', 'boutique'),
		'id' => $prefix . 'hdr_layout',
		'type' => 'image_select',
		'options' => array(
			'default' => array(
				'title' => '',
				'alt' => 'Default header',
				'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/default.jpg'
			),
			'header1' => array(
				'title' => '',
				'alt' => 'Style 1',
				'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/hd1.jpg'
			),
			 'header2' => array(
			 	'title' => '',
			 	'alt' => 'Style 2',
			 	'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/hd2.jpg'
			 ),
			 'header3' => array(
			 	'title' => '',
			 	'alt' => 'Style 3',
			 	'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/hd3.jpg'
			 ),
			'header4' => array(
				'title' => '',
				'alt' => 'Style 5',
				'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/hd4.jpg'
			),
			 'header5' => array(
			 	'title' => '',
			 	'alt' => 'Style 6',
			 	'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/hd5.jpg'
			 ),
			 'header6' => array(
			 	'title' => '',
			 	'alt' => 'Style 7',
			 	'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/hd6.jpg'
			 ),
		),
		'default' => '',
	));

	$cmb_boutique->add_field( array(
		'name' => esc_html__('Show/Hide Menu', 'boutique'),
		'desc' => esc_html__( 'Do you want to display Menu?', 'boutique' ),
		'id' => $prefix . 'mainnav',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
						'on'=> 'Yes',
						'off'=> 'No'
					)
	));

}


add_action( 'cmb2_admin_init', 'boutique_register_metabox' );

function boutique_register_metabox() {
	$prefix = 'boutique_';

	$cmb_boutique = new_cmb2_box( array(
		'id'            => $prefix . 'pageoptn',
		'title'         => esc_html__( 'Page Options', 'boutique' ),
		'object_types'  => array( 'page' ), // Post type
	) );


	$cmb_boutique->add_field( array(
		'name' => __('Page layout', 'boutique'),
		'desc' => __('Choose page layout', 'boutique'),
		'id' => $prefix . 'page_custom_layout',
		'type' => 'image_select',
		'options' => array(
			'default' => array(
				'title' => 'Full Width',
				'alt' => 'Full Width',
				'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/full.png'
			),
			'sidebar-left' => array(
				'title' => 'Sidebar Left',
				'alt' => 'Sidebar Left',
				'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/left_sidebar.png'
			),
			'sidebar-right' => array(
				'title' => 'Sidebar Right',
				'alt' => 'Sidebar Right',
				'img' => BOUTIQUE_FRAMEWORK_URI . '/custom-metaboxes/images/right_sidebar.png'
			),
		),
		'default' => 'default',
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__('Select Sidebar', 'boutique'),
		'desc' => esc_html__('Select page sidebar shown in selected side.', 'boutique' ),
		'id' 	=> $prefix . 'sidebar_sl',
		'type'    => 'radio_inline',
		'options' => array(
			'primary_sidebar' 	=>	esc_html__( 'Primary Sidebar', 'boutique' ),
			'shop_sidebar' 		=>	esc_html__( 'Shop Sidebar', 'boutique' ),
		),
	));

	$cmb_boutique->add_field( array(
		'name' => esc_html__('Show/Hide Sidebar Category', 'boutique'),
		'desc' => esc_html__( 'Do you want to display banner sidebar', 'boutique' ),
		'id' => $prefix . 'bnnr_cat',
		'type' => 'switch',
		'default' => 0,
		'label' => array(
							'on'=> 'Yes',
							'off'=> 'No'
						)
	));

	$cmb_boutique->add_field( array(
		'name' => esc_html__('Display Header', 'boutique'),
		'desc' => esc_html__( 'Do you want to display Header?', 'boutique' ),
		'id' => $prefix . 'header',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
						'on'=> 'Yes',
						'off'=> 'No'
					),
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__('Display page title', 'boutique'),
		'desc' => esc_html__( 'Do you want to display page title?', 'boutique' ),
		'id' => $prefix . 'page_title',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
						'on'=> 'Yes',
						'off'=> 'No'
					),
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__('Display Breadcumb', 'boutique'),
		'desc' => esc_html__( 'Do you want to display breadcumb?', 'boutique' ),
		'id' => $prefix . 'breadcumb',
		'type' => 'switch',
		'default' => 0,
		'label' => array(
						'on'=> 'Yes',
						'off'=> 'No'
					),
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__('Display Banner', 'boutique'),
		'desc' => esc_html__( 'Do you want to display Banner?', 'boutique' ),
		'id' => $prefix . 'hdrbnnr',
		'type' => 'switch',
		'default' => 0,
		'label' => array(
							'on'=> 'Yes',
							'off'=> 'No'
						),
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__( 'Banner Background Image', 'boutique' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'boutique' ),
		'id'   => $prefix . 'hbg_image',
		'type' => 'file',
		'default' => 'https://dummyimage.com/1920x500.jpg'
	) );

	$cmb_boutique->add_field( array(
		'name'    => esc_html__( 'Banner Text Color', 'boutique' ),
		'desc'    => esc_html__( 'Change the banner text color', 'boutique' ),
		'id'      => $prefix . 'bnr_text_clr',
		'type'    => 'colorpicker',
		'default' => '',
	) );

	$cmb_boutique->add_field( array(
		'name' => esc_html__('Show/Hide Footer', 'boutique'),
		'desc' => esc_html__( 'Do you want to display footer?', 'boutique' ),
		'id' => $prefix . 'footer_sh',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
						'on'=> 'Yes',
						'off'=> 'No'
					)
	));
	
}


add_action( 'cmb2_admin_init', 'boutique_post_metaboxes' );

function boutique_post_metaboxes() {
	$prefix = 'boutique_';

	$cmb_boutique = new_cmb2_box( array(
		'id'           => $prefix . 'singlepostoption',
		'title'        => esc_html__( 'Post Options', 'boutique' ),
		'object_types' => array( 'post' ), // Post type
		'context'      => 'normal',
		'priority'     => '',
		'show_names'   => true, // Show field names on the left
	) );

	$cmb_boutique->add_field( array(
		'name' => esc_html__('Show/Hide featured image', 'boutique'),
		'desc' => esc_html__( 'Do you want to display featured image?', 'boutique' ),
		'id' => $prefix . 'featured_img',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
							'on'=> 'Yes',
							'off'=> 'No'
						)
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__('Display Banner', 'boutique'),
		'desc' => esc_html__( 'Do you want to display Banner?', 'boutique' ),
		'id' => $prefix . 'hdrbnnr',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
							'on'=> 'Yes',
							'off'=> 'No'
						),
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__( 'Header Background Image', 'boutique' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'boutique' ),
		'id'   => $prefix . 'hd_bg_img',
		'type' => 'file',
	) );
	
}


add_action( 'cmb2_admin_init', 'boutique_shop_metaboxes' );

function boutique_shop_metaboxes() {
	$prefix = 'boutique_';

	$cmb_boutique = new_cmb2_box( array(
		'id'           => $prefix . 'woo',
		'title'        => esc_html__( 'Post Options', 'boutique' ),
		'object_types' => array( 'product' ), // Post type
		'context'      => 'normal',
		'priority'     => '',
		'show_names'   => true, // Show field names on the left
	) );

	$cmb_boutique->add_field( array(
		'name' => esc_html__('Show/Hide featured image', 'boutique'),
		'desc' => esc_html__( 'Do you want to display featured image?', 'boutique' ),
		'id' => $prefix . 'featured_img',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
							'on'=> 'Yes',
							'off'=> 'No'
						)
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__('Display Banner', 'boutique'),
		'desc' => esc_html__( 'Do you want to display Banner?', 'boutique' ),
		'id' => $prefix . 'hdrbnnr',
		'type' => 'switch',
		'default' => 1,
		'label' => array(
							'on'=> 'Yes',
							'off'=> 'No'
						),
	));
	$cmb_boutique->add_field( array(
		'name' => esc_html__( 'Header Background Image', 'boutique' ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', 'boutique' ),
		'id'   => $prefix . 'hd_bg_img',
		'type' => 'file',
	) );
	
}



function boutique_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'boutique' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}
function boutique_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}
