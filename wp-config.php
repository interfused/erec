<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
define ('WP_CONTENT_FOLDERNAME', 'assets');
define ('WP_CONTENT_DIR', ABSPATH . WP_CONTENT_FOLDERNAME) ;
define('WP_SITEURL', 'http://demo.eyerecruit.com/');
define('WP_CONTENT_URL', WP_SITEURL . WP_CONTENT_FOLDERNAME);
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'eyerec5_demo');


/** MySQL database username */
define('DB_USER', 'eyerec5_ifused');


/** MySQL database password */
define('DB_PASSWORD', 'eyer3cru1td3v');


/** MySQL hostname */
define('DB_HOST', 'localhost');


/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'px)3-+aVC |Hi%b-aos.;8RPM2.gmtETzu=ELPuGLr5S6|&j~xHDY5E]Fak0wWtb');

define('SECURE_AUTH_KEY',  'eqfg0!WT-[bN`v-aGJY_>Uc|3V,AG+O-Ia:J%(>[?4jat9C}. }+xpxps-Q~%;p0');

define('LOGGED_IN_KEY',    '~$3[~Cb1EWu+MDNgw)6|X_N&]]j`?C}^)|ICC/X!opW#Y:ZxM7meKg39&;etY}c1');

define('NONCE_KEY',        ' 4goo~<*bcNp5/8mBpHTX0iDf3OI}8MZY?NxcOTa2nvI^}e>.Ce#:lz*sxo#)tth');

define('AUTH_SALT',        '8+|mgH$SO3Rb.jPEOBZ1B5qY2LGY4aO=khY+I-,@enU1Vz+s]0xbZy[GQ$1xT)CI');

define('SECURE_AUTH_SALT', 'D2B0A[9ZL;zDxmym-N/jh25i@kxf6E]{Jprn1oZj:qvFpYt5px{qEZ)5b~@Xc?.#');

define('LOGGED_IN_SALT',   'S4/[{jryLJHM=5[Vgg*<8E7/_BP3ku0%Bw9N0-?+7nVf |lqJB=gXAF_ZErJSD,r');

define('NONCE_SALT',       'cs3Ex7EW<(51@up6tc~($!oO>p_m<]yg01]kHOxm:{Bsuuac@fQY[zt0 T%]wn:V');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'eyecuwp_';


/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
/**
 * This will log all errors notices and warnings to a file called debug.log in
 * wp-content (If Apache does not have write permission, you may need to create
 * the file first and set the appropriate permissions (i.e. use 660) )
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
