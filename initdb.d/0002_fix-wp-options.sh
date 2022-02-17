# fix hostname

docker_process_sql << EOF
UPDATE ${WORDPRESS_TABLE_PREFIX}options SET option_value = '${WORDPRESS_SITE_URL}' WHERE option_name = 'siteurl';
UPDATE ${WORDPRESS_TABLE_PREFIX}options SET option_value = '${WORDPRESS_SITE_URL}' WHERE option_name = 'home';
EOF

