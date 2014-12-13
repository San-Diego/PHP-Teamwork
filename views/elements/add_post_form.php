<h1>Add a Post</h1>
<form action="" method="post">
    <div>
        <label for="title">Title: </label>
        <input type="text" id="title" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title'] ?>"/>
    </div>
    <div>
        <label for="contents">Contents: </label>
        <textarea name="contents" id="contents" cols="50" rows="15"><?php if(isset($_POST['contents'])) echo $_POST['contents'] ?></textarea>
    </div>
    <div>
        <label for="category">Category: </label>
        <select name="category" id="category">
            <?php
            $categories = get_categories($db);
            foreach ($categories as $category):
                ?>
                <option value="<?php echo htmlentities($category['name']) ?>"><?php echo htmlentities($category['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
	    <div>
        <label for="tags">Tags: </label>
        <select name="tags" id="tags">
            <?php
            foreach (get_tags() as $tags):
                ?>
                <option value="<?=$tags['id']?>"><?=$tags['name']?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <input type="submit" value="Add Post"/>
    </div>
</form>