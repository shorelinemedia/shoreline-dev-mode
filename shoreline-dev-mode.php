<?php
/**
* Plugin Name:          Shoreline Dev Mode
* Plugin URI:           https://github.com/shorelinemedia/shoreline-dev-mode
* Description:          Adds function <code>sl9_is_staging</code> and styles the admin bar with a red box and the word "DEV" in the top left to help indicate that you are on a staging/dev version of the site
* Version:              1.5.1
* Author:               Shoreline Media
* Author URI:           https://shoreline.media
* License:              GNU General Public License v2
* License URI:          http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:          sl9-scripts-codes
* GitHub Plugin URI:    https://github.com/shorelinemedia/shoreline-dev-mode
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Is this a staging/dev server?
if ( !function_exists( 'sl9_is_staging' ) ) {
  function sl9_is_staging() {
    return (
      // Check for new wp_get_environment_type() function and also check for
      // defined 'WP_ENVIRONMENT_TYPE' constant
      ( function_exists( 'wp_get_environment_type' ) && 'production' !== wp_get_environment_type() ) 
      // If the WP_ENV constant is defined and set to 'staging' or 'development'
      || ( defined( 'WP_ENV' ) && ( 'local' === WP_ENV || 'staging' === WP_ENV || 'development' === WP_ENV ) )
      // Or if WP_LOCAL_DEV constant is set
      || defined( 'WP_LOCAL_DEV' )
      // If we're on Siteground hosting and it's a staging environment
      || ( defined( 'SITEGROUND_STAGING' ) && SITEGROUND_STAGING )
      // If we're on WPE and it is the "legacy" staging site
      || ( function_exists( 'is_wpe_snapshot' ) && is_wpe_snapshot() )
    );
  }
}

// Helper functions with similar function names that return the same thing--
// basically that it's not prod

if ( !function_exists( 'sl9_is_not_prod' ) ) {
  function sl9_is_not_prod() { return sl9_is_staging(); }
}
if ( !function_exists( 'sl9_is_dev' ) ) {
  function sl9_is_dev() { return sl9_is_staging(); }
}
if ( !function_exists( 'sl9_is_local' ) ) {
  function sl9_is_local() { return sl9_is_staging(); }
}

/**
 * DEV MODE ALERT
 *
 * If we're on a staging/dev/local server visually indicate it in the WP Admin
 *
 */
if ( !function_exists( 'sl9_dev_mode_alert' ) ) {
  function sl9_dev_mode_alert() {
    // Don't show for non admin users
    if ( ( is_multisite() && !is_super_admin() ) || !current_user_can( 'manage_options' ) ) return false;

    if ( sl9_is_staging() ) {

      $css = sl9_dev_mode_css();

      // Add our inline styles to the admin bar so it only appears while logged in
      wp_add_inline_style( 'admin-bar', $css );

    }
  }
  add_action( 'admin_enqueue_scripts', 'sl9_dev_mode_alert', 99 );
  add_action( 'wp_enqueue_scripts', 'sl9_dev_mode_alert', 99 );
}

if ( !function_exists( 'sl9_dev_mode_css' ) ) {
  function sl9_dev_mode_css($css = '') {
    // Add styles to admin
    $custom_css = '
#wpadminbar {
-webkit-box-shadow: inset 0 2px red;
        box-shadow: inset 0 2px red;
}
#wp-admin-bar-wp-logo > .ab-item:after {
content: "DEV";
display: block;
background-color: red;
color: white;
position: absolute;
width: 100%;
margin: 0 -7px;
text-align: center;
mix-blend-mode: luminosity;
pointer-events: none;
}
    ';
    $css = apply_filters( 'sl9_dev_mode_css', $custom_css );
    return $css;
  }
}

include_once( DIRNAME( __FILE__ ) . '/inc/webhooks.php' );
include_once( DIRNAME( __FILE__ ) . '/inc/scripts-codes.php' );
