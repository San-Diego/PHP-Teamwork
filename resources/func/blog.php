<?php

function add_post($db,$title,$contents,$by,$cat,$time)
{
    $title = mysql_real_escape_string($title);
    $contents = mysql_real_escape_string($contents);
	$query = "INSERT INTO `posts` SET
                    `title` = '{$title}',
                    `article` = '{$contents}',
					`by` = '{$by}',
					cat_id = '{$cat}',
                    `date` = '{$time}' ";
					
	try
    {
        // Execute the query to create the user
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }catch(PDOException $ex)
    {
        die("Failed to run query: " . $ex->getMessage());
    }
}

function edit_post($title, $contents, $category)
{
    $id = (int)$_GET['id'];
    $title = mysql_real_escape_string($title);
    $contents = mysql_real_escape_string($contents);
    $category = (int)$category;

    mysql_query("UPDATE `posts` SET
                  `cat_id` = {$category},
                  `title` = '{$title}',
                  `contents` = '{$contents}',
                  WHERE `id` = {$id}");
}

function add_category($name, $db)
{
    $query = "
            INSERT INTO cat (
                name
            ) VALUES (
                :name
            )
        ";

    $query_params = array(
        ':name' => $name
    );

    try
    {
        // Execute the query to create the user
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex)
    {
        die("Failed to run query: " . $ex->getMessage());
    }
}

function delete($table, $id, $db)
{
    $query = "
            DELETE FROM {$table}
            WHERE id={$id}
        ";

    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }
}

function get_posts($id = null, $cat_id = null)
{
    $posts = array();

    $query = "SELECT `posts`.`id` AS `post_id`,
                     `categories`.`id` AS `category_id`,
                `title`, `contents`, `date_posted`, `categories`.`name`
                FROM `posts`
                INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id`";

    if(isset($id)) {
        $id = (int)$id;
        $query .= "WHERE `posts`.`id` = '{$id}'";
    }

    if(isset($cat_id)) {
        $cat_id = (int)$cat_id;
        $query .= "WHERE `cat_id` = '{$cat_id}'";
    }

    $query .= "ORDER BY `posts`.`id` DESC";

    $query = mysql_query($query);

    while($row = mysql_fetch_assoc($query)){
        $posts[] = $row;
    }

    return $posts;
}

function category_exist($name, $db)
{
	 $query = "
	 SELECT
	 1
	 FROM cat
	 WHERE
	 name = :username
	 ";

	 $query_params = array(
	 ':username' => $name
	 );

	 try {
	 $stmt = $db->prepare($query);
	 $result = $stmt->execute($query_params);
	 } catch (PDOException $ex) {
	 // remove getMessage on production
	 die("Failed to run query: " . $ex->getMessage());
	 }

	 $row = $stmt->fetch();
	 if ($row) {
	 return true;
	 }
	 return false;
}

function get_categories($db)
{
    $query = "
            SELECT
                id, name
            FROM cat
        ";

    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }

    $rows = $stmt->fetchAll();
    return $rows;
}

function add_tags($db, $name) {
    foreach ($tags as $tag) {
        $result = mysql_query("SELECT id FROM tags WHERE name = $tag");
        if(mysql_num_rows($result) == 0) {
            $query = INSERT INTO `tags` SET `name` = $tag;
  }
	try    {
        /* Execute the query to create the tag*/
        $stmt = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }catch(PDOException $ex)    {
        die("Failed to run query: " . $ex->getMessage());
    }
    }

}

// this function is used only for presentation - created views/elements/category.php to replace it - still accepts $posts variable
function display_content($posts)
{
//    foreach ($posts as $post):
//
//        ?>
<!--        <h2><a href="index.php?id=--><?//=$post['post_id']?><!--">--><?//=$post['title']?><!--</a></h2>-->
<!--        <div>--><?//=nl2br($post['contents'])?><!--</div>-->
<!--        <div>-->
<!--            <p>Posted on --><?//=date('d-m-Y h:i:s', strtotime($post['date_posted']))?>
<!--                in <a href="category.php?id=--><?//=$post['category_id']?><!--">--><?//=$post['name']?><!--</a>-->
<!--            </p>-->
<!--        </div>-->
<!---->
<!--        <menu>-->
<!--            <ul>-->
<!--                <li><a href="delete_post.php?id=--><?//=$post['post_id']?><!--">Delete This Post</a></li>-->
<!--                <li><a href="edit_post.php?id=--><?//=$post['post_id']?><!--">Edit This Post</a></li>-->
<!--            </ul>-->
<!--        </menu>-->
<!--    --><?php //endforeach; ?>
<?php
}

?>
 