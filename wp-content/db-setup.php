<?php 

$query = file_get_contents( './wp-content/wp_travis.sql' );

$link = mysql_connect('localhost', 'root', '');

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("wp_travis", $link);

mysql_query( $query );

$select_test = mysql_query( "SELECT * FROM `wp_users` WHERE ID = 1" );

var_dump($select_test); die;

mysql_close($link);
?>