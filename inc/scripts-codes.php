<?php 

/**
 * Prevent scripts and code plugins from outputting tracking scripts while
 * in dev/staging/local
 */

if ( !function_exists( 'sl9_dev_mode_scripts_codes_init' ) ) {
    function sl9_dev_mode_scripts_codes_init() {
        // Check for dev mode
        $sl9_dev = sl9_is_dev();
        $override = defined( 'SL9_DEV_MODE_DO_SCRIPTS' ) ? true : false;
        
        if ( 
            $sl9_dev // Or if we're in a dev env
            && !$override // If we're overrding via constant
            ) {
            
            /* Insert headers and footers plugin */
            add_filter( 'disable_ihaf', function() {
                return true;
            }, 98);
            /* Shoreline Scripts & Codes */
            add_filter( 'sl9_scripts_codes_disable', function() {
                return true;
            }, 98);

        }
    }
    add_action( 'plugins_loaded', 'sl9_dev_mode_scripts_codes_init' );
}