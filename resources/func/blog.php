<?php

function add_post($db,$title,$contents,$by,$cat,$time)
{
   $query = "INSERT INTO posts (title,article,author,cat_id,date) VALUES (:title,:contents,:author,:cat,:time)";

    try
    {
        $stmt = $db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':contents', $contents);
        $stmt->bindParam(':author', $by);
        $stmt->bindParam(':cat', $cat);
        $stmt->bindParam(':time', $time);
        $stmt->execute();
    }catch(PDOException $ex)
    {
        die("Failed to run query: " . $ex->getMessage());
    }
}

function edit_post($id, $title, $contents, $category)
{
    global $db;

    $query = "UPDATE posts SET
                  cat_id = :category,
                  title = :title,
                  article = :contents
                  WHERE id = :id";

    $query_params = array(
        ':category' => $category,
        ':title' => $title,
        ':contents' => $contents,
        ':id' => $id
    );

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

function get_category_id($name) {
    global $db;

    $query = "
            SELECT
                id
            FROM cat
            WHERE name = :name";

    $query_params = array(
        ':name' => $name
    );

    if(isset($id)) {
        $id = (int)$id;
        $query .= " WHERE id = :id";
        $query_params[':id'] = $id;
    }

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }

    $row = $stmt->fetch();
    return $row['id'];

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

function get_posts($id = null, $cat_id = null, $offset, $count, $db)
{
//    $posts = array();
//
//    $query = "SELECT `posts`.`id` AS `post_id`,
//                     `categories`.`id` AS `category_id`,
//                `title`, `contents`, `date_posted`, `categories`.`name`
//                FROM `posts`
//                INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id`";
//
//    if(isset($id)) {
//        $id = (int)$id;
//        $query .= "WHERE `posts`.`id` = '{$id}'";
//    }
//
//    if(isset($cat_id)) {
//        $cat_id = (int)$cat_id;
//        $query .= "WHERE `cat_id` = '{$cat_id}'";
//    }
//
//    $query .= "ORDER BY `posts`.`id` DESC";
//
//    $query = mysql_query($query);
//
//    while($row = mysql_fetch_assoc($query)){
//        $posts[] = $row;
//    }
//
//    return $posts;

    //============================

    $query = "
            SELECT
                id, title, article, date, cat_id, visits
            FROM posts";

    $query_params = array();

    if(isset($id)) {
        $id = (int)$id;
        $query .= " WHERE id = :id";
        $query_params[':id'] = $id;
    }

    if(isset($cat_id)) {
        $cat_id = (int)$cat_id;
        $query .= " WHERE cat_id = :cat_id";
        $query_params[':cat_id'] = $cat_id;
    }

    $query .= " LIMIT {$offset}, {$count}";

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }

    $rows = $stmt->fetchAll();
    return $rows;
}

function increase_visits($id) {
    global $db;

    $query = "UPDATE posts SET visits=visits+1 WHERE id=:id";

    $query_params = array(
        ':id' => $id
    );

    try
    {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    }
    catch(PDOException $ex)
    {
        die("Failed to run query: " . $ex->getMessage());
    }
}

function category_exist($name, $db)
{
	 $query = "
	 SELECT
	 1
	 FROM cat
	 WHERE
	 name = :name
	 ";

	 $query_params = array(
	 ':name' => strtolower($name)
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
    foreach ($name as $tag) {
        $result = mysql_query("SELECT `name` FROM `tags` WHERE `name` = $tag");
        if($result == 0) {
            $query = "INSERT INTO `tags` SET
                    `name` = '{$tag}'";

  }
	try    {
        /* Execute the query to create the tag*/
        $stmt = $db->prepare($query);
        $result = $stmt->execute();
    }catch(PDOException $ex)    {
        die("Failed to run query: " . $ex->getMessage());
    }
    }
}

function add_comment($post_ID, $user_name, $content) {
    global $db;

    $query = "
            INSERT INTO comments (
                user_name, content, post_id
            ) VALUES (
                :user_name, :content, :post_ID
            )
        ";

    $query_params = array(
        ':user_name' => $user_name,
        ':content' => $content,
        ':post_ID' => $post_ID
    );

    try
    {
        // Execute the query to create the user
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    }
    catch(PDOException $ex)
    {
        die("Failed to run query: " . $ex->getMessage());
    }
}

function get_comments($post_id) {
    global $db;

    $query = "
            SELECT
                id, user_name, content
            FROM comments
            WHERE post_id = :post_id
        ";

    $query_params = array(
        ':post_id' => $post_id
    );

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }

    $rows = $stmt->fetchAll();
    return $rows;
}

function get_number_of_rows($tab, $col) {
    global $db;

    $query = "SELECT COUNT(:col) FROM $tab";

    $query_params = array(
        ':col' => $col,
        //':tab' => $tab
    );

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }

    return $stmt->fetch()["COUNT('$col')"];
}
?>
 