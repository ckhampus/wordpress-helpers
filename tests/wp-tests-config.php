<?php

// Path to the WordPress codebase you'd like to test. Add a backslash in the end.
define('ABSPATH', __DIR__ . '/../vendor/wordpress/wordpress/');

// Test with multisite enabled: (previously -m)
// define('WP_TESTS_MULTISITE', true);

// Force known bugs: (previously -f)
// define('WP_TESTS_FORCE_KNOWN_BUGS', true);

// Test with WordPress debug mode on (previously -d)
// define('WP_DEBUG', true);

// ** MySQL settings ** //

// This configuration file will be used by the copy of WordPress being tested.
// wordpress/wp-config.php will be ignored.

// WARNING WARNING WARNING!
// These tests will DROP ALL TABLES in the database with the prefix named below.
// DO NOT use a production database or one that is shared with something else.

define('DB_NAME', 'wordpress_test');    // The name of the database
define('DB_USER', 'root');     // Your MySQL username
define('DB_PASSWORD', ''); // ...and password
define('DB_HOST', 'localhost');    // 99% chance you won't need to change this value
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('WP_TESTS_DOMAIN', 'example.org');
define('WP_TESTS_EMAIL', 'admin@example.org');
define('WP_TESTS_TITLE', 'Test Blog');

define('WP_PHP_BINARY', 'php');

define('WPLANG', '');

$table_prefix  = 'wptests_';   // Only numbers, letters, and underscores please!