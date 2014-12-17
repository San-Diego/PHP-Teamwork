<div class="container">
    <div class="blog-header">
        <h1 class="blog-title">Team San Diego Blog</h1>
        <p class="lead blog-description">This is the official SoftUni teamwork blog</p>
    </div>
    <div class="row">
        <div class="col-sm-8 blog-main">
            <?php
				getArchivesArticles(htmlspecialchars($_GET['month']),(int)$_GET['year']);
			?>
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
						getArchives();
					?>
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