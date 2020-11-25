<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'WP_HOME', 'https://carevalet.my' );
define( 'WP_SITEURL', 'https://carevalet.my' );

define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', 'd5e2fbb7303863e91c4b465bcb879208122105fbe6a1f653' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'x9*]cCS~Cz[<2&oYV* %-uF(j/@P:XC/|cLaKWRE&P>bZ&s4*p.,XKcd3=_6`ZgQ' );
define( 'SECURE_AUTH_KEY',  'K5GF6./fpG6jf(CWk_bl;/$$Bney[)`mn!8p7=}rKz2i84.87_uEh9nP;l%J9 ~A' );
define( 'LOGGED_IN_KEY',    'ffVKTAdc!q=VyW6>HK|`QhpT}%FmHvW&{1FIVhE}FGr1QknkS^cNM!$3l6Z|odWu' );
define( 'NONCE_KEY',        '?/@+yIGf)W. c0M&}1YgB#5JiyQ}%2%`fEf#Z+Yh1%F$a%jP/*jy)O|:x1.1y`S<' );
define( 'AUTH_SALT',        '2dne06=WVD0Xwj%q;T1v!VZl=CeN[M]OPc6`+4SrcQFTmK4Y~4MI4M&jY?X5f14x' );
define( 'SECURE_AUTH_SALT', 'u.ZWcGtz2 WD,.A,GeG65fa*>4qy17[X,uC-6`~|_k$ z@X3lgWhQ#ynu;k~DH) ' );
define( 'LOGGED_IN_SALT',   '#*pX[2/rDyzch+l~80UFY$=UPej^dQpkE#RPm wNFAtlpENA)ZRVuCU EfZHBX#&' );
define( 'NONCE_SALT',       'cA{|us`_zV>rSP<g,/&NGv`_u]iGgEMOk7jl4450$OVx(VJ~~a[}A:a*t6&0e}E]' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
