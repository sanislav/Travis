#!/bin/bash

wp_tests_dir=${1-$WP_TESTS_DIR}

if [[ '' = $wp_tests_dir ]]; then
	wp_tests_dir='../../plugins/nb-tests/'
	# echo 'usage: ./bin/test /path/to/wp-tests/'
	# exit
fi

wp_dir=$(pwd)

cd $wp_tests_dir

phpunit --no-globals-backup $wp_dir/wp-content/plugins/wp-tests/test_test.php
# cd wp_dir