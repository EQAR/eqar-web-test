<?php

// from https://github.com/docker-library/wordpress/blob/master/latest/php7.4/apache/wp-config-docker.php

// a helper function to lookup "env_FILE", "env", then fallback
if (!function_exists('getenv_docker')) {
	// https://github.com/docker-library/wordpress/issues/588 (WP-CLI will load this file 2x)
	function getenv_docker($env, $default = null) {
		if ($fileEnv = getenv($env . '_FILE')) {
			return rtrim(file_get_contents($fileEnv), "\r\n");
		}
		else if (($val = getenv($env)) !== false) {
			return $val;
		}
		else {
			return $default;
		}
	}
}

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
define( 'FORCE_SSL_ADMIN', false ); // Force SSL for Dashboard - Security > Settings > Secure Socket Layers (SSL) > SSL for Dashboard
// END iThemes Security - Do not modify or remove this line

define( 'WP_CONTENT_DIR', '/var/www/html/assets' ); // Do not remove. Removing this line could break your site. Added by Security > Settings > Change Content Directory.
define( 'WP_CONTENT_URL', getenv_docker('WORDPRESS_SITE_URL', 'http://localhost:8080') . '/assets' ); // Do not remove. Removing this line could break your site. Added by Security > Settings > Change Content Directory.

// Site URL (overrides the one set in database, if any)
define( 'WP_HOME', getenv_docker('WORDPRESS_SITE_URL') );
define( 'WP_SITEURL', getenv_docker('WORDPRESS_SITE_URL') );

define('WP_AUTO_UPDATE_CORE', false);
define('FS_METHOD', 'direct');

// EQAR settings
define('EQARFORMAT', 'json');

define('EQAR_ENV', 'LIVE'); // one of LIVE or TEST

define('EQARBASEURL_LIVE', getenv_docker('DEQAR_WEBAPI_BASE', 'https://backend.sandbox.deqar.eu/webapi/v2/browse/'));
define('EQARCONNECTURL_LIVE', getenv_docker('DEQAR_CONNECTAPI_BASE', 'https://backend.sandbox.deqar.eu/connectapi/v1/'));
define('EQARAUTHKEY_LIVE', getenv_docker('DEQAR_API_KEY'));

# Meilisearch
define('DEQAR_MEILI_BASE', getenv_docker('DEQAR_MEILI_BASE'));
define('DEQAR_MEILI_KEY', getenv_docker('DEQAR_MEILI_KEY'));

# live environemnt
define('EQARDB_BASEURL', getenv_docker('EQARDB_API_BASE', 'https://db.app.eqar.eu/stats/v1/'));
define('EQARDB_AUTHKEY', getenv_docker('EQARDB_API_KEY'));

define('EQAR_CACHE_TIME', getenv_docker('EQAR_CACHE_TIME', 300) ); // long, static lists (countries, agencies) will be stored as transient for that many seconds

define('EQAR_MAP_ADDITIONAL_COUNTRIES', array(115, 268, 273) ); // Monaco, Kosovo, BE German Community
define('EQAR_MAP_MICRO_STATES', array(4, 99, 101, 108, 115, 148, 188, 273) ); // Andorra, Liechtenstein, Luxembourg, Malta, Monaco, San Marino, Holy See

# ESCO API
define('ESCO_BASEURL', getenv_docker('ESCO_BASEURL', 'https://ec.europa.eu/esco/api/'));
define('ESCO_VERSION', getenv_docker('ESCO_VERSION', 'v1.1.1') );
define('ESCO_CACHE_TIME', getenv_docker('ESCO_CACHE_TIME', 300) );

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv_docker('WORDPRESS_DB_NAME', 'wordpress') );

/** Database username */
define( 'DB_USER', getenv_docker('WORDPRESS_DB_USER', 'example username') );

/** Database password */
define( 'DB_PASSWORD', getenv_docker('WORDPRESS_DB_PASSWORD', 'example password') );

/**
 * Docker image fallback values above are sourced from the official WordPress installation wizard:
 * https://github.com/WordPress/WordPress/blob/f9cc35ebad82753e9c86de322ea5c76a9001c7e2/wp-admin/setup-config.php#L216-L230
 * (However, using "example username" and "example password" in your database is strongly discouraged.  Please use strong, random credentials!)
 */

/** Database hostname */
define( 'DB_HOST', getenv_docker('WORDPRESS_DB_HOST', 'mysql') );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', getenv_docker('WORDPRESS_DB_CHARSET', 'utf8') );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv_docker('WORDPRESS_DB_COLLATE', '') );

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
define( 'AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY',         'put your unique phrase here') );
define( 'SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY',  'put your unique phrase here') );
define( 'LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY',    'put your unique phrase here') );
define( 'NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY',        'put your unique phrase here') );
define( 'AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT',        'put your unique phrase here') );
define( 'SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', 'put your unique phrase here') );
define( 'LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT',   'put your unique phrase here') );
define( 'NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT',       'put your unique phrase here') );
// (See also https://wordpress.stackexchange.com/a/152905/199287)

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv_docker('WORDPRESS_TABLE_PREFIX', 'wp_');

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
define( 'WP_DEBUG', !!getenv_docker('WORDPRESS_DEBUG', '') );

/* Add any custom values between this line and the "stop editing" line. */

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also https://wordpress.org/support/article/administration-over-ssl/#using-a-reverse-proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false) {
	$_SERVER['HTTPS'] = 'on';
}
// (we include this by default because reverse proxying is extremely common in container environments)

if ($configExtra = getenv_docker('WORDPRESS_CONFIG_EXTRA', '')) {
	eval($configExtra);
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

