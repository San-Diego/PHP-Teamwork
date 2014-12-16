<?php
require_once('resources/init.php');

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$count_of_posts = 3;
$num_posts = get_number_of_rows('posts', 'id');
$offset = $num_posts - $page * $count_of_posts;
$offset = $offset < 0 || isset($_GET['id']) ? 0 : $offset;

$num_pages = floor($num_posts / $count_of_posts);
if($num_posts % $count_of_posts != 0) {
    $num_pages++;
}

$posts = isset($_GET['id']) ? get_posts($_GET['id'], null, 0, 1, $db) : get_posts(null, null, $offset, $count_of_posts, $db);
$posts = array_reverse($posts);

$show_comments = count($posts) == 1;

if($show_comments) {
    $comments = get_comments($posts[0]['id']);
    increase_visits($posts[0]['id']);
}
// $element =  path to the html element you need e.g. form, aside, post... DX_ROOT_DIR . /views/elements/placeholder
$element = 'views/elements/welcome_screen.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';

?>


 