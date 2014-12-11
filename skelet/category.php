<?php
require_once('resources/init.php');

$posts = get_posts(null, $_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1"/>
    <style>
        ul{
            list-style-type: none;
        }
        li{
            display: inline;
            margin-right: 20px;
        }
    </style>
    <title>Team San Diego's Blog</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Index</a></li>
            <li><a href="add_post.php">Add a Post</a></li>
            <li><a href="add_category.php">Add a Category</a></li>
            <li><a href="category_list.php">Category List</a></li>
        </ul>
    </nav>

    <h1>Team San Diego's Awesome Blog</h1>

    <?php display_content($posts); ?>
</body>
</html>
 