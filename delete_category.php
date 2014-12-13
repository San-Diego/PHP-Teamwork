<?php

require_once('resources/init.php');

if(!isset($_GET['id'])) {
    header('Location: index.php');
    die();
}

delete('cat', $_GET['id'], $db);

header('Location: category_list.php');
die();

?>
 