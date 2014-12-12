<?php
require_once('resources/init.php');

unset($_SESSION['user']);

header("Location: login.php");
die("Redirecting to: login.php");
?>