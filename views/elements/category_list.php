<div class="container">
    <h1>List of Categories</h1>
<?php
foreach ($categories as $category):
    ?>
    <p>
        <a href="category.php?id=<?php echo $category['id'] ?>&name=<?php echo $category['name']?>"><?php echo htmlentities($category['name']) ?></a>
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
        <a href="delete_category.php?id=<?php echo $category['id']?>"> - Delete Category</a>
        <?php endif ?>
    </p>
<?php endforeach; ?>
</div> <!-- /container -->
