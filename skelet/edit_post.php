<?php
require_once('resources/init.php');

$post = get_posts($_GET['id']);

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
        edit_post($_GET['id'], $title, $contents, $_POST['category']);

        header("Location: index.php?id={$post[0]['post_id']}");
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

<h1>Edit a Post</h1>

<?php
if(isset($errors) && !empty($errors)) {
    echo "<ul><li>".implode('</li><li>', $errors)."</li></ul>";
}
?>

<form action="" method="post">
    <div>
        <label for="title">Title: </label>
        <input type="text" id="title" name="title" value="<?=$post[0]['title']?>"/>
    </div>
    <div>
        <label for="contents">Contents: </label>
        <textarea name="contents" id="contents" cols="50" rows="15"><?=$post[0]['contents']?></textarea>
    </div>
    <div>
        <label for="category">Category: </label>
        <select name="category" id="category">
            <?php
            foreach (get_categories() as $category):
                $selected = ($category['name'] == $post[0]['name']) ? 'selected' : '';
                ?>
                <option value="<?=$category['id']?>"<?=$selected?>><?=$category['name']?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <input type="submit" value="Edit Post"/>
    </div>
</form>
</body>
</html>
 