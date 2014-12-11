<?php
//require_once('config.php');

$connect = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('blog_project');

include_once('func/blog.php');

?>