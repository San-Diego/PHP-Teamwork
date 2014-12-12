<h1>Display category</h1>
<?php foreach ($posts as $post): ?>
<h2><a href="index.php?id=<?=$post['post_id']?>"><?=$post['title']?></a></h2>
<div><?=nl2br($post['contents'])?></div>
<div>
    <p>Posted on <?=date('d-m-Y h:i:s', strtotime($post['date_posted']))?>
        in <a href="category.php?id=<?=$post['category_id']?>"><?=$post['name']?></a>
    </p>
</div>

<menu>
    <ul>
        <li><a href="delete_post.php?id=<?=$post['post_id']?>">Delete This Post</a></li>
        <li><a href="edit_post.php?id=<?=$post['post_id']?>">Edit This Post</a></li>
    </ul>
</menu>
<?php endforeach; ?>