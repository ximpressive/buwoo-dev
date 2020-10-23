<?php
/**
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
require_once  BOUTIQUE_FRAMEWORK . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'boutique_register_required_plugins' );

function boutique_register_required_plugins() {
	
	$plugins = array(
		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'			=> 'Elementor', // The plugin name.
			'slug'			=> 'elementor',
			'version'		=> '2.4.3',
			'required'		=> true
		),
		array(
			'name'        	=> 'Contact Form 7',
			'slug'        	=> 'contact-form-7',
			'version'		=> '5.0.5',
			'required'    	=> true,
		),
		array(
			'name'        	=> 'WooCommerce',
			'slug'        	=> 'woocommerce',
			'version'		=> '3.4.5',
			'required'    	=> true,
		),
		array(
			'name'			=> 'Boutique Instagram Feed', 
			'slug'			=> 'http://krocant.com/', 
			'version'		=> '1.0.0',
			'source'        => get_template_directory_uri() . '/framework/plugins/boutique-instagram-feed.zip', 
			'required'      => true, // If false, the plugin is only 'recommended' instead of required.
			'version'       => '', 
		),
		array(
			'name'        	=> 'YITH WooCommerce Wishlist',
			'slug'        	=> 'yith-woocommerce-wishlist',
			'version'		=> '2.2.7',
			'required'    	=> true,
		),
		array(
			'name'        	=> 'YITH Infinite Scrolling',
			'slug'        	=> 'yith-infinite-scrolling',
			'version'		=> '1.1.3',
			'required'    	=> true,
		),
		array(
			'name'        	=> 'One Click Demo Import',
			'slug'        	=> 'one-click-demo-import',
			'version'		=> '2.5.1',
			'required'    	=> true,
		),
	);
	
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}
