<?php
/**
 * CF7 & Gravity Forms Webhooks
 * 
 * Pass an empty string as the hook URL while in dev mode--
 * to test a real webhook URL, define a constant `SL9_DEV_WEBHOOK_URL` in wp-config.php 
 * 
 **/


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Independant of plugin, get the dev webhook url
if ( !function_exists( 'sl9_dev_mode_get_webhook_url' ) ) {
    function sl9_dev_mode_get_webhook_url( $hook_url ) {
      if ( sl9_is_staging() ) {
        // If there's no constant for the URL to use so return empty string
        if ( !defined( 'SL9_DEV_WEBHOOK_URL' ) ) {
          $hook_url = '';
        } else {
          // Use the URL in the constant
          $hook_url = SL9_DEV_WEBHOOK_URL;
        }
      }
      return $hook_url;
    }
}

// Add our filters on init
if ( !function_exists( 'sl9_dev_mode_webhooks_init' ) ) {
    function sl9_dev_mode_webhooks_init() {
      // Filter the webhook URL for
      add_filter( 'ctz_hook_url', 'sl9_dev_mode_cf7_to_webhook_url', 99, 2 );
      add_filter( 'gform_webhooks_request_url', 'sl9_dev_mode_gforms_webhook_url', 99, 4 );
    }
    add_action( 'init', 'sl9_dev_mode_webhooks_init' );
}


///
// CF7 to Webhook integration
///

if ( !function_exists( 'sl9_dev_mode_cf7_to_webhook_url' ) ) {
    function sl9_dev_mode_cf7_to_webhook_url( $hook_url, $data ) {
        return sl9_dev_mode_get_webhook_url( $hook_url );
    }
}

////
// Gravity Forms webhook integration
///

if ( !function_exists( 'sl9_dev_mode_gforms_webhook_url' ) ) {
    function sl9_dev_mode_gforms_webhook_url( $hook_url, $feed, $entry, $form ) {
        return sl9_dev_mode_get_webhook_url( $hook_url );
    }
}
