<?php
require_once('resources/init.php');

$posts = get_posts(null, $_GET['id'], $db);
$categoryName = $_GET['name'];
$element = 'views/elements/category.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';
?>


 