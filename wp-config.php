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

define( 'DB_NAME', 'portofolio' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('FS_METHOD','direct');

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
define( 'AUTH_KEY',         '^d<r!;%vp;P`P9:nIa 9GNOgy1C%>uZ`)P$L?PG1oLUvsdH!^9Ob$drf>s[}#$X}' );
define( 'SECURE_AUTH_KEY',  '  2)1qA%C7jR@F;Q=w&VZvEDS(325)>[7Wj5M$QL%E@<EJKtPn|!m:]zbImL[*T!' );
define( 'LOGGED_IN_KEY',    '2k&W@`%Y2WQ{bEB@r2Jb.2V8>R>QMQUgmM9WIPVs{1w6SYHcCYJOek*Vs!O7)d<)' );
define( 'NONCE_KEY',        'FQu[X _]PnDjJUypDa(YBc`=9:biK>~C*AOw:%16fs.GGK#:/zf|hT:-,m3_y;@f' );
define( 'AUTH_SALT',        'Z]| 7AS$lB5#9)Uo$TrQ0m<E+1tjet@E@DEOCfz>f0<2v)N6FKmY] f>t?|J%5g+' );
define( 'SECURE_AUTH_SALT', 'c6gTz=^u5xC`H@6SsY.$ tj18`.Z>U;x#wdvNY6Nix8?~dH6oM3m/f7~8U|YRm9,' );
define( 'LOGGED_IN_SALT',   'of>R.^w6U#WQy4 BzVcX4Okl6IW8Vq  =m2L,jYdQIM48%)W>Z{F3GM5m`E^q t=' );
define( 'NONCE_SALT',       'foyy*M&u[ yJD/HC5neW^CtomGLEMI-rSaXrboa.h()56j1&6~NLE5/p>Zm(Vyqy' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
