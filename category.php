<?php
require_once('resources/init.php');

$posts = get_posts(null, $_GET['id'], 0, get_number_of_rows('posts', 'id'));
$categoryName = $_GET['name'];
$element = 'views/elements/category.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';
?>


 