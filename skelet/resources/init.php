<?php
//require_once('config.php');

$connect = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('blog_project');

include_once('func/blog.php');

define( 'DX_ROOT_DIR', substr(dirname( __FILE__ ), 0, strlen(dirname( __FILE__ )) - strlen('resources')) );

?>