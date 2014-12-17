<?php

require_once('resources/init.php');

if(!isset($_GET['id'])) {
    header('Location: index.php');
    die();
}

$id = $_GET['id'];

$tags_name = get_tags_by_post($id);

foreach($tags_name as $tag_name) {
    decrease_tag_count($tag_name);
}


delete('posts', $id, 'id', $db);
delete('comments', $id, 'post_id', $db);
delete('blog_post_tags', $id, 'blog_post_id', $db);

header('Location: index.php');
die();

?>
 