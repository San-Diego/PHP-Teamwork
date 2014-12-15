<?php if(!isset($_SESSION['user'])): ?>
<h2>Welcome!</h2>
<div>
    <a href="login.php">Log in</a><br />
    <a href="register.php">Register</a>
</div>
<?php endif ?>
<?php foreach ($posts as $post): ?>
    <h2><a href="index.php?id=<?php echo $post['id']?>"><?php echo htmlentities($post['title']) ?></a></h2>
    <div><?php echo nl2br(htmlentities($post['article'])) ?></div>
    <div>
        <p>
            Posted on <?php echo date('d-m-Y h:i:s', strtotime($post['date']))?>
        </p>
    </div>

    <menu>
        <ul>
            <li><a href="delete_post.php?id=<?php echo $post['id']?>">Delete This Post</a></li>
            <li><a href="edit_post.php?id=<?php echo $post['id']?>">Edit This Post</a></li>
        </ul>
    </menu>
<?php endforeach; ?>