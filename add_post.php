<?php

require_once('resources/init.php');
if(isset($_POST['title'], $_POST['contents'], $_POST['category'], $_POST['tags'])) {

    $errors = array();

    $title = trim($_POST['title']);
    $tags = explode(", ", strtolower(trim($_POST['tags'])));
    $contents = trim($_POST['contents']);

    if (empty($title)) {

        $errors[] = 'You need to supply a title';

    } elseif (strlen($title) > 255) {

        $errors[] = 'The title cannot be longer than 255 chars!';
    }

    if (empty($contents)) {
        $errors[] = 'You need to supply some text';
    }
    if (empty($tags)) {
        $errors[] = 'You need to supply at least one tag';
    }
    foreach ($tags as $tag) {
        if (strlen($tag) > 255) {
            $errors[] = 'The tag length cannot be longer than 255 chars!';
        }
    }


    if (empty($errors)) {
        add_tags($db,$tags);
        add_post($db,$title,$contents,$_SESSION['user']['id'],$_POST['category'],time());
        $id = mysql_insert_id();
        add_tagsToPost($db,$tagId, $postId);
        header("Location: index.php?id={$id}");
        die();
    }
}

$element = 'views/elements/add_post_form.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';
?>


<?php
if(isset($errors) && !empty($errors)) {
    echo "<ul><li>".implode('</li><li>', $errors)."</li></ul>";
}
?>

