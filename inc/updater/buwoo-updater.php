<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package EDD Sample Theme
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'BuWoo_Updater_Admin' ) ) {
    include( dirname( __FILE__ ) . '/buwoo-updater-admin.php' );
}

// Loads the updater classes
$updater = new BuWoo_Updater_Admin(

    // Config settings
    $config = array(
        'remote_api_url' => 'https://krocant.com', // Site where EDD is hosted
        'item_name'      => BUWOO_NAME, // Name of theme
        'theme_slug'     => 'buwoo', // Theme slug
        'version'        => BUWOO_VERSION, // The current version of this theme
        'author'         => BUWOO_AUTHOR, // The author of this theme
        'download_id'    => 892, // Optional, used for generating a license renewal link
        'renew_url'      => '', // Optional, allows for a custom license renewal link
        'beta'           => false, // Optional, set to true to opt into beta versions
    ),

    // Strings
    $strings = array(
        'theme-license'             => __( 'Theme License', 'boutique' ),
        'enter-key'                 => __( 'Enter your theme license key.', 'boutique' ),
        'license-key'               => __( 'License Key', 'boutique' ),
        'license-action'            => __( 'License Action', 'boutique' ),
        'deactivate-license'        => __( 'Deactivate License', 'boutique' ),
        'activate-license'          => __( 'Activate License', 'boutique' ),
        'status-unknown'            => __( 'License status is unknown.', 'boutique' ),
        'renew'                     => __( 'Renew?', 'boutique' ),
        'unlimited'                 => __( 'unlimited', 'boutique' ),
        'license-key-is-active'     => __( 'License key is active.', 'boutique' ),
        'expires%s'                 => __( 'Expires %s.', 'boutique' ),
        'expires-never'             => __( 'Lifetime License.', 'boutique' ),
        '%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'boutique' ),
        'license-key-expired-%s'    => __( 'License key expired %s.', 'boutique' ),
        'license-key-expired'       => __( 'License key has expired.', 'boutique' ),
        'license-keys-do-not-match' => __( 'License keys do not match.', 'boutique' ),
        'license-is-inactive'       => __( 'License is inactive.', 'boutique' ),
        'license-key-is-disabled'   => __( 'License key is disabled.', 'boutique' ),
        'site-is-inactive'          => __( 'Site is inactive.', 'boutique' ),
        'license-status-unknown'    => __( 'License status is unknown.', 'boutique' ),
        'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'boutique' ),
        'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'boutique' ),
    )

);
