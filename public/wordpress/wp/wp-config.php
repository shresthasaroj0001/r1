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
define( 'DB_NAME', 'shellyto_wp80' );

/** MySQL database username */
define( 'DB_USER', 'shellyto_wp80' );

/** MySQL database password */
define( 'DB_PASSWORD', '5Rp1(T2S7)' );

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
define( 'AUTH_KEY',         '10istshadwen4rhpjgxgj4a1ujwdzb16v0oiwfsjkyqu6pnyxfjnlofrl1plhmzr' );
define( 'SECURE_AUTH_KEY',  '3kduwk1hbugerjguerdhzrle8zyebolcj8q69ivqtirzd74guqi5xxjarpu3xmat' );
define( 'LOGGED_IN_KEY',    'l1xjswjpnplwb0ivq50yjqlogl0vy8bjdrksmgjwgn8ojkbsj7pm9wodjyhozvus' );
define( 'NONCE_KEY',        'par8vj0eiuutzqmpp606t6cnzd5r37lxc0z3ykfoubwyw1blv7nynorunf2sws8f' );
define( 'AUTH_SALT',        'v1n360aet4cebsvf016ju5xkjma0fijohzb3ujk1mkv5cxr6h06p2qrj92ay3ble' );
define( 'SECURE_AUTH_SALT', 'c9orze26gjgv3mqdwwxme4mj4kyphobga3tevxoqbtklnxbsjbvynmotnzoss1ff' );
define( 'LOGGED_IN_SALT',   'yovkmotxgtpgjcnbxnd5tabawrifhfuosxrm7o16snt4w651pzrtuhu3p7njqfob' );
define( 'NONCE_SALT',       'fdwplv82gcoalimjpjggebwdqajaoyjidnolgl4w9tkrbylyneoskxfhgroetbta' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpsfr1_';

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
