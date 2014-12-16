<?php if(!isset($_SESSION['user'])): ?>
    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">Team San Diego Blog</h1>
        <p class="lead blog-description">This is the official SoftUni teamwork blog</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">
<div>
    <a href="login.php">Log in</a><br />
    <a href="register.php">Register</a>
</div>
<?php endif ?>
<?php foreach ($posts as $post): ?>
    <h2 class="blog-post-title"><a href="index.php?id=<?php echo $post['id']?>"><?php echo htmlentities($post['title']) ?></a></h2>
    <p><?php echo nl2br(htmlentities($post['article'])) ?></p>
    <div>
        <p  class="blog-post-meta">
            Posted on <?php echo date('d-m-Y h:i:s', strtotime($post['date']))?><br />
            visits: <?php echo $post['visits'] ?><br />
            category:  <?php echo $post['cat_id'] != 0 ? get_category_name($post['cat_id']) : 'uncategorized' ?>
        </p>
    </div>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
    <menu>
        <ul>
            <li><a class="btn btn-danger" href="delete_post.php?id=<?php echo $post['id']?>">Delete This Post</a></li>
            <li><a class="btn btn-warning" href="edit_post.php?id=<?php echo $post['id']?>">Edit This Post</a></li>
        </ul>
    </menu>
    <?php endif ?>
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
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
            <a href="delete_comment.php?id=<?php echo $comment['id'] ?>&post_ID=<?php echo $post['id'] ?>">Delete comment</a>
            <?php endif ?>
        <?php endforeach ?>
    <?php endif ?>
<?php endforeach;
if (!$show_comments) :?>
<nav>
	<ul class="pagination">
        <li><a href="index.php?page=1">&lt;&lt;</a></li>
        <li><a href="index.php?page=<?php echo $prev_page ?>">&lt;</a></li>
		<?php for($i = $first_page ; $i <= $last_page ; $i++): ?>
			<li class="<?php if($i == $page){ echo 'active'; }?>"><a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
		<?php endfor ?>
        <li><a href="index.php?page=<?php echo $next_page ?>">&gt;</a></li>
        <li><a href="index.php?page=<?php echo $num_pages ?>">&gt;&gt;</a></li>
	</ul>
</nav>
    </div><!-- /.blog-main -->
	        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">February 2014</a></li>
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->
 </div><!-- /.row -->

</div><!-- /.container -->

<?php endif ?>

