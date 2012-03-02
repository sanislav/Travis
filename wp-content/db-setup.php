<?php 

$query = file_get_contents( './wp-content/wp_travis.sql' );

$link = mysql_connect('localhost', 'root', '');

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("wp_travis", $link);

mysql_query( $query );

$select_test = mysql_query( "DESCRIBE `wp_users`" );

var_dump($select_test); die;

mysql_close($link);
?>