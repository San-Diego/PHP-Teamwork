<header>
    <h1>This is our header!</h1>
    <nav>
        <ul>
            <li><a href="index.php">Index</a></li>
            <li><a href="category_list.php">Category List</a></li>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
            <li><a href="add_post.php">Add a Post</a></li>
            <li><a href="add_category.php">Add a Category</a></li>
            <?php endif ?>
        </ul>
    </nav>
    <?php if(isset($_SESSION["user"])): ?>
    <div>
        <a href="logout.php">Log out</a><br />
        <span>User name: <?php echo $_SESSION["user"]["username"] ?></span>
    </div>
    <?php endif ?>
</header>