<?php
/**
 * The initation loader for CMB2, and the main plugin file.
 *
 * @category     WordPress_Plugin
 * @package      CMB2
 * @author       CMB2 team
 * @license      GPL-2.0+
 * @link         https://cmb2.io
 *
 * Plugin Name:  CMB2
 * Plugin URI:   https://github.com/CMB2/CMB2
 * Description:  CMB2 will create metaboxes and forms with custom fields that will blow your mind.
 * Author:       CMB2 team
 * Author URI:   https://cmb2.io
 * Contributors: Justin Sternberg (@jtsternberg / dsgnwrks.pro)
 *               WebDevStudios (@webdevstudios / webdevstudios.com)
 *               Human Made (@humanmadeltd / hmn.md)
 *               Jared Atchison (@jaredatch / jaredatchison.com)
 *               Bill Erickson (@billerickson / billerickson.net)
 *               Andrew Norcross (@norcross / andrewnorcross.com)
 *
 * Version:      2.4.2
 *
 * Text Domain:  cmb2
 * Domain Path:  languages
 *
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * https://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * **********************************************************************
 */

/**
 * *********************************************************************
 *               You should not edit the code below
 *               (or any code in the included files)
 *               or things might explode!
 * ***********************************************************************
 */

if ( ! class_exists( 'CMB2_Bootstrap_242_Trunk', false ) ) {

	/**
	 * Handles checking for and loading the newest version of CMB2
	 *
	 * @since  2.0.0
	 *
	 * @category  WordPress_Plugin
	 * @package   CMB2
	 * @author    CMB2 team
	 * @license   GPL-2.0+
	 * @link      https://cmb2.io
	 */
	class CMB2_Bootstrap_242_Trunk {

		/**
		 * Current version number
		 *
		 * @var   string
		 * @since 1.0.0
		 */
		const VERSION = '2.4.2';

		/**
		 * Current version hook priority.
		 * Will decrement with each release
		 *
		 * @var   int
		 * @since 2.0.0
		 */
		const PRIORITY = 9966;

		/**
		 * Single instance of the CMB2_Bootstrap_242_Trunk object
		 *
		 * @var CMB2_Bootstrap_242_Trunk
		 */
		public static $single_instance = null;

		/**
		 * Creates/returns the single instance CMB2_Bootstrap_242_Trunk object
		 *
		 * @since  2.0.0
		 * @return CMB2_Bootstrap_242_Trunk Single instance object
		 */
		public static function initiate() {
			if ( null === self::$single_instance ) {
				self::$single_instance = new self();
			}
			return self::$single_instance;
		}

		/**
		 * Starts the version checking process.
		 * Creates CMB2_LOADED definition for early detection by other scripts
		 *
		 * Hooks CMB2 inclusion to the init hook on a high priority which decrements
		 * (increasing the priority) with each version release.
		 *
		 * @since 2.0.0
		 */
		private function __construct() {
			/**
			 * A constant you can use to check if CMB2 is loaded
			 * for your plugins/themes with CMB2 dependency
			 */
			if ( ! defined( 'CMB2_LOADED' ) ) {
				define( 'CMB2_LOADED', self::PRIORITY );
			}

			add_action( 'init', array( $this, 'include_cmb' ), self::PRIORITY );
		}

		/**
		 * A final check if CMB2 exists before kicking off our CMB2 loading.
		 * CMB2_VERSION and CMB2_DIR constants are set at this point.
		 *
		 * @since  2.0.0
		 */
		public function include_cmb() {
			if ( class_exists( 'CMB2', false ) ) {
				return;
			}

			if ( ! defined( 'CMB2_VERSION' ) ) {
				define( 'CMB2_VERSION', self::VERSION );
			}

			if ( ! defined( 'CMB2_DIR' ) ) {
				define( 'CMB2_DIR', trailingslashit( dirname( __FILE__ ) ) );
			}

			$this->l10ni18n();

			// Include helper functions.
			require_once CMB2_DIR . 'includes/CMB2_Base.php';
			require_once CMB2_DIR . 'includes/CMB2.php';
			require_once CMB2_DIR . 'includes/helper-functions.php';

			// Now kick off the class autoloader.
			spl_autoload_register( 'cmb2_autoload_classes' );

			// Kick the whole thing off.
			require_once( cmb2_dir( 'bootstrap.php' ) );
			cmb2_bootstrap();
		}

		/**
		 * Registers CMB2 text domain path
		 *
		 * @since  2.0.0
		 */
		public function l10ni18n() {

			$loaded = load_plugin_textdomain( 'cmb2', false, '/languages/' );

			if ( ! $loaded ) {
				$loaded = load_muplugin_textdomain( 'cmb2', '/languages/' );
			}

			if ( ! $loaded ) {
				$loaded = load_theme_textdomain( 'cmb2', get_stylesheet_directory() . '/languages/' );
			}

			if ( ! $loaded ) {
				$locale = apply_filters( 'plugin_locale', get_locale(), 'cmb2' );
				$mofile = dirname( __FILE__ ) . '/languages/cmb2-' . $locale . '.mo';
				load_textdomain( 'cmb2', $mofile );
			}

		}

	}

	// Make it so...
	CMB2_Bootstrap_242_Trunk::initiate();

}// End if().


