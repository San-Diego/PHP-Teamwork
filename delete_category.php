<?php
session_start();

if ($_SESSION['user']['admin'] != 1) {
    header('Location: index.php');
    die();
}

require_once('resources/init.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    die();
}

delete('cat', $_GET['id'], 'id');
remove_posts_category($_GET['id']);

header('Location: category_list.php');
die();