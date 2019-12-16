# Shoreline Dev Mode

This plugin adds support to be able to gate certain functionality depending on whether the Wordpress site is in developer/staging mode.

When you are running your site locally, add the following line to your `wp-config.php` file:

`define( 'WP_ENV', 'development' );`

This function also looks for the "Legacy" WPEngine staging environment setup as well.


### Installation

Install the [Github Updater](https://github.com/afragen/github-updater/archive/master.zip) plugin by uploading the ZIP file and activating on your wordpress install.

Install the plugin through the Github Updater's Install Plugin section by using the full github URL of `https://github.com/shorelinemedia/shoreline-dev-mode` and then activate the plugin under Plugins section
