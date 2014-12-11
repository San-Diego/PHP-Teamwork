<?php

require_once('resources/init.php');

if(isset($_POST['title'], $_POST['contents'], $_POST['category'])) {

    $errors = array();

    $title = trim($_POST['title']);
    $contents = trim($_POST['contents']);

    if (empty($title)) {

        $errors[] = 'You need to supply a title';

    } elseif (strlen($title) > 255) {

        $errors[] = 'The title cannot be longer than 255 chars!';
    }

    if (empty($contents)) {
        $errors[] = 'You need to supply some text';
    }

    if (!category_exist('id', $_POST['category'])) {
        $errors[] = 'That category does not exist';
    }

    if (empty($errors)) {
        add_post($title, $contents, $_POST['category']);

        $id = mysql_insert_id();

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

