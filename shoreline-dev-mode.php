<?php
/**
* Plugin Name:          Shoreline Dev Mode
* Plugin URI:           https://github.com/shorelinemedia/shoreline-dev-mod
* Description:          Adds function <code>sl9_is_staging</code> and styles the admin bar with a red box and the word "DEV" in the top left to help indicate that you are on a staging/dev version of the site
* Version:              1.0.4
* Author:               Shoreline Media
* Author URI:           https://shoreline.media
* License:              GNU General Public License v2
* License URI:          http://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:          sl9-scripts-codes
* GitHub Plugin URI:    https://github.com/shorelinemedia/shoreline-dev-mode
*/


// Is this a staging/dev server?
if ( !function_exists( 'sl9_is_staging' ) ) {
  function sl9_is_staging() {
    return (
      // If the WP_ENV constant is defined and set to 'staging' or 'development'
      ( defined( 'WP_ENV' ) && ( 'local' === WP_ENV || 'staging' === WP_ENV || 'development' === WP_ENV ) )
      // Or if WP_LOCAL_DEV constant is set
      || defined( 'WP_LOCAL_DEV' )
      // If we're on WPE and it is the "legacy" staging site
      || function_exists( 'is_wpe_snapshot' ) && is_wpe_snapshot()
    );
  }
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
