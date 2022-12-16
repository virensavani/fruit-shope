<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */

// define('DISABLE_WP_CRON', true);

// MAIL_MAILER=smtp
// MAIL_HOST=smtp.gmail.com
// MAIL_PORT=587
// mailto:mail_username=iiiem.test@gmail.com
// MAIL_PASSWORD=ykpzcgqvyofjknww
// MAIL_ENCRYPTION=tls
// mailto:mail_from_address="iiiem.test@gmail.com"
// MAIL_FROM_NAME="${APP_NAME}"

// SMTP email settings
define( 'SMTP_username', 'viren.karmaln@gmail.com' );  // username of host like Gmail
define( 'SMTP_password', 'viren@1298' );   // password for login into the App
define( 'SMTP_server', 'smtp.gmail.com' );     // SMTP server address
define( 'SMTP_FROM', 'viren.karmaln@gmail.com' );   // Your Business Email Address
define( 'SMTP_NAME', 'Karmaleen' );   //  Business From Name
define( 'SMTP_PORT', '587' );     // Server Port Number
define( 'SMTP_SECURE', 'tls' );   // Encryption - ssl or tls
define( 'SMTP_AUTH', true );  // Use SMTP authentication (true|false)
define( 'SMTP_DEBUG',   0 );  // for debugging purposes only

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
