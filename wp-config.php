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
define('FS_METHOD', 'direct');
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hostel');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'rafa2112');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'N.v2;?|N$(Gx62{Jqbmf2l:e?gx:VVn_/#Xb V76GZgfqK/?GxWikG)L}Dc9f*6h');
define('SECURE_AUTH_KEY',  '2z=E6M;Ly;Jtn3#gkrYK@At+SACcH;%6jG|C.j$^xk]|:q/vAo7%/!F72YdJRQKv');
define('LOGGED_IN_KEY',    'HK/Cmpi}&##2{6D.h`0;x#`?TTLthbO)^jAR)/KoG7G_AX%>_A8`G>6Y}m Npa?F');
define('NONCE_KEY',        '/D_gE|xRIToIDhh _/u~2EQ_=(jWL8hK[WI+jsdQ%zlL<XzNiTC5V$DEPj.1=_HQ');
define('AUTH_SALT',        'h@(zw^>R;| E6314P)49Cr8Y8DPr-9RtylJW>22H?0Y2hF:7Dlosnlu`P^Nk>gI;');
define('SECURE_AUTH_SALT', 'u*FWgo^ZI(Sd&cs7+~2K,g4{/NkX@H|{,ut;R}fp;>NQ,b!76Q2Qk{O(d3Hkn(pC');
define('LOGGED_IN_SALT',   'H`c{nV-.!,:M5~JJD0E8nC Sk{2nFE{:4tmfVf7$Fu|nPd4VMv=}r[R%9XgwM2uA');
define('NONCE_SALT',       'F{Y$/tY-<;-w$k/<:gtsc%Bo1g1uCf-dCj:U>B$5D0rbhq%hMZu(f!o+x+2qCGT|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
