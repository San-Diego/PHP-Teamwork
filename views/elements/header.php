<header>
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index.php">Home</a>
          <a class="blog-nav-item" href="category_list.php">Category List</a>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
            <a class="blog-nav-item" href="add_post.php">Add a Post</a>
            <a class="blog-nav-item" href="add_category.php">Add a Category</a>
            <?php endif ?>
		  <?php if(isset($_SESSION["user"])): ?>
          <a class="blog-nav-item" href="logout.php">Log out</a>
		  <span>User name: <?php echo $_SESSION["user"]["username"] ?></span>
		  <?php endif ?>
        </nav>
          <form method="get" action="search.php">
              <input type="text" name="search"/>
              <input type="submit" value="Search"/>
          </form>
      </div>
    </div>
</header>
