<div class="container">
    <div class="blog-header">
        <h1 class="blog-title">Awesome Blog</h1>
        <p class="lead blog-description">This is the official PHP teamwork blog</p>
    </div>
    <div class="row">
        <div class="col-sm-8 blog-main">
            <?php foreach ($posts as $post): ?>
                <h2 class="blog-post-title"><a
                        href="index.php?id=<?php echo $post['id'] ?>"><?php echo htmlentities($post['title']) ?></a>
                </h2>
                <div>
                    <p class="blog-post-meta"><span class="glyphicon glyphicon-time"></span>
                        Posted on <?php echo date('d-m-Y \a\t h:i', ($post['date'])) ?><br/>
                        Seen: <?php echo $post['visits'] ?> times<br/>
                        Category:  <?php echo $post['cat_id'] != 0 ? get_category_name($post['cat_id']) : 'uncategorized' ?>
                    </p>
                </div>
                <hr>
                <p><?php echo nl2br(htmlentities($post['article'])) ?></p>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
                    <nav>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Action</button>
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="edit_post.php?id=<?php echo $post['id'] ?>">Edit Post</a></li>
                                <li><a href="delete_post.php?id=<?php echo $post['id'] ?>">Delete Post</a></li>
                            </ul>
                        </div>
                    </nav>
                <?php endif ?>
                <hr>
                <?php if ($show_comments): ?>
                    <p class="blog-post-meta">
                        Tagged:
                        <?php foreach ($tags as $tag): ?>
                            <a class="btn btn-xs btn-primary" href="search.php?search=<?php echo $tag ?>"><?php echo htmlentities($tag) ?></a>
                        <?php endforeach ?>
                    </p>
                    <form method="post" action="add_comment.php">
                        <?php if (!isset($_SESSION['user'])): ?>
                            <label for="userName">Your name:</label>
                            <input type="text" name="user_name" id="userName"/><br/>
                        <?php endif ?>
                        <label for="comment">Write a new comment:</label>
                        <div class="form-group">
                        <textarea class="form-control" name="content" id="comment" rows="5"></textarea>
                        </div>
                        <input type="submit" class="btn" value="Add comment"/>
                        <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>"/>
                    </form>
                    <?php foreach ($comments as $comment): ?>
                        <div id="comment">
                            <hr>
                            <p>Comment by: <?php echo htmlentities($comment['user_name']) ?></p>
                            <p>Comment:<br/><?php echo htmlentities($comment['content']) ?></p>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
                                <a href="delete_comment.php?id=<?php echo $comment['id'] ?>&post_ID=<?php echo $post['id'] ?>">Delete
                                    comment</a>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            <?php endforeach;
            if (!$show_comments) :?>
            <nav>
                <ul class="pagination">
                    <li><a href="index.php?page=1">&lt;&lt;</a></li>
                    <li><a href="index.php?page=<?php echo $prev_page ?>">&lt;</a></li>
                    <?php for ($i = $first_page; $i <= $last_page; $i++): ?>
                        <li class="<?php if ($i == $page) {
                            echo 'active';
                        } ?>"><a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php endfor ?>
                    <li><a href="index.php?page=<?php echo $next_page ?>">&gt;</a></li>
                    <li><a href="index.php?page=<?php echo $num_pages ?>">&gt;&gt;</a></li>
                </ul>
            </nav>
            <?php endif ?>
        </div>
        <!-- /.blog-main -->
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <?php if (!isset($_SESSION['user'])): ?>
                <div class="sidebar-module sidebar-module-inset">
                    <a href="login.php">Log in</a><br/>
                    <a href="register.php">Register</a>
                </div>
            <?php else: ?>
                <div class="sidebar-module sidebar-module-inset">
                    <a href="logout.php">Log out</a>
                </div>
            <?php endif ?>
            <div class="sidebar-module sidebar-module-inset">
                <h4>About</h4>

                <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet
                    fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
            </div>
            <div class="sidebar-module">
                <h4>Archives</h4>
                <ol class="list-unstyled">
                    <?php
						getArchives($db);
					?>
                </ol>
            </div>
            <div class="sidebar-module">
                <h4>Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="http://github.com/San-Diego/PHP-Teamwork" target="_blank">GitHub</a></li>
                </ol>
            </div>
        </div><!-- /.blog-sidebar -->
    </div><!-- /.row -->
</div><!-- /.container -->