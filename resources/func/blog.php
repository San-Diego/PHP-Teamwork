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

function get_posts_by_tag($tag) {
    global $db;
    $tag = strtolower(trim($tag));

    $query = "
            SELECT
                id
            FROM tags
            WHERE name = :name";

    $query_params = array(
        ':name' => $tag
    );

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }
    $tag_id = $stmt->fetch()['id'];

    if($tag_id) {
        $query = "
            SELECT
                blog_post_id
            FROM blog_post_tags
            WHERE tag_id = :tag_id";

        $query_params = array(
            ':tag_id' => $tag_id
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
        } catch (PDOException $ex) {
            // remove getMessage on production
            die("Failed to run query: " . $ex->getMessage());
        }
        $posts = $stmt->fetchAll();
        $return = [];

        foreach($posts as $post) {
            $query = "
            SELECT
                id, title, author, cat_id, date
            FROM posts
            WHERE id = :id";

            $query_params = array(
                ':id' => $post['blog_post_id']
            );

            try {
                $stmt = $db->prepare($query);
                $stmt->execute($query_params);
            } catch (PDOException $ex) {
                // remove getMessage on production
                die("Failed to run query: " . $ex->getMessage());
            }
            $res = $stmt->fetch();
            $return[] = $res;
        }

        return $return;
    }
    return;
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

//    if(isset($id)) {
//        $id = (int)$id;
//        $query .= " WHERE id = :id";
//        $query_params[':id'] = $id;
//    }

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

function get_category_name($id) {
    global $db;

    $query = "
            SELECT
                name
            FROM cat
            WHERE id = :id";

    $query_params = array(
        ':id' => $id
    );

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: " . $ex->getMessage());
    }

    $row = $stmt->fetch();
    return $row['name'];
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

function remove_posts_category($cat_id) {
    global $db;

    $query = "UPDATE posts SET cat_id = 0 WHERE cat_id = :cat_id";

    $query_params = array(
        ':cat_id' => $cat_id
    );

    try {
        /* Execute the query to create the tag*/
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: " . $ex->getMessage());
    }

}

function add_tags($db, $name) {
    foreach ($name as $tag) {
        $t = trim($tag);

        $query = "SELECT id FROM tags WHERE name = :tag";
        $query_params = array(
            ':tag' => $t
        );
        try    {
            /* Execute the query to create the tag*/
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
            $result = $stmt->fetch();
            $tag_id = $result['id'];
        }catch(PDOException $ex)    {
            die("Failed to run query: " . $ex->getMessage());
        }

        if(empty($result)) {
            $query = "INSERT INTO tags SET
                    name = :tag, count = 1";

            $query_params = array(
                ':tag' => $tag
            );

            try {
                /* Execute the query to create the tag*/
                $stmt = $db->prepare($query);
                $stmt->execute($query_params);
            } catch (PDOException $ex) {
                die("Failed to run query: " . $ex->getMessage());
            }
        } else {
            $query = "UPDATE tags SET count=count+1 WHERE id=:tag_id";

            $query_params = array(
                ':tag_id' => $tag_id
            );

            try {
                /* Execute the query to create the tag*/
                $stmt = $db->prepare($query);
                $stmt->execute($query_params);
            } catch (PDOException $ex) {
                die("Failed to run query: " . $ex->getMessage());
            }

        }
    }
}

function add_tagsToPost($db,$name, $id) {
    foreach ($name as $tag) {
        $query = "SELECT id FROM tags WHERE name = :tag";

        $query_params = array(
            ':tag' => $tag
        );
        try    {
            /* Execute the query to create the tag*/
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
        }catch(PDOException $ex)    {
            die("Failed to run query: " . $ex->getMessage());
        }

        $tag_id = $stmt->fetch()['id'];

            $query = "INSERT INTO blog_post_tags SET
                    tag_id = {$tag_id}, blog_post_id = {$id}";
        try    {
            /* Execute the query to create the tag*/
            $stmt = $db->prepare($query);
            $stmt->execute();
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
 