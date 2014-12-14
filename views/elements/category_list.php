<h1>Category List</h1>
<?php
$categories = get_categories($db);
foreach ($categories as $category):
    ?>
    <p>
        <a href="category.php?id=<?php echo $category['id'] ?>&name=<?php echo $category['name']?>"><?php echo htmlentities($category['name']) ?></a> -
        <a href="delete_category.php?id=<?php echo $category['id']?>">Delete Category</a>
    </p>
<?php endforeach; ?>