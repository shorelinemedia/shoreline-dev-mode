# Shoreline Dev Mode

Tags: 
Requires at least:
Tested up to:
Requires PHP:
Stable tag:
**License:** GPLv2 or later \
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds support to be able to gate certain functionality depending on whether the Wordpress site is in developer/staging mode.

The function `sl9_is_staging()` can be used to optionally show some code or functions depending on whether it's a staging/local environment. A good practice would be to only include Google Analytics or other tracking scripts when the site is **not** in a development/local environment.

This function also looks for the "Legacy" WPEngine staging environment setup as well.

## Local Setup

When you are running your site locally, add **one** the following lines to your `wp-config.php` file:

```
define( 'WP_ENVIRONMENT_TYPE', 'development' );
```
OR
```
define( 'WP_ENVIRONMENT_TYPE', 'local' );
```
OR
```
define( 'WP_ENVIRONMENT_TYPE', 'staging' );
```
OR
```
define( 'WP_LOCAL_DEV', true );
```

By having one of these lines in your local `wp-config.php` it will trigger the function `sl9_is_staging` to return `true`;

## Dev Mode

This plugin helps you know you are on a development version of a website. It adds a helpful CSS style to the admin bar on the website, using a red background on the Wordpress logo and a red border in addition to a `DEV` label in the top left of the site.

## Usage

Once the plugin is installed, you can use a variable in your code to check for development mode:

```
$is_dev 

### function_exists( 'sl9_is_staging' ) ? sl9_is_staging() : false;

```

This should be bulletproof-- if this plugin is removed and our function doesn't exist then it should return `false`.

## Install with Github Updater

Install the [Github Updater](https://github.com/afragen/github-updater/archive/master.zip) plugin by uploading the ZIP file and activating on your wordpress install.

Install the plugin through the Github Updater's Install Plugin section by using the full github URL of `https://github.com/shorelinemedia/shoreline-dev-mode` and then activate the plugin under Plugins section

## Integrations

We try and integrate with popular plugins to disable some functionality while in staging/development environments

## Scripts & Codes / Headers and Footers plugin

When this plugin is active and `sl9_is_staging()` return `true`, scripts and codes from plugins like Insert Headers and Footers and our very own Scripts and Codes will not be output on the frontend.  This is meant to stop tracking analytics or other events that should only be run in production environments to preserve data integrity.  However, if you need to test functionality of code that is in these plugin settings, add a constant to `wp-config.php` named `SL9_DEV_MODE_DO_SCRIPTS` and you can keep the plugin active so that it continues to give you visual cues about the dev environment and continues to block Webhooks on forms as well, but will keep the scripts intact.

## CF7 to Zapier and Gravity Forms webhook add-on

By default, when running this dev mode plugin and the CF7 to Webhook plugin or Gravity Forms Webhook add-on, it will disable webhooks entirely by passing an empty URL to the plugin in a dev environment. *This will also cause an error when trying to send a CF7 form on the frontend.*

To override a webhook URL and test the webhook or to get form sending working again for CF7 on staging/local, supply a URL like one at [webhooks.site](https://webhook.site/) in a constant in `wp-config.php`:

```
define( 'SL9_DEV_WEBHOOK_URL', 'https://webhook.site/5bb1f633-0686-4a3c-9443-fc7f27b02929' );
```
