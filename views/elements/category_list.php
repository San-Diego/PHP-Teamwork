<h1>Category List</h1>
<?php

foreach (get_categories() as $category):
    ?>
    <p>
        <a href="category.php?id=<?=$category['id']?>"><?=$category['name']?></a> -
        <a href="delete_category.php?id=<?=$category['id']?>">Delete Category</a>
    </p>
<?php endforeach; ?>