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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'password' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '5t=+6RXPTld|RKG9lX6K>2Bz;a42EfIwfU2 jwS3?LQ_aNc6:fus%vqG=)a !?|c' );
define( 'SECURE_AUTH_KEY',  '*lq6F&OUtg;63e@CN/mM(<N6U 4vg8ci_|nIy5pgd-xp.C,t{q$LW@a!.RH/uv?}' );
define( 'LOGGED_IN_KEY',    'QR}NvJ7QB+Uq4X>JObVfCZR sl/4(HI=>CC?AR3#)NAcr&^KsVZb*Y)^s1IfTNZ;' );
define( 'NONCE_KEY',        'x<6F$_K@WFDsl[S/*T$r*/cEtmAaR{it6:1Z{B$d[gZbYcW>rH#]hDFVgX0Ro}83' );
define( 'AUTH_SALT',        '3Ltn5RCv_kH@bzcIbq6Kblz4X-xWa*2=+fBp=>7<{OY-FH@IX|/%6x&`r:F~ZR+.' );
define( 'SECURE_AUTH_SALT', ']2hU0]fcy]N$6s+i0M-5BW|T/V|4C(D5!fg@aVgw#QiTYZ5$%`1l<,3V_9zeK|mR' );
define( 'LOGGED_IN_SALT',   '/xA,Xp8d+m:btRel:j0VWH5 `dSV:7?UfbCN;sWgSzv#^)_4s,x6*SmCCIIkSQ~L' );
define( 'NONCE_SALT',       'F%5%51f+Lb4xJpUeyLGhJkm;B{.ab:Yy%.,*.L g45<C1w[z/XDCcfR.P%,;6XwW' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
