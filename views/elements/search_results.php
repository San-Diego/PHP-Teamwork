<div class="container">
    <h1>Search Results</h1>
    <?php foreach ($posts as $post): ?>
        <h2><a href="index.php?id=<?php echo $post['id'] ?>"><?php echo htmlentities($post['title']) ?></a></h2>
        <div>
            <p>
                Posted on <?php echo date('d-m-Y \a\t h:i', $post['date']) ?>
            </p>
        </div>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
            <nav>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Action</button>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="edit_post.php?id=<?php echo $post['id'] ?>">Edit Post</a></li>
                        <li><a href="delete_post.php?id=<?php echo $post['id'] ?>">Delete Post</a></li>
                    </ul>
                </div>
            </nav>
            <hr>
        <?php endif ?>
    <?php endforeach; ?>
</div> <!-- /container -->
