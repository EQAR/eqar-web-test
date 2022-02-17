#!/bin/bash

LANG=C
LC_ALL=C
export LANG LC_ALL

RemotePath="websrv.eqar.eu:/sites/staging.eqar.eu/www/"
LocalDest="html/"
Plugins="
	acf-content-analysis-for-yoast-seo
	advanced-custom-fields-pro
	authorizer
	better-wp-security
	classic-editor
	contexture-page-security
	cookie-notice
	duplicate-post
	gravityforms
	gravityforms-acf-field
	infogram
	public-post-preview
	real-media-library
	safe-svg
    user-role-editor
	timber-library
	wordpress-seo
	wp-super-cache
	wp-sync-db-master
	public-post-preview
	"

echo ; echo "Updating ${LocalDest}:"

mkdir -p "${LocalDest}assets/plugins"

echo -n "  * Core: "
rsync -aiu --delete --exclude="wp-config.php" "${RemotePath}{index.php,wp-*.php,wp-admin,wp-includes}" "${LocalDest}" \
    | grep -v '^\.\(d\|f\)' | wc -l

for P in ${Plugins}
do
    echo -n "  * Plugin $P: "
    rsync -aiu --delete "${RemotePath}assets/plugins/${P}" "${LocalDest}assets/plugins/" \
        | grep -v '^\.\(d\|f\)' | wc -l
done


