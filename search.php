<?php
require_once('resources/init.php');

if(!isset($_GET['search'])) {
    header("Location: index.php");
    die();
}

$tags = explode(',', $_GET['search']);
$posts = [];

foreach($tags as $tag) {
    $posts = array_merge($posts, get_posts_by_tag($tag));
}

for ($i = 0; isset($posts[$i]); $i++) {
    $c = 0;
    for($c = 0; $i > $c; $c++) {
        if ($posts[$i]['id'] == $posts[$c]['id']) {
            unset($posts[$i]);
        }
    }
}

$element = 'views/elements/search_results.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';
?>