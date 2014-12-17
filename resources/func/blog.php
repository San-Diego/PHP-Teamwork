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
        die("Failed to run query: ");
    }
}

function getArchivesArticles($db,$month, $year){
	$query = "SELECT * FROM posts";
	try {
        $stmt = $db->prepare($query);
        $stmt->execute();
		$articles = $stmt->fetchAll();
        
        foreach($articles as $article) {
            $date = $article['date'];
			$DByear = date("Y",$date);
            $DBmonth = date("F",$date);
			
			if($DByear==$year && $DBmonth==$month) {
				$id = $article['id'];
				$title = $article['title'];
				echo "<h2 class='blog-post-title'><a
                        href='index.php?id=$id'>$title</a>
                </h2>";
			}
        }
    } catch (PDOException $ex) {
        die("Failed to run query: ");
    }
}

function getArchives($db) {
	$query = "SELECT date FROM posts";
	try {
        $stmt = $db->prepare($query);
        $stmt->execute();
		$dates = $stmt->fetchAll();
        $years = array(
            2013 => array(
                'January' => 0,
                'February' => 0,
                'March' => 0,
                'April' => 0,
                'May' => 0,
                'June' => 0,
                'July' => 0,
                'August' => 0,
                'September' => 0,
                'October' => 0,
                'November' => 0,
                'December' => 0,
            ),
            2014 => array(
                'January' => 0,
                'February' => 0,
                'March' => 0,
                'April' => 0,
                'May' => 0,
                'June' => 0,
                'July' => 0,
                'August' => 0,
                'September' => 0,
                'October' => 0,
                'November' => 0,
                'December' => 0,
            )
        );
        foreach($dates as $date) {
            $year = date("Y",$date['date']);
            $month = date("F",$date['date']);
            $years[$year][$month]++;
        }

        foreach($years as $yearKey => $year) {
            foreach($year as $monthKey => $monthOutput) {
                if($monthOutput>0){
                    echo "<li><a href='archive.php?month=$monthKey&year=$yearKey'>$monthKey $yearKey</a></li>";
                }
            }
        }
    } catch (PDOException $ex) {
        die("Failed to run query: ");
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
        die("Failed to run query: ");
    }
}

function get_tags_by_post($id) {
    global $db;

    $query = "
            SELECT
                tag_id
            FROM blog_post_tags
            WHERE blog_post_id = :id";

    $query_params = array(
        ':id' => $id
    );

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        // remove getMessage on production
        die("Failed to run query: ");
    }

    $tags_id = $stmt->fetchAll();

    $results = [];

    foreach($tags_id as $tag_id) {
        $query = "
            SELECT
                name
            FROM tags
            WHERE id = :id";

        $query_params = array(
            ':id' => $tag_id['tag_id']
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
            $results[] = $stmt->fetch()['name'];
        } catch (PDOException $ex) {
            // remove getMessage on production
            die("Failed to run query: ");
        }
    }

    return $results;
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
        die("Failed to run query: ");
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
            die("Failed to run query: ");
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
                die("Failed to run query: ");
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
        die("Failed to run query: ");
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

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: ");
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
        die("Failed to run query: ");
    }

    $row = $stmt->fetch();
    return $row['name'];
}

function delete($table, $id, $col, $db)
{
    $query = "
            DELETE FROM {$table}
            WHERE {$col}={$id}
        ";

    try {
        $stmt = $db->prepare($query);
        $stmt->execute();
    } catch (PDOException $ex) {
        die("Failed to run query: ");
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
        die("Failed to run query: ");
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
        die("Failed to run query: ");
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
	 $stmt->execute($query_params);
	 } catch (PDOException $ex) {
	 die("Failed to run query: ");
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
        die("Failed to run query: ");
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
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: ");
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
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
            $result = $stmt->fetch();
            $tag_id = $result['id'];
        }catch(PDOException $ex)    {
            die("Failed to run query: ");
        }

        if(empty($result)) {
            $query = "INSERT INTO tags SET
                    name = :tag, count = 1";

            $query_params = array(
                ':tag' => $tag
            );

            try {
                $stmt = $db->prepare($query);
                $stmt->execute($query_params);
            } catch (PDOException $ex) {
                die("Failed to run query: ");
            }
        } else {
            $query = "UPDATE tags SET count=count+1 WHERE id=:tag_id";

            $query_params = array(
                ':tag_id' => $tag_id
            );

            try {
                $stmt = $db->prepare($query);
                $stmt->execute($query_params);
            } catch (PDOException $ex) {
                die("Failed to run query: ");
            }

        }
    }
}

function decrease_tag_count($tag_name)
{
    global $db;

    $query = "UPDATE tags SET count=count-1 WHERE name=:tag_name";

    $query_params = array(
        ':tag_name' => $tag_name
    );

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: ");
    }
}

function add_tagsToPost($db,$name, $id) {
    foreach ($name as $tag) {
        $query = "SELECT id FROM tags WHERE name = :tag";

        $query_params = array(
            ':tag' => $tag
        );
        try    {
            $stmt = $db->prepare($query);
            $stmt->execute($query_params);
        }catch(PDOException $ex)    {
            die("Failed to run query: ");
        }

        $tag_id = $stmt->fetch()['id'];

            $query = "INSERT INTO blog_post_tags SET
                    tag_id = {$tag_id}, blog_post_id = {$id}";
        try    {
            $stmt = $db->prepare($query);
            $stmt->execute();
        }catch(PDOException $ex)    {
            die("Failed to run query: ");
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
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    }
    catch(PDOException $ex)
    {
        die("Failed to run query: ");
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
        die("Failed to run query: ");
    }

    $rows = $stmt->fetchAll();
    return $rows;
}

function get_number_of_rows($tab, $col) {
    global $db;

    $query = "SELECT COUNT(:col) FROM $tab";

    $query_params = array(
        ':col' => $col,
    );

    try {
        $stmt = $db->prepare($query);
        $stmt->execute($query_params);
    } catch (PDOException $ex) {
        die("Failed to run query: ");
    }

    return $stmt->fetch()["COUNT('$col')"];
}
?>
 