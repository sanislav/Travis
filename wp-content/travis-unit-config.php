<?php
/* Path to the WordPress codebase you'd like to test. Add a backslash in the end. */
define( 'ABSPATH', '/home/vagrant/builds/sanislav/Travis/' );

define( 'DB_NAME', 'wp_travis' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

define( 'WPLANG', '' );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* Cron tries to make an HTTP request to the blog, which always fails, because tests are run in CLI mode only */
define( 'DISABLE_WP_CRON', true );

$table_prefix  = 'wp_';