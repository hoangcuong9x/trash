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
define( 'DB_NAME', 'banhang' );

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
define( 'AUTH_KEY',         'Z?{+jCHv;0o$[aNzh9LjeCx.Y?cXit(du6WM[9&kDeKy/Lc*d>oP,6c9>CE {}6a' );
define( 'SECURE_AUTH_KEY',  'u1*@rIozTV=ZNg3>0h1CDF]98,J*SM4;n~eNJ0.TPj10qWaal,Z=Np&X3r]sU+38' );
define( 'LOGGED_IN_KEY',    '}R&nglIca#xbjU+PH`$7a4#Y3O*Cg g~CuLA*Xw/|!b-%rL~2O%`79>l;]ws3kSv' );
define( 'NONCE_KEY',        '=2Jd( S+C1g7f~DX1eEJBN{>UbOlL;9&n;D({@C}SFgNCgB%*G`o@KSpo}iB.V[C' );
define( 'AUTH_SALT',        'N4E:EZGlg34``U3N~_Xrb_N~IcjVngck,&W[z&$|.j:!W11{SeRjhcg}o>9S/!#X' );
define( 'SECURE_AUTH_SALT', 'Jc^MkjuugVEO>>AC.<N^c9-@@!&]ev|;+^JUuCkg|!@2(w]/Yb.~?KC#B)LuT~pk' );
define( 'LOGGED_IN_SALT',   'p:Wk?3>.CyFj?bFx{O_E@:;77Gzk9c$s9[H`|aZ[FOPM bg(c`k-r3^1WzcS#n(V' );
define( 'NONCE_SALT',       '217NP%s}&H,}g?9vfQSSx,VVG%H#!/Zg8oRL_0p~Z IGt0795,0bYd-BW_U>LRB2' );

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
