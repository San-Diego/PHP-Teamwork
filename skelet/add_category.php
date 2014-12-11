<?php

require_once('resources/init.php');

if(isset($_POST['name'])) {
    $name = trim($_POST['name']);

    if(empty($name)) {
        $error = 'You must submit a category name!';
    } elseif(category_exist('name', $name)) {
        $error = 'That category already exists';
    } elseif(strlen($name) > 30) {
        $error = "Category names can only be up to 30 chars.";
    }

    if(!isset($error)) {
        add_category($name);
    }
}

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <title>Add a Category</title>
</head>
<body>
    <h1>Add a Category</h1>

    <?php
    if(isset($error)) {
        echo "<p>$error</p>";
    }
    ?>

    <form action="" method="post">
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" id="name"/>
        </div>
        <br/>
        <div>
            <input type="submit" value="Add Category"/>
        </div>
    </form>
</body>
</html>

<?php
  
?>
 