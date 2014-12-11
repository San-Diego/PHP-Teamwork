<?php

require_once('resources/init.php');

if(isset($_POST['name'])) {
    $name = trim($_POST['name']);

    if(empty($name)) {
        $error = 'You must submit a category name!';
    } elseif(category_exist('name', $name)) {
        $error = 'That category already exists';
    } elseif(strlen($name) > 30) {
        $error = "Category names can only be up to 30 chars.";
    }

    if(!isset($error)) {
        add_category($name);
        header('Location: add_post.php');
    }
}

$element = 'views/elements/add_category_form.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';
?>


 