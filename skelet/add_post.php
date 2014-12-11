<?php

require_once('resources/init.php');

if(isset($_POST['title'], $_POST['contents'], $_POST['category'])) {

    $errors = array();

    $title = trim($_POST['title']);
    $contents = trim($_POST['contents']);

    if(empty($title)) {

        $errors[] = 'You need to supply a title';

    } elseif(strlen($title) > 255) {

        $errors[] = 'The title cannot be longer than 255 chars!';
    }

    if(empty($contents)) {
        $errors[] = 'You need to supply some text';
    }

    if(!category_exist('id', $_POST['category'])) {
        $errors[] = 'That category does not exist';
    }

    if(empty($errors)) {
        add_post($title, $contents, $_POST['category']);

        $id = mysql_insert_id();

        header("Location: index.php?id={$id}");
        die();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <style>
        ul {
            list-style-type: none;
        }
        li {
            display: inline;
            margin-right: 20px;
        }
        label{
            display: block;
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

    <h1>Add a Post</h1>

    <?php
    if(isset($errors) && !empty($errors)) {
        echo "<ul><li>".implode('</li><li>', $errors)."</li></ul>";
    }
    ?>

    <form action="" method="post">
        <div>
            <label for="title">Title: </label>
            <input type="text" id="title" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title'] ?>"/>
        </div>
        <div>
            <label for="contents">Contents: </label>
            <textarea name="contents" id="contents" cols="50" rows="15"><?php if(isset($_POST['contents'])) echo $_POST['contents'] ?></textarea>
        </div>
        <div>
            <label for="category">Category: </label>
            <select name="category" id="category">
                <?php
                foreach (get_categories() as $category):
                    ?>
                    <option value="<?=$category['id']?>"><?=$category['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <input type="submit" value="Add Post"/>
        </div>
    </form>
</body>
</html>