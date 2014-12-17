<?php

if($_SESSION['user']['admin'] != 1) {
    header('Location: index.php');
    die();
}

require_once('resources/init.php');

$post = get_posts($_GET['id'], null, 0, 1);
$post_id = $_GET['id'];

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

    if (!category_exist($_POST['category'], $db)) {
        $errors[] = 'That category does not exist';
    }

    if (empty($errors)) {
        edit_post($post_id, $title, $contents, get_category_id($_POST['category']));

        header("Location: index.php?id={$post_id}");
        die();
    }
}

$element = 'views/elements/edit_post_form.php';
include_once DX_ROOT_DIR . 'views/templates/default_template.php';

?>


<?php
if(isset($errors) && !empty($errors)) {
    echo "<ul><li>".implode('</li><li>', $errors)."</li></ul>";
}
?>


 