<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SanDiego's blog</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="category_list.php">Category List</a></li>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1): ?>
                        <li><a href="add_post.php">Add a Post</a></li>
                        <li><a href="add_category.php">Add a Category</a></li>
                    <?php endif ?>
                    <?php if(isset($_SESSION["user"])): ?>
                        <li><a href="#">User name: <?php echo $_SESSION["user"]["username"] ?></a></li>
                    <?php endif ?>
                </ul>
                <form class="navbar-form navbar-right" role="form" method="get" action="search.php">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder = "Search" name="search"/>
                    </div>
                    <input type="submit" class="btn btn-default" value="Search"/>
                </form>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</header>