<div class="container">
    <h2>Display category - <?php echo $categoryName ?></h2>
<?php foreach ($posts as $post): ?>
<h2><a href="index.php?id=<?php echo $post['id']?>"><?php echo htmlentities($post['title']) ?></a></h2>
<div>
    <p>
        Posted on <?php echo date('d-m-Y h:i:s', strtotime($post['date']))?>
    </p>
</div>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
    <menu>
        <ul>
            <li><a href="delete_post.php?id=<?php echo $post['id']?>">Delete This Post</a></li>
            <li><a href="edit_post.php?id=<?php echo $post['id']?>">Edit This Post</a></li>
        </ul>
    </menu>
    <?php endif ?>
<?php endforeach; ?>
</div> <!-- /container -->