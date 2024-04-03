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
define( 'AUTH_KEY',          '`OoSMk:s{+[y%y*.>=H.z4Y>j}#eKzti` ^LuzRrcLrN9}/gFr<ru3%!AUtf B}$' );
define( 'SECURE_AUTH_KEY',   '<e)]O!J9(2D`|Qx{[qW>Lq*P7j^9>N3u)nk##jAWTt#EQPpY6>dzEZp7!-38_U6N' );
define( 'LOGGED_IN_KEY',     '[0XZ-uq20kGjb!CVTEHa%zG!jq`,8wy &E.R4bPULOAnSMG,u_!h% 0xSEC,lr6-' );
define( 'NONCE_KEY',         '$SN+4 $w/TCRJczA`Wj~+,Z8>7j~HIZ{ZM1*^?@%LzN_MsKxDP=*Nv;7tVR|M4uD' );
define( 'AUTH_SALT',         'S3,CeEi$nIXZ^]Vp(I0=)os[%tVa/1I{*)To$)!}if:TCv.tJfg?$^l#s;OippKC' );
define( 'SECURE_AUTH_SALT',  '=>a)a8,2a+|}9g{pX6lgvI{)[(14e!_~O()UVS`MDzP`cwg0?T~SX]h?&GgH&B7Z' );
define( 'LOGGED_IN_SALT',    'pKHlfRH3_(rV7N*7+R(!Rl%$r=X+#1F8*-Qup;XHAiu{h2>aPh:s~ms@CF.]|6>@' );
define( 'NONCE_SALT',        '(wAc(  U*AICds]z2X;/%y[In0~pPaw,{`[./dUj}Nc/tqv/e/$(lNEc0ea+@<(k' );
define( 'WP_CACHE_KEY_SALT', 'zk3HMmUL36|dI0C]5Jk->fc_E0{@BC ZEk._=$U3r=Z!#p/w%W<^*.yc AcQ273-' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
