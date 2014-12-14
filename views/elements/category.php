<h1>Display category - <?php echo $categoryName ?></h1>
<?php foreach ($posts as $post): ?>
<h2><a href="index.php?id=<?php echo $post['id']?>"><?php echo htmlentities($post['title']) ?></a></h2>
<div>
    <p>
        Posted on <?php echo date('d-m-Y h:i:s', strtotime($post['date']))?>
    </p>
</div>

<menu>
    <ul>
        <li><a href="delete_post.php?id=<?=$post['id']?>">Delete This Post</a></li>
        <li><a href="edit_post.php?id=<?=$post['id']?>">Edit This Post</a></li>
    </ul>
</menu>
<?php endforeach; ?>