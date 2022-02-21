# Docker configuration for WordPress testing/development

## Quick start

 1. Run `update_wp.sh` to fetch/update WordPress core and plugins from Slik-managed instance
 1. Save a fitting database dump in `0001_XYZ.sql`
 1. Clone theme repository into `eqar-wptheme` directory
 1. Run `mkdir -p eqar-wptheme/public/js` and `mkdir -p eqar-wptheme/public/css`
 1. Create `.env` (see below)
 1. Run `docker-compose build`
 1. Run `docker-compose up`

## Environment

Required variables (or technically not, but have no useful default):

 - `WORDPRESS_DB_NAME`
 - `WORDPRESS_DB_USER`
 - `WORDPRESS_DB_PASSWORD`
 - `WORDPRESS_THEME` is the folder in which the theme will be located, will be mounted with same name under /var/www/html/assets/themes in the container
 - `DEQAR_API_KEY`
 - `EQARDB_API_KEY`

These should be something random, per `wp-config.php` documentation:

 - `WORDPRESS_AUTH_KEY`
 - `WORDPRESS_SECURE_AUTH_KEY`
 - `WORDPRESS_LOGGED_IN_KEY`
 - `WORDPRESS_NONCE_KEY`
 - `WORDPRESS_AUTH_SALT`
 - `WORDPRESS_SECURE_AUTH_SALT`
 - `WORDPRESS_LOGGED_IN_SALT`
 - `WORDPRESS_NONCE_SALT`

Optional (with reasonable defaults):

 - `WORDPRESS_DB_HOST`=db
 - `WORDPRESS_SITE_URL`=http://localhost:8080
 - `WORDPRESS_TABLE_PREFIX`=wp\_
 - `GRUNT_MODE`=default
 - `DEQAR_WEBAPI_BASE`=https://backend.sandbox.deqar.eu/webapi/v2/browse/
 - `DEQAR_CONNECTAPI_BASE`=https://backend.sandbox.deqar.eu/connectapi/v1/
 - `EQARDB_API_BASE`=https://db.app.eqar.eu/stats/v1/
 - `EQAR_CACHE_TIME`=300

