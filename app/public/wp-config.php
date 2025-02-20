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
define( 'AUTH_KEY',          '/=e!-z+#=Oj`:5~X Lw5V*G$,<|uiPg8ak8pl,;B |()QG1amo**uO`O*BIyB@+Y' );
define( 'SECURE_AUTH_KEY',   ';@sl`mu?x_7Yj4JykN/_/$@UOYS1A61}T:JS?K6FCUl#tCgvQC$t+8hoVpRQ4hD`' );
define( 'LOGGED_IN_KEY',     '>Kl[QF1qRqiRg}AfNk/CHf^0O%wY=@)geAXuV}%n}Yz5Rnsx:ui`vfyjj!y>85H4' );
define( 'NONCE_KEY',         'K?J>6rE1P}~# 7H?xQK:f1LUSfO2sB)uqQKfbFn+z0X~32G<u-Pd4Bp5(dt7RuM1' );
define( 'AUTH_SALT',         'stY`bvmr=V=%[@JRh.-9W[0Y3 ^SiwgJTzB:FTu6>3Cf!u!=&U.mNj]mp!9J*iil' );
define( 'SECURE_AUTH_SALT',  'T(<V=wPOpedf)zZDgivS3]s&h&*R(8ULsKue5:LPj]htteG1`JNtRr=,ee03/t<a' );
define( 'LOGGED_IN_SALT',    'Khn}pn-sptO)Lin@ll*8/![yhUpR<BqtWXfrDZ-^P&(un6gm}Od&1pRPO@1HPyfN' );
define( 'NONCE_SALT',        'y[i1XJcjOaOdIdfj{{ou1+Ys@7h{$C3DeW/7yZ]Ckk0FwZxM]kI8W^z=NIpMJ/^^' );
define( 'WP_CACHE_KEY_SALT', 'eA:=|7,EgM4/>A1Ehrdor-s?+h(U}x;:`@s^&N.9~{}s$K|d*Y:eIj*,j`3>_7{j' );


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
