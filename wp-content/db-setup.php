<?php 

$query = file_get_contents( 'wp_travis.sql' );
echo substr($query, 0, 10); die;
$link = mysql_connect('localhost', 'root', '');

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("wp_travis", $link);

mysql_query( $query );

$select_test = mysql_query( "SELECT * FROM `wp_users`" );
$select_test = mysql_fetch_array( $select_test );

echo $select_test['user_login']; die;

mysql_close($link);
?>