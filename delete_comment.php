<?php
require_once('resources/init.php');

$id = $_GET['id'];
$post_ID = $_GET['post_ID'];
delete('comments', $id, 'id', $db);

header("Location: index.php?id={$post_ID}");
die();
?>