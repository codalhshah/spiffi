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
define( 'DB_NAME', 'spiffi_spiffiwp' ); //this is db for development server

/** MySQL database username */
define( 'DB_USER', 'spiffi_spiffiwp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'aNb+,dp5)24[' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

//define('WP_HOME','http://spiffi.biz');
//define('WP_SITEURL','http://spiffi.biz');

define('WP_HOME','http://localhost/spiffi');
define('WP_SITEURL','http://localhost/spiffi');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'N9xm(meieYU*f=Z-Khc@/oPH^WLfg^@MqS]VEE9?PE/~Cb+I0RBf^uwZ6B[o2NNQ');
define('SECURE_AUTH_KEY',  '!nD0jOk6$@VHLZvIDLdUfgQI6A1w4$KwX[8Sz:8j?K})i;ee<k4=f.2KI=]5FdB^');
define('LOGGED_IN_KEY',    'NE$#i|v;v U=Z`):_jb1jEtK-{y?8Gpn]952dOEHan:Q]0F]r_%_-P9,;Veog_p5');
define('NONCE_KEY',        'e &9_GK>pLilTm|9rV=OaLn%WUnDg^|y=IZ_sX;eoAn0 R= O]Zb6ht>Jq`%n:wt');
define('AUTH_SALT',        '$5X{,3@wIhIH`cXT+3s,!g$C$T]mXc1sEve93/6%kM%xAaUQ]mgU|eOI7(ju]UC}');
define('SECURE_AUTH_SALT', ')A!4Dz9!t_ZI1[4l+%G:~tu_7Q)^ToU9g{*Ws={!qp3OH99&VEE/ItK#G%T_.[=$');
define('LOGGED_IN_SALT',   'y]Aqgkt[X-q@T]~ja+YO,u#Q`J,4tvbm<Jj<b[D)L/59gkOr5JzJ0dTBSb:!US|,');
define('NONCE_SALT',       'Ki+8{EygFi3PNr5dzN%k8in_}mzN3|/n#MEJVv-V&c3Xk_JGFGH;)u.SnbJa}:)8');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'nspiffi_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
