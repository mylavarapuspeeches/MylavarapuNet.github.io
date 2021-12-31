<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'FORCE_SSL_ADMIN', true ); // Redirect All HTTP Page Requests to HTTPS - Security > Settings > Secure Socket Layers (SSL) > SSL for Dashboard
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home1/himamsu/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'himamsu_wrdp1');

/** MySQL database username */
define('DB_USER', 'himamsu_wrdp1');

/** MySQL database password */
define('DB_PASSWORD', '4Uk0T7Uu23MFXY');

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
define('AUTH_KEY',         'D(D|BMWyMD2SNMaLVEziCoZ:#3IfZC#<:ZXg()M-H7vTr3M!WO5pyNLl\`1GO!rr8PTpS?U');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    ':WeSMpiUf<8fY~Hs0AT#HLg53E#6VPMnJ;nJCAqqgxcy*dge*=7g>l/Y(RN?Ub9#rU$QWj|a9');
define('NONCE_KEY',        'i4LX6Cj3(v*#lztpb:g)xTDrr|AWeIpv2~mA9*@16|8<l~/T~70W8p3pujCFds:AD4>L6azE$8_N1:QG');
define('AUTH_SALT',        'g094RxWBz)BNfN_EdlULn<p0#Txi4Ub56Fb)E)aeU*/@eJO!m9~!4uQxFX4|p^A');
define('SECURE_AUTH_SALT', '>Rr:;v_6jOXqzE!);$jp*-IDPRr^=Ya?f3A~$)vrE1u!nVwsF3*JhYy#e/iipcsUXbO|TG~D/C$Vt');
define('LOGGED_IN_SALT',   'UuT?_@1V;HS7#0>>\`$3Ek6f/A@\`H(1yK#Jp>C>f/v83!zd=*7<Rs\`jmBTCWqOL$x<P|*6w#\`DKEP^~');
define('NONCE_SALT',       'NGvAtWXFo*lfy9s$vGwWJj$~zVzwCRSZfB7mVahYzFv^3LA0kc(PScKXQD|0_p?Q|BV|Zvv)8');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each a unique
* prefix. Only numbers, letters, and underscores please!
*/
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
