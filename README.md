This repo is a bareboned example of how to integrate a github repository with Travis CI and run wp unit tests in Travis CI.

#### Setup your Travis CI account and hook it to your github repository. 

#### Setup your github repository.

Basically it should contain a wp-content folder together with a .gitignore file.

The .gitignore file should contain at first the rules to ignore all wp root folders and files. Example: 

	/wp-admin
	/wp-includes
	/*.php
	/*.txt
	/*.html
	/.wp-tests-db-version
	/.htaccess

#### Add Travis CI config file to the repository

In the root of your repository add a file called .travis.yml . This file contains the instructions needed for setting up the environment on travis-ci.org. The .travis.yml in this repo is a working example for the current files contained by this repo. More instructions on what you can do with this file can be found at http://about.travis-ci.org/docs/user/build-configuration/

#### For writing unit tests I recommend using https://github.com/nb/wordpress-tests . 

I cloned this repository into my wp-content/plugins folder. 

You'll notice this repository has a file called unittests-config-sample.php . Copy this file in wp-content folder of your repository. 

Edit this file and set ABSPATH to /home/vagrant/builds/YOUR_REPOSITORY ( example: define( 'ABSPATH', '/home/vagrant/builds/sanislav/Travis/' ); ). To be sure of the correct ABSPATH add the '- pwd'  command to the .travis.yml config file at the beginning of the 'before_script' section and make a push. Go to travis-ci.org and watch the outcome of your push. Check for the output of the 'pwd' command. This will be the absolute path in the travis environment to your project. After you make sure to use this path in the unittests-config-sample.php, remove the '- pwd' command from the .travis.yml config file.

Add the Travis CI DB credentials. These should match the ones used in .travis.yml config file. This example uses 

	define( 'DB_NAME', 'wp_travis' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );

As a note, by default Travis uses root as a user with no password.

The settings in .travis.yml file for mysql show the following settings:

	mysql:
	  adapter: mysql2
	  username: root
	  encoding: utf8
	  database: wp_travis

This reads to : db name = "wp_travis"; db user = "root"; db password = ""; db host = "localhost";

#### Copy a wp-config-sample.php file to wp-content folder in your repository.

In this file fill in the DB credentials to match the ones set in .travis.yml and also in the wordpress-tests config described above.

Prepare a database dump of your project and store it in the wp-content folder. This file will be imported in the travis environment. This example uses a file called wp_travis.sql. If you decide to rename it also update .travis.yml at the line where db is imported:

	mysql wp_travis < wp-content/wp_travis.sql

#### Make a git push.

Switch to travis-ci.org and watch the outcome of your instructions from .travis.yml.

The config states that phpunit will be used and the wp-content/plugins/wp-tests/test_test.php script will be run. Write your own scenarios, add them to wp-content/plugins/wp-tests/ and run them by editing .travis.yml "script: " section