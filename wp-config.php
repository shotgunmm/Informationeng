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

define('WP_CACHE', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'informationeng_wp');

/** MySQL database username */
define('DB_USER', 'informeng_wp');

/** MySQL database password */
define('DB_PASSWORD', 'P52cwT#PYB4@');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'T&(Q)e]!KOX};hr]+a)w?w*bXwA7Esf||d.Ga6>6]<N#]EpZT )[l <2a7,r;m>g');
define('SECURE_AUTH_KEY',  'dq+;^XbE$.}{`e<G=J&4EDYo1;oA=gzLu6Ycn%4Os%+uR((HN7P|FPm0W!dU{?e@');
define('LOGGED_IN_KEY',    'Uir2U6~rW2iNTfiE#OM15pBIA:;6hha28Rl$Yobq{N9/{YZ]Dn:5KwZi.+L~[/-X');
define('NONCE_KEY',        'l/#IBL$5(vQH/JhWeoMAhN%Ar@#_1,Xx@|EysZVh|p+bF&FH]+R.y!UPS}SmZA@)');
define('AUTH_SALT',        '2|9|cJT6ZaTH=M9j:McuCtPb#XGOa-0U78s*~I+fq1loX[Ub0u(9Vm/}a:3Ox3%o');
define('SECURE_AUTH_SALT', 'w[|+qS?y,7yu{TW>z>ARI|:XT{tGN}A+81~1VvXI M<#+EWZgiu&t[m+OgTbS%}H');
define('LOGGED_IN_SALT',   'Urv% ^S(waAs3N7^n]J*J4)N3Ap+>iMO?V27tk-kt}z)hftcJ-f!S+;#|a{zDM(7');
define('NONCE_SALT',       '}5c&p,v^[LvJ;ELxVZj3;|^~A|PYg$k4Vf-=NC0|4*a!GgY)vbvX)+=}0k/PY=k-');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
