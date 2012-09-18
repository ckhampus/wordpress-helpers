<?php

require __DIR__.'/../vendor/autoload.php';

use Queensbridge\Console\Downloader;
use Queensbridge\Console\Installer;

/* Path to the WordPress codebase you'd like to test. Add a backslash in the end. */
define('ABSPATH', __DIR__.'/wordpress/');

define('DB_NAME', 'wordpress_test');
define('DB_USER', 'wptest');
define('DB_PASSWORD', 'wptest');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
define('DB_TABLE_PREFIX', 'wp_');

define('WPLANG', '');
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);

define('WP_TESTS_DOMAIN', 'example.org');
define('WP_TESTS_ADMIN', 'admin');
define('WP_TESTS_EMAIL', 'admin@example.org');
define('WP_TESTS_TITLE', 'Test Blog' );
define('WP_TESTS_NETWORK_TITLE', 'Test Network');
define('WP_TESTS_SUBDOMAIN_INSTALL', true);
$base = '/';

/* Cron tries to make an HTTP request to the blog, which always fails, because tests are run in CLI mode only */
define('DISABLE_WP_CRON', true);

define('WP_ALLOW_MULTISITE', false);

if (WP_ALLOW_MULTISITE) {
    define( 'WP_TESTS_BLOGS', 'first,second,third,fourth' );
}

if (WP_ALLOW_MULTISITE && !defined('WP_INSTALLING')) {
    define( 'SUBDOMAIN_INSTALL', WP_TESTS_SUBDOMAIN_INSTALL );
    define( 'MULTISITE', true );
    define( 'DOMAIN_CURRENT_SITE', WP_TESTS_DOMAIN );
    define( 'PATH_CURRENT_SITE', '/' );
    define( 'SITE_ID_CURRENT_SITE', 1);
    define( 'BLOG_ID_CURRENT_SITE', 1);
    define( 'WPMU_PLUGIN_DIR', __DIR__ . '/mu-plugins' );
}

/*
 * Globalize some WordPress variables, because PHPUnit loads this file inside a function
 * See: https://github.com/sebastianbergmann/phpunit/issues/325
 *
 * These are not needed for WordPress 3.3+, only for older versions
*/
global $table_prefix, $wp_embed, $wp_locale, $_wp_deprecated_widgets_callbacks, $wp_widget_factory;

// These are still needed
global $wpdb, $current_site, $current_blog, $wp_rewrite, $shortcode_tags, $wp;

$downloader = new Downloader(ABSPATH);
$downloader->fetch('https://github.com/WordPress/WordPress.git');
$downloader->branch('3.4.2');

$installer = new Installer();
$installer->install();

