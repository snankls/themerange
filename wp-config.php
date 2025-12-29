<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

if ( $_SERVER['HTTP_HOST'] === 'localhost' ) {
    define( 'DB_NAME', 'themerange' );
    define( 'DB_USER', 'root' );
    define( 'DB_PASSWORD', '' );
} else {
    define( 'DB_NAME', 'themeran_wp169' );
    define( 'DB_USER', 'themeran_wp169' );
    define( 'DB_PASSWORD', '2pS9(ffV].Y@K5-5' );
    define( 'DB_HOST', 'localhost' );
}

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('DISABLE_WP_CRON', true);

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'gwzkpnbuesh8za8xwiskbpmxaybeqjsavbxbclj2gzm7pflbzouqujbxv4v6qqvg' );
define( 'SECURE_AUTH_KEY',  'vy00uceuxmsrt9ri9apuizsulzvtghuaemhmbkqvsspnh0gcg3l9aiptxfywdad9' );
define( 'LOGGED_IN_KEY',    'ikgtv6bekx8wuqrnvnufpljcly5thr9vg8w4gaf5gxcegprrgqzgn2yuv3y1frgc' );
define( 'NONCE_KEY',        'xr90mesn6iwf4e80m1el9dqul06b5m8ckmhipkhvlmeana3dxw2vnr1r7oohoqft' );
define( 'AUTH_SALT',        'nzxfzvccfw4htlsorbx3dyk4edvao3ncaspzb6glazsvfsf5aztiloja1ypb3od8' );
define( 'SECURE_AUTH_SALT', 'ghtivxliwdb1wl6gb0ebsibywesewzltckmptd8qqdas7enezo7mlphqwnwgbhbz' );
define( 'LOGGED_IN_SALT',   'ynxlr8k8flp2mvxh04ma21nqi5etvfaswaqfylxaphpoq066vjfrwpvqsnbey2sn' );
define( 'NONCE_SALT',       'qu8zijvh1rlbrsg21lj8gjsrdwq5oiua8vu0yqu6lge5mkxwkkzinmfeyz5isxiv' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp8k_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';