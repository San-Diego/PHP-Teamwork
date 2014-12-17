<?php
require_once('config.php');

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASSWORD, $options);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

session_start();

include_once('func/blog.php');

define( 'DX_ROOT_DIR', substr(dirname( __FILE__ ), 0, strlen(dirname( __FILE__ )) - strlen('resources')) );

?>