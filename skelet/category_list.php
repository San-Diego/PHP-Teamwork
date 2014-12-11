<?php

require_once('resources/init.php');

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1"/>
    <title>Category List</title>
</head>
<body>
    <?php

    foreach (get_categories() as $category):
        ?>
        <p>
            <a href="category.php?id=<?=$category['id']?>"><?=$category['name']?></a> -
            <a href="delete_category.php?id=<?=$category['id']?>">Delete Category</a>
        </p>
    <?php endforeach; ?>


</body>
</html>