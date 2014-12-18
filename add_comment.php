<?php
require_once('resources/init.php');

$errors = [];
$post_ID = $_POST['post_id'];

if (empty($_POST["content"]) || strlen($_POST["content"]) > 255) {
    $errors[] = "invalid comment";
}

if (!isset($_SESSION["user"]) && (empty($_POST["user_name"]) || strlen($_POST["user_name"]) > 20)) {
    $errors[] = "invalid user name";
}

if (!empty($errors)) {
    header("Location: index.php?id={$post_ID}");
    die();
}

$content = $_POST["content"];
$user_name = isset($_SESSION["user"]) ? $_SESSION["user"]["username"] : $_POST["user_name"] . " - guest";

add_comment($post_ID, $user_name, $content);
header("Location: index.php?id={$post_ID}");
die();