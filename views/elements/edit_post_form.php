<h1>Edit a Post</h1>
<form action="" method="post">
    <div>
        <label for="title">Title: </label>
        <input type="text" id="title" name="title" value="<?=$post[0]['title']?>"/>
    </div>
    <div>
        <label for="contents">Contents: </label>
        <textarea name="contents" id="contents" cols="50" rows="15"><?=$post[0]['article']?></textarea>
    </div>
    <div>
        <label for="category">Category: </label>
        <select name="category" id="category">
            <?php
            $categories = get_categories($db);
            foreach ($categories as $category):
                $selected = ($category['name'] == $post[0]['name']) ? 'selected' : '';
                ?>
                <option value="<?php echo $category['name']?>"<?php echo $selected?>><?php echo $category['name']?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <input type="submit" value="Edit Post"/>
    </div>
</form>