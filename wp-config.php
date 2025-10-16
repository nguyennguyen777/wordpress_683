<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_683' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'Fv$L%Nfusk*5)fcH}OWI&N+#8.tI`AxFb#rE-5{wCtNJzr?cwe-miA&ZQ3f;F#3f' );
define( 'SECURE_AUTH_KEY',  'nJ/zV*A`Rwm#q80t3>O=M!/Sou~bm]3% x@d_YIb>kzX;3]cUk!n&b[E2@~VbM$W' );
define( 'LOGGED_IN_KEY',    'E`rF:l0#_FBHhpbX%j,Y,RU6/ &P-KN1<0OzB*|hu1zT7[D3&?J@2N.&maUYO)[a' );
define( 'NONCE_KEY',        'lleh gF|l5;7I/[&-OVa7~3x)QFtBoWfEory(!/8IOS]9Tw/NQ85-]ZYv9gDxoxL' );
define( 'AUTH_SALT',        'KqHS.O=_ZS^IkZ5#CT#4!Q-ywaiIdC0W?lbK/&*+o!dC$Z{U IfjW+DQ:ZNnSFSG' );
define( 'SECURE_AUTH_SALT', 'BC>OOPH1j[*gVr1pl>YLGWg_9mW+`l.K%H#q($TA8g(HTQ_$F;NbS<pF>=,6bG]y' );
define( 'LOGGED_IN_SALT',   'GrKpdAYs@> 0)}f6xdNG =s~qDy&-oS4mFE&]Ys%5K9n}HuIQt9(;F`1e9$<^d[S' );
define( 'NONCE_SALT',       '{IQK.L_*<?;AOf`|*>G[ktnDWRnh?:g1k2UN`CmmdKyocxuTQCw$94Us,FTLQ:l?' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
