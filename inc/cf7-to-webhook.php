<?php
/**
 * CF7 to Webhook integration
 */

// Pass an empty string as the hook URL while in dev mode
// to test a real webhook URL, define a constant
// CF7_TO_WEBHOOK_DEV_URL in wp-config.php
if ( !function_exists( 'sl9_dev_mode_cf7_to_webhook_init' ) ) {
  function sl9_dev_mode_cf7_to_webhook_init() {
    // Filter the webhook URL
    add_filter( 'ctz_hook_url', 'sl9_dev_mode_cf7_to_webhook_url', 99, 2 );
  }
  add_action( 'init', 'sl9_dev_mode_cf7_to_webhook_init' );
}

if ( !function_exists( 'sl9_dev_mode_cf7_to_webhook_url' ) ) {
  function sl9_dev_mode_cf7_to_webhook_url( $hook_url, $data ) {
    if ( sl9_is_staging() ) {
      // If there's no constant for the URL to use so return empty string
      if ( !defined( 'CF7_TO_WEBHOOK_DEV_URL' ) ) {
        $hook_url = '';
      } else {
        // Use the URL in the constant
        $hook_url = CF7_TO_WEBHOOK_DEV_URL;
      }
    }
    return $hook_url;
  }
}
