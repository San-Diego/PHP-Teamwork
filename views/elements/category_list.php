<style>
    p#categories a {
        font-size: 25px;
    }
</style>
<h1 align="center">Category List</h1>
<?php

foreach ($categories as $category):
    ?>
    <p align="center" id="categories">
        <a href="category.php?id=<?php echo $category['id'] ?>&name=<?php echo $category['name']?>"><?php echo htmlentities($category['name']) ?></a> -
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
        <a href="delete_category.php?id=<?php echo $category['id']?>">Delete Category</a>
        <?php endif ?>
    </p>
<?php endforeach; ?>