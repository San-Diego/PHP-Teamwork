<?php

if($_SESSION['user']['admin'] != 1) {
    header('Location: index.php');
    die();
}

require_once('resources/init.php');

$id = $_GET['id'];
$post_ID = $_GET['post_ID'];
delete('comments', $id, 'id');

header("Location: index.php?id={$post_ID}");
die();
?>