// function initialize_showcase_meta_boxs() {
// 	require_once('includes/types/CMB2_Tabs_class.php');
// }
// add_action('init', 'initialize_showcase_meta_boxs', 9999 ); /** LOAD --- Related CSS and JS */
// function load_custom_cmb2_scripts() {
// 	wp_enqueue_style( 'cmb2_tabs_jui', '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css', '', '1.0' );
// 	wp_enqueue_style( 'cmb2_tabs-css', BOUTIQUE_FRAMEWORK_URI .'/custom-metaboxes/css/cmb2Tabs.css', false, '1.0.0' );
// 		wp_enqueue_script( 'cmb2_tab-js', BOUTIQUE_FRAMEWORK_URI. '/custom-metaboxes/js/cmb2Tabs.js' , array('jquery-ui-tabs'), '1.0.0', true );
// }
// add_action( 'admin_enqueue_scripts', 'load_custom_cmb2_scripts', 20 );



function initialize_showcase_meta_box() {
	 //CMB2 Switch Field
	require_once('includes/types/CMB2_Type_Switch.php'); //CMB2 Switch Field
	require_once('includes/types/CMB2_Image_Select_Metafield.php'); //CMB2 Buttonset Field
}
add_action('init', 'initialize_showcase_meta_box', 9999 );
/** LOAD --- Related CSS and JS */
function load_custom_cmb2_script() {
	//CMB2 Switch Styling
	// wp_enqueue_style( 'cmb2_tabs_jui', '//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css', '', '1.0' );
	// wp_enqueue_style( 'cmb2_tabs-css', BOUTIQUE_FRAMEWORK_URI .'/custom-metaboxes/css/cmb2Tabs.css', false, '1.0.0' );
	wp_enqueue_style( 'cmb2_switch-css', BOUTIQUE_FRAMEWORK_URI .'/custom-metaboxes/css/switch_metafield.css', false, '1.0.0' );
	wp_enqueue_style( 'cmb2_imgselect-css', BOUTIQUE_FRAMEWORK_URI .'/custom-metaboxes/css/image_select_metafield.css', false, '1.0.0' );
	// wp_enqueue_script( 'cmb2_tabs-js', BOUTIQUE_FRAMEWORK_URI. '/custom-metaboxes/js/cmb2Tabs.js' , '', '1.0.0', true );

	wp_enqueue_script( 'cmb2_switch-js', BOUTIQUE_FRAMEWORK_URI. '/custom-metaboxes/js/switch_metafield.js' , '', '1.0.0', true );
	wp_enqueue_script( 'cmb2_imgselect-js', BOUTIQUE_FRAMEWORK_URI. '/custom-metaboxes/js/image_select_metafield.js' , '', '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'load_custom_cmb2_script', 20 );
