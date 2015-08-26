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
define('DB_NAME', 'anaximander');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '1l0vep@1n');

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
define('AUTH_KEY',         '5fJ%Qa9{C=?g0Jp^T+C7mc1bO<I5)toT2<E?1EFMDu#l5T!!V$-m |IEJd|7MhB~');
define('SECURE_AUTH_KEY',  'w]oyCI,hNGNv<Bh+k!M*XYi$Cqm51@}Q {t;mU^NKS65O!-J6^R_a5_&7ziw$Xzu');
define('LOGGED_IN_KEY',    'P(//*k8ik12hk-z)!y-N4|#;OLeP@4+mfC*u C -3,(|q9* Z_fevYhs|1Z>##4j');
define('NONCE_KEY',        '[b+;|q&|nMS|qBK-/R$XNUWql-tLxi$:boRV>-;L;[Xyeer D25VajSB4z,1rtMx');
define('AUTH_SALT',        'eIZ8wo*{+~KH-{(dC>)!pWOk.42$JqE,lG!Wwec7#y_zsbLe%_,SO:|+p>r+$3f.');
define('SECURE_AUTH_SALT', '/_!h+>>?D@Pf0{JPP1PAv-<lb7US~Vr[p-.N^G6H(-8J4!BDOVK<7Z]<%S7~z4qA');
define('LOGGED_IN_SALT',   'sfMcq-7C-[G*q0-y/nCZ-,)|AIjP`n-EQj.w0r#PJI?A[PUsh5c9w]aC<-G1rm7H');
define('NONCE_SALT',       'GiPF2]WypVg+9D wtwXctpsBIgyJ.GxpNe*J/2R>Mpp$O2W!5l@eGl`1L[Veq{ma');

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
