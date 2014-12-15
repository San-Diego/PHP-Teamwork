<?php
require_once('resources/init.php');

$posts = isset($_GET['id']) ? get_posts($_GET['id'], null, $db) : get_posts(null, null, $db);
$show_comments = count($posts) == 1;

if($show_comments) {
    $comments = get_comments($posts[0]['id']);
    increase_visits($posts[0]['id']);
}
// $element =  path to the html element you need e.g. form, aside, post... DX_ROOT_DIR . /views/elements/placeholder
$element = 'views/elements/welcome_screen.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';

?>


 