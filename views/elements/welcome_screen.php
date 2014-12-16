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
            Posted on <?php echo date('d-m-Y h:i:s', strtotime($post['date']))?><br />
            visits: <?php echo $post['visits'] ?>
        </p>
    </div>

    <menu>
        <ul>
            <li><a href="delete_post.php?id=<?php echo $post['id']?>">Delete This Post</a></li>
            <li><a href="edit_post.php?id=<?php echo $post['id']?>">Edit This Post</a></li>
        </ul>
    </menu>
    <?php if($show_comments): ?>
        <form method="post" action="add_comment.php">
            <?php if(!isset($_SESSION['user'])): ?>
                <label for="userName">Your name:</label>
                <input type="text" name="user_name" id="userName"/><br />
            <?php endif ?>
            <label for="comment">Your comment:</label>
            <input type="text" name="content" id="comment" />
            <input type="submit" value="Add comment" />
            <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>"/>
        </form>
        <?php foreach($comments as $comment):?>
            <p>User name: <?php echo htmlentities($comment['user_name']) ?></p>
            <p>Content:<br /><?php echo htmlentities($comment['content']) ?></p>
            <a href="delete_comment.php?id=<?php echo $comment['id'] ?>&post_ID=<?php echo $post['id'] ?>">Delete comment</a>
        <?php endforeach ?>
    <?php endif ?>
<?php endforeach;
if (!$show_comments) :?>
<ul>
    <?php for($i = 1 ; $i <= $num_pages ; $i++): ?>
        <li><a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php endfor ?>
</ul>
<?php endif ?>
