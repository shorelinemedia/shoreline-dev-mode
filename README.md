# Shoreline Dev Mode

This plugin adds support to be able to gate certain functionality depending on whether the Wordpress site is in developer/staging mode.

The function `sl9_is_staging()` can be used to optionally show some code or functions depending on whether it's a staging/local environment. A good practice would be to only include Google Analytics or other tracking scripts when the site is **not** in a development/local environment.

This function also looks for the "Legacy" WPEngine staging environment setup as well.

### Setup

When you are running your site locally, add **one** the following lines to your `wp-config.php` file:

````
define( 'WP_ENV', 'development' );
````
OR
````
define( 'WP_ENV', 'local' );
````
OR
````
define( 'WP_ENV', 'staging' );
````
OR
````
define( 'WP_LOCAL_DEV', true );
````

By having one of these lines in your local `wp-config.php` it will trigger the function `sl9_is_staging` to return `true`;

### Dev Mode

This plugin helps you know you are on a development version of a website. It adds a helpful CSS style to the admin bar on the website, using a red background on the Wordpress logo and a red border in addition to a `DEV` label in the top left of the site.

### Usage

Once the plugin is installed, you can use a variable in your code to check for development mode:

````php
$is_dev = function_exists( 'sl9_is_staging' ) ? sl9_is_staging() : false;
````

This should be bulletproof-- if this plugin is removed and our function doesn't exist then it should return `false`.

### Installation

Install the [Github Updater](https://github.com/afragen/github-updater/archive/master.zip) plugin by uploading the ZIP file and activating on your wordpress install.

Install the plugin through the Github Updater's Install Plugin section by using the full github URL of `https://github.com/shorelinemedia/shoreline-dev-mode` and then activate the plugin under Plugins section

## Integrations

We try and integrate with popular plugins to disable some functionality while in staging/development environments

#### CF7 to Webhook/Zapier

By default, when running this dev mode plugin and the CF7 to Webhook plugin, it will disable webhooks entirely by passing an empty URL to the plugin in a dev environment. *This will also cause an error when trying to send a CF7 form on the frontend.*

To override a webhook URL and test the webhook or to get form sending working again in staging, supply a URL like one at [webhooks.site](https://webhook.site/) in a constant in `wp-config.php`:

``
define( 'CF7_TO_WEBHOOK_DEV_URL', 'https://webhook.site/5bb1f633-0686-4a3c-9443-fc7f27b02929' );
``
